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
	?>
	<div id="mainMenu">
		<div class='navItem'>
			<a href='generate.php'><img src='img/calendar.png' alt='Make a Schedule'></a>
			<div><a href='generate.php'>Make a Schedule</a></div>
		</div>
		<div class='navItem'>
			<a href='browse.php'><img src='img/browse.png' alt='Browse Courses'></a>
	
			<div><a href='browse.php'>Browse Courses</a></div>
		</div>
		<div class='navItem'>
			<a href='roulette.php'><img src='img/roulette.png' alt='Course Roulette'></a>
			<div><a href='roulette.php'>Course Roulette</a></div>
		</div>
	</div>
	<?
	}
}
