<?php
session_start();
include ("helper.php");
if(isset($_POST['create'])) {
    include ("database_connect.php");
    $next_meetingid =  getNextId("meetings","meeting_id",$db);
    $meeting_name = $_POST['meeting_name'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $group_id = $_POST['group_id'];
    $announcement = $_POST['announcement'];

    $mysqlDate=date("Y-m-d",strtotime($date));

    $mysqlDateInt=strtotime($mysqlDate);
    $day = date('D', $mysqlDateInt);
    
    $next_timeslot =  getNextId("time_slot","time_slot_id",$db);
    $mysqlTime = date('h:i:s A', strtotime($time)+3600);
    //Create time slot 

    $sql = "INSERT INTO time_slot (time_slot_id, day_of_the_week,start_time,end_time)
    VALUES ('$next_timeslot', '$day', '$time', '$mysqlTime')";
    
    if ($db->query($sql) === FALSE) {
      echo "Error: " . $sql . "<br>" . $db->error;
      exit();
    }

    //create meeting
        $sql = "INSERT INTO meetings (meeting_id, meeting_name,date,time_slot_id,capacity,group_id,announcement)
        VALUES ('$next_meetingid', '$meeting_name', '$mysqlDate', '$next_timeslot', 0 ,'$group_id', '$announcement')";
        
        if ($db->query($sql) === FALSE) {
          echo "Error: " . $sql . "<br>" . $db->error;
          exit();
        }
    
    header("Location: meeting.php");
} else  if(isset($_POST['submit2'])) {
    include ("database_connect.php");
    //We could move this to a single file and make it a function for reuse
    //start
    $max_id_query = "SELECT MAX(`group_id`) FROM `groups`;";
    $max_id_result = mysqli_query($db, $max_id_query);
    $max_id_row = mysqli_fetch_row($max_id_result);
    $max_id = $max_id_row[0];
    $next_id = $max_id + 1;
    //end

    $name = $_POST['name'];
    $desc = $_POST['desc'];
    $grade_req = $_POST['grade_req'];

    $sql = "INSERT INTO groups (group_id, name, description,grade_req)
    VALUES ('$next_id', '$name', '$desc', '$grade_req')";
    
    if ($db->query($sql) === FALSE) {
      echo "Error: " . $sql . "<br>" . $db->error;
      exit();
    }
    header("Location: readinggroup.php");
} else {
    echo "You can not come here without using a form.";
}
?>