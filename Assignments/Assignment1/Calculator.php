<?php
    class Calculator{
        
        public function __construct(){
        $operator="";
        $num1=0.0;
        $num2=0.0;
        $answer=0.0;
        }


        public function calc($operator, $num1, $num2){  
                if(!isset($operator)||!isset($num1)||!isset($num2)){
                    die("Cannot perform operation. You must have three arguments. A string for the operator (+,-,*,/) and two integers or floats for the numbers.");
                }
                if (gettype($num1)!="integer"||gettype($num1)!="double"||gettype($num2)!="integer"||gettype($num2)!="double"){
                    die("Cannot perform operation. You must have three arguments. A string for the operator (+,-,*,/) and two integers or floats for the numbers.");
                }

                if ($operator==="+"){
                    $answer=$num1+$num2;
                    return "The calculation is ".$num1.$operator.$num2.". The answer is ".$answer.".";
                } elseif ($operator==="*"){
                    $answer=$num1*$num2;
                    return "The calculation is ".$num1.$operator.$num2.". The answer is ".$answer.".";
                } elseif ($operator==="-"){
                    $answer=$num1-$num2;
                    return "The calculation is ".$num1.$operator.$num2.". The answer is ".$answer.".";
                } elseif ($operator==="/"){
                    $answer=$num1/$num2;
                    return "The calculation is ".$num1.$operator.$num2.". The answer is ".$answer.".";
                } else {
                    return "Cannot perform operation. You must have three arguments. A string for the operator (+,-,*,/) and two integers or floats for the numbers.";
                }

        }
    }
?>
