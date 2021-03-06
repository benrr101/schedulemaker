////////////////////////////////////////////////////////////////////////////
// COURSE ROULETTE JAVASCRIPT FUNCTIONS
//
// @author	Ben Russell (benrr101@csh.rit.edu)
//
// @file	js/roulette.js
// @descrip	Functions for managing displaying and manipulating the course
//			roulette page.
////////////////////////////////////////////////////////////////////////////

// GLOBAL VARIABLES ////////////////////////////////////////////////////////
var schoolCache = null;

// When the document's ready, add handlers to necessary elements
$(document).ready(function() {
    // Add handler to roulette spinner button
    $("#spinButton").click(function(e) {
        e.preventDefault();
        spinRoulette();
    });

    // Add handler to the term selector
    $("#term").change(function() { termOnChange(); });

    // Add handler to the school selector
    $("#college").change(function() { collegeOnChange(); });

    // Add handler to the any time checkbox
    $("#timesAny").change(function() { toggleTimesAny(this); });

    // Add handler to the any day checkbox
    $("#daysAny").change(function() { toggleDaysAny(this); });

    // Load the initial school list
    termOnChange();
});

/**
 * Called when the college is changed. Loads the departments for the school
 * from the browse ajax handler.
 */
function collegeOnChange() {
    // Clear out the list of departments
    var departments = $("#department");
    departments.children().remove();
    var school = $("#college").val();
    var term = $("#term").val();

    // If the school selected is 'all', then back out
    if(school == 'any') {
        $("<option value='any'>Select a College From Above</option>").appendTo(departments);
        return;
    }

    // Setup the post parameters
    var parameters = {
        action: "getDepartments",
        school: school,
        term:   term
    };

    // Get the departments
    $.post("./js/browseAjax.php", parameters, function(d) {
        // Check for errors
        if(d.error != undefined && d.error != null) {
            alert(d.msg);
            return;
        }

        // Iterate over the array we got back and add options for them
        for(var i = 0; i < d.departments.length; ++i) {
            var dept = d.departments[i];

            // Create the option
            var opt = $("<option>");
            opt.val(dept.id);
            if(term > 20130) {
                opt.html(dept.code + " - " + dept.title);
            } else {
                opt.html(dept.number + " - " + dept.title);
            }

            opt.appendTo(departments);
        }
    });

    // Prepend a all option and select it
    $("<option value='any' selected='selected'>Any Department</option>").prependTo(departments);
}

/**
 * Called when the term field changes. Reloads the list of schools.
 */
function termOnChange() {
    // Do we have a list of schools cached?
    if(schoolCache == null) {
        // Schools haven't been cached. Grab them then call back here
        $.post("./js/browseAjax.php", {action: "getSchools"}, function(d) {
            // Error check
            if(d.error != undefined && data.error != null) {
                alert(d.msg);
                return;
            }

            // Store the schools and call the function again.
            schoolCache = d;
            termOnChange();
        });
        return;
    }

    // Clear out the list of schools
    var schools = $("#college");
    schools.children().remove();

    // Clear out the list of departments
    var departments = $("#department");
    departments.children().remove();
    $("<option value='any'>Select a College From Above</option>").appendTo(departments);

    // Sort the list of schools based on code or number
    var term = $("#term").val();
    if(term > 20130) {
        // Sort by code
        sortSchools("title");
    } else {
        // Sort by number
        sortSchools("number");
    }

    // Iterate over the list of schools and generate new options for each
    for(var i = 0; i < schoolCache.length; ++i) {
        var school = schoolCache[i];

        // Create an option
        var option = $("<option>");
        if(term > 20130) {
            // Make sure it has a code
            if(school.code == null) { continue; }
            option.html(school.code + " - " + school.title);
        } else {
            // Make sure it has a number
            if(school.number == null) { continue; }
            option.html(school.number + " - " + school.title);
        }
        option.val(school.id);

        // Add the option to the school selector
        option.appendTo(schools);
    }

    // Add the all option to the front of the list
    $("<option value='any'>Any College</option>").prependTo(schools);
    schools.children().first().attr("selected", "selected");
}

/**
 * Sorts schools based on the property given
 * Adapted from code at: http://stackoverflow.com/a/881987
 * @param   prop    String  The property to sort by
 */
function sortSchools(prop) {
    schoolCache = schoolCache.sort(function(a, b) {
        return (a[prop] > b[prop]);
    });
}

function spinRoulette() {
	// Serialize the data from the restrictions form and send it in a POST request
	$.post("./js/rouletteAjax.php", $('#parameters').serialize(), function(d) {
        // Store the roulette course div for future use
        var courseDiv = $('#rouletteCourse');

        // Clear out existing random courses and display the header
        courseDiv.empty();
        courseDiv.removeClass();

		// Was there an error?
		if(d.error != undefined && d.error != null) {
			// Display the error in the result box
			courseDiv.html("<h2>Sorry! An error occurred!</h2>" + d.msg + "");
			courseDiv.addClass('rouletteError');
            courseDiv.slideDown();
            return;
		}

        // Load the template for the random course
        var template = fetchTemplate("js/templates/rouletteRandomCourse.html");
        if(template == null) {
            // Display an error
            courseDiv.html("<h2>Sorry! An error occurred!</h2><p>Failed to load the output template.</p>");
            courseDiv.addClass("rouletteError");
            courseDiv.slideDown();
            return;
        }

        // Display the department based on the term
        var term = $("#term").val();

        courseDiv.html(template(d));

        // @TODO:	Link to course in the browse page

        // Make a button that stores the course info in session data
        // @TODO: Just store the object and have the schedule js figure it out
        // @TODO: ALSO SEND THE TERM NUMBER WITH THE COURSE INFO!!!
        $("<input>").attr("type", "button")
                    .attr("value", "Build Schedule with this Course")
                    .click(function() {
                        var department = ($("#term").children(":selected").val() > 20130) ? d.department.code : d.department.number;
                        sessionStorage.setItem("rouletteCourse", department + "-" + d.course + "-" + d.section);
                        window.location = "generate.php";
                        })
                    .appendTo(courseDiv);

        courseDiv.slideDown();
		$('#spinButton').val("I Want a Different Course!");
	});
}

/**
 * Called when the anyDays checkbox is checked/unchecked. Toggles the enabled
 * status of the specific day checkboxes
 * @param field     (hopefully) the anyDays checkbox
 */
function toggleDaysAny(field) {
    // Grab the days checkboxes
    var days = $(".days");

    // Are we hiding or showing
	if(field.checked) {
        // Hide them all!
        days.attr("disabled", "disabled");
	} else {
		// Show them all!
		days.removeAttr("disabled");
	}
}

/**
 * Called when the anyTimes checkbox is checked/unchecked. Toggles the enabled
 * status of the specific time checkboxes
 * @param field     (hopefully) the anyTimes checkbox
 */
function toggleTimesAny(field) {
    var times = $(".times");

	// Are we hiding or showing?
	if(field.checked) {
		// Hide them all!
        times.attr("disabled", "disabled");
	} else {
		// Show them all!
        times.removeAttr("disabled");
	}
}
