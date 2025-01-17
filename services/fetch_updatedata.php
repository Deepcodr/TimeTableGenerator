<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('../includes/dbconnection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $semester = isset($_POST['year']) != null ? $_POST['year'] : null;
    $data = isset($_POST['data']) != null ? $_POST['data'] : null;
    $type = isset($_POST['type']) != null ? $_POST['type'] : null;
    $query = isset($_POST['query']) != null ? $_POST['query'] : null;
    $division = isset($_POST['division']) != null ? $_POST['division'] : null;

    if ($data == "subjects") {
        $q = mysqli_query(
            $conn,
            "SELECT * FROM subjects where semester=$semester and course_type='$type'"
        );
        $row_count = mysqli_num_rows($q);
        if ($row_count) {
            $mystring = '<option selected disabled>Select Subject</option>';
            while ($row = mysqli_fetch_assoc($q)) {
                $mystring .= '<option value="' . $row['subject_code'] . '">' . "(" . $row['subject_code'] . ")  " . $row['subject_name'] . '</option>';
            }

            echo $mystring;
        } else {
            echo "<option selected disabled>No Data Found</option>";
        }
    } else if ($data == "divisions" && $type == "register") {
        $q = mysqli_query(
            $conn,
            "SELECT * FROM divisions where year=$semester"
        );
        $row_count = mysqli_num_rows($q);
        if ($row_count) {
            $mystring = '<option selected disabled>Select Division</option>';
            while ($row = mysqli_fetch_assoc($q)) {
                $mystring .= '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
            }

            echo $mystring;
        }else
        {
            echo "<option selected disabled>No Data Found</option>";
        }
    } else if ($data == "divisions") {
        $q = mysqli_query(
            $conn,
            "SELECT * FROM divisions where year=$semester"
        );
        $row_count = mysqli_num_rows($q);
        if ($row_count) {
            $mystring = '<option selected disabled>Select Division</option>';
            while ($row = mysqli_fetch_assoc($q)) {
                $mystring .= '<option value="' . $row['name'] . '">' . $row['name'] . '</option>';
            }

            echo $mystring;
        } else {
            echo "<option selected disabled>No Data Found</option>";
        }
    } else if ($data == "batches") {
        $q = mysqli_query(
            $conn,
            "SELECT * FROM batches where year=$semester and division='$division'"
        );
        $row_count = mysqli_num_rows($q);
        if ($row_count) {
            $mystring = '<option selected disabled>Select Batch</option>';
            while ($row = mysqli_fetch_assoc($q)) {
                $mystring .= '<option value="' . $row['name'] . '">' . $row['name'] . '</option>';
            }

            echo $mystring;
        }
    } else if ($data == "lecturecnt") {
        $q = mysqli_query(
            $conn,
            "SELECT status FROM timetable_status where year=$semester"
        );

        $row_count = mysqli_num_rows($q);

        if ($row_count) {
            $row = mysqli_fetch_assoc($q);

            if ($row['status'] == 1) {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert" data-bs-delay={>
                       Timetable Already Exist For This Year
                       <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <button class="btn btn-primary btn-block" onclick="modifytt(' . $semester . ')" type="button"><i class="fas fa-user-plus"></i>Delete & Create New</button>
                        <button class="btn btn-primary btn-block" onclick="viewtt(' . $semester . ')" type="button"><i class="fas fa-user-plus"></i>View Existing Timetable</button>';
            } else {
                $q = mysqli_query(
                    $conn,
                    "SELECT * FROM subjects where semester=$semester and subject_code!='OFF'"
                );
                $row_count = mysqli_num_rows($q);
                if ($row_count) {

                    $mystring = "<form id='lecturecntform' class='form-signup'>
                            <table>
                                <tbody>";
                    while ($row = mysqli_fetch_assoc($q)) {
                        // $mystring .= '<option value="' . $row['name'] . '">' . $row['name'] . '</option>';
                        $mystring .= "<tr>
                                        <td>" . $row['subject_name'] . "</td>
                                        <td>
                                            <div class='m-2'>
                                            <input type='number' class='form-control' name='" . $row['subject_code'] . "' placeholder='Enter lecture count'></input>
                                            </div>
                                        </td>
                                    </tr>";
                    }

                    $mystring = $mystring . '</tbody>
                                    </table>
                                    <button id="ttgeneratebtn" class="btn btn-primary btn-block" onclick="generatett()" type="button">Generate</button>
                                    <button id="ttsavebtn" class="btn btn-primary btn-block" disabled onclick="savett()" type="button">Save Current Timetable</button>
                                    </form>';

                    echo $mystring;
                } else {
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" data-bs-delay={>
                   No Subject Data Found For This Year
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                 </div>';
                }
            }
        } else {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" data-bs-delay={>
            Failed To Fetch Data
         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
    } else if ($data == "timetable" && $type == "delete") {
        try {
            $status = 0;
            $sql = mysqli_prepare($conn, "UPDATE timetable_status SET status=? WHERE year=?");
            $sql->bind_param("ii", $status, $semester);
            $sql->execute();

            try {
                $sql = mysqli_prepare($conn, "DELETE from timetables where year=?");
                $sql->bind_param("i", $semester);
                $sql->execute();

                $q = mysqli_query(
                    $conn,
                    "SELECT * FROM subjects where semester=$semester and subject_code!='OFF'"
                );

                $row_count = mysqli_num_rows($q);

                if ($row_count) {

                    $mystring = "<form id='lecturecntform' class='form-signup'>
                            <table>
                                <tbody>";
                    while ($row = mysqli_fetch_assoc($q)) {
                        // $mystring .= '<option value="' . $row['name'] . '">' . $row['name'] . '</option>';
                        $mystring .= "<tr>
                                        <td>" . $row['subject_name'] . "</td>
                                        <td>
                                            <div class='m-2'>
                                            <input type='number' class='form-control' name='" . $row['subject_code'] . "' placeholder='Enter lecture count'></input>
                                            </div>
                                        </td>
                                    </tr>";
                    }

                    $mystring = $mystring . '</tbody>
                                    </table>
                                    <button id="ttgeneratebtn" class="btn btn-primary btn-block" onclick="generatett()" type="button">Generate</button>
                                    <button id="ttsavebtn" class="btn btn-primary btn-block" disabled onclick="savett()" type="button">Save Current Timetable</button>
                                    </form>';

                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert" data-bs-delay={>
                   Timetable Deleted Successfully
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                 </div>' . $mystring;
                } else {
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" data-bs-delay={>
                   No Subject Data Found For This Year
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                 </div>';
                }
            } catch (Exception $e) {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" data-bs-delay={>
                    Error Occured While Deleting Timetable
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                 </div>
                 <button class="btn btn-primary btn-block" onclick="modifytt(' . $semester . ')" type="button"><i class="fas fa-user-plus"></i>Delete & Create New</button>
                 <button class="btn btn-primary btn-block" onclick="viewtt(' . $semester . ')" type="button"><i class="fas fa-user-plus"></i>View Existing Timetable</button>';
            }
        } catch (Exception $e) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" data-bs-delay={>
                       Error Occured While Deleting Timetable
                       <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <button class="btn btn-primary btn-block" onclick="modifytt(' . $semester . ')" type="button"><i class="fas fa-user-plus"></i>Delete & Create New</button>
                        <button class="btn btn-primary btn-block" onclick="viewtt(' . $semester . ')" type="button"><i class="fas fa-user-plus"></i>View Existing Timetable</button>';
        }
    } else if ($data == "timetable" && $type == "alltt") {
        $q = mysqli_query(
            $conn,
            "SELECT * FROM timetables where year=$semester group by timeslot,day,batch,division"
        );
        $row_count = mysqli_num_rows($q);

        $q1 = mysqli_query(
            $conn,
            "SELECT * FROM divisions where year=$semester"
        );

        $rc2 = mysqli_num_rows($q1);

        $divisions = [];

        if ($rc2) {
            while ($row = mysqli_fetch_assoc($q1)) {
                array_push($divisions, $row['name']);
            }
        }

        $q2 = mysqli_query(
            $conn,
            "SELECT * FROM subjects where semester=$semester"
        );

        $rc3 = mysqli_num_rows($q2);

        $subjects = [];

        if ($rc3) {
            while ($row = mysqli_fetch_assoc($q2)) {
                $subjects[$row['subject_code']] = $row['subject_alias'];
            }
        }

        $q4 = mysqli_query(
            $conn,
            "SELECT * FROM staff where year=$semester"
        );

        $rc4 = mysqli_num_rows($q4);

        $staff = [];

        if ($rc4) {
            while ($row = mysqli_fetch_assoc($q4)) {
                $staff[$row['staffId']] = $row['name'];
            }
        }

        if ($row_count) {
            $mystring = '';

            $timetable = [];

            $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
            $slots_per_day = 8;

            foreach ($divisions as $division) {
                foreach ($days as $day) {
                    for ($slot = 1; $slot <= $slots_per_day; $slot++) {
                        $timetable[$division][$day][$slot] = []; // Empty slot
                    }
                }
            }

            while ($row = mysqli_fetch_assoc($q)) {
                if (is_null($row['batch'])) {
                    $timetable[$row['division']][$row['day']][$row['timeslot']][$staff[$row['staff']]] = $subjects[$row['subject']];
                } else {
                    $timetable[$row['division']][$row['day']][$row['timeslot']][$row['batch']] = [];
                    $timetable[$row['division']][$row['day']][$row['timeslot']][$row['batch']][$staff[$row['staff']]] = $subjects[$row['subject']];
                }
                // $timetable[$row['division']][$row['day']][$row['timeslot']]
                // $mystring = '<div>'.$row['year'].' '.$row['division'].' '.$row['day'].' '.$row['timeslot'].' '.$row['batch'].' '.$row['subject'].' '.$row['staff'].'</div><br>';
                // echo $mystring;
            }

            echo json_encode($timetable);
            // echo $mystring;
        }
    } else if ($data == "timetable" && $type == "staff") {
        $q = mysqli_query(
            $conn,
            "SELECT * FROM timetables where year=$semester and division 
            IN (SELECT DISTINCT division from associations WHERE staffId='$query'
                UNION
                SELECT DISTINCT division from batch_associations WHERE staffId='$query') 
            group by timeslot,day,batch,division"
        );
        $row_count = mysqli_num_rows($q);

        $q1 = mysqli_query(
            $conn,
            "SELECT DISTINCT division from associations WHERE staffId='$query'
            UNION
            SELECT DISTINCT division from batch_associations WHERE staffId='$query'"
        );

        $rc2 = mysqli_num_rows($q1);

        $divisions = [];

        if ($rc2) {
            while ($row = mysqli_fetch_assoc($q1)) {
                array_push($divisions, $row['division']);
            }
        }

        $q2 = mysqli_query(
            $conn,
            "SELECT * FROM subjects where semester=$semester"
        );

        $rc3 = mysqli_num_rows($q2);

        $subjects = [];

        if ($rc3) {
            while ($row = mysqli_fetch_assoc($q2)) {
                $subjects[$row['subject_code']] = $row['subject_alias'];
            }
        }

        $q4 = mysqli_query(
            $conn,
            "SELECT * FROM staff where year=$semester"
        );

        $rc4 = mysqli_num_rows($q4);

        $staff = [];

        if ($rc4) {
            while ($row = mysqli_fetch_assoc($q4)) {
                $staff[$row['staffId']] = $row['name'];
            }
        }

        if ($row_count) {
            $mystring = '';

            $timetable = [];

            $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
            $slots_per_day = 8;

            foreach ($divisions as $division) {
                foreach ($days as $day) {
                    for ($slot = 1; $slot <= $slots_per_day; $slot++) {
                        $timetable[$division][$day][$slot] = []; // Empty slot
                    }
                }
            }

            while ($row = mysqli_fetch_assoc($q)) {
                if (is_null($row['batch'])) {
                    $timetable[$row['division']][$row['day']][$row['timeslot']][$staff[$row['staff']]] = $subjects[$row['subject']];
                } else {
                    $timetable[$row['division']][$row['day']][$row['timeslot']][$row['batch']] = [];
                    $timetable[$row['division']][$row['day']][$row['timeslot']][$row['batch']][$staff[$row['staff']]] = $subjects[$row['subject']];
                }
                // $timetable[$row['division']][$row['day']][$row['timeslot']]
                // $mystring = '<div>'.$row['year'].' '.$row['division'].' '.$row['day'].' '.$row['timeslot'].' '.$row['batch'].' '.$row['subject'].' '.$row['staff'].'</div><br>';
                // echo $mystring;
            }

            echo json_encode($timetable);
            // echo $mystring;
        }
    } else if ($data == "timetable") {
        $q = mysqli_query(
            $conn,
            "SELECT * FROM timetables where year=$semester group by timeslot,day,batch,division"
        );
        $row_count = mysqli_num_rows($q);

        $q1 = mysqli_query(
            $conn,
            "SELECT * FROM divisions where year=$semester"
        );

        $rc2 = mysqli_num_rows($q1);

        $divisions = [];

        if ($rc2) {
            while ($row = mysqli_fetch_assoc($q1)) {
                array_push($divisions, $row['name']);
            }
        }

        $q2 = mysqli_query(
            $conn,
            "SELECT * FROM subjects where semester=$semester"
        );

        $rc3 = mysqli_num_rows($q2);

        $subjects = [];

        if ($rc3) {
            while ($row = mysqli_fetch_assoc($q2)) {
                $subjects[$row['subject_code']] = $row['subject_alias'];
            }
        }

        $q4 = mysqli_query(
            $conn,
            "SELECT * FROM staff where year=$semester"
        );

        $rc4 = mysqli_num_rows($q4);

        $staff = [];

        if ($rc4) {
            while ($row = mysqli_fetch_assoc($q4)) {
                $staff[$row['staffId']] = $row['name'];
            }
        }

        if ($row_count) {
            $mystring = '';

            $timetable = [];

            $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
            $slots_per_day = 8;

            foreach ($divisions as $division) {
                foreach ($days as $day) {
                    for ($slot = 1; $slot <= $slots_per_day; $slot++) {
                        $timetable[$division][$day][$slot] = []; // Empty slot
                    }
                }
            }

            while ($row = mysqli_fetch_assoc($q)) {
                if (is_null($row['batch'])) {
                    $timetable[$row['division']][$row['day']][$row['timeslot']][$staff[$row['staff']]] = $subjects[$row['subject']];
                } else {
                    $timetable[$row['division']][$row['day']][$row['timeslot']][$row['batch']] = [];
                    $timetable[$row['division']][$row['day']][$row['timeslot']][$row['batch']][$staff[$row['staff']]] = $subjects[$row['subject']];
                }
                // $timetable[$row['division']][$row['day']][$row['timeslot']]
                // $mystring = '<div>'.$row['year'].' '.$row['division'].' '.$row['day'].' '.$row['timeslot'].' '.$row['batch'].' '.$row['subject'].' '.$row['staff'].'</div><br>';
                // echo $mystring;
            }

            echo json_encode($timetable);
            // echo $mystring;
        }
    }
}
