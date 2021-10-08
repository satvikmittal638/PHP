<?php
$fileName = "testFile.txt";
// readfile($fileName);
$fptr = fopen($fileName, "r");
$content = fread($fptr, filesize($fileName));
if(fclose($fptr)){
    echo "Closed the file successfully<br>";
}
echo $content;
?>