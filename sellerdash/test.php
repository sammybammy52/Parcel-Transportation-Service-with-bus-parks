<?php

session_start();

include 'connection.php';

if (isset($_POST['order'])) {
    $item_name = $_POST['item_name'];
    $quantity = $_POST['quantity'];
    $item_description = $_POST['item_description'];
    $dropoff_park = $_POST['dropoff_park'];
    $seller_number = $_POST['seller_number'];
    $recipient_number = $_POST['recipient_number'];
    $order_number = date('Ymd') . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
    $seller_id = $_SESSION['user_id'];
    $dstate = $_POST['dstate'];
    $dlga = $_POST['dlga'];
    $dpark = $_POST['dpark'];
    $order_status = "Pending";

    //$order_type = "Local";

    echo $dropoff_park;
    echo $item_description;
    echo $order_status;


   
}
?>