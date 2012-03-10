<?php
////////////////////////////////////////////////////////////////////////////
// SCHEDULEMAKER - Index View
// 
// @file	views/IndexView.php
// @descrip	This file defines the IndexView class that displays the huge icons
//			that point the user to the various pages that they would want
//			to access
// @author	Benjamin Russell (benrr101@csh.rit.edu)
////////////////////////////////////////////////////////////////////////////

class IndexView extends View {
	
	// METHODS /////////////////////////////////////////////////////////////
	/**
	 * Renders the index view by outputting the code necessary for the page
	 */
	public function render() {
		$this->load("Index");
	}
}
