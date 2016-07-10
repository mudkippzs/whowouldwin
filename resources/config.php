<?php
/*
	Get session started
*/
session_start();
 
use PFBC\Form;
use PFBC\Element;
/*
    Quick config bootstrap header phile :)
*/
$active_db = 'local';

$config = array(
    "db" => array(
        "master" => array(
            "dbname" => "whowouldwin_master",
            "username" => "www_master",
            "password" => "go9H8r&1pLn07^c1",
            "host" => "localhost"
        ),
        "local" => array(
            "dbname" => "whowouldwin_local",
            "username" => "root",
            "password" => "",
            "host" => "localhost"
        )
    ),
    "urls" => array(
        "baseUrl" => "http://www.whowouldwin.io",
        "sandboxUrl" => "localhost",
    ),
    "paths" => array(
        "resources" => "../resources",
        "images" => array(
            "content" => $_SERVER["DOCUMENT_ROOT"] . "/imgs/content",
            "layout" => $_SERVER["DOCUMENT_ROOT"] . "/imgs/layout",
            "uploads" => $_SERVER["DOCUMENT_ROOT"] . "/imgs/uploads",
        )
    )
);
$db = array();
/**
DB SWITCH
**/
switch($active_db){
	case 'local':
		$db = array(
		'host'=>$config['db']['local']['host'],
		'dbname'=>$config['db']['local']['dbname'],
		'user'=>$config['db']['local']['username'],
		'pass'=>$config['db']['local']['password'],
		);
	break;
	case 'master':
		$db = array(
			'host'=>$config['db']['master']['host'],
			'dbname'=>$config['db']['master']['dbname'],
			'user'=>$config['db']['master']['username'],
			'pass'=>$config['db']['master']['password'],
			);
	break;
	
	default:
		$db = array(
		'host'=>$config['db']['local']['host'],
		'dbname'=>$config['db']['local']['dbname'],
		'user'=>$config['db']['local']['username'],
		'pass'=>$config['db']['local']['password'],
		);
	break;
	
}

define("DBNAME",$db["dbname"]);
define("DBUSER",$db["user"]);
define("DBPASS",$db["pass"]);
define("DBHOST",$db["host"]);
define("PAGETITLE",'Who Would Win :: You decide');

//req the database class 
/*
* tip: to select a certain db, instatiate a db class using the config array like: 
$config['db']<--change these['local'/'master']['dbname'/'username'/'password'/'host']--->);
*/
require_once  $_SERVER["DOCUMENT_ROOT"] . '/db/MysqliDb.php';
include_once  $_SERVER["DOCUMENT_ROOT"] . '/resources/functions.php'; 
include_once  $_SERVER["DOCUMENT_ROOT"] . '/resources/userService.class.php'; 
include_once $_SERVER["DOCUMENT_ROOT"] . '/resources/login_user.class.php'; 
include_once $_SERVER["DOCUMENT_ROOT"] . '/resources/password_reset.class.php'; 
include_once $_SERVER["DOCUMENT_ROOT"] . '/resources/logout_user.class.php'; 
include_once $_SERVER["DOCUMENT_ROOT"] . '/resources/register_user.class.php'; 
include_once $_SERVER["DOCUMENT_ROOT"] . '/resources/post.class.php'; 
include_once $_SERVER["DOCUMENT_ROOT"] . '/resources/postService.class.php'; 



/*
    Creating constants for heavily used paths makes things a lot easier.
*/
defined("LIBRARY_PATH")
    or define("LIBRARY_PATH", realpath(dirname(__FILE__) . '/libs'));
     
defined("RESC_PATH")
    or define("RESC_PATH", realpath(dirname(__FILE__)));
     
defined("TEMPLATES_PATH")
    or define("TEMPLATES_PATH", realpath(dirname(__FILE__) . '/templates'));
 
/*
    Error reporting.
*/
ini_set("error_reporting", "true");
error_reporting(E_ALL|E_STRCT);
include LIBRARY_PATH . "/PFBC/Form.php";


?>
