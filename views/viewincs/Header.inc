<!DOCTYPE html>
<html>
	<head>
		<title><?= $this->title ?></title>
		<link href='<?= $this->baseURL ?>inc/global.css' rel='stylesheet' type='text/css'>
		<script type='text/javascript' stc='<?= $this->baseURL ?>js/jquery.js'></script>
	</head>
<body>
	<div id='oldBadge'>
		Report Issues: <a href='http://github.com/benrr101/schedulemaker'>Github</a><br />
		<a href='http://oldschedule.csh.rit.edu/'>Old Schedule Maker</a>
	</div>
	<div id='superContainer'>
	<div id='header'>
		<div class='logo'><a href='<?= $this->pageURL() ?>'>ScheduleMaker</a></div>
		<div class='nav<?= ($this->underline == "roulette") ? " underline" : "" ?>'>
			<a href='<?= $this->pageURL("roulette") ?>'>Course Roulette</a>
		</div>
		<div class='nav<?= ($this->underline == "browse") ? " underline" : "" ?>'>
			<a href='<?= $this->pageURL("browse") ?>'>Browse Courses</a>
		</div>
		<div class='nav<?= ($this->underline == "generate") ? " underline" : "" ?>'>
			<a href='<?= $this->pageURL("generate") ?>'>Build Schedules</a>
		</div>
	</div>
	<div id="container">
