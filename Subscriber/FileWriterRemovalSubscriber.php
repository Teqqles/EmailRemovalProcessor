<?php

namespace Subscriber;


use Notification\BounceRemovalNotification;
use Notification\ComplaintRemovalNotification;
use Notification\RemovalNotification;

class FileWriterRemovalSubscriber implements RemovalSubscriber {
    const CLASS_NAME = __CLASS__;

    /**
     * @var string
     */
    private $fileLocation;

    /**
     * @var boolean
     */
    private $split;


    /**
     * @param $fileLocation
     * @param $splitMessageTypes
     */
    public function __construct( $fileLocation, $splitMessageTypes ) {
        $this->fileLocation = $fileLocation;
        $this->split        = $splitMessageTypes;
    }


    /**
     * @param SubscriptionItem $item
     *
     * @return bool
     */
    public function update( SubscriptionItem $item ) {
        if ( $item instanceof ComplaintRemovalNotification ) {
            return $this->fileProcessing( $item, '-complaint' );
        } elseif ( $item instanceof BounceRemovalNotification ) {
            return $this->updateByBounceType( $item );
        }

        return false;
    }


    /**
     * @param \Notification\RemovalNotification $notification
     * @param                                   $nameToAppend
     *
     * @return bool
     */
    private function fileProcessing( RemovalNotification $notification, $nameToAppend ) {
        $file = $this->fileLocation;
        if ( $this->split ) {
            $file = $this->splitFileSectionAppender( $file, $nameToAppend );
        }

        return file_put_contents( $file, $notification->getRemovalSubject() . "\n", FILE_APPEND ) !== false;
    }


    /**
     * @param $fileName
     * @param $appendName
     *
     * @return string
     */
    private function splitFileSectionAppender( $fileName, $appendName ) {
        $newFile = preg_replace( '/^(.*?)(\.\w{3,4})?$/i', '\1' . $appendName . '\2', $fileName );

        return $newFile;
    }


    /**
     * @param \Notification\BounceRemovalNotification $item
     *
     * @return bool
     */
    private function updateByBounceType( BounceRemovalNotification $item ) {
        return $this->fileProcessing( $item, '-' . $item->getRemovalMessage() . '-bounce' );
    }

}
 