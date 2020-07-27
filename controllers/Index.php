<?php
    session_start();
    // check valid
    if (isset($_SESSION['user'])) {
        switch ($_SESSION['user']['role']) {
            case 'Administrator':
                header("Location: views/admin.php");
                exit;
                break;
                
                default:
                header("Location: views/user.php");
                exit;
                break;
        }
    }


    require('Functions.php');
    
    if (isset($_POST['loginButton'])) {
        $username = $_POST['loginUsername'];
        $password = $_POST['loginPassword'];
        $check = loginChecked($username, $password);
    }
