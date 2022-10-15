<?php

include "db.php";
$sql = "select * from tbl_cage where is_exist='true';";
$stmt = $connect->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows >= 1) {
    while ($row = $result->fetch_assoc()) {
        echo '<tr class="cage-data cursor-pointer table_row_record_details">' .
            '<td>' . $row["cage_id"] . '</td>' .
            '<td>' . $row["cage_name"] . '</td>' .
            '<td>' . getTotal($connect, $row["cage_id"]) . '</td>' .
            '<td class="text-center flex flex-row">' .
            '<span id="edit_01" class="my-auto hover:text-blue-500" onclick="edit_pig_details(\'' . $row["cage_id"] . '\',\'' . $row["cage_name"] . '\')">Edit</span>' .
            '</tr>';
    }
} else {
    echo '<tr class="cage-data cursor-pointer table_row_record_details">' .
        '<td colspan="4">No data found...</td>' .
        '</tr>';
}