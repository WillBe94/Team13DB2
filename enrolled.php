<?php  

require 'header.php';

$meeting_query = "SELECT meeting_id,grade_req,meeting_name,a.group_id,date_format(start_time,'%H:%i') as start_time,date_format(end_time,'%H:%i') as end_time,end_time,a.time_slot_id,date,capacity,announcement FROM meetings a
INNER JOIN time_slot b ON a.time_slot_id = b.time_slot_id
INNER JOIN groups c ON c.group_id = a.group_id;";
$meeting_result = mysqli_query($db, $meeting_query); 

$enroll_query = "SELECT a.meeting_id,meeting_name,group_id,date_format(start_time,'%H:%i') as start_time,date_format(end_time,'%H:%i') as end_time,end_time,a.time_slot_id,date,capacity,announcement FROM meetings a
INNER JOIN time_slot b ON a.time_slot_id = b.time_slot_id
INNER JOIN enroll c ON c.meeting_id = a.meeting_id
WHERE c.student_id = $user_id;";
$enroll_result = mysqli_query($db, $enroll_query); 


$group_query = "SELECT description,name,group_id,grade_req FROM groups;";
$group_result = mysqli_query($db, $group_query); 

?>

</br>

<div>

    <form action="enrolled_script.php" method="post">
        <h2>Upcoming Meetings</h2>
        <table cellspacing="1" bgcolor="#000000">
            <tr bgcolor="#ffffff">
                <th></th>
                <th>Name</th>
                <th>Date</th>
                <th>Start time</th>
                <th>Group</th>
                <th>Announcment</th>
                <th>Capacity</th>
            </tr>

            <?php 
                while ($row = $meeting_result->fetch_assoc()) {
					$sqlDate = $row['date'];
					$sqlTime = $row['start_time'];


					$theDate = date('Y-m-d H:i', strtotime("$sqlDate $sqlTime"));
					if($theDate > date('Y-m-d H:i')  ) {
					?>
            <tr bgcolor="#ffffff">
                <td>
                    <form action="enrolled_script.php" method="post">
                        <input type="submit" value="Join" name="join" />
                        <input value="<?php echo $row['meeting_id']; ?>" name="meeting_id2" type="hidden">
                        <input value="<?php echo $user_id; ?>" name="student_id2" type="hidden">
                        <input value="<?php echo $row['date']; ?>" name="date2" type="hidden">
                    </form>
                </td>
                <td>
                    <input value="<?php echo $row['meeting_id']; ?>" name="meeting_id[]" type="hidden">
                    <input value="<?php echo $row['time_slot_id']; ?>" name="time_slot_id[]" type="hidden">
                    <input value="<?php echo $row['meeting_name']; ?>" type="text" name="meeting_name[]" required>
                </td>
                <td><input value="<?php echo $row['date']; ?>" type="date" type="text" name="date[]" required></td>
                <td><input value="<?php echo $row['start_time']; ?>" type="time" name="time[]" min="00:00:00"
                        max="23:59:59" required>
                </td>
                <td><select name="group_id[]" required> <?php  while ($row2 = $group_result->fetch_assoc()) { ?> <option
                            <?php  if($row['group_id'] == $row2['group_id']) { echo "selected"; } ?>
                            value="<?php echo $row2['group_id']; ?>"> <?php echo $row2['name']; ?>
                        </option> <?php  } ?> </select></td>
                <td><input value="<?php echo $row['announcement']; ?>" type="text" name="announcement[]"></td>
                <td><?php echo $row['capacity']; ?></td>

            </tr>
            <?php  mysqli_data_seek($group_result,0); }}?>
        </table>

        </br>

        <input type="submit" value="Join All in your group" name="joinall" />

    </form>


    <h2>Past Meetings</h2>
    <table cellspacing="1" bgcolor="#000000">
        <tr bgcolor="#ffffff">

            <th>Name</th>
            <th>Date</th>
            <th>Start time</th>
            <th>Group</th>
            <th>Announcment</th>
        </tr>

        <?php 
		mysqli_data_seek($meeting_result,0);
                while ($row = $meeting_result->fetch_assoc()) {
					$sqlDate = $row['date'];
					$sqlTime = $row['start_time'];


					$theDate = date('Y-m-d H:i', strtotime("$sqlDate $sqlTime"));
					if($theDate < date('Y-m-d H:i')) {
					?>
        <tr bgcolor="#ffffff">

            <td> <?php echo $row['meeting_id']; ?>
                <?php echo $row['time_slot_id']; ?>
                <?php echo $row['meeting_name']; ?>
            </td>
            <td><input value="<?php echo $row['date']; ?>" type="date" type="text" name="date[]" required></td>
            <td><input value="<?php echo $row['start_time']; ?>" type="time" name="time[]" min="00:00:00" max="23:59:59"
                    required>
            </td>
            <td><select name="group_id[]" required> <?php  while ($row2 = $group_result->fetch_assoc()) { ?> <option
                        <?php  if($row['group_id'] == $row2['group_id']) { echo "selected"; } ?>
                        value="<?php echo $row2['group_id']; ?>"> <?php echo $row2['name']; ?>
                    </option> <?php  } ?> </select></td>
            <td><?php echo $row['announcement']; ?></td>

        </tr>
        <?php  mysqli_data_seek($group_result,0); }}?>
    </table>


    <?php if ($user_type == "student") { ?>
    <h2>Meetings you are enrolled in</h2>
    <table cellspacing="1" bgcolor="#000000">
        <tr bgcolor="#ffffff">

            <th>Name</th>
            <th>Date</th>
            <th>Start time</th>
            <th>Group</th>
            <th>Announcment</th>
            <th>Leave Meeting</th>

        </tr>

        <?php 
	
                while ($row = $enroll_result->fetch_assoc()) {

				
					?>
        <tr bgcolor="#ffffff">

            <td>
                <?php echo $row['meeting_name']; ?>
            <td><?php echo $row['date']; ?></td>
            <td><input value="<?php echo $row['start_time']; ?>" type="time" name="time[]" min="00:00:00" max="23:59:59"
                    required>
            </td>
            <td><select name="group_id[]" required> <?php  while ($row2 = $group_result->fetch_assoc()) { ?> <option
                        <?php  if($row['group_id'] == $row2['group_id']) { echo "selected"; } ?>
                        value="<?php echo $row2['group_id']; ?>"> <?php echo $row2['name']; ?>
                    </option> <?php  } ?> </select></td>
            <td><?php echo $row['announcement']; ?></td>
            <td>
                <input type="submit" value="Leave" name="delete" />
                <input value="<?php echo $row['meeting_id']; ?>" name="meeting_id2" type="hidden">
                <input value="<?php echo $user_id; ?>" name="student_id2" type="hidden">
            </td>

        </tr>
        <?php  mysqli_data_seek($group_result,0); }?>
    </table>
    <?php	}?>
</div>

<?
require 'footer.php';
?>