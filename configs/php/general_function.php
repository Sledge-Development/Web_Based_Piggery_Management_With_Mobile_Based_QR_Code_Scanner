<?php
function generateUid()
{
    $list = "abcdefghijkmnopqstuvwxyz1234567890";
    $uid = "";
    $split = str_split($list, 1);
    for ($i = 0; $i < 1; $i++) {
        for ($c = 0; $c < 64; $c++) {
            $ran = rand(0, 33);
            $uid = $uid . "" . $split[$ran];
        }
    }
    return $uid;
}
function returner($code, $message)
{
    return json_encode(["code" => $code, "message" => $message]);
}
function getTotalCage($connect, $id)
{
    $sql = "select count(cage_id) as total_pig from tbl_pigs where is_exist='true' and cage_id=?";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row["total_pig"];
}
function getTotalBatch($connect, $id)
{
    $sql = "select count(batch_id) as total_pig from tbl_pigs where is_exist='true' and batch_id=?";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row["total_pig"];
}
function generatePigUid()
{
    $list = "abcdefghijkmnopqstuvwxyz1234567890";
    $uid = "";
    $split = str_split($list, 1);
    for ($i = 0; $i < 1; $i++) {
        for ($c = 0; $c < 6; $c++) {
            $ran = rand(0, 33);
            $uid = $uid . "" . $split[$ran];
        }
    }
    return $uid;
}
function returnDate()
{
    date_default_timezone_set('Asia/Manila');
    $date = new DateTime();
    $date = $date->format("d-m-Y H:i:s");
    return $date;
}

function jwt($randomString)
{
    $token = hash("sha256", $randomString);
    $_SESSION['token'] = $token;
    return $token;
}

function jwt_verify($token)
{
    if ($token == $_SESSION['token']) {
        return true;
    } else {
        return false;
    }
}

function checkDuplicateItem($connect, $userid, $productid)
{
    $sql = "select * from items_list where USER_ACCOUNT_ID=? AND ITEM_ID=? AND ITEM_EXIST='true'";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("ss", $userid, $productid);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows == 0) {
        return true;
    } else {
        return false;
    }
}


function getTotalPrice($quantity, $item_price)
{
    return $quantity * $item_price;
}

function idStripper($item_id)
{
    $data =  explode(":", $item_id);
    return $data[0];
}

function checkPassword($connect, $password, $user_id)
{
    $sql = "select * from accounts where USER_ID=?  AND IS_EXIST='true'";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("s", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["PASSWORD"])) {
            return 200;
        } else {
            return 401;
        }
    } else {
        return 404;
    }
}






function MenuRender($full_name)
{
    return '<div class="h-auto flex flex-col text-white overflow-y-auto no-scroll w-1/6 bg-gray-500">'
        . '<div class="w-full h-12  flex flex-row text-center text-sm ">'
        . '<img class="h-12 ml-2 w-12 " src="assets/icons/user_icon.png">'
        . '<h1 class="my-auto ml-4">Welcome ' . $full_name . '</h1>'
        . '</div>'
        . '<div class="w-full ">'
        . '<h1>Menu</h1>'
        . '</div>'
        . '<div id="dashboard" class="w-full flex p-2 flex-row cursor-pointer text-white hover:bg-gray-600 text-center h-12 bg-gray-500 ">'
        . '<img class="w-8 h-8 my-auto ml-2 mr-4" src="assets/icons/dashboard_users.png" alt="">'
        . '<h1 class="mt-auto mb-auto text-sm mr-auto ml-0">Dashboard</h1>'
        . '</div>'
        . '<div id="user_management" class="w-full flex p-2 flex-row cursor-pointer text-white hover:bg-gray-600 text-center h-12 bg-gray-500 ">'
        . '<img class="w-8 h-8 my-auto ml-2 mr-4" src="assets/icons/user_management.png" alt="">'
        . '<h1 class="mt-auto mb-auto text-sm mr-auto ml-0">User Management</h1>'
        . '</div>'
        . '<div id="pig_management" class="w-full flex p-2 flex-row cursor-pointer text-white hover:bg-gray-600 text-center h-12 bg-gray-500 ">'
        . '<img class="w-8 h-8 my-auto ml-2 mr-4" src="assets/icons/pig_management.png" alt="">'
        . '<h1 class="mt-auto mb-auto text-sm mr-auto ml-0">Pig Management</h1>'
        . '</div>'
        . '<div id="inventory_management" class="w-full flex p-2 flex-row cursor-pointer text-white hover:bg-gray-600 text-center h-12 bg-gray-500 ">'
        . '<img class="w-8 h-8 my-auto ml-2 mr-4" src="assets/icons/inventory_management.png" alt="">'
        . '<h1 class="mt-auto mb-auto text-sm mr-auto ml-0">Inventory Management</h1>'
        . '</div>'
        . '<div id="purchase_request" class="w-full flex p-2 flex-row cursor-pointer text-white hover:bg-gray-600 text-center h-12 bg-gray-500 ">'
        . '<img class="w-8 h-8 my-auto ml-2 mr-4" src="assets/icons/purchase_request.png" alt="">'
        . '<h1 class="mt-auto mb-auto text-sm mr-auto ml-0">Purchase Request</h1>'
        . '</div>'
        . '<div id="scheduling_management" class="w-full flex p-2 flex-row cursor-pointer text-white hover:bg-gray-600 text-center h-12 bg-gray-500 ">'
        . '<img class="w-8 h-8 my-auto ml-2 mr-4" src="assets/icons/schedule.png" alt="">'
        . '<h1 class="mt-auto mb-auto text-sm mr-auto ml-0">Scheduling Management</h1>'
        . '</div>'
        . '<div id="record_management" class="w-full flex p-2 flex-col cursor-pointer text-white hover:bg-gray-900 text-center h-auto bg-gray-500 ">'
        . '<div class="w-full flex flex-row">'
        . '<img class="w-8 h-8 my-auto ml-2 mr-4" src="assets/icons/record.png" alt="">'
        . '<h1 class="mt-auto mb-auto text-sm mr-auto ml-0">Record Management</h1>'
        . '<img id="down_indicator" class="w-10 h-10 my-auto" src="/assets/svg/down_menu.png" alt="" srcset="">'
        . '</div>'
        . '<div id="manage_feeding" class="hidden hover:bg-blue-500 mt-2 mb-2 record_sub_menu w-full p-2 flex-row flex">'
        . '<img class="w-8 h-8 my-auto ml-2 mr-4" src="assets/svg/feeding.png" alt="">'
        . '<h1 class="mt-auto mb-auto text-sm mr-auto ml-0">Manage Feeding</h1>'
        . '</div>'
        . '<div id="manage_vaccination" class="hidden hover:bg-blue-500 mt-2 mb-2 record_sub_menu w-full p-2 flex-row flex">'
        . '<img class="w-8 h-8 my-auto ml-2 mr-4" src="assets/svg/vaccination.png" alt="">'
        . '<h1 class="mt-auto mb-auto text-sm mr-auto ml-0">Manage Vaccination</h1>'
        . '</div>'
        . '<div id="manage_deworming" class="hidden hover:bg-blue-500 mt-2 mb-2 record_sub_menu w-full p-2 flex-row flex">'
        . '<img class="w-8 h-8 my-auto ml-2 mr-4" src="assets/svg/deworm.png" alt="">'
        . '<h1 class="mt-auto mb-auto text-sm mr-auto ml-0">Manage Deworming</h1>'
        . '</div>'
        . '<div id="manage_medicine" class="hidden hover:bg-blue-500 mt-2 mb-2 record_sub_menu w-full p-2 flex-row flex">'
        . '<img class="w-8 h-8 my-auto ml-2 mr-4" src="assets/svg/medicine.png" alt="">'
        . '<h1 class="mt-auto mb-auto text-sm mr-auto ml-0">Manage Medicine Administration</h1>'
        . '</div>'
        . '</div>'
        . '<div id="reports" class="w-full flex p-2 flex-row cursor-pointer text-white hover:bg-gray-600 text-center h-12 bg-gray-500 ">'
        . '<img class="w-8 h-8 my-auto ml-2 mr-4" src="assets/icons/reports.png" alt="">'
        . '<h1 class="mt-auto mb-auto text-sm mr-auto ml-0">Reports</h1>'
        . '</div>'
        . '<div id="backup_and_restore" class="w-full flex p-2 flex-row cursor-pointer text-white hover:bg-gray-600 text-center h-12 bg-gray-500 ">'
        . '<img class="w-8 h-8 my-auto ml-2 mr-4" src="assets/icons/backup_restore.png" alt="">'
        . '<h1 class="mt-auto mb-auto text-sm mr-auto ml-0">Back-up & Restore</h1>'
        . '</div>'
        . '<div id="logout" class="w-full flex p-2 flex-row cursor-pointer text-white hover:bg-gray-600 text-center h-12 bg-gray-500 ">'
        . '<img class="w-8 h-8 my-auto ml-2 mr-4" src="assets/icons/logout.png" alt="">'
        . '<h1 class="mt-auto mb-auto text-sm mr-auto ml-0">Logout</h1>'
        . '</div>'
        . '</div>';
}
