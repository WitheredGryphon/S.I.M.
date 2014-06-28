<?php
    session_start();
    unset($_SESSION['user']);
    unset($_SESSION['pass']);
    echo "Successfully logged out. <a href='index.php'><br />Click here if you don't want to wait.</a>";
    header("refresh:5;url=index.php");
?>