<?php

namespace Subscriber;


use Notification\RemovalNotification;

class NullRemovalSubscriber implements RemovalSubscriber {
    const CLASS_NAME = __CLASS__;


    /**
     * @param RemovalNotification $removal
     *
     * @return bool
     */
    public function update( RemovalNotification $removal ) {
        return true;
    }
}
 