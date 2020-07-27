<?php
    require('../Functions.php');

    $keyword = trim(mysqli_escape_string($conn, $_POST['keyword']));
    $result = getAllDataQuery("SELECT DISTINCT CONCAT_ws(' ', brand, type), brand, type, color FROM `stock` WHERE CONCAT_ws(' ', brand, type) = '$keyword'");

    if ($result) {
        $colors = [];
        for ($i=0; $i < count($result); $i++) {
            array_push($colors, $result[$i]['color']);
        }
        
        $data = [
            'brand' => $result[0]['brand'],
            'type' => $result[0]['type'],
            'colors' => $colors
        ];
        
        echo json_encode($data);
    }
