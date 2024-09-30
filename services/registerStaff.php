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

    try{
        $sql=mysqli_prepare($conn,"INSERT INTO staff(phone,emailId,password,name,staffId,qualification) VALUES (?,?,?,?,?,?)");
        $sql->bind_param("ssssss",$phone,$email,$password,$name,$staffId,$qual);
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