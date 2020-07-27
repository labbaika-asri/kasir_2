<?php
    require('../Functions.php');

    $brandType =  mysqli_escape_string($conn, $_POST['brandType']);
    $color =  mysqli_escape_string($conn, $_POST['color']);

    $result = getAllDataQuery("SELECT DISTINCT CONCAT_ws(' ', brand, type), memory FROM `stock` WHERE CONCAT_ws(' ', brand, type) = '$brandType' AND color = '$color'");

    if ($result) {
        $memory = [];
        for ($i=0; $i < count($result); $i++) {
            array_push($memory, $result[$i]['memory']);
        }

        echo json_encode($memory);
    }
