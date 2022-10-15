<?php
include "db.php";
$item_tag = $connect->real_escape_string($_POST["item_tag"]);
$item_name = $connect->real_escape_string($_POST["item_name"]);
$item_description = $connect->real_escape_string($_POST["item_description"]);

$sql = "update tbl_inventory set item_name=?,item_description=? where item_tag=? and is_exist='true';";
$stmt = $connect->prepare($sql);
$stmt->bind_param("sss", $item_name, $item_description, $item_tag);
if ($stmt->execute()) {
    echo returner(200, "Item detail was updated successfully.");
} else {
    echo returner(500, "Something went wrong updating item details.");
}
