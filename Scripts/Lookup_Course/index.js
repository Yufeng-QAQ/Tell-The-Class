"use strict"
var user = "";
var course_code = "";
window.onload = pageLoad;

function pageLoad() {
    course_code = document.getElementById("course_code").value;
    fetchUser();
    fetchComments();
    document.querySelector(".comment-form").onsubmit = submitComment;
}

function toggleForm() {
    const form = document.querySelector('.form-container');
    // Change the button content to "Close"
    const post_btn = document.querySelector('.post-comment');
    post_btn.innerHTML = "Close";

    // Toggle display property when the "post comment" button is hit
    if (form.style.display === 'none' || form.style.display === '') {
        form.style.display = 'block';
    } else {
        form.style.display = 'none';
        // Reset the form to initial state
        document.querySelector('.comment-form').reset();
        post_btn.innerHTML = "Post Comment";
    }
}   

/*
    NOTE: Chart.js is having major conflict with prototype.js, therefore this page will use
          Tradictional ajax method
*/

// Obtain current user
const fetchUser = () => {
    var ajax = new XMLHttpRequest();
    ajax.onload = () => {  
        if (ajax.readyState == 4) {
            // User will set to Null if not logged in
            var response = JSON.parse(ajax.responseText);
            user = response.user;
        }
    };
    ajax.open("get", "Scripts/Lookup_Course/getUser.php", true);
    ajax.send();
}

// Handle comment submit operation
const submitComment = (event) => {
    event.preventDefault();
    if (user === "Null") {
        alert("Please login to submit a comment.");
        return;
    }
    
    const formData = new FormData(event.target);
    formData.append("user", user);  // Append the user value to the FormData

    var ajax = new XMLHttpRequest();
    ajax.onload = () => {
        if (ajax.readyState == 4) {
            const response = JSON.parse(ajax.responseText);
            if (response.success) {
                alert("Comment submitted successfully!");
                event.target.reset();   // Reset form table
                const code = course_code.split(" ");
                window.location.href = `course_detail.php?course_code=${encodeURIComponent(code[0])}+${encodeURIComponent(code[1])}`;
            } else {
                alert(`Error: ${response.error}`);
            }
        }
    }

    ajax.onerror = () => {alert("An error occurred while submitting the comment.");}
    ajax.open("post", "Scripts/Lookup_Course/submitComment.php", true);
    ajax.send(formData);
}

const fetchComments = () => {
    const form = document.querySelector(".comment-form"); // Get the form
    const course_code = form.querySelector("input[name='course_code']").value;
    
    var ajax = new XMLHttpRequest();
    
    ajax.onload = () => {
        if (ajax.readyState == 4) {
            const response = JSON.parse(ajax.responseText);
            if (response.success) {
                displayComments(response.comments);
            } else {
                console.error("Error fetching comments:", response.error);
            }
        }
    }
    
    ajax.open("GET", `Scripts/Lookup_Course/fetchComment.php?course_code=${encodeURIComponent(course_code)}`, true);
    ajax.send();
}

const displayComments = (comments) => {
    const commentsSection = document.getElementById("comment-list");
    //commentsSection.innerHTML = "TRYEOAOIR"; // Clear existing comments

    comments.forEach(comment => {
        // Create the comment container div
        const commentDiv = document.createElement("div");
        commentDiv.classList.add("comment");

        // Add user image
        const userImg = document.createElement("img");
        userImg.src = "Image/user.png";
        userImg.alt = "user";
        commentDiv.appendChild(userImg);

        // Create the comment-info container
        const commentInfoDiv = document.createElement("div");
        commentInfoDiv.classList.add("comment-info");

        // Create the comment-header container
        const commentHeaderDiv = document.createElement("div");
        commentHeaderDiv.classList.add("comment-header");

        // Add grade, professor name, and date
        commentHeaderDiv.innerHTML = `
            <span class="grade">Grade: ${comment.grade}</span>
            <span>Prof: ${comment.prof_name}</span>
            <span>${comment.date}</span>
        `;

        // Add comment text
        const commentTextP = document.createElement("p");
        commentTextP.classList.add("comment-text");
        commentTextP.textContent = comment.comment;

        // Append the header and text to the info container
        commentInfoDiv.appendChild(commentHeaderDiv);
        commentInfoDiv.appendChild(commentTextP);

        // Append the info container to the main comment container
        commentDiv.appendChild(commentInfoDiv);

        // Append the entire comment to the comments section
        commentsSection.appendChild(commentDiv);
    });
}
