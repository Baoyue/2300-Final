<?php 
session_start(); 
?>

<!DOCTYPE html>
<html>
<head>
	<title>CHES: Courses</title>
	
	<!--MONTSERRAT-->
	<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
	<!--OPEN SANS-->
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:300,300italic,400,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
	<!--SCRIPTS-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<script src= "js/script.js"></script>
	<!--CSS-->
	<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="css/style.css" rel="stylesheet" type="text/css">
	<link href="css/styles.css" rel="stylesheet" type="text/css">
	<!--SCRIPTS-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<script src= "js/courses.js"></script>
	<!--META-->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
</head>
<body>
	<?php include 'navbar.php'; ?>
	<div class='container'>
		<div class='row'>
			<div class='col-md-12 title'>
				<h1>Courses</h1>
			</div>
		</div>
		<div class='row'>
			<div id='notice'><img id='notice-img' src='img/Notice.jpg' alt='notice'>
				<span id='tooltip'> Dear CHES Parents,<br><br> Registration for Fall 2014 Enrichment classes is upon us again!<br><br> Please return your application, signed waiver and health form, and payment to the PTA mailbox in the main office (in yellow Enrichment folder) by this Friday, September 26th.  Make sure you filled out every question including the afterschool pick information which is very important!  Please note pickup times and make sure you can be on time for pick up as many instructors need to leave right after class.<br><br> Checks should be made out to “CHES PTA” for $60(6wk session), $80(8wk session) or two checks for $60 and $20 if applying for a $60 or $80 class (since you don’t know which one your child will get into).  All unused checks will be stapled to your child’s class assignment letter and returned to you. <br><br> As usual, there are many great offerings and we may have more applications than we have spaces.  Please prepare your child for the possibility that a class may be filled. <br><br>Please make sure you sign up for classes your child wants to take and that fit into your schedule, we unfortunately cannot offer refunds.<br><br>Class assignments will be sent home, by Tuesday, September 30th.  Unless otherwise noted, classes start the week of October 6th and run for 6-8 weeks. We regret that we cannot consider applications without attached payment (except, obviously, those that include a request for scholarship), nor can we accept late applications.  Class assignments will be made all at once. <br><br>Thanks a billion,<br><br>Karin Harjes<br><br>Parent Coordinator for Enrichment<br><br><br>
				</span>
			</div>
			<h3>Fall 2014 Enrichment Class Descriptions: </h3>
			<p>Click on the course names for more information!</p>
			<div class='separator'></div>
			<div class='col-md-1'></div>
			<div class='col-md-10'>
				<?php

				$topics = array("Academic Classes", "Athletic Classes", "Creative Classes", "Nature Classes");
				$num = array(3, 3, 3, 2);

				$info = array(
					//academic
					array("Creative Problem Solving I: 8 Weeks", "(Limit 10 Students)", "Grades K-2", "This will be a creative problem solving class in the vein of Odyssey of the Mind spontaneous problems. It would focus on short group exercises as well as individual creative out of the box thinking and collaborating. Some challenges would be verbal, others short building exercises. Kids will learn some brainstorming techniques and team development.<br><br><i>Taught by Jules Behrens, who has been teaching and tutoring children for over 15 years.  She has coached Odyssey of the Mind for 4 years and has taught Creative Problem Solving classes for 3 years.</i>"),
					array("Science Surprises I: 6 Weeks", "(Limit 10 Students)", "Grades K-2", "No class description"),
					array("Science Surprises II: 6 Weeks", "(Limit 10 Students)", "Grades 3-5", "This class offered by the Sciencenter introduces students to the wonders of science with hands on experiments such as rocket launching, stirring up ‘slime’ and making ice cream.<br><br><i> Taught by Sciencenter educator Emily Cotman.</i>"),
					//athletic
					array("Hip Hop & Jazz Dance: 8 Weeks", "(Limit 10 Students)", "Grades 3-5", "Upbeat dance class learning jazz and hip hop moves and stretches to popular music.  Please wear sneakers & comfortable clothing! <br><br><i>Taught by Armstrong School of Dance Instructor Brittany Manuel.</i>"),
					array("Fun Yoga: 8 Weeks", "(Limit 10 Students)", "Grades K-2", "This will be a creative problem solving class in the vein of Odyssey of the Mind spontaneous problems. It would focus on short group exercises as well as individual creative out of the box thinking and collaborating. Some challenges would be verbal, others short building exercises. Kids will learn some brainstorming techniques and team development.<br><br><i>Taught by Jules Behrens, who has been teaching and tutoring children for over 15 years. She has coached Odyssey of the Mind for 4 years and has taught Creative Problem Solving classes for 3 years.</i>"),
					array("Youth Basketball: 4 Weeks (2x per week)", "(Limit 8 Students)", "Grades 3-5", "This will be a creative problem solving class in the vein of Odyssey of the Mind spontaneous problems. It would focus on short group exercises as well as individual creative out of the box thinking and collaborating. Some challenges would be verbal, others short building exercises. Kids will learn some brainstorming techniques and team development.<br><br><i>Taught by Jules Behrens, who has been teaching and tutoring children for over 15 years.  She has coached Odyssey of the Mind for 4 years and has taught Creative Problem Solving classes for 3 years.</i>"),
					//creative classes
					array("Let’s Get Cooking!: 6 Weeks", "(Limit 7 Students)", "Grades K-2", "An introduction to cooking for younger children, this course focuses on making food and cooking fun!  Come and explore different grains and healthy food and how to prepare them. <br><br><i>Taught by Waldorf teacher and ex-CHES parent, Marion Gunderson.</i>"),
					array("More Fun With Cooking: 6 Weeks", "(Limit 7 Students)", "Grades 3-5", "An intensive, more advanced cooking course focusing on ideas for breakfast, lunch, dinner and desert. <br><br><i>Taught by Waldorf teacher and ex-CHES parent, Marion Gunderson.</i>"), 
					array("Radical Glass: 6 Weeks", "(Limit 12 Students)", "Grades 4-5", "Students will make a stained glass mirror, fused glass dish or vase, glass bugs and possibly more! Kids will lay out their unique designs in glass, which will then be brought back to Serviente Glass Studios to be heated to red hot in a kiln, and returned to school as finished pieces. The instructor will help with some aspects of the projects, but the kids are the artists. <br><br><i>Taught by Brandon Huntone, an artist, instructor and studio assistant for Serviente Glass Studio. He has taught after school programs and at the studio.</i>"),
					//nature classes
					array("Amazing Animals: 6 Weeks", "(Limit 12 Students)", "Grades K-2", "We learn about animals using the live animals from our indoor collection, giving the children a unique opportunity to touch and interact with the animals up close while learning about them. The following animal groups will be covered: amphibians, tortoises, turtles, lizards, snakes, birds, and mammals.<br><br><i>Taught by Emily McKittrick, Cayuga Nature Center educator and manager of Animal Collections.</i>"),
					array("Primitive Pursuits: 8 Weeks", "(Limit 12 Students)", "Grades 2-5", "Explore natural mysteries and primitive technologies in your school’s backyard. Test your awareness in scout games, learn the hazards of the woods and track the stories left by your wild neighbors. We will gather as a small tribe and find out what it takes to care for ourselves and our environment while having fun!<br><br><i>Taught by Primitive Pursuits instructors.</i>")
					);

				$counter = 0;

				for ($y=0; $y < sizeof($topics); $y++) {

					echo "<div class='row'>";
					echo "<div class='col-md-12'>";
					echo "<h3 class='class-types'>$topics[$y]</h3>";
					echo "</div></div>";

					for ($x=0; $x < $num[$y]; $x++) {

						$name = $info[$counter][0];
						$limit = $info[$counter][1];
						$grades = $info[$counter][2];
						$descrip = $info[$counter][3];

						echo "<div class='row'>";
						echo "<div class='col-md-5'>";
						echo "<p class='class-titles'>$name</p>";
						echo "</div>";
						echo "<div class='col-md-5'>";
						echo "<p>$limit</p>";
						echo "</div>";
						echo "<div class='col-md-2'>";
						echo "<p>$grades</p>";
						echo "</div>";
						echo "<div class='row description'>";
						echo "<div class='col-md-12'>";
						echo "<p class='class-descrip hidden'><br>$descrip<br><br></p>";
						echo "</div></div></div>";

						$counter = $counter + 1;
					}
				}
				?>
			</div>
		</div>
	<div class='row separator'></div>
</div>

<!-- ~~~~~~~~~~~~~~~~~~~~FOOTER~~~~~~~~~~~~~~~~~~~~ -->
<?php include 'footer.php' ?>

</body>
</html>