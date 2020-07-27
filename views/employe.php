<?php
    require('../controllers/Employe.php');
?>
<div class="shadow-sm p-3 mb-3 rounded employe">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Employe</h1>
    </div>

    <!-- Flash Data -->
    <div class="flash-data-employe" data-flashdata="<?= flash(); ?>"
        data-link="http://localhost/kasir.v2/views/admin.php?menu=employe">
    </div>

    <div class="row text-right mb-3">
        <div class="col">
            <button type="button" class="btn btn-primary add-employe-modal-button" data-toggle="modal"
                data-target="#addNewEmployeModal">Add New
                Employe
            </button>
        </div>
    </div>

    <div class="d-flex flex-wrap justify-content-around">
        <?php foreach ($employes as $employe) : ?>
        <div class="card employe mb-3 bg-light shadow-sm border border-info">
            <div class="card-body text-center">
                <img src="../assets/img/profile/<?= $employe['profile']; ?>"
                    alt="Photo Profile" class="card-profile rounded-circle mb-3">
                <h5 class="card-title">
                    <?= $employe['name'] === ''  ? $employe['username'] : $employe['name']; ?>
                </h5>
                <h6 class="card-subtitle mb-2 text-muted">(Employe)</h6>
                <p class="card-text mb-0" data-employeusername=<?= $employe['username'] ?>>
                    Username : <?= $employe['username']; ?>
                </p>
                <p class="card-text mb-1">
                    Phone Number : <?= $employe['phone_number'] === ''  ? 'Not Create' : $employe['phone_number']; ?>
                </p>
                <p class="card-text">
                    <small class="text-muted">
                        Since <?= date('d-m-Y', $employe['date_create']); ?>
                    </small>
                </p>
                <a href="#" class="btn btn-success btn-sm change-employe-password-link" data-toggle="modal"
                    data-target="#changeEmployePasswordModal">Change
                    Password</a>
                <a href="#" class="btn btn-danger btn-sm delete-employe-link"
                    data-employeid="<?= $employe['id'] ?>">Delete</a>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- Add Employe Modal-->
<div class="modal fade add-employe-modal" id="addNewEmployeModal" tabindex="-1" role="dialog"
    aria-labelledby="addNewEmployeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="addNewEmployeModalLabel">Add New Employe</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="addNewEmployeUsername">Username</label>
                                <input type="text" class="form-control" id="addNewEmployeUsername"
                                    name="addNewEmployeUsername" aria-describedby="addNewEmployeUsernameHelp"
                                    minlength="3" maxlength="15" autocomplete="off" required autofocus>
                                <small id="addNewEmployeUsernameHelp" class="text-muted">
                                    Must be 3-15 characters long and no space.
                                </small>
                            </div>
                        </div>
                    </div>
                    <div class="row row-cols-1 row-cols-sm-1 row-cols-lg-2">
                        <div class="col">
                            <div class="form-group">
                                <label for="addNewEmployePassword">Password</label>
                                <input type="password" class="form-control" id="addNewEmployePassword"
                                    name="addNewEmployePassword" aria-describedby="addNewEmployePasswordHelp"
                                    minlength="8" maxlength="15" required autocomplete="off">
                                <small id="addNewEmployePasswordHelp" class="text-muted">
                                    Must be 8-15 characters long.
                                </small>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="addNewEmployeRePassword">Repeat Password</label>
                                <input type="password" class="form-control" id="addNewEmployeRePassword"
                                    name="addNewEmployeRePassword" required maxlength="15" autocomplete="off">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-warning">Clear</button>
                    <button type="submit" class="btn btn-primary" name="addNewEmployeButton" disabled>Add</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Change Employe Password Modal-->
<div class="modal fade change-password-employe-modal" id="changeEmployePasswordModal" tabindex="-1" role="dialog"
    aria-labelledby="changeEmployePasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="changeEmployePasswordModalLabel">Change Employe Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row row-cols-1 row-cols-sm-1 row-cols-lg-2">
                        <div class="col">
                            <div class="form-group">
                                <input type="hidden" id="changeEmployePasswordUsername"
                                    name="changeEmployePasswordUsername" readonly>
                                <label for="changeEmployePassword">Password</label>
                                <input type="password" class="form-control" id="changeEmployePassword"
                                    name="changeEmployePassword" autocomplete="off"
                                    aria-describedby="changeEmployePasswordHelp" minlength="8" maxlength="15"
                                    autocomplete="off" required autofocus>
                                <small id="changeEmployePasswordHelp" class="text-muted">
                                    Must be 8-15 characters long.
                                </small>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="changeEmployeRePassword">Repeat Password</label>
                                <input type="password" class="form-control" id="changeEmployeRePassword"
                                    name="changeEmployeRePassword" maxlength="15" autocomplete="off" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-warning">Clear</button>
                        <button type="submit" class="btn btn-primary" name="changeEmployePasswordButton" disabled>Change
                            password</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
            </form>
        </div>
    </div>
</div>