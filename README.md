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

to be updated
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
