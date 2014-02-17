<?php
use Notification\SNS\SnsRequestWrapper;

if ( !isset( $HTTP_RAW_POST_DATA ) ) {
    $HTTP_RAW_POST_DATA = file_get_contents( 'php://input' );
}

$snsRequest = new SnsRequestWrapper( $HTTP_RAW_POST_DATA );
//$complaint_simulator_email = 'complaint@simulator.amazonses.com';

//Confirm SNS subscription

$message = \Notification\SNS\SnsMessageTypeFactory::determineMessageType( $snsRequest );


if ( $message instanceof \Notification\SNS\ConfirmationMessage ) {
    $message->confirm();
    exit;
}

//detect complaints
$obj              = json_decode( $data->Message );
$notificationType = $obj->{'notificationType'};
$problem_email    = $obj->{'complaint'}->{'complainedRecipients'};
$problem_email    = $problem_email[ 0 ]->{'emailAddress'};
$from_email       = $obj->{'mail'}->{'source'};
$from_email       = preg_replace( '/<[^>]+>/i', '', $from_email );

//check if email is valid, if not, exit
if ( !filter_var( $problem_email, FILTER_VALIDATE_EMAIL ) ) {
    exit;
}

if ( $notificationType == 'Complaint' ) {
    //Update Bounce status
    if ( $problem_email == $complaint_simulator_email ) {
        mysqli_query( $mysqli, 'UPDATE apps SET complaint_setup=1 WHERE from_email = "' . $from_email . '"' );
        mysqli_query( $mysqli, 'UPDATE campaigns SET complaint_setup=1 WHERE from_email = "' . $from_email . '"' );
    }

    //get the id of the last campaign
    $q = 'SELECT last_campaign, last_ares FROM subscribers WHERE email = "' . $problem_email . '"';
    $r = mysqli_query( $mysqli, $q );
    if ( $r && mysqli_num_rows( $r ) > 0 ) {
        while ( $row = mysqli_fetch_array( $r ) ) {
            $campaign_id    = $row[ 'last_campaign' ];
            $ares_emails_id = $row[ 'last_ares' ];

            if ( $campaign_id == '' ) {
                $campaign_id = 0;
            }
            if ( $ares_emails_id == '' ) {
                $ares_emails_id = 0;
            }

            //Update database of
            $q2 = 'UPDATE subscribers SET unsubscribed = 0, bounced = 0, complaint = 1, timestamp = ' . $time . ' WHERE email = "' . $problem_email . '" AND (last_campaign = ' . $campaign_id . ' OR last_ares = ' . $ares_emails_id . ')';
            mysqli_query( $mysqli, $q2 );
        }
    }
}
