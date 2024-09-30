<?php
include('../includes/dbconnection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $semester = $_POST['year'];
    $data = $_POST['data'];

    if($data=="subjects")
    {
        $q = mysqli_query(
            mysqli_connect("localhost", "root", "root", "Dev"),
            "SELECT * FROM subjects where semester=$semester"
        );
        $row_count = mysqli_num_rows($q);
        if ($row_count) {
            $mystring = '<option selected disabled>Select Subject</option>';
            while ($row = mysqli_fetch_assoc($q)) {
                $mystring .= '<option value="' . $row['subject_code'] . '">' . "(" . $row['subject_code'] . ")  " . $row['subject_name'] . '</option>';
            }
    
            echo $mystring;
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
    }
}
