<?php
    require('../Functions.php');
    
    $id = $_POST['id'];

    echo json_encode(deleteItem($id));
