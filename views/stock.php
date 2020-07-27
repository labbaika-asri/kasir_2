<?php
    require("../controllers/Stock.php");
?>
<div class="shadow-sm p-3 mb-3 rounded stock">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Stock</h1>
    </div>

    <!-- Flash Data -->
    <div class="flash-data-stock" data-flashdata="<?= flash(); ?>"
        data-link="http://localhost/kasir.v2/views/<?= $_SESSION['user']['role'] === 'Administrator' ? 'admin' : 'user'?>.php?menu=stock">
    </div>

    <div class="row mb-2">
        <div class="col-lg-5">
            <div class="form-group">
                <input type="email" class="form-control" id="searchStock" name="searchStock"
                    placeholder="Search data..">
            </div>
        </div>
        <div class="col mb-sm-2 d-flex justify-content-around justify-content-md-end flex-wrap">
            <!-- Button input item modal -->
            <button type="button" class="btn btn-info mb-2 button-input-item-modal ml-md-2" data-toggle="modal"
                data-target="#inputItemModal">Input
                Item</button>
            <a href="?menu=input_stock" class="btn btn-success mb-2 ml-md-2">Input Stock</a>
            <button type="button" class="btn btn-primary mb-2 button-update-items-modal ml-md-2" data-toggle="modal"
                data-target="#updateItemsModal">
                Update Items
            </button>
            <button type="button" id="printStock" class="btn btn-warning mb-2 ml-md-2">Print to PDF</button>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <table class="table table-primary table-responsive-md text-center">
                <thead>
                    <tr class="bg-primary text-white">
                        <th scope="col" class="align-middle">No.</th>
                        <th scope="col" class="align-middle">Brand & Type</th>
                        <th scope="col" class="align-middle">Color</th>
                        <th scope="col" class="align-middle">Memory</th>
                        <th scope="col" class="align-middle">Purchase Price</th>
                        <th scope="col" class="align-middle">Selling Price</th>
                        <th scope="col" class="align-middle">Qty</th>
                    </tr>
                </thead>
                <tbody id="tbodyStock">
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
                        <td rowspan="<?= $rowspanBrandType1 ?>"
                            class="align-middle">
                            <?= $i + 1; ?>
                        </td>
                        <td rowspan="<?= $rowspanBrandType1 ?>"
                            class="align-middle">
                            <?= $brandType1; ?>
                        </td>
                        <td rowspan="<?= $rowspanBrandTypeColor1 ?>"
                            class="align-middle">
                            <?= $color1; ?>
                        </td>
                        <td class="align-middle">
                            <?= $memory1; ?>
                        </td>
                        <td class="align-middle">
                            <?= rupiah($purchasePrice1); ?>
                        </td>
                        <td class="align-middle">
                            <?= rupiah($sellingPrice1); ?>
                        </td>
                        <td class="align-middle">
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
                        <td class="align-middle">
                            <?= $memory2; ?>
                        </td>
                        <td class="align-middle">
                            <?= rupiah($purchasePrice2); ?>
                        </td>
                        <td class="align-middle">
                            <?= rupiah($sellingPrice2); ?>
                        </td>
                        <td class="align-middle">
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
                        <td rowspan="<?= $rowspanBrandTypeColor2; ?>"
                            class="align-middle">
                            <?= $color2; ?>
                        </td>
                        <td class="align-middle">
                            <?= $memory3; ?>
                        </td>
                        <td class="align-middle">
                            <?= rupiah($purchasePrice3); ?>
                        </td>
                        <td class="align-middle">
                            <?= rupiah($sellingPrice3); ?>
                        </td>
                        <td class="align-middle">
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
                        <td class="align-middle">
                            <?= $memory4; ?>
                        </td>
                        <td class="align-middle">
                            <?= rupiah($purchasePrice4); ?>
                        </td>
                        <td class="align-middle">
                            <?= rupiah($sellingPrice4); ?>
                        </td>
                        <td class="align-middle">
                            <?= $stock4; ?>
                        </td>
                    </tr>
                    <?php endfor; ?>
                    <?php endfor; ?>
                    <?php endfor; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Input Item-->
<div class="modal fade input-item-modal" id="inputItemModal" tabindex="-1" role="dialog"
    aria-labelledby="inputItemModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="inputItemModalLabel">Input Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST">
                <div class="modal-body">
                    <div class="row row-cols-1 row-cols-md-2">
                        <div class="col">
                            <div class="form-group">
                                <label for="brandInputItem">Brand</label>
                                <input type="text" class="form-control" id="brandInputItem" name="brandInputItem"
                                    required autofocus>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="typeInputItem">Type</label>
                                <input type="text" class="form-control" id="typeInputItem" name="typeInputItem"
                                    required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="colorInputItem">Color</label>
                                <input type="text" class="form-control" id="colorInputItem" name="colorInputItem"
                                    aria-describedby="colorInputItemHelp" required>
                                <small id="colorInputItemHelp" class="text-muted">
                                    Example : blue,red, green, dark blue, salmon.
                                </small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group mb-0">
                                <label for="memoryInputItem1" class="d-block">
                                    Memory
                                </label>
                                <input type="text" class="form-control small-input d-inline-block mb-2 mb-lg-0 mr-2"
                                    id="memoryInputItem1" name="memoryInputItem1" aria-describedby="memoryInputItemHelp"
                                    required>
                                <button type="button"
                                    class="btn btn-success btn-sm text-light btn-size-sm mb-1 btn-plus-input-item">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                            <small id="memoryInputItemHelp" class="text-muted">
                                Example : 4/64.
                            </small>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group mt-3 purchase-price-container-input-item">
                                <label for="purchasePriceInputItem1" class="d-block">
                                    Purchase Price
                                </label>
                                <input type="text"
                                    class="form-control small-input d-inline-block mb-2 mr-2 rupiah-format"
                                    id="purchasePriceInputItem1" name="purchasePriceInputItem1" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="sellingPriceInputItem1" class="d-block">
                                    Selling Price
                                </label>
                                <input type="text"
                                    class="form-control small-input d-inline-block mb-2 mr-2 rupiah-format"
                                    id="sellingPriceInputItem1" name="sellingPriceInputItem1" required>
                                <button type="button"
                                    class="btn btn-danger btn-sm text-light btn-size-sm mb-1 btn-minus-input-item d-none"
                                    disabled>
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-warning">Reset All</button>
                    <button type="submit" name="submitInputItem" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Update Items -->
<div class="modal fade update-items-modal" id="updateItemsModal" tabindex="-1" role="dialog"
    aria-labelledby="updateItemsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateItemsModalLabel">Update Items</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="col col-lg-7">
                            <div class="form-group">
                                <label for="searchUpdateItems">Search</label>
                                <input type="text" class="form-control" id="searchUpdateItems" name="searchUpdateItems"
                                    placeholder="Search items...">
                            </div>
                        </div>
                    </div>
                    <div id="visibilityUpdateItems" class="d-none">
                        <div class="row row-cols-1 row-cols-md-2">
                            <input type="hidden" id="typeIdUpdateItems" name="typeIdUpdateItems" readonly>
                            <div class="col">
                                <div class="form-group">
                                    <label for="brandUpdateItems">Brand</label>
                                    <input type="text" class="form-control" id="brandUpdateItems"
                                        name="brandUpdateItems" required>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="typeUpdateItems">Type</label>
                                    <input type="text" class="form-control" id="typeUpdateItems" name="typeUpdateItems"
                                        required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-lg-6">
                                <div class="form-group">
                                    <label for="colorUpdateItems">Color</label>
                                    <input type="text" class="form-control" id="colorUpdateItems"
                                        name="colorUpdateItems" aria-describedby="colorInputUpdateItems" required>
                                    <small id="colorInputUpdateItems" class="text-muted">
                                        Example : blue, dark blue, red, maroon.
                                    </small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group mb-0">
                                    <label for="memoryUpdateItems1" class="d-block">
                                        Memory
                                    </label>
                                    <input type="text" class="form-control small-input d-inline-block mb-2 mb-lg-2 mr-2"
                                        id="memoryUpdateItems1" name="memoryUpdateItems1"
                                        aria-describedby="memoryInputUpdateItems" required>
                                    <button type="button"
                                        class="btn btn-success btn-sm text-light btn-size-sm mb-2 btn-plus-update-items">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                                <small id="memoryInputUpdateItems" class="text-muted">
                                    Example : 4/64.
                                </small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group mt-3 purchase-price-container-update-items">
                                    <label for="purchasePriceUpdateItems1" class="d-block">
                                        Purchase Price
                                    </label>
                                    <input type="text"
                                        class="form-control small-input d-inline-block mb-2 mr-2 rupiah-format"
                                        id="purchasePriceUpdateItems1" name="purchasePriceUpdateItems1" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="sellingPriceUpdateItems1" class="d-block">
                                        Selling Price
                                    </label>
                                    <input type="text"
                                        class="form-control small-input d-inline-block mb-2 mr-2 rupiah-format"
                                        id="sellingPriceUpdateItems1" name="sellingPriceUpdateItems1" required>
                                    <button type="button"
                                        class="btn btn-danger btn-sm text-light btn-size-sm mb-2 btn-minus-update-items d-none"
                                        disabled>
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-warning d-none" disabled>Clear All</button>
                    <button type="button" class="btn btn-danger d-none button-delete-update-items"
                        disabled>Delete</button>
                    <button type="submit" id="submitUpdateItems" name="submitUpdateItems" class="btn btn-primary d-none"
                        disabled>Update</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>