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
		$model = new BrowseModel();
	
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

	// AJAX HANDLERS //////////////////////////////////////////////////////
	public function getDepartments() {
		// Figure out which school's departments to get
		$urlSplit = explode('/', $this->getURI());
		if(empty($urlSplit[2])) {
			// Include an error View
			// @TODO: error
		}
		$school = $urlSplit[2];

		// Create a model that will load up the departments in the school
		$model = new BrowseModel();
		$departments = $model->getDepartments($school);
		if(!count($departments)) {
			// @TODO: Error view
		}

		// Create a view for the departments to return them
		$view = new SetAjaxView($departments);
		$view->render();
	}
}
