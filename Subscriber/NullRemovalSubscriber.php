<?php

namespace Subscriber;


class NullRemovalSubscriber implements RemovalSubscriber {
    const CLASS_NAME = __CLASS__;


    /**
     * @param SubscriptionItem $item
     *
     * @return bool
     */
    public function update( SubscriptionItem $item ) {
        return true;
    }
}
 