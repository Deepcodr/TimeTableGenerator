<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script type="text/javascript">
        function changesheet(sheet) {
            document.getElementById('pagestyle').setAttribute('href', sheet);
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/f5126202d4.js" crossorigin="anonymous"></script>
    <script src="./js/login.js"></script>
    <link rel="stylesheet" type="text/css" href="./css/login.css">
</head>

<body class="login-form" style="font-size: 100%;">
    <?php
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
    if (isset($_SESSION['registerstatus'])) {
        if ($_SESSION['registerstatus'] === 1) {
            echo '<div id="successtoast" class="alert alert-success container mt-4" role="alert">
        <h4 class="alert-heading">Registration Successful Login to Continue!</h4>
        </div>
        <script>
            setTimeout(hidetoast,5000);
        </script>';
            $_SESSION['registerstatus'] = 0;
        } elseif ($_SESSION['registerstatus'] === -1) {
            echo '<div id="dangertoast" class="alert alert-danger container mt-4" role="alert">
        <h4 class="alert-heading">Registration Unsuccessful . Please Try Again!</h4>
        </div>
        <script>
            setTimeout(hidetoast,5000);
        </script>';
            $_SESSION['registerstatus'] = 0;
        } else {
            echo '<script>
        hidetoast();
        </script>';
        }
    } else if (isset($_SESSION["loginstatus"])) {
        if ($_SESSION["loginstatus"] === 2) {
            echo '<div id="dangertoast" class="alert alert-danger container mt-4" role="alert">
            <h4 class="alert-heading">User Does Not Exist!</h4>
            </div>
            <script>
                setTimeout(hidetoast,5000);
            </script>';
        } elseif ($_SESSION["loginstatus"] === -1) {
            echo '<div id="dangertoast" class="alert alert-danger container mt-4" role="alert">
                <h4 class="alert-heading">Invalid Username Or Password</h4>
                </div>
                <script>
                    setTimeout(hidetoast,5000);
                </script>';
        }
    } else {
        echo '<script>
        hidetoast();
        </script>';
    }
    ?>
    <div id="logreg-forms">
        <form id="login-form" class="form-signin" action="./services/loginuser.php" method="post" onsubmit="return validateLogin()">
            <h1 class="h3 mb-3 font-weight-normal" style="text-align: center"> Sign in</h1>
            <div class="form-group mb-3">
                <label for="user-type">User Type</label>
                <select name="user-type" class="form-control" id="user-type">
                    <option selected value="0">Student</option>
                    <option value=1>Admin</option>
                    <option value=2>Staff</option>
                </select>
            </div>
            <div class="mb-3">
                <input type="email" id="inputEmail" class="form-control" placeholder="Username" required="" autofocus="" name="username">
            </div>
            <div class="mb-3">
                <input type="password" id="inputPassword" class="form-control" placeholder="Password" required="" name="password">
            </div>

            <button class="form-control btn btn-success btn-block" type="submit"><i class="fas fa-sign-in-alt"></i><br> Sign in</button>
            <!-- <a href="#" id="forgot_pswd">Forgot password?</a> -->
            <hr>
            <!-- <p>Don't have an account!</p>  -->
            <a class="btn btn-primary btn-block text-light" href="./register.php" id="btn-signup"><i class="fas fa-user-plus"></i><br>Sign up New Account</a>
        </form>

        <form action="/reset/password/" class="form-reset">
            <input type="email" id="resetEmail" class="form-control" placeholder="Email address" required="" autofocus="">
            <button class="btn btn-primary btn-block" type="submit">Reset Password</button>
            <a href="#" id="cancel_reset"><i class="fas fa-angle-left"></i> Back</a>
        </form>
    </div>
</body>
</html>