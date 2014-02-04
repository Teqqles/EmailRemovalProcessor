<?php

namespace Removal;


use Publication\Publisher;

class RemovalProcessor {
    const CLASS_NAME = __CLASS__;

    /** @var Publisher */
    private $publisher;


    public function __construct( Publisher $publisher ) {
        $this->publisher = $publisher;
    }
}
 