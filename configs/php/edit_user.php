<?php
include "db.php";

$username = $connect->real_escape_string($_POST["username"]);
$password = $connect->real_escape_string(password_hash($_POST["password"], PASSWORD_DEFAULT, array("cost" => 9)));
$first_name = $connect->real_escape_string($_POST["first_name"]);
$middle_name = $connect->real_escape_string($_POST["middle_name"]);
$last_name = $connect->real_escape_string($_POST["last_name"]);
$phone_number = $connect->real_escape_string($_POST["phone_number"]);
$job = $connect->real_escape_string($_POST["job"]);
$has_pass = $connect->real_escape_string($_POST["has_pass"]);
$user_id = $connect->real_escape_string($_POST["user_id"]);
if ($has_pass) {
    $sql = "UPDATE `piggerymanagement`.`tbl_user` SET `username`=?, `first_name`=?, `middle_name`=?, `last_name`=?, `phone_number`=?, `job`=? WHERE  `user_id`=?";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("sssssss", $username, $first_name, $middle_name, $last_name, $phone_number, $job, $user_id);
    $result = $stmt->execute();
    if ($result == 1) {
        echo json_encode(["code" => 200, "message" => "User details was updated successfully"]);
    } else {
        echo json_encode(["code" => 500, "message" => "Something went wrong~"]);
    }
} else {
    $sql = "UPDATE `piggerymanagement`.`tbl_user` SET `username`=?,`password`=?, `first_name`=?, `middle_name`=?, `last_name`=?, `phone_number`=?, `job`=? WHERE  `user_id`=?";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("ssssssss", $username, $password, $first_name, $middle_name, $last_name, $phone_number, $job, $user_id);
    $result = $stmt->execute();
    if ($result == 1) {
        echo json_encode(["code" => 200, "message" => "User details was updated successfully"]);
    } else {
        echo json_encode(["code" => 500, "message" => "Something went wrong~"]);
    }
}
