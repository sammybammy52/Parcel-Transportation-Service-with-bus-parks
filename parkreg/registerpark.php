<?php

function validate($data){

    $data = trim($data);

    $data = stripslashes($data);

    $data = htmlspecialchars($data);

    return $data;

 }

//saving to the parks table

function savetoparks()
{

    include '../connection.php';

    $park_name = validate($_POST['park_name']);
    $address = validate($_POST['address']);
    $state = validate($_POST['state']);
    $lga = validate($_POST['lga']);
    $name1 = validate($_POST['name1']);
    $handler1 = validate($_POST['handler1']);
    $name2 = validate($_POST['name2']);
    $handler2 = validate($_POST['handler2']);
    $name3 = validate($_POST['name3']);
    $handler3 = validate($_POST['handler3']);
    $latitude = validate($_POST['latitude']);
    $longitude = validate($_POST['longitude']);

    $park_chairman = validate($_POST['park_chairman']);
    $pc_number = validate($_POST['pc_number']);


    $sql = "insert into `parks` (park_name,address,state_id,lga_id,name1,handler1,name2,handler2,name3,handler3,park_chairman,pc_number,latitude,longitude) values ('$park_name','$address',$state,$lga,'$name1','$handler1','$name2','$handler2','$name3','$handler3','$park_chairman','$pc_number','$latitude','$longitude')";

    $result = mysqli_query($conn, $sql);

}

function getstates()
{
	include '../connection.php';
	$sql = "SELECT * FROM tbl_states ORDER BY tbl_states.states ASC";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			$state_arr[$row['id']] = $row['states']; ?>
			<option value="<?php echo $row['id']; ?>" style="text-transform:capitalize;"><?php echo $row['states']; ?></option>
<?php
		}
	}
}

if (isset($_POST['submit_park'])) {

    try {
        savetoparks();
        $cookie_name = "result";
        $cookie_value = "success";
        setcookie($cookie_name, $cookie_value, time() + 15, "/"); 

        header("Location: nominatepark.php");



    } catch (Exception $th) {
        echo $th->getMessage();
    }
    
    
}








?>

