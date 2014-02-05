<?php

namespace Notification;

use Subscriber\SubscriptionItem;

class BounceRemovalNotification implements RemovalNotification, SubscriptionItem {
    const CLASS_NAME = __CLASS__;


    /**
     * @return string
     */
    public function getRemovalSubject() {

    }


    /**
     * @return string
     */
    public function getRemovalMessage() {

    }
}
 