<?php

session_start();
include('../includes/dbconnection.php');

if($_SERVER["REQUEST_METHOD"]=="POST")
{
    $name=$_REQUEST['fullname'];
    $phone=$_REQUEST['phone'];
    $email=$_REQUEST['email'];
    $password=$_REQUEST['password'];
    $year=$_REQUEST['year'];
    $division=$_REQUEST['division'];
    $prn=$_REQUEST['prn'];

    try{
        $sql=mysqli_prepare($conn,"INSERT INTO students(username,phone,email,password,name,PRN,year,division) VALUES (?,?,?,?,?,?,?,?)");
        $sql->bind_param("sssssiii",$email,$phone,$email,$password,$name,$prn,$year,$division);
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
    echo "Registration Failed";
}
?>