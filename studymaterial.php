<?php  
require 'header.php';

$meeting_query = "SELECT material_id,meeting_id,title,author,type,assigned_date,url,notes FROM material;";
$meeting_result = mysqli_query($db, $meeting_query); 


$meeting_query = "SELECT meeting_name,meeting_id FROM meetings;";
$meeting_result = mysqli_query($db, $meeting_query); 
?>

</br>

<div>

    <form action="studymaterial_script.php" method="post">
        <h2>Create new studymaterial</h2>
        <table cellspacing="1" bgcolor="#000000">
            <tr bgcolor="#ffffff">

                <th>Title</th>
                <th>Author</th>
                <th>Type</th>
                <th>URL</th>
                <th>Notes</th>
                <th>Assigned Date</th>
                <th>Meeting</th>


            </tr>
            <tr bgcolor="#ffffff">
                <td><input type="text" name="title" required></td>
                <td><input type="text" name="author"></td>
                <td><input type="text" name="type"></td>
                <td><input type="text" name="url"></td>
                <td><input type="text" name="notes"></td>
                <td><input type="date" type="text" name="date" required></td>
                <td><select name="meeting_id" required> <?php  while ($row = $meeting_result->fetch_assoc()) { ?>
                        <option value="<?php echo $row['meeting_id']; ?>"> <?php echo $row['meeting_name']; ?>
                        </option> <?php } ?>
                    </select></td>

            </tr>
        </table>
        </br>

        <input type="submit" value="Create" name="create" />
    </form>
    <br><br><br>
    <?php mysqli_data_seek($meeting_result,0); ?>