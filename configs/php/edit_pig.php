<?php
include "db.php";
$pig_id = $connect->real_escape_string($_POST["pig_id"]);
$sql = "SELECT * FROM tbl_pigs LEFT JOIN tbl_breed ON tbl_pigs.breed=tbl_breed.breed_id LEFT JOIN tbl_cage ON tbl_pigs.cage_id=tbl_cage.cage_id LEFT JOIN tbl_batch ON  tbl_pigs.batch_id = tbl_batch.batch_id WHERE  tbl_pigs.is_exist='true'  and tbl_pigs.pig_id=?";
$stmt = $connect->prepare($sql);
$stmt->bind_param("s", $pig_id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    echo returner(200, $row);
} else {
    echo returner(404, "Something went wrong . Cannot find pig with pig id :" . $pig_id);
}
