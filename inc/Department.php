<?php
////////////////////////////////////////////////////////////////////////////
// SCHEDULEMAKER - Department Object
//
// @file	inc/Department.php
// @descrip	This class represents a department object. It basically only has
//			a id and a title... much like a school... But we can also derive
//			the school that it is part of.
// @author	Benjamin Russell (benrr101@csh.rit.edu)
////////////////////////////////////////////////////////////////////////////

class Department extends SerializableObject {
	// MEMBER VARIABLES ////////////////////////////////////////////////////
	
	// int	The id of the department (also the department number)
	protected $id;

	// string	The name of the department
	protected $name;

	// CONSTRUCTOR /////////////////////////////////////////////////////////
	public function __construct($id, $name) {
		// Store the data we received
		$this->id = $id;
		$this->name = $name;
	}

	// GETTERS /////////////////////////////////////////////////////////////
	public function getId()     { return $this->id; }
	public function getName()   { return $this->name;}
	public function getSchool() { return substr($this->id, 0, 2); }
}
