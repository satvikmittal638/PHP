<?php
$server = "localhost";
$uname = "root";
$pwd = "";
$db = "users";

$conn = mysqli_connect($server, $uname, $pwd, $db);


if(!$conn){
    die("Sorry we are having some trouble connecting");
}
?>