<html>
    <head>
        <link rel="stylesheet" type="text/css" href="main.css">
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
        <title>
            S.I.M.
        </title>
    </head>
    <body>
        <div id = "titlebar"><p align = center><b>Student Information Management</b></p></div>
        <br /><br />
        <form id="login" method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
            <p align = center><b> Username: </b><input type = "text" name = "user"></p>
            <p align = center><b> Password: </b><input type = "password" name = "pass"></p>
            <br />
            <p align = center><input type = "submit" value = "Login" name = "submit"></p>
        </form>
       
        <div id = "footer"><p align = left>S.I.M. is an open source information management system for both instructors and students alike.</p></div>
    </body>
</html>

<?php

define('INDEX', true);
include_once("config.php");

if (isset($_POST['submit']))
{
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASS);
    if(mysqli_connect_errno()) 
    {
        echo "Failed to connect to MYSQL: " . mysqli_connect_error() . "<br />
                <b>Error Code:</b> Beagle";
    }
    $sql_query = 'CREATE DATABASE IF NOT EXISTS ' . DB_NAME;
    mysqli_query($link, $sql_query);
    $db= new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    
    mysqli_select_db($link, DB_NAME) or die ("Cannot connect to database. <br />
                                                                    <b>Error Code:</b> Chinook");
    
   $cr_table = "CREATE TABLE IF NOT EXISTS Accounts(
                            PID INT NOT NULL AUTO_INCREMENT,
                            PRIMARY KEY(PID),
                            Username CHAR(30) NOT NULL,
                            Password CHAR(60) NOT NULL,
                            AccountType CHAR(10) NOT NULL)"; 
    mysqli_query($link, $cr_table);
    
    $user = mysqli_real_escape_string($link, stripslashes($_POST['user']));
    $pass = mysqli_real_escape_string($link, stripslashes($_POST['pass']));
    
    $loginQuery = "SELECT * FROM Accounts WHERE Username = '$user' AND Password = '$pass'";
    $result = mysqli_query($link, $loginQuery);
    
    if (!mysqli_num_rows($result))
    {
        echo "Invalid Username or Password.";
    }
    else
    {
        session_start();
        
        $_SESSION['user'] = $user;
        $_SESSION['pass'] = $pass;
        
        $info = mysqli_fetch_array($result);
        $_SESSION['atype'] = $info['AccountType'];
        
        if ($_SESSION['atype'] == "admin")
        {
            header("Location: adminPanel/index.php");
        }
        else if ($_SESSION['atype'] == "instructor")
        {
            header("Location: instructorPanel/index.php");
        }
        else if ($_SESSION['atype'] == "student")
        {
            header("Location: studentPanel/index.php");
        }
        else
        {
            echo "<p align = 'center'>There was an error logging you in.<br />
                       Contact your university/school IT department.<br /><br />
                      <b>Error Code:</b> Alligator</p>";
        }
    }

}

?>