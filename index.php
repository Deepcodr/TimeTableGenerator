<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/index.css">
    <title>TimeTableGenerator</title>
</head>
<?php

?>

<body>
    <div class="container-fluid">
        <div class="container text-center" style="height: 20vh;">
            <h1 class="display-1 p-4">Welcome To Time Table Generator</h1>
        </div>
        <div class="container d-flex justify-content-between align-items-center" style="height: 80vh;">
            <div class="card" style="width: 18rem; height:10rem;">
                <div class="card-body text-center d-flex align-items-center justify-content-center login_btn">
                    <button class="btn btn-transparent">
                        <a href="/TimeTableGenerator/login.php" class="home_link"><h1 class="card-text text-light">Login</h1></a>
                    </button>
                </div>
            </div>
            <div class="card" style="width: 18rem; height:10rem;">
                <div class="card-body text-center d-flex align-items-center justify-content-center login_btn">
                    <button class="btn btn-transparent">
                    <a href="/TimeTableGenerator/register.php" class="home_link"><h1 class="card-text text-light">Register</h1></a>
                    </button>
                </div>
            </div>
            <div class="card" style="width: 18rem; height:10rem;">
                <div class="card-body text-center d-flex align-items-center justify-content-center login_btn">
                    <button class="btn btn-transparent">
                    <a href="/TimeTableGenerator/administration.php" class="home_link"><h1 class="card-text text-light">Administration</h1></a>
                    </button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>