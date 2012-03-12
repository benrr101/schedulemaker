<?php
////////////////////////////////////////////////////////////////////////////
// SCHEDULEMAKER - School Object
//
// @file    inc/School.php
// @descrip This class represents a school. Technocally part of the model, but
//          has no connections to the database.
// @author  Benjamin Russell (benrr101@csh.rit.edu)
////////////////////////////////////////////////////////////////////////////

class School {
    // MEMBER VARIABLES ////////////////////////////////////////////////////

    // int  The id of the school
    private $id;

    // string   The name of the school
    private $name;

    // CONSTRUCTOR /////////////////////////////////////////////////////////
    public function __construct($id, $name) {
        $this->id = $id;
        $this->name = $name;
    }

    // GETTERS /////////////////////////////////////////////////////////////
    public function getId()   { return $this->id; }
    public function getName() { return $this->name; }

	public function jsonEncode() {
		foreach($this as $key=>$value) {
			$json->$key = $value;
		}
		return json_encode($json);
	}
}
