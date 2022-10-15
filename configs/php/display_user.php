<?php
include "db.php";
$sql = "select * from tbl_user where is_exist='true'";
$stmt = $connect->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows != 0) {
    while ($row = $result->fetch_assoc()) {
        echo ' <tr data="' . $row["user_id"] . '" class="user-data cursor-pointer table_row_record_details">' .
            '   <td>' . $row["username"] . '</td>'
            .  '<td>' . $row["first_name"] . '</td>'
            .  '<td>' . $row["middle_name"] . '</td>'
            .  '<td>' . $row["last_name"] . '</td>'
            .  '<td>' . $row["phone_number"] . '</td>'
            .  '<td>' . $row["job"] . '</td>'
            .   '<td class="text-center grid grid-cols-3"><span id="edit_01" class="w-full mx-auto my-auto hover:text-blue-500" onclick="edit_operation_details(\'' . $row["user_id"] . '\')">Edit</span> | <span class="w-full mx-auto my-auto hover:text-blue-500" id="delete_01" onclick="remove_operation_details(\'' . $row["user_id"] . '\')">Delete</span></td>'
            . '</tr>';
    }
} else {
    echo ' <tr class="user-data cursor-pointer table_row_record_details">' .
        '<td colspan="7">No data on here yet...</td>' .
        '</tr>';
}
