const course_data = [
    {
        major: "IS - Information System",
        courses: [
            {
                name: "IS 448 - Markup and Scripting Languages",
                description: "IS 448 covers the history, theory, and practice of markup languages and their associated scripting languages. This course covers client-side web technology, such as JavaScript and server-side web technology, such PHP, markup languages, such as XML, and common databases used with web technology."
            }, 
            {
                name: "IS 410 - Introduction to Database Design",
                description: "This course introduces the student to the process of database development, including data modeling, database design and database implementation. Students learn basic interactive SQL for both data definition and queries. Students practice design skills by developing a small database project. This course requires consent of the department, where consent will be granted only to students who have completed the IS BS Gateway."
            },
            {
                name: "IS 450 - Data Communications and Networks",
                description: "This is an introductory survey course in data communications and networking. It surveys basic theory and technology of computer networking. A single networking protocol stack is also covered in depth."
            }
        ]
    }
];

const content = document.getElementById("content");

course_data.forEach(major => {
    // Create course-container class
    const courseContainer = document.createElement('div');
    courseContainer.classList.add('course-container');

    // Create major-name in course-container
    const majorName = document.createElement('p');
    majorName.classList.add('major-name');
    majorName.innerHTML = major.major;
    
    // Create course list
    const courseList = document.createElement('ul');
    courseList.classList.add('course-list');

    courseContainer.appendChild(majorName);
    courseContainer.appendChild(courseList);

    
    major.courses.forEach(course => {
        const courseBlock = document.createElement('li');
        courseBlock.classList.add('course');

        const courseName = document.createElement('h4');
        courseName.classList.add('course-name');
        courseName.innerHTML = course.name;

        const courseDescription = document.createElement('p');
        courseDescription.classList.add('course-description');
        courseDescription.innerHTML = course.description;

        const viewBtn = document.createElement('button');
        viewBtn.classList.add('view-detail-btn');
        viewBtn.innerHTML = "Course Details";

        courseBlock.appendChild(courseName);
        courseBlock.appendChild(courseDescription);
        courseBlock.appendChild(viewBtn);
        courseList.appendChild(courseBlock);
    });


    content.appendChild(courseContainer);
});