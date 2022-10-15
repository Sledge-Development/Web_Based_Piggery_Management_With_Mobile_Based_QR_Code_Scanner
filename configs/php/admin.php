<?php
include "db.php";

$username = $connect->real_escape_string($_POST["username"]);
$password = $connect->real_escape_string(password_hash($_POST["password"], PASSWORD_DEFAULT, array("cost" => 9)));
$first_name = $connect->real_escape_string($_POST["first_name"]);
$middle_name = $connect->real_escape_string($_POST["middle_name"]);
$last_name = $connect->real_escape_string($_POST["last_name"]);
$phone = $connect->real_escape_string($_POST["phone"]);
$job="owner";
try {

    $sql = "INSERT INTO `piggerymanagement`.`tbl_user` ( `username`, `password`, `first_name`, `middle_name`, `last_name`, `phone_number`, `job`) VALUES (?,?,?,?,?,?,'owner');";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("ssssss", $username, $password, $first_name, $middle_name, $last_name, $phone,$job);
    $result = $stmt->execute();
    if ($result == 1) {
        echo json_encode(["code" => 200, "message" => "Admin account created. Redirecting to login page..."]);
    } else {
        echo json_encode(["code" => 500, "message" => "Something went wrong creating adminstrator account!"]);
    }
} catch (Exception $e) {
    if ($e->getCode() == 1062) {
        echo json_encode(["code" => 1062, "message" => "Username is not available."]);
    }
}
