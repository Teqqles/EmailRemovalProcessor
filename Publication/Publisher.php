<?php

namespace Publication;

use Subscriber\RemovalSubscriber;

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


    public function updateSubscribers();
}
 