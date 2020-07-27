<?php
    if (isset($_POST["submitInputStock"])) {
        if (inputStock($_POST) > 0) {
            setFlash('success', 'Successfull!', 'Stock has been added.');
        } elseif (!isset($_SESSION['flash'])) {
            // setFlash('error', 'Unsuccessfull!', 'Please try again.');
        }
    }
