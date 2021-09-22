<?php
$fileName = "testFile.txt";
$fptr = fopen($fileName, "r");
// echo fgetc($fptr);
// echo fgetc($fptr);

// echo fgets($fptr); // also updated after using fgetc

// Read until a full stop is encountered

while($c = fgetc($fptr)){
    if($c == ".")
    break;
    echo $c;
}

fclose($fptr);
?>