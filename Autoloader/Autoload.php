<?php

namespace Autoloader;

require_once( __DIR__ . "/AutoloadException.php" );


class Autoload {
    const CLASS_NAME = __CLASS__;


    /**
     * @param $class
     *
     * @throws AutoloadException
     */
    static public function load( $class ) {
        $class = __DIR__ . "/../" . str_replace( '\\', '/', $class ) . ".php";
        if ( !file_exists( $class ) ) {
            throw new AutoloadException();
        }
        /** @noinspection PhpIncludeInspection */
        require( $class );
    }

}
 