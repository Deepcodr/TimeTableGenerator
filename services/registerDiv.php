<?php

session_start();
include('../includes/dbconnection.php');

if($_SERVER["REQUEST_METHOD"]=="POST")
{
    $name=$_REQUEST['division'];
    $year=$_REQUEST['year'];
    

    try{
        $sql=mysqli_prepare($conn,"INSERT INTO divisions(name,year) VALUES (?,?)");
        $sql->bind_param("ss",$name,$year);
    }
    catch(Exception $e)
    {
        echo $e->getMessage();
        die;
    }

    $sql->execute();
    
    header("Location: http://localhost/TimeTableGenerator/addDivisions.php");
    exit();
}
?>