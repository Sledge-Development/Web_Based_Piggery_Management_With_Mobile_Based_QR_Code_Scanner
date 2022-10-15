<?php

include "db.php";
$search = $connect->real_escape_string("%" . $_POST["keyword"] . "%");
$sql = "select * from tbl_pigs where pig_id like ? and is_exist='true'";
$stmt = $connect->prepare($sql);
$stmt->bind_param("s", $search);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows <= 0) {
    echo '<tr class="sow-data hover:bg-blue-500 w-full text-black cursor-pointer "><td class="text-black">No pig id found with keyword :' . explode("%", $search)[1] . '</td></tr>';
} else {
    while ($row = $result->fetch_assoc()) {
        echo '<tr onclick="load_sow(\'' . $row["pig_id"] . '\')" data="' . $row["pig_id"] . '" class="sow-data hover:bg-blue-500 w-full text-black cursor-pointer "><td class="text-black"> ' . $row["pig_id"] . '</td></tr>';
    }
}
