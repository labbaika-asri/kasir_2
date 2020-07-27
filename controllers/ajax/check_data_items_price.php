<?php
    require('../Functions.php');

    $memoryId = $_POST['memoryId'];

    $result = getDataQuery("SELECT * FROM memory_price WHERE id = '$memoryId'");

    echo json_encode($result);
