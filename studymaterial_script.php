<?php
session_start();
include ("helper.php");
if(isset($_POST['create'])) {
    include ("database_connect.php");
    $next_materialid =  getNextId("material","material_id",$db);
    $title = $_POST['title'];
    $author = $_POST['author'];
    $type = $_POST['type'];
    $url = $_POST['url'];
    $notes = $_POST['notes'];
    $date = $_POST['date'];
    $meeting_id = $_POST['meeting_id'];

    $mysqlDate=date("Y-m-d",strtotime($date));

    $mysqlDateInt=strtotime($mysqlDate);
    $day = date('D', $mysqlDateInt);
    
    //create meeting
        $sql = "INSERT INTO material
        (material_id,
        title,
        author,
        type,
        url,
        notes,
        assigned_date,
        meeting_id)

        VALUES ('$next_materialid', 
        '$title', 
        '$author', 
        '$type',
         '$url' ,
        '$notes',
        '$date',
        '$meeting_id')";
        
        if ($db->query($sql) === FALSE) {
          echo "Error: " . $sql . "<br>" . $db->error;
          exit();
        }
    
    header("Location: studymaterial.php");

}
    ?>