<?php
include "db.php";
$sow = $connect->real_escape_string($_POST["sow"]);
$boar = $connect->real_escape_string($_POST["boar"]);

$sql = "INSERT INTO `piggerymanagement`.`tbl_batch` (`sow_id`,`boar_id`) VALUES (?,?);";
$stmt = $connect->prepare($sql);
$stmt->bind_param("ss", $sow, $boar);
$result = $stmt->execute();
if ($result) {
    echo json_encode(["code" => 200, "message" => "New batch was added."]);
} else {
    echo json_encode(["code" => 500, "message" => "Something went wrong."]);
}
