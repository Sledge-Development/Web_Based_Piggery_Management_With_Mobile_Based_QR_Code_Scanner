<?php
include "db.php";


$sql = "select count(batch_id) as batch_id,sow_id,boar_id from tbl_batch where is_exist='true'";
$stmt = $connect->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
echo json_encode($result->fetch_assoc());
