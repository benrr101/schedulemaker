<?php
////////////////////////////////////////////////////////////////////////////
// SCHEDULEMAKER - View Super Class
//
// @file	views/View.php
// @descrip	This file defines the class that all views will inherit from.
//			The only requirement is the implementation of a render method. Any
//			child class is welcome to take in more information via the
//			constructor to create a more pertinent rendering experience.
// @author	Benjamin Russell (benrr101@csh.rit.edu)
////////////////////////////////////////////////////////////////////////////

abstract class View {
	// MEMBER VARIABLES ////////////////////////////////////////////////////

	// string	The base url of schedulemaker as determined from the config
	protected $baseURL;

	// Config	Instance of the config class
	private $config;

	// METHODS /////////////////////////////////////////////////////////////
	public function __construct() {
		// Populate the config var with an instance of the Config class
		$this->config = Config::getInstance();
		$this->baseURL = $this->config->getConfigValue("http_root_address");
	}

	abstract public function render();

	/**
	 * Builds a URL to the desired image file.
	 * @param	string	$imgFile	The image file to load
	 * @return	string	A url to the image file
	 */
	protected function imgURL($imgFile) {
		// Build the result url
		return $this->baseURL . 'img/' . $imgFile;
	}

	/**
	 * Builds a URL to the desired javascript file
	 * @param	string	$jsFile	The javascript file to load
	 * @return	string	A url to the javascript file
	 */
	protected function jsURL($jsFile) {
		// Build the result url
		return $this->baseURL . 'js/' . $jsFile;
	}
	
	/**
	 * Loads the requested include file from the viewincs folder
	 * @param	string	$inc	The name of the file to include
	 * @param	array	$params	An associative array of parameters to
	 * 			the loaded inc file
	 */
	protected function load($inc, $params = NULL) {
		require "viewincs/{$inc}.inc";
		//@TODO: Error conditions
	}

	/**
	 * Builds a URL to the specified controller/model/query
	 * @param	string	$controller	The controller to load
	 * @param	string	$method		The method to take for the controller
	 * @param	string	$query		The query to pass to the method
	 * @return	string	A full URL to the requested controller/model/query
	 */
	protected function pageURL($controller = NULL, $method = NULL, $query = NULL) {
		$url = $this->baseURL;

		// Add the controller, model, and query
		$url .= ($controller) ? $controller : NULL;
		$url .= ($method) ? $model : NULL;
		$url .= ($query) ? $query : NULL;

		return $url;
	}
}
