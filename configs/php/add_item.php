<?php

include 'db.php';


try {
    $item_tag = $connect->real_escape_string($_POST["item_tag"]);
    $item_name = $connect->real_escape_string($_POST["item_name"]);
    $item_description = $connect->real_escape_string($_POST["item_description"]);
    $item_net_weight = $connect->real_escape_string($_POST["add_item_netweight"]);
    $add_item_quantity = $connect->real_escape_string($_POST["add_item_quantity"]);
    $add_item_unit = $connect->real_escape_string($_POST["add_item_unit"]);
    $sql = "INSERT INTO `piggerymanagement`.`tbl_inventory` (`item_id`, `item_name`, `item_description`, `item_quantity`, `item_net_weight`, `item_unit`) VALUES (?,?,?,?,?,?);";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("sssdds", $item_tag, $item_name, $item_description, $add_item_quantity, $item_net_weight, $add_item_unit);

    if ($stmt->execute()) {
        echo returner(200, "Item is added in the inventory.");
    } else {
        echo returner(500, "Something went wrong.");
    }
} catch (Exception $e) {
    if ($e->getCode() == 1062) {
        echo returner(500, "This item tag is already exist.");
    }
}

