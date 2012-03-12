<?php
////////////////////////////////////////////////////////////////////////////
// SCHEDULEMAKER - Browse View
// 
// @file	views/BrowseObjectView.php
// @descrip	This view is used when displaying an object that can be displayed
//			on the browse page. This means: schools->departments->courses->
//			and sections. When created, a model-created object is passed to it.
//			On rendering, the type of the object is determined and used to
//			determine which view to load.
// @author	Benjamin Russell (benrr101@csh.rit.edu)
////////////////////////////////////////////////////////////////////////////

class BrowseObjectView extends View {
	// MEMBER VARIABLES ////////////////////////////////////////////////////

	// School (or child)	The object to be drawn
	private $object;

	// METHODS /////////////////////////////////////////////////////////////
	public function __construct($object) {
		// If it's not an object, throw an exception
		if(!($object instanceof School)) {
			// @TODO: Error;
		}

		$this->object = $object;
	}

	public function render() {
		// Which type of object is being rendered?
		//@TODO: Other types go first
		if($this->object instanceof School) {
			// Create an array of parameters to give to the load
			$params = array(
				"id"     => $this->object->getId(),
				"number" => $this->object->getId(),
				"name"   => $this->object->getName(),
				"sub"    => false
				);
			$this->load("BrowseObject", $params);
		}
	}
}
