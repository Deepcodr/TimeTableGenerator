<?php

session_start();
include('../includes/dbconnection.php');

if($_SERVER["REQUEST_METHOD"]=="POST")
{
    $name=$_REQUEST['fullname'];
    $phone=$_REQUEST['phone'];
    $email=$_REQUEST['email'];
    $password=$_REQUEST['password'];
    $staffId=$_REQUEST['staffID'];
    $qual = $_REQUEST['qualification'];
    $year=$_REQUEST['year'];

    try{
        $sql=mysqli_prepare($conn,"INSERT INTO staff(phone,emailId,password,name,staffId,qualification,year) VALUES (?,?,?,?,?,?,?)");
        $sql->bind_param("ssssssi",$phone,$email,$password,$name,$staffId,$qual,$year);
    }
    catch(Exception $e)
    {
        echo $e->getMessage();
        die;
    }

    $sql->execute();
    
    header("Location: http://localhost/TimeTableGenerator/addStaff.php");
    exit();
}
?>