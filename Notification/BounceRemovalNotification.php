<?php

namespace Notification;

use Notification\SNS\Message;
use Subscriber\SubscriptionItem;

class BounceRemovalNotification implements RemovalNotification, SubscriptionItem, Message {
    const CLASS_NAME = __CLASS__;

    const SETUP_EMAIL_ADDRESS = 'bounce@simulator.amazonses.com';


    public function __construct() {

    }


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
 