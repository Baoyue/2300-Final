<?php 
    session_start(); 
?>

<!DOCTYPE html>
<html>
<head>
    <title>CHES: Admin Account</title>
    
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
    <div class="section admin">


        <?php 
            if (isset($_SESSION['logged_user']) && isset($_SESSION['isAdmin']) && $_SESSION['isAdmin']) {
                $userID = $_SESSION['logged_user'];
                require_once("config.php"); 
                $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                $result = $mysqli -> query("SELECT * FROM Users");
                $username;
                while ($row = $result->fetch_assoc()) {
                    if ($userID == $row['userID']) {
                        $username = $row['firstName'];
                        break;
                    }
                }
        ?>

        <?php 
                print("<h3 class='title'>Welcome, $username!</h3>");

        ?>
                <div class="adminCard">
                    <div class="adminOpt">
                        <h3><a href="addEvent.php">Add New Events</a></h3>
                        <p>You can add new events to the schedule.</p>
                    </div>
                    <div class="adminOpt">
                        <h3><a href="editEvent.php">Manage Events</a></h3>
                        <p>You can manage events here.</p>
                    </div>
                    <div class="adminOpt" style="margin:0">
                        <h3><a href="addAdmin.php">Manage Admin</a></h3>
                        <p>You can add new administrators here.</p>
                    </div>
                    <div class="clear"></div>
                </div>

        <?php
                
            } else {
                print("<h3 class='title'>Error</h3>");
                print("<p class='subtitle'>Sorry, you do not have the right to access this page. Please login as an admin.</p>");
            }
        ?>
        
    </div>

<!-- ~~~~~~~~~~~~~~~~~~~~FOOTER~~~~~~~~~~~~~~~~~~~~ -->
    <?php include 'footer.php' ?>

</body>
</html>