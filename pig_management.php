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
    <script src="assets/qr_code_generate/qrcode.min.js"></script>
    <title>Pig Management</title>
</head>

<body>

    <div id="view_pig_details" class="w-screen hidden h-screen rounded-md shadow-2xl flex bg-black/50 overflow-hidden absolute">
        <div id="view_form" class="w-1/2 bg-white overflow-y-auto no-scroll shadow-2xl rounded-md h-11/12 no-scrollbar flex flex-col   my-auto mx-auto">
            <div class="w-full h-1/12">
                <h1 class="text-center text-2xl my-4">View Schedule Details</h1>
            </div>
            <div class="w-full flex  flex-col h-auto ">
                <div class="w-3/4 mx-auto mt-2 mb-2 h-auto flex flex-col">
                    <span class="text-xl font-mono my-auto">Pig Id:</span>
                    <span id="view_pig_id" class="my-auto text-base">pig_hkl525</span>
                </div>
                <div class="w-3/4 mx-auto mt-2 mb-2 h-auto flex flex-col">
                    <span class="text-xl font-mono my-auto">Pig Tag:</span>
                    <span id="view_pig_tag" class="my-auto text-base">pig_hkl525</span>
                </div>
                <div class="w-3/4 mx-auto mt-2 mb-2 h-auto flex flex-col">
                    <span class="text-xl font-mono my-auto">Weight:</span>
                    <span id="view_pig_weight" class="my-auto text-base">255kg</span>
                </div>
                <div class="w-3/4 mx-auto mt-2 mb-2 h-auto flex flex-col">
                    <span class="text-xl font-mono my-auto">Breed:</span>
                    <span id="view_pig_breed" class="my-auto text-base">Duroc</span>
                </div>
                <div class="w-3/4 mx-auto mt-2 mb-2 h-auto flex flex-col">
                    <span class="text-xl font-mono my-auto">Birthdate:</span>
                    <span id="view_pig_birthdate" class="my-auto text-base">08/05/2021</span>
                </div>
                <div class="w-3/4 mx-auto mt-2 mb-2 h-auto flex flex-col">
                    <span class="text-xl font-mono my-auto">Gender:</span>
                    <span id="view_gender" class="my-auto text-base">1</span>
                </div>
                <div class="w-3/4 mx-auto mt-2 mb-2 h-auto flex flex-col">
                    <span class="text-xl font-mono my-auto">Batch Number:</span>
                    <span id="view_pig_batch" class="my-auto text-base">1</span>
                </div>
                <div class="w-3/4 mx-auto mt-2 mb-2 h-auto flex flex-col">
                    <span class="text-xl font-mono my-auto">Cage Name:</span>
                    <span id="view_cage_name" class="my-auto text-base">1</span>
                </div>
                <div class="w-3/4 mx-auto mt-2 mb-2 h-auto flex flex-col">
                    <span class="text-xl font-mono my-auto">Sow Id:</span>
                    <span id="view_sow_id" class="my-auto text-base">1</span>
                </div>
                <div class="w-3/4 mx-auto mt-2 mb-2 h-auto flex flex-col">
                    <span class="text-xl font-mono my-auto">Boar Id:</span>
                    <span id="view_boar_id" class="my-auto text-base">1</span>
                </div>
                <div class="w-3/4 mx-auto mt-2 mb-2 h-auto flex flex-col">
                    <span class="text-xl font-mono my-auto">Feeding Operation:</span>
                    <table id="view_feeding_operation">
                        <thead class="text-center">
                            <th>Date</th>
                            <th>Item Name</th>
                            <th>Quantity</th>
                        </thead>
                    </table>
                </div>
                <div class="w-3/4 mx-auto mt-2 mb-2 h-auto flex flex-col">
                    <span class="text-xl font-mono my-auto">Deworm Operation:</span>
                    <table id="view_deworm_operation">
                        <thead class="text-center">
                            <th>Date</th>
                            <th>Item Name</th>
                            <th>Quantity</th>
                        </thead>
                    </table>
                </div>
                <div id="view_vaccine_operation" class="w-3/4 mx-auto mt-2 mb-2 h-auto flex flex-col">
                    <span class="text-xl font-mono my-auto">Vaccine Operation:</span>
                    <table>
                        <thead class="text-center">
                            <th>Date</th>
                            <th>Item Name</th>
                            <th>Quantity</th>
                        </thead>
                    </table>
                </div>
                <div class="w-3/4 mx-auto mt-2 mb-2 h-auto flex flex-col">
                    <span class="text-xl font-mono my-auto">Medicine Administration Operation:</span>
                    <table id="view_medicine_administration_operation">
                        <thead class="text-center">
                            <th>Date</th>
                            <th>Item Name</th>
                            <th>Quantity</th>
                        </thead>
                    </table>
                </div>
                <div class="w-full mb-2 h-16 flex flex-row">
                    <button class="w-1/4 h-12 rounded-md bg-blue-500 hover:bg-red-400 mx-auto mt-4 mb-4" id="confirm_view_pig_details">OK</button>
                </div>
            </div>
        </div>
    </div>
    <div id="add_pig_details" class="w-screen hidden h-screen  flex bg-black/50 overflow-hidden absolute">
        <form id="add_pig_form" class="w-1/2 bg-white overflow-y-hidden shadow-2xl rounded-md h-11/12 flex flex-col   my-auto mx-auto">
            <div class="w-full h-1/12 grid">
                <h1 class="text-center text-2xl my-auto">New Pig Details</h1>
            </div>
            <div class="w-full  flex overflow-y-auto no-scroll flex-col h-11/12 ">
                <div class="w-3/4 mx-auto mt-2 mb-2 h-auto flex flex-col">
                    <span class="text-xl font-mono my-auto">Pig Id:</span>
                    <input name="pig_id" type="text" disabled id="new_pig_id" class="shadow appearance-none border rounded w-full ml-auto mr-auto h-12 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="w-3/4 mx-auto mt-2 mb-2 h-auto flex flex-col">
                    <span class="text-xl font-mono my-auto">Pig Tag:</span>
                    <input name="pig_tag" type="number" id="new_pig_tag" class="shadow appearance-none border rounded w-full ml-auto mr-auto h-12 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="w-3/4 mx-auto mt-2 mb-2 h-auto flex flex-col">
                    <span class="text-xl font-mono my-auto">Weight:</span>
                    <input name="weight" id="new_pig_weight" type="text" class="shadow appearance-none border  rounded w-full mx-auto h-12 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="w-3/4 mx-auto mt-2 mb-2 h-auto flex flex-col">
                    <span class="text-xl font-mono my-auto">Breed:</span>
                    <select name="breed" id="new_pig_breed" class="shadow border  rounded w-full mx-auto h-12 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <option value="default">Breed</option>
                    </select>
                </div>
                <div class="w-3/4 mx-auto mt-2 mb-2 h-auto flex flex-col">
                    <span class="text-xl font-mono my-auto">Birthdate:</span>
                    <input name="birthdate" type="date" id="birthdate" class="shadow appearance-none border  rounded w-full mx-auto h-12 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="w-3/4 mx-auto mt-2 mb-2 h-auto flex flex-col">
                    <span class="text-xl font-mono my-auto">Gender:</span>
                    <select name="gender" id="add_gender" class="shadow appearance-none border  rounded w-full mx-auto h-12 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <option value="default">Gender</option>
                        <option value="boar">Boar</option>
                        <option value="sow">Sow</option>
                        <option value="gilt">Gilt</option>
                        <option value="barrow">Borrow</option>
                        <option value="piglet">Piglet</option>

                    </select>
                </div>
                <div class="w-3/4 mx-auto mt-2 mb-2 h-auto flex flex-col">
                    <span class="text-xl font-mono my-auto flex flex-row">Batch <abbr title="Batch is listed from newest to olderst"><img src="/assets/svg/alert.png" class="w-6 mx-2 h-6 border-b-2 border-b-black"></abbr>:</span>
                    <div class="w-full flex flex-row">
                        <select class="shadow appearance-none border  rounded w-full mx-auto h-12 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="batch" id="add_pig_batch">
                            <option class="" value="default">Batch</option>
                        </select>
                    </div>
                </div>
                <div class="w-3/4 mx-auto mt-2 mb-2 h-auto flex flex-col">
                    <span class="text-xl font-mono my-auto">Cage:</span>
                    <select name="cage" id="add_cage" type="text" class="shadow appearance-none border  rounded w-full mx-auto h-12 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <option value="default">Cage</option>
                    </select>
                </div>
                <div class="w-full mt-2 mb-2 h-auto flex flex-col">
                    <span class="text-xl ml-12">Qr Tag:<span class="text-sm text-red-500"> before adding consider downloading this qr tag for pig.</span></span>
                    <div class="w-36 h-36 mt-2 mb-2 mx-auto " id="qrcode"></div>
                    <button class="h-12 w-36 mx-auto bg-green-500" id="download_qr">Download QR</button>
                </div>
                <div class="w-full mb-2 h-16 flex flex-row">
                    <input type="submit" value="Add" class="w-1/4 h-12 rounded-md bg-blue-500 hover:bg-red-400 mx-auto my-auto">
                    <button class="w-1/4 h-12 rounded-md bg-blue-500 hover:bg-red-400 mx-auto my-auto" id="cancel_add_pigs">Cancel </button>
                </div>
            </div>
        </form>
    </div>
    <div id="edit_pig_details" class="w-screen  hidden h-screen  flex bg-black/50 overflow-hidden absolute">
        <form id="edit_pig_form" class="w-1/2 bg-white overflow-y-hidden shadow-2xl rounded-md h-11/12 flex flex-col   my-auto mx-auto">
            <div class="w-full h-1/12 grid">
                <h1 class="text-center text-2xl my-auto">Edit Pig Details</h1>
            </div>
            <div class="w-full  flex overflow-y-auto no-scroll flex-col h-11/12 ">
                <div class="w-3/4 mx-auto mt-2 mb-2 h-auto flex flex-col">
                    <span class="text-xl font-mono my-auto">Pig Id:</span>
                    <input name="pig_id" type="text" disabled id="edit_pig_id" class="shadow appearance-none border rounded w-full ml-auto mr-auto h-12 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="w-3/4 mx-auto mt-2 mb-2 h-auto flex flex-col">
                    <span class="text-xl font-mono my-auto">Pig Tag:</span>
                    <input name="edit_pig_tag" type="number" id="edit_pig_tag" class="shadow appearance-none border rounded w-full ml-auto mr-auto h-12 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="w-3/4 mx-auto mt-2 mb-2 h-auto flex flex-col">
                    <span class="text-xl font-mono my-auto">Weight:</span>
                    <input name="edit_weight" id="edit_weight" type="text" class="shadow appearance-none border  rounded w-full mx-auto h-12 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="w-3/4 mx-auto mt-2 mb-2 h-auto flex flex-col">
                    <span class="text-xl font-mono my-auto">Breed:</span>
                    <select name="edit_breed" id="edit_pig_breed" class="shadow border  rounded w-full mx-auto h-12 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <option value="default">Breed</option>
                    </select>
                </div>
                <div class="w-3/4 mx-auto mt-2 mb-2 h-auto flex flex-col">
                    <span class="text-xl font-mono my-auto">Birthdate:</span>
                    <input name="edit_birthdate" type="date" id="edit_birthdate" class="shadow appearance-none border  rounded w-full mx-auto h-12 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="w-3/4 mx-auto mt-2 mb-2 h-auto flex flex-col">
                    <span class="text-xl font-mono my-auto">Gender:</span>
                    <select name="edit_gender" id="edit_gender" class="shadow appearance-none border  rounded w-full mx-auto h-12 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <option value="default">Gender</option>
                        <option value="boar">Boar</option>
                        <option value="sow">Sow</option>
                        <option value="gilt">Gilt</option>
                        <option value="barrow">Borrow</option>
                        <option value="piglet">Piglet</option>
                    </select>
                </div>
                <div class="w-3/4 mx-auto mt-2 mb-2 h-auto flex flex-col">
                    <span class="text-xl font-mono my-auto flex flex-row">Batch <abbr title="Batch is listed from newest to olderst"><img src="/assets/svg/alert.png" class="w-6 mx-2 h-6 border-b-2 border-b-black"></abbr>:</span>
                    <div class="w-full flex flex-row">
                        <select class="shadow appearance-none border  rounded w-full mx-auto h-12 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="edit_batch" id="edit_pig_batch">
                            <option class="" value="default">Batch</option>
                        </select>
                    </div>
                </div>
                <div class="w-3/4 mx-auto mt-2 mb-2 h-auto flex flex-col">
                    <span class="text-xl font-mono my-auto">Cage:</span>
                    <select name="edit_cage" id="edit_cage" type="text" class="shadow appearance-none border  rounded w-full mx-auto h-12 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <option value="default">Cage</option>
                    </select>
                </div>
                <div class="w-full mt-2 mb-2 h-auto flex flex-col">
                    <span class="text-xl ml-12">Qr Tag:</span>
                    <div class="w-36 h-36 mt-2 mb-2 mx-auto " id="edit_qrcode"></div>
                    <button class="h-12 w-36 mx-auto bg-green-500" id="edit_download_qr">Download QR</button>
                </div>
                <div class="w-full mb-2 h-16 flex flex-row">
                    <input type="submit" value="Update" class="w-1/4 h-12 rounded-md bg-blue-500 hover:bg-red-400 mx-auto my-auto">
                    <button class="w-1/4 h-12 rounded-md bg-blue-500 hover:bg-red-400 mx-auto my-auto" id="cancel_edit_pigs">Cancel </button>
                </div>
            </div>
        </form>
    </div>
    <div id="remove_pig_details" class="w-screen hidden  h-screen  flex bg-black/50 overflow-hidden absolute">
        <div class="w-1/4 bg-white shadow-2xl rounded-md h-1/4 flex flex-col   my-auto mx-auto">
            <div class="w-full h-2/6 grid border-black border-b-2">
                <h1 class="text-center w-full text-2xl my-auto">Delete Operation Details</h1>
            </div>
            <div class="w-full grid overflow-y-auto grid-cols-1 h-11/12 ">
                <div class="w-full text-center">
                    <span>Are you sure you want to remove <span id="display_pig_id"></span> ?</span>
                </div>
                <div class="w-full h-12 flex flex-row">
                    <button class="w-1/4 h-full rounded-md bg-blue-500 hover:bg-red-400 mx-auto my-auto" id="confirm_remove_pig_detail">Remove </button>
                    <button class="w-1/4 h-full rounded-md bg-blue-500 hover:bg-red-400 mx-auto my-auto" id="cancel_remove_pig_detail">Cancel </button>
                </div>
            </div>
        </div>
    </div>
    <div id="main" class="w-screen h-screen bg-gray-800 flex flex-col overflow-hidden">
        <div class="w-full h-1/12 grid header-em">
            <h1 class="mr-4 ml-auto mt-auto mb-auto text-white">RVM HOG FARM</h1>
        </div>
        <div class="h-11/12 w-full flex flex-row bg-gray-400">
            <?php echo $renderer; ?>
            <div class="h-full w-5/6 flex flex-col bg-gray-600">
                <div class="w-full flex mt-2 flex-row">
                    <img class="w-12 h-12 mr-4 ml-8" src="assets/icons/pig_management.png" alt="icon_user">
                    <h1 class="mt-auto text-white mb-auto font-bold">Pig Management</h1>
                    <div class="w-auto mx-auto flex flex-row">
                        <input id="pig_details_search" class="w-64 h-12 focus:outline-none" type="search" name="" placeholder="Search..." id="">
                    </div>
                    <button id="new_pig_details" class="w-1/6 ml-2 my-auto rounded-md   h-5/6 bg-blue-500 hover:bg-red-400 mr-6">
                        New Pig
                    </button>
                    <button id="batch_management" class="w-1/6 my-auto rounded-md   h-5/6 bg-blue-500 hover:bg-red-400 ml-auto mr-6">
                        Batch Management
                    </button>
                    <button id="cage_management" class="w-1/6 my-auto rounded-md   h-5/6 bg-blue-500 hover:bg-red-400 ml-auto mr-6">
                        Cage Management
                    </button>
                </div>
                <div class="w-5/6 h-5/6 mx-auto my-auto overflow-y-auto">
                    <table id="pig-data" class="table-fixed w-full  ">
                        <thead>
                            <th>Pig Id</th>
                            <th>Pig Tag</th>
                            <th>Breed</th>
                            <th>BirthDate</th>
                            <th>Action</th>
                        </thead>
                        <?php
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
                                    '<span id="edit_01" class="w-full mx-auto my-auto hover:text-blue-500" onclick="edit_pig_details(\'' . $row["pig_id"] . '\')">Edit</span>' .
                                    '|' .
                                    ' <span class="w-full mx-auto my-auto hover:text-blue-500" id="delete_01" onclick="remove_pig_details(\'' . $row["pig_id"] . '\')">Delete</span>' .
                                    '</td>' .
                                    '</tr>';
                            }
                        } else {
                            echo '<tr class="pig-data cursor-pointer table_row_record_details">' .
                                '<td colspan="5">No data can be loaded at the moment.</td>' .
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
<script src="assets/js/pig_management_events.js"></script>

</html>