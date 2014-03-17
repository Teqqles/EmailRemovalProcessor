<?php

namespace Notification;


use Notification\Exception\NotAMessageException;

class MessageList extends \ArrayObject {
    const CLASS_NAME = __CLASS__;


    /**
     * @param mixed   $index
     * @param Message $value
     *
     * @throws \Notification\Exception\NotAMessageException
     */
    public function offsetSet( $index, $value ) {
        if ( !$value instanceof Message ) {
            throw new NotAMessageException();
        }
        parent::offsetSet( $index, $value );
    }


    /**
     * @param mixed $index
     *
     * @return Message
     */
    public function offsetGet( $index ) {
        return parent::offsetGet( $index );
    }
}
 