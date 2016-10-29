<?php 
    session_start(); 
?>

<!DOCTYPE html>
<html>
<head>
    <title>CHES: Participant List</title>
    
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

                <h3 class='title'>Reservation List</h3>
                <div class="adminBottom">
        <?php 
        		$eventID = filter_input(INPUT_GET, "eventID", FILTER_SANITIZE_NUMBER_INT);
                require_once("config.php"); 
                $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                print("<h2>Participants List</h2>");
                $result = $mysqli -> query("SELECT * FROM Reservation WHERE eventID=$eventID"); 
                $count=0;
                
                if(mysqli_num_rows($result)>0) {
                	print("<table><tr><th>Email</th><th>Name</th><th>Number of People</th><th>Comment</th></tr>");
	                while ($row = $result->fetch_assoc()) {
	                    $email=$row['email'];
	                    $firstName=$row['firstName'];
	                    $lastName=$row['lastName'];
	                    $num=$row['numReservations'];
	                    $comment=$row['comment']==''? "N/A": $row['comment'];
	                    $name=$firstName." ".$lastName;
	                    $count+=$num;
	                    print("<tr><td>".$email."</td><td>".$name."</td><td>".$num."</td><td>".$comment."</td></tr>");
	                    
	                }
	                print("</table>");
	                print("<div class='summary'><span>Total reservation number: ".$count."<span></div>");

                } else {
                	print("<h3>There is no reservation for this event.</h3>");
                }

                print("<h2>Volunteers List</h2>");

                $volunteer = $mysqli -> query("SELECT * FROM Volunteers WHERE eventID=$eventID"); 
                $count=0;
                if(mysqli_num_rows($volunteer)>0) {
                    print("<table><tr><th>Email</th><th>Name</th></tr>");
                    while ($volunteer_row = $volunteer->fetch_assoc()) {
                        $volunteerID = $volunteer_row['userID'];
                        $result = $mysqli -> query("SELECT * FROM Users WHERE userID=$volunteerID");
                        $row = $result->fetch_assoc();
                        $email=$row['email'];
                        $firstName=$row['firstName'];
                        $lastName=$row['lastName'];
                        $name=$firstName." ".$lastName;
                        $count++;
                        print("<tr><td>".$email."</td><td>".$name."</td></tr>");
                        
                    }
                    print("</table>");
                    print("<div class='summary'><span>Total volunteer number: ".$count."<span></div>");

                } else {
                    print("<h3>There is no volunteer for this event.</h3>");
                }

                print("<div class='itemButton'><a href='editEvent.php'>BACK TO EVENTS LIST</a></div>");
                
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