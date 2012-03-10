<?php
////////////////////////////////////////////////////////////////////////////
// SCHEDULEMAKER - MySQL Connection Class
//
// @file	inc/DatabaseConnection.php
// @descrip	This file defines the database connection class. It wraps a mysqli
//			instance and allows basic operations to be performed on the
//			database. The class is implemented in singleton.
// @author	Benjamin Russell (benrr101@csh.rit.edu)
////////////////////////////////////////////////////////////////////////////

class DatabaseConnection {
	// MEMBER VARIABLES ////////////////////////////////////////////////////

	// Config	An instance of the config class
	private $config;

	// mysqli	A connection to the database.
	private $dbConn;

	// DatabaseConnection	The singleton instance of this class
	private static $instance;

	// mysqli_result	The last result to be created
	private $result;

	// METHODS /////////////////////////////////////////////////////////////

	/**
	 * Creates a new instance of the database connection. It is private because
	 * we only want at max one instance in existance.
	 */
	private function __construct() {
		// Get an instance of the config class so we can get the database
		// credentials
		$this->config = Config::getInstance();
		$dbHost = $this->config->getConfigValue("database_server");
		$dbUser = $this->config->getConfigValue("database_user");
		$dbPass = $this->config->getConfigValue("database_password");
		$dbName = $this->config->getConfigValue("database_name");

		// Open a new connection to the database
		$this->dbConn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

		// If there was an error, we should let someone know
		if($this->dbConn->connect_error) {
			// @TODO: Error.
		}
	}

	/**
	 * Does nothing but is private so we can't duplicate the class
	 */
	private function __clone() { }

	/**
	 * Returns an escaped version of the string.
	 * @param	string	$str	The string to escape
	 * @return	string	An escaped version of the string
	 */
	public function escape($str) {
		// Escape and return
		return $this->dbConn->real_escape_string($str);
	}

	/**
	 * Return the last error that occurred from the database
	 * @return	string	The last database error
	 */
	public function getError() {
		return $this->dbConn->error;
	}

	/**
	 * Creates a new instance of this class if one doesn't exist. If it does
	 * exist, then that instance is returned.
	 * @return	DatabaseConnection	The internal instance of the class
	 */
	public static function getInstance() {
		// If an instance exists, then return it, otherwise create one
		if(empty(self::$instance)) {
			self::$instance = new DatabaseConnection();
		}

		// Return the instance
		return self::$instance;
	}

	/**
	 * Performs the specified query on the database. Returns the set of rows on
	 * successful SELECT queries, bool on other queries.
	 * @param	string	$query	The query to perform on the database.
	 * @return	mixed	Associative array of rows on successful SELECT
	 *					Boolean, otherwise
	 */
	public function query($query) {
		// Perform a query on the database
		$this->result = $this->dbConn->query($query);
		
		// If the result was not a mysqli result then return it
		if(!($this->result instanceof mysqli_result)) {
			return $this->result;
		}
	
		// The result was a mysqli_result, convert it to an array
		$rows = array();
		while($row = $this->result->fetch_assoc()) {
			$rows[] = $row;
		}
		
		// All rows collected, return to the caller
		return $rows;
	}
}
