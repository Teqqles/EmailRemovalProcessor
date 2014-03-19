<?php

namespace Notification\SNS;

use Notification\MessageList;
use Notification\MessageProcessor;
use Notification\RemovalProcessor;
use Subscriber\RemovalSubscriberList;

class SnsMessageListProcessor implements MessageProcessor {
    const CLASS_NAME = __CLASS__;

    /** @var string */
    private $postData;

    /**
     * @var SnsMessageListGenerator
     */
    private $messageListGenerator;

    /**
     * @var RemovalSubscriberList
     */
    private $removalSubscriberList;


    /**
     * @param                         $rawPost
     * @param SnsMessageListGenerator $messageListGenerator
     */
    public function __construct( $rawPost, SnsMessageListGenerator $messageListGenerator ) {
        $this->postData             = $rawPost;
        $this->messageListGenerator = $messageListGenerator;
    }


    public function attachSubscriberList( RemovalSubscriberList $removalSubscriber ) {
        $this->removalSubscriberList = $removalSubscriber;
    }


    public function process() {
        $messageList = $this->buildMessageList( $this->postData );
        $this->processMessageList( $messageList );
    }


    /**
     * @param $rawPost
     *
     * @return MessageList
     */
    private function buildMessageList( $rawPost ) {
        $snsRequest = $this->wrapRawPost( $rawPost );

        return $this->messageListGenerator->buildMessageList( $snsRequest );
    }


    /**
     * @param $rawPost
     *
     * @return SnsRequestWrapper
     */
    private function wrapRawPost( $rawPost ) {
        return new SnsRequestWrapper( $rawPost );
    }


    /**
     * @param MessageList $messageList
     */
    private function processMessageList( MessageList $messageList ) {
        $processor = $this->discoverProcessor( $messageList );
        $processor->process();
    }


    /**
     * @param MessageList $messageList
     *
     * @return MessageProcessor
     */
    public function discoverProcessor( MessageList $messageList ) {
        if ( $messageList instanceof ConfirmationMessageList ) {
            return new ConfirmationProcessor( $messageList );
        }

        return RemovalProcessor::createRemovalProcessor( $messageList, $this->removalSubscriberList );
    }
}
