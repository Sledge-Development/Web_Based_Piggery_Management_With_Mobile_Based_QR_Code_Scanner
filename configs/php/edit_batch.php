<?php
include "db.php";

$batch_id = $connect->real_escape_string($_POST["batch_id"]);
$sow_id = $connect->real_escape_string($_POST["sow"]);
$boar_id = $connect->real_escape_string($_POST["boar"]);

$sql = "UPDATE `piggerymanagement`.`tbl_batch` SET `sow_id`=?, `boar_id`=? WHERE  `batch_id`=?;";
$stmt = $connect->prepare($sql);
$stmt->bind_param("ssi", $sow_id, $boar_id, $batch_id);
$stmt->execute();
if ($stmt->affected_rows == 1) {
    echo returner(200, "Batch details updated successfully.");
} else {
    echo returner(500, "Something went wrong. Please try again later.");
}
