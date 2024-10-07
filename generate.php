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
    // echo json_encode($subjects);


    // Define the timetable structure
    // $years = [
    //     'First Year' => ['Division A1', 'Division B1', 'Division C1'],
    //     'Second Year' => ['Division A2', 'Division B2', 'Division C2'],
    //     'Third Year' => ['Division A3', 'Division B3', 'Division C3']
    // ];

    // $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
    // $time_slots = ['9:00 AM - 10:00 AM', '10:00 AM - 11:00 AM', '11:00 AM - 12:00 PM', '12:00 PM - 1:00 PM', '1:00 PM - 2:00 PM', '2:00 PM - 3:00 PM', '3:00 PM - 4:00 PM'];

    // // Subjects and faculty for each year
    // $subjects = [
    //     'First Year' => ['Math', 'Physics', 'Chemistry', 'Engineering Mechanics', 'Basic Electrical'],
    //     'Second Year' => ['Data Structures', 'Digital Electronics', 'Discrete Math', 'Signals and Systems', 'Computer Networks'],
    //     'Third Year' => ['Operating Systems', 'Microprocessors', 'Database Systems', 'Software Engineering', 'Artificial Intelligence']
    // ];

    // $faculty = [
    //     'First Year' => ['Dr. Smith', 'Prof. Johnson', 'Dr. Lee', 'Prof. Brown', 'Dr. Patel'],
    //     'Second Year' => ['Prof. Clark', 'Dr. Martinez', 'Prof. Taylor', 'Dr. White', 'Prof. Hall'],
    //     'Third Year' => ['Dr. King', 'Prof. Adams', 'Dr. Wright', 'Prof. Scott', 'Dr. Harris']
    // ];

    // Helper function to get a random subject and ensure no overlap for the same division
    //  

    // Helper function to get a random faculty and ensure no overlapping for the same time slot across divisions
    // function getAvailableFaculty($division, $day, $time, $faculty, $timetable) {
    //     global $divisions;

    //     // Find the faculty who aren't assigned to any other division at the same time
    //     $available_faculty = $faculty[$division];
    //     foreach ($divisions[$division] as $div) {
    //         if (isset($timetable[$year][$div][$day][$time]) && $div !== $division) {
    //             $assigned_faculty = $timetable[$year][$div][$day][$time]['faculty'];
    //             $available_faculty = array_diff($available_faculty, [$assigned_faculty]);
    //         }
    //     }

    //     return !empty($available_faculty) ? $available_faculty[array_rand($available_faculty)] : $faculty[$year][array_rand($faculty[$year])];
    // }

    // Generate timetable with no overlapping for faculty between divisions in the same time slot
    // function generateTimetable($divisions, $days, $time_slots, $subjects, $faculty) {
    //     $timetable = [];

    //     // foreach ($years as $year => $divisions) {
    //         foreach ($divisions as $division) {
    //             foreach ($days as $day) {
    //                 $assigned_subjects = [];

    //                 foreach ($time_slots as $time) {
    //                     // Add Lunch Break from 12:00 PM to 1:00 PM
    //                     if ($time === '12:00 PM - 1:00 PM') {
    //                         // $timetable[$year][$division][$day][$time] = [
    //                         $timetable[$division][$day][$time] = [
    //                             'subject' => 'Lunch Break',
    //                             'faculty' => '-'
    //                         ];
    //                     } else {
    //                         // Get available subject and faculty
    //                         $subject = getAvailableSubject($assigned_subjects, $subjects[$division]);
    //                         $teacher = getAvailableFaculty($division, $day, $time, $faculty, $timetable);

    //                         // Store assigned subjects to avoid overlaps within the same division
    //                         $assigned_subjects[] = $subject;

    //                         // Assign the timetable entry
    //                         $timetable[$year][$division][$day][$time] = [
    //                             'subject' => $subject,
    //                             'faculty' => $teacher
    //                         ];
    //                     }
    //                 }
    //             }
    //         }
    //     // }

    //     return $timetable;
    // }

    // Display timetable for each division as a single table with all days included
    // function displayTimetable($timetable) {
    //     foreach ($timetable as $year => $divisions) {
    //         echo "<h1>Timetable for $year</h1>";
    //         foreach ($divisions as $division => $days) {
    //             echo "<h2>Timetable for $division</h2>";
    //             echo "<table border='1' cellpadding='10'>";
    //             echo "<tr><th>Time Slot</th>";
    //             foreach (array_keys($days) as $day) {
    //                 echo "<th>$day</th>";
    //             }
    //             echo "</tr>";

    //             // Loop through each time slot and display subjects/faculty for each day
    //             foreach (array_keys(current($days)) as $time_slot) {
    //                 echo "<tr>";
    //                 echo "<td>$time_slot</td>";
    //                 foreach ($days as $day => $times) {
    //                     $subject = $times[$time_slot]['subject'];
    //                     $faculty = $times[$time_slot]['faculty'];
    //                     echo "<td>$subject<br>($faculty)</td>";
    //                 }
    //                 echo "</tr>";
    //             }
    //             echo "</table><br>";
    //         }
    //     }
    // }

    // Generate and display the timetable
    // $timetable = generateTimetable($years, $days, $time_slots, $subjects, $faculty);
    // displayTimetable($timetable);

    ?>
    <div class="container">
        <!-- onsubmit="return validateRegistration()" -->
        <form action="./services/generatett.php" method="POST" class="form-signup">
            <!-- <select name="staff" class="form-control"> -->
            <!-- <?php
                    $q = mysqli_query(
                        mysqli_connect("localhost", "root", "root", "Dev"),
                        "SELECT * FROM staff"
                    );
                    $row_count = mysqli_num_rows($q);
                    if ($row_count) {
                        $mystring = '
         <option selected disabled>Select Staff</option>';
                        while ($row = mysqli_fetch_assoc($q)) {
                            $mystring .= '<option value="' . $row['staffId'] . '">' . "(" . $row['staffId'] . ")  " . $row['name'] . '</option>';
                        }

                        echo $mystring;
                    }
                    ?> -->
            <!-- </select> -->
            <!-- <select class="form-select" aria-label="Default select example" name="year" onchange="fetch_updatedata(this.value)">
                <option selected disabled>Select Year</option>
                <option value="2">2</option> -->
            <!-- <option value="LAB">lab</option> -->
            <!-- <option value="2">Two</option>
                        <option value="3">Three</option> -->
            <!-- </select> -->
            <table>
                <tbody>
                    <?php
                    $lecturecountinput = "";
                    foreach ($subjects as $subjectid => $subject) {
                        $subrow = "<tr>
                        <td>$subject</td>
                        <td><input type='number' class='form-control' name='" . $subjectid ."' placeholder='Enter lecture count'></input></td>
                    </tr>";
                        $lecturecountinput = $lecturecountinput . $subrow;
                    }
                    echo $lecturecountinput;
                    ?>
                </tbody>
            </table>
            <!-- <select id="subjectselection" name="subject" class="form-control">
                <option selected disabled>Select Subject</option>

            </select> -->
            <!-- <select id="divisionselection" class="form-select" aria-label="Default select example" name="division">
                <option selected disabled>Select Division</option> -->
            <!-- <option value="2">Two</option>
                        <option value="3">Three</option> -->
            <!-- </select> -->
            <!-- <input type="number" id="semester" class="form-control" placeholder="semester" required autofocus="" name="semester"> -->
            <!-- <input type="text" id="qualification" class="form-control" placeholder="Qualification" required autofocus="" name="qualification">
                    <input type="password" id="user-pass" class="form-control" placeholder="Password" required autofocus="">
                    <input type="password" id="user-repeatpass" class="form-control" placeholder="Repeat Password" required autofocus="" name="password"> -->

            <button class="btn btn-primary btn-block" type="submit"><i class="fas fa-user-plus"></i>Generate</button>
        </form>
    </div>
</body>

</html>