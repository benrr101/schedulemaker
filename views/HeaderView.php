<?php
////////////////////////////////////////////////////////////////////////////
// SCHEDULEMAKER - Header View
// 
// @file	views/HeaderView.php
// @descrip	This view generates the header for the site. This includes all the
//			code necessary for generating a title and CSS includes.
// @author	Benjamin Russell
////////////////////////////////////////////////////////////////////////////

class HeaderView extends View {
	// MEMBER VARIABLES ////////////////////////////////////////////////////

	// string	The title of the page
	protected $title;

	// string	The page link to underline in the header. Can be NULL
	protected $underline;

	// METHODS /////////////////////////////////////////////////////////////
	/**
	 * Constructs a new header view. Only requires a page title to be passed
	 * @param	string	$title	The title of the page
	 */
	public function __construct($title, $under = NULL) {
		parent::__construct();
		$this->title = $title;
		$this->underline = $under;
	}

	/**
	 * Render the header by outputting the code for the header
	 */
	public function render() { 
		// Determine which page should be underlined
		$this->load("Header");
	}
}
