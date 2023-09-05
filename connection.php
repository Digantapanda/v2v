<?php
$servername = "localhost";
$usernam = "root";
$password = "";
$db="v2v";
$con = mysqli_connect($servername, $usernam, $password, $db);
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}


?>
