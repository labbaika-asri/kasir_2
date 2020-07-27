<?php

    require '../Functions.php';

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
?>

<?php
    switch ($report) {
    case '1':
    $resultUserIncome = getAllDataQuery(
        "SELECT id, username, description, date_create AS 'date' FROM `input_detail` WHERE date_create BETWEEN '$firstDay' AND '$lastDay'"
    );
?>
<div class="row">
    <div class="col">
        <h4 class="text-gray-800 my-4 text-center">Income Report</h4>
    </div>
</div>
<?php
    foreach ($resultUserIncome as $data) :
        $userId = $data['id'];
        $dataIncome = getAllDataQuery("SELECT * FROM `input_stock` WHERE input_detail_id = '$userId'");
    ?>
<div class="p-2 bg-info text-white border border-primary rounded mb-3">
    <div class="row mb-2 row-cols-1 row-cols-sm-1 row-cols-lg-2">
        <div class="col">
            <div class="row no-gutters">
                <div class="col col-3 col-md-2 col-lg-3">
                    <p class="m-0">Date</p>
                </div>
                <div class="col col-1 mx-1">
                    <p class="m-0 text-right">:</p>
                </div>
                <div class="col">
                    <p class="m-0">
                        <?= date('l, d-m-Y', $data['date']); ?>
                    </p>
                </div>
            </div>
            <div class="row no-gutters">
                <div class="col col-3 col-md-2 col-lg-3">
                    <p class="m-0">Time</p>
                </div>
                <div class="col col-1 mx-1">
                    <p class="m-0 text-right">:</p>
                </div>
                <div class="col">
                    <p class="m-0">
                        <?= date('H:i:s', $data['date']); ?>
                    </p>
                </div>
            </div>
            <div class="row no-gutters">
                <div class="col col-3 col-md-2 col-lg-3">
                    <p class="m-0">Username</p>
                </div>
                <div class="col col-1 mx-1">
                    <p class="m-0 text-right">:</p>
                </div>
                <div class="col">
                    <p class="m-0">
                        <?= $data['username']; ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="row no-gutters">
                <div class="col col-3 col-md-2 col-lg-3">
                    <p class="m-0">Description</p>
                </div>
                <div class="col col-1 mx-1">
                    <p class="m-0 text-right">:</p>
                </div>
                <div class="col">
                    <p class="m-0">
                        <?= $data['description']; ?>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <table class="table table-primary table-responsive-lg text-center mb-0">
                <thead class="text-white">
                    <tr class="bg-primary">
                        <th scope="col" class="align-middle">No.</th>
                        <th scope="col" class="align-middle">Serial Number</th>
                        <th scope="col" class="align-middle">Brand & Type</th>
                        <th scope="col" class="align-middle">Color</th>
                        <th scope="col" class="align-middle">Memory</th>
                        <th scope="col" class="align-middle">Purchase Price</th>
                        <th scope="col" class="align-middle">Selling Price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $i = 1;
                        foreach ($dataIncome as $data) :
                    ?>
                    <tr>
                        <th scope="row">
                            <?= $i; ?>
                        </th>
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
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
    endforeach;
    break;
    case '2':
    $resultUserExpanse = getAllDataQuery(
        "SELECT id, username, description, date_create AS 'date', customor_name FROM `output_detail` WHERE date_create BETWEEN '$firstDay' AND '$lastDay'"
    );
?>
<div class="row">
    <div class="col">
        <h4 class="text-gray-800 my-4 text-center">Expanse Report</h4>
    </div>
</div>
<?php
    foreach ($resultUserExpanse as $data) :
        $userId = $data['id'];
        $dataExpanse = getAllDataQuery("SELECT * FROM `output_stock` WHERE output_detail_id = '$userId'");
    ?>
<div class="p-2 bg-info text-white border border-primary rounded mb-3">
    <div class="row mb-2 row-cols-1 row-cols-sm-1 row-cols-lg-2">
        <div class="col">
            <div class="row no-gutters">
                <div class="col col-3 col-md-2 col-lg-3">
                    <p class="m-0">Date</p>
                </div>
                <div class="col col-1 mx-1">
                    <p class="m-0 text-right">:</p>
                </div>
                <div class="col">
                    <p class="m-0">
                        <?= date('l, d-m-Y', $data['date']); ?>
                    </p>
                </div>
            </div>
            <div class="row no-gutters">
                <div class="col col-3 col-md-2 col-lg-3">
                    <p class="m-0">Time</p>
                </div>
                <div class="col col-1 mx-1">
                    <p class="m-0 text-right">:</p>
                </div>
                <div class="col">
                    <p class="m-0">
                        <?= date('H:i:s', $data['date']); ?>
                    </p>
                </div>
            </div>
            <div class="row no-gutters">
                <div class="col col-3 col-md-2 col-lg-3">
                    <p class="m-0">Username</p>
                </div>
                <div class="col col-1 mx-1">
                    <p class="m-0 text-right">:</p>
                </div>
                <div class="col">
                    <p class="m-0">
                        <?= $data['username']; ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="row no-gutters">
                <div class="col col-3 col-md-2 col-lg-3">
                    <p class="m-0">Customer Name</p>
                </div>
                <div class="col col-1 mx-1">
                    <p class="m-0 text-right">:</p>
                </div>
                <div class="col">
                    <p class="m-0">
                        <?= $data['customor_name']; ?>
                    </p>
                </div>
            </div>
            <div class="row no-gutters">
                <div class="col col-3 col-md-2 col-lg-3">
                    <p class="m-0">Description</p>
                </div>
                <div class="col col-1 mx-1">
                    <p class="m-0 text-right">:</p>
                </div>
                <div class="col">
                    <p class="m-0">
                        <?= $data['description']; ?>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <table class="table table-primary table-responsive-lg text-center mb-0">
                <thead class="text-white">
                    <tr class="bg-primary">
                        <th scope="col" class="align-middle">No.</th>
                        <th scope="col" class="align-middle">Serial Number</th>
                        <th scope="col" class="align-middle">Brand & Type</th>
                        <th scope="col" class="align-middle">Color</th>
                        <th scope="col" class="align-middle">Memory</th>
                        <th scope="col" class="align-middle">Purchase Price</th>
                        <th scope="col" class="align-middle">Selling Price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $i = 1;
                        foreach ($dataExpanse as $data) :
                    ?>
                    <tr>
                        <th scope="row">
                            <?= $i; ?>
                        </th>
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
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
    endforeach;
    break;
    }
