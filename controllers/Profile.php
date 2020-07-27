<?php

    // Change profile data
    if (isset($_POST['updateProfile'])) {
        if (updateProfile($_POST) > 0) {
            setFlash('success', 'Successfull!', 'Profile successfully changed.');
        } elseif (!isset($_SESSION['flash'])) {
            setFlash('error', 'Unsuccessfull!', 'Please try again.');
        }
    }

    // Change Password User
    if (isset($_POST['changePassword'])) {
        $username = $_POST["username"];
        $password = $_POST["password"];
        $rePassword = $_POST["rePassword"];
        if (changePassword($username, $password, $rePassword) > 0) {
            setFlash('success', 'Successfull!', 'Password was change successfully.');
        } else {
            setFlash('error', 'Unsuccessfull!', 'Password was not change successfully.');
        }
    }
