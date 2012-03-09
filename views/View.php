<?php
////////////////////////////////////////////////////////////////////////////
// SCHEDULEMAKER - View Super Class
//
// @file	views/View.php
// @descrip	This file defines the class that all views will inherit from.
//			The only requirement is the implementation of a render method. Any
//			child class is welcome to take in more information via the
//			constructor to create a more pertinent rendering experience.
// @author	Benjamin Russell (benrr101@csh.rit.edu)
////////////////////////////////////////////////////////////////////////////

abstract class View {
	// MEMBER VARIABLES ////////////////////////////////////////////////////

	// METHODS /////////////////////////////////////////////////////////////
	abstract public function render();
}
