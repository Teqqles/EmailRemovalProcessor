<?php

namespace Publication;

use Subscriber\RemovalSubscriber;
use Subscriber\SubscriptionItem;

interface Publisher {
    const INTERFACE_Publisher = __CLASS__;


    /**
     * @param RemovalSubscriber $subscriber
     *
     * @return bool
     */
    public function attach( RemovalSubscriber $subscriber );


    /**
     * @param RemovalSubscriber $subscriber
     *
     * @return bool
     */
    public function detach( RemovalSubscriber $subscriber );


    /**
     * @param SubscriptionItem $item
     */
    public function notifySubscribers( SubscriptionItem $item );


}
 