<?php

namespace Notification;


interface RemovalNotification {
    const INTERFACE_RemovalNotification = __CLASS__;


    /**
     * @return string
     */
    public function getRemovalSubject();


    /**
     * @return string
     */
    public function getRemovalMessage();

}
 