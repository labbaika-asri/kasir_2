<?php
    if (isset($_POST["submitCashier"])) {
        // var_dump($_POST);

        if (outputStock($_POST) > 0) {
            setFlash('success', 'Successfull!', '');
        } elseif (!isset($_SESSION['flash'])) {
            setFlash('error', 'Unsuccessfull!', 'Please try again.');
        }
    }
