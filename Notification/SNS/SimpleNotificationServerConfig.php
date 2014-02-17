<?php

namespace Notification\SNS;


class SimpleNotificationServerConfig {
    const CLASS_NAME = __CLASS__;

    private $key;

    private $secret;

    private $region;


    public function __construct( $key, $secret, $region ) {
        $this->key    = $key;
        $this->secret = $secret;
        $this->region = $region;
    }
}
 