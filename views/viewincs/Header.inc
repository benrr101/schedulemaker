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
		<div class='nav<?= ($this->underline == "roulette") ? " underline" : "" ?>'>
			<a href='roulette.php'>Course Roulette</a>
		</div>
		<div class='nav<?= ($this->underline == "browse") ? " underline" : "" ?>'>
			<a href='browse.php'>Browse Courses</a>
		</div>
		<div class='nav<?= ($this->underline == "generate") ? " underline" : "" ?>'>
			<a href='generate.php'>Build Schedules</a>
		</div>
	</div>
	<div id="container">
