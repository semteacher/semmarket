<?php
/**
 * Created by PhpStorm.
 * User: SemenetsA
 * Date: 20.06.2015
 * Time: 16:18
 */
session_start();
 
define ('DS', DIRECTORY_SEPARATOR);
define ('HOME', dirname(__FILE__));

if (dirname($_SERVER['SCRIPT_NAME']) !=DIRECTORY_SEPARATOR) {
    define ('SITE_ROOT', dirname($_SERVER['SCRIPT_NAME']));
} else {
    define ('SITE_ROOT', '');
}

ini_set('display_errors', 1);

require_once HOME . DS . 'configs' . DS . 'app_conf.php';
require_once HOME . DS . 'configs' . DS . 'db_conf.php';
require_once HOME . DS . 'configs' . DS . 'acl.php';
require_once HOME . DS . 'utils' . DS . 'bootstrap.php';

function __autoload($class)
{
    //var_dump($class);
    if (file_exists(HOME . DS . 'utils' . DS . $class . '.Class.php')) {
        require_once HOME . DS . 'utils' . DS . $class . '.Class.php';
    } else if (file_exists(HOME . DS . 'app'. DS .'models' . DS . $class . '.Class.php')) {
        require_once HOME . DS . 'app'. DS .'models' . DS . $class . '.Class.php';
    } else if (file_exists(HOME . DS .'app'. DS . 'controllers' . DS . $class . '.Class.php')) {
        require_once HOME . DS . 'app'. DS . 'controllers' . DS . $class . '.Class.php';
    }
}