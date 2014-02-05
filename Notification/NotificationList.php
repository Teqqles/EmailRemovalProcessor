<?php

namespace Notification;


use Notification\Exception\NotANotificationException;

class NotificationList extends \ArrayObject {
    const CLASS_NAME = __CLASS__;


    /**
     * @param mixed               $index
     * @param RemovalNotification $value
     *
     * @throws NotANotificationException
     */
    public function offsetSet( $index, $value ) {
        if ( !$value instanceof RemovalNotification ) {
            throw new NotANotificationException();
        }
        parent::offsetSet( $index, $value );
    }


    /**
     * @param mixed $index
     *
     * @return RemovalNotification
     */
    public function offsetGet( $index ) {
        return parent::offsetGet( $index );
    }
}
 