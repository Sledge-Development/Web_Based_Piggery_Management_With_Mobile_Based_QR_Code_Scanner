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
    <title>Schedule Management</title>
</head>

<body>
    <div id="view_schedule_detail" class="w-screen hidden h-screen rounded-md shadow-2xl flex bg-black/50 overflow-hidden absolute">
        <div class="w-1/4 bg-white overflow-y-auto shadow-2xl rounded-md h-auto flex flex-col   my-auto mx-auto">
            <div class="w-full h-1/12 grid border-black border-b-2">
                <h1 class="text-center text-2xl my-auto">View Schedule Details</h1>
            </div>
            <div class="w-full flex overflow-y-auto no-scroll flex-col h-11/12 ">
                <div class="w-full mt-2 mb-2 h-auto flex flex-col">
                    <fieldset class="border border-solid border-gray-300 p-3 w-3/4 h-auto mx-auto">
                        <legend>Pig List</legend>
                        <p id="legend"></p>

                    </fieldset>
                </div>
                <div class="w-full mt-2 mb-2 h-auto flex flex-row">
                    <span class="text-xl ml-12 my-auto">Item Name:</span>
                    <span class="my-auto text-xl">Ivermictine</span>
                </div>
                <div class="w-full mt-2 mb-2 h-auto flex flex-row">
                    <span class="text-xl ml-12 my-auto">Item Quantity:</span>
                    <span class="my-auto text-xl">0.5 mg</span>
                </div>

                <div class="w-full mt-2 mb-2 h-auto flex flex-row">
                    <span class="text-xl ml-12 my-auto">Creator:</span>
                    <span class="my-auto text-xl">April Jude Provido</span>
                </div>
                <div class="w-full mt-2 mb-2 h-auto flex flex-row">
                    <span class="text-xl ml-12">Schedule Date:</span>
                    <span class="my-auto text-xl">02/12/2022</span>
                </div>
                <div class="w-full mb-2 h-16 flex flex-row">
                    <button class="w-1/4 h-12 rounded-md bg-blue-500 hover:bg-red-400 mx-auto my-auto" id="confirm_view_schedule">OK</button>
                </div>
            </div>
        </div>
    </div>
    <div id="add_schedule_details" class="w-screen hidden  h-screen  flex bg-black/50 overflow-hidden absolute">
        <div class="w-1/4 bg-white overflow-y-auto shadow-2xl rounded-md h-3/4 flex flex-col   my-auto mx-auto">
            <div class="w-full h-1/12 grid border-black border-b-2">
                <h1 class="text-center text-2xl my-auto">New Feeding Details</h1>
            </div>
            <div class="w-full flex overflow-y-auto no-scroll flex-col h-11/12 ">
                <div class="w-full mt-2 mb-2 h-auto flex flex-col">
                    <span class="text-xl ml-12 my-auto">Pig Id:</span>
                    <div class="flex flex-row">
                        <input type="text" id="pig_id" class="shadow appearance-none border  rounded w-64 ml-auto mr-2 h-12 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <button class="mr-2" id="add_button_list">
                            <img class="w-12 h-12 " src="assets/svg/add.png" alt="">
                        </button>
                    </div>
                    <fieldset class="border border-solid border-gray-300 p-3 w-3/4 h-auto mx-auto">
                        <legend>Pig List</legend>
                        <p id="legends"></p>

                    </fieldset>
                </div>
                <div class="w-full mt-2 mb-2 h-auto flex flex-col">
                    <span class="text-xl ml-12 my-auto">Item Name:</span>
                    <input type="text" class="shadow appearance-none border  rounded w-3/4 mx-auto h-12 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="w-full mt-2 mb-2 h-auto flex flex-col">
                    <span class="text-xl ml-12 my-auto">Item Quantity:</span>
                    <div class="w-full flex flex-row">
                        <input type="text" class="mr-0 ml-auto text-center shadow appearance-none border  rounded w-36 h-12 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <select class="block w-34 mr-auto ml-2 bg-white border border-gray-400 hover:border-gray-500 rounded shadow leading-tight focus:outline-none focus:shadow-outline" name="add_unit" id="add_unit">
                            <option value="kg">kg(Kilo Gram/s)</option>
                            <option value="mg">mg(Milli Gram/s)</option>
                            <option value="g">g(Gram/s)</option>
                            <option value="pcs">pcs(Piece/s)</option>
                        </select>
                    </div>
                    <p id="deduction_notice" class="text-sm w-3/4  mx-auto text-center text-red-500 "><abbr title="Adding this operation details will automatically deduct the item quantity">
                            5 kg of hog grower will be deducted in inventory
                        </abbr></p>
                </div>
                <div class="w-full mt-2 mb-2 h-auto flex flex-col">
                    <span class="text-xl ml-12 my-auto">Creator:</span>
                    <input type="text" class="shadow appearance-none border  rounded w-3/4 mx-auto h-12 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="w-full mt-2 mb-2 h-24 flex flex-col">
                    <span class="text-xl ml-12">Schedule Date:</span>
                    <input id="operation_date" type="date" class="shadow appearance-none border  rounded w-3/4 h-12 mx-auto  text-gray-700  leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="w-full mb-2 h-16 flex flex-row">
                    <button class="w-1/4 h-12 rounded-md bg-blue-500 hover:bg-red-400 mx-auto my-auto" id="confirm_add_schedule">Add</button>
                    <button class="w-1/4 h-12 rounded-md bg-blue-500 hover:bg-red-400 mx-auto my-auto" id="cancel_add_schedule">Cancel </button>
                </div>
            </div>
        </div>
    </div>
    <div id="edit_schedule_details" class="w-screen hidden  h-screen  flex bg-black/50 overflow-hidden absolute">
        <div class="w-1/4 bg-white overflow-y-auto shadow-2xl rounded-md h-3/4 flex flex-col   my-auto mx-auto">
            <div class="w-full h-1/12 grid border-black border-b-2">
                <h1 class="text-center text-2xl my-auto">Edit Schedule Details</h1>
            </div>
            <div class="w-full flex overflow-y-auto no-scroll flex-col h-11/12 ">
                <div class="w-full mt-2 mb-2 h-auto flex flex-col">
                    <span class="text-xl ml-12 my-auto">Pig Id:</span>
                    <div class="flex flex-row">
                        <input type="text" id="pig_id_edit" class="shadow appearance-none border  rounded w-64 ml-auto mr-2 h-12 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <button class="mr-2" id="add_update_button_list">
                            <img class="w-12 h-12 " src="assets/svg/add.png" alt="">
                        </button>
                    </div>
                    <fieldset class="border border-solid border-gray-300 p-3 w-3/4 h-auto mx-auto">
                        <legend>Pig List</legend>
                        <p id="legend_edit"></p>
                    </fieldset>
                </div>
                <div class="w-full mt-2 mb-2 h-auto flex flex-col">
                    <span class="text-xl ml-12 my-auto">Item Name:</span>
                    <input type="text" class="shadow appearance-none border  rounded w-3/4 mx-auto h-12 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="w-full mt-2 mb-2 h-auto flex flex-col">
                    <span class="text-xl ml-12 my-auto">Item Quantity:</span>
                    <div class="w-full flex flex-row">
                        <input type="text" class="mr-0 ml-auto text-center shadow appearance-none border  rounded w-36 h-12 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <select class="block w-34 mr-auto ml-2 bg-white border border-gray-400 hover:border-gray-500 rounded shadow leading-tight focus:outline-none focus:shadow-outline" name="add_unit" id="add_unit">
                            <option value="kg">kg(Kilo Gram/s)</option>
                            <option value="mg">mg(Milli Gram/s)</option>
                            <option value="g">g(Gram/s)</option>
                            <option value="pcs">pcs(Piece/s)</option>
                        </select>
                    </div>
                    <p id="deduction_notice" class="text-sm w-3/4  mx-auto text-center text-red-500 "><abbr title="Adding this operation details will automatically deduct the item quantity">
                            5 kg of hog grower will be deducted in inventory
                        </abbr></p>
                </div>
                <div class="w-full mt-2 mb-2 h-auto flex flex-col">
                    <span class="text-xl ml-12 my-auto">Creator:</span>
                    <input type="text" class="shadow appearance-none border  rounded w-3/4 mx-auto h-12 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="w-full mt-2 mb-2 h-24 flex flex-col">
                    <span class="text-xl ml-12">Schedule Date:</span>
                    <input id="operation_date" type="date" class="shadow appearance-none border  rounded w-3/4 h-12 mx-auto  text-gray-700  leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="w-full mb-2 h-16 flex flex-row">
                    <button class="w-1/4 h-12 rounded-md bg-blue-500 hover:bg-red-400 mx-auto my-auto" id="confirm_edit_schedule">Add</button>
                    <button class="w-1/4 h-12 rounded-md bg-blue-500 hover:bg-red-400 mx-auto my-auto" id="cancel_edit_schedule">Cancel </button>
                </div>
            </div>
        </div>
    </div>
    <div id="remove_schedule_details" class="w-screen hidden  h-screen  flex bg-black/50 overflow-hidden absolute">
        <div class="w-1/4 bg-white shadow-2xl rounded-md h-1/4 flex flex-col   my-auto mx-auto">
            <div class="w-full h-2/6 grid border-black border-b-2">
                <h1 class="text-center w-full text-2xl my-auto">Delete Operation Details</h1>
            </div>
            <div class="w-full grid overflow-y-auto grid-cols-1 h-11/12 ">
                <div class="w-full text-center">
                    <span>Are you sure you want to remove operation for 23123423</span>
                </div>
                <div class="w-full h-12 flex flex-row">
                    <button class="w-1/4 h-full rounded-md bg-blue-500 hover:bg-red-400 mx-auto my-auto" id="confirm_remove_schedule_detail">Remove </button>
                    <button class="w-1/4 h-full rounded-md bg-blue-500 hover:bg-red-400 mx-auto my-auto" id="cancel_remove_schedule_detail">Cancel </button>
                </div>
            </div>
        </div>
    </div>
    <div class="w-screen h-screen bg-gray-800 flex flex-col overflow-hidden">
        <div class="w-full h-1/12 grid header-em">
            <h1 class="mr-4 ml-auto mt-auto mb-auto text-white">RVM HOG FARM</h1>
        </div>
        <div class="h-11/12 w-full flex flex-row bg-gray-400">
            <?php echo $renderer; ?>
            <div class="h-full w-5/6 flex flex-col bg-gray-600">
                <div class="w-full flex mt-2 flex-row">
                    <img class="w-12 h-12 mr-4 ml-8" src="assets/icons/dashboard_users.png" alt="icon_user">
                    <h1 class="mt-auto text-white mb-auto font-bold">Dashboard</h1>
                    <button id="new_schedule" class="w-1/6 my-auto rounded-md   h-5/6 bg-blue-500 hover:bg-red-400 ml-auto mr-6">New
                        Schedule</button>
                </div>
                <div class="w-5/6 h-5/6 mx-auto my-auto overflow-y-auto">
                    <table class="table-fixed w-full  ">
                        <tr>
                            <th>Schedule Id</th>
                            <th>Operation</th>
                            <th>Schedule Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        <tr class="cursor-pointer table_row_record_details">
                            <td>23123423</td>
                            <td>Deworm</td>
                            <td>12/22/2022</td>
                            <td>Pending</td>
                            <td class="text-center grid grid-cols-3">
                                <span id="edit_01" class="w-full mx-auto my-auto hover:text-blue-500" onclick="edit_schedule_details('edit_01')">Edit</span>
                                |
                                <span class="w-full mx-auto my-auto hover:text-blue-500" id="delete_01" onclick="remove_schedule_details('delete_01')">Delete</span>
                            </td>
                        </tr>
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
<script src="assets/js/new_schedule_events.js"></script>

</html>