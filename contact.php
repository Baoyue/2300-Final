<?php 
    session_start(); 
?>

<!DOCTYPE html>
<html>
<head>
    <title>CHES: Contact</title>
    
    <!--MONTSERRAT-->
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <!--OPEN SANS-->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,300italic,400,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>

    <!--CSS-->
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css">
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

    <!-- ~~~~~~~~~~~~~~~~~~~~CONTACT~~~~~~~~~~~~~~~~~~~~ -->
    <div class="section contacts">
        <h3 class="title">Contacts</h3>
        
        <div class='container'>
            <div class='row'>
                <div class='col-md-4'>
                    <div class='card teal'>
                        <h4 class='subtitle'>Co-Presidents</h4>
                        <br><a class='email' href="mailto:kelviden@yahoo.com" target="_top">Amy Schwartz</a>
                        <br><a class='email' href="mailto:betsycollins49@gmail.com" target="_top">Betsy Collins</a>
                    </div>
                </div>
                <div class='col-md-4'>
                    <div class='card red'>
                        <h4 class='subtitle'>Treasurer</h4>
                        <br><a class="email" href="mailto:catherine.gale@gmail.com" target="_top">Catherine Gale</a>
                        <br><h5 class='desc'>Click to email.</h5>
                    </div>
                </div>
                <div class='col-md-4'>
                    <div class='card pink'>
                        <h4 class='subtitle'>Membership Chair</h4>
                        <br><a class="email" href="mailto:catherine.gale@gmail.com" target="_top">Catherine Gale</a>
                        <br><h5 class='desc'>Click to email.</h5>
                    </div>
                </div>
            </div>
            
            <div class='row'>
                <div class='col-md-4'>
                    <div class='card dark'>
                        <h4 class='subtitle'>List-Serve Admin</h4>
                        <br><a class="email" href="mailto:amymonroe@gmail.com" target="_top">Amy Monroe</a>
                        <br><h5 class='desc'>Click to email.</h5>
                    </div>
                </div>
                <div class='col-md-4'>
                    <div class='card seafoam'>
                        <h4 class='subtitle'>Website Admin</h4>
                        <br><a class="email" href="mailto:gmschwartz@yahoo.com" target="_top">Gary Schwartz</a>
                        <br><h5 class='desc'>Click to email.</h5>
                    </div>
                </div>
                <div class='col-md-4'>
                    <div class='card skyblue'>
                        <h4 class='subtitle'>Yearbook Chair</h4>
                        <br><a class="email" href="mailto:doa_a@yahoo.com" target="_top">Doa Abdelghany</a>
                        <br><h5 class='desc'>Click to email.</h5>
                    </div>
                </div>
            </div>

        </div>

        <!-- <div class="right-wrapper">
            <h4 class="subtitle">School Information</h4>

            <h3 class="infoTitle">Address</h3>
            <h3 class="info">110 E. Upland Rd.</h3>
            <h3 class="info">Ithaca, New York, 14850</h3>

            <h3 class="infoTitle">Phone Number</h3>
            <h3 class="info">Office: 607-257-8557</h3>
            <h3 class="info">Nurse Cindy: 607-266-0432</h3>
            <h3 class="info">After School (CHSAP): 607-257-0368</h3>
            <h3 class="info">Transportation: 607-274-2128</h3>

        </div> -->
    </div>

    <!-- ~~~~~~~~~~~~~~~~~~~~FOOTER~~~~~~~~~~~~~~~~~~~~ -->
    <?php include 'footer.php' ?>

</body>
</html>