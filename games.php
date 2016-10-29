<?php 
    session_start(); 
?>

<!DOCTYPE html>
<html>
<head>
    <title>CHES: Games</title>
    
    <!--MONTSERRAT-->
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <!--OPEN SANS-->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,300italic,400,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>

    <!--CSS-->
	<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="css/style.css" rel="stylesheet" type="text/css">
	<link href="css/styles.css" rel="stylesheet" type="text/css">
   
    <!--SCRIPTS-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src= "js/script.js"></script>

    <!--META-->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
</head>

<body>
	<!-- ~~~~~~~~~~~~~~~~~~~~NAVBAR~~~~~~~~~~~~~~~~~~~~ -->
	<?php include 'navbar.php'; ?> 

	<!-- ~~~~~~~~~~~~~~~~~~~~GAMES~~~~~~~~~~~~~~~~~~~~ -->
	<div class='section games'>
		<h3 class='title'>Educational Games</h3>
		<div class='container'>
			<div class='row'>
				<div class='col-md-6'>
					<div class='icons'>
						<a href = 'http://www.funbrain.com/brain/MathBrain/MathBrain.html'>
						<img src='img/arcade.png' alt='games' class='icons'></a>
					</div>
				</div>
				<div class='col-md-6'>
					<div class='icons'>
						<a href = 'http://www.funbrain.com/brain/JustForFunBrain/JustForFunBrain.html'>
						<img src='img/arcade2.png' alt='games' class='icons'></a>
					</div>
				</div>
			</div>
			<div class='row'>
				<div class='col-md-6'>
					<div class='icons'>
						<a href = 'http://www.funbrain.com/brain/SweepsBrain/sweepsbrain.html'>
						<img src='img/other.png' alt='games' class='icons'></a>
					</div>
				</div>
				<div class='col-md-6'>
					<div class='icons'>
						<a href = 'http://www.funbrain.com/brain/ReadingBrain/ReadingBrain.html'>
						<img src='img/reading.png' alt='games' class='icons'></a>
					</div>
				</div>
			</div>
		</div>
	</div>

    <!-- ~~~~~~~~~~~~~~~~~~~~FOOTER~~~~~~~~~~~~~~~~~~~~ -->
    <?php include 'footer.php' ?>
    
</body>
</html>

