<?php 
    session_start(); 
?>

<!DOCTYPE html>
<html>
<head>
    <title>CHES: Cancel Registration</title>
    
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
    <?php
        include 'navbar.php';
    ?>
    <!-- ~~~~~~~~~~~~~~~~~~~~INDEX~~~~~~~~~~~~~~~~~~~~ -->
    <div class="section">


        <?php 
            $eventID = filter_input(INPUT_GET, "eventID", FILTER_SANITIZE_NUMBER_INT);
            if (isset($_SESSION['logged_user']) && isset($_SESSION['isAdmin']) && !$_SESSION['isAdmin']) {
                $userID = $_SESSION['logged_user'];
        ?>

                <h3 class='title'>Cancel Volunteer Registration</h3>
                <div class="adminBottom">
        <?php 
                require_once("config.php"); 
                $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                $mysqli -> query("DELETE FROM Volunteers WHERE eventID=$eventID AND userID=$userID");   
                print("<p class='subtitle'>Your registration has been successfully canceled!</p>");
                print("<div class='itemButton' style='margin:auto; float:none'><a href='parent.php'>BACK TO ACCOUNT</a></div>");
                
        ?> 
                </div>
        <?php 
       
        
            } else {
                // the user is not an admin
                print("<h3 class='title'>Error</h3>");
                print("<p class='subtitle'>Sorry, you do not have the right to access this page. Please <a href='login.php'>login</a>.</p>");
            }
    	?>
        
    </div>

<!-- ~~~~~~~~~~~~~~~~~~~~FOOTER~~~~~~~~~~~~~~~~~~~~ -->
    <?php include 'footer.php' ?>
    
</body>
</html>