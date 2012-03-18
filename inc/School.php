<?php
////////////////////////////////////////////////////////////////////////////
// SCHEDULEMAKER - School Object
//
// @file    inc/School.php
// @descrip This class represents a school. Technocally part of the model, but
//          has no connections to the database.
// @author  Benjamin Russell (benrr101@csh.rit.edu)
////////////////////////////////////////////////////////////////////////////

class School extends SerializableObject {
    // MEMBER VARIABLES ////////////////////////////////////////////////////

    // int  The id of the school
    protected $id;

    // string   The name of the school
    protected $name;

    // CONSTRUCTOR /////////////////////////////////////////////////////////
    public function __construct($id, $name) {
        $this->id = $id;
        $this->name = $name;
    }

    // GETTERS /////////////////////////////////////////////////////////////
    public function getId()   { return $this->id; }
    public function getName() { return $this->name; }
}
