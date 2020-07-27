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

    $now = strtotime(date("Y-m-d"));
    $report = $_GET["selectedReport"];
    if (isset($_GET["button"])) {
        switch ($_GET["button"]) {
            case 'thisDay':
            $firstDay = $now;
            $lastDay = strtotime('+1 day', $now) - 1;
            break;

            case 'thisMonth':
            $firstDay = strtotime('first day of', $now);
            $lastDay = strtotime('last day of', $now);
            break;

            case 'thisYear':
            $firstDay = strtotime(date("Y-01-01"));
            $lastDay = strtotime(date("Y-12-31"));
            break;
        }
    } elseif (isset($_GET['firstDate']) && isset($_GET['endDate'])) {
        $firstDay = explode('/', $_GET['firstDate']);
        $lastDay = explode('/', $_GET['endDate']);
        $firstDay = strtotime("$firstDay[2]-$firstDay[1]-$firstDay[0]");
        $lastDay = strtotime("$lastDay[2]-$lastDay[1]-$lastDay[0]") - 1;
    } elseif (isset($_GET['firstDate'])) {
        $firstDay = explode('/', $_GET['firstDate']);
        $firstDay = strtotime("$firstDay[2]-$firstDay[1]-$firstDay[0]");
        $lastDay = strtotime('+1 day', $firstDay) - 1;
    }
    
    switch ($report) {
        case '1':
            $title = "Income Report";
            $resultUser = getAllDataQuery(
                "SELECT id, username, description, date_create AS 'date' FROM `input_detail` WHERE date_create BETWEEN '$firstDay' AND '$lastDay'"
            );
            $resultDataQuery = "SELECT * FROM `input_stock` WHERE input_detail_id = ";
        break;

        case '2':
            $title = "Expanse Report";
            $resultUser = getAllDataQuery(
                "SELECT id, username, description, date_create AS 'date', customor_name FROM `output_detail` WHERE date_create BETWEEN '$firstDay' AND '$lastDay'"
            );
            $resultDataQuery = "SELECT * FROM `output_stock` WHERE output_detail_id = ";
        break;
    }

    ob_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>
        <?= $title; ?>
    </title>
    <link rel="stylesheet" href="../assets/css/style.css" />
</head>

<body>
    <div class="input-output-stock-report">
        <h1>
            <?= $title; ?>
        </h1>
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
            <div class="row">
                <div class="title">
                    Date Range
                </div>
                <div class="content">
                    <div class="double-dot">:</div>
                    <div>
                        <?= ($lastDay === strtotime('+1 day', $firstDay) - 1) ? "Just " . date('d-m-y', $firstDay) : date('d-m-y', $firstDay) . " to " . date('d-m-y', $lastDay); ?>
                    </div>
                </div>
            </div>
        </div>

        <?php
            foreach ($resultUser as $data) :
            $userId = $data['id'];
            $resultData = getAllDataQuery($resultDataQuery."'$userId'");
            ?>

        <section class="result">
            <header>
                <div class="box1">
                    <div class="row">
                        <div class="title">
                            Date
                        </div>
                        <div class="content">
                            <div class="double-dot">:</div>
                            <div>
                                <?= date('l, d-m-Y', $data['date']); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="title">
                            Time
                        </div>
                        <div class="content">
                            <div class="double-dot">:</div>
                            <div>
                                <?= date('H:i:s', $data['date']); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="title">
                            Username
                        </div>
                        <div class="content">
                            <div class="double-dot">:</div>
                            <div>
                                <?= $data['username']; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box2">
                    <?php if ($_GET['selectedReport'] === '2') : ?>
                    <div class="row">
                        <div class="title">
                            Customer Name
                        </div>
                        <div class="content">
                            <div class="double-dot">:</div>
                            <div>
                                <?= $data['customor_name']; ?>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                    <div class="row">
                        <div class="title">
                            Description
                        </div>
                        <div class="content">
                            <div class="double-dot">:</div>
                            <div class="txt-justify">
                                <?= $data['description']; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <section class="data">
                <table>
                    <tr>
                        <th>No.</th>
                        <th>Serial Number</th>
                        <th>Brand & Type</th>
                        <th>Color</th>
                        <th>Memory</th>
                        <th>Purchase Price</th>
                        <th>Selling Price</th>
                    </tr>
                    <?php
                        $i = 1;
                        foreach ($resultData as $data) :
                    ?>
                    <tr>
                        <td>
                            <?= $i; ?>
                        </td>
                        <td>
                            <?= $data['serial_number']; ?>
                        </td>
                        <td>
                            <?= $data['brand'] . " " . $data['type']; ?>
                        </td>
                        <td>
                            <?= $data['color']; ?>
                        </td>
                        <td>
                            <?= $data['memory']; ?>
                        </td>
                        <td>
                            <?= rupiah($data['purchase_price']); ?>
                        </td>
                        <td>
                            <?= rupiah($data['selling_price']); ?>
                        </td>
                    </tr>
                    <?php
                        $i++;
                        endforeach;
                        ?>
                </table>
            </section>
        </section>
        <?php endforeach; ?>
    </div>
</body>

</html>
<?php
    $mpdf->setFooter('{PAGENO}');
    $html = ob_get_contents();
    ob_end_clean();
    $mpdf->WriteHTML(utf8_encode($html));
    $mpdf->Output($title."_".$_SESSION['user']['username']."_".date("dmyHis").".pdf", 'D');
    exit;
