<?php
include 'db.php';
session_start();
$username = $connect->real_escape_string($_GET["username"]);
$password = $connect->real_escape_string($_GET["password"]);

$sql = "select * from tbl_user where username=? and is_exist='true'";

$stmt = $connect->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
    while ($row = $result->fetch_assoc()) {
        if (password_verify($password, $row["password"])) {
            $_SESSION["username"] = $row["username"];
            $_SESSION["user_id"] = $row["user_id"];
            $_SESSION["first_name"] = $row["first_name"];
            $_SESSION["middle_name"] = $row["middle_name"];
            $_SESSION["last_name"] = $row["last_name"];
            $_SESSION["job"] = $row["job"];
            setcookie("job", $row["job"], 0, "/");
            echo json_encode(["code" => 200, "message" => "Logged in successfully"]);
        } else {
            echo json_encode(["code" => 404, "message" => "Incorrect Username or Password"]);
        }
    }
} else {
    echo json_encode(["code" => 404, "message" => "Incorrect Username or Password"]);
}
