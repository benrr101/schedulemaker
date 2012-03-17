<?php
////////////////////////////////////////////////////////////////////////////
// SCHEDULEMAKER - Quarter
//
// @file	inc/Quarter.php
// @descrip	This class represents a Quarter with it's id, name, start/end dates
//			and break start/end dates.
// @author	Benjamin Russell (benrr101@csh.rit.edu)
////////////////////////////////////////////////////////////////////////////

class Quarter {
	// MEMBER VARIABLES ////////////////////////////////////////////////////

	// int	UNIX Timestamp of when the break ends (or 0 for doesn't exist)
	private $breakEnd;

	// int	UNIX timestamp of when the break starts (or 0 for doesn't exist)
	private $breakStart;

	// int	UNIX timestamp of when the quarter ends
	private $end;

	// int	ID of the quarter (\d{4}[1234]) OR (\d{3}???)
	private $id;

	// int	UNIX timestamp of when the quarter starts
	private $start;

	// CONSTRUCTOR /////////////////////////////////////////////////////////
	public function __construct($id, $start = 0, $end = 0, $bStart = 0, $bEnd = 0) {
		// Store all the information
		$this->id         = $id;
		$this->start      = $start;
		$this->end        = $end;
		$this->breakStart = $bStart;
		$this->breakEnd   = $bEnd;
	}

	// GETTERS /////////////////////////////////////////////////////////////

	public function getBreakEnd()     { return $this->breakEnd; }
	public function getBreakStart()   { return $this->breakStart; }
	public function getQuarterEnd()   { return $this->end; }
	public function getID()           { return $this->id; }
	public function getQuarterStart() { return $this->start; }
	public function getName() {
		// First part of the name is the year
		$name = substr($this->id, 0, 4) . " ";

		// Name is based on the last character of the id
		switch(substr($this->id, -1)) {
			case 1:
				return $name . "Fall";
				break;
				
			case 2:
				return $name . "Winter";
				break;
	
			case 3:
				return $name . "Spring";
				break;

			case 4:
				return $name . "Summer";
				break;
		}
	}
}
