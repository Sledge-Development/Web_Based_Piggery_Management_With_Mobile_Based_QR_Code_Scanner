<?php
include "db.php";
$sow = $connect->real_escape_string($_POST["sow"]);
$boar = $connect->real_escape_string($_POST["boar"]);
$batch_max = $connect->real_escape_string($_POST["batch_max"]);

$sql = "INSERT INTO `piggerymanagement`.`tbl_batch` (`sow_id`,`boar_id`,`batch_max`) VALUES (?,?,?);";
$stmt = $connect->prepare($sql);
$stmt->bind_param("ssi", $sow, $boar, $batch_max);
$result = $stmt->execute();
if ($result) {
    echo json_encode(["code" => 200, "message" => "New batch was added."]);
} else {
    echo json_encode(["code" => 500, "message" => "Something went wrong."]);
}
