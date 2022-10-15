<?php
include 'configs/php/db.php';
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location:/index.php?error=401");
}
$full_name = $_SESSION["first_name"] . " " . $_SESSION["middle_name"] . " " . $_SESSION["last_name"];
$renderer = MenuRender($full_name);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicon_io/favicon-16x16.png">
    <link rel="manifest" href="assets/img/favicon_io/site.webmanifest">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/tailwind.css">
    <link rel="stylesheet" href="assets/css/table.css">
    <link rel="stylesheet" href="assets/css/custom.css">
    <script src="assets/jquery.js"></script>
    <title>Manage Medicine Administration</title>
</head>

<body>
    <div id="remove_item_details" class="w-screen hidden  h-screen  shadow-2xl flex bg-black/50 overflow-hidden absolute">
        <div id="remove_item_form" class="w-1/2 h-auto flex flex-col bg-white my-auto rounded-md mx-auto">
            <div class="w-full h-1/12 grid">
                <h1 class="text-center text-2xl my-4">View Item Details</h1>
            </div>
            <div class="w-full text-center">
                <span> Would you like to remove <span id="remove_item_tag"></span></span>
            </div>
            <div class="w-full flex flex-col overflow-y-auto h-11/12 ">
                <div class="w-full h-8 mt-2 mb-2 flex flex-row">
                    <button class="w-1/4 h-full rounded-md bg-blue-500 hover:bg-red-400 mx-auto my-auto" id="confirm_remove_item_details">remove</button>
                    <button class="w-1/4 h-full rounded-md bg-blue-500 hover:bg-red-400 mx-auto my-auto" id="close_remove_item_details">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div id="view_item_details" class="w-screen hidden h-screen  shadow-2xl flex bg-black/50 overflow-hidden absolute">
        <div id="view_item_form" class="w-1/2 h-auto flex flex-col bg-white my-auto rounded-md mx-auto">
            <div class="w-full h-1/12 grid">
                <h1 class="text-center text-2xl my-4">View Item Details</h1>
            </div>
            <div class="w-full flex flex-col overflow-y-auto h-11/12 ">
                <div class="w-full h-auto mt-2 mb-2 flex flex-col">
                    <span class="text-2xl my-auto ml-2 mr-4">Item Tag:</span>
                    <span id="view_item_tag" class="text-xl ml-2 font-mono my-auto">Hello</span>
                </div>
                <div class="w-full h-auto mt-2 mb-2 flex flex-col">
                    <span class="text-2xl my-auto ml-2 mr-2">Item Name:</span>
                    <span id="view_item_name" class="text-xl ml-2 font-mono my-auto"></span>
                </div>
                <div class="w-full h-auto mt-2 mb-2 flex flex-col">
                    <span class="text-2xl my-auto ml-2 mr-2">Item Description:</span>
                    <span id="view_item_description" class="text-xl ml-2 font-mono my-auto"></span>
                </div>
                <div class="w-full h-auto mt-2 mb-2 flex flex-col">
                    <span class="text-2xl my-auto ml-2 mr-4">Item Quantity:</span>
                    <span id="view_item_quantity" class="text-xl ml-2 font-mono my-auto"></span>
                </div>
                <div class="w-full h-auto mt-2 mb-2 flex flex-col">
                    <span class="text-2xl my-auto ml-2 mr-4">Item Net Weight:</span>
                    <span id="view_item_net_weight" class="text-xl ml-2 font-mono my-auto"></span>
                </div>
                <div class="w-full h-8 mt-2 mb-2 flex flex-row">
                    <button class="w-1/4 h-full rounded-md bg-blue-500 hover:bg-red-400 mx-auto my-auto" id="close_item_details">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div id="add_item_details" class="w-screen hidden h-screen  flex bg-black/50 overflow-hidden absolute">
        <form id="add_item_form" class="w-1/2 bg-white shadow-2xl overflow-y-auto no-scrollbar rounded-md h-11/12 flex flex-col   my-auto mx-auto">
            <div class="w-full h-1/12 grid">
                <h1 class="text-center text-2xl my-4">New Item</h1>
            </div>
            <div class="w-full flex  flex-col h-auto">
                <div class="w-3/4 mx-auto mt-2 mb-2 h-auto flex flex-col">
                    <span class="text-xl font-mono my-auto">Item Tag:</span>
                    <input name="item_tag" id="add_item_tag" type="text" class="shadow appearance-none border  rounded w-full mx-auto h-12 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="w-3/4 mx-auto mt-2 mb-2 h-auto flex flex-col">
                    <span class="text-xl font-mono my-auto">Item Name:</span>
                    <input name="item_name" id="add_item_name" type="text" class="shadow appearance-none border  rounded w-full mx-auto h-12 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="w-3/4 mx-auto mt-2 mb-2 h-auto flex flex-col">
                    <span class="text-xl font-mono my-auto">Item Description:</span>
                    <input name="item_description" id="add_item_description" type="text" class="shadow appearance-none border  rounded w-full mx-auto h-12 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="w-3/4 mx-auto mt-2 mb-2 h-auto flex flex-col">
                    <span class="text-xl font-mono my-auto">Item Net Weight:</span>
                    <div class="w-full flex flex-row">
                        <input id="item_netweight" name="add_item_netweight" type="text" class="mr-0 ml-auto text-center shadow appearance-none border  rounded w-3/4 h-12 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <select class="block w-34 mr-auto ml-2 bg-white border border-gray-400 hover:border-gray-500 rounded shadow leading-tight focus:outline-none focus:shadow-outline" name="add_item_unit" id="add_item_unit">
                            <option value="default">Unit</option>
                            <option value="kg">kg(Kilo Gram/s)</option>
                            <option value="mg">mg(Milli Gram/s)</option>
                            <option value="g">g(Gram/s)</option>
                            <option value="pcs">pcs(Piece/s)</option>
                        </select>
                    </div>
                </div>
                <div class="w-3/4 mx-auto mt-2 mb-2 h-auto flex flex-col">
                    <span class="text-xl font-mono my-auto">Item Quantity:</span>
                    <input type="text" id="add_item_quantity" name="add_item_quantity" class="shadow appearance-none border  rounded w-full mx-auto h-12 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="w-full mb-2 h-24 flex flex-row">
                    <input type="submit" class="w-1/4 h-12 rounded-md bg-blue-500 hover:bg-red-400 mx-auto my-auto" value="Add">
                    <button class="w-1/4 h-12 rounded-md bg-blue-500 hover:bg-red-400 mx-auto my-auto" id="cancel_add_item">Cancel </button>
                </div>
            </div>
        </form>
    </div>
    <div id="edit_item_details" class="w-screen hidden h-screen  flex bg-black/50 overflow-hidden absolute">
        <form id="edit_item_form" class="w-1/2 bg-white shadow-2xl overflow-y-auto no-scrollbar rounded-md h-11/12 flex flex-col   my-auto mx-auto">
            <div class="w-full h-1/12 grid">
                <h1 class="text-center text-2xl my-4">Edit Item Details</h1>
            </div>
            <div class="w-full flex  flex-col h-auto">
                <div class="w-3/4 mx-auto mt-2 mb-2 h-auto flex flex-col">
                    <span class="text-xl font-mono my-auto">Item Tag:</span>
                    <input name="item_tag" id="edit_item_tag" type="text" class="shadow appearance-none border  rounded w-full mx-auto h-12 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="w-3/4 mx-auto mt-2 mb-2 h-auto flex flex-col">
                    <span class="text-xl font-mono my-auto">Item Name:</span>
                    <input name="item_name" id="edit_item_name" type="text" class="shadow appearance-none border  rounded w-full mx-auto h-12 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="w-3/4 mx-auto mt-2 mb-2 h-auto flex flex-col">
                    <span class="text-xl font-mono my-auto">Item Description:</span>
                    <input name="item_description" id="edit_item_description" type="text" class="shadow appearance-none border  rounded w-full mx-auto h-12 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="w-3/4 mx-auto mt-2 mb-2 h-auto flex flex-col">
                    <span class="text-xl font-mono my-auto">Item Net Weight:</span>
                    <div class="w-full flex flex-row">
                        <input id="edit_item_netweight" name="add_item_netweight" type="text" class="mr-0 ml-auto text-center shadow appearance-none border  rounded w-3/4 h-12 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <select class="block w-34 mr-auto ml-2 bg-white border border-gray-400 hover:border-gray-500 rounded shadow leading-tight focus:outline-none focus:shadow-outline" name="add_item_unit" id="edit_item_unit">
                            <option value="default">Unit</option>
                            <option value="kg">kg(Kilo Gram/s)</option>
                            <option value="mg">mg(Milli Gram/s)</option>
                            <option value="g">g(Gram/s)</option>
                            <option value="pcs">pcs(Piece/s)</option>
                            <option value="ml">ml(Milli Liters)</option>
                        </select>
                    </div>
                </div>
                <div class="w-3/4 mx-auto mt-2 mb-2 h-auto flex flex-col">
                    <span class="text-xl font-mono my-auto">Item Quantity:</span>
                    <input type="text" id="edit_item_quantity" name="item_quantity" class="shadow appearance-none border  rounded w-full mx-auto h-12 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="w-full mb-2 h-24 flex flex-row">
                    <input type="submit" class="w-1/4 h-12 rounded-md bg-blue-500 hover:bg-red-400 mx-auto my-auto" value="Edit">
                    <button class="w-1/4 h-12 rounded-md bg-blue-500 hover:bg-red-400 mx-auto my-auto" id="cancel_edit_item">Cancel </button>
                </div>
            </div>
        </form>
    </div>
    <div class="w-screen h-screen bg-gray-800 flex flex-col overflow-hidden">
        <div class="w-full h-1/12 grid header-em">
            <h1 class="mr-4 ml-auto mt-auto mb-auto text-white">RVM HOG FARM</h1>
        </div>
        <div class="h-11/12 w-full flex flex-row bg-gray-400">
            <?php echo $renderer; ?>
            <div class="h-full w-5/6 flex flex-col bg-gray-600">
                <div class="w-full h-12 flex mt-2 flex-row">
                    <img class="w-12 h-12 mr-4 ml-8" src="assets/icons/inventory_management.png" alt="icon_user">
                    <h1 class="mt-auto text-white mb-auto font-bold">Inventory Management</h1>
                    <div class="w-64 mx-auto flex flex-row">
                        <input id="record_management_search" class="w-64 h-12 focus:outline-none" type="search" name="" placeholder="Search..." id="">
                    </div>
                    <button id="add_item" class="mr-4 text-sm h-12 w-auto bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded">
                        Add item
                    </button>
                    <button id="deduct_item" class="mr-4 text-sm h-12 w-auto bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded">
                        Deduct Item
                    </button>
                </div>
                <div class="w-5/6 h-5/6 mx-auto my-auto overflow-y-auto">
                    <table id="item-data" class="table-fixed w-full  ">
                        <thead>
                            <th>Item Tag</th>
                            <th>Item Name</th>
                            <th>Item Quantity</th>
                            <th>Action</th>
                        </thead>

                        <?php
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

                        ?>



                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="assets/notyf/notyf.min.js"></script>
<link rel="stylesheet" href="assets/notyf/notyf.min.css">
<script src="assets/js/notif_handler.js"></script>
<script src="assets/js/navigation.js"></script>
<script src="assets/js/inventory_management_events.js"></script>

</html>