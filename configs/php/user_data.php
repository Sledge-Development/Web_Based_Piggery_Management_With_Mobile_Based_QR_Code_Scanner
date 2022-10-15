<?php

include "db.php";

$user_id = $connect->real_escape_string($_POST["user_id"]);
$sql = "select * from tbl_user where user_id=? and is_exist='true'";
$stmt = $connect->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows != 0) {
    while ($row = $result->fetch_assoc()) {
        echo json_encode([
            "code" => 200,
            "username" => $row["username"],
            "first_name" => $row["first_name"],
            "middle_name" => $row["middle_name"],
            "last_name" => $row["last_name"],
            "phone_number" => $row["phone_number"],
            "job" => $row["job"],
        ]);
    }
} else {
    echo json_encode(["code" => 500, "message" => "Something went wrong please try again later."]);
}
