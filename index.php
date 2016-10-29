<?php 
    session_start(); 
?>

<!DOCTYPE html>
<html>
<head>
    <title>CHES: Home Page</title>
    
    <!--MONTSERRAT-->
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <!--OPEN SANS-->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,300italic,400,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>

    <!--CSS-->
    <link href="css/style.css" rel="stylesheet" type="text/css">

    <!--SCRIPTS-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src= "js/script.js"></script>

    <!--META-->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
</head>


<body>

    <!-- ~~~~~~~~~~~~~~~~~~~~NAVBAR~~~~~~~~~~~~~~~~~~~~ -->
    <?php include 'navbar.php' ?>

    <!-- ~~~~~~~~~~~~~~~~~~~~INDEX~~~~~~~~~~~~~~~~~~~~ -->
    <div class='index hero'>
        <div class='gradient'>
            <h1 class='header'>Cayuga Heights<br>Elementary School</h1>
            <h2 class='subheader'>Parents and Teachers Association</h2>
            <!-- <p class="subtitle">Official Parents and Teachers Association website for the Cayuga Heights Elementary School</p> -->

            <!-- <h2 class="upload">Upload yearbook picture here. 
            <a href="upload.php"></a>
            </h2>
            <br><br>
            Here we are going to implement a photo slider. The js file is photoSlider.js in js folder. At present we just put an image here and the style will be adjusted later
            <div id="photoSlider">
                <img src='img/school.png' alt="school" class='pic'>
            </div> -->
        </div>
    </div>

    <!-- ~~~~~~~~~~~~~~~~~~~~FOOTER~~~~~~~~~~~~~~~~~~~~ -->
    <?php include 'footer.php' ?>

</body>
</html>