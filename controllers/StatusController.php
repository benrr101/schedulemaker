<?php
////////////////////////////////////////////////////////////////////////////
// SCHEDULEMAKER - Status Controller
//
// @file	controllers/StatusController.php
// @descrip	This file defines the StatusController class. Handle requests
//			for the status of the scraper and other statuses to be added later.
// @author	Benjamin Russell (benrr101@csh.rit.edu)
////////////////////////////////////////////////////////////////////////////

class StatusController extends Controller {
	// MEMBER VARIABLES ////////////////////////////////////////////////////

	// METHODS /////////////////////////////////////////////////////////////
	/**
	 * Generates the scraper status page for the site.
	 */
	public function index() {
		// Load the header view
		$header = new HeaderView("ScheduleMaker");
		$header->render();

		// Load the status model class
		$model = new StatusModel();
	
		// Load the view of the scraper status
		$scrapeStatus = new ScraperStatusView($model);
		$scrapeStatus->render();

		// Load the footer view
		$footer = new FooterView();
		$footer->render();
	}
}
