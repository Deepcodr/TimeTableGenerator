<?php

session_start();
include('../includes/dbconnection.php');

if($_SERVER["REQUEST_METHOD"]=="POST")
{
    $subname=$_REQUEST['subjectname'];
    $subcode=$_REQUEST['subjectcode'];
    $subtype=$_REQUEST['subtype'];
    $semester=$_REQUEST['semester'];
    $alloted=0;
    // $staffId=$_REQUEST['staffID'];
    // $qual = $_REQUEST['qualification'];

    try{
        $sql=mysqli_prepare($conn,"INSERT INTO subjects(subject_code,subject_name,course_type,semester,isalloted) VALUES (?,?,?,?,?)");
        $sql->bind_param("sssii",$subcode,$subname,$subtype,$semester,$alloted);
        $sql->execute();
    }
    catch(Exception $e)
    {
        echo $e->getMessage();
        // die;
    }

    
    header("Location: http://localhost/TimeTableGenerator/addSubjects.php");
    exit();
}
?>