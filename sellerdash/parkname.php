<?php
    session_start();
    
    if (!isset($_SESSION["username"])) {
      header('location: ../login_seller.html');
    }
    
    require_once "connection.php";
    $drop_park = $_POST["drop_park"];
    
    $result = mysqli_query($conn,"SELECT park_name,address FROM parks where parks.id = $drop_park");
    
    if ($result) {

    $row = mysqli_fetch_assoc($result);

    $park_name = $row['park_name'];
    $address = $row['address'];

    echo '<input type="hidden" class="form-control border-bottom border-primary p-2" id="dropoff_park" name="dropoff_park" value="'.$park_name.', '.$address.'">';
    }
    else {
        echo 'An error occured';
    }
    
    

?>

