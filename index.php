<?php
include "configs/php/db.php";
$sql = "select `job` from tbl_user where is_exist='true' and job='owner';";
$stmt = $connect->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows <= 0) {
    header('location:/newuser.php');
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
    <link rel="shortcut icon" href="/assets/img/favicon/android-chrome-512x512.png" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/tailwind.css">
    <link rel="stylesheet" href="assets/notyf/notyf.min.css">
    <script src="assets/jquery.js"></script>
    <title>Login</title>
</head>

<body>
    <div class="w-screen h-screen bg-gray-800 grid overflow-hidden">
        <form id="login" method="post" class="w-1/4 h-3/4 bg-gray-600 mr-auto ml-auto rounded-md shadow-2xl flex flex-col mb-2 mt-auto">
            <div class="flex flex-col w-full mt-6 col-span-3">
                <img class="w-36 bg-white mx-auto my-auto rounded-full h-36 mt-2 mb-2" src="assets/img/logo.png" alt="logo">
                <h1 class="text-center text-xl text-white mt-2 mb-2">RVM HOG FARM</h1>
            </div>
            <input class="w-3/4 h-12 mt-2 mb-2 focus:outline-none text-center rounded-md mr-auto ml-auto" type="text" name="username" id="username" placeholder="Username">
            <input class="w-3/4 h-12 mt-2 mb-2 focus:outline-none text-center rounded-md mr-auto ml-auto" type="password" name="password" id="password" placeholder="Password">
            <input class="w-1/2 rounded-md shadow-2xl h-12 mx-auto mt-2 mb-2 focus:outline-none hover:bg-red-400 bg-blue-500 bg" type="submit" value="Login">
        </form>
        <a class="text-center text-white underline mt-0 mb-auto" href="/forgot_password.html">Forgot Password?</a>
    </div>
</body>
<script src="assets/notyf/notyf.min.js"></script>
<script src="assets/js/notif_handler.js"></script>
<script src="configs/js/login.js"></script>

</html>