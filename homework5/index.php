<?php
    echo <<<_END
    <form method='post' action='index.php' enctype='multipart/form-data' >
        select file: <input type='file' name='uploadfileinput' size='10' >
        name for this file: <input type="text" name="docname">
        <input type='submit' value='Upload to database'> 
        <hr>
    </form>
_END;

    require_once 'login.php';

    $conn = new mysqli($hn, $un, $pw, $db);

    if ($conn->connect_error) die(mysql_fatal_error());

    // Need to do database querying here, and print out the output to the webpage everytime the page reloads. 
    $query = "SELECT * FROM datahub";
    $result = $conn->query($query);
    if(!$result) die(mysql_fatal_error());

    $rows = $result->num_rows;

    for($i = 0; $i < $rows; $i++){
        $result->data_seek($i);
        $row = $result->fetch_array(MYSQLI_ASSOC);
        echo "File Name: " . $row['name'] . "<br>";
        echo "Content: " . $row['content'] . "<hr>";
    }

    $result->close();
    if($_FILES){
        $inputtype = $_FILES['uploadfileinput']['type'];
        if($inputtype == "text/plain" && $_POST["docname"] != ""){
            $name = $_FILES['uploadfileinput']['name'];
            // Name from the form
            $filename = $_POST["docname"];

            $fh = fopen($name, 'r') or die("File Does not exist");

            // Filedata put in a string
            $filedata = file_get_contents($name);
            // Here we can add an optional check to limit the size of filedata so that the db can be more contained.

            fclose($fh);

            // Databse Qureying, Database is setup in a way that it does not allow duplicate filenames. Table name is datahub, and the field names are name and content.

            $query = "INSERT INTO datahub (name, content) VALUES ('$filename', '$filedata')";
            $result = $conn->query($query);
            if (!$result) echo "INSERT failed: $query<br>" . $conn->error . "<br><br>";
        }else{
            echo "Error: Please make sure you upload a .txt file and provide the name in the name field. <br>";
        }
    }

    $conn->close();

    function mysql_fatal_error(){
        echo "DATABASE ERROR!<br>";
    }
?>