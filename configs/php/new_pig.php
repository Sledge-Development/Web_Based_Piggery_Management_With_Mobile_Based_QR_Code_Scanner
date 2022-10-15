<?php

include 'db.php';



$pig_id = $connect->real_escape_string($_POST["pig_id"]);
$pig_tag = $connect->real_escape_string($_POST["pig_tag"]);
$weight = $connect->real_escape_string($_POST["weight"]);
$breed = $connect->real_escape_string($_POST["breed"]);
$birthday = date_create($connect->real_escape_string($_POST["birthdate"]));
$bday = date_format($birthday, "Y-m-d");
$batch = $connect->real_escape_string($_POST["batch"]);
$cage = $connect->real_escape_string($_POST["cage"]);
$sow = $connect->real_escape_string($_POST["sow"]);
$boar = $connect->real_escape_string($_POST["boar"]);
$gender=$connect->real_escape_string($_POST["gender"]);
try {
    $sql = "INSERT INTO `piggerymanagement`.`tbl_pigs` (`pig_id`, `pig_tag`, `weight`, `breed`, `birthdate`, `batch_id`, `cage_id`,`gender`) VALUES (?,?,?,?,?,?,?,?);";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("sisisiis", $pig_id, $pig_tag, $weight, $breed, $bday, $batch, $cage,$gender);
    if ($stmt->execute()) {
        echo json_encode(["code" => 200, "message" => "New pig details was added."]);
    } else {
        echo json_encode(["code" => 500, "message" => "Something went wrong."]);
    }
} catch (Exception $e) {
    echo json_encode(["code" => $e->getCode(), "message" => $e->getMessage()]);
}
