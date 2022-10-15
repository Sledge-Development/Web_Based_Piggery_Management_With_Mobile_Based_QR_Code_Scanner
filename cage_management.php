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
    <title>Cage Management</title>
</head>

<body>
    <div id="view_cage_detail" class="w-screen hidden h-screen rounded-md shadow-2xl flex bg-black/50 overflow-hidden absolute">
        <div class="w-1/2 bg-white overflow-y-auto shadow-2xl rounded-md h-auto flex flex-col   my-auto mx-auto">
            <div class="w-full h-1/12 grid">
                <h1 class="text-center text-2xl my-4">View Schedule Details</h1>
            </div>
            <div class="w-full flex overflow-y-auto no-scroll flex-col h-11/12 ">
                <div class="w-3/4 mx-auto mt-2 mb-2 h-auto flex flex-col">
                    <span class="text-xl font-mono my-auto">Cage ID:</span>
                    <span id="view_cage_id" class="my-auto text-xl">1</span>
                </div>
                <div class="w-3/4 mx-auto mt-2 mb-2 h-auto flex flex-col">
                    <span class="text-xl font-mono my-auto">Cage Name:</span>
                    <span id="view_cage_name" class="my-auto text-xl">1</span>
                </div>
                <div class="w-3/4 mx-auto mt-2 mb-2 h-auto flex flex-col">
                    <span class="text-xl font-mono my-auto">Cage Total Pigs:</span>
                    <span id="view_cage_total" class="my-auto text-xl">1</span>
                </div>
                <div class="w-full mb-2 h-16 flex flex-row">
                    <button class="w-1/4 h-12 rounded-md bg-blue-500 hover:bg-red-400 mx-auto my-auto" id="confirm_view_cage">OK</button>
                </div>
            </div>
        </div>
    </div>
    <div id="add_cage" class="w-screen hidden h-screen  flex bg-black/50 overflow-hidden absolute">
        <form id="add_cage_form" method="post" class="w-1/2 bg-white overflow-y-auto shadow-2xl rounded-md h-auto flex flex-col   my-auto mx-auto">
            <div class="w-full h-1/12 my-4 grid">
                <h1 class="text-center text-2xl my-auto">New Cage Details</h1>
            </div>
            <div class="w-full flex overflow-y-auto no-scroll flex-col h-11/12 ">
                <div class="w-3/4 mx-auto mt-2 mb-2 h-auto flex flex-col">
                    <span class="text-xl font-mono my-auto"> Cage Name</span>
                    <input id="cage_name" name="cage_name" type="text" class="shadow appearance-none border  rounded w-full mx-auto h-12 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="w-full mb-2 h-16 flex flex-row">
                    <input type="submit" class="w-1/4 h-12 rounded-md bg-blue-500 hover:bg-red-400 mx-auto my-auto" value="Add" />
                    <button class="w-1/4 h-12 rounded-md bg-blue-500 hover:bg-red-400 mx-auto my-auto" id="cancel_add_batch">Cancel </button>
                </div>
            </div>
        </form>
    </div>
    <div id="edit_cage_details" class="w-screen hidden  h-screen  flex bg-black/50 overflow-hidden absolute">
        <form method="post" id="edit_cage_form" class="w-1/2 bg-white overflow-y-auto shadow-2xl rounded-md h-auto flex flex-col   my-auto mx-auto">
            <div class="w-full h-1/12 grid ">
                <h1 class="text-center text-2xl my-4">Edit Batch Details</h1>
            </div>
            <div class="w-full flex overflow-y-auto no-scroll flex-col h-11/12 ">
                <div class="w-3/4 mx-auto mt-2 mb-2 h-auto flex flex-col">
                    <span class="text-xl font-mono my-auto">Cage Id:</span>
                    <input type="text" name="cage_id" disabled id="edit_cage_id" class="shadow appearance-none border rounded w-full ml-auto mr-auto h-12 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="w-3/4 mx-auto mt-2 mb-2 h-auto flex flex-col">
                    <span class="text-xl font-mono my-auto">Cage Name:</span>
                    <input type="text" name="cage_name" id="edit_cage_name" class="shadow appearance-none border rounded w-full ml-auto mr-auto h-12 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="w-full mb-2 h-16 flex flex-row">
                    <button class="w-1/4 h-12 rounded-md bg-blue-500 hover:bg-red-400 mx-auto my-auto" id="confirm_edit_pigs">Edit</button>
                    <button class="w-1/4 h-12 rounded-md bg-blue-500 hover:bg-red-400 mx-auto my-auto" id="cancel_edit_pigs">Cancel </button>
                </div>
            </div>
        </form>
    </div>
    <div class="w-screen h-screen bg-gray-800 flex flex-col overflow-hidden">
        <div class="w-full h-1/12 grid header-em">
            <h1 class="mr-4 ml-auto mt-auto mb-auto text-white">RVM HOG FARM</h1>
        </div>
        <div class="h-11/12 w-full flex flex-row bg-gray-400">
            <?php echo MenuRender($full_name);?>
            <div class="h-full w-5/6 flex flex-col bg-gray-600">
                <div class="w-full flex mt-2 flex-row">
                    <img class="w-12 h-12 mr-4 ml-8" src="assets/svg/cage.png" alt="icon_user">
                    <h1 class="mt-auto text-white mb-auto font-bold">Cage Management</h1>
                    <button id="new_cage" class="w-1/6 my-auto rounded-md   h-5/6 bg-blue-500 hover:bg-red-400 ml-auto mr-6">
                        New Cage
                    </button>
                </div>
                <div class="w-5/6 h-5/6 mx-auto my-auto overflow-y-auto">
                    <table id="cage-data-table" class="table-fixed w-full  ">
                        <thead>
                            <th>Cage Id</th>
                            <th>Cage Number</th>
                            <th>Total Pig</th>
                            <th>Action</th>
                        </thead>
                        <?php
                        $sql = "select * from tbl_cage where is_exist='true';";
                        $stmt = $connect->prepare($sql);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        if ($result->num_rows >= 1) {
                            while ($row = $result->fetch_assoc()) {
                                echo '<tr class="cage-data cursor-pointer table_row_record_details">' .
                                    '<td>' . $row["cage_id"] . '</td>' .
                                    '<td>' . $row["cage_name"] . '</td>' .
                                    '<td>' . getTotal($connect, $row["cage_id"]) . '</td>' .
                                    '<td class="text-center flex flex-row">' .
                                    '<span id="edit_01" class="my-auto hover:text-blue-500" onclick="edit_pig_details(\'' . $row["cage_id"] . '\',\'' . $row["cage_name"] . '\')">Edit</span>' .
                                    '</tr>';
                            }
                        } else {
                            echo '<tr class="cage-data cursor-pointer table_row_record_details">' .
                                '<td colspan="4">No data found...</td>' .
                                '</tr>';
                        } ?>
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
<script src="assets/js/cage_management_event.js"></script>

</html>