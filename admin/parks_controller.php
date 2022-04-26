<?php



function getparks()
{
    include '../connection.php';

    $sql = "SELECT * FROM `parks`";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        $n = 1;

        while ($row = mysqli_fetch_assoc($result)) {
            $park_name = $row['park_name'];

            $address = $row['address'];

            $name1 = $row['name1'];

            $handler1 = $row['handler1'];

            $park_chairman = $row['park_chairman'];
            
            $pc_number = $row['pc_number'];

            

            echo '<tr>
            <th scope="row">'.$n++.'</th>
            <td>'.$park_name.'</td>
            <td>'.$address.'</td>
            <td>'.$name1.'</td>
            <td>'.$handler1.'</td>
            <td>'.$park_chairman.'</td>
            <td>'.$pc_number.'</td>
            

        </tr>';


        }
    }
}


function getnomparks()
{
    include '../connection.php';

    $sql = "SELECT * FROM `temp`";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        $n = 1;

        while ($row = mysqli_fetch_assoc($result)) {

            $id = $row['id'];

            $state_id = $row['state_id'];
            $lga_id  = $row['lga_id'];

            $park_name = $row['park_name'];

            $name1 = $row['name1'];

            $handler1 = $row['handler1'];

            $ref1 = $row['ref1'];

            

            echo '<tr>
            <th scope="row">'.$n++.'</th>
            <td>'.$park_name.'</td>
            <td>'.$state_id.'</td>
            <td>'.$lga_id.'</td>
            <td>'.$name1.'</td>
            <td>'.$handler1.'</td>';


            if ($ref1 == "Admin") {
                echo '<td>'.$ref1.'</td>
                
                </tr>';
            }
            else {
                $other = "other";

                echo '<td>'.$other.'</td>
                
                </tr>';
            }

        


        }
    }
}


function nominate_by_admin()
{

    include '../connection.php';

    $state_id = $_POST['dto_state'];
    $lga_id = $_POST['dto_lga'];
    $park_name = $_POST['dto_park_name'];
    $name1 = $_POST['dto_name1'];
    $handler1 = $_POST['dto_handler1'];
    $ref1 = "Admin";

    $sql = "INSERT into `temp` (state_id,lga_id,park_name,name1,handler1,ref1) VALUES ($state_id, $lga_id, '$park_name', '$name1', '$handler1','$ref1')";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        $mssg = "success";
    }
    





    
}



if (isset($_POST['nominate'])) {
    try {
        nominate_by_admin();
        $cookie_name = "result";
        $cookie_value = "success";
        setcookie($cookie_name, $cookie_value, time() + 60, "/"); 

        header("Location: nom_park.php");



    } catch (Exception $th) {
        echo $th->getMessage();

    }
}



?>

