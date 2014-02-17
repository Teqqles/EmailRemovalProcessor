<?php

namespace Notification\SNS;


class ConfirmationMessage implements Message {
    const CLASS_NAME = __CLASS__;

    /** @var string */
    private $certificateBundle;

    /** @var string */
    private $confirmationUrl;


    /**
     * @param $subscribeConfirmationUrl
     */
    public function __construct( $subscribeConfirmationUrl ) {
        $this->certificateBundle = __DIR__ . '/certs/cacert.pem';
        $this->confirmationUrl   = $subscribeConfirmationUrl;
    }


    /**
     * @return string
     */
    public function confirm() {
        return $this->retrieveConfirmationContentViaCurl( $this->confirmationUrl );
    }


    /**
     * @param string $url
     *
     * @return string
     */
    private function retrieveConfirmationContentViaCurl( $url ) {
        $curlHandle = curl_init();
        curl_setopt( $curlHandle, CURLOPT_HEADER, 0 );
        curl_setopt( $curlHandle, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt( $curlHandle, CURLOPT_URL, $url );
        curl_setopt( $curlHandle, CURLOPT_SSL_VERIFYHOST, 2 );
        curl_setopt( $curlHandle, CURLOPT_SSL_VERIFYPEER, 1 );
        curl_setopt( $curlHandle, CURLOPT_CAINFO, $this->certificateBundle );
        $data = curl_exec( $curlHandle );
        curl_close( $curlHandle );

        return $data;
    }
}
