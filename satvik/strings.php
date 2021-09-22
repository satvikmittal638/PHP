<?php
$mystr = "  Hey I am PHP, try using me !!  ";

echo strlen($mystr);
echo "<br>";

echo strpos($mystr, "I");
echo "<br>";

echo strrev($mystr);
echo "<br>";

echo str_replace("PHP", "CPP", $mystr);
echo "<br>";

// pre tag keeps the text as it is
echo "<pre>";
echo ltrim($mystr);
echo "</pre>";

echo "<br>";

echo "<pre>";
echo rtrim($mystr);
echo "</pre>";

echo "<br>";
echo str_word_count($mystr);

// . is a concatenation operator
?>