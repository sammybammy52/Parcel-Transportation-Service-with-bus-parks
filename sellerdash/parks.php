<?php
    include 'sessions.php';
    require "connection.php";
    $lg_id = $_POST["lg_id"];
    $result = mysqli_query($conn,"SELECT * FROM parks where lga_id = $lg_id ORDER BY park_name ASC");
?>
    <option value="">Select Park</option>
<?php
    while($row = mysqli_fetch_array($result)) {
?>
    <option value="<?php echo $row["id"];?>"><?php echo $row["park_name"];?></option>
<?php
    }
?>