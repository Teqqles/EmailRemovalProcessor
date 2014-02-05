<?php

namespace Subscriber;

interface RemovalSubscriber {
    const INTERFACE_Subscriber = __CLASS__;


    /**
     * @param SubscriptionItem $item
     *
     * @return bool
     */
    public function update( SubscriptionItem $item );
}
 