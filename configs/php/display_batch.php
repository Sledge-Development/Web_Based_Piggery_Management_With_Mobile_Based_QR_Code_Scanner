<?php
include "configs/php/db.php";
$sql = "select * from tbl_batch where is_exist='true' and boar_id!='NULL' and sow_id!='NULL'";
$stmt = $connect->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows >= 1) {
    while ($row = $result->fetch_assoc()) {
        echo ' <tr class="batch-data cursor-pointer table_row_record_details">' .
            ' <td>' . $row["batch_id"] . '</td>' .
            '<td>' . $row["boar_id"] . '</td>' .
            '<td>' . $row["sow_id"] . '</td>' .
            '<td class="text-center grid grid-cols-3">' .
            '<span id="edit_01" class="w-full mx-auto my-auto hover:text-blue-500" onclick="edit_pig_details(\'' . $row["batch_id"] . '\',\'' . $row["boar_id"] . '\',\'' . $row["sow_id"] . '\')">Edit</span>' .
            '</td>' .
            '</tr>';
    }
} else {
    echo ' <tr class="cursor-pointer table_row_record_details">' .
        ' <td colspan="4">No data found here...</td>' .
        '</tr>';
}
