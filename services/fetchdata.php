<?php
include('../includes/dbconnection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $semester = $_POST['year'];
    $data = $_POST['data'];
    
    // $type = $_POST['type'];
    // $division = $_POST['division'];

    if($data=="subjects")
    {
        $q = mysqli_query(
            $conn,
            "SELECT * FROM subjects where semester=$semester and subject_code!='OFF'"
        );

        $row_count = mysqli_num_rows($q);

        if ($row_count) {
            $subjects=[];

            while ($row = mysqli_fetch_assoc($q)) {
                $subjects[$row["subject_code"]]=$row;
            }
            echo json_encode($subjects);
        }else
        {
            echo json_encode([]);
        }

    }else if($data=="staff")
    {
        $q = mysqli_query(
            $conn,
            "SELECT * FROM staff"
        );

        $row_count = mysqli_num_rows($q);

        if ($row_count) {
            $staff=[];

            while ($row = mysqli_fetch_assoc($q)) {
                $staff[$row["staffId"]]=$row;
            }
            echo json_encode($staff);
        }else
        {
            echo json_encode([]);
        }

    }else if($data=="divisions")
    {
        $q = mysqli_query(
            mysqli_connect("localhost", "root", "root", "Dev"),
            "SELECT * FROM divisions where year=$semester"
        );
        $row_count = mysqli_num_rows($q);
        if ($row_count) {
            $mystring = '<option selected disabled>Select Division</option>';
            while ($row = mysqli_fetch_assoc($q)) {
                $mystring .= '<option value="' . $row['name'] . '">' . $row['name'] . '</option>';
            }
    
            echo $mystring;
        }
    }else if($data=="batches")
    {
        $q = mysqli_query(
            mysqli_connect("localhost", "root", "root", "Dev"),
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
    }
}
