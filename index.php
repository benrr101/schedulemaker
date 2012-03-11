<?php
////////////////////////////////////////////////////////////////////////////
// SCHEDULE MAKER
//
// @author	Ben Russell (benrr101@csh.rit.edu)
//
// @file	index.php
// @descrip	Index page for schedule maker. It does the initial processing on
//			the URI, loads up the controller that was requested, and calls the
//			method from the controller that was specified. If the controller
//			doesn't exist, or the method doesn't exist. An error is raised.
////////////////////////////////////////////////////////////////////////////

// If the link is to ?s=yadayada Redirect to the schedule page
if(isset($_GET['s'])) {
	require_once("./inc/config.php");
	header("Location: {$HTTPROOTADDRESS}schedule.php?mode=old&id={$_GET['s']}");
	die();
}

// AUTOLOADING /////////////////////////////////////////////////////////////
function __autoload($class_name) {
	// What type of class is it?
	if(strstr($class_name, "View") == "View" && file_exists("views/{$class_name}.php")) {
		// Require a view
		require_once("views/{$class_name}.php");
	} elseif(strstr($class_name, "Controller") == "Controller" && file_exists("controllers/{$class_name}.php")) {
		// Require a controller
		require_once("controllers/{$class_name}.php");
	} elseif(strstr($class_name, "Model") == "Model" && file_exists("models/{$class_name}.php")) {
		// Require a model
		require_once("models/{$class_name}.php");
	} elseif(file_exists("inc/{$class_name}.php")) {
		// Requiring a library class
		require_once("inc/{$class_name}.php");
	} else {
		throw new Exception("File does not exist: {$class_name}");
	}

	// @TODO: Check to see if the class exists
}

// URI PROCESSING //////////////////////////////////////////////////////////
// Grab the URL
$config   = Config::getInstance();
$url      = $_SERVER['REQUEST_URI'];
$url      = str_replace($config->getConfigValue("subdirectory"), "", $url);
$urlSplit = explode('/', $url);
if(empty($url)) {
	// We weren't provided with a controller to load, so load the index page
	$controller = "Index";
} else {
	// We were provided with a controller along with other stuff
	$controller = ucfirst($urlSplit[0]);
}

// Load up the requested controller
$controller .= "Controller";
try {
	$controller = new $controller($url);
} catch(Exception $e) {
	$controller = new ErrorController($url);
	$urlSplit[1] = "error404";
}

// Was there a method provided?
if(!empty($urlSplit[1])) {
	// There was method provided! Does it exist?
	$method = $urlSplit['1'];
	if(method_exists($controller, $method)) {
		// Method exists, call it!
		$controller->$method();
	} else {
		// @TODO: Error conditions
	}
} else {
	// We're loading the default method (which is guaranteed to exist)
	$controller->index();
}
?>
