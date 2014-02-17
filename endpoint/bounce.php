<?php

	if (!isset($HTTP_RAW_POST_DATA)) $HTTP_RAW_POST_DATA = file_get_contents('php://input');
	$data = json_decode($HTTP_RAW_POST_DATA);

	$bounce_simulator_email = 'bounce@simulator.amazonses.com';
	
	//Confirm SNS subscription
	if($data->Type == 'SubscriptionConfirmation')
	{		
		file_get_contents_curl($data->SubscribeURL);
	}
	else
	{
		//detect bounces
		$obj = json_decode($data->Message);
		$notificationType = $obj->{'notificationType'};
		$bounceType = $obj->{'bounce'}->{'bounceType'};
		$problem_email = $obj->{'bounce'}->{'bouncedRecipients'};
		$problem_email = $problem_email[0]->{'emailAddress'};
		$from_email = $obj->{'mail'}->{'source'};
        $from_email = preg_replace( '/<[^>]+>/i', '', $from_email );
		
		//check if email is valid, if not, exit
		if(!filter_var($problem_email,FILTER_VALIDATE_EMAIL)) exit;
		
		if($notificationType=='Bounce')
		{
			//Update Bounce status
			if($problem_email==$bounce_simulator_email) 
			{
				mysqli_query($mysqli, 'UPDATE apps SET bounce_setup=1 WHERE from_email = "'.$from_email.'"');
				mysqli_query($mysqli, 'UPDATE campaigns SET bounce_setup=1 WHERE from_email = "'.$from_email.'"');
			}
			
			//Update database of
			if($bounceType == 'Transient')
				$q = 'UPDATE subscribers SET bounce_soft = bounce_soft+1 WHERE email = "'.$problem_email.'"';
			else
				$q = 'UPDATE subscribers SET bounced = 1, timestamp = '.$time.' WHERE email = "'.$problem_email.'"';
			$r = mysqli_query($mysqli, $q);
			if ($r)
			{
				//check if recipient has soft bounced 3 times
				if($bounceType == 'Transient')
				{
					$q2 = 'SELECT bounce_soft FROM subscribers WHERE email = "'.$problem_email.'" LIMIT 1';
					$r2 = mysqli_query($mysqli, $q2);
					if ($r2 && mysqli_num_rows($r2) > 0)
					{
					    while($row = mysqli_fetch_array($r2))
					    {
							$bounce_soft = $row['bounce_soft'];
					    }  
					    
					    //if soft bounced 3 times or more, set as hard bounce
					    if($bounce_soft >= 3)
					    {
						    $q = 'UPDATE subscribers SET bounced = 1, timestamp = '.$time.' WHERE email = "'.$problem_email.'"';
						    $r = mysqli_query($mysqli, $q);
						    if($r){}
					    }
					}
				}
			}
		}
	}
