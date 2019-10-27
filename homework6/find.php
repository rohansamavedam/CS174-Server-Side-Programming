<?php
    ini_set('display_errors', '0');

    require_once 'login.php';

    echo <<<_END
    <a href="index.php"><h3>HOME</h3></a>
    <a href="add.php"><h3>ADD</h3></a>
    <form method='post' action='find.php' enctype='multipart/form-data'>
        search by advisor name: <input type="text" name="aname">
        <input type='submit' value='Find from DB'>
    </form>    
_END;

    $conn = new mysqli($hn, $un, $pw, $db);

    if ($conn->connect_error) die(mysql_fatal_error());

    // Need to figure out how to get the value from the form submission even after refrshing and also need to figure out how to print the all the elemnents of the database without any loss. 
        $query = "SELECT * FROM studentclass WHERE advisor='serna'";
        $result = $conn->query($query);

        if(!$result) die(mysql_fatal_error());

        $rows = $result->num_rows;

        for($i = 0; $i < $rows; $i++){
            $result->data_seek($i);
            $row = $result->fetch_array(MYSQLI_ASSOC);
            echo "Adivisor Name: " . $row['aname'] . "<br>";
            echo "Student Name: " . $row['sname'] . "<br>";
            echo "Student Id: " . $row['sid'] . "<br>";
            echo "Class Code: " . $row['ccode'] . "<hr>";
        }

   

    function mysql_fatal_error(){
        echo "DATABASE ERROR!<br>";
    }

    $conn->close();

?>