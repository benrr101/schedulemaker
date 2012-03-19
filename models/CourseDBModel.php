<?php
////////////////////////////////////////////////////////////////////////////
// SCHEDULEMAKER - CourseDB Model
//
// @file	models/BrowseModel.php
// @descrip	This model provides an abstraction to the database for retrieving
//			schools, departments, courses, and sections.
// @author	Benjamin Russell (benrr101@csh.rit.edu)
////////////////////////////////////////////////////////////////////////////

class CourseDBModel extends Model {
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

	public function currentQuarter() {
		// Different quarters based on what month it is
		switch(date('n')) {
			case 2:
			case 3:
				$quarter = date("Y")-1 . '3'; // Point them to the spring
				break;
			case 4:
			case 5:
			case 6:
			case 7:
			case 8:
			case 9:
				$quarter = date("Y") . '1'; // Point them to the fall
				break;
			case 10:
			case 11:
			case 12:
			case 1:
				$quarter = date("Y") . '2'; // Point them to the summer
				break;
		}

		// Now lookup that quarter
		return $this->getQuarter($quarter);
	}

	public function getQuarter($quarter = 'all') {
		if($quarter == 'all') {
			// Build a query that will lookup the quarters
			$query = "SELECT quarter AS id, start, end, breakstart, breakend FROM quarters ORDER BY quarter";
			$result = $this->dbConn->query($query);
			if(!$result) {
				//@TODO: Error
			}
	
			// For each row, create a quarter object
			$quarters = array();
			foreach($result as $row) {
				$quarters[] = new Quarter(
					$row['id'], 
					$row['start'],
					$row['end'],
					$row['breakstart'],
					$row['breakend']
					);
			}
			
			return $quarters;
		} else {
			// Build a query to select the only quarter
			$query = "SELECT quarter AS id, start, end, breakstart, breakend FROM quarters WHERE quarter={$quarter}";
			$result = $this->dbConn->query($query);
			if(!$result || count($result) != 1) {
				// @TODO: Error
			}
			
			// Build and return the quarter
			$result = $result[0];
			return new Quarter(
				$result['id'],
				$result['start'],
				$result['end'],
				$result['breakstart'],
				$result['breakend']
				);
		}
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

	public function getCourses($quarter, $department, $course) {
		// Build a query for the all the courses that match the search
		$query = "SELECT id, department, course, credits, quarter, title, description FROM courses";
		$query .= " WHERE quarter='{$this->dbConn->escape($quarter)}'";
		$query .= " AND department='{$this->dbConn->escape($department)}'";
		$query .= " ORDER BY course";
		// Conditionally add the course number
		if($course != "all") {
			$query .= " AND course='{$this->dbConn->escape($course)}'";
		}
		$results = $this->dbConn->query($query);
		if(!$results) {
			// @TODO: Error database
			die($this->dbConn->getError());
		}

		// Iterate over the results and create course objects
		$courses = array();
		foreach($results as $row) {
			$courses[] = new Course(
				$row['quarter'],
				$row['department'],
				$row['course'],
				$row['title'],
				$row['description'],
				$row['credits'],
				$row['title']
				);
		}

		return $courses;
	}

	public function getSections($quarter, $department, $course, $section) {
		// Build a query for all the sections that match the search
		$query = "SELECT c.department, c.course, c.credits, c.quarter, c.title AS ctitle, c.description,";
		$query .= " s.id, s.section, s.title AS stitle, s.type, s.status, s.instructor, s.maxenroll, s.curenroll";
		$query .= " FROM sections AS s JOIN courses AS c ON s.course = c.id";
		$query .= " WHERE c.quarter='{$this->dbConn->escape($quarter)}'";
		$query .= " AND c.department='{$this->dbConn->escape($department)}'";
		$query .= " AND c.course='{$this->dbConn->escape($course)}'";
		if($section != "all") {
			$query .= " AND s.section='{$this->dbConn->escape($section)}'";
		}
		$query .= " ORDER BY section";

		$results = $this->dbConn->query($query);
		if(!$results) {
			// @TODO: Error database
			die($this->dbConn->getError());
		}

		// Iterate over the results and create course objects
		$courses = array();
		foreach($results as $row) {
			$course = new Course(
				$row['quarter'],
				$row['department'],
				$row['course'],
				(!empty($row['stitle'])) ? $row['stitle'] : $row['ctitle'],
				NULL,
				$row['credits'],
				$row['section'],
				$row['instructor'],
				$row['type'],
				$row['status'],
				$row['maxenroll'],
				$row['curenroll']
				);

			// Query for the times that the section meets
			$tQuery = "SELECT day, start, end, building, room FROM times";
			$tQuery .= " WHERE section={$this->dbConn->escape($row['id'])}";
			$tQuery .= " ORDER BY day, start";
			$tResult = $this->dbConn->query($tQuery);
			
			// Error check
			if(!$results) {
				// @TODO: Error database
				die($this->dbConn->getError());
			}

			// Iterate over the times and create time objects
			foreach($tResult as $tRow) {
				$course->addTime(new Time(
					$tRow['day'],
					$tRow['start'],
					$tRow['end'],
					$tRow['building'],
					$tRow['room']
					));
			}

			// Add the course to the list
			$courses[] = $course;
		}

		return $courses;
	}
} 
