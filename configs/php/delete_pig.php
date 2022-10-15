<?php

include "db.php";

$pig_id = $connect->real_escape_string($_POST["pig_id"]);

$sql = "update tbl_pigs set is_exist='false' where pig_id=? and is_exist='true'";
$stmt = $connect->prepare($sql);
$stmt->bind_param("s", $pig_id);
$stmt->execute();
if ($stmt->affected_rows == 1) {
    echo returner(200, "Pig information was removed from the record.");
} else {
    echo returner(500, "Something went wrong removing the pig information");
}
