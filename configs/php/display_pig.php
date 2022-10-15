<?php
include "db.php";
$sql = "SELECT * FROM tbl_pigs LEFT JOIN tbl_breed ON tbl_pigs.breed=tbl_breed.breed_id LEFT JOIN tbl_cage ON tbl_pigs.cage_id=tbl_cage.cage_id LEFT JOIN tbl_batch ON  tbl_pigs.batch_id = tbl_batch.batch_id WHERE  tbl_pigs.is_exist='true'  ";
$stmt = $connect->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows >= 1) {
    while ($row = $result->fetch_assoc()) {
        echo '<tr data="' . $row["pig_id"] . '" class="pig-data cursor-pointer table_row_record_details">' .
            '<td>' . $row["pig_id"] . '</td>' .
            '<td>' . $row["pig_tag"] . '</td>' .
            '<td>' . $row["breed_name"] . '</td>' .
            '<td>' . $row["birthdate"] . '</td>' .
            '<td class="text-center">' .
            '<span id="edit_01" class="w-full mx-auto my-auto hover:text-blue-500" onclick="edit_pig_details(\''.$row["pig_id"].'\')">Edit</span>' .
            '|' .
            ' <span class="w-full mx-auto my-auto hover:text-blue-500" id="delete_01" onclick="remove_pig_details(\''.$row["pig_id"].'\')">Delete</span>' .
            '</td>' .
            '</tr>';
    }
} else {
    echo '<tr class="cursor-pointer table_row_record_details">' .
        '<td colspan="5">No data can be loaded at the moment.</td>' .
        '</tr>';
}
