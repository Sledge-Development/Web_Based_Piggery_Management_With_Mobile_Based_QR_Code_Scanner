<?php
include "db.php";
$sql = "select * from tbl_inventory where is_exist='true'";
$stmt = $connect->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows !== 0) {
    while ($row = $result->fetch_assoc()) {
        echo  '<tr data="' . $row["item_tag"] . '" class="cursor-pointer table_row_record_details">' .
            '<td>' . $row["item_tag"] . '</td>' .
            '<td>' . $row["item_name"] . '</td>' .
            '<td>' . $row["item_quantity"] . '</td>' .
            '<td class="text-center flex flex-row "><span id="edit_01" class=" my-auto hover:text-blue-500" onclick="edit_item_detail(\'' . $row["item_tag"] . '\')">Edit</span>' .
            '|' .
            '<span id="edit_01" class=" my-auto hover:text-blue-500" onclick="remove_item_detail(\'' . $row["item_tag"] . '\')">Delete</span>' .
            '</td>' .
            '</tr>';
    }
} else {
    echo '<tr class="cursor-pointer table_row_record_details">' .
        '<td colspan="4">No data can be loaded . Add new items first.</td>' .
        '</tr>';
}
