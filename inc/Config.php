<?php
////////////////////////////////////////////////////////////////////////////
// SCHEDULEMAKER - Config Class
//
// @file	inc/Config.php
// @descrip	This file defines the Config class. This is a singleton class that
//			provides functionality for reading config variables from a config
//			XML file. There are also handy functions for handling simple cases
//			like what the current quarter is.
// @author	Benjamin Russell (benrr101@csh.rit.edu)
////////////////////////////////////////////////////////////////////////////

class Config {
	// MEMBER VARIABLES ////////////////////////////////////////////////////

	// Array<string>	Associative array of attributes and their values
	private $attributes;

	// Config	The instance of the configuration class
	private static $instance;

	// int	The current quarter as defined by the config file
	private $currentQuarter;

	// METHODS /////////////////////////////////////////////////////////////

	/**
	 * Constructs a new instance of the config class. The attributes array will
	 * be populated with key=>value pairs derived from the config.xml file. The
	 * config file will also be parsed to determine the current quarter.
	 */
	private function __construct() {
		// If the config file does not exist, then error out
		if(!file_exists("inc/config.xml")) {
			// @TODO: Error out
		}

		// Open up the config file and read it into a dom document
		$domDoc = new DOMDocument();
		if(!$domDoc->load("inc/config.xml")) {
			// @TODO: Error out
		}

		// Grab the root node for attributes and grab the children of it
		$attrNode = $domDoc->getElementsByTagName("attributes");
		$attrNode = $attrNode->item(0);

		// Iterate over the children nodes and store the values
		foreach($attrNode->childNodes as $node) {
			// Skip anything that isn't an attribute node
			if($node->nodeName != "attribute") {
				continue;
			}

			// Grab the attribute name and value from the node
			$nodeAttrs = $nod->attributes;
			$attrName  = $nodeAttrs->getNamedItem("name");
			$attrValue = $nodeAttrs->getNamedItem("value");

			// Create an array entry for this item
			$this->attributes[$attrName] = $attrValue;
		}
	}

	private function __clone() { }

	/**
	 * Looks up the requested attribute. Returns it if it exists
	 * @param	string	$key	The attribute to look up
	 * @return	string	The value of the requested attribute
	 */
	public function getConfigValue($key) {
		// Return the entry in the array
		if(!array_key_exists($key, $this->attributes)) {
			// Array key doesn't exist, so error.
			// @TODO: Error out
		}

		// Otherwise, return it
		return $this->attributes[$key];
	}

	/**
	 * Return the only instance of this class. If it hasn't been created,
	 * then create a new instance
	 * @return	Config	The instance of the config class
	 */
	public function getInstance() {
		// If an instance does not exist, create a new one
		if(!isset(self::$instance)) {
			self::$instance = new Config();
		}

		// Return the instance
		return self::$instance;
	}
}
