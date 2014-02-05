#EmailRemovalProcessor
=====================

Tool for handling the removal of bounced or complaint emails from a data store.

---

Usage:
- A subscriber is added to the NotificationPublisher.
- When the publisher receives a notification it sends this to each subscriber which is in itself responsible for handling removal.

## Quick Example

```php
<?php

use Publication\NotificationPublisher;
use Subscriber\NullRemovalSubscriber; //replace with your implementation
use Notification\BounceRemovalNotification;

$publisher    = new NotificationPublisher();
$notification = new BounceRemovalNotification();
$subscriber   = new NullRemovalSubscriber();

$publisher->attach( $subscriber );
$publisher->notifySubscribers( $notification ); //notifies all subscribers of a bounce

```

Also see test suite for usage examples

## Uses

Processor uses:
- AWS-SDK-PHP <https://github.com/aws/aws-sdk-php>

---

Tests are written using:

- PHPUnit <https://github.com/sebastianbergmann/phpunit>
- Phockito <https://github.com/hafriedlander/phockito>
- DynamicReturnType (PHPStorm plugin) <https://github.com/pbyrne84/DynamicReturnTypePlugin>
