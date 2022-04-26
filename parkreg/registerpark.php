<?php


//saving to the parks table

function savetoparks()
{

    include '../connection.php';

    $park_name = $_POST['park_name'];
    $address = $_POST['address'];
    $state = $_POST['state'];
    $lga = $_POST['lga'];
    $name1 = $_POST['name1'];
    $handler1 = $_POST['handler1'];
    $name2 = $_POST['name2'];
    $handler2 = $_POST['handler2'];
    $name3 = $_POST['name3'];
    $handler3 = $_POST['handler3'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];

    $park_chairman = $_POST['park_chairman'];
    $pc_number = $_POST['pc_number'];


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

