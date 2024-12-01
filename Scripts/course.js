
window.onload = pageLoad;

function pageLoad() {
    console.log("Page loaded!"); 
    document.getElementById("editbutton").onclick = edit;
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
        console.log("Validation failed, not sending request.");
        return; // If validation fails, stop execution
    }

    console.log("Validation passed, sending AJAX request...");
    
    // If validation passed, make the AJAX request
    new Ajax.Request("Scripts/edit_course.php", {
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
            console.log("Server Response: " + response.responseText);  // Log the server's response
            alert(response.responseText); // Optionally, show the response to the user
        },
        onFailure: function(response) {
            console.log("Request failed. Status: " + response.status);
            alert("There was an error with the request.");
        }
    });

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
    var textPattern = /^[a-zA-Z\s]+$/;
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
    error.classList.add("error-message");
    error.innerText = errorMessage;
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

function display(ajax) {
    // Handle the server's response
    console.log(ajax.responseText); // Logs the server response
    document.getElementById("result").innerHTML = ajax.responseText; // Optionally display it on the page
}
