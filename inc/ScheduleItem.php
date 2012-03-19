<?php
////////////////////////////////////////////////////////////////////////////
// SCHEDULEMAKER - ScheduleItem
//
// @file	inc/ScheduleItem.php
// @descrip	This class represents any object that can be added to a schedule.
//			Basically this means it posesses a time or set of times. It also
//			inherits from SerializableObject that means it can be
//			converted to JSON.
// @author	Benjamin Russell (benrr101@csh.rit.edu)
////////////////////////////////////////////////////////////////////////////

abstract class ScheduleItem extends SerializableObject {
	// MEMBER VARIABLES ////////////////////////////////////////////////////
	
	// array<Time>	The times that the class meets
	protected	$times;

	// METHODS /////////////////////////////////////////////////////////////

	// GETTERS /////////////////////////////////////////////////////////////
	protected function getTimes() { return $this->times; }

	// SETTERS /////////////////////////////////////////////////////////////
	public function addTime($obj) {
		// If it's not a time object, throw exception
		if(!($obj instanceof Time)) {
			throw new Exception("Cannot add non-Time object to a ScheduleItem's time slot");
		}

		$this->times[] = $obj;
	}
	
}
