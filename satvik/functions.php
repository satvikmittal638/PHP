<?php
function avgArr($arr){
    $sum=0;
    foreach($arr as $ind => $value)
        $sum += $value;
    return $sum/($ind + 1);
}

echo avgArr([1,2,3]);
?>