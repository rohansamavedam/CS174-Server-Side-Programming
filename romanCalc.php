<!-- Krishna Rohan Samavedam, CS174 HW2 -->

<?php
    // Function to FIND the numerical value of the Roman Numeral.
    function valueOfRoman($input){
        $roman_map = array(
            "I" => 1,
            "V" => 5,
            "X" => 10,
            "L" => 50,
            "C" => 100,
            "D" => 500,
            "M" => 1000
        );
        return $roman_map[$input];
    }

    // Function to CALCULATE the numerical value of the Roman Numeral.
    function romanCalc($input){
        $convertedValue;

       for($i = 0; $i < strlen($input); $i++){
            $valueOne = valueOfRoman($input[$i]);
            if($i + 1 < strlen($input)){
                $valueTwo = valueOfRoman($input[$i + 1]);

                if($valueOne >= $valueTwo){
                    $convertedValue += $valueOne;
                }else{
                    $convertedValue += $valueTwo - $valueOne;
                    $i++;
                }
            }else{
                $convertedValue += $valueOne;
                $i++;
            }

       }

       return $convertedValue;
    }

    // Base function to CALCULATE the numerical value of Roman Numeral Entered, Handles the Errors and Calls the romanCalc() function.
    function convertFromRomanToModern($str){
        if(gettype($str) != "string"){
            return "Invalid Roman Numeral Entered <br>";
        }

        $input = strtoupper($str);
        $charArray = str_split($input);

        foreach($charArray as $char){
            if(!valueOfRoman($char)){
                return "Invalid Roman Numeral Entered <br>";
            }
        }

        return romanCalc($input);
    }

    function romanTester(){
        if(convertFromRomanToModern('VI') == 6){
            echo " VI = 6 <br>";
            echo "Test Passed <br>";
        }else{
            echo "Test Failed <br>";
        }

        if(convertFromRomanToModern('IV') == 4){
            echo " IV = 4 <br>";
            echo "Test Passed <br>";
        }else{
            echo "Test Failed <br>";
        }

        if(convertFromRomanToModern('MCMXC') == 1990){
            echo " MCMXC = 1990 <br>";
            echo "Test Passed <br>";
        }else{
            echo "Test Failed <br>";
        }

        if(convertFromRomanToModern('IX') == 9){
            echo " IX = 9 <br>";
            echo "Test Passed <br>";
        }else{
            echo "Test Failed <br>";
        }
    }

    function errorTester(){
        // Testing with input other than roman numerals 
        echo convertFromRomanToModern('2344');

        // Testing with alphabets that are not roman numerals
        echo convertFromRomanToModern('LLP');

        // Testing with different Data Types other than Strings
        echo convertFromRomanToModern(True);
        echo convertFromRomanToModern(123);
    }


    // Tester Function Calls
    romanTester();
    errorTester();
    
?>