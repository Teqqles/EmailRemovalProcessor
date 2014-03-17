<?php

namespace Notification;

use Publication\NotificationPublisher;
use Subscriber\RemovalSubscriber;
use Subscriber\RemovalSubscriberList;
use Subscriber\SubscriptionItem;

class RemovalProcessor implements MessageProcessor {
    const CLASS_NAME = __CLASS__;

    /** @var MessageList */
    private $messageList;

    /** @var NotificationPublisher */
    private $publisher;


    /**
     * @param MessageList           $messageList
     * @param NotificationPublisher $publisher
     * @param RemovalSubscriberList $subscriberList
     */
    public function __construct( MessageList $messageList,
                                 NotificationPublisher $publisher,
                                 RemovalSubscriberList $subscriberList ) {

        $this->messageList = $messageList;
        $this->publisher   = $publisher;
        $this->attachSubscriberList( $subscriberList );

    }


    /**
     * @param RemovalSubscriberList $subscriberList
     */
    private function attachSubscriberList( RemovalSubscriberList $subscriberList ) {
        /** @var RemovalSubscriber $subscriber */
        foreach ( $subscriberList as $subscriber ) {
            $this->publisher->attach( $subscriber );
        }
    }


    /**
     * @param MessageList $messageList
     *
     * @return RemovalProcessor
     */
    public static function createRemovalProcessor( MessageList $messageList ) {
        return new RemovalProcessor( $messageList, new NotificationPublisher(), new RemovalSubscriberList() );
    }


    public function process() {
        /** @var SubscriptionItem */
        foreach ( $this->messageList as $subscriptionRemovalMessage ) {
            $this->publisher->notifySubscribers( $subscriptionRemovalMessage );
        }
    }
}
 