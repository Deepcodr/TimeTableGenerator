<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script type="text/javascript">
        function changesheet(sheet) {
            document.getElementById('pagestyle').setAttribute('href', sheet);
        }
    </script>
    <!-- <script src="./js/login.js"></script> -->
    <script src="https://kit.fontawesome.com/f5126202d4.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="./css/login.css">
</head>

<body class="login-form" style="font-size: 100%;">
<div id="logreg-forms">
<!-- onsubmit="return validateRegistration()" -->
    <form action="./services/registeruser.php" method="POST" class="form-signup" >
        <input type="text" id="user-name" class="form-control" placeholder="Full name" required="" autofocus="" name="fullname">
        <input type="number" id="user-phone" class="form-control" placeholder="Phone Number" required="" autofocus="" name="phone">
        <input type="email" id="user-email" class="form-control" placeholder="Email address" required autofocus="" name="email">
        <!-- <input type="password" id="user-pass" class="form-control" placeholder="Password" required autofocus=""> -->
        <input type="password" id="user-repeatpass" class="form-control" placeholder="Repeat Password" required autofocus="" name="password">

        <button class="btn btn-primary btn-block" type="submit"><i class="fas fa-user-plus"></i> Sign Up</button>
    </form>
    
</div>
</body>
</html>