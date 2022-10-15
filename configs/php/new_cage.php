<?php
include "db.php";

$cage_name = $connect->real_escape_string($_POST["cage_name"]);

$sql = "INSERT INTO `piggerymanagement`.`tbl_cage` (`cage_name`) VALUES (?);";

$stmt = $connect->prepare($sql);
$stmt->bind_param("s", $cage_name);
if ($stmt->execute()) {
   echo returner(200,"New cage was added.");
}else{
   echo returner(500,"Something went wrong!");
}
