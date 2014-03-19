<?php
/**
 * Author: Teqqles@gmail.com
 * Date: 04/02/14
 * Time: 12:30
 */

//require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . "/Autoloader/Autoload.php";

$autoloader = new \Autoloader\Autoload();
spl_autoload_register( array( $autoloader, 'load' ) );