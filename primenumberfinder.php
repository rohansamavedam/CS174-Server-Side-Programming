<?php
   function prime_function($input){
       $answer = "";
       
       if($input <= 1){
           return $answer;
       }

       for($i = 2; $i <= $input; $i++){
           if(is_prime($i) == TRUE){
               $answer = $answer . $i . ", ";
           }
       }

       //Trimming the extra comma and space that have been concated in the loop above.
       $answer = rtrim($answer, ', '); 

       return $answer;
   }

   function is_prime($value){
        for($i = 2; $i < $value; $i++){
            if($value % $i == 0){
                return FALSE;
            }
        }
        return TRUE;
   }

   function tester_function(){
       if(prime_function(10) == "2, 3, 5, 7"){
           echo "TEST PASSED";
           echo "<br/>";
           echo prime_function(10);
           echo "<br/>";
       }else{
           echo "TEST FAILED";
       }

       if(prime_function(0) == ""){
            echo "TEST PASSED";
            echo "<br/>";
            echo prime_function(0);
            echo "<br/>";
        }else{
            echo "TEST FAILED";
        }  
   }

   function tester_function_two($test_input){
        echo prime_function($test_input);    
   }

   tester_function();
   tester_function_two(10);
?>