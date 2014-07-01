<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../main.css">
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
    </head>
    <body>
    </body>
</html>

<?php
    include_once("../config.php");

    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASS);
    if(mysqli_connect_errno()) 
    {
        echo "Failed to connect to MYSQL: " . mysqli_connect_error() . "<br />
                <b>Error Code:</b> Beagle";
    }
    $db = mysqli_select_db($link, DB_NAME) or die ("Cannot connect to database. <br />
                                                                            <b>Error Code:</b> Chinook");
    
    $findProfs = "SELECT * FROM Instructors";
    $result = "";
    if(!mysqli_query($link, $findProfs))
    {
        echo "Could not locate any instructors. <br /><b>Error Code: Dingo</b><br /><br />
                  <script>
                        function goBack()
                        {
                            window.history.back()
                        }
                    </script>
                    <button onclick='goBack()'>Return To Previous Page</button>";
        echo "<div id = 'wrapper' style='width:100%; text-align:center'>
            <img src = '../images/warning.png'/>
        </div>";
        die();
    }
    else
    {
        $result = mysqli_query($link, $findProfs);
    }
    $records = mysqli_num_rows($result);
    $fieldInfo = mysqli_fetch_field($result);
    
    echo "<table border = \"1\">";
    echo "<th>"; 
    echo str_replace("PID", $fieldInfo->name, "ID #");
    echo "</th>";
    
    while($fieldInfo = mysqli_fetch_field($result))
    {
        echo "<th>";
        echo $fieldInfo->name;
        echo "</th>";
    }
    while ($row = mysqli_fetch_row($result))
    {
        echo "<tr>"; 
        foreach ($row as $field)
        {
            echo "<td><p style='text-align: center;'>".stripslashes($field)."</p></td>";
        }
        echo "</tr>";
    }
    
    echo "</table>";

    mysqli_close($link);
?>