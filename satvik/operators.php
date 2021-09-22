<?php

$a = 8;
$b=10;

echo "$a to power $b is ".($a**$b);
echo "<br>";

$a**=$b;
echo "After change value of a is ".$a;
echo "<br>";

echo var_dump($b==1); // no value is printed without var_dump if the result is false
echo var_dump($a<>$b); // same as !=
echo "<br>";
echo var_dump(true && false);
?>