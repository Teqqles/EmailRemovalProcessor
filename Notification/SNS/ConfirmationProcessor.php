<?php

namespace Notification\SNS;

use Notification\MessageProcessor;

class ConfirmationProcessor implements MessageProcessor {
    const CLASS_NAME = __CLASS__;

    /**
     * @var ConfirmationMessageList
     */
    private $messageList;


    public function __construct( ConfirmationMessageList $confirmationList ) {
        $this->messageList = $confirmationList;
    }


    public function process() {
        $this->messageList->confirm();
    }
}
 