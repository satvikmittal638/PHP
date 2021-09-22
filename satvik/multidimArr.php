<?php
// Dimension of an array is the required no of indices required to access its root elements
// 3D array
$arr = [
        [
            [1,2,3],[4,5,6]
        ],
        [
            [3,4,5], [4,6,6]
        ],
        [
            [4,4,3], [3,3,2]
        ]
    ];


for ($i=0; $i < count($arr); $i++) { 
    for ($j=0; $j < count($arr[$i]); $j++) { 
        for ($k=0; $k < count($arr[$i][$j]); $k++) { 
            echo $arr[$i][$j][$k]." ";
        }
        echo " ";
    }
    echo "<br>";
}

?>