<?php
////////////////////////////////////////////////////////////////////////////
// SCHEDULEMAKER - Course
//
// @file	inc/Course.php
// @descrip	This class reprents a complete course (technically section).
// @author	Benjamin Russell (benrr101@csh.rit.edu)
////////////////////////////////////////////////////////////////////////////

class Course extends ScheduleItem {
	
	// MEMBER VARIABLES ////////////////////////////////////////////////////

	// bool	True if the object is a section, False otherwise
	protected $isSection;

	// COURSE SPECIFIC //
	protected $quarter;
	protected $department;
	protected $course;
	protected $title;
	protected $description;
	protected $credits;

	// SECTION SPECIFIC //
	protected $section;
	protected $instructor;
	protected $type;
	protected $status;
	protected $maxEnroll;
	protected $curEnroll;

	// CONSTRUCTOR /////////////////////////////////////////////////////////
	public function __construct(
		$quarter, $department, $course, $title, $description, $credits,
		$section=NULL, $instructor=NULL, $type=NULL, $status=NULL, $maxEnroll=NULL, $curEnroll=NULL
	) {
		// Store all the data
		$this->quarter     = $quarter;
		$this->department  = $department;
		$this->course      = $course;
		$this->section     = $section;
		$this->title       = $title;
		$this->description = $description;
		$this->credits     = $credits;
		$this->instructor  = $instructor;
		$this->type        = $type;
		$this->status      = $status;
		$this->maxEnroll   = $maxEnroll;
		$this->curEnroll   = $curEnroll;

		// Is this a course or a section
		$this->isSection = ($instructor && $type && $status && $maxEnroll && $curEnroll);
	}

	// METHODS /////////////////////////////////////////////////////////////
	public function isSection() { return $isSection; }
	public function getQuarter() { return $quarter; }
	public function getDepartment() { $department; }
	public function getCourses() { $course; }
	public function getSection() { $section; }
	public function getInstructor() { $instructor; }
	public function getType() { $type; }
	public function getStatus() { $status; }
	public function getMaxEnroll() { $maxEnroll; }
	public function getCurEnroll() { $curEnroll; }
}
