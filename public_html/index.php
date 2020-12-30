<?php 
define("PROJECTPATH", dirname(__DIR__));
define("APPPATH", PROJECTPATH . '/app');
define("DEBUG",true);
require "../vendor/autoload.php";
use PHPRouter\RouteCollection;
use PHPRouter\Router;
use PHPRouter\Route;
use PHPRouter\Config;
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Methods:*');
header('Access-Control-Allow-Headers:*');
$config = Config::loadFromFile(PROJECTPATH.'/Config/routes.yaml');
$router = Router::parseConfig($config);
//$router = Router::parseRafaFile($config);
if (!session_id()) @session_start();
ActiveRecord\Config::initialize(function($cfg)
{
	include('../Config/web.php');
	$cfg->set_model_directory(PROJECTPATH.'/App/Models');
	$cfg->set_connections(array(
	'development' => 'mysql://'.$database['user'].':'.$database['password'].'@'.$database['host'].'/'.$database['name'].';charset=utf8'));
});

if(DEBUG==false){
	try{
		
		$router->matchCurrentRequest();
	}
	catch(Exception $e){

		die($e->getMessage());
	}
}
else{
	$whoops = new \Whoops\Run;
	$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
	$whoops->register();

	$router->matchCurrentRequest();
}


