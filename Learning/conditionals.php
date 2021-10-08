<?php
$age = 66;
// all statements skipped after any step out of the if-else ladder is executed
if($age < 25){
    echo "You cannot drive";
}
elseif($age > 65){
    echo "You are too old to drive, so don't try";
}
else{
    echo "You are free to drive";
}
echo "<br>";
?>


<?php


$marks = 4;
$maxMarks = 10;

// Switch statement executes all code blocks after a case is matched, so break is needed
switch(true){

    case $marks == $maxMarks:
        echo  "Topper !";
        break;
    case $marks >= $maxMarks/2:
        echo "Average";
        break;
    default:
        echo "Failure"; 
        break;        
}
echo "<br>End of program";
?>