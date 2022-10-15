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
    <title>User Management</title>
</head>

<body>
    <div id="view_record_details" class="w-screen hidden h-screen rounded-md shadow-2xl flex bg-black/50 overflow-hidden absolute">
        <div class="w-1/2 h-3/4 flex flex-col rounded-md bg-white my-auto mx-auto">
            <div class="w-full h-1/12 grid">
                <h1 class="text-center text-2xl my-4">User Details</h1>
            </div>
            <div class="w-full grid grid-cols-1 h-11/12 ">
                <div class="w-full h-12 flex flex-col">
                    <span class="text-2xl my-auto ml-2 mr-4">Username</span>
                    <span id="username" class="text-lg ml-4 my-auto font-mono">135790</span>
                </div>
                <div class="w-full h-12 flex flex-col">
                    <span class="text-2xl my-auto ml-2 mr-4">First Name</span>
                    <span id="first_name" class="text-lg ml-4 my-auto font-mono">Deworming</span>
                </div>
                <div class="w-full h-12 flex flex-col">
                    <span class="text-2xl my-auto ml-2 mr-4">Middle Name</span>
                    <span id="middle_name" class="text-lg ml-4 my-auto font-mono">Ivermectin</span>
                </div>
                <div class="w-full h-12 flex flex-col">
                    <span class="text-2xl my-auto ml-2 mr-4">Last Name</span>
                    <span id="last_name" class="text-lg ml-4 my-auto font-mono">Royd Catalunes</span>
                </div>
                <div class="w-full h-12 flex flex-col">
                    <span class="text-2xl my-auto ml-2 mr-4">Phone Number</span>
                    <span id="phone_number" class="text-lg ml-4 my-auto font-mono">07/04/2022</span>
                </div>
                <div class="w-full h-12 flex flex-col">
                    <span class="text-2xl my-auto ml-2 mr-4">Job</span>
                    <span id="job" class="text-lg ml-4 my-auto font-mono">07/04/2022</span>
                </div>
                <div class="w-full h-12 flex flex-col">
                    <button class="w-1/4 h-full rounded-md bg-blue-500 hover:bg-red-400 mx-auto my-auto" id="close_user_detail">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div id="add_new_user_details" class="w-screen no-scroll hidden  h-screen  flex bg-black/50 overflow-hidden absolute">
        <form method="post" id="new_user_form" class="w-1/2 bg-white shadow-2xl overflow-y-auto no-scrollbar  rounded-md h-11/12 flex flex-col   my-auto mx-auto">
            <div class="w-full h-1/12 grid">
                <h1 class="text-center text-2xl my-4">New User Details</h1>
            </div>
            <div class="w-full flex flex-col h-auto ">
                <div class="w-3/4 mt-2 mb-2 h-auto flex flex-col mx-auto">
                    <span class="text-xl font-mono ml- my-auto">Username:</span>
                    <input type="text" name="username" id="add_username" class="shadow appearance-none border  rounded w-full h-12 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="w-3/4 mx-auto mt-2 mb-2 h-auto flex flex-col">
                    <span class="text-xl font-mono my-auto">Password:</span>
                    <input type="password" name="password" id="add_password" class="shadow appearance-none border  rounded w-full mx-auto h-12 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="w-3/4 mx-auto mt-2 mb-2 h-auto flex flex-col">
                    <span class="text-xl font-mono my-auto">First Name:</span>
                    <input type="text" name="first_name" id="add_first_name" class="shadow appearance-none border  rounded w-full mx-auto h-12 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="w-3/4 mx-auto mt-2 mb-2 h-auto flex flex-col">
                    <span class="text-xl font-mono my-auto">Middle Name:</span>
                    <input type="text" name="middle_name" id="add_middle_name" class="shadow appearance-none border  rounded w-full mx-auto h-12 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="w-3/4 mx-auto mt-2 mb-2 h-auto flex flex-col">
                    <span class="text-xl font-mono my-auto">Last Name:</span>
                    <input type="text" name="last_name" id="add_last_name" class="shadow appearance-none border  rounded w-full mx-auto h-12 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="w-3/4 mx-auto mt-2 mb-2 h-24 flex flex-col">
                    <span class="text-xl font-mono">Phone Number:</span>
                    <input name="phone_number" type="text" id="add_phone" class="shadow appearance-none border  rounded w-full h-12 mx-auto  text-gray-700  leading-tight focus:outline-none focus:shadow-outline" minlength="13" maxlength="13">
                </div>
                <div class="w-3/4 mx-auto mt-2 mb-2 h-24 flex flex-col">
                    <span class="text-xl font-mono">Email:</span>
                    <input name="email" type="email" id="add_email" class="shadow appearance-none border  rounded w-full h-12 mx-auto  text-gray-700  leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="w-3/4 mx-auto mt-2 mb-2 h-24 flex flex-col">
                    <span class="text-xl font-mono">Job:</span>
                    <select class="shadow appearance-none border  rounded w-full h-12 mx-auto  text-gray-700  leading-tight focus:outline-none focus:shadow-outline" name="job" id="add_job">
                        <option value="default">Job</option>
                        <option value="worker">Worker</option>
                        <option value="owner">Owner</option>
                        <option value="veterinarian">Veterinarian</option>
                    </select>
                </div>
                <div class="w-full pb-16 mb-4 h-12 flex flex-row">
                    <input type="submit" class="w-1/4 h-12 rounded-md bg-blue-500 hover:bg-red-400 mx-auto my-auto" id="confirm_add_vaccination_details" value="Add">
                    <button class="w-1/4 h-12 rounded-md bg-blue-500 hover:bg-red-400 mx-auto my-auto" id="cancel_add_user_details">Cancel </button>
                </div>
            </div>
        </form>
    </div>
    <div id="edit_user_details" class="w-screen   h-screen hidden flex bg-black/50 overflow-hidden absolute">
        <form method="post" id="edit_user_form" class="w-1/2 bg-white shadow-2xl overflow-y-auto no-scroll rounded-md h-11/12 flex flex-col   my-auto mx-auto">
            <div class="w-full h-1/12 grid ">
                <h1 class="text-center text-2xl my-4">Edit User Details</h1>
            </div>
            <div class="w-full mx-auto flex flex-col h-auto ">
                <div class="w-3/4 mx-auto mt-2 mb-2 h-auto flex flex-col">
                    <span class="text-xl font-mono my-auto">Username:</span>
                    <input type="text" name="username" id="edit_username" class="shadow appearance-none border  rounded w-full mx-auto h-12 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="w-3/4 mx-auto mt-2 mb-2 h-auto flex flex-col">
                    <span class="text-xl font-mono my-auto">Password:</span>
                    <input type="password" name="password" id="edit_password" class="shadow appearance-none border  rounded w-full mx-auto h-12 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="w-3/4 mx-auto mt-2 mb-2 h-auto flex flex-col">
                    <span class="text-xl font-mono my-auto">First Name:</span>
                    <input type="text" name="first_name" id="edit_first_name" class="shadow appearance-none border  rounded w-full mx-auto h-12 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="w-3/4 mx-auto mt-2 mb-2 h-auto flex flex-col">
                    <span class="text-xl font-mono my-auto">Middle Name:</span>
                    <input type="text" name="middle_name" id="edit_middle_name" class="shadow appearance-none border  rounded w-full mx-auto h-12 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="w-3/4 mx-auto mt-2 mb-2 h-auto flex flex-col">
                    <span class="text-xl font-mono my-auto">Last Name:</span>
                    <input type="text" name="last_name" id="edit_last_name" class="shadow appearance-none border  rounded w-full mx-auto h-12 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="w-3/4 mx-auto mt-2 mb-2 h-24 flex flex-col">
                    <span class="text-xl font-mono">Phone Number:</span>
                    <input name="phone_number" type="text" id="edit_phone" maxlength="13" minlength="13" class="shadow appearance-none border  rounded w-full h-12 mx-auto  text-gray-700  leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="w-3/4 mx-auto mt-2 mb-2 h-24 flex flex-col">
                    <span class="text-xl font-mono">Job:</span>
                    <select id="edit_job" class="shadow appearance-none border  rounded w-full h-12 mx-auto  text-gray-700  leading-tight focus:outline-none focus:shadow-outline" name="job">
                        <option value="default">Job</option>
                        <option value="worker">Worker</option>
                        <option value="owner">Owner</option>
                        <option value="veterinarian">Veterinarian</option>
                    </select>
                </div>
                <div class="w-full mb-4 pb-16 h-12 flex flex-row">
                    <input type="submit" class="w-1/4 h-12 rounded-md bg-blue-500 hover:bg-red-400 mx-auto my-auto" value="Edit">
                    <button class="w-1/4 h-12 rounded-md bg-blue-500 hover:bg-red-400 mx-auto my-auto" id="cancel_edit_user_details">Cancel </button>
                </div>
            </div>
        </form>
    </div>
    <div id="remove_user_details" class="w-screen hidden  h-screen  flex bg-black/50 overflow-hidden absolute">
        <div class="w-1/4 bg-white shadow-2xl rounded-md h-1/4 flex flex-col   my-auto mx-auto">
            <div class="w-full h-2/6 grid">
                <h1 class="text-center w-full text-2xl my-auto">Delete User Details</h1>
            </div>
            <div class="w-full grid overflow-y-auto grid-cols-1 h-11/12 ">
                <div class="w-full text-center">
                    <span>Are you sure you want to remove <span class="font-bold" id="remove_username"></span> from the system?</span>
                </div>
                <div class="w-full h-12 flex flex-row">
                    <button class="w-1/4 h-full rounded-md bg-blue-500 hover:bg-red-400 mx-auto my-auto" id="confirm_remove_user_detail">Remove </button>
                    <button class="w-1/4 h-full rounded-md bg-blue-500 hover:bg-red-400 mx-auto my-auto" id="cancel_remove_record_detail">Cancel </button>
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
                <div class="w-full flex flex-row">
                    <img class="w-12 h-12 mr-4 ml-8" src="assets/icons/dashboard_users.png" alt="icon_user">
                    <h1 class="mt-auto text-white mb-auto font-bold">Dashboard</h1>
                    <div class="w-auto mx-auto mt-2 flex flex-row">
                        <input class="w-64 placeholder-l-4 h-12 focus:outline-none" type="search" name="" placeholder="Search..." id="user_management_search">
                    </div>
                    <button id="new_user" class="w-1/6 my-auto rounded-md  h-5/6 bg-blue-500 hover:bg-red-400 ml-auto mr-6">
                        New User
                    </button>
                </div>
                <div class="w-5/6 h-5/6 mx-auto my-auto overflow-y-auto">
                    <table id="tbl_user" class="table-fixed w-full  overflow-hidden">
                        <thead>
                            <th>Username</th>
                            <th>First Name</th>
                            <th>Middle Name</th>
                            <th>Last Name</th>
                            <th>Phone Number</th>
                            <th>Job</th>
                            <th>Action</th>
                        </thead>
                        <?php
                        $sql = "select * from tbl_user where is_exist='true' ";
                        $stmt = $connect->prepare($sql);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        if ($result->num_rows != 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo ' <tr data="' . $row["user_id"] . '" class="user-data cursor-pointer table_row_record_details">' .
                                    '   <td>' . $row["username"] . '</td>'
                                    .  '<td>' . $row["first_name"] . '</td>'
                                    .  '<td>' . $row["middle_name"] . '</td>'
                                    .  '<td>' . $row["last_name"] . '</td>'
                                    .  '<td>' . $row["phone_number"] . '</td>'
                                    .  '<td>' . $row["job"] . '</td>'
                                    .   '<td class="text-center flex flex-row"><span id="edit_01" class="mr-2 hover:text-blue-500" onclick="edit_operation_details(\'' . $row["user_id"] . '\')">Edit</span>|<span class=" ml-2 hover:text-blue-500" id="delete_01" onclick="remove_operation_details(\'' . $row["user_id"] . '\')">Delete</span></td>'
                                    . '</tr>';
                            }
                        } else {
                            echo ' <tr class="user-data cursor-pointer table_row_record_details">' .
                                '<td colspan="7">No data on here yet...</td>' .
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
<script src="assets/js/user_management_events.js"></script>

</html>