<?php

include_once("../config.php");

session_start();
$link = mysqli_connect(DB_HOST, DB_USER, DB_PASS);
if(mysqli_connect_errno()) 
{
    echo "Failed to connect to MYSQL: " . mysqli_connect_error();
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

if(isset($_POST['addClass']))
{
    $user = strtolower(substr($_POST['fname'], 0, 1) . $_POST['lname']);
    if(!mysqli_query($link, "SELECT * FROM Accounts WHERE Username = '$user'")){ }
    else
    {
        while(mysqli_query($link, "SELECT * FROM Accounts Where Username = '$user'"))
        {
            if(!mysqli_query($link, "SELECT * FROM Accounts WHERE Username = '$user'"))
            {
                break;
            }
            else
            {
                $user = $user . rand(1,99);
                break;
            }
        }
    }
    
    $pass = getNewPassword();
    $aType = "instructor";
    
    $generateUser = "INSERT INTO Accounts(Username, Password, AccountType)
    VALUES ('$user', '$pass', '$aType')";
    
    if(!mysqli_query($link, $generateUser))
    {
            echo("I broke: " . mysqli_error($link));
    }
    
    $generateInfoTable = "CREATE TABLE IF NOT EXISTS Classes(
                                        PID INT NOT NULL AUTO_INCREMENT,
                                        PRIMARY KEY(PID),
                                        ClassName CHAR(100) NOT NULL,
                                        CreditHours CHAR(1) NOT NULL,
                                        ProfName CHAR(60) NOT NULL,
                                        Semester CHAR(15) NOT NULL)";
                                        
    if(!mysqli_query($link, $generateInfoTable))
    {
        $cname = isset($_POST['cname']) ? $_POST['cname'] : "";
        $hours = isset($_POST['hours']) ? $_POST['hours'] : "";
        $pname = isset($_POST['pname']) ? $_POST['pname'] : "";
        $semester = isset($_POST['semester']) ? $_POST['semester'] : "";
        
        $insertStudent = "INSERT INTO Classes(ClassName, CreditHours, ProfName, Semester)
        VALUES('$cname', '$hours', '$pname', '$semester')";

        mysqli_query($link, $insertStudent);
    }
    else
    {
        $fname = isset($_POST['fname']) ? $_POST['fname'] : "";
        $lname = isset($_POST['lname']) ? $_POST['lname'] : "";
        $email = isset($_POST['email']) ? $_POST['email'] : "";
        $address = isset($_POST['address']) ? $_POST['address'] : "";
        
        $insertStudent = "INSERT INTO Classes(ClassName, CreditHours, ProfName, Semester)
        VALUES('$fname', '$lname', '$email', '$address')";
        
        mysqli_query($link, $insertStudent);
    }
}
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="admin.css">
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
        <title>
            Add Admin
        </title>
    </head>
    <body>
        <div id = "navbar">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="classList.php">Class List</a></li>
                <li><a href="studentList.php">Student List</a></li>
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
        <br />
        <br />
        <div class = "container">
            <h1><p align = center>New Class Form</p></h1>
            <form id = "admin" method = "POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                <p align = center><b>Class Name: </b><input type = "text" name = "cname"></p>
                <p align = center><b>Credit Hours: </b><input type = "text" name = "hours"></p>
                <p align = center><b>Professor Teaching: </b><input type = "text" name = "pname"></p>
                <p align = center><b>Fall, Winter, or Summer Semester: </b><input type = "text" name = "semester"></p>
                <br />
                 <p align = center><input type = "submit" value = "Submit" name = "addClass"></p>
            </form>
        </div>
    </body>
</html>