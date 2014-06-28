<?php

include_once("../config.php");

session_start();
$link = mysqli_connect(DB_HOST, DB_USER, DB_PASS);
if(mysqli_connect_errno()) 
{
    echo "Failed to connect to MYSQL: " . mysqli_connect_error();
}

$db = mysqli_select_db($link, DB_NAME) or die ("Cannot connect to database");

if(!isset($_SESSION['user']))
{
    header( "Location: ../redirect.php" );
}

mysqli_close($link);
?>

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="student.css">
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
        <title>
            Student Panel
        </title>
    </head>
    <body>
    
        <div id = "navbar">
            <ul>
                <li><a href="#">My Classes</a>
                    <ul>
                        <li><a href="#">Class A</a></li>
                        <li><a href="#">Class B</a></li>
                        <li><a href="#">Class C</a></li>
                    </ul>
                </li>
                <li><a href="#">Grades</a></li>
                <li><a href="#">Attendance</a></li>
                <li><a href="#">Assignments</a>
                    <ul>
                        <li><a href="#">Upcoming</a></li>
                        <li><a href="#">Ongoing</a></li>
                        <li><a href="#">Overdue</a></li>
                    </ul>
               </li>
            </ul>
            <div id = "logout">
                <?php echo "Logged in as: " . $_SESSION['user']; ?>
                <a href="../logout.php"><b>Log Out</b></a>
            </div>
        </div>
        
        <div id = "backColor">
            Student Information Management
        </div>
        
        <div class = "container">
            <div id = "newsHead">
                <h2>News</h2>
            </div>
            <div id = "newsContent">
                <b><h3>Class A</h3></b>
                Text<br />
                <b><h3>Class B</h3></b>
                Text<br />
                <b><h3>Class C</h3></b>
                Text
            </div>
        </div>
    </body>
</html>