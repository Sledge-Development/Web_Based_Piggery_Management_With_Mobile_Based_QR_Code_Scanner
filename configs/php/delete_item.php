<?php

include "db.php";

$item_tag = $connect->real_escape_string($_POST["item_tag"]);

$sql = "update tbl_inventory set is_exist='false' where item_tag=? and is_exist='true'";
$stmt = $connect->prepare($sql);
$stmt->bind_param("s", $item_tag);
$stmt->execute();
if ($stmt->affected_rows == 1) {
    echo returner(200, "Pig information was removed from the record.");
} else {
    echo returner(500, "Something went wrong removing the pig information");
}
