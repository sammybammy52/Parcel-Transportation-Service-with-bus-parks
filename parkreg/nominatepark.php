<?php

session_start();

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





function store()
{

    include '../connection.php';


    $state_id = $_POST['dto_state'];
    $lga_id = $_POST['dto_lga'];
    $park_name = $_POST['dto_park_name'];
    $name1 = $_POST['dto_name1'];
    $handler1 = $_POST['dto_handler1'];
    $ref2 = $_SESSION['handler1'];

    $sql = "insert into `temp` (state_id,lga_id,park_name,name1,handler1,ref2) values ($state_id,$lga_id,'$park_name','$name1','$handler1','$ref2')";
    $result = $conn->query($sql);
}

function retrieve()
{
    include '../connection.php';

    $ref2 = $_SESSION['handler1'];

    $sql = "SELECT * FROM `temp` WHERE ref2 = $ref2";

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





            echo '<tr>
            <th scope="row">' . $n++ . '</th>
            <td>' . $park_name . '</td>
            <td>' . $state_id . '</td>
            <td>' . $lga_id . '</td>
            <td>' . $name1 . '</td>
            <td>' . $handler1 . '</td> 
            </tr>';
        }
    }
}

if (isset($_POST['nominate'])) {

    try {
        store();
        $cookie_name = "nominate";
        $cookie_value = "success";
        setcookie($cookie_name, $cookie_value, time() + 60, "/");
    } catch (Exception $th) {

        echo $th->getMessage();
    }
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <link id="pagestyle" href="../sellerdash/assets/css/material-dashboard.css?v=3.0.0" rel="stylesheet" />
    <link rel="stylesheet" href="./styles/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body class="g-sidenav-show  bg-gray-200">

    <div class="container-fluid py-4 col-8">
        <div class="row">

            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Delivery Locations</h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2 position-relative">

                        <?php

                        if ($_COOKIE["result"] == "success") {
                            echo '<div class="alert alert-success alert-dismissible text-white m-3" role="alert">
                            <span class="text-sm">Hurray. Operation Successful, Just one more step now. <br> Please Input the locations Your Park Delivers to</span>
                            <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                          </div>';
                        }

                        if ($_COOKIE["nominate"] == "success") {
                            echo '<div class="alert alert-success alert-dismissible text-white m-3" role="alert">
                            <span class="text-sm">Nomination Successful <br> You Can input More Locations below</span>
                            <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                          </div>';
                        }


                        ?>

                        <form id="regForm" method="POST">

                            <h5>New Location</h5>
                            <p>State State <select name="dto_state" id="dto_state" class="form-select" style="padding: 12px; border: 1px solid #aaaaaa; border-radius: 0;">
                                    <option value="" selected="selected">States</option>

                                    <?php

                                    getstates();
                                    ?>
                                </select></p>

                            <p>Select LGA <select name="dto_lga" id="dto_lga" class="form-select" style="padding: 12px; border: 1px solid #aaaaaa; border-radius: 0;">
                                    <option value="">Select State</option>
                                </select></p>


                            <p>Park Name<input type="text" placeholder="Park Name" oninput="this.className = ''" name="dto_park_name"></p>

                            <p>Handler Name<input type="text" placeholder="Name of Attendant" oninput="this.className = ''" name="dto_name1"></p>


                            <p>Handler Number<input type="number" placeholder="Phone number of Attendant" oninput="this.className = ''" name="dto_handler1"></p>


                            <button type="submit" class="btn btn-primary" name="nominate">Input</button>

                        </form>

                        <table class="table table-bordered m-3" width="60px">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Park Name</th>
                                <th scope="col">State</th>
                                <th scope="col">LGA</th>
                                <th scope="col">Handler Name</th>
                                <th scope="col">Handler No.</th>
                            </tr>


                            <?php 
                            
                            retrieve();
                            
                            ?>
                                
                            



                        </table>


                    </div>
                </div>
            </div>
        </div>

        <footer class="footer py-4  ">
            <div class="container-fluid">
                <div class="row align-items-center justify-content-lg-between">
                    <div class="col-lg-6 mb-lg-0 mb-4">
                        <div class="copyright text-center text-sm text-muted text-lg-start">
                            © <script>
                                document.write(new Date().getFullYear())
                            </script>,
                            made with <i class="fa fa-heart"></i> by
                            <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">Creative Tim</a>
                            for a better web.
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                            <li class="nav-item">
                                <a href="https://www.creative-tim.com" class="nav-link text-muted" target="_blank">Creative Tim</a>
                            </li>
                            <li class="nav-item">
                                <a href="https://www.creative-tim.com/presentation" class="nav-link text-muted" target="_blank">About Us</a>
                            </li>
                            <li class="nav-item">
                                <a href="https://www.creative-tim.com/blog" class="nav-link text-muted" target="_blank">Blog</a>
                            </li>
                            <li class="nav-item">
                                <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted" target="_blank">License</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    </main>

    <script>
        $(document).ready(function() {

            $('#dto_state').on('change', function() {
                var state_id = this.value;
                $.ajax({
                    url: "/loginregisteradmin/sellerdash/lga.php",
                    type: "POST",
                    data: {
                        state_id: state_id
                    },
                    cache: false,
                    success: function(result) {
                        console.log(result);
                        $("#dto_lga").html(result);


                    }
                });
            });





        });
    </script>



    <script src="../sellerdash/assets/js/core/popper.min.js"></script>
    <script src="../sellerdash/assets/js/core/bootstrap.min.js"></script>
    <script src="../sellerdash/assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../sellerdash/assets/js/plugins/smooth-scrollbar.min.js"></script>
</body>

</html>