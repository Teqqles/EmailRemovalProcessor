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
$notificationType = $snsRequest->notificationType();
$problem_email    = $snsRequest->userEmail();
$from_email       = $snsRequest->fromAddress();

//check if email is valid, if not, exit
if ( !filter_var( $problem_email, FILTER_VALIDATE_EMAIL ) ) {
    exit;
}


if ( $problem_email == $complaint_simulator_email ) {
    //confirm setup
}

//Update database of
