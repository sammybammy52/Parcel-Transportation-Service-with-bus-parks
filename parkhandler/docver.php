<?php 
          if(isset($_POST['insert'])){
            if($_FILES['image']['tmp_name']!=null){
              $file=addslashes(file_get_contents($_FILES['image']['tmp_name']));

              $cid = $_SESSION['user_id'];

              $sql= "update `tbl_couriers` set documents='$file' where id=$cid";
              if(mysqli_query($conn,$sql)){
                echo '<script>alert("File Inserted successfully")</script>';
                header('Location: profile.php');
              }else{
                echo '<script>alert("Error in insertion")</script>';
                header('Location: profile.php');
              }	
            }else{
              echo '<script>alert("Please Select Image");</script>';
              header('Location: profile.php');
            }
          }
?>