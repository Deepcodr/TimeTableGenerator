<?php
include('../includes/dbconnection.php');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $associations = [];
    $subjects = [];
    // $lecturedata = $_POST["TK01"];

    $subcnt = count($_POST);

    $lctrcnt = 0;

    $sublctrmap = [];

    foreach ($_POST as $subid => $lctcnt) {
        $lctrcnt = $lctrcnt + $lctcnt;
        $sublctrmap[$subid] = $lctcnt;
    }

    // echo json_encode($sublctrmap);
    // echo $sub1;

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
        $associations[$row['division']][$row['staffid']] = $row['subjectcode'];
    }

    // echo json_encode($associations);

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

    $lecidarr = [];

    for ($i = 1; $i <= $lctrcnt; $i++) {
        $lecidarr[$i - 1] = $i;
    }

    // shuffle($lecidarr);
    // echo $lecidarr[0];
    // echo json_encode($lecidarr);

    $divisions = ['A', 'B', 'C'];

    $divisioncnt = array(
        "A" => 1,
        "B" => 2,
        "C" => 3,
    );

    // Define the time slots for each day (5 days, 6 lectures per day)
    $time_slots = ['9:00 AM - 10:00 AM', '10:00 AM - 11:00 AM', '11:00 AM - 11:15 AM', '11:15 AM - 12:15 PM', '12:15 PM - 1:15 PM', '1:15 PM - 2:15 PM', '2:15 PM - 3:15 PM', '3:15 PM - 4:15 PM'];

    $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
    $slots_per_day = 8;

    // Create an empty timetable for each division
    $timetable = [];
    // $timetable = [];

    // foreach ($associations as $division => $divisionassoc) {
    //     shuffle($divisionassoc);
    //     $divsubltrmap = $sublctrmap;

    //     foreach ($divisionassoc as $divstaffid => $divsubid) {
    //         $divsublctrcnt = $divsubltrmap[$divsubid];

    //         for ($s = 0; $s < $divsublctrcnt; $s++) {
    //         }
    //     }

    //     // foreach($divsubltrmap as $subid => $lctcnt)
    //     // {

    //     // }
    // }

    // Initialize an empty array to track faculty schedules (faculty_name => [day => [slot => division]])
    // $faculty_schedule = [];

    // Initialize the empty timetable structure
    // foreach($divisions as $division)
    // {
    foreach ($days as $day) {
        for ($slot = 1; $slot <= $slots_per_day; $slot++) {
            $timetable[$day][$slot] = null; // Empty slot
        }
    }
    // }

    // Function to check if a slot is free for both division and faculty
    // function is_slot_free($timetable, $faculty_schedule, $faculty, $division, $day, $slot)
    // {
    //     // Check if the slot is free in the current division
    //     if ($timetable[$division][$day][$slot] !== null) {
    //         return false;
    //     }
    //     // Check if the faculty is free during this time in any division
    //     if (isset($faculty_schedule[$faculty][$day][$slot])) {
    //         return false;
    //     }
    //     return true;
    // }

    // echo json_encode($associations);

    // echo json_encode($associations);
    $extended_substaff = [];

    $mastercnt = 0;

    foreach ($associations as $division => $divdata) {
        $mastercnt = 0;
        foreach ($divdata as $divstaff => $divsub) {
            $divsublctrcnt = $sublctrmap[$divsub];

            while ($divsublctrcnt > 0) {
                $extended_substaff[$division][$mastercnt] = array(
                    "staff" => $divstaff,
                    "subject" => $divsub,
                );
                $divsublctrcnt = $divsublctrcnt - 1;
                $mastercnt++;
            }
        }
        shuffle($extended_substaff[$division]);
    }

    // shuffle($extended_substaff);
    // echo json_encode($extended_substaff);

    function generate_timetable_per_divisionv1($extended_substaff, &$timetable, $days, $slots_per_day, $divisioncnt, $divisions)
    {
        foreach ($extended_substaff as $division => $divlecturedata) {
            // shuffle($divdata);
            // echo json_encode($divdata);
            // foreach ($divdata as $divstaff => $divsub) {
            //     $divsublctrcnt = $sublctrmap[$divsub];
            // echo json_encode($divlecturedata);
            // echo "\n";
            foreach ($divlecturedata as $lecturedata) {
                // echo json_encode($lecturedata);
                // echo "\n";
                foreach ($days as $day) {
                    $subset = 0;
                    for ($slot = 1; $slot <= $slots_per_day; $slot++) {
                        if ($slot == 3) {
                            continue;
                        } else if ($slot == 6) {
                            continue;
                        } else if ($timetable[$day][$slot] != null && (count($timetable[$day][$slot]) == $divisioncnt[$division])) {
                            continue;
                        } else {
                            // if ($timetable[$day][$slot] == null && $division == "A") {
                            //     $timetable[$day][$slot][$lecturedata["staff"]] = $lecturedata["subject"];
                            //     $subset=1;
                            // } 
                            // else 
                            if ($timetable[$day][$slot] != null && count($timetable[$day][$slot]) == ($divisioncnt[$division] - 1) && $timetable[$day][$slot][$lecturedata["staff"]] == null) {

                                $timetable[$day][$slot][$lecturedata["staff"]] = $lecturedata["subject"];
                                $subset = 1;
                                // break;
                                // $divsublctrcnt = $divsublctrcnt - 1;
                            } else if ($timetable[$day][$slot][$lecturedata["staff"]] == null) {

                                $initcount = $timetable[$day][$slot]!=null?count($timetable[$day][$slot]):0;
                                for ($i = $initcount; $i < $divisioncnt[$division] - 1; $i++) {
                                    $timetable[$day][$slot][$day . $slot . "-Free-" . $divisions[$i]] = "Free";
                                }

                                $timetable[$day][$slot][$lecturedata["staff"]] = $lecturedata["subject"];
                                $subset = 1;
                            } else {
                                $timetable[$day][$slot][$slot . "-Free-" . $division] = "Free";
                            }
                        }
                        if ($subset == 1) {
                            break;
                        }
                    }
                    if ($subset == 1) {
                        break;
                    }
                }
                // foreach($days as $day)
                // {
                //     for ($slot = 1; $slot <= $slots_per_day; $slot++) {
                //         if ($slot == 3) {
                //             continue;
                //         } else if ($slot == 6) {
                //             continue;
                //         } else if ($timetable[$day][$slot] != null && (count($timetable[$day][$slot]) == $divisioncnt[$division])) {
                //             continue;
                //         } else {
                //             if ($timetable[$day][$slot][$divisioncnt[$division]-1] == null) {
                //                 $timetable[$day][$slot][$slot."-Free-".$division]= "Free";
                //             }
                //         }
                //     }
                // }
            }

            // }
        }
    }

    // function generate_timetable_per_divisionv0($associations, $sublctrmap, &$timetable, $days, $slots_per_day, $divisioncnt)
    // {
    //     foreach ($associations as $division => $divdata) {
    //         // shuffle($divdata);
    //         // echo json_encode($divdata);
    //         foreach ($divdata as $divstaff => $divsub) {
    //             $divsublctrcnt = $sublctrmap[$divsub];

    //             foreach ($days as $day) {
    //                 for ($slot = 1; $slot <= $slots_per_day; $slot++) {
    //                     if ($slot == 5) {
    //                         $timetable[$day][$slot]['Lunch Break'] = ['Free'];
    //                     } else if ($timetable[$day][$slot] != null && (count($timetable[$day][$slot]) == $divisioncnt[$division] || count($timetable[$day][$slot]) == $divisioncnt["C"])) {
    //                         continue;
    //                     } else {
    //                         if ($timetable[$day][$slot] == null && $division == "A") {
    //                             $timetable[$day][$slot][$divstaff] = $divsub;
    //                             $divsublctrcnt = $divsublctrcnt - 1;
    //                         } else if ($timetable[$day][$slot][$divstaff] == null) {
    //                             $timetable[$day][$slot][$divstaff] = $divsub;
    //                             $divsublctrcnt = $divsublctrcnt - 1;
    //                         }
    //                     }
    //                     if ($divsublctrcnt == 0) {
    //                         break;
    //                     }
    //                 }
    //                 if ($divsublctrcnt == 0) {
    //                     break;
    //                 }
    //             }
    //         }
    //     }
    // }

    // // Call the function to assign the subjects to divisions considering faculty
    // generate_timetable_per_divisionv0($associations, $sublctrmap, $timetable, $days, $slots_per_day, $divisioncnt);
    generate_timetable_per_divisionv1($extended_substaff,  $timetable, $days, $slots_per_day, $divisioncnt, $divisions);

    // echo json_encode($extended_substaff);
    // echo "\n";
    echo json_encode($timetable);
    // echo $timetable['C']==null;
    // Function to display the timetable for each division in an HTML table
    function display_timetable($timetable, $divisions, $days, $divisioncnt, $time_slots)
    {
        echo '<style>
        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        </style>';

        foreach ($divisions as $division) {
            echo "<h2>Timetable for Division $division</h2>";
            echo "<table>";
            echo "<tr><th>Time Slot</th>";
            foreach ($days as $day) {
                echo "<th>$day</th>";
            }
            echo "</tr>";

            // Loop through each time slot (1 to 6)
            for ($slot = 1; $slot <= 8; $slot++) {
                echo "<tr>";
                echo "<td>" . $time_slots[$slot - 1] . "</td>"; // Display slot number
                foreach ($days as $day) {
                    if ($slot == 3) {
                        echo "<td>Tea Break</td>";
                        continue;
                    }
                    if ($slot == 6) {
                        echo "<td>Lunch Break</td>";
                        continue;
                    }
                    if ($timetable[$day][$slot] == null) {
                        continue;
                    }
                    $slotfaculty = array_keys($timetable[$day][$slot]);
                    $subject = $timetable[$day][$slot][$slotfaculty[$divisioncnt[$division] - 1]] ?? 'Free';
                    echo "<td>" . $subject . "(" . $slotfaculty[$divisioncnt[$division] - 1] . ")</td>";
                }
                echo "</tr>";
            }

            echo "</table>";
        }
    }


    // Display the generated timetable for both divisions
    // display_timetable($timetable, $divisions, $days, $divisioncnt, $time_slots);
}
