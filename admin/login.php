<?php
    require_once '../controller/controller.php';
    session_start();
    
    if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
        $id_cookie = $_COOKIE['id'];
        $key_cookie = $_COOKIE['key'];

        $query = "SELECT username FROM users WHERE id=$id_cookie";
        $record = mysqli_query($connection, $query);
        $user = mysqli_fetch_assoc($record);
    
        if (password_verify($user['username'], $key_cookie)) {
            $_SESSION['login'] = true;
            header('Location: index.php');
            exit;
        }
    }

    if (isset($_SESSION['login'])) {
        header('Location: index.php');
        exit;
    }

    if (isset($_POST['submit'])) {
        $_SESSION['login'] = login($_POST);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - OurBooks</title>
    <link rel="shortcut icon" href="../assets/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/login.css">
</head>
<body>
    <main id="login-container">
        <form method="POST">
            <img src="../assets/Title.webp"/>
            <div class="input-form">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" autocomplete="off" autofocus>
            </div>
            <div class="input-form">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" autocomplete="off">
            </div>
            <div id="input-remember">
                <label for="remember">Remember me?</label>
                <input type="checkbox" name="remember" id="remember">
            </div>
            <div>
                <input type="submit" name="submit" id="btn-login" value="Login"> 
            </div>
        </form>
    </main>
</body>
</html>
