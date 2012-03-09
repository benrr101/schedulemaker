<?php
////////////////////////////////////////////////////////////////////////////
// SCHEDULEMAKER - Controller Class
//
// @file	controllers/Controller.php
// @descrip	This class is the base class for all controllers in this MVC
//			framework. The only requirement for any class to inherit from this
//			one is that it must implement an index method. The index method
//			is the method to run if no method is specified in the URL
// @author	Benjamin Russell (benrr101@csh.rit.edu)
////////////////////////////////////////////////////////////////////////////

abstract class Controller {
	// MEMBER VARIABLES ////////////////////////////////////////////////////
	private $uri;

	// METHODS /////////////////////////////////////////////////////////////
	
	/**
	 * Construct a new Controller instance.
	 * @param	string	$uri	The URI used to request the page
	 */
	public function __construct($uri) {
		$this->uri = $uri;
	}

	/**
	 * The method to be executed if no method is specified in the URI. Required
	 * to be implemented in the child class.
	 */
	abstract function index();

	// GETTERS /////////////////////////////////////////////////////////////
	// You know how these work.
	public function getURI() { return $this->uri; }
}

?>
