<?php

namespace Subscriber;

use Notification\RemovalNotification;

interface RemovalSubscriber {
    const INTERFACE_Subscriber = __CLASS__;


    /**
     * @param RemovalNotification $removal
     *
     * @return bool
     */
    public function update( RemovalNotification $removal );
}
 