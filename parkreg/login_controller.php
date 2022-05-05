<?php

session_start();

include '../connection.php';

if (isset($_POST['login_handler'])) {

    function validate($data){

       $data = trim($data);

       $data = stripslashes($data);

       $data = htmlspecialchars($data);

       return $data;

    }

    $phone_no = validate($_POST['handler1']);

    $sql = "SELECT name1,handler1 FROM temp WHERE handler1='$phone_no'";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {

            $row = mysqli_fetch_assoc($result);

            if ($row['handler1'] === $phone_no) {

                echo "Logged in!";

                $_SESSION['handler1'] = $row['handler1'];

                header("Location: index.php");

                exit();

            }else{

                header("Location: login_handler.php?error=Incorect Number");

                exit();

            }

        }else{

            header("Location: login_handler.php?error=Incorect Number");

            exit();

        }

}else{

    header("Location: login_handler.php");

    exit();

}



?>