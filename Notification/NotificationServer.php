<?php

namespace Notification;


interface NotificationServer {
    const INTERFACE_NotificationServer = __CLASS__;

    public function retrieveNotificationList();
}
 