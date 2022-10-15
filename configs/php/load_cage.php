<?php

include "db.php";

$sql = "select * from tbl_cage where is_exist='true'";
$stmt = $connect->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows <= 0) {
    echo json_encode(["code" => 404, "message" => "No breed data yet. Please add new breeds first."]);
} else {
    while ($row = $result->fetch_assoc()) {
        echo '<option class="cage-data" value="' . $row["cage_id"] . '">' . $row["cage_name"] . '</option>';
    }
}
