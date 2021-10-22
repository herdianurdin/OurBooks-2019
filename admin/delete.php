<?php
    session_start();

    if (!$_SESSION['login']) {
        header('Location: login.php');
        exit;
    }

    require "../controller/controller.php";

    $id = $_GET["id"];
    deleteBook($id);