<?php

session_start();
include('../includes/dbconnection.php');

if($_SERVER["REQUEST_METHOD"]=="POST")
{
    $name=$_REQUEST['batch'];
    $division=$_REQUEST['division'];
    $year=$_REQUEST['year'];
    

    try{
        $sql=mysqli_prepare($conn,"INSERT INTO batches(name,division,year) VALUES (?,?,?)");
        $sql->bind_param("ssi",$name,$division,$year);
    }
    catch(Exception $e)
    {
        echo $e->getMessage();
        die;
    }

    $sql->execute();
    
    header("Location: http://localhost/TimeTableGenerator/addBatches.php");
    exit();
}
?>