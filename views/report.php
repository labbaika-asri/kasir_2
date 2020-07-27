<?php
    require('../controllers/Report.php');
?>
<div class="shadow-sm p-3 mb-3 rounded report">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Report</h1>
    </div>

    <div class="row align-items-end">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="selectReport">Choose</label>
                <select class="form-control" id="selectReport">
                    <option value="1">Income Report</option>
                    <option value="2">Expense Report</option>
                </select>
            </div>
        </div>
        <div class="col text-right">
            <button type="button" class="btn btn-primary mb-3" name="thisDay" id="thisDay">This Day</button>
            <button type="button" class="btn btn-primary mb-3 active" name="thisMonth" id="thisMonth" role="button"
                aria-pressed="true">This Month</button>
            <button type="button" class="btn btn-primary mb-3" name="thisYear" id="thisYear">This Year</button>
        </div>
    </div>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 align-items-end">
        <div class="col">
            <div class="form-group">
                <label for="firstDate">Shorting Date</label>
                <input type="text" class="form-control" id="firstDate" name="firstDate" placeholder="First Date">
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <input type="text" class="form-control" id="endDate" name="endDate" placeholder="Last Date">
            </div>
        </div>
    </div>
    <div class="row text-right">
        <div class="col">
            <button type="button" class="btn btn-warning" id="printInputOutputStock">
                Print to PDF
            </button>
        </div>
    </div>

    <div id="resultReport">
    </div>
</div>