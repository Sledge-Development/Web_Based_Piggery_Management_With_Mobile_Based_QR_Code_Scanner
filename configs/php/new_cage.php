<?php
include "db.php";

$cage_name = $connect->real_escape_string($_POST["cage_name"]);
$cage_max=$connect->real_escape_string($_POST["cage_max"]);
$sql = "INSERT INTO `piggerymanagement`.`tbl_cage` (`cage_name`,`cage_max`) VALUES (?,?);";

$stmt = $connect->prepare($sql);
$stmt->bind_param("sd", $cage_name,$cage_max);
if ($stmt->execute()) {
   echo returner(200,"New cage was added.");
}else{
   echo returner(500,"Something went wrong!");
}
