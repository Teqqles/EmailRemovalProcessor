<?php

require_once( "../autoload.php" );

use Notification\SNS\SnsMessageListGenerator;
use Notification\SNS\SnsMessageListProcessor;

if ( !isset( $HTTP_RAW_POST_DATA ) ) {
    $HTTP_RAW_POST_DATA = file_get_contents( 'php://input' );
}

$HTTP_RAW_POST_DATA = file_get_contents("D:/EmailRemovalProcessor/Tests/sns.subscription.test.txt");

$processorFactory = new SnsMessageListProcessor( $HTTP_RAW_POST_DATA, new SnsMessageListGenerator() );

$processorFactory->process();

