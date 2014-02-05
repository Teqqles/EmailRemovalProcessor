<?php

namespace Publication;


use Subscriber\RemovalSubscriber;
use Subscriber\RemovalSubscriberList;
use Subscriber\SubscriptionItem;

class NotificationPublisher implements Publisher {
    const CLASS_NAME = __CLASS__;

    /** @var RemovalSubscriberList */
    private $subscriberList;


    public function __construct() {
        $this->subscriberList = new RemovalSubscriberList();
    }


    /**
     * @param RemovalSubscriber $subscriber
     *
     * @return bool
     */
    public function attach( RemovalSubscriber $subscriber ) {
        if ( $this->subscriberInList( $subscriber ) ) {
            return false;
        }
        $this->subscriberList[ ] = $subscriber;

        return true;
    }


    /**
     * @param RemovalSubscriber $subscriber
     *
     * @return bool
     */
    private function subscriberInList( RemovalSubscriber $subscriber ) {
        /** @var $subListEntry RemovalSubscriber */
        foreach ( $this->subscriberList as $subListEntry ) {
            if ( $subListEntry === $subscriber ) {
                return true;
            }
        }

        return false;
    }


    /**
     * @param RemovalSubscriber $subscriber
     *
     * @return bool
     */
    public function detach( RemovalSubscriber $subscriber ) {
        return $this->removeSubscriber( $subscriber );
    }


    /**
     * @param RemovalSubscriber $subscriber
     *
     * @return bool
     */
    private function removeSubscriber( RemovalSubscriber $subscriber ) {
        /** @var $subListEntry RemovalSubscriber */
        foreach ( $this->subscriberList as $key => $subListEntry ) {
            if ( $subListEntry === $subscriber ) {
                $this->subscriberList->offsetUnset( $key );

                return true;

            }
        }

        return false;
    }


    /**
     * @param SubscriptionItem $item
     *
     * @throws \Exception
     */
    public function notifySubscribers( SubscriptionItem $item ) {

        /** @var RemovalSubscriber $subscriber */
        foreach ( $this->subscriberList as $subscriber ) {
            $subscriber->update( $item );
        }
    }


}
 