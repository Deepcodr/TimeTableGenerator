<?php

session_start();
include('../includes/dbconnection.php');

if($_SERVER["REQUEST_METHOD"]=="POST")
{
    $name=$_REQUEST['fullname'];
    $phone=$_REQUEST['phone'];
    $email=$_REQUEST['email'];
    $password=$_REQUEST['password'];

    try{
        $sql=mysqli_prepare($conn,"INSERT INTO users(username,phone,email,password,name) VALUES (?,?,?,?,?)");
        $sql->bind_param("sssss",$email,$phone,$email,$password,$name);
    }
    catch(Exception $e)
    {
        echo $e->getMessage();
        die;
    }

    $sql->execute();
    
    if($conn->affected_rows===1)
    {
        $_SESSION['registerstatus']=1;
    }
    else
    {
        $_SESSION['registerstatus']=-1;
    }
    header("Location: http://localhost/TimeTableGenerator/login.php");
    exit();
}
else
{
    $_SESSION['registerstatus']=0;
    echo "NON SENSE";
}
?>