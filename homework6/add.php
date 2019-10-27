<?php
    ini_set('display_errors', '0');

    require_once 'login.php';

    echo <<<_END
    <a href="index.php"><h3>HOME</h3></a>
    <a href="find.php"><h3>FIND</h3></a>
    <h4>ADD DETAILS</h4>
    <form method='post' action='add.php' enctype='multipart/form-data' >
        advisor name: <input type="text" name="aname"><br><br>
        student name: <input type="text" name="sname"><br><br>
        student id: <input type="text" name="sid"><br><br>
        class code: <input type="text" name="ccode"><br><br>
        <input type='submit' value='Add to Database'>
        <p>* all the fields are required for succesful insertion into db</p>
        <hr>
    </form>
_END;

    $conn = new mysqli($hn, $un, $pw, $db);

    if ($conn->connect_error) die(mysql_fatal_error());
    
    $aname = trim($_POST["aname"]);
    $sname = trim($_POST["sname"]);
    $sid = trim($_POST["sid"]);
    $ccode = trim($_POST["ccode"]);

    if($aname != "" && $sname != "" && $sid != "" && $ccode != ""){
        $query = "INSERT INTO studentclass (advisor, student, sid, ccode) VALUES ('$aname', '$sname', '$sid', '$ccode')";
        $result = $conn->query($query);

        if (!$result) echo "INSERT failed: $query<br>" . $conn->error . "<br><br>";
    }


    function mysql_fatal_error(){
        echo "DATABASE ERROR!<br>";
    }

    $conn->close();
?>