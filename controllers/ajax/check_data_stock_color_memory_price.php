<?php
    require('../Functions.php');

    $brandType =  mysqli_escape_string($conn, $_POST['brandType']);
    $color =  mysqli_escape_string($conn, $_POST['color']);
    $memory =  mysqli_escape_string($conn, $_POST['memory']);

    $result = getDataQuery("SELECT DISTINCT CONCAT_WS(' ', brand, type), purchase_price, selling_price, COUNT(*) AS 'stock' FROM `stock` WHERE CONCAT_WS(' ', brand, type) = '$brandType' AND color = '$color' AND memory = '$memory'");

    if ($result) {
        $data = [
            // 'purchase_price' => $result['purchase_price'],
            'selling_price' => $result['selling_price'],
            'stock' => $result['stock']
        ];

        echo json_encode($data);
    }
