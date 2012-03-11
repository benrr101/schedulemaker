<?php
////////////////////////////////////////////////////////////////////////////
// SCHEDULEMAKER - Error Box View
//
// @file	views/ErrorBoxView.php
// @descrip	This view provides a handy dandy box for printing whole page errors
// @author	Benjamin Russell (benrr101@csh.rit.edu)
////////////////////////////////////////////////////////////////////////////

class ErrorBoxView extends View {
	// MEMBER VARIABLES ////////////////////////////////////////////////////

	// string	The error message to print out
	protected $error;

	// METHODS /////////////////////////////////////////////////////////////

	public function __construct($errorMsg) {
		$this->error = $errorMsg;
	}

	public function render() {
		$this->load("ErrorBox");
	}
}
?>
