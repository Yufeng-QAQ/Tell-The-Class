"use strict"
window.onload = function() {
    loadCourse();
    document.getElementById("editbutton").onclick = edit;
    $("add-class-form").onsubmit = addClass;
};

function loadCourse() {
    new Ajax.Request("Scripts/MyCourse/showCourse.php", {
        method: "post",
        onSuccess: function (response) {
            const serverResponse = response.responseText;
            const contentDiv = document.getElementById("content");
            contentDiv.innerHTML = serverResponse;
        },
        onFailure: function (response) {
            alert("Course Load Error");
        },
    });
}

function addClass(event) {
    event.preventDefault();
    
    var subject = document.getElementById("add_subject").value;
    var catalogNumber = document.getElementById("add_catalog").value;
    var courseName = document.getElementById("add_course_name").value;
    var professorName = document.getElementById("add_prof_name").value;
    var creditNumber = document.getElementById("add_credit").value;
    var finalGrade = document.getElementById("add_grade").value;
    var terms = document.getElementById("add_term").value;

    if (!validateData(0, subject, catalogNumber, courseName, professorName, creditNumber, finalGrade, terms)) {
        return; 
    }

    console.log(`Add ${courseName}`);
    
    new Ajax.Request("Scripts/MyCourse/mycourse_process.php", {
        method: "post",
        parameters: {
            Subject: subject,
            Catalog: catalogNumber,
            Course_name: courseName,
            Professor_name: professorName,
            Credit_number: creditNumber,
            Grade: finalGrade,
            Terms: terms
        },
        onSuccess: (response) => {
            console.log("Server Response: " + response.responseText);
            alert(response.responseText);
            loadCourse();
        }, 
        onFailure: (response) => {
            console.log("Request failed. Status: " + response.status);
            alert("Unable to add enrollment record.");
        }

    });
}


function edit() {
    var id = document.getElementById("course_ids").value;
    var subj = document.getElementById("subjects").value;
    var log = document.getElementById("Catalogs").value;
    var className = document.getElementById("course").value;
    var prof = document.getElementById("name").value;
    var numCredit = document.getElementById("number").value;
    var Final = document.getElementById("letter").value;
    var terms = document.getElementById("semester").value;

    // Validate the inputs before submitting
    if (!validateData(id, subj, log, className, prof, numCredit, Final, terms)) {
        return; // If validation fails, stop execution
    }

    // If validation passed, make the AJAX request
    new Ajax.Request("Scripts/MyCourse/edit_course.php", {
        method: "post",
        parameters: {
            id: id,
            subject: subj,
            catalog: log,
            name: className,
            professor: prof,
            credit: numCredit,
            grade: Final,
            term: terms
        },
        onSuccess: function(response) {
            console.log("Server Response: " + response.responseText);
            alert(response.responseText);
        },
        onFailure: function(response) {
            console.log("Request failed. Status: " + response.status);
            alert("There was an error with the request.");
        }
    });
    loadCourse();
    
}

function validateData(id, subj, log, className, prof, numCredit, Final, terms) {
    // Clear previous error messages
    clearErrors();

    // 1. Validate ID (positive integer)
    var idPattern = /^\d+$/;
    if (!idPattern.test(id)) {
        showError("course_ids", "Please enter a valid course ID (positive integer).");
        return false;
    }

    // 2. Validate subject, catalog, className, professor (non-empty with letters and spaces)
    var textPattern = /^[a-zA-Z\s:]+$/;
    if (!textPattern.test(subj)) {
        showError("subjects", "Please enter a valid Subject (letters and spaces only).");
        return false;
    }

    var catalogPattern = /^\d{3}$/;  // Matches exactly three digits
    if (!catalogPattern.test(log)) {
        showError("Catalogs", "Please enter a valid Catalog (exactly 3 digits).");
        return false;
    }
    if (!textPattern.test(className)) {
        showError("course", "Please enter a valid Course Name (letters and spaces only).");
        return false;
    }
    if (!textPattern.test(prof)) {
        showError("name", "Please enter a valid Professor Name (letters and spaces only).");
        return false;
    }

    // 3. Validate number of credits (positive integer)
    var creditPattern = /^[1-9][0-9]*$/;
    if (!creditPattern.test(numCredit)) {
        showError("number", "Please enter a valid number of credits (positive integer).");
        return false;
    }

    // 4. Validate grade (one of A, B, C, D, F)
    var gradePattern = /^[A-F]$/;
    if (!gradePattern.test(Final)) {
        showError("letter", "Please enter a valid grade (A, B, C, D, or F).");
        return false;
    }

    // 5. Validate term (e.g., "Fall 2024", "Spring 2024")
    var termPattern = /^(Fall|Spring|Summer|Winter) \d{4}$/;
    if (!termPattern.test(terms)) {
        showError("semester", "Please enter a valid term (e.g., 'Fall 2024').");
        return false;
    }

    // All checks passed
    return true;
}

// Show error message next to the invalid input and focus on the field
function showError(fieldId, errorMessage) {
    var field = document.getElementById(fieldId);
    var error = document.createElement("div");
    alert(errorMessage);
    field.parentNode.appendChild(error); // Append error message below the input field
    field.focus(); // Focus on the invalid field
}

// Clear previous error messages
function clearErrors() {
    var errorMessages = document.querySelectorAll(".error-message");
    errorMessages.forEach(function (message) {
        message.remove(); // Remove all existing error messages
    });

}

function toggleForm() {
    const form = document.querySelector('.form-container');
    const editForm = document.querySelector('.data'); // The edit form
    const setBtn = document.getElementById('add-class');
    const editBtn = document.getElementById('edit-class');

    // Close the edit form if it's open
    if (editForm.style.display === 'block') {
        editForm.style.display = 'none';
        editBtn.innerHTML = "Edit Class";
        document.querySelector('.data-form').reset();
    }

    // Toggle the add form
    if (form.style.display === 'none' || form.style.display === '') {
        form.style.display = 'block';
        setBtn.innerHTML = "Cancel";
    } else {
        form.style.display = 'none';
        setBtn.innerHTML = "Add Class";
        document.querySelector('.class-form').reset();
    }
}

function editClass() {
    const form = document.querySelector('.form-container'); // The add form
    const editForm = document.querySelector('.data');
    const editBtn = document.getElementById('edit-class');
    const setBtn = document.getElementById('add-class');

    // Close the add form if it's open
    if (form.style.display === 'block') {
        form.style.display = 'none';
        setBtn.innerHTML = "Add Class";
        document.querySelector('.class-form').reset();
    }

    // Toggle the edit form
    if (editForm.style.display === 'none' || editForm.style.display === '') {
        editForm.style.display = 'block';
        editBtn.innerHTML = "Cancel";
    } else {
        editForm.style.display = 'none';
        editBtn.innerHTML = "Edit Class";
        document.querySelector('.data-form').reset();
    }
}