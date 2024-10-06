<?php
include('../includes/dbconnection.php');
session_start();
if($_SERVER["REQUEST_METHOD"]==="POST")
{
    $username=$_REQUEST['username'];
    $password=$_REQUEST['password'];
    $usertype=$_REQUEST['user-type'];

    $sql;
    if($usertype == 0)
    {
        $sql=$conn->prepare("SELECT * FROM students WHERE username=?");
        $sql->bind_param("s",$username);   
    }else if($usertype == 1)
    {
        $sql=$conn->prepare("SELECT * FROM admin WHERE username=?");
        $sql->bind_param("s",$username); 
    }else if($usertype == 2)
    {
        $sql=$conn->prepare("SELECT * FROM staff WHERE emailId=?");
        $sql->bind_param("s",$username); 
    }
    $sql->execute();
    $result=$sql->get_result();

    if($result->num_rows>0)
    {
        while($row=$result->fetch_assoc())
        {
            if($row["password"]==$password)
            {
                $_SESSION["username"]=$row['name'];
                $_SESSION["userid"]=$row['email']==''?$row['staffId']:$row['email'];
                $_SESSION["userloggedin"]=true;
                $_SESSION["loginstatus"]=1;
                if($usertype==1)
                {
                    $_SESSION["adminstatus"]=1;
                    header("Location: http://localhost/TimeTableGenerator/administration.php");
                    exit();
                }
                else
                {
                    $_SESSION["adminstatus"]=0;
                    header("Location: http://localhost/TimeTableGenerator/dashboardnew.php");
                    exit();
                }
            }
            else
            {
                $_SESSION["userloggedin"]=false;
                $_SESSION["loginstatus"]=-1;
                header("Location: http://localhost/TimeTableGenerator/login.php");
                exit();
            }
        }
    }
    else
    {
        $_SESSION["userloggedin"]=false;
        $_SESSION["loginstatus"]=2;
        header("Location: http://localhost/TimeTableGenerator/login.php");
        exit();
    }
}
?>