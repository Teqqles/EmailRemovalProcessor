<?php

namespace Notification;

use Subscriber\SubscriptionItem;

class NullNotification implements RemovalNotification, SubscriptionItem, Message {
    const CLASS_NAME = __CLASS__;


    /**
     * @return string
     */
    public function getRemovalSubject() {
        return '';
    }


    /**
     * @return string
     */
    public function getRemovalMessage() {
        return '';
    }
}
 