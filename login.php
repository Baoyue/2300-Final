<?php 
    session_start(); 
?>

<!DOCTYPE html>
<html>
<head>
    <title>CHES: Login</title>
    
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
    <?php include 'navbar.php'; ?> 

    <!-- ~~~~~~~~~~~~~~~~~~~~LOGIN~~~~~~~~~~~~~~~~~~~~ -->
    <div class='log hero'>
        <div class="gradient">

            <div class='modal'>
            <h3 class="title">Login</h3>

            <?php 
                // the user did not login before
                if(!isset($_SESSION['logged_user'])) {
                    // the user has not submit the form
                    if (!isset($_POST['email']) || !isset($_POST['password'])) { 
            ?>

                        <p>Please enter your username and password to login!</p>
                        <div class="login-form">
                        <form name="login_form" method="post" enctype="multipart/form-data">
                            
                            <input type="text" name="email" placeholder='user email'/>
                            <input type="password" name="password" placeholder='password'/>
                            <input type="submit" name="login" value="Login"/>
                        </form>
                        </div>
                        <p>Don't have an account?<br>Please <a href="signup.php">sign up</a> here!</p>


            <?php 
                    } else {
                        // check user's input
                        $error ="";
                        if (!filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL)) {
                            $error.="Your input for email is invalid. ";
                        }
                        $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
                        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
                        
                        if (!preg_match("/^[0-9A-Za-z]{3,12}$/", $password)) {

                            if (!preg_match("/^[0-9A-Za-z]+$/", $password)) {
                                $error.="The format of your input for password is not valid. ";
                            } else {
                                $error.="The length of your input for password should be 3~12 characters.<br>";
                            }
                        }
                        if ($error !="") {
                            print("<p class='error'>Sorry, please fix the errors below: 
                                <br> $error 
                                </p><br>");
            ?>
                            <p>Please try again!</p>
                            <form name="login_form" method="post" enctype="multipart/form-data">
                                
                                <input type="text" name="email" placeholder='email'/>
                                <input type="password" name="password" placeholder='password'/><br>
                                <input type="submit" name="login" value="Login"/>
                            </form>
            <?php
                        } else {
                            // the user submitted login form
                            require_once("config.php"); 
                            $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                            $result = $mysqli -> query("SELECT * FROM Users");
                            $verified = false;
                            $isAdmin = false;
                            $userID;
                            $username;
                            while ($row = $result->fetch_assoc()) {
                                if ($email === $row['email'] && password_verify($password, $row['hashedPassword'])) {
                                    $isAdmin = $row['isAdmin'];
                                    $verified = true;
                                    $userID = $row['userID'];
                                    $username = $row['firstName'];
                                    break;
                                }
                            }
                            // if the user has successfully logged in
                            if ($verified) {
                                $_SESSION['logged_user'] = $userID; 
                                $_SESSION["isAdmin"] = $isAdmin;
                                // if the user is an admin
                                if ($isAdmin) {         
            ?>

                                    <p>Congratulations! You have successfully<br>logged in as wesbite administrator!<br>You can <a href='admin.php'>manage</a> the PTA<br>website or<a href="logout.php"> logout</a>.</p>

            <?php
                                } else {

                                // if the user is a parent
                                    print("<p>Congratulations! You have successfully logged in as $username!</p>");

                                    print("<p>You can manage your <a href='parent.php'>reservations</a> or <a href='logout.php'>logout</a></p>");
                                }    

                            } else {
                            // if the user inputs wrong username/password
                                 print("<p>Sorry, your email or password is incorrect.</p>");
                                 print("<p>Please <a href='login.php'>login</a> again.</p>");
                            }
                        }
                    }
                } else {
                    // the user has already logged in
                    print("<p>You have already logged in.<br>To logout, please<a href='logout.php'> logout</a>.</p>");
                }
        ?>
            </div>

        </div>
    </div>

    <!-- ~~~~~~~~~~~~~~~~~~~~FOOTER~~~~~~~~~~~~~~~~~~~~ -->
    <?php include 'footer.php' ?>

</body>
</html>