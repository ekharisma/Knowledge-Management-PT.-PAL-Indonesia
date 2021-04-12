<?php
require('../config/db_sql.php');
$sql = "SELECT * FROM tb_direktorat";
$result_direktorat = $mysqli->query($sql);

if (isset($_POST['id_direktorat'])) {
    $id_direktorat = $_POST['id_direktorat'];
    $sql = "SELECT * FROM tb_divisi WHERE id_direktorat=?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $id_direktorat);
    $stmt->execute();
    $result_divisi = $stmt->get_result();
    while ($divisi = $result_divisi->fetch_assoc()) {
        echo "<option value='" . $divisi['id_divisi'] . "'>" . $divisi['divisi'] . "</option>";
    }
}


if (isset($_POST['register'])) {
    $sql = "INSERT INTO tb_pengguna (nama_pengguna, username, password, foto, id_level, id_direktorat, id_divisi)
            VALUES (?,?,?,?,?,?,?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ssssiii", $name, $username, $password, $foto, $level, $direktorat, $divisi);
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = md5(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING));
    $foto = "pal.png";
    $level = filter_input(INPUT_POST, 'level', FILTER_SANITIZE_NUMBER_INT);
    $direktorat = filter_input(INPUT_POST, 'direktorat', FILTER_SANITIZE_NUMBER_INT);
    $divisi = filter_input(INPUT_POST, 'divisi', FILTER_SANITIZE_NUMBER_INT);

    if ($stmt->execute()) {
        echo $mysqli->affected_rows;
        header("Location: login.php");
    } else {
        echo $stmt->error;
        echo $password;
    }
    $stmt->close();
    $mysqli->close();
}
?>

<!DOCTYPE html>
<!--
Template Name: Midone - HTML Admin Dashboard Template
Author: Left4code
Website: http://www.left4code.com/
Contact: muhammadrizki@left4code.com
Purchase: https://themeforest.net/user/left4code/portfolio
Renew Support: https://themeforest.net/user/left4code/portfolio
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<html lang="en" class="light">
<!-- BEGIN: Head -->

<head>
    <meta charset="utf-8">
    <link href="../dist/images/logo.svg" rel="shortcut icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Midone admin is super flexible, powerful, clean & modern responsive tailwind admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Midone admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="LEFT4CODE">
    <title>Register</title>
    <!-- BEGIN: CSS Assets-->
    <link rel="stylesheet" href="../dist/css/app.css" />
    <!-- END: CSS Assets-->
</head>
<!-- END: Head -->

<body class="login">
    <div class="container sm:px-10">
        <div class="block xl:grid grid-cols-2 gap-4">
            <!-- BEGIN: Register Info -->
            <div class="hidden xl:flex flex-col min-h-screen">
                <a href="" class="-intro-x flex items-center pt-5">
                    <img alt="Midone Tailwind HTML Admin Template" class="w-6" src="../dist/images/logo.svg">
                    <span class="text-white text-lg ml-3"> Mid<span class="font-medium">One</span> </span>
                </a>
                <div class="my-auto">
                    <img alt="Midone Tailwind HTML Admin Template" class="-intro-x w-1/2 -mt-16" src="../dist/images/illustration.svg">
                    <div class="-intro-x text-white font-medium text-4xl leading-tight mt-10">
                        A few more clicks to
                        <br>
                        sign up to your account.

                    </div>
                    <div class="-intro-x mt-5 text-lg text-white dark:text-gray-500">Manage all your e-commerce accounts in one place</div>
                </div>
            </div>
            <!-- END: Register Info -->
            <!-- BEGIN: Register Form -->
            <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
                <div class="my-auto mx-auto xl:ml-20 bg-white xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                    <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">
                        Sign Up
                    </h2>
                    <div class="intro-x mt-2 text-gray-500 dark:text-gray-500 xl:hidden text-center">A few more clicks to sign in to your account. Manage all your e-commerce accounts in one place</div>
                    <form method="POST" enctype="multipart/form-data" action="">
                        <div class="intro-x mt-8">
                            <input type="text" class="intro-x login__input input input--lg border border-gray-300 " name="name" placeholder="Name">
                            <input type="text" class="intro-x login__input input input--lg border border-gray-300 block mt-4" name="username" placeholder="Username">
                            <div class="intro-y col-span-12 sm:col-span-6 mt-4">
                                <select id="direktorat" name="direktorat" class="input w-full border flex-1">
                                    <option>--Pilih Direktorat--</option>
                                    <?php foreach ($result_direktorat as $direktorat) : ?>
                                        <option value="<?= $direktorat['id_direktorat'] ?>"><?= $direktorat['direktorat'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-6 mt-4">
                                <select id="divisi" name="divisi" class="input w-full border flex-1">
                                    <option value="">--Pilih Divisi--</option>
                                </select>
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-6 mt-4">
                                <div class="sm:mt-2"> <select name="level" class="input w-full">
                                        <option>--Pilih Level--</option>
                                        <option value="1">Admin</option>
                                        <option value="2">User</option>
                                    </select> </div>
                                <input type="password" class="intro-x login__input input input--lg border border-gray-300 block mt-4" name="password" placeholder="Password">
                            </div>
                            <div class="intro-x flex items-center text-gray-700 dark:text-gray-600 mt-4 text-xs sm:text-sm">
                                <input type="checkbox" class="input border mr-2" id="remember-me">
                                <label class="cursor-pointer select-none" for="remember-me">I agree to the Envato</label>
                                <a class="text-theme-1 dark:text-theme-10 ml-1" href="">Privacy Policy</a>.
                            </div>
                            <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                                <input class="button button--lg w-full xl:w-32 text-white bg-theme-1 xl:mr-3 align-top" type="submit" value="Register" name="register"></input>
                            </div>
                    </form>
                </div>
            </div>
            <!-- END: Register Form -->
        </div>
    </div>
    
    <!-- BEGIN: JS Assets-->
    <script src="../dist/js/app.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        var url = "../dist/js/register.js";
        $.getScript(url);
    </script>
    <!-- END: JS Assets-->
</body>

</html>