<?php
include "db.php";


$sql = "select * from tbl_batch  where is_exist='true' order by batch_id desc";
$stmt = $connect->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows !== 0) {
    while ($row = $result->fetch_assoc()) {
        if (getTotalBatch($connect, $row["batch_id"]) <= $row["batch_max"]) {
            if ($row["sow_id"] == "" && $row["boar_id"] == "") {
                echo '<option class="data-batch" value="' . $row["batch_id"] . '">Breeder Batch</option>';
            } else {
                echo '<option class="data-batch" value="' . $row["batch_id"] . '">Batch ' . $row["batch_id"] . ',Max:' . $row["batch_max"] . '</option>';
            }
        }
    }
}
