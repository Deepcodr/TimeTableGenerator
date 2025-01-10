<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('../includes/dbconnection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = file_get_contents('php://input');

    $timetable= json_decode($data,true);


    foreach($timetable as $year => $yeardata)
    {
        foreach($yeardata as $division => $divisiondata)
        {
            foreach($divisiondata as $day => $daydata)
            {
                foreach($daydata as $slot => $slotdata)
                {
                    // echo $day." ".$slot." ".$division." ".gettype($slotdata)."\n";
                    if(count($slotdata)==0)
                    {
                        try{
                            $break = "OFF";
                            $sql=mysqli_prepare($conn,"INSERT INTO timetables(year,division,timeslot,day,subject,staff) VALUES (?,?,?,?,?,?)");
                            $sql->bind_param("isisss",$year,$division,$slot,$day,$break,$break);
                            $sql->execute();
                        }
                        catch(Exception $e)
                        {
                            echo $e->getMessage();
                            // die;
                        }
                    }
                    else if(count($slotdata)>1)
                    {
                        foreach($slotdata as $batch => $batchdata)
                        {
                            // echo gettype($batchdata);
                            // echo json_encode($batchdata);
                            if(is_string($batchdata))
                            {
                                try{
                                    $sql=mysqli_prepare($conn,"INSERT INTO timetables(year,division,batch,timeslot,day,subject,staff) VALUES (?,?,?,?,?,?,?)");
                                    $sql->bind_param("ississs",$year,$division,$batch,$slot,$day,$batchdata,$batchdata);
                                    $sql->execute();
                                }
                                catch(Exception $e)
                                {
                                    echo $e->getMessage();
                                    // die;
                                }
                            }else
                            {
                                foreach($batchdata as $subject=>$faculty)
                                {
                                    try{
                                        $sql=mysqli_prepare($conn,"INSERT INTO timetables(year,division,batch,timeslot,day,subject,staff) VALUES (?,?,?,?,?,?,?)");
                                        $sql->bind_param("ississs",$year,$division,$batch,$slot,$day,$subject,$faculty);
                                        $sql->execute();
                                    }
                                    catch(Exception $e)
                                    {
                                        echo $e->getMessage();
                                        // die;
                                    }
                                }
                            }
                        }
                    }else
                    {
                        foreach($slotdata as $subject=>$faculty)
                        {
                            
                            try{
                                $sql=mysqli_prepare($conn,"INSERT INTO timetables(year,division,timeslot,day,subject,staff) VALUES (?,?,?,?,?,?)");
                                $sql->bind_param("isisss",$year,$division,$slot,$day,$subject,$faculty);
                                $sql->execute();
                                // echo $conn->error;
                            }
                            catch(Exception $e)
                            {
                                echo $e->getMessage();
                                // die;
                            }
                        }
                    }
                }
            }
        }
    }

    try{
        $status=1;
        $sql=mysqli_prepare($conn,"INSERT INTO timetable_status(year,status) VALUES (?,?)");
        $sql->bind_param("ii",$year,$status);
        $sql->execute();
        echo json_encode(['status' => 'success', 'message' => 'Timetable Saved Successfully']);
        // echo $conn->error;
    }
    catch(Exception $e)
    {
        echo $e->getMessage();
        echo json_encode(['status' => 'failed', 'message' => 'Error While Saving Timetable']);
        // die;
    }

}
?>