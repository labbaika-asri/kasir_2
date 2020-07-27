<?php

    // Database connection
    $conn = mysqli_connect('localhost', 'root', '', 'kasir_2');

    //  Function Rupiah
    function rupiah($number)
    {
        $result = "Rp. " . number_format($number, 0, ',', '.');
        return $result;
    }

    // Function for query get many data
    function getAllDataQuery($query)
    {
        global $conn;

        $result = mysqli_query($conn, $query);
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }

    // Function for query one data
    function getDataQuery($query)
    {
        global $conn;
        $result = mysqli_query($conn, $query);
        return mysqli_fetch_assoc($result);
    }

    // Functon for set massage
    function setFlash($icon, $title, $text)
    {
        $_SESSION['flash'] = [ 'icon' => $icon, 'title' => $title, 'text' => $text];
    }

    // Function for get massage
    function flash()
    {
        if (isset($_SESSION['flash'])) {
            echo $_SESSION['flash']['icon'] . "-" . $_SESSION['flash']['title']  . "-" . $_SESSION['flash']['text'];
            unset($_SESSION['flash']);
        }
    }
    
    // Function setSession
    function setSession($username)
    {
        $result = getDataQuery("SELECT `username`, `password`, `name`, `phone_number`, `profile`, `date_create`, `role` FROM `user` JOIN user_role on user.role_id = user_role.id WHERE `username` = '$username'");
        $_SESSION["user"] = [
            'username' =>  $result['username'],
            'name' =>  $result['name'],
            'profile' =>  $result['profile'],
            'phone_number' =>  $result['phone_number'],
            'since' =>  $result['date_create'],
            'role' =>  $result['role'],
        ];
    }

    // login validation
    function loginChecked($username, $password)
    {
        global $conn;

        // Username checked
        $result = getDataQuery("SELECT `username`, `password`, `name`, `phone_number`, `profile`, `date_create`, `role` FROM `user` JOIN user_role on user.role_id = user_role.id WHERE `username` = '$username'");
        if (!$result) {
            return 0;
        }
        
        // Password checked
        if (!password_verify($password, $result['password'])) {
            return 0;
        }

        // Set user session data
        setSession($username);
        
        switch ($result['role']) {
                case 'Administrator':
                header("Location: views/admin.php");
                exit;
                break;
                
                default:
                header("Location: views/user.php");
                exit;
                break;
            }
    }

    // Get all employes
    function getAllEmployes(Type $var = null)
    {
        $query = "SELECT * FROM user WHERE role_id != 1";
        return $employes = getAllDataQuery($query);
    }

    // Add new employe
    function addNewEmploye($data)
    {
        global $conn;

        $username = trim(htmlspecialchars(stripcslashes(strtolower($data['addNewEmployeUsername']))));
        $password = mysqli_real_escape_string($conn, $data["addNewEmployePassword"]);
        $password2 = mysqli_real_escape_string($conn, $data["addNewEmployeRePassword"]);

        // Username Check
        $usernameCheckResult = getDataQuery("SELECT username FROM user WHERE username = '$username'");

        if (!is_null($usernameCheckResult)) {
            setFlash('error', 'Unsuccessfull!', 'Username already registered.');
            return ;
        }
        
        // Password Check
        if ($password !== $password2) {
            setFlash('error', 'Unsuccessfull!', 'Password and repeat password not matching.');
            return ;
        }

        $password = password_hash($password, PASSWORD_DEFAULT);
        $time = time();
    
        $query = "INSERT INTO user(username, password, date_create, role_id) VALUES('$username', '$password',  $time, 2)";
        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }
   
    // Delete employe
    function deleteEmploye($id)
    {
        global $conn;
        
        // Get Profile Image
        $queryUserProfile = "SELECT profile FROM user WHERE id= '$id'";
        $userProfile = getDataQuery($queryUserProfile);
        $profile = $userProfile['profile'];

        // Delete Employe
        $resultDeleteUser = mysqli_query($conn, "DELETE FROM user WHERE id = '$id'");

        // // Delete Profile Image
        if (mysqli_affected_rows($conn) === 1 && $profile !== 'default.jpg') {
            $target = "../assets/img/profile/".$profile;
            unlink($target);
        }
        
        return mysqli_affected_rows($conn);
    }

    // Change password
    function changePassword($username, $password, $rePassword)
    {
        global $conn;

        $password = mysqli_escape_string($conn, $password);
        $password2 = mysqli_escape_string($conn, $rePassword);

        // Password Check
        if ($password !== $password2) {
            setFlash('error', 'Unsuccessfull!', 'Password and repeat password not matching.');
            return ;
        }

        $password = password_hash($password, PASSWORD_DEFAULT);

        $query = "UPDATE `user` SET password = '$password' WHERE username = '$username'";
        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }

    // Upload Chacked
    function upload()
    {
        $fileName = $_FILES['photoProfile']['name'];
        $fileSize = $_FILES['photoProfile']['size'];
        $error = $_FILES['photoProfile']['error'];
        $tmpName = $_FILES['photoProfile']['tmp_name'];

        // If does'n upload img
        if ($error === 4) {
            return $error;
        }

        $validExtention = ['jpg', 'jpeg', 'png'];
        $imgExtention = explode('.', $fileName);
        $imgExtention = strtolower(end($imgExtention));

        if (!in_array($imgExtention, $validExtention)) {
            setFlash('error', 'Unsuccessfull!', 'Only upload profile with extensions .jpg, .jpeg, .png.');
            return ;
        }

        if ($fileSize > 1048576) {
            setFlash('error', 'Unsuccessfull!', 'Your profile image size is more than 1 MB.');
            return ;
        }

        $newProfileName = uniqid().'.'.$imgExtention;

        $chack = move_uploaded_file($tmpName, '../assets/img/profile/'.$newProfileName);
        if ($chack) {
            return $newProfileName;
        } else {
            setFlash('error', 'Unsuccessfull!', 'Try another profile image.');
            return ;
        }
    }

    // Update Profile
    function updateProfile($data)
    {
        global $conn;

        $username = $data['username'];
        $name = trim(stripcslashes(htmlspecialchars($data['name'])));
        $phoneNumber = trim(stripcslashes(htmlspecialchars($data['phoneNumber'])));
        $profile = upload();

        if (is_string($profile)) {
            $wasProfile = getDataQuery("SELECT profile FROM user WHERE username = '$username'");
            $wasProfile = $wasProfile['profile'];

            $updateUserQuery = "UPDATE user SET name = '$name', phone_number = '$phoneNumber', profile = '$profile' WHERE username = '$username'";
            if ($wasProfile !== 'default.jpg') {
                $target = "../assets/img/profile/".$wasProfile;
                unlink($target);
            }
        } elseif ($profile === 4) {
            $updateUserQuery = "UPDATE user SET name = '$name', phone_number = '$phoneNumber' WHERE username = '$username'";
        } else {
            return ;
        }
        mysqli_query($conn, $updateUserQuery);
        return mysqli_affected_rows($conn);
    }

    // Input Item
    function inputItem($data)
    {
        global $conn;

        $brand = strtoupper(trim(stripcslashes(htmlspecialchars($data['brandInputItem']))));
        $type = strtoupper(trim(stripcslashes(htmlspecialchars($data['typeInputItem']))));
        $colors = strtolower(trim(stripcslashes(htmlspecialchars($data['colorInputItem']))));

        // Check whether the brand already exists in the database
        $brandChecked = getDataQuery("SELECT * FROM brand WHERE brand = '$brand'");
        if (!$brandChecked) {
            // Insert Brand
            mysqli_query($conn, "INSERT INTO brand VALUES('' , '$brand')");
            $brandChecked = getDataQuery("SELECT id FROM brand WHERE brand = '$brand'");
        }
        $brandId = (int) $brandChecked['id'];

        // Check whether the brand with same type already exists in the database
        $typeChecked = getDataQuery("SELECT * FROM `type` WHERE `type` = '$type'");
        if (is_null($typeChecked)) {
            // Insert type
            mysqli_query($conn, "INSERT INTO `type` VALUES('', $brandId, '$type')");
            $typeChecked = getDataQuery("SELECT id FROM `type` WHERE `type` = '$type' AND brand_id=$brandId");
        } else {
            setFlash('error', 'Unsuccessfull!', 'The type with same brand is allready in the database.');
            return ;
        }
        $typeId = (int) $typeChecked['id'];
        
        $color = explode(',', $colors);
        for ($i=0; $i < count($color) ; $i++) {
            $color[$i] = trim($color[$i]);
            // Insert color
            mysqli_query($conn, "INSERT INTO color VALUES('', $typeId, '$color[$i]')");
        }

        $count = count($data);
        $n = (int)(floor(($count / 3) - 1));
        for ($i=0; $i < $n ; $i++) {
            $memory[$i] = htmlspecialchars(trim($data['memoryInputItem' . ($i + 1)]));
            $purchasePrice[$i] = str_replace('.', '', substr(htmlspecialchars($data['purchasePriceInputItem' . ($i + 1)]), 4)) ;
            $sellingPrice[$i] = str_replace('.', '', substr(htmlspecialchars($data['sellingPriceInputItem' . ($i + 1)]), 4)) ;

            // Insert memory and price
            mysqli_query($conn, "INSERT INTO memory_price VALUES('', $typeId, '$memory[$i]', '$purchasePrice[$i]', '$sellingPrice[$i]')");
        }

        return mysqli_affected_rows($conn);
    }

    // Update Item
    function updateItem($data)
    {
        global $conn;

        $typeId = htmlspecialchars($data['typeIdUpdateItems']);
        $brand = strtoupper(trim(stripcslashes(htmlspecialchars($data['brandUpdateItems']))));
        $type = strtoupper(trim(stripcslashes(htmlspecialchars($data['typeUpdateItems']))));
        $colors = strtolower(trim(stripcslashes(htmlspecialchars($data['colorUpdateItems']))));

        // Check whether the brand already exists in the database
        $brandChecked = getDataQuery("SELECT * FROM brand WHERE brand = '$brand'");
        if (!$brandChecked) {
            // Insert Brand
            mysqli_query($conn, "INSERT INTO brand VALUES('' , '$brand')");
            $brandChecked = getDataQuery("SELECT id FROM brand WHERE brand = '$brand'");
        }
        $brandId = (int) $brandChecked['id'];

        // Change Brand & type
        mysqli_query($conn, "UPDATE `type` set brand_id = $brandId, type = '$type' WHERE id = $typeId");
        
        // Delete color
        mysqli_query($conn, "DELETE FROM color WHERE type_id = $typeId");
        
        // Change color
        $color = explode(',', $colors);
        for ($i=0; $i < count($color) ; $i++) {
            $color[$i] = trim($color[$i]);
            // Insert color
            mysqli_query($conn, "INSERT INTO color VALUES('', $typeId, '$color[$i]')");
        }
        
        // Delete memory and price
        mysqli_query($conn, "DELETE FROM memory_price WHERE type_id = $typeId");
        

        $count = count($data);
        $n = (int)(floor(($count / 3) - 2));
        for ($i=0; $i < $n ; $i++) {
            $memory[$i] = htmlspecialchars(trim($data['memoryUpdateItems' . ($i + 1)]));
            $purchasePrice[$i] = str_replace('.', '', substr(htmlspecialchars($data['purchasePriceUpdateItems' . ($i + 1)]), 4)) ;
            $sellingPrice[$i] = str_replace('.', '', substr(htmlspecialchars($data['sellingPriceUpdateItems' . ($i + 1)]), 4)) ;

            // Insert memory and price
            mysqli_query($conn, "INSERT INTO memory_price VALUES('', $typeId, '$memory[$i]', '$purchasePrice[$i]', '$sellingPrice[$i]')");
        }

        return mysqli_affected_rows($conn);
    }

    // Delete employe
    function deleteItem($typeId)
    {
        global $conn;
        
        // Delete item
        mysqli_query($conn, "DELETE FROM `type` WHERE id = $typeId");
        $result = mysqli_affected_rows($conn);

        // Clearing unless brand
        $unlessBrand = getAllDataQuery("SELECT  brand.id, brand, type FROM `brand` LEFT JOIN `type` ON brand.id = brand_id WHERE type IS NULL");
        if ($unlessBrand) {
            for ($i=0; $i < count($unlessBrand); $i++) {
                $brandId = $unlessBrand[$i]['id'];
                
                // delete brand
                mysqli_query($conn, "DELETE FROM brand WHERE id = $brandId");
            }
        }

        return $result;
    }

    // Input stock
    function inputStock($data)
    {
        global $conn;
        
        $n = (count($data)-2) / 7;
        $inputDetailId = md5(uniqid(rand(), true));
        
        $username = $_SESSION['user']['username'];
        $description = $data['descriptionInputStock'];
        $date = time();
        mysqli_query($conn, "INSERT INTO `input_detail` VALUES('$inputDetailId', '$username', '$description', '$date')");
        
        for ($i=0; $i < $n; $i++) {
            $serialNumber = trim(stripcslashes(htmlspecialchars($data["serialNumberResultInputStock" . ($i + 1) ])));
            $brand = trim(stripcslashes(htmlspecialchars($data["brandResultInputStock" . ($i + 1) ])));
            $type = trim(stripcslashes(htmlspecialchars($data["typeResultInputStock" . ($i + 1) ])));
            $color = trim(stripcslashes(htmlspecialchars($data["colorResultInputStock" . ($i + 1) ])));
            $memory = trim(stripcslashes(htmlspecialchars($data["memoryResultInputStock" . ($i + 1) ])));
            $purchasePrice = str_replace('.', '', substr(htmlspecialchars($data['purchasePriceResultInputStock' . ($i + 1)]), 4)) ;
            $sellingPrice = str_replace('.', '', substr(htmlspecialchars($data['sellingPriceResultInputStock' . ($i + 1)]), 4)) ;

            mysqli_query($conn, "INSERT INTO `stock` VALUES('', '$serialNumber', '$brand', '$type', '$color', '$memory', '$purchasePrice', '$sellingPrice')");
            mysqli_query($conn, "INSERT INTO `input_stock` VALUES('', '$serialNumber', '$brand', '$type', '$color', '$memory', '$purchasePrice', '$sellingPrice', '$inputDetailId')");
        }

        return mysqli_affected_rows($conn);
    }

    // output stock
    function outputStock($data)
    {
        global $conn;

        $n = (count($data)-3) / 6;

        $outputDetailId = md5(uniqid(rand(), true));
        $username = $_SESSION['user']['username'];
        $customerName = $data['customerNameCashier'];
        $description = $data['descriptionCashier'];
        $date = time();

        for ($i=0; $i < $n; $i++) {
            $brand = trim(stripcslashes(htmlspecialchars($data["brandResultCashier" . ($i + 1) ])));
            $type = trim(stripcslashes(htmlspecialchars($data["typeResultCashier" . ($i + 1) ])));
            $color = trim(stripcslashes(htmlspecialchars($data["colorResultCashier" . ($i + 1) ])));
            $memory = trim(stripcslashes(htmlspecialchars($data["memoryResultCashier" . ($i + 1) ])));
            $sellingPrice = str_replace('.', '', substr(htmlspecialchars($data['sellingPriceResultCashier' . ($i + 1)]), 4)) ;
            $qty = trim(stripcslashes(htmlspecialchars($data["qtyResultCashier" . ($i + 1) ])));

            // check data output stock
            $serialNumberPurchasePrice = getAllDataQuery("SELECT serial_number, purchase_price FROM `stock` WHERE brand = '$brand' AND type = '$type' AND color = '$color' AND memory = '$memory' AND selling_price = '$sellingPrice' LIMIT $qty");
            if ($serialNumberPurchasePrice) {

                // Insert to output stock
                for ($j=0; $j < count($serialNumberPurchasePrice); $j++) {
                    $serialNumber = $serialNumberPurchasePrice[$j]['serial_number'];
                    $purchasePrice = $serialNumberPurchasePrice[$j]['purchase_price'];
                    mysqli_query($conn, "INSERT INTO `output_stock` VALUES('', '$serialNumber', '$brand', '$type', '$color', '$memory', '$purchasePrice', '$sellingPrice', '$outputDetailId')");
                    
                    // delete Stock
                    mysqli_query($conn, "DELETE FROM stock WHERE serial_number = $serialNumber");
                }
            }
        }
        
        // insert output stock detail
        mysqli_query($conn, "INSERT INTO `output_detail` VALUES('$outputDetailId', '$username', '$customerName', '$description', '$date')");
        return mysqli_affected_rows($conn);
    }
