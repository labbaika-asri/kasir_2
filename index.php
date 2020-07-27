<?php
    require('controllers/Index.php');
?>

<!DOCTYPE html>
<html lang="en" class="login">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS, My Style -->
    <link rel="stylesheet" href="assets/css/bootstrap.css" />
    <link rel="stylesheet" href="assets/css/style.css" />

    <title>Login</title>
</head>

<body class="login">
    <div class="container-fluid bg-primary h-100 login">
        <div class="row h-100 align-items-center justify-content-center">
            <div class="col-lg-7 col-md-10 rounded text-white">
                <div class="row mb-3">
                    <div class="col text-center">
                        <h1>Login</h1>
                        <hr class="bg-white" />
                    </div>
                </div>
                <form action="" method="POST">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="loginUsername">Username</label>
                                <input type="text" id="loginUsername" name="loginUsername" class="form-control" required
                                    autofocus />
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="loginPassword">Password</label>
                                <input type="password" id="loginPassword" name="loginPassword" class="form-control"
                                    autocomplete="off" required />
                            </div>
                        </div>
                    </div>
                    <?php if (isset($_POST['loginButton']) && $check < 1) : ?>
                    <div class="row">
                        <div class="col">
                            <div class="alert alert-danger" role="alert">
                                Your Username or Password is Wrong!
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                    <div class="row justify-content-end">
                        <div class="col-md-3">
                            <button type="submit" id="loginButton" name="loginButton"
                                class="btn btn-success login-button">
                                Login
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Bootstrap JS-->
    <script src="assets/js/jquery-3.5.1.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</body>

</html>