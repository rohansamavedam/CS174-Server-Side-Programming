<!-- Krishna Rohan Samavedam, CS174 Section 01, Mid-Term 1 -->
<!-- Note: This assignment excepts a 20x20 string input from the txt file. However, it works for a single line string aswell -->

<?php
    echo <<<_END
        <html><head><title>PHP Form Upload</title></head><body>
        <form method='post' action='index.php' enctype='multipart/form-data' >
            Select File: <input type='file' name='uploadfileinput' size='10' >
            <input type='submit' value='Upload'>
        </form>
_END;

    if($_FILES){
        $inputtype = $_FILES['uploadfileinput']['type'];

        if($inputtype == "text/plain"){

            // Accessing the Name of the file uploaded.
            $name = $_FILES['uploadfileinput']['name'];

            // Opening the file and reading the lines of numbers.
            $fh = fopen($name, 'r') or die("File Does not exist");

            // Assigning all the values to an array.
            $charArray = [];
            while(!feof($fh)){
                $line = fgets($fh);
                $tempCharArray = str_split($line);
                array_push($charArray, $tempCharArray);
            }
            
            fclose($fh);

            // Validate for the right input and Give out the ANSWER.
            if(validateInputData($charArray) != true){
                echo "Error: File is Not Formatted properly.";
            }else{
                // Giving out the Answer if everything is Correct.
                echo "File Name: " . $name . " <br> ";

                echo "The max product is: <h1>";
                echo calculateProduct($charArray);
                echo "</h1>";
            }

            tester($charArray);

        }else{
            echo "Illegal File Type: Please Upload a text file with extension .txt only";
            echo "<br>";
        }
    }

    // Ignored the top and left cases because it will be the same as right and bottom.
    function calculateProduct($charArray){
        $product = 0;
        for($row = 0; $row < sizeof($charArray); $row++){
            for($col = 0; $col < sizeof($charArray[$row]); $col++){
                if($charArray[$row][$col] !== "\n"){
                    //Right
                    $tempProductRight = $charArray[$row][$col] * $charArray[$row][$col + 1] * $charArray[$row][$col + 2] * $charArray[$row][$col + 3];
                    //Bottom
                    $tempProductDown = $charArray[$row][$col] * $charArray[$row + 1][$col] * $charArray[$row + 2][$col] * $charArray[$row + 3][$col];
                    //Diagnol
                    $tempProductCross = $charArray[$row][$col] * $charArray[$row + 1][$col + 1] * $charArray[$row + 2][$col +2] * $charArray[$row + 3][$col + 3];

                    // Getting the max from Right, Bottom and Diagnol.
                    $tempMax = max($tempProductRight, $tempProductDown, $tempProductCross);

                    if($tempMax > $product){
                        $product = $tempMax;
                    }
                }
            }
        }
        return $product;
    }

    //Method to find if the length is 400 and has the right datatypes in the string.
    function validateInputData($charArray){
        $counter = 0;

        for($row = 0; $row < sizeof($charArray); $row++){
            for($col = 0; $col < sizeof($charArray[$row]); $col++){
                if($charArray[$row][$col] !== "\n"){
                    $val = $charArray[$row][$col];
                    if(is_numeric($val) != true){
                        return false;
                    }
                    $counter++;
                }
            }
        }

        if($counter != 400){
            return false;
        }

        return true;
    }

    //Tester function is being called in the main area after echoing the answer. 
    function tester($charArray){
        echo "<br> <br> Tester Function: <br>";

        $inputWithDifferentDatatypeInBetween = '12345d7567m';

        $inputWithLengthLessThanFourHundred = '71636269561882677';
        
        if(validateInputData($charArray) != true){
            echo "Error: Data Invalid";
            echo "<br>";
        }else{
            // Giving out the Answer if everything is Correct.
            echo "Test 1: For Correct Data:  ";
            echo calculateProduct($charArray);
            echo "<br>";
        }

        if(validateInputData($inputWithDifferentDatatypeInBetween) != true){
            echo "Test 2: For Incorrect Data with Datatypes other than numeric in between:  ";
            echo "Error: Data Invalid";
            echo "<br>";
        }else{
            echo calculateProduct($charArray);
        }

        if(validateInputData($inputWithLengthLessThanFourHundred) != true){
            echo "Test 3: For length not equal to 400:  ";
            echo "Error: Data Invalid";
            echo "<br>";
        }else{
            echo calculateProduct($charArray);
        }


    }

    echo "</body></html>";
?>