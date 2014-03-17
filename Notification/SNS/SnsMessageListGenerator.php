<?php

namespace Notification\SNS;


use Notification\BounceRemovalNotification;
use Notification\ComplaintRemovalNotification;
use Notification\Message;
use Notification\MessageList;
use Notification\NullNotification;

class SnsMessageListGenerator {
    const CLASS_NAME = __CLASS__;

    const SNS_NOTIFICATION_BOUNCE = 'Bounce';

    const SNS_NOTIFICATION_COMPLAINT = 'Complaint';


    /**
     * @param $data
     *
     * @return Message
     */
    public function buildMessageList( SnsRequestWrapper $data ) {

        $messageList = new MessageList();

        if ( $data->type() == SnsRequestWrapper::SNS_SUBSCRIPTION_CONFIRMATION ) {
            $messageList    = new ConfirmationMessageList();
            $messageList[ ] = new ConfirmationMessage( $data->subscribeUrl() );

            return $messageList;
        }


        return $this->mapMessageList( $data, $messageList );
    }


    /**
     * @param SnsRequestWrapper $dataWrapper
     * @param MessageList       $message
     *
     * @return MessageList
     */
    private function mapMessageList( SnsRequestWrapper $dataWrapper, MessageList $message ) {
        $countOfMessages = $dataWrapper->countUserEmailList();
        for ( $i = 0; $i < $countOfMessages; $i++ ) {
            $message[ ] = $this->detect( $dataWrapper, $i );
        }

        return $message;
    }


    /**
     * @param SnsRequestWrapper $data
     *
     * @param                   $offset
     *
     * @return Message
     */
    private function detect( SnsRequestWrapper $data, $offset ) {
        switch ( $data->notificationType() ) {
            case  self::SNS_NOTIFICATION_COMPLAINT:
                return new ComplaintRemovalNotification( $data->userEmail( $offset ), $data->feedback() );
            case self::SNS_NOTIFICATION_BOUNCE :
                return new BounceRemovalNotification( $data->userEmail( $offset ), $data->bounceType() );
        }
        return new NullNotification();
    }


}
 