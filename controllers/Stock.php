<?php
    if (isset($_POST['submitInputItem'])) {
        if (inputItem($_POST) > 0) {
            setFlash('success', 'Successfull!', 'Item has been added.');
        } elseif (!isset($_SESSION['flash'])) {
            setFlash('error', 'Unsuccessfull!', 'Please try again.');
        }
    }
    if (isset($_POST['submitUpdateItems'])) {
        if (updateItem($_POST) > 0) {
            setFlash('success', 'Successfull!', 'Item has been update.');
        } elseif (!isset($_SESSION['flash'])) {
            setFlash('error', 'Unsuccessfull!', 'Please try again.');
        }
    }

    $query = "SELECT CONCAT_WS(' ', brand, type) as brand_type, color, memory, purchase_price, selling_price, COUNT(*) AS stock FROM `stock` GROUP BY brand, type, color, memory ORDER BY brand, type, color, memory ASC";
    $result = getAllDataQuery($query);

    $dataBrandType = array_unique(array_column($result, "brand_type"));
    $brandType = [];
    foreach ($dataBrandType as $bt) {
        array_push($brandType, $bt);
    }
    $rowBrandType = array_count_values(array_column($result, "brand_type"));

    $brandTypeColor = [];
    for ($i=0; $i < count($result) ; $i++) {
        $tmp = $result[$i]['brand_type'] . '-' . $result[$i]['color'];
        array_push($brandTypeColor, $tmp);
    }

    $rowBrandTypeColor = array_count_values($brandTypeColor);

    $brandTypeColor = array_unique($brandTypeColor);
    $tmp = [];
    foreach ($brandTypeColor as $btr) {
        array_push($tmp, $btr);
    }
    $brandTypeColor = $tmp;

    $tmpBrandTypeColor = [];
    for ($i=0; $i < count($brandType); $i++) {
        $color = [];
        for ($j=0; $j < count($brandTypeColor); $j++) {
            $dataBrandTypeColor = explode('-', $brandTypeColor[$j]);
            if ($dataBrandTypeColor[0] === $brandType[$i]) {
                array_push($color, $dataBrandTypeColor[1]);
            }
        }
        $tmpBrandTypeColor[$brandType[$i]] = $color;
    }
    $brandTypeColor = $tmpBrandTypeColor;

    $brandTypeColorMemory = [];
    for ($i=0; $i < Count($result); $i++) {
        $tmp = $result[$i]['brand_type'] . '-' . $result[$i]['color'] . '-' . $result[$i]['memory'] . '-' . $result[$i]['purchase_price'] . '-' . $result[$i]['selling_price']. '-' . $result[$i]['stock'];
        array_push($brandTypeColorMemory, $tmp);
    }
    // $brandTypeColorMemory = array_unique($brandTypeColorMemory);
    $tmpBrandTypeColorMemory = [];
    for ($i=0; $i < count($brandType); $i++) {
        for ($j=0; $j < count($brandTypeColor[$brandType[$i]]) ; $j++) {
            $color = $brandTypeColor[$brandType[$i]][$j];
            $memory = [];
            for ($k=0; $k < count($brandTypeColorMemory); $k++) {
                $dataBrandTypeColorMemory = explode('-', $brandTypeColorMemory[$k]);
                $dataBrandType = $dataBrandTypeColorMemory[0];
                $dataColor = $dataBrandTypeColorMemory[1];
                $dataMemory = $dataBrandTypeColorMemory[2];
                $dataPurchasePrice = $dataBrandTypeColorMemory[3];
                $dataSellingPrice = $dataBrandTypeColorMemory[4];
                $dataStock = $dataBrandTypeColorMemory[5];

                if ($brandType[$i] === $dataBrandType && $color = $dataColor) {
                    array_push($memory, $dataMemory . '-' . $dataPurchasePrice . '-' . $dataSellingPrice . '-' . $dataStock);
                }
                $index = $brandType[$i] . '-' . $color;
                $tmpBrandTypeColorMemory[$index] = $memory;
            }
        }
    }
    $brandTypeColorMemory = $tmpBrandTypeColorMemory;

    
    // var_dump($brandType);
    // var_dump($rowBrandType);
    
    // var_dump($brandTypeColor);
    // var_dump($rowBrandTypeColor);

    // var_dump($brandTypeColorMemory);
