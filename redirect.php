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
        echo "<b>You must be logged in to access this portion of the page.<br /><br />
                  To log in, click <a href='index.php'>here.</a></b>";
    }
?>