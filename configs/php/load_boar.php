<?php

include "db.php";
$search = $connect->real_escape_string("%" . $_POST["keyword"] . "%");
$action = $connect->real_escape_string($_POST["action"]);
$sql = "select * from tbl_pigs where pig_id like ? and is_exist='true'";
$stmt = $connect->prepare($sql);
$stmt->bind_param("s", $search);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows <= 0) {
    echo '<tr class="boar-data hover:bg-blue-500 w-full text-black cursor-pointer "><td class="text-black">No pig id found with keyword :' . explode("%", $search)[1] . '</td></tr>';
} else {
    while ($row = $result->fetch_assoc()) {
        echo '<tr onclick="load_boar(\'' . $row["pig_id"] . '\',\'' . $action . '\');" data="' . $row["pig_id"] . '" class="boar-data hover:bg-blue-500 w-full text-black cursor-pointer "><td class="text-black"> ' . $row["pig_id"] . '</td></tr>';
    }
}
