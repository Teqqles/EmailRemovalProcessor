<?php

namespace Removal;


use Notification\RemovalNotification;

interface SubscriberRemoval {
    const INTERFACE_RemoveSubscriber = __CLASS__;


    /**
     * @param \Notification\RemovalNotification $notification
     *
     * @return bool
     */
    public function remove( RemovalNotification $notification );
}
 