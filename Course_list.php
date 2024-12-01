<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tell The Class</title>
    <link rel="stylesheet" href="Styles/Course_list.css">
    <link rel="stylesheet" href="Styles/Banner.css">
</head>

<body>
    <!-- This page is implemented by Yufeng -->

    <!-- Banner HTML -->
    <?php 
        $currentPage = 'Course_list';
        include 'Components/banner.php';
    ?>

    <!-- Course List content section -->
    <div class="content" id="content">
        <h1 class="uni-name">University of Maryland, Baltimore County</h1>
        
        <!-- This section contain all list of courses -->
        <div class="course-container">

            <?php
                //Connect to the database
                $db = mysqli_connect("studentdb-maria.gl.umbc.edu", "yufengl1", "yufengl1", "yufengl1");

                if (mysqli_connect_errno()) {
                    exit("Error - could not connect to MySQL");
                }

                // Change encoding
                mysqli_set_charset($db ,"utf8mb4");

                // Retrieve info from majors and courses tables
                $query = "SELECT majors.major_name, majors.major_code, courses.course_code, courses.course_name, courses.course_description 
                        FROM majors 
                        JOIN courses ON majors.major_id = courses.major_id
                        ORDER BY majors.major_code, courses.course_code";

                $result = mysqli_query($db, $query);

                if (mysqli_num_rows($result) > 0) {
                    $current_major = "";

                    while ($row = mysqli_fetch_array($result)) {
                        // If the major has changed, start a new major section
                        if ($current_major != $row['major_code']) {
                            // Close the previous major's list if it's not the first entry
                            if ($current_major != "") {
                                echo '</ul>';
                            }

                            // Update current major and start a new section
                            $current_major = $row['major_code'];
                            echo '<p class="major-name">' . $row['major_code'] . ' - ' . $row['major_name'] . '</p>';
                            echo '<ul class="course-list">';
                        }

                        // Output each course under the current major
                        echo '<li class="course">';
                        echo '<h4 class="course-name">' . $row['course_code'] . ' - ' . $row['course_name'] . '</h4>';
                        echo '<p class="course-description">' . $row['course_description'] . '</p>';

                        // View detail button that navigate to the grade distribution page, passing parameter 'course_code'
                        echo '<form action="course_detail.php" method="get">';
                        echo '<input type="hidden" name="course_code" value="' . $row['course_code'] . '">';
                        echo '<button type="submit" class="view-detail-btn">View Details</button>';
                        echo '</form>';

                        echo '</li>';
                    }

                    // Close a major section
                    echo '</ul>';
                }
            ?>

        </div>

    </div>

</body>

</html>