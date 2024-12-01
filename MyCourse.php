<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Styles/MyCourse.css" />
    <link rel="stylesheet" href="Styles/Banner.css">
    <script type = "text/javascript" src = "Scripts/loadcourse.js" ></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/prototype/1.6.0.3/prototype.js"></script>
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
            <button class="setbutton" type="button" onclick="editClass()">Edit Class</button>
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
                        <span>Term: </span> <input type="text" name="Terms" placeholder="e.g Fall 2024" required/>
                    </div>

                    <!-- Buttons for adding the class or canceling -->
                    <div class="op">
                        <div>
                            <!-- Button to add the class -->
                            <span><input class="popbutton" type="submit" value="Add Class" id ="addbutton" /></span>

                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Script written by Yufeng -->
        <script>
            function toggleForm() {
                const form = document.querySelector('.form-container');
                const set_btn = document.querySelector('.setbutton');                

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

<div class="data" style="display: none;"> 
    <form class="data-form" id="dataForm">
        <div class="Addclass">
            <!-- First line of the form with Subject and Catalog Number -->
            <div class="firstline">
                <span>Course_ID:</span><input type="number" name="course_id" id="course_ids" />
            </div>
            <div class="firstline">
                <span>Subject: </span><input type="text" name="Subject" id="subjects" placeholder="e.g CMSC" required/>
                <span>Catalog #: </span><input type="number" name="Catalog" id="Catalogs" placeholder="e.g 341" required/>
            </div>

            <!-- Class name input field -->
            <div class="firstline">
                <span>Class name: </span> <input type="text" name="Course_name" id="course" placeholder="e.g Data Structures" required/>
            </div>

            <!-- Professor and Credits input fields -->
            <div class="firstline">
                <span>Professor: </span> <input type="text" name="Professor_name" id="name" required/>
                <span># of Credit: </span> <input type="number" name="Credit_number" id="number" required/>
            </div>

            <!-- Final Grade and Term input fields -->
            <div class="firstline">
                <span>Final Grade: </span>
                <select name="Grade" id="letter">
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
                    <option value="E">F</option>
                </select>
                <span>Term: </span> <input type="text" name="Terms" id="semester" placeholder="Fall 2024" required/>
            </div>

            <!-- Buttons for adding the class or canceling -->
            <div class="op">
                <div>
                    <!-- Button to add the class -->
                    <span><input class="popbutton" type="button" value="Edit Class" id ="editbutton" /></span>
                </div>
            </div>
        </div>
    </form>
</div>


<script>
    function editClass() {
        const formContainer = document.querySelector('.data'); 
        const toggleButton = document.getElementById('button');

        if (formContainer.style.display === 'none' || formContainer.style.display === '') {
            
            formContainer.style.display = 'block';
            toggleButton.innerHTML = "Cancel";
        } else {
            formContainer.style.display = 'none';
            toggleButton.innerHTML = "Edit Class";
            document.querySelector('.data-form').reset();
        }
    }
</script>
<div class="course-history" id="content">
    <p>ww</p>
</div>    

</body>



</html>