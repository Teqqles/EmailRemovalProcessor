<?php

namespace Notification;

use Subscriber\SubscriptionItem;

class BounceRemovalNotification implements RemovalNotification, SubscriptionItem, Message {
    const CLASS_NAME = __CLASS__;

    const SNS_RAW_SOFT_BOUNCE_MESSAGE = 'Transient';

    const BOUNCE_HARD = 'hard';

    const BOUNCE_SOFT = 'soft';

    /** @var string */
    private $emailToRemove;

    /** @var bool */
    private $softBounce = false;


    public function __construct( $emailToRemove, $bounceType ) {
        $this->emailToRemove = $emailToRemove;
        $this->softBounce    = ( $bounceType == self::SNS_RAW_SOFT_BOUNCE_MESSAGE );
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
                ? self::BOUNCE_SOFT
                : self::BOUNCE_HARD;
    }
}
 