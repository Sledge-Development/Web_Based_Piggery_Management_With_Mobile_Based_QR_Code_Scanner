<?php
include "configs/php/db.php";
$sql = "select `job` from tbl_user where is_exist='true' and job='owner';";
$stmt = $connect->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows >= 1) {
    header('location:index.php?error=409');
}
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
    <title>Setup-Create Admin</title>
    <script src="/assets/jquery.js"></script>
    <link rel="stylesheet" href="/assets/css/tailwind.css">
    <link rel="stylesheet" href="/assets/css/custom.css">
    <link rel="stylesheet" href="/assets/notyf/notyf.min.css">

</head>

<body>
    <div class="w-screen flex h-screen bg-gray-900">
        <form id="admin-new" method="post" class="mx-auto my-auto overflow-y-auto no-scroll bg-white rounded-md w-1/2 flex flex-col h-3/4">
            <span class="w-full mx-auto text-2xl my-4 font-bold text-center">CREATE ADMINISTRATOR ACCOUNT</span>
            <div class="flex flex-col text-lg font-bold font-mono mx-auto w-3/4">
                <span>Username:</span>
                <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" type="text" name="username" id="username">
            </div>
            <div class="flex flex-col text-lg font-bold font-mono mx-auto w-3/4">
                <span>Password:</span>
                <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" type="password" minlength="8" name="password" id="password">
            </div>
            <div class="flex flex-col text-lg font-bold font-mono mx-auto w-3/4">
                <span>First Name:</span>
                <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" type="text" name="first_name" id="first_name">
            </div>
            <div class="flex flex-col text-lg font-bold font-mono mx-auto w-3/4">
                <span>Middle Name:</span>
                <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" type="text" name="middle_name" id="middle_name">
            </div>
            <div class="flex flex-col text-lg font-bold font-mono mx-auto w-3/4">
                <span>Last Name:</span>
                <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" type="text" name="last_name" id="last_name">
            </div>
            <div class="flex flex-col text-lg font-bold font-mono mx-auto w-3/4">
                <span>Phone Number:</span>
                <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" type="text" name="phone" id="phone" minlength="13" maxlength="13">
            </div>
            <input class="p-4 w-1/4 h-24 bg-blue-500 text-center mx-auto my-2" type="submit" value="Create" id="submit" />
        </form>
    </div>
</body>
<script src="/assets/notyf//notyf.min.js"></script>
<script src="/assets/js/notif_handler.js"></script>
<script src="configs/js/admin.js"></script>

</html>