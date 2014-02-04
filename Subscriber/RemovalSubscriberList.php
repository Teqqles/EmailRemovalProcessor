<?php

namespace Subscriber;


class RemovalSubscriberList extends \ArrayObject {
    const CLASS_NAME = __CLASS__;


    /**
     * @param mixed             $index
     * @param RemovalSubscriber $value
     *
     * @throws NotARemovalSubscriberException
     */
    public function offsetSet( $index, $value ) {
        if ( !$value instanceof RemovalSubscriber ) {
            throw new NotARemovalSubscriberException();
        }
        parent::offsetSet( $index, $value );
    }


    /**
     * @param mixed $index
     *
     * @return RemovalSubscriber
     */
    public function offsetGet( $index ) {
        return parent::offsetGet( $index );
    }
}
 