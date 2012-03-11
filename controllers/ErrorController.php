<?php
////////////////////////////////////////////////////////////////////////////
// SCHEDULEMAKER - Error Controller
//
// @file	controllers/ErrorController.php
// @descrip	This controller takes care of displaying various errors.
// @author	Benjamin Russell (benrr101@csh.rit.edu)
////////////////////////////////////////////////////////////////////////////

class ErrorController extends Controller {
	
	// METHODS /////////////////////////////////////////////////////////////
	public function error404() {
		// Load header
		$header = new HeaderView("Error 404 - ScheduleMaker");
		$header->render();

		// Load an error box
		$error = new ErrorBoxView("The requested page does not exist.");
		$error->render();
		
		// Load footer
		$footer = new FooterView();
		$footer->render();
	}

	public function index() {
		echo "An undescribable error occurred";
	}
}
