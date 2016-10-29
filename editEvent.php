<?php 
    session_start(); 
?>

<!DOCTYPE html>
<html>
<head>
    <title>CHES: Manage Event</title>
    
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
            if (isset($_SESSION['logged_user']) && isset($_SESSION['isAdmin']) && $_SESSION['isAdmin']) {
                $userID = $_SESSION['logged_user'];
        ?>

                <h3 class='title'>Edit Events</h3>
                <div class="adminBottom">
        <?php 
                require_once("config.php"); 
                $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                $result = $mysqli -> query("SELECT * FROM Events"); 
                if (!mysqli_num_rows($result)){
                    print("<h3>There is no events.</h3>");
                    print("<div class='itemButton'><a href='addEvent.php'>ADD NEW EVENT</a></div>");
                } else {
                    while ($row = $result->fetch_assoc()) {
                        $eventID=$row['eventID'];
                        $date=$row['date'];
                        $startTime=$row['startTime'];
                        $endTime=$row['endTime'];
                        $name=$row['eventName'];
                        $description=$row['description'];
                        print("<div class='eventItem'><h2>".$name."</h2>");
                        print("<div class='itemSub'><span>Date: ".$date."</span></div>");
                        print("<div class='itemSub'><span>Time: ".$startTime." - ".$endTime."</span></div>"); 
                        print("<div class='clear'></div>");
                        print("<p>Description: ".$description."</p>");
                        print("<div class='itemButton'><a href='viewList.php?eventID=$eventID'>RESERVATION LIST</a></div>");
                        print("<div class='itemButton'><a href='editItem.php?eventID=$eventID'>EDIT EVENT</a></div>");
                        print("<div class='itemButton'><a href='deleteItem.php?eventID=$eventID'>DELETE EVENT</a></div>");
                        print("<div class='clear'></div>");
                        
                        print("</div>");
                        
                    }
                }

                
        ?> 
                </div>
        <?php 
       
        
            } else {
                // the user is not an admin
                print("<h3 class='title'>Error</h3>");
                print("<p class='subtitle'>Sorry, you do not have the right to access this page. Please login as an admin.</p>");
            }
        ?>
        
    </div>

<!-- ~~~~~~~~~~~~~~~~~~~~FOOTER~~~~~~~~~~~~~~~~~~~~ -->
    <?php include 'footer.php' ?>

</body>
</html>