<!-- Krishna Rohan Samavedam, CS174 Section 01, HW3 -->

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

            // Opening the file and reading the line of numbers.
            $fh = fopen($name, 'r') or die("File Does not exist");
            $line = fgets($fh);
            fclose($fh);

            $charArray = str_split($line);

            if(validateInputData($charArray) != true){
                echo "Error: Data from the file Invalid";
            }else{
                // Giving out the Answer if everything is Correct.
                echo "File Name: " . $name . " <br> ";
                echo "The Factorial of Max Product: ";
                echo calculateProductAndFactorial($charArray);
            }

        }else{
            echo "Illegal File Type: Please Upload a text file with extension .txt only";
            echo "<br>";
        }
    }

    function calculateProductAndFactorial($charArray){
        // Calculating the largest product of five adjacent values.
        $product = 0;
        for($i = 0; $i < count($charArray); $i++){
            $tempProduct = $charArray[$i] * $charArray[$i+1] * $charArray[$i+2] * $charArray[$i+3] * $charArray[$i+4];
            if($tempProduct > $product){
                $product = $tempProduct;
            }
        }

        //Calculating the Factorial of the max product.
        $productArray = str_split($product);
        $factorialSum = 0;

        foreach($productArray as $val){
            $factorialSum = $factorialSum + factorial($val);
        }

        return $factorialSum;
    }

    // Method to calculate the factorial of a value.
    function factorial($input){ 
        if($input <= 1){   
            return 1;   
        }   
        else{   
            return $input * factorial($input - 1);   
        }   
    } 

    //Method to find if the length is 1000 and has the right values in the string.
    function validateInputData($charArray){
        if(count($charArray) != 1000){
            return false;
        }else{
            foreach($charArray as $val){
                if(is_numeric($val) != true){
                    return false;
                }
            }
            return true;
        }
    }

    function tester(){
        echo "<br> <br> Tester Function: <br>";
        $correctLine = '7163626956188267042825248360082325753042075296345085861560789112949495459501737958331952853208805511657273330010533678812202354218097512545405947522435258490771167055601360483958644670632441572215539753697817977846174064955149290862569321978468622482839722413756570560574902614079729686524145351004748216637048440319989000889524345065854122758866688196983520312774506326239578318016984801869478851843125406987471585238630507156932909632952274430435576689664895044524452316173185640309871112172238311305886116467109405077541002256983155200055935729725164271714799244429282308634656748139191231628245861786645835912456652947654568284891288314260769004224219022671055626321111109370544217506941658960408071984038509624554443629812309878799272442849091888458015616609791913387549920052406368991256071760662229893423380308135336276614282806444486645238749731671765313306249192251196744265747423553491949343035890729629049156044077239071381051585930796086670172427121883998797908792274921901699720888093776';
        $lineWithDifferentDatatypeInBetween = 'b16M62695618826704282524a360082325753042075296345k85861560789112949495459501737958331952853208805511657273330010533678812202354218097512545405947522435258490771167055601360483958644670632441572215539753697817977846174064955149290862569321978468622482839722413756570560574902614079729686524145351004748216637048440319989000889524345065854122758866688196983520312774506326239578318016984801869478851843125406987471585238630507156932909632952274430435576689664895044524452316173185640309871112172238311305886116467109405077541002256983155200055935729725164271714799244429282308634656748139191231628245861786645835912456652947654568284891288314260769004224219022671055626321111109370544217506941658960408071984038509624554443629812309878799272442849091888458015616609791913387549920052406368991256071760662229893423380308135336276614282806444486645238749731671765313306249192251196744265747423553491949343035890729629049156044077239071381051585930796086670172427121883998797908792274921901699720888093776';
        $lineWithLengthLessThanThousand = '71636269561882677';

        if(validateInputData(str_split($correctLine)) != true){
            echo "Error: Data Invalid";
            echo "<br>";
        }else{
            // Giving out the Answer if everything is Correct.
            echo "Test 1: For Correct Data:  ";
            echo calculateProductAndFactorial(str_split($correctLine));
            echo "<br>";
        }
        if(validateInputData(str_split($lineWithDifferentDatatypeInBetween)) != true){
            echo "Test 2: For Incorrect Data with Datatypes other than numeric in between:  ";
            echo "Error: Data Invalid";
            echo "<br>";
        }else{
            // Giving out the Answer if everything is Correct.
            echo calculateProductAndFactorial(str_split($lineWithDifferentDatatypeInBetween));
            echo "<br>";
        }
        if(validateInputData(str_split($lineWithLengthLessThanThousand)) != true){
            echo "Test 3: For length less than thousand:  ";
            echo "Error: Data Invalid";
            echo "<br>";
            
        }else{
            // Giving out the Answer if everything is Correct.
            echo calculateProductAndFactorial(str_split($lineWithLengthLessThanThousand));
            echo "<br>";
        }

    }

    tester();


    echo "</body></html>";
?>