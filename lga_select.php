<?php
    require_once "connection.php";
    $state_id = $_POST["state_id"];
    $result = mysqli_query($conn,"SELECT * FROM tbl_lgs where state_id = $state_id ORDER BY name ASC");
?>
    <option value="">Select LGA</option>
<?php
    while($row = mysqli_fetch_array($result)) {
?>
    <option value="<?php echo $row["id"];?>"><?php echo $row["name"];?></option>
<?php
    }
?>