<?php
session_start();
if (isset($_SESSION['username']) || isset($_COOKIE['user'])) {
    header("Location: index.php");
}


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    include "db.php";
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM `user` WHERE `username` = '$username' AND `password` = '$password';";
    $result = $conn->execute_query($sql);
    if ($result->num_rows > 0) {
        $data = $username . "-" . $password;
        $key = "shalin";
        $method = "AES-256-CBC";
        $option = 0;
        $iv = 1234567891011121;
        $encryption = openssl_encrypt($data, $method, $key, $option, $iv);
        if (isset($_POST["remember"])) {
            setcookie("user", $encryption, time() + 86400, $secure = true);
        }
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        header("Location: index.php");
    } else {
        echo "login failed";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
</head>

<body>
    <form method="post">
        <label for="username">Username</label>
        <input type="text" name="username" id="username"><br>
        <label for="password">Password</label>
        <input type="password" name="password" id="password"><br>
        <input type="checkbox" name="remember" id="remember">
        <label for="remember">Remember me</label><br>
        <button type="submit">LOGIN</button>
    </form>
</body>

</html>