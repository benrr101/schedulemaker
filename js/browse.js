////////////////////////////////////////////////////////////////////////////
// SCHEDULE BUILDER JAVASCRIPT FUNCTIONS
//
// @author	Ben Russell (benrr101@csh.rit.edu)
//
// @file	js/browse.js
// @descrip	Functions for browsing the course list in a fancy way
////////////////////////////////////////////////////////////////////////////

// Register the on clicks for the schools
$(document).ready( function() {
	// Add handlers to the 
	$("button").each(function(k, v) {
		$(v).click(function() {
			schoolOnExpand($(v));
			return false;			// Avoid following the clicks
			});
		});
	});

function courseOnCollapse(obj) {
	obj.html("+");
	
	// Get the parent and hide all it's children courses
	parent = obj.parent();
	parent.children().last().slideUp();
	obj.next().next().slideUp();

	// Reset the click function
	obj.unbind("click");
	obj.click(function() { courseOnExpand($(this)); return false; });
}

function courseOnExpand(obj) {
	// Set the clicked obj to a -
	obj.html("-");
	obj.unbind("click");
	obj.click(function() { courseOnCollapse($(this)); return false; });

	// Get the parent and the input field
	var p       = obj.parent();
	var input   = obj.next();
	var quarter = $("#quarter");

	// Expand the course description
	input.next().slideDown();
	
	// If the sections already exist, then don't do the post request
	if(p.children().last().hasClass("subDivision")) {
		p.children().last().slideDown();
		return;
	}

	// If there was an error, remove the error and redo the post request
	if(p.children().last().hasClass("error")) {
		p.children().last().remove();
	}

	// Creat a div for storing all the sections
	var box = $("<div>");
	box.addClass("subDivision");
	box.appendTo(p);

	// Parse the course number into a department and a course
	var args = input.val().match(/(\d{4})-(\d{3})/);

	// Do an ajax call for the sections of the course
	$.post("API/section/" + quarter.val() + "/" + args[1] + "/" + args[2] + "/all", {}, function(data) {
		//@DEBUG
		q = data;

		// Check for errors
		if(data.error != null && data.error != undefined) {
			box.addClass("error");
			box.html("Sorry! An error occurred!<br />" + data.msg);
			box.slideDown();
			return;
		}
		
		// No Errors!! No we need to add a div for each section
		for(i=0; i < data.length; i++) {
			var div = $("<div>");
			div.addClass("item");
			div.html("<b>" + data[i].department + "-" + data[i].course + "-" + data[i].section + "</b>"
				+ " : " + data[i].title + " with " + data[i].instructor + " ");
			
			// If the section is online, mark it as such
			if(data[i].online) {
				div.append($("<span class='online'>ONLINE</span>"));
			}

			// Add a paragraph for the current and maximum enrollment
			var descrip = $("<p>");
			descrip.html("Course Enrollment: " + data[i].curEnroll + " out of " + data[i].maxEnroll);
			descrip.appendTo(div);

			// Add a paragraph for each meeting time
			var times = $("<p>");
			for(j=0; j < data[i].times.length; j++) {
				times.html(times.html() +
					data[i].times[j].dayString + " " + data[i].times[j].startString + " - " + data[i].times[j].endString
					+ " " + data[i].times[j].building + "-" + data[i].times[j].room + "<br />");
			}
			times.appendTo(div);

			div.appendTo(box);
		}

		box.slideDown();
	});
}

function departmentOnCollapse(obj) {
	obj.html("+");
	
	// Get the parent and hide all it's children courses
	var p = obj.parent();
	p.children().last().slideUp()

	// Reset the click function
	obj.unbind("click");
	obj.click(function() { departmentOnExpand($(this)); return false; });
}

function departmentOnExpand(obj) {
	// Set the clicked obj to a -
	obj.html("-");
	obj.unbind("click");
	obj.click(function() { departmentOnCollapse($(this)); return false; });

	// Get the parent and the input field
	var p       = obj.parent();
	var input   = obj.next();
	var quarter = $("#quarter");

	// If the courses already exist, then don't do the post request
	if(p.children().last().hasClass("subDivision")) {
		p.children().last().slideDown();
		return;
	}

	// If there was an error, remove the error and redo the post request
	if(p.children().last().hasClass("error")) {
		p.children().last().remove();
	}

	// Create a div for storing all the courses
	var box = $("<div>");
	box.addClass("subDivision");
	box.appendTo(p);

	// Do an ajax call for the courses within the department
	$.post("API/course/" + quarter.val() + "/" + input.val() + "/all", {}, function(data) {
		// Check for errors
		if(data.error != null && data.error != undefined) {
			box.addClass("error");
			box.html("Sorry! An error occurred!<br />" + data.msg);
			box.slideDown();
			return;
		}

		// No errors! Now we need to add a div for each course
		for(i=0; i < data.length; i++) {
			var div = $("<div>")
			div.addClass("item");
			div.html(" " + data[i].department + "-" + data[i].course + " - " + data[i].title);

			var descrip = $("<p>")
			descrip.html(data[i].description);
			descrip.addClass("courseDescription");
			descrip.appendTo(div);
			
			var hidden = $("<input>");
			hidden.attr("type", "hidden");
			hidden.val(data[i].department + "-" + data[i].course);
			hidden.prependTo(div);

			var button = $("<button>")
			button.html("+");
			button.click(function() { courseOnExpand($(this)); return false; })
			button.prependTo(div);

			div.appendTo(box);
		}

		// Expand the Box
		box.slideDown();
	});
}

function schoolOnCollapse(obj) {
	obj.html("+");
	
	// Get the parent and hide all it's children	
	var p = obj.parent();
	p.children().last().slideUp();

	// Reset the click mechanism
	obj.unbind("click");
	obj.click(function() {schoolOnExpand($(this)); return false; });
}

function schoolOnExpand(obj) {
	// Set the clicked obj to a -
	obj.html("-");
	obj.unbind("click");
	obj.click(function() {schoolOnCollapse($(this)); return false;});

	// Get the parent and the input field of this school
	var p      = obj.parent();
	var input  = obj.next();

	// If the department already exists, then don't do the post resquest
	if(p.children().last().hasClass("subDivision")) {
		p.children().last().slideDown();
		return;
	}

	// If there was an error, remove the departments and redo the post request
	if(p.children().last().hasClass("error")) {
		p.children().last().remove();
	}
	
	// Create a div for storing all the departments
	var box = $("<div>");
	box.addClass("subDivision");
	box.appendTo(p);

	// Do an ajax call for the departments within this school
	$.post("API/department/" + input.val(), {}, function(data) {
		// Check for errors
		if(data.error != null && data.error != undefined) {
			box.addClass("error")
			box.html("Sorry! An error occurred!<br/>" + data.msg);
			box.slideDown();
			return;
		}

		// No errors! Now we need to add a div for each department
		for(i=0; i < data.length; i++) {
			// Div for the department
			var div = $("<div>");
			div.addClass("item");
			div.html(" " + data[i].id + " - " + data[i].name);
			
			// Hidden value for the department value
			var hidden = $("<input>");
			hidden.attr("type", "hidden");
			hidden.val(data[i].id)
			hidden.prependTo(div);
			
			// Button for expansion of the department
			var button = $("<button>");
			button.html("+")
			button.click(function() { departmentOnExpand($(this)); return false; })
			button.prependTo(div);
			
			div.appendTo(box);
		}

		// Expand the box
		box.slideDown();
	});
}
