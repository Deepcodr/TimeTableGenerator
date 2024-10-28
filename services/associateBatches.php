<?php

session_start();
include('../includes/dbconnection.php');

if($_SERVER["REQUEST_METHOD"]=="POST")
{
    $subcode=$_REQUEST['subject'];
    $staffid=$_REQUEST['staff'];
    $year=$_REQUEST['year'];
    $division=$_REQUEST['division'];
    $batchname= $_REQUEST['batch'];
    // $staffId=$_REQUEST['staffID'];
    // $qual = $_REQUEST['qualification'];

    $subjectname;

    try{
        $sql=mysqli_prepare($conn,"SELECT * FROM subjects WHERE subject_code=?");
        $sql->bind_param("s",$subcode);
        $sql->execute();

        $data = mysqli_fetch_assoc($sql->get_result());

        $subjectname = $data['subject_name'];

    }
    catch(Exception $e)
    {
        echo $e->getMessage();
        // die;
    }

    $staffname;

    try{
        $sql=mysqli_prepare($conn,"SELECT * FROM staff WHERE staffId=?");
        $sql->bind_param("s",$staffid);
        $sql->execute();

        $data = mysqli_fetch_assoc($sql->get_result());

        $staffname = $data['name'];
    }
    catch(Exception $e)
    {
        echo $e->getMessage();
        // die;
    }

    try{
        $sql=mysqli_prepare($conn,"INSERT INTO batch_associations(batchname ,division , staffid,staffname,subjectcode,subjectname,year) VALUES (?,?,?,?,?,?,?)");
        $sql->bind_param("ssssssi",$batchname,$division,$staffid,$staffname,$subcode,$subjectname,$year);
        $sql->execute();
    }
    catch(Exception $e)
    {
        echo $e->getMessage();
        // die;
    }
    
    header("Location: http://localhost/TimeTableGenerator/associateLabs.php");
    exit();
}
?>