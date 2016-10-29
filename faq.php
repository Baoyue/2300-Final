<?php 
    session_start(); 
?>

<!DOCTYPE html>
<html>
<head>
    <title>CHES: FAQ</title>
    
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
    <div class="section faq">
        <h3 class="title">FAQ</h3>

        <div class='faq-q'>
            <p class="question">How do I join?</p>
            <p class="answer">Fill out the membership form and send it in with your dues to the school office.</p>
        </div>

        <div class='faq-q'>
            <p class="question">How do I get on the list-serve?</p>
            <p class="answer">To subscribe to the list-serve, please contact the List-Serve Admin listed on our <a href="contact.php">Contacts</a> page.</p>
        </div>

        <div class='faq-q'>
            <p class="question"> Who can post and what can be posted on the list-serve?</p>
            <p class="answer">CayugaHeightsPTA has been established to facilitate communication among the parents and teachers of the school. The list is set up as a discussion list, so all members can post announcements and start threads of conversation.  All messages should be relevant to the CHES community. Please keep posts non-political and only post messages that will be of interest to the parents and teachers of Cayuga Heights Elementary School.</p>
        </div>

        <div class='faq-q'>
            <p class="question">How can I help?</p>
            <p class="answer">There are currently many opportunities to volunteer with the CHES PTA. Please see the list at the left for the areas where we are most urgently in need of volunteers.  If you have a specific area of interest, please contact one of our Co-Presidents listed on our <a href="contact.php">Contacts</a> page.</p>
        </div>

        <div class='faq-q'>
            <p class="question">How/What can I donate?</p>
            <p class="answer">Financial donations to the PTA are always welcome! If you are interested in making a financial donation, please contact our Treasurer listed on our <a href="contact.php">Contacts</a> page, or send a check made out to the CHES PTA in an envelope in your child's backpack or drop it off in the PTA mailbox located in the office.</p>
        </div>

        <div class='faq-q'>
            <p class="question">When are the PTA meetings and is there child care?</p>
            <p class="answer">Yes, child care is provided.  Please pre-register with one of our Co-Presidents listed on our <a href="contact.php">Contacts</a> page. Pizza is provided for a suggested $3 donation per child.  Please check meeting dates and times on the calendar on the <a href="index.php">main page</a> often, as sometimes information changes.</p>
        </div>

        <div class='faq-q'>
            <p class="question">Where are the PTA mailboxes?</p>
            <p class="answer">There are two PTA mailboxes (one general and one treasurer mailbox) located in the CHES office.</p>
        </div>

        <div class='faq-q'>
            <p class="question">How do I submit pictures for the yearbook?</p>
            <p class="answer">Have you been to school events and snapped some shots?  Do you have pictures of a field-trip or special classroom activity?  The yearbook committee is always looking for great CHES pictures or your kids.  Action shots or pictures with multiple children are especially welcome.  Please send photos to our Yearbook Chair listed on our <a href="contact.php">Contacts</a> page.</p>
        </div>

        <div class='faq-q'>
            <p class="question">How do I submit announcements for the PTA website?</p>
            <p class="answer">Email our Website Admin listed on our <a href="contact.php">Contacts</a> page any webpage submissions (documents, pictures or announcements) for posting.</p>
        </div>
        
    </div>

    <!-- ~~~~~~~~~~~~~~~~~~~~FOOTER~~~~~~~~~~~~~~~~~~~~ -->
    <?php include 'footer.php' ?>

</body>
</html>