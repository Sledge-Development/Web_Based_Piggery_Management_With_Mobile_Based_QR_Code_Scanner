<?php
include "configs/php/db.php";
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
    <script src="assets/qr_code_generate/qrcode.min.js"></script>
    <title>Batch Management</title>
</head>

<body>
    <div id="view_batch_detail" class="w-screen hidden  h-screen rounded-md shadow-2xl flex bg-black/50 overflow-hidden absolute">
        <div class="w-1/2 bg-white overflow-y-auto shadow-2xl rounded-md h-auto flex flex-col   my-auto mx-auto">
            <div class="w-full h-1/12 grid">
                <h1 class="text-center text-2xl my-4">View Schedule Details</h1>
            </div>
            <div class="w-full flex overflow-y-auto no-scroll flex-col h-11/12 ">
                <div class="w-3/4 mx-auto mt-2 mb-2 h-auto flex flex-col">
                    <span class="text-xl font-mono my-auto">Batch ID:</span>
                    <span id="view_batch_id" class="my-auto text-xl">1</span>
                </div>
                <div class="w-3/4 mx-auto mt-2 mb-2 h-auto flex flex-col">
                    <span class="text-xl font-mono my-auto">Sow ID:</span>
                    <span id="view_sow_id" class="my-auto text-xl">1</span>
                </div>
                <div class="w-3/4 mx-auto mt-2 mb-2 h-auto flex flex-col">
                    <span class="text-xl font-mono">Boar Tag:</span>
                    <span id="view_boar_id" class="my-auto text-xl">2</span>
                </div>
                <div class="w-full mb-2 h-16 flex flex-row">
                    <button class="w-1/4 h-12 rounded-md bg-blue-500 hover:bg-red-400 mx-auto my-auto" id="confirm_view_batch">OK</button>
                </div>
            </div>
        </div>
    </div>
    <div id="add_new_batch" class="w-screen hidden h-screen  flex bg-black/50 overflow-hidden absolute">
        <form id="new_batch_form" method="post" class="w-1/2 bg-white overflow-y-auto shadow-2xl rounded-md h-auto flex flex-col   my-auto mx-auto">
            <div class="w-full h-1/12 grid">
                <h1 class="text-center text-2xl my-4">New Pig Details</h1>
            </div>
            <div class="w-full flex overflow-y-auto no-scroll flex-col h-11/12 ">
                <div class="w-3/4 mx-auto mt-2 mb-2 h-auto flex flex-col">
                    <span class="text-xl font-mono my-auto">Sow Id:</span>
                    <input name="sow" id="add_sow" type="text" class="shadow appearance-none border  rounded w-full mx-auto h-12 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <table id="add_sow_list" class="w-full hidden  h-14 border-2 border-gray-500 overflow-y-auto overflow-x-hidden no-scroll">
                    </table>
                </div>
                <div class="w-3/4 mx-auto mt-2 mb-2 h-auto flex flex-col">
                    <span class="text-xl font-mono my-auto">Boar:</span>
                    <input name="boar" id="add_boar" type="text" class="shadow appearance-none border  rounded w-full mx-auto h-12 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <table id="add_boar_list" class="w-full hidden  h-14 border-2 border-gray-500 overflow-y-auto overflow-x-hidden no-scroll">
                    </table>
                </div>
                <div class="w-full mb-2 h-16 flex flex-row">
                    <input type="submit" class="w-1/4 h-12 rounded-md bg-blue-500 hover:bg-red-400 mx-auto my-auto" value="Add">
                    <button class="w-1/4 h-12 rounded-md bg-blue-500 hover:bg-red-400 mx-auto my-auto" id="cancel_add_batch">Cancel </button>
                </div>
            </div>
        </form>
    </div>
    <div id="edit_batch_details" class="w-screen hidden  h-screen  flex bg-black/50 overflow-hidden absolute">
        <form id="edit_batch_form" class="w-1/2 bg-white overflow-y-auto shadow-2xl rounded-md h-11/12 flex flex-col   my-auto mx-auto">
            <div class="w-full h-1/12 grid">
                <h1 class="text-center text-2xl my-4">Edit Batch Details</h1>
            </div>
            <div class="w-full flex overflow-y-auto no-scroll flex-col h-11/12 ">
                <div class="w-3/4 mx-auto mt-2 mb-2 h-auto flex flex-col">
                    <span class="text-xl font-mono my-auto">Sow Id:</span>
                    <input name="sow" id="edit_sow" type="text" class="shadow appearance-none border  rounded w-full mx-auto h-12 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <table id="edit_sow_list" class="w-full hidden  h-14 border-2 border-gray-500 overflow-y-auto overflow-x-hidden no-scroll">
                    </table>
                </div>
                <div class="w-3/4 mx-auto mt-2 mb-2 h-auto flex flex-col">
                    <span class="text-xl font-mono my-auto">Boar:</span>
                    <input name="boar" id="edit_boar" type="text" class="shadow appearance-none border  rounded w-full mx-auto h-12 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <table id="edit_boar_list" class="w-full hidden  h-14 border-2 border-gray-500 overflow-y-auto overflow-x-hidden no-scroll">
                    </table>
                </div>
                <div class="w-full mb-2 h-16 flex flex-row">
                    <input type="submit" class="w-1/4 h-12 rounded-md bg-blue-500 hover:bg-red-400 mx-auto my-auto" value="Edit" />
                    <button class="w-1/4 h-12 rounded-md bg-blue-500 hover:bg-red-400 mx-auto my-auto" id="cancel_edit_batch">Cancel </button>
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
                <div class="w-full flex mt-2 flex-row">
                    <img class="w-12 h-12 mr-4 ml-8" src="assets/svg/batch.png" alt="icon_user">
                    <h1 class="mt-auto text-white mb-auto font-bold">Batch Management</h1>
                    <button id="new_batch" class="w-1/6 my-auto rounded-md   h-5/6 bg-blue-500 hover:bg-red-400 ml-auto mr-6">
                        New Batch
                    </button>
                </div>
                <div class="w-5/6 h-5/6 mx-auto my-auto overflow-y-auto">
                    <table id="table-data" class="table-fixed w-full  ">
                        <thead>
                            <th>Batch ID</th>
                            <th>Boar ID</th>
                            <th>Sow ID</th>
                            <th>Action</th>
                        </thead>
                        <?php

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
<script src="assets/js/batch_management_events.js"></script>

</html>