<?php 
	session_start();
	$user = '';
	if (isset($_SESSION['logged_user'])) {
		$user = $_SESSION['logged_user'];
		unset($_SESSION['logged_user']);
		unset($_SESSION);
	    session_destroy();
	}
?>

<!DOCTYPE html>
<html>
<head>
    <title>CHES: Logout</title>
    
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
    
    <!-- ~~~~~~~~~~~~~~~~~~~~LOGOUT~~~~~~~~~~~~~~~~~~~~ -->
    <div class='log hero'>
        <div class="gradient">

            <div class='modal'>
            <h3 class="title">Logout</h3>
        <?php 
            if ($user != '') { 
            	print("<p>You have successfully logged out. You may <a href='login.php'>login</a> again.</p>");
            } else {
            	print("<p>You did not login, Please <a href='login.php'>login</a>.</p>");
            }
        ?>
            </div>
        </div>
    </div>

    <!-- ~~~~~~~~~~~~~~~~~~~~LOGOUT~~~~~~~~~~~~~~~~~~~~ -->
    <?php include 'footer.php' ?>

</body>
</html>