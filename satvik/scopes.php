<?php
$a = 10;
$b=20;


// changeVar(1,2);


function changeVar($a, $b){
    echo "Arguments:".$a." ".$b."<br>";
    global $a, $b;
    // now global vars will be used and we can't use arguments 😥
    echo "Global:".$a." ".$b; 
}

var_dump($GLOBALS); // gets all global scope variables


?>