<?php
    require("../controllers/Input_Stock.php");
?>
<div class="shadow-sm p-3 mb-3 rounded input-stock">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Input Stock</h1>
    </div>

    <!-- Flash Data -->
    <div class="flash-data-input-stock"
        data-flashdata="<?= flash(); ?>"
        data-link="http://localhost/kasir.v2/views/<?= $_SESSION['user']['role'] === 'Administrator' ? 'admin' : 'user'?>.php?menu=stock">
    </div>

    <form action="" method="POST">
        <div class="row row-cols-1 row-cols-md-2">
            <div class="col">
                <div class="form-group">
                    <label for="searchItemsInputStock">Search item</label>
                    <input type="text" class="form-control" id="searchItemsInputStock">
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="descriptionInputStock">Description</label>
                    <textarea class="form-control" id="descriptionInputStock" name="descriptionInputStock"
                        rows="3"></textarea>
                </div>
            </div>
        </div>

        <div id="visibilityInputStock" class="d-none">
            <div class="justify-content-end align-items-end row row-cols-1 row-cols-md-3 row-cols-lg-6">
                <div class="col">
                    <div class="form-group">
                        <label for="brandInputStock">Brand</label>
                        <input type="text" class="form-control" id="brandInputStock" readonly>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="typeInputStock">Type</label>
                        <input type="text" class="form-control" id="typeInputStock" readonly>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="colorInputStock">Color</label>
                        <select class="form-control" id="colorInputStock">
                            <option value="">
                                <- Choose ->
                            </option>
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="memoryInputStock">Memory</label>
                        <select class="form-control" id="memoryInputStock">
                            <option value="">
                                <- Choose ->
                            </option>
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="purchasePriceInputStock">Purchase Price</label>
                        <input type="text" class="form-control" id="purchasePriceInputStock" readonly>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="sellingPriceInputStock">Selling Price</label>
                        <input type="text" class="form-control" id="sellingPriceInputStock" readonly>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="qtyInputStock">Quantity</label>
                        <input type="number" class="form-control" id="qtyInputStock">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col text-right mb-3">
                    <button type="button" class="btn btn-danger clear-input-stock">Clear</button>
                    <button type="button" class="btn btn-success submit-input-stock">Submit</button>
                </div>
            </div>
        </div>
        <div id="visibilityResultInputStock" class="d-none">
            <div class="row">
                <div class="col">
                    <table class="table text-white table-responsive-lg">
                        <thead>
                            <tr class="bg-primary">
                                <th scope="col" class="text-center align-middle">No.</th>
                                <th scope="col" class="text-center align-middle">Serial Number</th>
                                <th scope="col" class="text-center align-middle">Brand</th>
                                <th scope="col" class="text-center align-middle">Type</th>
                                <th scope="col" class="text-center align-middle">Color</th>
                                <th scope="col" class="text-center align-middle">Memory</th>
                                <th scope="col" class="text-center align-middle">Purchase Price</th>
                                <th scope="col" class="text-center align-middle">Selling Price</th>
                                <th scope="col" class="text-center align-middle">#</th>
                            </tr>
                        </thead>
                        <tbody class="table-primary">

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col text-right">
                    <button type="button" class="btn btn-danger button-clear-data-input-stock">Clear Data</button>
                    <button type="submit" class="btn btn-success" id="submitInputStock" name="submitInputStock"
                        disabled>Submit</button>
                </div>
            </div>
        </div>
    </form>
    <div class="row mt-3">
        <div class="col col-12 text-right">
            <a
                href="http://localhost/kasir.v2/views/<?= $_SESSION['user']['role'] === 'Administrator' ? 'admin' : 'user'?>.php?menu=stock">
                <button type="button" class="btn btn-secondary">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i> Back to Stock
                </button>
            </a>
        </div>
    </div>
</div>