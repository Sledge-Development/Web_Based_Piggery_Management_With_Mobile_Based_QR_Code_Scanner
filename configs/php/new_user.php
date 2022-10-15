<?php
include "db.php";

$username = $connect->real_escape_string($_POST["username"]);
$password = $connect->real_escape_string(password_hash($_POST["password"], PASSWORD_DEFAULT, array("cost" => 9)));
$first_name = $connect->real_escape_string($_POST["first_name"]);
$middle_name = $connect->real_escape_string($_POST["middle_name"]);
$last_name = $connect->real_escape_string($_POST["last_name"]);
$phone_number = $connect->real_escape_string($_POST["phone_number"]);
$job = $connect->real_escape_string($_POST["job"]);

try {
    $sql = "INSERT INTO `piggerymanagement`.`tbl_user` (`username`, `password`, `first_name`, `middle_name`, `last_name`, `phone_number`,`job`) VALUES (?, ?, ?, ?, ?, ?,?);";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("sssssss", $username, $password, $first_name, $middle_name, $last_name, $phone_number, $job);
    if ($stmt->execute() == 1) {
        echo json_encode(["code" => 200, "message" => "New user is added to the system"]);
    } else {
        echo json_encode(["code" => 500, "message" => "Something went wrong. Please try again later!"]);
    }
} catch (Exception $e) {
    if ($e->getCode() == 1062) {
        echo json_encode(["code" => 1062, "message" => "Username is already taken."]);
    }
}
