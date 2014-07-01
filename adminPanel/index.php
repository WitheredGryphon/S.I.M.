<?php

include_once("../config.php");

session_start();
$link = mysqli_connect(DB_HOST, DB_USER, DB_PASS);
if(mysqli_connect_errno()) 
{
    echo "Failed to connect to MYSQL: " . mysqli_connect_error() . "<br />
            <b>Error Code:</b> Beagle";
}

$db = mysqli_select_db($link, DB_NAME) or die ("Cannot connect to database. <br />
                                                                        <b>Error Code:</b> Chinook");

if(!isset($_SESSION['user']))
{
    header( "Location: ../redirect.php" );
}

if($_SESSION['atype'] != "admin")
{
    header( "Location: ../accessDenied.php" );
}
?>

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="admin.css">
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
        <title>
            Admin Panel
        </title>
    </head>
    <body>
         <div id = "navbar">
            <ul>
                <li><a href="#">Class List</a></li>
                <li><a href="#">Student List</a></li>
                <li><a href="professorList.php">Professor List</a></li>
                <li><a href="#">Add...</a>
                    <ul>
                        <li><a href="addAdmin.php">Admin</a></li>
                        <li><a href="addProfessor.php">Professor</a></li>
                        <li><a href="addStudent.php">Student</a></li>
                        <li><a href="addClass.php">Class</a></li>
                    </ul>
               </li>
            </ul>
            <div id = "logout">
                <?php echo "Logged in as: " . $_SESSION['user']; ?>
                <a href="../logout.php"><b>Log Out</b></a>
            </div>
        </div>
        
        <div id = "backColor">
            Admin Panel
        </div>
    </body>
</html>