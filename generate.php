<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if ($_SESSION["userloggedin"] == 1) {
    if ($_SESSION["adminstatus"] == 0) {
        echo "You Dont Have Access to this page";
        die();
    }
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
                    <a href="/TimeTableGenerator/administration.php" class="nav-link active" aria-current="page">
                        <svg class="bi pe-none me-2" width="16" height="16">
                            <use xlink:href="#home" />
                        </svg>
                        Home
                    </a>
                </li>
                <li>
                    <a href="#" class="nav-link text-white">
                        <svg class="bi pe-none me-2" width="16" height="16">
                            <use xlink:href="#speedometer2" />
                        </svg>
                        My Time-Tables
                    </a>
                </li>
                <li>
                    <a href="#" class="nav-link text-white">
                        <svg class="bi pe-none me-2" width="16" height="16">
                            <use xlink:href="#table" />
                        </svg>
                        All Time-Tables
                    </a>
                </li>
                <li>
                    <a href="/TimeTableGenerator/generate.php" class="nav-link text-white">
                        <svg class="bi pe-none me-2" width="16" height="16">
                            <use xlink:href="#grid" />
                        </svg>
                        Generate TimeTables
                    </a>
                </li>
                <li>
                    <a href="/TimeTableGenerator/associate.php" class="nav-link text-white">
                        <svg class="bi pe-none me-2" width="16" height="16">
                            <use xlink:href="#people-circle" />
                        </svg>
                        Associate Staff
                    </a>
                </li>
                <li>
                    <a href="/TimeTableGenerator/associateLabs.php" class="nav-link text-white">
                        <svg class="bi pe-none me-2" width="16" height="16">
                            <use xlink:href="#people-circle" />
                        </svg>
                        Associate Labs
                    </a>
                </li>
                <li>
                    <a href="/TimeTableGenerator/addStaff.php" class="nav-link text-white">
                        <svg class="bi pe-none me-2" width="16" height="16">
                            <use xlink:href="#people-circle" />
                        </svg>
                        Add Staff
                    </a>
                </li>
                <li>
                    <a href="/TimeTableGenerator/addDivisions.php" class="nav-link text-white">
                        <svg class="bi pe-none me-2" width="16" height="16">
                            <use xlink:href="#people-circle" />
                        </svg>
                        Add Divisions
                    </a>
                </li>
                <li>
                    <a href="/TimeTableGenerator/addBatches.php" class="nav-link text-white">
                        <svg class="bi pe-none me-2" width="16" height="16">
                            <use xlink:href="#people-circle" />
                        </svg>
                        Add Batches
                    </a>
                </li>
                <li>
                    <a href="/TimeTableGenerator/addSubjects.php" class="nav-link text-white">
                        <svg class="bi pe-none me-2" width="16" height="16">
                            <use xlink:href="#people-circle" />
                        </svg>
                        Add Subjects
                    </a>
                </li>
            </ul>
            <hr>
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
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
            <div class="dashboard-heading display-4">Generate Timetable</div>
            <?php
            include('../TimeTableGenerator/includes/dbconnection.php');

            $associations = [];
            $subjects = [];

            try {
                $year = 2;
                $sql = mysqli_prepare($conn, "SELECT * FROM associations WHERE year=?");
                $sql->bind_param("i", $year);
            } catch (Exception $e) {
                echo $e->getMessage();
                // die;
            }

            $sql->execute();
            $data = $sql->get_result();

            // echo mysqli_fetch_assoc($data);
            while ($row = mysqli_fetch_assoc($data)) {
                $associations[$row['division']][$row['staffid']] = $row['subjectname'];
            }

            try {
                $year = 2;
                $sql = mysqli_prepare($conn, "SELECT distinct subject_code , subject_name FROM subjects WHERE semester=?");
                $sql->bind_param("i", $year);
            } catch (Exception $e) {
                echo $e->getMessage();
                // die;
            }

            $sql->execute();
            $data = $sql->get_result();

            // echo mysqli_fetch_assoc($data);
            while ($row = mysqli_fetch_assoc($data)) {
                $subjects[$row['subject_code']] = $row['subject_name'];
            }

            ?>
            <div class="container-fluid">
                <!-- action="./services/generatett.php" -->
                <form id="lecturecntform" class="form-signup">
                    <table>
                        <tbody>
                            <?php
                            $lecturecountinput = "";
                            foreach ($subjects as $subjectid => $subject) {
                                $subrow = "<tr>
                        <td>$subject</td>
                        <td>
                        <div class='m-2'>
                        <input type='number' class='form-control' name='" . $subjectid . "' placeholder='Enter lecture count'></input>
                        </div>
                        </td>
                    </tr>";
                                $lecturecountinput = $lecturecountinput . $subrow;
                            }
                            echo $lecturecountinput;
                            ?>
                        </tbody>
                    </table>
                    <button class="btn btn-primary btn-block" onclick="generatett()" type="button"><i class="fas fa-user-plus"></i>Generate</button>
                </form>
            </div>
            <hr>
            <div class="container-fluid">
                <div id="timetables"></div>
            </div>
        </div>
    </main>
    <script src="./js/sidebars.js"></script>
</body>
<script>
    function generatett(e) {
        const formData = new FormData(document.getElementById('lecturecntform'));
        let subjects;
        let staff;

        var xhr = new XMLHttpRequest();

        xhr.open("POST", "/TimeTableGenerator/services/fetchdata.php", false);

        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // console.log(xhr.response);
                console.log(JSON.parse(xhr.response));
                subjects = JSON.parse(xhr.response);
                console.log(typeof subjects);
                // displayTimetable(JSON.parse(xhr1.response));
            }
        };

        xhr.send("year=2&data=subjects");


        var xhr2 = new XMLHttpRequest();

        xhr2.open("POST", "/TimeTableGenerator/services/fetchdata.php", false);

        xhr2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        xhr2.onreadystatechange = function() {
            if (xhr2.readyState == 4 && xhr2.status == 200) {
                // console.log(xhr.response);
                console.log(JSON.parse(xhr2.response));
                staff = JSON.parse(xhr2.response);
                console.log(typeof staff);
                console.log(staff['T01']);
                // displayTimetable(JSON.parse(xhr1.response));
            }
        };

        xhr2.send("year=2&data=staff");

        var xhr1 = new XMLHttpRequest();

        xhr1.open("POST", "/TimeTableGenerator/services/generatett.php", true);

        xhr1.onreadystatechange = function() {
            if (xhr1.readyState == 4 && xhr1.status == 200) {
                // console.log(xhr1.response);
                if (xhr1.responseText == "Exception") {
                    alert("Failed To Generate Timetable with Specified Lecture Count.");
                } else {

                    console.log(JSON.parse(xhr1.response));
                    displayTimetable(JSON.parse(xhr1.response), staff, subjects);
                }
            }
        };

        xhr1.send(formData);



        // const timetableresponse = await fetch('http://localhost/TimeTableGenerator/services/generatett.php', {
        //     method: "POST",
        //     body: formData
        // })

        // console.log(await timetableresponse.json());
    }

    function displayTimetable(timetable, staff, subjects) {
        let container = document.getElementById('timetables'); // Assumes you have a container div for the timetable display.
        container.innerHTML = ''; // Clear any existing timetable content

        const divisions = ['A', 'B', 'C'];
        const days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        const divisionCnt = {
            'A': 1,
            'B': 2,
            'C': 3
        };
        const timeSlots = ['9:00 AM - 10:00 AM', '10:00 AM - 11:00 AM', '11:00 AM - 11:15 AM', '11:15 AM - 12:15 PM', '12:15 PM - 1:15 PM', '1:15 PM - 2:15 PM', '2:15 PM - 3:15 PM', '3:15 PM - 4:15 PM'];

        divisions.forEach((division) => {
            let tableHTML = `<h2>Timetable for Division ${division}</h2>`;
            tableHTML += '<table class="table table-bordered">';
            tableHTML += '<tr><th>Time Slot</th>';

            // Add headers for days
            days.forEach((day) => {
                tableHTML += `<th>${day}</th>`;
            });
            tableHTML += '</tr>';

            // Loop through each time slot
            for (let slot = 1; slot <= 8; slot++) {
                tableHTML += '<tr>';
                tableHTML += `<td>${timeSlots[slot - 1]}</td>`; // Display the time slot name

                // Add data for each day
                days.forEach((day) => {
                    // Check for break times
                    if (slot === 3) {
                        tableHTML += '<td class="bg-warning">Tea Break</td>';
                        return;
                    }
                    if (slot === 6) {
                        tableHTML += '<td class="bg-danger">Lunch Break</td>';
                        return;
                    }

                    // Check if there's a subject assigned at this slot
                    const dayData = timetable[day] || {};
                    const slotData = dayData[slot] || {};

                    // Get the faculty and subject for this slot
                    const slotFaculty = Object.keys(slotData);
                    const facultyIndex = divisionCnt[division] - 1;
                    const faculty = slotFaculty[facultyIndex] || 'No Faculty';
                    const subject = slotData[faculty] || 'Free';

                    if (faculty == "LAB" && typeof subject == 'object') {
                        var i = 1;
                        tableHTML += "<td>"
                        Object.entries(subject).forEach(([key, value]) => {
                            if (`${division}${i}` == key) {
                                // tableHTML+=`${staff[key][name]} : ${subjects[value][subject_name]}`;
                                tableHTML += `${key} : ${value}`;
                            } else {
                                // console.log(staff[key]['name']);
                                // console.log(subjects[value]['subject_name'])
                                tableHTML += `${division}${i} : ${subjects[value]['subject_alias']} : ${staff[key]['name']}`;
                            }
                            // console.log(`${division}${i} : ${key}: ${value}`);
                            tableHTML += "<br>";
                            i++;
                        })
                        // console.log(typeof subject);
                        // console.log(subject);
                        tableHTML += `</td>`;
                    } else {
                        // console.log(staff[faculty]['name']);
                        // console.log(subjects[subject]['subject_alias']);
                        // console.log(subject);
                        // console.log(faculty);
                        // tableHTML += `<td>${subject} (${faculty})</td>`;
                        if (subject != "Free" && subject != division) {
                            // console.log(subjects[subject]['subject_alias']);
                            tableHTML += `<td>${subjects[subject]['subject_alias']} (${staff[faculty]['name']})</td>`;
                        } else {
                            tableHTML += `<td>OFF</td>`;
                        }
                        // console.log("\n");
                    }
                    // console.log("\n");

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