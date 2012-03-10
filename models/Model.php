<?php
////////////////////////////////////////////////////////////////////////////
// SCHEDULEMAKER - Model superclass
//
// @file	models/Model.php
// @descrip	This file defines the model super class from which all models
//			inherit. Basically all this provides is a database instance that
//			can be queried.
// @author	Benjamin Russell (benrr101@csh.rit.edu)
////////////////////////////////////////////////////////////////////////////

abstract class Model {
	// MEMBER VARIABLES ////////////////////////////////////////////////////

	// DatabaseConnection 	the instance of the database
	protected $dbConn;

	// METHODS /////////////////////////////////////////////////////////////
	public function __construct() {
		// Get an instance of the database connection
		$this->dbConn = DatabaseConnection::getInstance();	
	}
}
