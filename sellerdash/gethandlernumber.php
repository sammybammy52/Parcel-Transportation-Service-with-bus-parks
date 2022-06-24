<?php
    session_start();

    if (!isset($_SESSION["username"])) {
      header('location: ../login_seller.html');
    }

    $dpark = $_POST['dpark'];

    $sendback = array("state"=>"", "lga"=>"", "park_name"=>"", "handler1"=>"", "handler2"=>"");

    include 'connection.php';

    $sql = "SELECT * FROM `parks` INNER JOIN tbl_lgs INNER JOIN tbl_states ON parks.lga_id=tbl_lgs.id AND parks.state_id=tbl_states.id WHERE parks.id=$dpark";

    $result = mysqli_query($conn, $sql);


    if ($result) {
        $row = mysqli_fetch_assoc($result);

        $handler1 = $row['handler1'];

        $handler2 = $row['handler2'];

        $park_name = $row['park_name'];

        $lga = $row['name'];

        $state = $row['states'];

        $sendback['state'] = $state;
        $sendback['lga'] = $lga;
        $sendback['park_name'] = $park_name;
        $sendback['handler1'] = $handler1;
        $sendback['handler2'] = $handler2;

        $mod_sendback = json_encode($sendback);

        echo $mod_sendback;

    }

?>

