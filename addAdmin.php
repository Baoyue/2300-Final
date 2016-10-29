<?php 
    session_start(); 
?>

<!DOCTYPE html>
<html>
<head>
    <title>CHES: Add Admin</title>
    
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

            <h3 class='title'>Add new admin</h3>
            <div class="adminBottom">
                    
        <?php 
                // the user has not submit the form
                if (!isset($_POST['email']) || !isset($_POST['firstname']) || !isset($_POST['lastname']) || !isset($_POST['password1']) || !isset($_POST['password2'])) { 
        ?>

                    <p>Please fill in all of the blanks in the form below:</p>

                        <form name="addAdmin_form" method="post" enctype="multipart/form-data">
                            <label>Email:</label><br>
                            <input type="text" name="email"/><br>
                            <label>First Name:</label><br>
                            <input type="text" name="firstname"/><br>
                            <label>Last Name:</label><br>
                            <input type="text" name="lastname"><br>
                            <label>Password:</label><br>
                            <input type="password" name="password1"><br>
                            <label>Repeat Password:</label><br>
                            <input type="password" name="password2"><br>
                            <input type="submit" name="addAdmin" value="Add Admin"/>
                        </form>

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
                        $error.="Please fill in all of the fields";
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
                        print("<h2>Sorry, Please fix the errors below:</h2>");
                        print("<p>$error</p>");
        ?>
                        <br><br>
                        <p>Please fill in all of the blanks in the form below:</p>

                            <form name="addAdmin_form" method="post" enctype="multipart/form-data">
                                <label>Email:</label><br>
                                <input type="text" name="email"/><br>
                                <label>First Name:</label><br>
                                <input type="text" name="firstname"/><br>
                                <label>Last Name:</label><br>
                                <input type="text" name="lastname"><br>
                                <label>Password:</label><br>
                                <input type="password" name="password1"><br>
                                <label>Repeat Password:</label><br>
                                <input type="password" name="password2"><br>
                                <input type="submit" name="addAdmin" value="Add Admin"/>
                            </form>
        <?php
                    } else {
                        require_once("config.php"); 
                        $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                        $msg = "Here is your account information:\nUser email: ".$email."\nFirst Name: ".$firstname."\nLast Name: ".$lastname."\nPassword: ".$password1;
                        $hashedPassword = password_hash($password1, PASSWORD_DEFAULT);
                        $mysqli -> query("INSERT INTO Users(hashedPassword,email,firstName,lastName,isAdmin) VALUES ('$hashedPassword','$email','$firstname','$lastname',1)");
                        if (mail($email, "PTA Admin Registration", $msg)) {

                            print("<h3>You are now a member of PTA website admins.</h3>");
                            print("<h3>An email which contains your account information is sent to your email address.</h3>");
                            print("<div class='adminOpt'><a href='addEvent.php'>Add new events</a></div>");
                            print("<div class='adminOpt'><a href='addAdmin.php'>Add another admin</a></div>"); 
                            print("<div class='adminOpt' style='margin:0'><a href='admin.php'>Back to admin account</a></div>");
                        }                 
                    }
                }
                print("</div>");
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