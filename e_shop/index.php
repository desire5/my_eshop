<?php
//use e_shop\components;
// front controller
//echo "This is controller from e_shop". "<br><br>";

//ini_set('display_errors');
error_reporting(E_ALL);

session_start();

//to html
define('ROOT', dirname(__FILE__));

require_once(ROOT.'/components/Autoload.php');

//require_once(ROOT.'/components/Router.php');
////CONNECT DATABASE
//require_once(ROOT.'/components/DB.php');





//ROUTER

(new Router())->run();
?>