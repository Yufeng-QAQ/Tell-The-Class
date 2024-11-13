<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Styles/MyCourse.css" />
    <link rel="stylesheet" href="Styles/Banner.css">
    <title>My Course</title>
</head>

<body>
    <!-- Banner HTML -->
    <?php 
        $currentPage = 'MyCourse';
        include 'Components/banner.php';
    ?>

    <!--Page written by Zhenqi Huang-->
    <!-- Container for the course history section -->
    <div class="course-history">
        <div class="set-btn">
            <!-- Button to add a class -->
            <button class="setbutton" type="button" onclick="toggleForm()">Add Class</button>
        </div>

        <!-- Container for the "Add Class" form -->
        <div class="form-container">
            <form class="class-form" method="POST" action="Scripts/mycourse_process.php">
                <div class="Addclass">
                    <!-- First line of the form with Subject and Catalog Number -->
                    <div class="firstline">
                        <span>Subject: </span><input type="text" name="Subject" placeholder="e.g CMSC" required/>
                        <span>Catalog #: </span><input type="number" name="Catalog" placeholder="e.g 341" required/>
                    </div>

                    <!-- Class name input field -->
                    <div class="firstline">
                        <span>Class name: </span> <input type="text" name="Course_name" placeholder="e.g Data Structures" required/>
                    </div>

                    <!-- Professor and Credits input fields -->
                    <div class="firstline">
                        <span>Professor: </span> <input type="text" name="Professor_name" required/>
                        <span># of Credit: </span> <input type="number" name="Credit_number" required/>
                    </div>

                    <!-- Final Grade and Term input fields -->
                    <div class="firstline">
                        <span>Final Grade: </span>
                        <select name="Grade">
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                            <option value="E">F</option>
                        </select>
                        <span>Term: </span> <input type="text" name="Terms" placeholder="Fall 2024" required/>
                    </div>

                    <!-- Buttons for adding the class or canceling -->
                    <div class="op">
                        <div>
                            <!-- Button to add the class -->
                            <span><input class="popbutton" type="submit" value="Add Class" /></span>

                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Script written by Yufeng -->
        <script>
            function toggleForm() {
                const form = document.querySelector('.form-container');
                const set_btn = document.querySelector('button');

                if (form.style.display === 'none' || form.style.display === '') {
                    form.style.display = 'block';
                    set_btn.innerHTML = "Cancel";
                } else {
                    form.style.display = 'none';
                    set_btn.innerHTML = "Add Class";
                    document.querySelector('.class-form').reset();
                }
            }
        </script>

        <!-- PHP script written by Yufeng -->
        <?php
        $curr_user = "";
        if (isset($_COOKIE['local_user'])) {
            $curr_user = $_COOKIE["local_user"];
        } else {
            echo "<p class='prompt-login'>Please login in to see My Course record</p>";
        }
        

        // Connect to the database
        $db = mysqli_connect("studentdb-maria.gl.umbc.edu","zhenqih1","zhenqih1","zhenqih1");

        if(mysqli_connect_errno())
            exit("Error - could not connect to MySQL");

        $query = "SELECT subject, catalog, course_name, prof_name, credit_number, grade, term 
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
                echo '        <span class="sub-info">' . htmlspecialchars($credits) . ' Credits · ' . htmlspecialchars($prof_name) . '</span>';
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
    </div>

    
    

</body>

</html>