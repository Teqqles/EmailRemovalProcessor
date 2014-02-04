<?php

namespace Logging;

use Notification\RemovalNotification;

interface LogNotification {
    const INTERFACE_Log = __CLASS__;


    /**
     * @param RemovalNotification $notification
     */
    public function log( RemovalNotification $notification );
}
 