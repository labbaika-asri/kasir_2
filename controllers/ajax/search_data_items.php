<?php
    require('../Functions.php');

    $keyword = mysqli_escape_string($conn, $_GET['keyword']);
    $query = "SELECT CONCAT_WS(' ', brand, type) AS brand_type FROM `type`JOIN `brand` ON brand_id = brand.id WHERE CONCAT_WS(' ', brand, type) LIKE '%$keyword%'";
    $result = mysqli_query($conn, $query);

    $rows = array();
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($rows, $row['brand_type']);
    }

    echo json_encode($rows);
