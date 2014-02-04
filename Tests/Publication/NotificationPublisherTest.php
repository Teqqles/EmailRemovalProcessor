<?php

namespace Tests\Publication;


use Publication\NotificationPublisher;
use Subscriber\NullRemovalSubscriber;

class NotificationPublisherTest extends \PHPUnit_Framework_TestCase {
    const CLASS_NAME = __CLASS__;


    public function test_attachAndDetachSubscriber() {
        $publisher   = new NotificationPublisher();
        $subscriberA = new NullRemovalSubscriber();
        $subscriberB = new NullRemovalSubscriber();

        $this->assertTrue(
            $publisher->attach( $subscriberA ),
            "A subscriber is attached when it is not registered with the publisher"
        );

        $this->assertFalse(
            $publisher->attach( $subscriberA ),
            "A subscriber is not reattached when it is registered with the publisher"
        );

        $this->assertTrue(
            $publisher->attach( $subscriberB ),
            "New subscribers are attached regardless of any existing subscriptions"
        );

        $this->assertTrue(
            $publisher->detach( $subscriberB ),
            "Subscriptions are removed from a publisher by calling detach"
        );

        $this->assertFalse(
            $publisher->detach( $subscriberB ),
            "Subscriptions are not removed if they do not exist in a publisher"
        );
    }


    public function test_updateSubscribers() {
        $this->fail( "not implemented" );
    }
}
 