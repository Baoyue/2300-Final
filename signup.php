<?php 
    session_start(); 
?>

<!DOCTYPE html>
<html>
<head>
    <title>CHES: Sign up</title>
    
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
    <!-- ~~~~~~~~~~~~~~~~~~~~SIGN UP~~~~~~~~~~~~~~~~~~~~ -->
    <div class="signup hero">
        <div class='gradient'>

            <div class='modal'>
            <h3 class="title">Sign Up</h3>
            <?php 
                if(!isset($_SESSION['logged_user'])) {
                    if (!isset($_POST['email']) || !isset($_POST['password1']) || !isset($_POST['password1'])) { 
            ?>

                    <p>You can register for volunteer or reserve events after sign up!</p>
                    <div class="login-form">

                        <form name="login_form" method="post" enctype="multipart/form-data">
                            <input type="text" name="firstname" placeholder='First Name'/>
                            <input type="text" name="lastname" placeholder='Last Name'/>
                            <input type="text" name="email" placeholder='Email'/><br>
                            <p class='password'>Legal password must be characters<br>0-9, a-z, or A-Z and 3-12 characters long.</p>
                            <input type="password" name="password1" placeholder='Password'/>
                            <input type="password" name="password2" placeholder='Repeat Password'/>
                            <input type="submit" name="signup" value="Sign Up"/>
                        </form>

                    </div>

            <?php 
                    } else {

                        // validate user's inputs
                        $firstname = trim($_POST['firstname']);
                        $lastname = trim($_POST['lastname']);
                        $email = trim($_POST['email']);
                        $password1 = trim($_POST['password1']);
                        $password2 = trim($_POST['password2']);

                        $error ="";

                        if ($firstname == '' || $lastname == '' || $email == '' || $password1 == '' || $password2 == '') {
                            $error.="Please fill in all of the fields.";
                        } else {
                            $firstname = trim(filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING));
                            $lastname = trim(filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING));
                            $email = trim(filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL));
                            $password1 = trim(filter_input(INPUT_POST, 'password1', FILTER_SANITIZE_STRING));
                            $password2 = trim(filter_input(INPUT_POST, 'password2', FILTER_SANITIZE_STRING));
                            if (!preg_match("/^[A-Za-z -]+$/", $firstname)) {
                                $error.="The format of your input for first name is not valid<br>";
                            }

                            if (!preg_match("/^[A-Za-z -]+$/", $lastname)) {
                                $error.="The format of your input for last name is not valid<br>";
                            }

                            if (!filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL)) {
                                $error.="The format of your email address is invalid.<br>";
                            }
                            if (!preg_match("/^[0-9A-Za-z]{3,12}$/", $password1)) {

                                if (!preg_match("/^[0-9A-Za-z]+$/", $password1)) {
                                    $error.="The format of your input for password is not valid.<br>";
                                } else {
                                    $error.="The length of your input for password should be 3~12 characters.<br>";
                                }
                            }
                            if (!preg_match("/^[0-9A-Za-z]{3,12}$/", $password2)) {

                                if (!preg_match("/^[0-9A-Za-z]+$/", $password2)) {
                                    $error.="The format of your input for repeat password is not valid.<br>";
                                } else {
                                    $error.="The length of your input for repeat password should be 3~12 characters.<br>";
                                }
                            }
                            if ($password1 !== $password2) {
                                $error.="Your input passwords do not match.\n";
                            }

                            require_once("config.php"); 
                            $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                            $result = $mysqli -> query("SELECT * FROM Users");
                            $userID;
                            while ($row = $result->fetch_assoc()) {
                                if ($email == $row['email']) {
                                    $error.="The email has already been registered!";
                                    break;
                                }
                            }
                        }   
                        if ($error !="") {
                            print("<p>Sorry, Please fix the errors below:</p>");
                            print("<p>$error</p>");
            ?>
                            <br><br>
                            <p>You can register for an event after sign up!</p>

                            <div class="login-form">

                                <form name="login_form" method="post" enctype="multipart/form-data">
                                    <input type="text" name="firstname" placeholder='First Name'/><br>
                                    <input type="text" name="lastname" placeholder='Last Name'/><br>
                                    <input type="text" name="email" placeholder='Email'/><br>
                                    <p>Legal password must be characters 0-9, a-z or A-Z with at least 3 characters and at most 12 characters</p>
                                    <input type="password" name="password1" placeholder='Password'/><br>
                                    <input type="password" name="password2" placeholder='Repeat Password'/><br>
                                    <input type="submit" name="signup" value="Sign Up"/>
                                </form>
                            </div>
                        
            <?php
                        } else {
                            // insert new user into Users table
                            require_once("config.php"); 
                            $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                            $msg = "Here is your account information:\nUser email: ".$email."\nFirst Name: ".$firstname."\nLast Name: ".$lastname."\nPassword: ".$password1;
                            $hashedPassword = password_hash($password1, PASSWORD_DEFAULT);
                            $mysqli -> query("INSERT INTO Users(hashedPassword,email,firstName,lastName,isAdmin) VALUES ('$hashedPassword','$email','$firstname','$lastname',0)");
                            if (mail($email, "PTA Registration", $msg)) {

                                print("<p>Thank you for your registration.</p>");
                                print("<p>An email which contains your account information is sent to your email address.</p>");
                                print("<h3>Now you can <a href='login.php'>Login</a> to register events.</p>");
                            }
                        }
                    }
                } else {
                    print("<p>You have logged in.</p>");
                    print("<p>To create a new account, Please first <a href='logout.php'>logout</a></p>");
                }
            ?>
            </div>

        </div>
    </div>

    <!-- ~~~~~~~~~~~~~~~~~~~~FOOTER~~~~~~~~~~~~~~~~~~~~ -->
    <?php include 'footer.php' ?>

</body>
</html>