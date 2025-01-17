<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if ($_SESSION["userloggedin"] == 1) {
} else {
    header("Location: http://localhost/TimeTableGenerator/login.php");
    exit();
}

?>
<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <link href="./css/sidebars.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/dashboard.css">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .b-example-divider {
            width: 100%;
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }

        .btn-bd-primary {
            --bd-violet-bg: #712cf9;
            --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

            --bs-btn-font-weight: 600;
            --bs-btn-color: var(--bs-white);
            --bs-btn-bg: var(--bd-violet-bg);
            --bs-btn-border-color: var(--bd-violet-bg);
            --bs-btn-hover-color: var(--bs-white);
            --bs-btn-hover-bg: #6528e0;
            --bs-btn-hover-border-color: #6528e0;
            --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
            --bs-btn-active-color: var(--bs-btn-hover-color);
            --bs-btn-active-bg: #5a23c8;
            --bs-btn-active-border-color: #5a23c8;
        }

        .bd-mode-toggle {
            z-index: 1500;
        }

        .bd-mode-toggle .dropdown-menu .active .bi {
            display: block !important;
        }
    </style>


    <!-- Custom styles for this template -->
    <link href="sidebars.css" rel="stylesheet">
</head>

<body>
    <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
        <symbol id="home" viewBox="0 0 16 16">
            <path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4H2.5z" />
        </symbol>
        <symbol id="speedometer2" viewBox="0 0 16 16">
            <path d="M8 4a.5.5 0 0 1 .5.5V6a.5.5 0 0 1-1 0V4.5A.5.5 0 0 1 8 4zM3.732 5.732a.5.5 0 0 1 .707 0l.915.914a.5.5 0 1 1-.708.708l-.914-.915a.5.5 0 0 1 0-.707zM2 10a.5.5 0 0 1 .5-.5h1.586a.5.5 0 0 1 0 1H2.5A.5.5 0 0 1 2 10zm9.5 0a.5.5 0 0 1 .5-.5h1.5a.5.5 0 0 1 0 1H12a.5.5 0 0 1-.5-.5zm.754-4.246a.389.389 0 0 0-.527-.02L7.547 9.31a.91.91 0 1 0 1.302 1.258l3.434-4.297a.389.389 0 0 0-.029-.518z" />
            <path fill-rule="evenodd" d="M0 10a8 8 0 1 1 15.547 2.661c-.442 1.253-1.845 1.602-2.932 1.25C11.309 13.488 9.475 13 8 13c-1.474 0-3.31.488-4.615.911-1.087.352-2.49.003-2.932-1.25A7.988 7.988 0 0 1 0 10zm8-7a7 7 0 0 0-6.603 9.329c.203.575.923.876 1.68.63C4.397 12.533 6.358 12 8 12s3.604.532 4.923.96c.757.245 1.477-.056 1.68-.631A7 7 0 0 0 8 3z" />
        </symbol>
        <symbol id="table" viewBox="0 0 16 16">
            <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm15 2h-4v3h4V4zm0 4h-4v3h4V8zm0 4h-4v3h3a1 1 0 0 0 1-1v-2zm-5 3v-3H6v3h4zm-5 0v-3H1v2a1 1 0 0 0 1 1h3zm-4-4h4V8H1v3zm0-4h4V4H1v3zm5-3v3h4V4H6zm4 4H6v3h4V8z" />
        </symbol>
        <symbol id="people-circle" viewBox="0 0 16 16">
            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
        </symbol>
        <symbol id="grid" viewBox="0 0 16 16">
            <path d="M1 2.5A1.5 1.5 0 0 1 2.5 1h3A1.5 1.5 0 0 1 7 2.5v3A1.5 1.5 0 0 1 5.5 7h-3A1.5 1.5 0 0 1 1 5.5v-3zM2.5 2a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zm6.5.5A1.5 1.5 0 0 1 10.5 1h3A1.5 1.5 0 0 1 15 2.5v3A1.5 1.5 0 0 1 13.5 7h-3A1.5 1.5 0 0 1 9 5.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zM1 10.5A1.5 1.5 0 0 1 2.5 9h3A1.5 1.5 0 0 1 7 10.5v3A1.5 1.5 0 0 1 5.5 15h-3A1.5 1.5 0 0 1 1 13.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zm6.5.5A1.5 1.5 0 0 1 10.5 9h3a1.5 1.5 0 0 1 1.5 1.5v3a1.5 1.5 0 0 1-1.5 1.5h-3A1.5 1.5 0 0 1 9 13.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3z" />
        </symbol>
    </svg>

    <main class="d-flex flex-nowrap">
        <div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark" style="width: 280px; height:100vh;">
            <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                <span class="fs-4">Dashboard</span>
            </a>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="/TimeTableGenerator/staffdashboard.php" class="nav-link text-white" aria-current="page">
                        <svg class="bi pe-none me-2" width="16" height="16">
                            <use xlink:href="#home" />
                        </svg>
                        Home
                    </a>
                </li>
                <li>
                    <a href="/TimeTableGenerator/myttstaff.php" class="nav-link active text-white">
                        <svg class="bi pe-none me-2" width="16" height="16">
                            <use xlink:href="#speedometer2" />
                        </svg>
                        My Time-Tables
                    </a>
                </li>
                <li>
                    <a href="/TimeTableGenerator/allttstaff.php" class="nav-link text-white">
                        <svg class="bi pe-none me-2" width="16" height="16">
                            <use xlink:href="#table" />
                        </svg>
                        All Time-Tables
                    </a>
                </li>
            </ul>
            <hr>
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <?php
                    echo '<img src=' . $_SESSION['avatar'] . ' alt="" width="32" height="32" class="rounded-circle me-2">';
                    ?>
                    <strong>
                        <?php
                        if (isset($_SESSION["userloggedin"])) {
                            if ($_SESSION["userloggedin"] != 1) {
                                header("Location: http://localhost/TimeTableGenerator/login.php");
                            } else {
                                echo '<li class="float-right" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' . $_SESSION["username"] . '</li>';
                            }
                        } else {
                            header("Location: http://localhost/TimeTableGenerator/login.php");
                        }
                        ?>
                    </strong>
                </a>
                <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                    <!-- <li><a class="dropdown-item" href="#">New project...</a></li>
          <li><a class="dropdown-item" href="#">Settings</a></li> -->
                    <li><a class="dropdown-item" href="#">Profile</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="./services/logout.php">Log out</a></li>
                </ul>
            </div>
        </div>
        <div class="dashboard-content container-fluid">
            <?php
            include('../TimeTableGenerator/includes/dbconnection.php');
            try {
                $sql = mysqli_prepare($conn, "SELECT * FROM `staff` where staffId=?;");
                $sql->bind_param("s", $_SESSION['userid']);
            } catch (Exception $e) {
                echo $e->getMessage();
                // die;
            }

            $sql->execute();
            $data = $sql->get_result();

            while ($row = mysqli_fetch_assoc($data)) {
                echo '
                <div class="dashboard-heading display-4">Timetable For ' . $_SESSION['username'] . '</div>
                <hr>
                <div class="container-fluid">
                    <div id="timetables"></div>
                </div>
                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        fetch_updatedata(' . $row['year'] . ',"' . $row['name'] . '","'.$row['staffId'].'");
                    });
                </script>';
            }
            ?>
        </div>
    </main>
</body>
<script src="./js/sidebars.js"></script>
<script>
    let timetable;
    let subjects;
    let staff;
    let updatedtt;

    function fetch_updatedata(e, staffname, staffId) {
        var xhr = new XMLHttpRequest();

        // Define the type of request, the URL, and if it's asynchronous
        xhr.open("POST", "/TimeTableGenerator/services/fetch_updatedata.php", true);

        // Set the request header to indicate the content type for POST
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        // Handle the response from the PHP file
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // Update the div with the response from the PHP file
                var timetable = JSON.parse(xhr.response);
                console.log(timetable);
                displayexistingtt(timetable, staffname);

            }
        };

        // Send the selected value as POST data
        xhr.send(`year=${e}&data=timetable&type=staff&query=${staffId}`);
    }

    function displayexistingtt(timetable, staffname) {
        var container = document.getElementById('timetables');

        const days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        const timeSlots = ['9:00 AM - 10:00 AM', '10:00 AM - 11:00 AM', '11:00 AM - 11:15 AM', '11:15 AM - 12:15 PM', '12:15 PM - 1:15 PM', '1:15 PM - 2:15 PM', '2:15 PM - 3:15 PM', '3:15 PM - 4:15 PM'];

        Object.entries(timetable).forEach(([division, divisiondata]) => {
            let tableHTML = `<h2>Timetable for Division ${division}</h2>`;
            tableHTML += '<table class="table table-bordered">';
            tableHTML += '<tr ><th class="bg-warning">Time Slot</th>';

            // Add headers for days
            days.forEach((day) => {
                tableHTML += `<th class="bg-warning">${day}</th>`;
            });
            tableHTML += '</tr>';

            // Loop through each time slot
            for (let slot = 1; slot <= 8; slot++) {
                tableHTML += '<tr>';
                tableHTML += `<td class="bg-warning">${timeSlots[slot - 1]}</td>`; // Display the time slot name

                // Add data for each day
                days.forEach((day) => {
                    // Check for break times
                    if (slot === 3) {
                        tableHTML += '<td class="bg-warning">Tea Break</td>';
                        return;
                    }
                    if (slot === 6) {
                        tableHTML += '<td class="bg-warning">Lunch Break</td>';
                        return;
                    }

                    if (Object.keys(timetable[division][day][slot]).length > 1) {
                        var i = 1;
                        tableHTML += "<td>"
                        Object.entries(timetable[division][day][slot]).forEach(([key, value]) => {
                            // tableHTML += `${Objects.keys(timetable[division][day][slot])[index]} : ${key} : ${value}`;
                            if (Object.keys(timetable[division][day][slot][key])[0] == staffname) {
                                tableHTML += `${key} : ${Object.keys(timetable[division][day][slot][key])[0]} : ${timetable[division][day][slot][key][Object.keys(timetable[division][day][slot][key])[0]]}`;
                                tableHTML += "<br>";
                            }

                            i++;
                        })
                        tableHTML += `</td>`;
                    } else {
                        // console.log(key);
                        // console.log(value);
                        // console.log("re");
                        if (Object.keys(timetable[division][day][slot])[0] == staffname) {
                            tableHTML += `<td>${Object.keys(timetable[division][day][slot])[0]} (${timetable[division][day][slot][Object.keys(timetable[division][day][slot])[0]]})</td>`;
                        }else
                        {
                            tableHTML+=`<td></td>`;
                        }
                    }
                });

                tableHTML += '</tr>';
            }

            tableHTML += '</table>';

            // Append the generated table HTML for the division to the container
            container.innerHTML += tableHTML;
        });
    }
</script>

</html>