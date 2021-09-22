<?php
// While loop
$i=0;

while($i<10){
    echo ($i*$i)."<br>";
    $i++;
}

echo "<br><br>";
?>

<?php
// For loop
$row = 5;
for ($i=1; $i <= $row; $i++) { 
    for ($j=1; $j <= $i; $j++) { 
        echo "*";
    }
    echo "<br>";
}
?>


<?php
// for-each loops
$arr = array("A", "B", 'C', "D");


// for ($i=0; $i < count($arr); $i++) { 
//     echo $arr[$i]."<br>";
// }

// With enumeration
foreach ($arr as $index => $value) {
    echo "Value at $index is $value<br>";
}
// Without enumeration
foreach ($arr as $item) {
    echo $item."<br>";
}

?>