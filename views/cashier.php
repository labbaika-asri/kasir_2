<?php
    require('../controllers/Cashier.php');
?>
<div class="shadow-sm p-3 mb-3 rounded cashier">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Cashier</h1>
    </div>

    <!-- Flash Data -->
    <div class="flash-data-cashier" data-flashdata="<?= flash(); ?>"
        data-link="http://localhost/kasir.v2/views/<?= $_SESSION['user']['role'] === 'Administrator' ? 'admin' : 'user'?>.php?menu=cashier">
    </div>

    <form action="" method="POST">
        <div class="row row-cols-1 row-cols-md-2">
            <div class="col">
                <div class="form-group">
                    <label for="customerNameCashier">Costumer Name</label>
                    <input type="text" class="form-control" id="customerNameCashier" name="customerNameCashier">
                </div>
                <div class="form-group">
                    <label for="search">Search Items</label>
                    <input type="text" class="form-control" id="searchCashier">
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="descriptionCashier">Description</label>
                    <textarea class="form-control" id="descriptionCashier" name="descriptionCashier"
                        rows="4"></textarea>
                </div>
            </div>
        </div>
        <div id="visibilityCashier" class="d-none">
            <div class="row row-cols-1 row-cols-md-3 row-cols-lg-6">
                <div class="col">
                    <div class="form-group">
                        <label for="brandCashier">Brand</label>
                        <input type="text" class="form-control" id="brandCashier" readonly>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="typeCashier">Type</label>
                        <input type="text" class="form-control" id="typeCashier" readonly>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="colorCashier">Color</label>
                        <select class="form-control" id="colorCashier">
                            <option value="">
                                <- Choose ->
                            </option>
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="memoryCashier">Memory</label>
                        <select class="form-control" id="memoryCashier">
                            <option value="">
                                <- Choose ->
                            </option>
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="sellingPriceCashier">Price</label>
                        <input type="text" class="form-control" id="sellingPriceCashier" readonly>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="qtyCashier">Quantity</label>
                        <input type="number" class="form-control" id="qtyCashier" min="1" max="1" disabled>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col text-right">
                    <button type="button" class="btn btn-danger button-clear-cashier">Clear</button>
                    <button type="button" class="btn btn-success button-submit-cashier">Submit</button>
                </div>
            </div>
        </div>

        <div id="visibilityResultCashier" class="d-none">
            <div class="row">
                <div class="col">
                    <h4 class="text-gray-800 my-4 text-center">Purchases List</h4>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <table class="table text-white table-responsive-lg">
                        <thead>
                            <tr class="bg-primary">
                                <th scope="col" class="text-center">No.</th>
                                <th scope="col" class="text-center">Brand</th>
                                <th scope="col" class="text-center">Type</th>
                                <th scope="col" class="text-center">Color</th>
                                <th scope="col" class="text-center">Memory</th>
                                <th scope="col" class="text-center">Price</th>
                                <th scope="col" class="text-center">Quantity</th>
                                <th scope="col" class="text-center">Total Price</th>
                                <th scope="col" class="text-center">#</th>
                            </tr>
                        </thead>
                        <tbody class="table-primary">
                            <tr id="amountPaid">
                                <th colspan="6" scope="row" class="text-center align-middle">Amount Paid</th>
                                <td colspan="3">
                                    <input type="text" class="form-control text-right" id="amountPaidResultCashier">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col text-right">
                    <button type="button" class="btn btn-danger button-clear-all-result-cashier">Clear All</button>
                    <button type="submit" class="btn btn-success" id="submitCashier" name="submitCashier"
                        disabled>Paid</button>
                </div>
            </div>
        </div>
    </form>
</div>