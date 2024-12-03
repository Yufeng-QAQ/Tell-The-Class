 <!-- PHP script written by Yufeng -->
 <?php
        $curr_user = "";
        if (isset($_COOKIE['local_user'])) {
            $curr_user = $_COOKIE["local_user"];
        } else {
            echo "<p class='prompt-login'>Please login in to see My Course record</p>";
        }
        

        // Connect to the database
        $db = mysqli_connect("studentdb-maria.gl.umbc.edu","yufengl1","yufengl1","yufengl1");

        if(mysqli_connect_errno())
            exit("Error - could not connect to MySQL");

        $query = "SELECT *
                FROM enrollments 
                WHERE user = '$curr_user'
                ORDER BY 
                    CASE 
                        WHEN term LIKE 'Fall%' THEN 1
                        WHEN term LIKE 'Summer%' THEN 2
                        WHEN term LIKE 'Spring%' THEN 3
                        WHEN term LIKE 'Winter%' THEN 4
                    END, 
                    SUBSTRING(term, -4) DESC";

        $result = mysqli_query($db, $query);

        $current_term = '';

        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                // Gather information
                $course_id = $row['course_id'];
                $term = $row['term'];
                $subject = $row['subject'];
                $catalog = $row['catalog'];
                $course_name = $row['course_name'];
                $credits = $row['credit_number'];
                $prof_name = $row['prof_name'];
                $grade = $row['grade'];


                // Check if we're starting a new term
                if ($term !== $current_term) {
                    // Close the previous term, if any
                    if ($current_term != '') {
                        echo '</div>';
                    }
                    
                    // Print the term header and open the semester div
                    echo '<div class="semester">';
                    echo '<h4 class="text_bold semester-title">' . htmlspecialchars($term) . '</h4>';
                    
                    // Update the current term tracker
                    $current_term = $term;
                }

                // Print each class entry
                echo '<div class="class">';
                echo '    <div class="info">';
                echo '        <span class="text_size"><span class="text_bold course-code">' . htmlspecialchars($subject . ' ' . $catalog) . '</span> ';
                echo                 htmlspecialchars($course_name) . '</span>';
                echo '        <br />';
                echo '        <span class="sub-info">'
                                 . htmlspecialchars($credits) . ' Credits · ' . htmlspecialchars($prof_name) . ' · id: ' . htmlspecialchars($course_id) .
                              '</span>';
                echo '    </div>';
                echo '    <span class="right">' . htmlspecialchars($grade) . '</span>';
                echo '</div>';
            }
            // Close the final semester div
            echo '</div>';
        } else {
            echo "Error fetching enrollments: " . mysqli_error($db);
        }

        ?>
