<?php

namespace Notification\SNS;

use Notification\MessageList;

class ConfirmationMessageList extends MessageList {
    const CLASS_NAME = __CLASS__;


    public function confirm() {
        /** @var ConfirmationMessage $confirmationMessage */
        foreach ( $this as $confirmationMessage ) {
            $confirmationMessage->confirm();
        }
    }
}
 