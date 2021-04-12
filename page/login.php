<?php
// error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED);
session_start();
require('../config/db_sql.php');
if (isset($_POST['register'])) {
    header('Location: register.php');
}
if (isset($_POST['login'])) {
    $secretKey = "6Ld6pHcaAAAAAGuniB5cXORFIqsQTkTDwtNxX-mN";
    $token = $_POST['g-token'];
    $ip = $_SERVER['REMOTE_ADDR'];
    $url = "https://www.google.com/recaptcha/api/siteverify";
    $fieds = [
        'secret' => $secretKey,
        'response' => $token,
        'remoteip' => $ip
    ];
    $fields_string = http_build_query($fieds);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = json_decode(curl_exec($ch));
    var_dump($result);
    if ($result->success == 1) {
        # code...
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
        $password = md5(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING));
        $query = $mysqli->query("SELECT * FROM tb_pengguna, tb_direktorat, tb_divisi, tb_level 
                                WHERE tb_pengguna.id_level = tb_level.id_level AND tb_pengguna.id_direktorat = tb_direktorat.id_direktorat 
                                    AND tb_pengguna.id_divisi = tb_divisi.id_divisi AND tb_pengguna.username='$username' AND tb_pengguna.password='$password'") or die ($mysqli->error);
        // var_dump($query);  
        // var_dump($_SESSION);              
        if (mysqli_num_rows($query) > 0) {
            $row = mysqli_fetch_assoc($query);
            $_SESSION['id_pengguna']    = $row['id_pengguna'];
            $_SESSION['nama']           = $row['nama_pengguna'];
            $_SESSION['username']       = $row['username'];
            $_SESSION['foto']           = $row['foto'];
            $_SESSION['id_direktorat']  = $row['id_direktorat'];
            $_SESSION['direktorat']     = $row['direktorat'];
            $_SESSION['id_divisi']      = $row['id_divisi'];
            $_SESSION['divisi']         = $row['divisi'];
            if (isset($_POST['remember'])) {
                //cookie
                setcookie('login', 'true', time() + 60);
                setcookie('key', hash('sha256', $row['username']));
            }
            if ($row['id_level'] == 2) {
                $_SESSION['admin'] = $username;
                header("Location: ../admin/index.php");
            } else if  ($row['id_level'] == 1) {
                echo "Masuk sini gan";
                $_SESSION['super'] = $username;
                header("Location: ../super/index.php");
            }
        } else {
            echo "<script language='javascript'>alert('User tidak ditemukan');</script>";
        }
    }
} ?>


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
    <title>Login</title>
    <!-- BEGIN: CSS Assets-->
    <link rel="stylesheet" href="../dist/css/app.css" />
    <script src="https://www.google.com/recaptcha/api.js?render=6Ld6pHcaAAAAAGJZ3dX3L4tWMkWX4NYvg1OmGcGM"></script>

    <!-- END: CSS Assets-->
</head>
<!-- END: Head -->

<body class="login">
    <div class="container sm:px-10">
        <div class="block xl:grid grid-cols-2 gap-4">
            <!-- BEGIN: Login Info -->
            <div class="hidden xl:flex flex-col min-h-screen">
                <div class="absolute inset-y-0 left-0 ml-20 pt-5">
                    <img alt="Midone Tailwind HTML Admin Template" class="h-10" src="../img/BUMN-PAL-R1.png">
                </div>
                <div class="absolute inset-y-0 right-0 mr-20 pt-5 ">
                    <img alt="Midone Tailwind HTML Admin Template" class=" h-10" src="../img/pal.png">
                </div>
                <div class="my-auto">
                    <div class="-intro-x text-white font-medium text-4xl leading-tight mt-10">
                        Welcome to
                        <br>
                        Knowledge Management
                        <br>
                        PT PAL Indonesia
                    </div>
                    <div class="-intro-x mt-5 text-lg text-white dark:text-gray-500"></div>
                </div>
            </div>
            <!-- END: Login Info -->
            <!-- BEGIN: Login Form -->

            <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
                <div class="my-auto mx-auto xl:ml-20 bg-white xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                    <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">
                        Sign In
                    </h2>
                    <form id="login-form" method="POST" action="">
                        <div class="intro-x mt-2 text-gray-500 xl:hidden text-center">A few more clicks to sign in to your account. Manage all your e-commerce accounts in one place</div>
                        <div class="intro-x mt-8">
                            <input type="hidden" name="g-token" id="g-token">
                            <input type="text" name="username" class="intro-x login__input input input--lg border border-gray-300 block" placeholder="username">
                            <input type="password" name="password" class="intro-x login__input input input--lg border border-gray-300 block mt-4" placeholder="password">
                        </div>
                        <div class="intro-x flex text-gray-700 dark:text-gray-600 text-xs sm:text-sm mt-4">
                            <div class="flex items-center mr-auto">
                                <input type="checkbox" class="input border mr-2" name="remember" id="remember-me">
                                <label class="cursor-pointer select-none" for="remember-me">Remember me</label>
                            </div>
                            <a href="">Forgot Password?</a>
                        </div>
                        <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                            <button class="button button--lg w-full xl:w-32 text-white bg-theme-1 xl:mr-3 align-top" name="login">Login</button>
                            <button class="button button--lg w-full xl:w-32 text-gray-700 border border-gray-300 dark:border-dark-5 dark:text-gray-300 mt-3 xl:mt-0 align-top" name="register">Sign up</button>
                        </div>
                        <div class="intro-x mt-10 xl:mt-24 text-gray-700 dark:text-gray-600 text-center xl:text-left">
                            By signin up, you agree to our
                            <br>
                            <a class="text-theme-1 dark:text-theme-10" href="">Terms and Conditions</a> & <a class="text-theme-1 dark:text-theme-10" href="">Privacy Policy</a>
                        </div>
                    </form>
                </div>
            </div>
            <!-- END: Login Form -->
        </div>
    </div>

    <!-- BEGIN: JS Assets-->
    <script src="../dist/js/app.js"></script>
    <script>
        grecaptcha.ready(function() {
            grecaptcha.execute('6Ld6pHcaAAAAAGJZ3dX3L4tWMkWX4NYvg1OmGcGM', {
                action: 'submit'
            }).then(function(token) {
                document.getElementById('g-token').value = token;
                console.log(document.getElementById('g-token').value);
            });
        });
        console.log("Test")
    </script>
    <!-- END: JS Assets-->
</body>

</html>