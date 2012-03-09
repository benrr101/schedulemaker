<?php
////////////////////////////////////////////////////////////////////////////
// SCHEDULEMAKER - Index Controller
//
// @file	controllers/IndexController.php
// @descrip	This file defines the IndexController class. It will output the
//			links to the other controllers as well as the header and the
//			footer. This controller will also handle the status page.
// @author	Benjamin Russell (benrr101@csh.rit.edu)
////////////////////////////////////////////////////////////////////////////

class IndexController extends Controller {
	// MEMBER VARIABLES ////////////////////////////////////////////////////

	// METHODS /////////////////////////////////////////////////////////////
	/**
	 * Generates the index page for the site.
	 */
	public function index() {
		// Load the header view
		$header = new HeaderView("ScheduleMaker");
		$header->render();

		// Load the index view
		$index = new IndexView();
		$index->render();

		// Load the footer view
		$footer = new FooterView();
		$footer->render();
	}

	/**
	 * Generates the status page of the latest scrapes
	 */
	public function status() {
		// Load the header view

		// Load the footer view
	}
}
