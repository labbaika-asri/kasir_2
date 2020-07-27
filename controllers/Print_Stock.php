<?php
    session_start();
    require 'Functions.php';
    require_once '../assets/mpdf/vendor/autoload.php';
    $mpdf = new \Mpdf\Mpdf();
    $mpdf->SetTitle('Labbaika Asri');
    $mpdf->SetCreator('Labbaika Asri');
    $mpdf->SetAuthor('Labbaika Asri');
    $mpdf->SetWatermarkText('Watermark');
    $mpdf->showWatermarkText = true;

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


    ob_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Stock Report</title>
    <link rel="stylesheet" href="../assets/css/style.css" />
</head>

<body>
    <div class="stock-report">
        <h1>Stock Report</h1>
        <div class="author">
            <div class="row">
                <div class="title">
                    Date
                </div>
                <div class="content">
                    <div class="double-dot">:</div>
                    <div>
                        <?= date("l, d-m-Y"); ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="title">
                    Author
                </div>
                <div class="content">
                    <div class="double-dot">:</div>
                    <div>
                        <?= $_SESSION["user"]["username"]; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="result">
            <table class="table table-primary table-responsive-md text-center">
                <tr class="bg-primary text-white">
                    <th>No.</th>
                    <th>Brand & Type</th>
                    <th>Color</th>
                    <th>Memory</th>
                    <th>Purchase Price</th>
                    <th>Selling Price</th>
                    <th>Qty</th>
                </tr>
                <?php
                        for ($i = 0; $i < count($brandType); $i++) :
                        $brandType1 = $brandType[$i];
                        $color1 = $brandTypeColor[$brandType1][0];
                        $brandTypeColorMemory1 = explode('-', $brandTypeColorMemory[$brandType1 . '-' . $color1][0]);
                        $memory1 = $brandTypeColorMemory1[0];
                        $purchasePrice1 = $brandTypeColorMemory1[1];
                        $sellingPrice1 = $brandTypeColorMemory1[2];
                        $stock1 = $brandTypeColorMemory1[3];
                        $rowspanBrandType1 = $rowBrandType[$brandType1];
                        $rowspanBrandTypeColor1 = $rowBrandTypeColor[$brandType1 . '-' . $color1];
                    ?>
                <tr>
                    <td rowspan="<?= $rowspanBrandType1 ?>">
                        <?= $i + 1; ?>
                    </td>
                    <td rowspan="<?= $rowspanBrandType1 ?>">
                        <?= $brandType1; ?>
                    </td>
                    <td rowspan="<?= $rowspanBrandTypeColor1 ?>">
                        <?= $color1; ?>
                    </td>
                    <td>
                        <?= $memory1; ?>
                    </td>
                    <td>
                        <?= rupiah($purchasePrice1); ?>
                    </td>
                    <td>
                        <?= rupiah($sellingPrice1); ?>
                    </td>
                    <td>
                        <?= $stock1; ?>
                    </td>
                </tr>
                <?php
                        for ($j = 1; $j < $rowspanBrandTypeColor1; $j++) :
                        $brandTypeColorMemory2 = explode('-', $brandTypeColorMemory[$brandType1 . '-' . $color1][$j]);
                        $memory2 = $brandTypeColorMemory2[0];
                        $purchasePrice2 = $brandTypeColorMemory2[1];
                        $sellingPrice2 = $brandTypeColorMemory2[2];
                        $stock2 = $brandTypeColorMemory2[3];
                    ?>
                <tr>
                    <td>
                        <?= $memory2; ?>
                    </td>
                    <td>
                        <?= rupiah($purchasePrice2); ?>
                    </td>
                    <td>
                        <?= rupiah($sellingPrice2); ?>
                    </td>
                    <td>
                        <?= $stock2; ?>
                    </td>
                </tr>
                <?php endfor; ?>

                <?php
                        for ($k = 1; $k < count($brandTypeColor[$brandType1]); $k++) :
                        $color2 = $brandTypeColor[$brandType1][$k];
                        $rowspanBrandTypeColor2 = $rowBrandTypeColor[$brandType1 . '-' . $color2];
                        $brandTypeColorMemory3 = explode('-', $brandTypeColorMemory[$brandType1 . '-' . $color2][0]);
                        $memory3 = $brandTypeColorMemory3[0];
                        $purchasePrice3 = $brandTypeColorMemory3[1];
                        $sellingPrice3 = $brandTypeColorMemory3[2];
                        $stock3 = $brandTypeColorMemory3[3];
                    ?>
                <tr>
                    <td rowspan="<?= $rowspanBrandTypeColor2; ?>">
                        <?= $color2; ?>
                    </td>
                    <td>
                        <?= $memory3; ?>
                    </td>
                    <td>
                        <?= rupiah($purchasePrice3); ?>
                    </td>
                    <td>
                        <?= rupiah($sellingPrice3); ?>
                    </td>
                    <td>
                        <?= $stock3; ?>
                    </td>
                </tr>
                <?php
                        for ($l = 1; $l < $rowspanBrandTypeColor2; $l++) :
                        $brandTypeColorMemory4 = explode('-', $brandTypeColorMemory[$brandType1 . '-' . $color2][$l]);
                        $memory4 = $brandTypeColorMemory4[0];
                        $purchasePrice4 = $brandTypeColorMemory4[1];
                        $sellingPrice4 = $brandTypeColorMemory4[2];
                        $stock4 = $brandTypeColorMemory4[3];
                    ?>
                <tr>
                    <td>
                        <?= $memory4; ?>
                    </td>
                    <td>
                        <?= rupiah($purchasePrice4); ?>
                    </td>
                    <td>
                        <?= rupiah($sellingPrice4); ?>
                    </td>
                    <td>
                        <?= $stock4; ?>
                    </td>
                </tr>
                <?php endfor; ?>
                <?php endfor; ?>
                <?php endfor; ?>
            </table>
        </div>
    </div>
</body>

</html>

<?php
    $mpdf->setFooter('{PAGENO}');
    $html = ob_get_contents();
    ob_end_clean();
    $mpdf->WriteHTML(utf8_encode($html));
    $mpdf->Output("Stock ".date("l, d-m-Y").".pdf", 'D');
    exit;
