<?php

namespace Notification\SNS;


class SnsRequestWrapper {
    const CLASS_NAME = __CLASS__;

    private $json;


    public function __construct( $rawJson ) {
        $this->json = json_decode( $rawJson );
    }


    /**
     * @return string
     */
    public function Type() {
        return $this->json->Type;
    }
}
 