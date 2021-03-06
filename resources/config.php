<?php
/*
	Get session started
*/
session_set_cookie_params(1800);
session_start();
 
use PFBC\Form;
use PFBC\Element;
use PFBC\View;
/*
    Quick config bootstrap header phile :)
*/
//get out db sorted
include $_SERVER["DOCUMENT_ROOT"] . '/resources/db.manifesto.php'; 

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

//use these definitions to grab DB creds anywhere in the codebase - dont change them for the life of me! also they're totally made up, I'll change them if anything gets fucky
define("DBNAME",$db["dbname"]);
define("DBUSER",$db["user"]);
define("DBPASS",$db["pass"]);
define("DBHOST",$db["host"]);
define("PAGETITLE",'Who Would Win :: You decide');

//req the database class 
/*
* tip: to select a certain db,      instatiate a db class using the config array like: 
$config['db']<--change these['local'/'master']['dbname'/'username'/'password'/'host']--->);
*/

//db is primary class - obey
require_once  $_SERVER["DOCUMENT_ROOT"] . '/db/MysqliDb.php';
//functions.php needs to be above the rest
include_once  $_SERVER["DOCUMENT_ROOT"] . '/resources/functions.php';
// service classes go here or the rest false apart, dont blame me Im just making this up as I go along
include_once  $_SERVER["DOCUMENT_ROOT"] . '/resources/userService.class.php';
include_once $_SERVER["DOCUMENT_ROOT"] . '/resources/postService.class.php'; 
include_once  $_SERVER["DOCUMENT_ROOT"] . '/resources/heroService.class.php';
include_once  $_SERVER["DOCUMENT_ROOT"] . '/resources/battleService.class.php';
  
//beautiful classes below - no ugly code please and descriptive file names please. respect my house.
include_once  $_SERVER["DOCUMENT_ROOT"] . '/resources/log.class.php'; 
include_once  $_SERVER["DOCUMENT_ROOT"] . '/resources/mail.class.php'; 
include_once $_SERVER["DOCUMENT_ROOT"] . '/resources/login_user.class.php'; 
include_once $_SERVER["DOCUMENT_ROOT"] . '/resources/password_reset.class.php'; 
include_once $_SERVER["DOCUMENT_ROOT"] . '/resources/logout_user.class.php'; 
include_once $_SERVER["DOCUMENT_ROOT"] . '/resources/register_user.class.php'; 
include_once $_SERVER["DOCUMENT_ROOT"] . '/resources/battle.class.php'; 
include_once $_SERVER["DOCUMENT_ROOT"] . '/resources/round.class.php'; 
include_once $_SERVER["DOCUMENT_ROOT"] . '/resources/power.class.php'; 
include_once $_SERVER["DOCUMENT_ROOT"] . '/resources/attack.class.php'; 
include_once $_SERVER["DOCUMENT_ROOT"] . '/resources/defend.class.php'; 
include_once $_SERVER["DOCUMENT_ROOT"] . '/resources/powerOff.class.php'; 
include_once $_SERVER["DOCUMENT_ROOT"] . '/resources/powerDef.class.php'; 
include_once $_SERVER["DOCUMENT_ROOT"] . '/resources/powerUti.class.php'; 
include_once $_SERVER["DOCUMENT_ROOT"] . '/resources/post.class.php'; 
include_once $_SERVER["DOCUMENT_ROOT"] . '/resources/hero.class.php'; 

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
