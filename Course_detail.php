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
            <button class="post-comment">
                Post Comment
            </button>

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