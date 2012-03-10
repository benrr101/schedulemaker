<?php
////////////////////////////////////////////////////////////////////////////
// SCHEDULEMAKER - Footer View
// 
// @file	views/FooterView.php
// @descrip	This view generates the header for the site. This includes all the
//			code necessary for generating a title and CSS includes.
// @author	Benjamin Russell
////////////////////////////////////////////////////////////////////////////

class FooterView extends View {
	// METHODS /////////////////////////////////////////////////////////////

	/**
	 * Render the footer by outputting the code for the footer
	 */
	public function render() { 
		$this->load("Footer");
	}
}
