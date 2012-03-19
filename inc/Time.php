<?php
////////////////////////////////////////////////////////////////////////////
// SCHEDULEMAKER - Time
// 
// @file	inc/Time.php
// @descrip	This class represents a time that a course can meet
// @author	Benjamin Russell (benrr101@csh.rit.edu)
////////////////////////////////////////////////////////////////////////////

class Time extends SerializableObject {
	// MEMBER VARIABLES ////////////////////////////////////////////////////
	public $day;
	public $dayString;
	public $start;
	public $startString;
	public $end;
	public $endString;
	public $building;
	public $room;

	// STATIC METHODS //////////////////////////////////////////////////////

	public static function translateDay($day) {
		// Switch case
		switch($day) {
		case 0:
			return "Sun";
		case 1:
			return "Mon";
		case 2:
			return "Tue";
		case 3:
			return "Wed";
		case 4:
			return "Thur";
		case 5:
			return "Fri";
		case 6:
			return "Sat";
		}
	}

	public static function translateTime($time) {
		// Get the am/pm
		$twelve = ($time >= 720 && $time < 1440) ? " pm" : " am";

		// Subtract off 12 hours if it's after 1pm
		$time -= ($time >= 780) ? 720 : 0;

		// Add 12 hours if it's before 1am
		$time += ($time < 60) ? 720 : 0;

		// Figure out the hour/minute and make it a string
		$hr = floor($time / 60);
		$mn = str_pad($time % 60, 2, "0");
		return "{$hr}:{$mn}{$twelve}";
	}

	// CONSTRUCTOR /////////////////////////////////////////////////////////
	public function __construct($day, $start, $end, $building=NULL, $room=NULL) {
		// Store the data
		$this->day      = $day;
		$this->start    = $start;
		$this->end      = $end;
		$this->building = $building;
		$this->room     = $room;

		// Convert to strings
		$this->startString = self::translateTime($start);
		$this->endString   = self::translateTime($end);
		$this->dayString   = self::translateDay($day);
	}

	// GETTERS /////////////////////////////////////////////////////////////
	public function getDay() { return $this->day; }
	public function getStart() { return $this->start; }
	public function getEnd() { return $this->end; }
	public function getBuilding() { return $this->building; }
	public function getRoom() { return $this->room; }
	
}
