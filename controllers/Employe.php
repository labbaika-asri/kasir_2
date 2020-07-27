<?php
    // Get all employe data
    $employes = getAllEmployes();

    // Add new employe
    if (isset($_POST['addNewEmployeButton'])) {
        if (addNewEmploye($_POST) > 0) {
            setFlash('success', 'Successfull!', 'New employe have been added.');
        } elseif (!isset($_SESSION['flash'])) {
            setFlash('error', 'Unsuccessfull!', 'Please try again.');
        }
    }

    // Change password employe
    if (isset($_POST['changeEmployePasswordButton'])) {
        $username = $_POST["changeEmployePasswordUsername"];
        $password = $_POST["changeEmployePassword"];
        $rePassword = $_POST["changeEmployeRePassword"];
        if (changePassword($username, $password, $rePassword) > 0) {
            setFlash('success', 'Successfull!', 'The employe password was change successfully');
        } else {
            setFlash('error', 'Unsuccessfull!', 'The employe password was not change successfully.');
        }
    }
