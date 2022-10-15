<?php

include "db.php";

$cage_id = $connect->real_escape_string($_POST["cage_id"]);
$cage_name = $connect->real_escape_string($_POST["cage_name"]);

$sql = "UPDATE `piggerymanagement`.`tbl_cage` SET `cage_name`=? WHERE  `cage_id`=?;";
$stmt = $connect->prepare($sql);
$stmt->bind_param("si", $cage_name, $cage_id);
$stmt->execute();
if ($stmt->affected_rows == 1) {
    echo  returner(200, "Cage name was updated succesfully.");
} else {
    echo returner(500, "Something went wrong.Please try again later.");
}
