<?php
include "db.php";
$pig_id = $connect->real_escape_string($_POST["pig_id"]);
$pig_tag = $connect->real_escape_string($_POST["edit_pig_tag"]);
$pig_weight = $connect->real_escape_string($_POST["edit_weight"]);
$pig_breed = $connect->real_escape_string($_POST["edit_breed"]);
$pig_birthdate = $connect->real_escape_string($_POST["edit_birthdate"]);
$pig_batch = $connect->real_escape_string($_POST["edit_batch"]);
$pig_cage = $connect->real_escape_string($_POST["edit_cage"]);
$gender = $connect->real_escape_string($_POST["edit_gender"]);

$sql = "UPDATE `piggerymanagement`.`tbl_pigs` SET `pig_tag`=?, `weight`=?, `breed`=?, `birthdate`=?, `batch_id`=?, `cage_id`=?, `gender`=? WHERE  `pig_id`=? and is_exist='true';";
$stmt = $connect->prepare($sql);
$stmt->bind_param("ssisiiss", $pig_tag, $pig_weight, $pig_breed, $pig_birthdate, $pig_batch, $pig_cage, $gender, $pig_id);

if ($stmt->execute()) {
    echo returner(200, "Pig information was updated successfully");
} else {
    echo returner(500, "Something went wrong updating pig information");
}
