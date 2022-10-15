<?php
//error_reporting(0);
include "general_function.php";
$host = "localhost";
$password = "";
$username = "root";
$port = "3306";
$db_name = "piggerymanagement";

$connect = mysqli_connect($host, $username, $password, $db_name, $port); //or die(mysqli_connect_error());
//echo password_hash("admin", PASSWORD_DEFAULT, array("cost" => 9));