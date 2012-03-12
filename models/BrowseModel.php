<?php
////////////////////////////////////////////////////////////////////////////
// SCHEDULEMAKER - Browse Model
//
// @file	models/BrowseModel.php
// @descrip	This model provides an abstraction to the database for retrieving
//			schools, departments, courses, and sections.
// @author	Benjamin Russell (benrr101@csh.rit.edu)
////////////////////////////////////////////////////////////////////////////

class BrowseModel extends Model {
	// MEMBER VARIABLES ////////////////////////////////////////////////////

	// METHODS /////////////////////////////////////////////////////////////
	public function getSchools() {
		// Build a query for the all the schools
		$query = "SELECT * FROM schools ORDER BY id";
		$result = $this->dbConn->query($query);
		
		// Iterate over the list of schools and generate a school object
		$schools = array();
		foreach($result as $row) {
			$schools[] = new School($row['id'], $row['title']);
		}		

		return $schools;
	}

	public function getDepartments($school) {
		// Build a query for all the schools
		$query = "SELECT title, id FROM departments WHERE school={$this->dbConn->escape($school)} ORDER BY id";
		$result = $this->dbConn->query($query);

		// Iterate over the results and create department objects
		$departments = array();
		foreach($result as $row) {
			$departments[] = new Department($row['id'], $row['title']);
		}

		return $departments;
	}
} 
