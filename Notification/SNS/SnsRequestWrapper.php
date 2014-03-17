<?php

namespace Notification\SNS;


class SnsRequestWrapper {
    const CLASS_NAME = __CLASS__;

    const SNS_REQUEST_NO_FROM_ADDRESS = "No from address is contained in SNS Request";

    const SNS_REQUEST_NO_USER_ADDRESS = "No user email address is contained in specified index within SNS Request";

    const SNS_SUBSCRIPTION_CONFIRMATION = 'SubscriptionConfirmation';

    private $messageWrapper;

    private $message;


    public function __construct( $rawJson ) {
        $this->messageWrapper = json_decode( $rawJson );
        $this->message        = $this->messageWrapper->Message;
    }


    /**
     * @return string
     */
    public function type() {
        return $this->messageWrapper->Type;
    }


    /**
     * @return string
     */
    public function notificationType() {
        return $this->message->{'notificationType'};
    }


    /**
     * @return int
     */
    public function countUserEmailList() {
        $problemEmailList = $this->retrieveRecipients();

        return count( $problemEmailList );
    }


    /**
     * @return array
     */
    private function retrieveRecipients() {
        if ( isset( $this->message->{'complaint'}->{'complainedRecipients'} ) ) {
            return $this->message->{'complaint'}->{'complainedRecipients'};
        } elseif ( isset( $this->message->{'bounce'}->{'bouncedRecipients'} ) ) {
            return $this->message->{'bounce'}->{'bouncedRecipients'};
        }

        return array();
    }


    /**
     * @param int $index
     *
     * @throws SnsRequestException
     * @return string
     */
    public function userEmail( $index = 0 ) {
        $problemEmailList = $this->retrieveRecipients();

        $problemEmail = $problemEmailList[ $index ]->{'emailAddress'};

        $this->checkNullValues( $problemEmail, self::SNS_REQUEST_NO_USER_ADDRESS );

        return $problemEmail;
    }


    /**
     * @param $value
     * @param $message
     *
     * @throws SnsRequestException
     */
    private function checkNullValues( $value, $message ) {
        if ( $value == '' ) {
            throw new SnsRequestException( $message );
        }
    }


    /**
     * @return string
     * @throws SnsRequestException
     */
    public function fromAddress() {
        $fromEmail = $this->message->{'mail'}->{'source'};

        $this->checkNullValues( $fromEmail, self::SNS_REQUEST_NO_FROM_ADDRESS );

        return preg_replace( '/<[^>]+>/i', '', $fromEmail );
    }


    /**
     * @return string
     */
    public function subscribeUrl() {
        return $this->messageWrapper->{'SubscribeURL'};
    }


    /**
     * @return string
     */
    public function feedback() {
        if ( !isset( $this->message->{'complaint'}->{'complaintFeedbackType'} ) ) {
            return 'no feedback';
        }

        return $this->message->{'complaint'}->{'complaintFeedbackType'};
    }


    /**
     * @return string
     */
    public function bounceType() {
        $bounceType = $this->message->{'bounce'}->{'bounceType'};

        return $bounceType;
    }

}
 