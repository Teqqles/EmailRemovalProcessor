<?php

namespace Notification;

use Notification\SNS\Message;
use Subscriber\SubscriptionItem;

class BounceRemovalNotification implements RemovalNotification, SubscriptionItem, Message {
    const CLASS_NAME = __CLASS__;

    /** @var string */
    private $emailToRemove;

    /** @var bool */
    private $softBounce = false;


    public function __construct( $emailToRemove, $bounceType ) {
        $this->emailToRemove = $emailToRemove;
        $this->softBounce    = ( $bounceType == 'Transient' );
    }


    /**
     * @return string
     */
    public function getRemovalSubject() {
        return $this->emailToRemove;
    }


    /**
     * @return string
     */
    public function getRemovalMessage() {
        return $this->softBounce
                ? 'Soft'
                : 'Hard';
    }
}
 