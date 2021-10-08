<?php

// $fptr = fopen("testFile2.txt", "w"); // empties the whole file if write mode is used
// fwrite($fptr, "Hello I am being written to this file");

$fptr = fopen("testFile2.txt", "a"); // keeps the file content if opened in append mode

fwrite($fptr, "I am appended to this file");




?>