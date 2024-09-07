<?php
session_start();
if (!isset($_SESSION['username'])) {
    if (!isset($_COOKIE['user'])) {
        header("Location: login.php");
    } else {
        $user = $_COOKIE['user'];
        echo $user;
        $key = "shalin";
        $method = "AES-256-CBC";
        $option = 0;
        $iv = 1234567891011121;
        $decryption = openssl_decrypt($user, $method, $key, $option, $iv);
        echo $decryption;
        $_SESSION['username'] = explode("-", $decryption)[0];
        $_SESSION['password'] = explode("-", $decryption)[1];
    }
}
