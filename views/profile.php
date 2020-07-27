<?php
    require('../controllers/Profile.php');
?>
<div class="shadow-sm p-3 mb-3 rounded profile">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">My Profile</h1>
    </div>

    <!-- Flash Data -->
    <div class="flash-data-profile" data-flashdata="<?= flash(); ?>"
        data-link="http://localhost/kasir.v2/views/<?= $_SESSION['user']['role'] === 'Administrator' ? 'admin' : 'user'?>.php?menu=profile">
    </div>

    <?php if ($_SESSION['user']['name'] === '' && $_SESSION['user']['phone_number'] === '') : ?>
    <div class="alert alert-danger">
        Please edit your profile. Set your name and your phone number.
    </div>
    <?php endif; ?>

    <div class="card mb-3 profile">
        <div class="row no-gutters">
            <div class="col-md-4 mb-0">
                <img src="../assets/img/profile/<?= $_SESSION['user']['profile']; ?>"
                    class="card-img" alt="Photo Profile">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">
                        <?= $_SESSION['user']['name']; ?>
                    </h5>
                    <h6 class="card-subtitle mb-2 text-muted">
                        <?= $_SESSION['user']['role']; ?>
                    </h6>
                    <p class="card-text mb-0">
                        Username : <?= $_SESSION['user']['username']; ?>
                    </p>
                    <p class="card-text mb-1">
                        Phone Number : <?= $_SESSION['user']['phone_number']; ?>
                    </p>
                    <p class="card-text"><small class="text-muted">
                            Since : <?= date('d-m-Y', $_SESSION['user']['since']); ?></small>
                    </p>
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                        data-target="#updateProfileModal">Edit Profile</button>
                    <button type="button" class="btn btn-success btn-sm change-password-profile" data-toggle="modal"
                        data-target="#changePasswordModal">Change Password</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Update Profile-->
<div class="modal fade" id="updateProfileModal" tabindex="-1" role="dialog" aria-labelledby="updateProfileModalLabel"
    aria-hidden="true">
    <div class="modal-dialog profile-edit">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateProfileModalLabel">Update Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col col-12 col-md-3">
                            <img src="../assets/img/profile/<?= $_SESSION['user']['profile']; ?>"
                                alt="Photo Profile" class="rounded-circle mb-3">
                        </div>
                        <div class="col">
                            <div class="form-group mb-0">
                                <label for="photoProfile">Photo Profile</label>
                                <input type="file" class="form-control-file" id="photoProfile" name="photoProfile"
                                    autofocus>
                            </div>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col">
                            <div class="form-group">
                                <input type="hidden" name="username"
                                    value="<?= $_SESSION['user']['username']; ?>"
                                    readonly>
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    aria-describedby="nameHelp" minlength="3" maxlength="20" autocomplete="off"
                                    value="<?= $_SESSION['user']['name']; ?>"
                                    required>
                                <small id="nameHelp" class="text-muted">
                                    Must be 3-20 characters long.
                                </small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="phoneNumber">Phone Number</label>
                                <input type="number" class="form-control" id="phoneNumber" name="phoneNumber"
                                    aria-describedby="phoneNumberHelp" minlength="10" maxlength="15" autocomplete="off"
                                    value="<?= $_SESSION['user']['phone_number']; ?>"
                                    required>
                                <small id="phoneNumberHelp" class="text-muted">
                                    Use active phone number.
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="updateProfile">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Change Password-->
<div class="modal fade change-password-modal" id="changePasswordModal" tabindex="-1" role="dialog"
    aria-labelledby="changePasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changePasswordModalLabel">Change Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST">
                <div class="modal-body">
                    <div class="row row-cols-1 row-cols-sm-1 row-cols-lg-2">
                        <div class="col">
                            <div class="form-group">
                                <input type="hidden" name="username"
                                    value="<?= $_SESSION['user']['username']; ?>"
                                    readonly>
                                <label for=" password">Password</label>
                                <input type="password" class="form-control" id="password" name="password"
                                    autocomplete="off" aria-describedby="changePasswordHelp" minlength="8"
                                    maxlength="15" autocomplete="off" required autofocus>
                                <small id="changePasswordHelp" class="text-muted">
                                    Must be 8-15 characters long.
                                </small>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="rePassword">Repeat Password</label>
                                <input type="Password" class="form-control" id="rePassword" name="rePassword"
                                    maxlength="15" autocomplete="off" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-warning">Clear</button>
                    <button type="submit" name="changePassword" class="btn btn-primary" disabled>Change
                        Password</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>