<?php
////////////////////////////////////////////////////////////////////////////
// SCHEDULEMAKER - Quarter Drop Down List
//
// @file	views/QuarterListView.php
// @descrip	A simple to include dropdown list of quarters. Specify in the
//			constructor what the name of the list is and an array of Quarter
//			objects.
// @author	Benjamin Russell (benrr101@csh.rit.edu)
////////////////////////////////////////////////////////////////////////////

class QuarterListView extends View {
	// MEMBER VARIABLES ////////////////////////////////////////////////////
	
	// Quarter	The default quarter
	private $default;

	// string	The name of the select tag
	private $name;

	// array<Quarter>	The quarters to display in the view
	private $quarters;

	// METHODS /////////////////////////////////////////////////////////////
	public function __construct($quarters, $default, $name = "quarter") {
		// Store the information for view
		$this->default = $default; // @TODO: Find error here
		$this->name = $name;
		$this->quarters = $quarters;
	}

	public function render() {
		// Output the top of the select
		echo "<select name='{$this->name}' id='{$this->name}'>";
	
		// Iterate over the list of quarters and output each one
		foreach($this->quarters as $quarter) {
			// Verify that it's a quarter
			if(!($quarter instanceof Quarter)) {
				// @TODO: Error
				throw new Exception("YA DUN GOOF'D");
			}

			$this->load("QuarterListRow", 
				array(
					'id'   => $quarter->getId(),
					'name' => $quarter->getName(),
					'selected' => ($quarter->getId() == $this->default->getId())
					)
				);
		}

		// Output the bottom of the select
		echo "</select>";
	}
}
