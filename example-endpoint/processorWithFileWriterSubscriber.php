<?php

require_once( "../autoload.php" );

use Notification\RemovalProcessor;
use Notification\SNS\SnsMessageListGenerator;
use Notification\SNS\SnsMessageListProcessor;

if ( !isset( $HTTP_RAW_POST_DATA ) ) {
    $HTTP_RAW_POST_DATA = file_get_contents( 'php://input' );
}

$HTTP_RAW_POST_DATA = file_get_contents( "../Tests/sns.complaint.test.txt" );

/** @var RemovalProcessor $processorFactory */
$processorFactory = new SnsMessageListProcessor( $HTTP_RAW_POST_DATA, new SnsMessageListGenerator() );

$subscriberList = new \Subscriber\RemovalSubscriberList();
$subscriberList->offsetSet( 0, new \Subscriber\FileWriterRemovalSubscriber( 'removal.txt', true ) );

$processorFactory->attachSubscriberList( $subscriberList );

$processorFactory->process();

