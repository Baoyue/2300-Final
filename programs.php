<?php 
session_start(); 
?>

<!DOCTYPE html>
<html>
<head>
	<title>CHES: Programs</title>
	
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
	<?php include 'navbar.php' ?>
	
	<div class='container'>
		<div class='row'>
			<div class='col-md-12 title'>
				<h1>Programs</h1>
			</div>
		</div>
		<div class='row separator'></div>

		<?php

		$info = array(
			array("Basketball", "Dribble your way down to the gym and join the CHES basketball team.  It is open to fourth and fifth grade students.", "img/Basketball.png"),
			array("Beautification", "Help keep CHES beautiful!", "img/Beautification.png"),
			array("Birthday Books", "All students get a free book during the month of their birthday or in June for summer birthdays.", "img/Birthday-Books.png"),
			array("Box Tops", "Collect Box Tops and send them to school in your child's backpack.  Box Tops are worth ten cents a piece and go towards funding PTA events and scholarships.", "img/Box-Tops.png"),
			array("Chesnuts", "In this CHES literary magazine, every student has a chance to showcase their artwork and writing.", "img/Chesnuts.png"),
			array("Community Garden", "The Community Garden is located near the playground.", "img/Community-Garden.png"),
			array("Directory", "The PTA publishes a free school directory for students, parents and staff.", "img/Directory.png"),
			array("Enrichment", "Students have a chance to sign up for after school enrichment classes offered in the fall and spring.  For class subjects and details. <a href='courses.php'>Click here for more information.</a>", "img/Enrichment.png"), 
			array("Holiday Baskets", "During the month of December, holiday baskets are collected and distributed to CHES families needing extra assistance.", "img/Holiday-Baskets.png"),
			array("Ice Skating Club", "Students can tie up their skates and enjoy time after school with friends at Cass Park Rink.", "img/Ice-Skating.png"),
			array("List-Serve", "Be in the know!  Sign up for the CHES list-serve and receive email school and community announcements and participate in discussions on school related topics.", "img/List-Serve.png"), 
			array("Math Olympiad", "Parent coaches help unlock the mysteries of math!  The program is open to all interested 4th and 5th graders.  The focus is on creative approaches to solving math problems, and students take part in national competitions.", "img/Math-Olympiad.png"),
			array("PTA Council", "CHES PTA sends a representative to PTA council meetings. Council meetings discuss ongoing issues and are made up of representatives, ICSD PTA presidents and the region PTA director.  Many times the ICSD superintendent attends as well.", "img/PTA.png"), 
			array("Ski Club", "Kindergarten through fifth grades are welcome to join ski club which travels weekly to Greek Peak during the winter months. Chaperones are required for grades K through 2nd.", "img/Ski-Club.png"), 
			array("Snack Pantry", "The snack pantry takes food and financial donations throughout year.  Snacks are then distributed by teachers to students in need.", "img/Snack-Pantry.png"),
			array("Spanish", "This program provides after school enrichment to CHES students interested in learning Spanish.", "img/Spanish.png"), 
			array("VIC (Very Important Copying)", "This important program gives teachers more time to plan and teach.  A team of parents help copy and sort materials provided by teachers.", "img/Copying.png"), 
			array("Yearbooks", "Look back at your friends in twenty years and smile. If you have great school pictures that you would like to share, please send them in to the yearbook chair.", "img/Yearbook.png"), 
			array("4th & 5th Grade Organized Concessions", "The sale of food concessions at various CHES events including basketball, Great Escape, and carnival, raise funds for the 5th grade trip.", "img/Concessions.png")
			);

		for ($x=0; $x < sizeof($info); $x++) {
			if ($x%3===0) {
				echo "<div class='row'>";
			}

			$img = $info[$x][2];
			$name = $info[$x][0];
			$desc = $info[$x][1];

			echo "<div class='col-md-4'>";
			echo "<div class='program-picture'>";
			echo "<img src='$img' class='program-symbol' alt='image'>";
			echo "</div>";
			echo "<h3 class='program-names'>$name</h3>";
			echo "<p class='program-desc'>$desc</p>";
			echo "</div>";
			if ($x%3===2) {
				echo "</div>";
			}
		}
		echo "</div>";

		?>
		<div class='row separator'></div>
	</div>

	<!-- ~~~~~~~~~~~~~~~~~~~~FOOTER~~~~~~~~~~~~~~~~~~~~ -->
	<?php include 'footer.php' ?>

</body>
</html>