<?php
////////////////////////////////////////////////////////////////////////////
// SCHEDULEMAKER - Browse Controller
// 
// @file	controllers/BrowseController.php
// @descrip	This controller handles interactions with the browse page as well
//			as retrieving data straight up from the database. This includes
//			handling all the AJAX calls that the page will undoubtedly create.
// @author	Benjamin Russell (benrr101@csh.rit.edu)
////////////////////////////////////////////////////////////////////////////

class BrowseController extends Controller {
	
	// METHODS /////////////////////////////////////////////////////////////
	public function index() {
		// Load the header
		$header = new HeaderView("Browse Courses", "browse");
		$header->render();

		// Create a new browse model
		$model = new CourseDBModel();

		// Show a list of the quarters
		$quarters = $model->getQuarter();
		$quarterDiv = new BrowseQuarterSelectView($quarters, $model->currentQuarter());
		$quarterDiv->render();
	
		// Grab all the schools from the model
		$schools = $model->getSchools();
		foreach($schools as $school) {
			// Create a view for the school
			$schoolv = new BrowseObjectView($school);
			$schoolv->render();
		}
		
		// Load the footer
		$footer = new FooterView();
		$footer->render();		
	}
}
