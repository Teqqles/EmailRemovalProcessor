<?php

namespace Notification;

use Notification\SNS\Message;
use Subscriber\SubscriptionItem;

class ComplaintRemovalNotification implements RemovalNotification, SubscriptionItem, Message {
    const CLASS_NAME = __CLASS__;

    /** @var string */
    private $emailAddress;

    /** @var string */
    private $removalReason;


    public function __construct( $emailAddressToRemove, $removalReason ) {
        $this->emailAddress  = $emailAddressToRemove;
        $this->removalReason = $removalReason;
    }


    /**
     * @return string
     */
    public function getRemovalSubject() {
        return $this->emailAddress;
    }


    /**
     * @return string
     */
    public function getRemovalMessage() {
        return $this->removalReason;
    }
}
 