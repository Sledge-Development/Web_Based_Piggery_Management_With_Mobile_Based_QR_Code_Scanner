<?php

include "db.php";

$item_tag = $connect->real_escape_string($_POST["id"]);

$sql = "select * from tbl_inventory where item_tag=? and is_exist='true'";
$stmt = $connect->prepare($sql);
$stmt->bind_param("s", $item_tag);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows !== 0) {
    $row = $result->fetch_assoc();
    echo returner(200, $row);
} else {
    echo returner(404, "Item details not found . Please try again.");
}
