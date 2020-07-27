<?php
    session_start();
    // Check valid
    if (!isset($_SESSION['user'])) {
        header('Location: ../index.php');
        exit;
    } elseif (isset($_SESSION['user']) && $_SESSION['user']['role'] !== 'Employe') {
        header('Location: admin.php');
    } elseif (isset($_SESSION['user']) && $_SESSION['user']['name'] === '' && $_SESSION['user']['phone_number'] === '') {
        $_GET['menu'] = 'profile';
    }
    
    require('Functions.php');
    // set Session
    setSession($_SESSION['user']['username']);
