<?php

namespace Notification\SNS;


use Notification\BounceRemovalNotification;
use Notification\ComplaintRemovalNotification;
use Notification\NullNotification;

class SnsMessageTypeFactory {
    const CLASS_NAME = __CLASS__;


    /**
     * @param $data
     *
     * @return Message
     */
    public static function determineMessageType( SnsRequestWrapper $data ) {
        switch ( $data->Type ) {
            case 'SubscriptionConfirmation' :
                return new ConfirmationMessage( $data->SubscribeURL );
        }
        return self::detect( $data->Message );
    }


    /**
     * @param $snsMessage
     *
     * @return Message
     */
    public static function detect( $snsMessage ) {
        switch ( $snsMessage->notificationType ) {
            case 'Complaint' :
                return new ComplaintRemovalNotification();
            case 'Bounce' :
                return new BounceRemovalNotification();
        }
        return new NullNotification();
    }


}
 