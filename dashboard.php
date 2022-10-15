<?php
include "configs/php/general_function.php";
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
    <link defer rel="stylesheet" href="assets/notyf/notyf.min.css">
    <link rel="stylesheet" href="assets/css/custom.css">
    <script src="assets/jquery.js"></script>
    <title>Dashboard</title>
</head>

<body>
    <div class="w-screen h-screen bg-gray-800 flex flex-col overflow-hidden">
        <div class="w-full h-1/12 grid header-em">
            <h1 class="mr-4 ml-auto mt-auto mb-auto text-white">RVM HOG FARM</h1>
        </div>
        <div class="h-11/12 w-full flex flex-row overflow-y-auto bg-gray-400">
            <?php echo $renderer; ?>
            <div class="h-full w-5/6 flex flex-col bg-gray-600">
                <div class="w-full flex flex-row">
                    <img class="w-12 h-12 mr-4 ml-8" src="assets/icons/dashboard_users.png" alt="icon_user">
                    <h1 class="mt-auto text-white mb-auto font-bold">Dashboard</h1>
                </div>
                <div class="w-5/6 mx-auto gap-x-2 gap-y-4 grid rounded-md  mt-2 grid-cols-4">
                    <div class="hover:text-white hover:bg-gray-900 cursor-pointer shadow-2xl  rounded-md grid grid-rows-2 bg-white w-full h-36 flex-row">
                        <h1 class="text-center my-auto text-lg">Total no. Pig</h1>
                        <h1 class="text-center my-auto">10</h1>
                    </div>
                    <div class="hover:text-white hover:bg-gray-900 cursor-pointer shadow-2xl  rounded-md grid grid-rows-2 bg-white w-full h-36 flex-row">
                        <h1 class="text-center my-auto text-lg">Total no. Sow</h1>
                        <h1 class="text-center my-auto">5</h1>
                    </div>
                    <div class="hover:text-white hover:bg-gray-900 cursor-pointer shadow-2xl  rounded-md grid grid-rows-2 bg-white w-full h-36 flex-row">
                        <h1 class="text-center my-auto text-lg">Total Medicines</h1>
                        <h1 class="text-center my-auto">15</h1>
                    </div>
                    <div class="hover:text-white hover:bg-gray-900 cursor-pointer shadow-2xl  rounded-md grid grid-rows-2 bg-white w-full h-36 flex-row">
                        <h1 class="text-center my-auto text-lg">Total Supply</h1>
                        <h1 class="text-center my-auto">25</h1>
                    </div>
                    <div class="hover:text-white hover:bg-gray-900 cursor-pointer shadow-2xl  rounded-md grid grid-rows-2 bg-white w-full h-36 flex-row">
                        <h1 class="text-center my-auto text-lg">Total No. Boar</h1>
                        <h1 class="text-center my-auto">5</h1>
                    </div>
                    <div class="hover:text-white hover:bg-gray-900 cursor-pointer shadow-2xl  rounded-md grid grid-rows-2 bg-white w-full h-36 flex-row">
                        <h1 class="text-center my-auto text-lg">Total Feeds</h1>
                        <h1 class="text-center my-auto">8</h1>
                    </div>
                    <div class="hover:text-white hover:bg-gray-900 cursor-pointer shadow-2xl  rounded-md grid grid-rows-2 bg-white w-full h-36 flex-row">
                        <h1 class="text-center my-auto text-lg">Total Vitamins</h1>
                        <h1 class="text-center my-auto">20</h1>
                    </div>

                </div>
            </div>
        </div>
    </div>
</body>
<script src="assets/notyf/notyf.min.js"></script>
<script src="assets/js/notif_handler.js"></script>
<script src="assets/js/navigation.js"></script>

</html>