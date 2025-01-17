<?php
include('../includes/dbconnection.php');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $associations = [];
    $subjects = [];
    // $lecturedata = $_POST["TK01"];

    $subcnt = count($_POST);

    $lctrcnt = 0;

    $sublctrmap = [];

    // $postsubjects = [
    //     "TK04" => "3",
    //     "TK05" => "4",
    //     "TK06" => "3",
    //     "TK07" => "2",
    //     "TK08" => "3",
    //     "TK02" => "3",
    //     "TK01" => "2",
    //     "TK09" => "2",
    //     "TK10" => "1",
    //     "TK11" => "1",
    //     "TK12" => "1"
    // ];

    foreach ($_POST as $subid => $lctcnt) {
        $lctrcnt = $lctrcnt + $lctcnt;
        $sublctrmap[$subid] = $lctcnt;
    }

    // echo json_encode($sublctrmap);
    // die();
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

    try {
        $year = 2;
        $sql = mysqli_prepare($conn, "SELECT * FROM batch_associations WHERE year=? ORDER BY batchname");
        $sql->bind_param("i", $year);
    } catch (Exception $e) {
        echo $e->getMessage();
        // die;
    }

    $sql->execute();
    $data = $sql->get_result();

    $labs = [];

    while ($row = mysqli_fetch_assoc($data)) {
        $labs[$row['division']][$row['batchname']][$row['subjectcode']] = $row['staffid'];
    }

    // echo json_encode($labs);
    // die();

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

    $extended_labsubstaff = [];

    foreach ($labs as $division => $batches) {
        foreach ($batches as $batch => $batchdata) {
            $mastercnt = 0;
            foreach ($batchdata as $labsub => $labstaff) {
                $lablctrcnt = $sublctrmap[$labsub];

                while ($lablctrcnt > 0) {
                    $extended_labsubstaff[$division][$batch][$mastercnt] = array(
                        "staff" => $labstaff,
                        "subject" => $labsub,
                    );
                    $lablctrcnt = $lablctrcnt - 1;
                    $mastercnt++;
                }
            }
            shuffle($extended_labsubstaff[$division][$batch]);
        }
    }

    // shuffle($extended_substaff);
    // echo json_encode($extended_labsubstaff);
    // die();

    //generate Lab slots.

    // $slots = range(1, 18);

    // // Shuffle the array to randomize the numbers
    // shuffle($slots);

    // // Split the array into three chunks of 6 slots each
    // $divisionLabSlots = array_chunk($slots, 6);

    // // Assign the chunks to divisions
    // $labslots = [
    //     'A' => $divisionLabSlots[0],
    //     'B' => $divisionLabSlots[1],
    //     'C' => $divisionLabSlots[2]
    // ];

    // $labslots = [
    //     "A" => [1, 5, 9, 10, 14, 16],
    //     "B" => [2, 7, 11, 15, 16, 17],
    //     "C" => [4, 8, 12, 13, 16, 17]
    // ];

    // $labslots = [
    //     "A" => [5, 14, 8, 12, 9, 16],
    //     "B" => [3, 15, 10, 1, 6, 18],
    //     "C" => [17, 2, 7, 11, 13, 4]
    // ];

    $labslots = [
        'Monday' => [
            1 => 'B',
            4 => 'C',
            7 => 'B',
        ],
        'Tuesday' => [
            1 => 'C',
            4 => 'A',
            7 => 'B',
        ],
        'Wednesday' => [
            1 => 'C',
            4 => 'A',
            7 => 'A',
        ],
        'Thursday' => [
            1 => 'B',
            4 => 'C',
            7 => 'A',
        ],
        'Friday' => [
            1 => 'C',
            4 => 'A',
            7 => 'B',
        ],
        'Saturday' => [
            1 => 'A',
            4 => 'C',
            7 => 'B'
        ],
    ];

    $batchlabcnt = array(
        "A1" => 1,
        "A2" => 2,
        "A3" => 3,
        "A4" => 4,
        "B1" => 1,
        "B2" => 2,
        "B3" => 3,
        "B4" => 4,
        "C1" => 1,
        "C2" => 2,
        "C3" => 3,
        "C4" => 4,
    );

    // echo json_encode($extended_labsubstaff);
    // die();

    // $batchesdata = [
    //     "A1" => [
    //         ["staff" => "T05", "subject" => "TK12"],
    //         ["staff" => "T01", "subject" => "TK09"],
    //         ["staff" => "T02", "subject" => "TK10"],
    //         ["staff" => "T04", "subject" => "TK11"],
    //         ["staff" => "T01", "subject" => "TK09"],
    //     ],
    //     "A2" => [
    //         ["staff" => "T02", "subject" => "TK10"],
    //         ["staff" => "T14", "subject" => "TK12"],
    //         ["staff" => "T04", "subject" => "TK11"],
    //         ["staff" => "T15", "subject" => "TK09"],
    //         ["staff" => "T15", "subject" => "TK09"]
    //     ],
    //     "A3" => [
    //         ["staff" => "T02", "subject" => "TK10"],
    //         ["staff" => "T05", "subject" => "TK12"],
    //         ["staff" => "T05", "subject" => "TK09"],
    //         ["staff" => "T05", "subject" => "TK09"],
    //         ["staff" => "T04", "subject" => "TK11"],
    //     ],
    //     "A4" => [
    //         ["staff" => "T14", "subject" => "TK09"],
    //         ["staff" => "T05", "subject" => "TK12"],
    //         ["staff" => "T14", "subject" => "TK09"],
    //         ["staff" => "T04", "subject" => "TK11"],
    //         ["staff" => "T02", "subject" => "TK10"],
    //     ],
    // ];

    // function groupBatches($batches) {
    //     $groups = [];
    //     $currentGroup = [];
    //     $staffUsed = [];

    //     foreach ($batches as $batch) {
    //         if (count($currentGroup) < 4) {
    //             $conflict = false;
    //             foreach ($batch as $assignment) {
    //                 if (in_array($assignment['staff'], $staffUsed)) {
    //                     $conflict = true;
    //                     break;
    //                 }
    //             }
    //             if (!$conflict) {
    //                 $currentGroup[] = $batch;
    //                 foreach ($batch as $assignment) {
    //                     $staffUsed[] = $assignment['staff'];
    //                 }
    //             }
    //         } else {
    //             $groups[] = $currentGroup;
    //             $currentGroup = [$batch];
    //             $staffUsed = array_map(function($assignment) {
    //                 return $assignment['staff'];
    //             }, $batch);
    //         }
    //     }

    //     if (!empty($currentGroup)) {
    //         $groups[] = $currentGroup;
    //     }

    //     return $groups;
    // }

    // // Generate groups
    // // $groups = generateMultipleGroups($extended_labsubstaff);
    // $groups = groupBatches($batchdata);

    // echo json_encode($groups);
    // die();

    function generate_timetable_per_batchv0($extended_labsubstaff, &$timetable, $days, $slots_per_day, $divisioncnt, $divisions, $labslots, $batchlabcnt)
    {
        ksort($extended_labsubstaff);

        foreach ($extended_labsubstaff as $division => $divisionbatches) {
            foreach ($divisionbatches as $batch => $batchdata) {
                // $f=1;
                // echo $batch;
                foreach ($batchdata as $labrow) {
                    // echo "\n";
                    // echo json_encode($labrow);
                    $labset = 0;
                    foreach ($days as $day) {

                        for ($slot = 1; $slot <= $slots_per_day; $slot++) {
                            if ($slot == 3 || $slot == 6) {
                                continue;
                            } else if ($labslots[$day][$slot] == $division) {
                                // || $timetable[$day][$slot]["LAB"]==$division
                                // echo $labrow["staff"];
                                if (is_string($timetable[$day][$slot]["LAB"])) {
                                    $timetable[$day][$slot]["LAB"] = [];
                                }
                                // else if(count($timetable[$day][$slot]["LAB"])1)
                                // {

                                // }
                                // echo $timetable[$day][$slot]["LAB"][$labrow["staff"]];
                                if ($timetable[$day][$slot][$labrow["staff"]] == null && $timetable[$day][$slot + 1][$labrow["staff"]] == null && $timetable[$day][$slot]["LAB"][$labrow["staff"]] == null && count($timetable[$day][$slot]["LAB"]) < $batchlabcnt[$batch]) {
                                    $timetable[$day][$slot]["LAB"][$labrow["staff"]] = $labrow["subject"];
                                    $labset = 1;
                                }
                            }
                            if ($labset == 1) {
                                break;
                            }
                        }
                        if ($labset == 1) {
                            break;
                        }
                    }
                    // if ($labset == 0) {
                    //     echo "Exception";
                    //     die();
                    // }
                }

                foreach ($days as $day) {
                    for ($slot = 1; $slot <= $slots_per_day; $slot++) {
                        if ($slot == 3 || $slot == 6) {
                            continue;
                        } else if ($labslots[$day][$slot] == $division) {

                            if (is_string($timetable[$day][$slot]["LAB"])) {
                                $timetable[$day][$slot]["LAB"] = [];
                            }

                            if (count($timetable[$day][$slot]["LAB"]) < $batchlabcnt[$batch]) {
                                $timetable[$day][$slot]["LAB"][$batch] = "OFF";
                            }
                        }
                    }
                }
            }
        }
    }

    function generate_timetable_per_divisionv2($extended_substaff, $extended_labsubstaff, &$timetable, $days, $slots_per_day, $divisioncnt, $divisions, $labslots)
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
                $subset = 0;
                foreach ($days as $day) {
                    for ($slot = 1; $slot <= $slots_per_day; $slot++) {
                        if ($slot == 3 || $slot == 6) {
                            continue;
                        } else if ($timetable[$day][$slot] != null && (count($timetable[$day][$slot]) == $divisioncnt[$division])) {
                            continue;
                        } else {

                            if ($labslots[$day][$slot] == $division || $labslots[$day][$slot - 1] == $division) {
                                // $initcount = $timetable[$day][$slot]!=null?count($timetable[$day][$slot]):0;
                                // for ($i = $initcount; $i < $divisioncnt[$division] - 1; $i++) {
                                //     $timetable[$day][$slot]["Lab-" . $divisions[$i]] = "Free";
                                // }
                                $timetable[$day][$slot]['LAB'] = $division;
                            }
                            // if ($timetable[$day][$slot] == null && $division == "A") {
                            //     $timetable[$day][$slot][$lecturedata["staff"]] = $lecturedata["subject"];
                            //     $subset=1;
                            // } 
                            // else 
                            else if ($timetable[$day][$slot] != null && count($timetable[$day][$slot]) == ($divisioncnt[$division] - 1) && $timetable[$day][$slot][$lecturedata["staff"]] == null) {

                                $timetable[$day][$slot][$lecturedata["staff"]] = $lecturedata["subject"];
                                $subset = 1;
                                // break;
                                // $divsublctrcnt = $divsublctrcnt - 1;
                            } else if ($timetable[$day][$slot][$lecturedata["staff"]] == null) {

                                // $initcount = $timetable[$day][$slot]!=null?count($timetable[$day][$slot]):0;
                                // for ($i = $initcount; $i < $divisioncnt[$division] - 1; $i++) {
                                //     $timetable[$day][$slot]["Free-" . $divisions[$i]] = "Free";
                                // }

                                $timetable[$day][$slot][$lecturedata["staff"]] = $lecturedata["subject"];
                                $subset = 1;
                            } else {
                                $timetable[$day][$slot]["Free-" . $division] = "Free";
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
                // if ($subset == 0) {
                //     echo "Exception";
                //     die();
                // }
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

            foreach ($days as $day) {
                for ($slot = 1; $slot <= $slots_per_day; $slot++) {
                    if ($slot == 3) {
                        continue;
                    } else if ($slot == 6) {
                        continue;
                    } else if ($timetable[$day][$slot] != null && (count($timetable[$day][$slot]) == $divisioncnt[$division])) {
                        continue;
                    } else {
                        if ($labslots[$day][$slot] == $division || $labslots[$day][$slot - 1] == $division) {
                            // $initcount = $timetable[$day][$slot]!=null?count($timetable[$day][$slot]):0;
                            // for ($i = $initcount; $i < $divisioncnt[$division] - 1; $i++) {
                            $timetable[$day][$slot]["LAB"] = $division;
                            // }
                            // $timetable[$day][$slot]['LAB']=$division;
                        } else {
                            // $initcount = $timetable[$day][$slot]!=null?count($timetable[$day][$slot]):0;
                            // for ($i = $initcount; $i < $divisioncnt[$division] - 1; $i++) {
                            $timetable[$day][$slot]["Free-" . $division] = "Free";
                            // }
                            // $timetable[$day][$slot]['Free']=$division;
                        }
                    }
                }
            }
            // echo json_encode($timetable);
            // echo "\n\n";
            // }
        }
    }

    // function generate_timetable_per_divisionv1($extended_substaff, &$timetable, $days, $slots_per_day, $divisioncnt, $divisions)
    // {
    //     foreach ($extended_substaff as $division => $divlecturedata) {
    //         // shuffle($divdata);
    //         // echo json_encode($divdata);
    //         // foreach ($divdata as $divstaff => $divsub) {
    //         //     $divsublctrcnt = $sublctrmap[$divsub];
    //         // echo json_encode($divlecturedata);
    //         // echo "\n";
    //         foreach ($divlecturedata as $lecturedata) {
    //             // echo json_encode($lecturedata);
    //             // echo "\n";
    //             foreach ($days as $day) {
    //                 $subset = 0;
    //                 for ($slot = 1; $slot <= $slots_per_day; $slot++) {
    //                     if ($slot == 3) {
    //                         continue;
    //                     } else if ($slot == 6) {
    //                         continue;
    //                     } else if ($timetable[$day][$slot] != null && (count($timetable[$day][$slot]) == $divisioncnt[$division])) {
    //                         continue;
    //                     } else {
    //                         // if ($timetable[$day][$slot] == null && $division == "A") {
    //                         //     $timetable[$day][$slot][$lecturedata["staff"]] = $lecturedata["subject"];
    //                         //     $subset=1;
    //                         // } 
    //                         // else 
    //                         if ($timetable[$day][$slot] != null && count($timetable[$day][$slot]) == ($divisioncnt[$division] - 1) && $timetable[$day][$slot][$lecturedata["staff"]] == null) {

    //                             $timetable[$day][$slot][$lecturedata["staff"]] = $lecturedata["subject"];
    //                             $subset = 1;
    //                             // break;
    //                             // $divsublctrcnt = $divsublctrcnt - 1;
    //                         } else if ($timetable[$day][$slot][$lecturedata["staff"]] == null) {

    //                             $initcount = $timetable[$day][$slot]!=null?count($timetable[$day][$slot]):0;
    //                             for ($i = $initcount; $i < $divisioncnt[$division] - 1; $i++) {
    //                                 $timetable[$day][$slot][$day . $slot . "-Free-" . $divisions[$i]] = "Free";
    //                             }

    //                             $timetable[$day][$slot][$lecturedata["staff"]] = $lecturedata["subject"];
    //                             $subset = 1;
    //                         } else {
    //                             $timetable[$day][$slot][$slot . "-Free-" . $division] = "Free";
    //                         }
    //                     }
    //                     if ($subset == 1) {
    //                         break;
    //                     }
    //                 }
    //                 if ($subset == 1) {
    //                     break;
    //                 }
    //             }
    //             // foreach($days as $day)
    //             // {
    //             //     for ($slot = 1; $slot <= $slots_per_day; $slot++) {
    //             //         if ($slot == 3) {
    //             //             continue;
    //             //         } else if ($slot == 6) {
    //             //             continue;
    //             //         } else if ($timetable[$day][$slot] != null && (count($timetable[$day][$slot]) == $divisioncnt[$division])) {
    //             //             continue;
    //             //         } else {
    //             //             if ($timetable[$day][$slot][$divisioncnt[$division]-1] == null) {
    //             //                 $timetable[$day][$slot][$slot."-Free-".$division]= "Free";
    //             //             }
    //             //         }
    //             //     }
    //             // }
    //         }

    //         // }
    //     }
    // }

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
    // generate_timetable_per_divisionv1($extended_substaff,  $timetable, $days, $slots_per_day, $divisioncnt, $divisions);
    generate_timetable_per_divisionv2($extended_substaff, $extended_labsubstaff, $timetable, $days, $slots_per_day, $divisioncnt, $divisions, $labslots);
    generate_timetable_per_batchv0($extended_labsubstaff, $timetable, $days, $slots_per_day, $divisioncnt, $divisions, $labslots, $batchlabcnt);
    // echo json_encode($extended_substaff);

    echo json_encode($timetable);

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
