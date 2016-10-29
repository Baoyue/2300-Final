<?php 
session_start(); 
?>

<!DOCTYPE html>
<html>
<head>
	<title>CHES: Committees</title>
	
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
	<?php include 'navbar.php' ?>

	 <!-- ~~~~~~~~~~~~~~~~~~~~COMMITTEES~~~~~~~~~~~~~~~~~~~~ -->
	<div class='section committees'>
		<h3 class='title'>Committees</h3>
		
		<div class='container'>
			<h2 class='subheader'><b>Key Officers:</b></h2>
			<div class='row'>
				<div class='col-md-4'>
					<div class='card red'>
                        <h4 class='subtitle'>Co-Presidents</h4>
                        <br><a class='email' href='#'>Amy Schwartz</a>
                        <br><a class='email' href='#'>Betsy Collins</a>
                    </div>
				</div>
				<div class='col-md-4'>
                    <div class='card skyblue'>
                        <h4 class='subtitle'>Treasurer</h4>
                        <br><a class='email' href='#'>Catherine Gale</a>
                        <br><h5 class='desc'>Manages funds.</h5>
                    </div>
                </div>
                <div class='col-md-4'>
                    <div class='card teal'>
                        <h4 class='subtitle'>Secretary</h4>
                        <br><a class='email' href='#'>Heather Filiberto</a>
                        <br><h5 class='desc'>Takes minutes.</h5>
                    </div>
                </div>
            </div>
			
			<h2 class='subheader'><b>Committee Chairs:</b></h2>
			
			<?php
				$info = array(
					array("Membership", "Catherine Gale"),
					array("Snack Pantry", "Spence Hill"),
					array("Enrichment", "Karen Harjes"),
					array("Firehouse Fund", "Kate Travis<br>Chris Miller"),
					array("Directory", "Mary Wirtz<br>Deidre Hay"),
					array("Book Fair", "Aoise Stratford<br>Lisa Ellin"),
					array("Birthday Books", "Melissa Perry<br>Doa Abdel-Ghany<br>Alicia Wittink<br>Chantelle Daniel"),
					array("5K", "Kathy Lacson<br>Sean Cunningham<br>Carolyn Greenwald"),
					array("Curriculum Breakfast", "Amy Schwartz")
					);

				echo "<div class='row'>";
				$colors = array('dark','pink','seafoam');
				for ($x=0; $x < 3; $x++) {
					$comm = $info[$x][0];
					$names = $info[$x][1];
					$color = $colors[$x];

					echo "<div class='col-md-4'>";
					echo "<div class='card "."$color'>";
					echo "<h4 class='subtitle'>$comm</h4>";
					echo "<br><a class='email' href='#'>$names</a>";
					echo "<br><h5 class='desc'>Committee chair.</h5>";
					echo "</div></div>";
				}
				echo "</div>";

				echo "<div class='row'>";
				$colors2 = array('teal','red','skyblue');
				for ($x=3; $x < 6; $x++) {
					$comm = $info[$x][0];
					$names = $info[$x][1];
					$color = $colors2[$x-3];

					echo "<div class='col-md-4'>";
					echo "<div class='card "."$color'>";
					echo "<h4 class='subtitle'>$comm</h4>";
					echo "<br><a class='email' href='#'>$names</a>";
					echo "</div></div>";
				}
				echo "</div>";
			?>

			<div class='row'>
				<div class='col-md-4'>
					<div class='card seafoam tall'>
                        <h4 class='subtitle'>Birthday Books</h4>
                        <br><a class='email' href='#'>Melissa Perry</a>
                        <br><a class='email' href='#'>Doa Abdel-Ghany</a>
                        <br><a class='email' href='#'>Alicia Wittink</a>
                        <br><a class='email' href='#'>Chantelle Daniel</a>
                    </div>
				</div>
				<div class='col-md-4'>
                    <div class='card dark tall'>
                        <h4 class='subtitle'>5K</h4>
                        <br><a class='email' href='#'>Kathy Lacson</a>
                        <br><a class='email' href='#'>Sean Cunningham</a>
                        <br><a class='email' href='#'>Carolyn Greenwald</a>
                    </div>
                </div>
                <div class='col-md-4'>
                    <div class='card pink tall'>
                        <h4 class='subtitle'>Curriculum Breakfast:</h4>
                        <br><a class='email' href='#'>Amy Schwartz</a>
                        <br><h5 class='desc'>Committee chair.</h5>
                    </div>
                </div>
            </div>

		</div>
	</div>
	
	<!-- ~~~~~~~~~~~~~~~~~~~~FOOTER~~~~~~~~~~~~~~~~~~~~ -->
    <?php include 'footer.php' ?>

</body>
</html>