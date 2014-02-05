<?php

namespace Notification;


use Notification\Exception\NotANotificationServerException;

class NotificationServerList extends \ArrayObject {
    const CLASS_NAME = __CLASS__;


    /**
     * @param mixed              $index
     * @param NotificationServer $value
     *
     * @throws NotANotificationServerException
     */
    public function offsetSet( $index, $value ) {
        if ( !$value instanceof RemovalNotification ) {
            throw new NotANotificationServerException();
        }
        parent::offsetSet( $index, $value );
    }


    /**
     * @param mixed $index
     *
     * @return NotificationServer
     */
    public function offsetGet( $index ) {
        return parent::offsetGet( $index );
    }
}
 