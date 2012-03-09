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
	private $title;

	// string	The page link to underline in the header. Can be NULL
	private $underline;

	// METHODS /////////////////////////////////////////////////////////////
	/**
	 * Constructs a new header view. Only requires a page title to be passed
	 * @param	string	$title	The title of the page
	 */
	public function __construct($title, $under = NULL) {
		$this->title = $title;
		$this->underline = $under;
	}

	/**
	 * Render the header by outputting the code for the header
	 */
	public function render() { 
		// Determine which page should be underlined
		$rouletteUnder = ($this->underline == "roulette") ? " underline" : "";
		$browseUnder   = ($this->underline == "browse")   ? " underline" : "";
		$generateUnder = ($this->underline == "generate") ? " underline" : "";
	?>
<!DOCTYPE html>
<html>
	<head>
		<title><?= $this->title ?></title>
		<link href='./inc/global.css' rel='stylesheet' type='text/css'>
		<script type='text/javascript' stc='./js/jquery.js'></script>
	</head>
<body>
	<div id='oldBadge'>
		Report Issues: <a href='http://github.com/benrr101/schedulemaker'>Github</a><br />
		<a href='http://oldschedule.csh.rit.edu/'>Old Schedule Maker</a>
	</div>
	<div id='superContainer'>
	<div id='header'>
		<div class='logo'><a href='index.php'>ScheduleMaker</a></div>
		<div class='nav<?= $rouletteUnder ?>'>
			<a href='roulette.php'>Course Roulette</a>
		</div>
		<div class='nav<?= $browseUnder ?>'>
			<a href='browse.php'>Browse Courses</a>
		</div>
		<div class='nav<?= $generateUnder ?>'>
			<a href='generate.php'>Build Schedules</a>
		</div>
	</div>
	<div id="container">
	<?
	}
}
