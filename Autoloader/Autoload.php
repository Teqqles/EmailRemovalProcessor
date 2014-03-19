<?php

namespace Autoloader;

use Autoloader\Exception\AutoloadException;

require_once( __DIR__ . "/Exception/AutoloadException.php" );


class Autoload {
    const CLASS_NAME = __CLASS__;

    private $projectRoot;


    /**
     * @param $projectRoot
     */
    function __construct( $projectRoot = './' ) {
        $this->projectRoot = $projectRoot;
    }


    /**
     * @param $class
     *
     * @return bool
     * @throws AutoloadException
     */
    public function load( $class ) {
        $class = $this->discoverValidFile( $class );
        /** @noinspection PhpIncludeInspection */
        include_once( $class );

        return true;
    }


    /**
     * @param $class
     *
     * @return string
     * @throws Exception\AutoloadException
     */
    private function discoverValidFile( $class ) {
        $libraryClassFile        = $this->mapLibraryFile( $class );
        $implementationClassFile = $this->mapImplementationFile( $class );
        if ( file_exists( $libraryClassFile ) ) {
            return $libraryClassFile;
        } elseif ( file_exists( $implementationClassFile ) ) {
            return $implementationClassFile;
        }
        throw new AutoloadException( $class . " not found" );
    }


    /**
     * @param $class
     *
     * @return string
     */
    private function mapLibraryFile( $class ) {
        return __DIR__ . "/../" . str_replace( '\\', '/', $class ) . ".php";
    }


    /**
     * @param $class
     *
     * @return string
     */
    private function mapImplementationFile( $class ) {
        return $this->projectRoot . str_replace( '\\', '/', $class ) . ".php";
    }

}
 