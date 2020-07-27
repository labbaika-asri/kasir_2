<?php
    require('../Functions.php');

    $keyword = trim(mysqli_escape_string($conn, $_POST['keyword']));
    $brandTypeId = getDataQuery("SELECT type.id, brand, type, CONCAT_WS(' ',brand, type) AS brand_type FROM `type` JOIN `brand` ON brand_id = brand.id WHERE CONCAT_WS(' ', brand, type) = '$keyword'");
    
    if ($brandTypeId) {
        $typeId = $brandTypeId['id'];

        // get brand
        $brand = $brandTypeId['brand'];

        // get type
        $type = $brandTypeId['type'];

        // get color
        $color = getAllDataQuery("SELECT color FROM color WHERE type_id = '$typeId'");
        $string = '';
        for ($i=0; $i < count($color); $i++) {
            if ($i === count($color)-1) {
                $string .= $color[$i]['color'];
            } else {
                $string .= $color[$i]['color'] . ', ';
            }
        }
        $color = $string;
        
        // Get memory and price

        // get memory price
        $memoryPrice = getAllDataQuery("SELECT id, memory, purchase_price, selling_price FROM memory_price WHERE type_id = '$typeId'");
        
        $data = [
            'id' => $typeId,
            'brand' => $brand,
            'type' => $type,
            'color' => $color,
            'memoryPrice' => $memoryPrice,
        ];
        echo json_encode($data);
    }
