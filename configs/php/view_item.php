<?php
include "db.php";

$id = $connect->real_escape_string($_GET["id"]);

$sql = "Select * from tbl_inventory where item_tag=? and is_exist='true'";
$stmt = $connect->prepare($sql);
$stmt->bind_param("s", $id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows !== 0) {
    $row = $result->fetch_assoc();
    echo returner(200, $row);
} else {
    echo returner(404, "Cannot find item details associated with item tag " . $id . ".");
}
