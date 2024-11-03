<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tell The Class</title>
    <link rel="stylesheet" href="Styles/Banner.css">
    <link rel="stylesheet" href="Styles/Course_detail.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <!-- Page written by Yufeng -->

    <!-- Banner HTML -->
    <?php 
        $currentPage = 'Course_list';
        include 'Components/banner.php';
    ?>

    <!-- Content HTML -->
    <div class="Course-detail-content">
        
        <?php
            // Print the course name on top
            $course_code = htmlspecialchars($_GET['course_code']);
            echo '<h1 class="course-name">' . $course_code . '</h1>';
        ?>

        <!-- Grade distribution bar chart -->
        <div class="grade-distribution">
            <canvas id="gradeChart"></canvas>
        </div>


        <?php
            //Connect to the database
            $db = mysqli_connect("studentdb-maria.gl.umbc.edu", "yufengl1", "yufengl1", "yufengl1");
            if (mysqli_connect_errno()) {
                exit("Error - could not connect to MySQL");
            }

            $query = "SELECT * FROM course_grades WHERE course_code='$course_code'";
            $result = mysqli_query($db, $query);

            // i\If result object is not returned, then print an error and exit the PHP program
            if(!$result){
                print("Error - query could not be executed");
                $error = mysqli_error($db);
                print "<p> . $error . </p>";
                exit;
            }

            $grade_data = [0, 0, 0, 0, 0];

            // Retrieve the number of each grade
            if (mysqli_num_rows($result) > 0) {
                $result_array = mysqli_fetch_array($result);
                $grade_data = [
                    $result_array['grade_a'],
                    $result_array['grade_b'],
                    $result_array['grade_c'],
                    $result_array['grade_d'],
                    $result_array['grade_f']
                ];
            }
        ?>

        <script>
            // Pass PHP data as a JavaScript variable
            const grade_data = <?php echo json_encode($grade_data); ?>;
        </script>
        <script src="Scripts/bar_chart.js"></script>


        <!-- Student comments section -->
        <div class="course-comment">
            <button class="post-comment" onclick="toggleForm()">
                Post Comment
            </button>

            <div class="form-container">

                <!-- The processing php is not yet implemented due to it will use The
                 cookie technique to verify if user is logged in. Which is belongs to 
                 a task of another team member -->

                <form class="comment-form" action="" method="">
                    <!-- Grade Selection -->
                    <label for="grade">Grade</label>
                    <select id="grade" name="grade" required>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                        <option value="F">F</option>
                    </select>
                    <br>
                    
                    <!-- Professor Name Input -->
                    <label for="professor_name">Professor Name</label>
                    <input type="text" id="professor_name" name="professor_name" required>
                    <br>
                    <!-- Date Input -->
                    <label for="date">Date</label>
                    <input type="date" id="date" name="date" required>
                    <br>

                    <!-- Comment Input -->
                    <label for="comment">Comment</label>
                    <textarea id="comment" name="comment" rows="4" cols="50" placeholder="Enter your comment" required></textarea>
                    <br>

                    <!-- Submit Button -->
                    <input type="submit" value="Submit Comment">

                </form>
            </div>

            <script>
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
            </script>

            <!-- This is the individule comment block -->
            <div class="comment">
                <img src="Image/user.png" alt="user">

                <!-- Contain info such as grade, prof name, and date posted -->
                <div class="comment-info">
                    <div class="comment-header">
                        <span class="grade">Grade: A</span>
                        <span>Prof: Professor Name</span>
                        <span>10-11-2024</span>
                    </div>
                    <p class="comment-text">
                        The professor was very nice! Just need to prepare for the test!
                    </p>
                </div>
            </div>

            <!-- Repeat stucture above -->
            <div class="comment">
                <img src="Image/user.png" alt="user">
                <div class="comment-info">
                    <div class="comment-header">
                        <span class="grade">Grade: A</span>
                        <span>Prof: Professor Name</span>
                        <span>10-11-2024</span>
                    </div>
                    <p class="comment-text">
                        The professor was very nice! Just need to prepare for the test!
                        The professor was very nice! Just need to prepare for the test!
                        The professor was very nice! Just need to prepare for the test!
                        The professor was very nice! Just need to prepare for the test!
                        The professor was very nice! Just need to prepare for the test!
                    </p>
                </div>
            </div>

            <div class="comment">
                <img src="Image/user.png" alt="user">
                <div class="comment-info">
                    <div class="comment-header">
                        <span class="grade">Grade: A</span>
                        <span>Prof: Professor Name</span>
                        <span>10-11-2024</span>
                    </div>
                    <p class="comment-text">
                        If you study, you can get an A.
                    </p>
                </div>
            </div>

        </div>


    </div>

    



    <a href="#banner" class="to-top">
        <h4>Back to Top</h4>
    </a>
</body>