<?php

session_start();
include('../includes/dbconnection.php');

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $query = $_REQUEST['query'];

    if ($query == "batchassoc") {
        $batchassocid = $_REQUEST['batchassocid'];

        try {
            $sql = mysqli_prepare($conn, "DELETE FROM batch_associations WHERE id=?");
            $sql->bind_param("s", $batchassocid);
            $sql->execute();

            header("Location: http://localhost/TimeTableGenerator/associateLabs.php");
            exit();
        } catch (Exception $e) {
            echo $e->getMessage();
            // die;
        }
    }else if($query=="staffassoc")
    {
        $staffassocid = $_REQUEST['staffassocid'];

        try {
            $sql = mysqli_prepare($conn, "DELETE FROM associations WHERE id=?");
            $sql->bind_param("s", $staffassocid);
            $sql->execute();

            header("Location: http://localhost/TimeTableGenerator/associate.php");
            exit();
        } catch (Exception $e) {
            echo $e->getMessage();
            // die;
        }
    }else if($query=="staff")
    {
        $staffid = $_REQUEST['staffid'];

        try {
            $sql = mysqli_prepare($conn, "DELETE FROM staff WHERE staffId=?");
            $sql->bind_param("s", $staffid);
            $sql->execute();

            header("Location: http://localhost/TimeTableGenerator/addStaff.php");
            exit();
        } catch (Exception $e) {
            echo $e->getMessage();
            // die;
        }
    }else if($query=="division")
    {
        $divisionid = $_REQUEST['divisionid'];

        try {
            $sql = mysqli_prepare($conn, "DELETE FROM divisions WHERE id=?");
            $sql->bind_param("s", $divisionid);
            $sql->execute();

            header("Location: http://localhost/TimeTableGenerator/addDivisions.php");
            exit();
        } catch (Exception $e) {
            echo $e->getMessage();
            // die;
        }
    }else if($query=="batch")
    {
        $batchid = $_REQUEST['batchid'];

        try {
            $sql = mysqli_prepare($conn, "DELETE FROM batches WHERE id=?");
            $sql->bind_param("s", $batchid);
            $sql->execute();

            header("Location: http://localhost/TimeTableGenerator/addBatches.php");
            exit();
        } catch (Exception $e) {
            echo $e->getMessage();
            // die;
        }
    }else if($query=="subject")
    {
        $subcode = $_REQUEST['subcode'];

        try {
            $sql = mysqli_prepare($conn, "DELETE FROM subjects WHERE subject_code=?");
            $sql->bind_param("s", $subcode);
            $sql->execute();

            header("Location: http://localhost/TimeTableGenerator/addSubjects.php");
            exit();
        } catch (Exception $e) {
            echo $e->getMessage();
            // die;
        }
    }
    // $subcode=$_REQUEST[''];
    // $staffid=$_REQUEST['staff'];
    // $year=$_REQUEST['year'];
    // $division=$_REQUEST['division'];
    // $batchname= $_REQUEST['batch'];
    // $staffId=$_REQUEST['staffID'];
    // $qual = $_REQUEST['qualification'];

    // $subjectname;

    // try{
    //     $sql=mysqli_prepare($conn,"SELECT * FROM subjects WHERE subject_code=?");
    //     $sql->bind_param("s",$subcode);
    //     $sql->execute();

    //     $data = mysqli_fetch_assoc($sql->get_result());

    //     $subjectname = $data['subject_name'];

    // }
    // catch(Exception $e)
    // {
    //     echo $e->getMessage();
    //     // die;
    // }

    // $staffname;

    // try{
    //     $sql=mysqli_prepare($conn,"SELECT * FROM staff WHERE staffId=?");
    //     $sql->bind_param("s",$staffid);
    //     $sql->execute();

    //     $data = mysqli_fetch_assoc($sql->get_result());

    //     $staffname = $data['name'];
    // }
    // catch(Exception $e)
    // {
    //     echo $e->getMessage();
    //     // die;
    // }

    // try{
    //     $sql=mysqli_prepare($conn,"INSERT INTO batch_associations(batchname ,division , staffid,staffname,subjectcode,subjectname,year) VALUES (?,?,?,?,?,?,?)");
    //     $sql->bind_param("ssssssi",$batchname,$division,$staffid,$staffname,$subcode,$subjectname,$year);
    //     $sql->execute();
    // }
    // catch(Exception $e)
    // {
    //     echo $e->getMessage();
    //     // die;
    // }

    // header("Location: http://localhost/TimeTableGenerator/associateLabs.php");
    // exit();
}
