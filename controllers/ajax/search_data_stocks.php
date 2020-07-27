<?php
    require('../Functions.php');

    $keyword = mysqli_escape_string($conn, $_GET['keyword']);
    $query = "SELECT DISTINCT CONCAT_ws(' ', brand, type) as 'brand_type' FROM `stock` WHERE CONCAT_ws(' ', brand, type) LIKE '%$keyword%'";
    $result = mysqli_query($conn, $query);

    $rows = array();
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($rows, $row['brand_type']);
    }

    echo json_encode($rows);
