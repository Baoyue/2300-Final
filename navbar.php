<nav id='primary_nav_wrap'>
    <!-- <img class='logo' src='img/customLogo.png' alt='logo'> -->
    <ul class='link-wrapper'>
    <li><a class='link' href='index.php'>home</a></li>
    <li><a class='link' href='#' style='cursor: default;'>events</a>
        
        <!-- EVENTS DROPDOWN -->
        <ul class='dropdown-wrapper' id='events'>
            <li><a class='link' href='events.php'>events</a></li>
            <li><a class='link' href='programs.php'>programs</a></li>
            <li><a class='link' href='courses.php'>courses</a></li>
        </ul>
    </li>

    <li><a class='link' href='#' style='cursor: default;'>people</a>
        <!-- EVENTS DROPDOWN -->
        <ul class='dropdown-wrapper' id='people'>
            <li><a class='link' href='contact.php'>contacts</a></li>
            <li><a class='link' href='committees.php'>committees</a></li>
        </ul>
    </li>
    

    <li><a class='link' href='games.php'>games</a></li>

    <li><a class='link' href='#' style='cursor: default;'>resources</a>
        <!-- RESOURCES DROPDOWN -->
        <ul class='dropdown-wrapper' id='resources'>
            <li><a class='link' href='http://www.ithacacityschools.org/index.cfm/page/cayugaheights.htm'>ches website</a></li>
            <li><a class='link' href="http://www.ithacacityschools.org/index.cfm/dir.wpSrch?view=teachers&amp;school=CAY">teachers</a></li>
            <li><a class='link' href='http://www.ithacacityschools.org/index.cfm/cayugaheights/menu/library.htm'>ches library</a></li>
            <li><a class='link' href='http://www.cayugaheightsafterschool.org/'>chsap</a></li>
            <li><a class='link' href='http://www.ithacacityschools.org/districtpage.cfm?pageid=229'>lunch menus</a></li>            
        </ul>
    </li>

    <li><a class='link' href='faq.php'>faq</a></li>

    
    <?php
        // ----------HIDDEN CONTENT----------
        if (isset($_SESSION['logged_user']) && isset($_SESSION['isAdmin']) && $_SESSION['isAdmin']) {
            echo "<li class='navbar-link'><a class='link' href='admin.php'>admin</a></li>";
            echo "<li class='navbar-link'><a class='link' href='logout.php'>logout</a></li>";
        } elseif (isset($_SESSION['logged_user'])){
            $userID = $_SESSION['logged_user'];
            require_once("config.php"); 
            $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
            $result = $mysqli -> query("SELECT * FROM Users");
            while ($row = $result->fetch_assoc()) {
                if ($userID === $row['userID']) {
                    $username = $row['firstName'];
                    break;
                }
            }
            echo "<li class='navbar-link'><a class='link' href='parent.php'>$username</a></li>";
            echo "<li class='navbar-link'><a class='link' href='logout.php'>logout</a></li>";
        } else {
            echo "<li class='navbar-link'><a class='link' href='login.php'>login</a></li>";
        }
    ?>
    </ul>
</nav>
