<?php

include "db.php";
session_start();
$user_id = $connect->real_escape_string($_POST["user_id"]);
if ($user_id == $_SESSION["user_id"]) {
    echo json_encode(["code" => 201, "message" => "You cant delete your own account."]);
    return 0;
}

$sql1 = "select count(user_id) as total from tbl_user where is_exist='true' and job='owner' ";
$stmt1 = $connect->prepare($sql1);
$stmt1->execute();
$result = $stmt1->get_result();

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    if ($row["total"] >= 1) {
        $sql = "UPDATE `piggerymanagement`.`tbl_user` SET `is_exist`='false' WHERE  `user_id`=? and is_exist='true'";
        $stmt = $connect->prepare($sql);
        $stmt->bind_param("s", $user_id);
        $result = $stmt->execute();
        if ($result == 1) {
            echo json_encode(["code" => 200, "message" => "User was removed from server!"]);
        } else {
            echo json_encode(["code" => 500, "message" => "Something went wrong!"]);
        }
    } else {
        echo json_encode(["code" => 204, "message" => "You can not delete this user. Atleast one administrator account is required for this system."]);
    }
} else {
    echo json_encode(["code" => 500, "message" => "Something went wrong!"]);
}
