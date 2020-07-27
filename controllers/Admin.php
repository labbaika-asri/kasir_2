<?php
    session_start();
    // Check valid
    if (!isset($_SESSION['user'])) {
        header('Location: ../index.php');
        exit;
    } elseif (isset($_SESSION['user']) && $_SESSION['user']['role'] !== 'Administrator') {
        header('Location: user.php');
    }
    require('Functions.php');
    // set Session
    setSession($_SESSION['user']['username']);
