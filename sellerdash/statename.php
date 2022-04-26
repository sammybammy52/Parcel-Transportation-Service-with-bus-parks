<?php
    require_once "connection.php";
    $state_id = $_POST["state_id"];
    $lg_id = $_POST['lg_id'];
    $result = mysqli_query($conn,"SELECT * FROM tbl_lgs INNER JOIN tbl_states ON tbl_lgs.state_id=tbl_states.id where tbl_lgs.id = $lg_id AND state_id = $state_id");
    $row = mysqli_fetch_row($result);
    $statename = $row[4];
    $lgname = $row[2];
    echo '<h4 class="ms-3">Showing Couriers in: '.$statename.', '.$lgname.'</h4>';

?>
    
