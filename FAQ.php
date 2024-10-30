<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Styles/Banner.css">
    <link rel="stylesheet" href="Styles/FAQ.css">
    <title>FAQ</title>
</head>
<body>
    <!-- Banner HTML -->
    <?php 
        $currentPage = 'FAQ';
        include 'Components/banner.php';
    ?>
    

    <div class="QandA">
        <!-- Title for the FAQ section -->
        <span class="text_bold">Frequently Asked Questions</span>
    
        <!-- First question and answer pair -->
        <div class="box">
            <div class="question">
                <span>Q: Are the comments anonymous? </span>
            </div>
            <div class="answer">
                <span>Yes, all comments are absolutely anonymous.</span>
            </div>
        </div>
    
        <!-- Second question and answer pair -->
        <div class="box">
            <div class="question">
                <span>Q: Can I edit my comments? </span> <!-- Changed the question for diversity -->
            </div>
            <div class="answer">
                <span>Yes, you can edit your comments at any time.</span> <!-- Changed the answer for diversity -->
            </div>
        </div>
    
        <!-- Third question and answer pair -->
        <div class="box">
            <div class="question">
                <span>Q: How long are comments stored? </span> <!-- Changed the question for diversity -->
            </div>
            <div class="answer">
                <span>Comments are stored indefinitely unless deleted by the user.</span>
                <!-- Changed the answer for diversity -->
            </div>
        </div>
    
        <!-- Fourth question and answer pair -->
        <div class="box">
            <div class="question">
                <span>Q: Can I report inappropriate comments? </span> <!-- Changed the question for diversity -->
            </div>
            <div class="answer">
                <span>Yes, you can report any inappropriate comments using the report feature.</span>
                <!-- Changed the answer for diversity -->
            </div>
        </div>
    
    </div>
</body>
</html>