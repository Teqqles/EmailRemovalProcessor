<?php

namespace Notification;


interface MessageProcessor {
    const INTERFACE_SnsMessageProcessor = __CLASS__;

    public function process();
}
 