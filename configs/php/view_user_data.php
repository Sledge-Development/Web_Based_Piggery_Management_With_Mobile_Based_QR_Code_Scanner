<?php

include "db.php";

$id = $connect->real_escape_string($_POST["id"]);
$sql = "select username,first_name,middle_name,last_name,phone_number,job from tbl_user where user_id=? and is_exist='true'";
$stmt = $connect->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows == 1) {
    echo json_encode(["code" => 200, "result_set" => $result->fetch_assoc()]);
} else {
    echo json_encode(["code" => 500, "message" => "Something went wrong.Please try again later."]);
}
