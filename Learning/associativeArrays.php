<?php
$powers = [
"Batman" => "Kick",
"Superman" => "Punch",
"Iron Man"=> "Brains",
1 => "test" // numeric values can be used as keys
];

foreach($powers as $key=> $value)
    echo "$key has $value power <br>";

?>
