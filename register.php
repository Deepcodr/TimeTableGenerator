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
    <script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
    <script src="./js/login.js"></script>
    <link rel="stylesheet" type="text/css" href="./css/login.css">
</head>

<body class="login-form" style="font-size: 100%;">
    <div id="logreg-forms">
        <!-- onsubmit="return validateRegistration()"  -->
        <form action="./services/registeruser.php" id="registerform" method="post" class="form-signup" onsubmit="return validateRegistration()">
            <div class="mb-3">
                <input type="text" id="user-name" class="form-control" placeholder="Full name" required="" autofocus="" name="fullname">
            </div>
            <div class="mb-3">
                <input type="number" id="user-phone" class="form-control" placeholder="Phone Number" required="" autofocus="" name="phone">
            </div>
            <div class="mb-3">
                <input type="email" id="user-email" class="form-control" placeholder="Email address" required="" autofocus="" name="email">
            </div>
            <div class="mb-3">
                <input type="number" id="user-prn" class="form-control" placeholder="PRN Number" required="" autofocus="" name="prn">
            </div>
            <div class="mb-3">
                <label for="year" class="form-label">Select Year</label>
                <select class="form-select" id="user-year" name="year" onchange="fetchdata(this.value)">
                    <option selected disabled>Year</option>
                    <option value="1">First Year</option>
                    <option value="2">Second Year</option>
                    <option value="3">Third Year</option>
                    <option value="4">Final Year</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="division" class="form-label">Select Division to associate</label>
                <select id="user-division" class="form-select" name="division">
                    <option selected disabled>Division</option>
                </select>
            </div>
            <div class="mb-3">
                <input type="password" id="user-pass" class="form-control" placeholder="Password" required autofocus="">
            </div>
            <div class="mb-3">
                <input type="password" id="user-repeatpass" class="form-control" placeholder="Repeat Password" required autofocus="" name="password">
            </div>
            <button class="form-control btn btn-primary btn-block" type="submit"><i class="fas fa-user-plus"></i><br> Sign Up</button>
        </form>

    </div>
</body>
<script>
    function fetchdata(e) {
        var xhr1 = new XMLHttpRequest();

        // Define the type of request, the URL, and if it's asynchronous
        xhr1.open("POST", "/TimeTableGenerator/services/fetch_updatedata.php", true);

        // Set the request header to indicate the content type for POST
        xhr1.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        // Handle the response from the PHP file
        xhr1.onreadystatechange = function() {
            if (xhr1.readyState == 4 && xhr1.status == 200) {
                // Update the div with the response from the PHP file
                document.getElementById('user-division').innerHTML = xhr1.responseText;
            }
        };

        // Send the selected value as POST data
        xhr1.send("year=" + e + "&data=divisions&type=register");
    }
</script>

</html>