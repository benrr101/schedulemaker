<?php
////////////////////////////////////////////////////////////////////////////
// SCHEDULEMAKER - Browse Quarter Select View
//
// @file	views/BrowseQuarterSelectView.php
// @descrip	This is the little block that goes above all the departments
// @author	Benjamin Russell (benrr101@csh.rit.edu)
////////////////////////////////////////////////////////////////////////////

class BrowseQuarterSelectView extends View {

	// MEMBER VARIABLE /////////////////////////////////////////////////////

	// array<Quarter>	A list of all the quarters to display
	private $quarters;

	// Quarter	The current quarter
	private $curQuarter;

	// METHODS /////////////////////////////////////////////////////////////
	public function __construct($quarters, $curQuarter) {
		// Store the data
		$this->quarters   = $quarters;
		$this->curQuarter = $curQuarter;
	}

	public function render() {
		// Draw the header and title
		echo "<h1>Browse Courses &gt; <span id='quarterHeader'>{$this->curQuarter->getName()}</span></h1>";
		echo "<div id='browseQuarter' class='subContainer'>";
		echo "<script type='text/javascript' src='{$this->jsURL('browse.js')}'></script>";
		echo "Select a Different Quarter: ";
		
		// Load the quarter list
		$quarters = new QuarterListView($this->quarters, $this->curQuarter);
		$quarters->render();

		// Close up the div
		echo "</div>";
	}
}
