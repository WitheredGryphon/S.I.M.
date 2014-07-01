<html>
<head>
<link rel="stylesheet" type="text/css" href="main.css">
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
</head>
<body>
</body>
</html>

<?php
    session_start();
    if(!isset($_SESSION['user']))
    {
        echo "<b>You must be logged in to access this portion of the website.<br /><br />
                  To log in, click <a href='index.php'>here.</a><br /><br />
                  You will be automatically redirected in 5 seconds.</b>";
                  
        header("refresh:5; url='index.php'");
    }
?>