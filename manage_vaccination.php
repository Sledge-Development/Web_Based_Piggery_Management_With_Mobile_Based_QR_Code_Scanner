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
    <title>Manange Vaccination</title>
</head>

<body>
    <div id="view_vaccination_details" class="w-screen hidden h-screen  shadow-2xl flex bg-black/50 overflow-hidden absolute">
        <div class="w-1/4 h-auto flex flex-col bg-white my-auto rounded-md mx-auto">
            <div class="w-full h-1/12 grid border-black border-b-2">
                <h1 class="text-center text-2xl my-auto">Vaccination Details</h1>
            </div>
            <div class="w-full flex flex-col overflow-y-auto h-11/12 ">
                <div class="w-full h-auto mt-2 mb-2 flex flex-row">
                    <span class="text-2xl my-auto ml-2 mr-4">Pig Id:</span>
                    <span class="text-xl ml-2 my-auto">135790</span>
                </div>
                <div class="w-full h-auto mt-2 mb-2 flex flex-row">
                    <span class="text-2xl my-auto ml-2 mr-4">Item Name:</span>
                    <span class="text-xl ml-2 my-auto">Mycroplasma Hypneumoniae</span>
                </div>
                <div class="w-full h-auto mt-2 mb-2 flex flex-row">
                    <span class="text-2xl my-auto ml-2 mr-4">Item Quantity:</span>
                    <span class="text-xl ml-2 my-auto">5 ml</span>
                </div>
                <div class="w-full h-auto mt-2 mb-2 flex flex-row">
                    <span class="text-2xl my-auto ml-2 mr-4">Creator:</span>
                    <span class="text-xl ml-2 my-auto">April Jude Provido</span>
                </div>
                <div class="w-full h-auto mt-2 mb-2 flex flex-row">
                    <span class="text-2xl my-auto ml-2 mr-4">Date:</span>
                    <span class="text-xl ml-2 my-auto">07/04/2022</span>
                </div>
                <div class="w-full h-8 mt-2 mb-2 flex flex-row">
                    <button class="w-1/4 h-full rounded-md bg-blue-500 hover:bg-red-400 mx-auto my-auto" id="close_record_detail">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div id="add_vaccination_details" class="w-screen hidden  h-screen  flex bg-black/50 overflow-hidden absolute">
        <div class="w-1/4 bg-white shadow-2xl rounded-md h-3/4 flex flex-col   my-auto mx-auto">
            <div class="w-full h-1/12 grid border-black border-b-2">
                <h1 class="text-center text-2xl my-auto">New vaccination Details</h1>
            </div>
            <div class="w-full flex overflow-y-auto flex-col h-11/12 ">
                <div class="w-full mt-2 mb-2 h-auto flex flex-col">
                    <span class="text-xl ml-12 my-auto">Pig Id:</span>
                    <input type="text" class="shadow appearance-none border  rounded w-3/4 mx-auto h-12 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
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
                    <span class="text-xl ml-12">Date:</span>
                    <input id="operation_date" type="date" class="shadow appearance-none border  rounded w-3/4 h-12 mx-auto  text-gray-700  leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="w-full mb-2 h-12 flex flex-row">
                    <button class="w-1/4 h-full rounded-md bg-blue-500 hover:bg-red-400 mx-auto my-auto" id="confirm_add_vaccination_details">Add </button>
                    <button class="w-1/4 h-full rounded-md bg-blue-500 hover:bg-red-400 mx-auto my-auto" id="cancel_add_vaccination_details">Cancel </button>
                </div>
            </div>
        </div>
    </div>
    <div id="edit_vaccination_details" class="w-screen hidden  h-screen  flex bg-black/50 overflow-hidden absolute">
        <div class="w-1/4 bg-white shadow-2xl rounded-md h-auto flex flex-col   my-auto mx-auto">
            <div class="w-full h-1/12 grid border-black border-b-2">
                <h1 class="text-center text-2xl my-auto">Edit vaccination Details</h1>
            </div>
            <div class="w-full flex overflow-y-auto flex-col h-11/12 ">
                <div class="w-full mt-2 mb-2 h-auto flex flex-col">
                    <span class="text-xl ml-12 my-auto">Pig Id:</span>
                    <input type="text" class="shadow appearance-none border  rounded w-3/4 mx-auto h-12 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
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
                    <p id="deduction_notice" class="text-sm w-3/4  mx-auto text-center text-red-500 "><abbr title="Editing this operation details will automatically deduct the item quantity">
                            5 kg of hog grower will be deducted in inventory
                        </abbr></p>
                </div>
                <div class="w-full mt-2 mb-2 h-auto flex flex-col">
                    <span class="text-xl ml-12 my-auto">Creator:</span>
                    <input type="text" class="shadow appearance-none border  rounded w-3/4 mx-auto h-12 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="w-full mt-2 mb-2 h-24 flex flex-col">
                    <span class="text-xl ml-12">Date:</span>
                    <input id="operation_date" type="date" class="shadow  border  rounded w-3/4 h-12 mx-auto  text-gray-700  leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="w-full mb-2 h-12 flex flex-row">
                    <button class="w-1/4 h-full rounded-md bg-blue-500 hover:bg-red-400 mx-auto my-auto" id="confirm_edit_vaccination_details">Add </button>
                    <button class="w-1/4 h-full rounded-md bg-blue-500 hover:bg-red-400 mx-auto my-auto" id="cancel_edit_vaccination_details">Cancel </button>
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
                <div class="w-full h-12 flex mt-2 flex-row">
                    <img class="w-12 h-12 mr-4 ml-8" src="assets/svg/vaccination.png" alt="icon_user">
                    <h1 class="mt-auto text-white mb-auto font-bold">Vaccination Management</h1>
                    <div class="w-1/2 mx-auto flex flex-row">
                        <input id="record_management_search" class="w-64 h-12 focus:outline-none" type="search" name="" placeholder="Search..." id="">

                    </div>
                    <button id="new_vaccination_detail" class="mr-4 bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded">New
                        Vaccination Operation
                    </button>
                </div>
                <div class="w-5/6 h-5/6 mx-auto my-auto overflow-y-auto">
                    <table class="table-fixed w-full  ">
                        <tr>
                            <th>Pig ID</th>
                            <th>Creator</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                        <tr class="cursor-pointer table_row_record_details">
                            <td>135790</td>
                            <td>April Jude Provido</td>
                            <td>07/04/2022</td>
                            <td class="text-center grid"><span id="edit_01" class="w-full mx-auto my-auto hover:text-blue-500" onclick="edit_operation_details('edit_01')">Edit</span></td>
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
<script src="assets/js/vaccination_events.js"></script>

</html>