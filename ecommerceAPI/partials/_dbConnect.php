<?php
$host = "localhost";
$user = "root";
$pwd = "";
$database = "";


$conn = mysqli_connect($host,$user, $pwd, $database);
header("Content-Type: application/json");
if(!$conn){
    $response['connection'] = mysqli_error($conn);
    http_response_code(502);
}
?>