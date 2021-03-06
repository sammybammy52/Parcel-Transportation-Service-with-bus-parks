<?php

session_start();

if (!isset($_SESSION["username"])) {
  header('location: ../login_seller.html');
}



$drop_park = $_GET['park'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="assets/img/favicon.png">
    <title>
        Order details
    </title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Nucleo Icons -->
    <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS Files -->
    <link id="pagestyle" href="assets/css/material-dashboard.css?v=3.0.0" rel="stylesheet" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body class="g-sidenav-show  bg-gray-200">
    <?php
    require 'sidebar.php';
    ?>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">New Delivery</h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2 position-relative">




                        <form class="m-5" method="POST" action="orderpagehandler.php">
                            <div class="mb-3">
                                <label class="form-label">Package weight (Kg) </label>
                                <input type="number" class="form-control border border-secondary p-2" id="package_weight" name="package_weight">
                            </div>

                            <div class="col-4 mb-3">
                                <label class="form-label">No of Identical Packages</label>
                                <input type="number" class="form-control border border-secondary p-2" id="quantity" name="quantity">
                            </div>

                            <div class="row">
                                <div class="col-4">
                                    <label class="form-label">Length (cm)</label>
                                    <input type="number" class="form-control border border-secondary p-2" id="length" name="length">
                                </div>
                                <div class="col-4">
                                    <label class="form-label">Width (cm)</label>
                                    <input type="number" class="form-control border border-secondary p-2" id="width" name="width">
                                </div>
                                <div class="col-4">
                                <label class="form-label">Height (cm)</label>
                                <input type="number" class="form-control border border-secondary p-2" id="height" name="height">
                                </div>
                            </div>

                            <div class="mb-3" id="dropoff">
                            <input type="hidden" class="form-control border-bottom border-primary p-2" id="dropoff_park" name="dropoff_park" value="<?php echo $drop_park?>">

                            </div>

                            <div class="mb-3">
                                <label class="form-label">Your Phone number</label>
                                <input type="number" class="form-control border border-secondary p-2" id="seller_number" name="seller_number">
                            </div>



                            <div class="mb-3">
                                <label class="form-label">Recipient's Phone Number</label>
                                <input type="number" class="form-control border border-secondary p-2" id="recipient_number" name="recipient_number">
                            </div>

                            <div class="mb-3">
                                <label for="state">Destination State</label>
                                <select class="form-select p-2 mb-2 border border-secondary" name="dstate" id="state">

                                    <option selected>Select State</option>

                                    <?php
                                    include 'connection.php';
                                    $sql = "SELECT * FROM tbl_states ORDER BY tbl_states.states ASC";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            $state_arr[$row['id']] = $row['states']; ?>
                                            <option value="<?php echo $row['id']; ?>" style="text-transform:capitalize;"><?php echo $row['states']; ?></option>
                                    <?php
                                        }
                                    }


                                    ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="lga">Destination LGA</label>
                                <select class="form-select p-2 border border-secondary" name="dlga" id="lga">
                                    <option>Select State first</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="park">Destination Park</label>
                                <select class="form-select p-2 border border-secondary" name="dpark" id="park">
                                    <option>Select State and LGA first</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary" name="order">Submit Request</button>
                        </form>

                        <script>
                            $(document).ready(function() {

                                $('#state').on('change', function() {
                                    var state_id = this.value;
                                    $.ajax({
                                        url: "lga.php",
                                        type: "POST",
                                        data: {
                                            state_id: state_id
                                        },
                                        cache: false,
                                        success: function(result) {
                                            console.log(result);
                                            $("#lga").html(result);
                                            $('#park').html('<option value="">Select Lga first</option>');

                                        }
                                    });
                                });

                                $('#lga').on('change', function() {
                                    var lg_id = this.value;
                                    $.ajax({
                                        url: "parks.php",
                                        type: "POST",
                                        data: {
                                            lg_id: lg_id
                                        },
                                        cache: false,
                                        success: function(result) {
                                            console.log(result);
                                            $("#park").html(result);
                                        }
                                    });
                                });

                            });
                        </script>







                    </div>
                </div>
            </div>
        </div>

        <footer class="footer py-4  ">
            <div class="container-fluid">
                <div class="row align-items-center justify-content-lg-between">
                    <div class="col-lg-6 mb-lg-0 mb-4">
                        <div class="copyright text-center text-sm text-muted text-lg-start">
                            ?? <script>
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
    <div class="fixed-plugin">
        <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
            <i class="material-icons py-2">settings</i>
        </a>
        <div class="card shadow-lg">
            <div class="card-header pb-0 pt-3">
                <div class="float-start">
                    <h5 class="mt-3 mb-0">Material UI Configurator</h5>
                    <p>See our dashboard options.</p>
                </div>
                <div class="float-end mt-4">
                    <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
                        <i class="material-icons">clear</i>
                    </button>
                </div>
                <!-- End Toggle Button -->
            </div>
            <hr class="horizontal dark my-1">
            <div class="card-body pt-sm-3 pt-0">
                <!-- Sidebar Backgrounds -->
                <div>
                    <h6 class="mb-0">Sidebar Colors</h6>
                </div>
                <a href="javascript:void(0)" class="switch-trigger background-color">
                    <div class="badge-colors my-2 text-start">
                        <span class="badge filter bg-gradient-primary active" data-color="primary" onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-dark" data-color="dark" onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-info" data-color="info" onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-success" data-color="success" onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-warning" data-color="warning" onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-danger" data-color="danger" onclick="sidebarColor(this)"></span>
                    </div>
                </a>
                <!-- Sidenav Type -->
                <div class="mt-3">
                    <h6 class="mb-0">Sidenav Type</h6>
                    <p class="text-sm">Choose between 2 different sidenav types.</p>
                </div>
                <div class="d-flex">
                    <button class="btn bg-gradient-dark px-3 mb-2 active" data-class="bg-gradient-dark" onclick="sidebarType(this)">Dark</button>
                    <button class="btn bg-gradient-dark px-3 mb-2 ms-2" data-class="bg-transparent" onclick="sidebarType(this)">Transparent</button>
                    <button class="btn bg-gradient-dark px-3 mb-2 ms-2" data-class="bg-white" onclick="sidebarType(this)">White</button>
                </div>
                <p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p>
                <!-- Navbar Fixed -->
                <div class="mt-3 d-flex">
                    <h6 class="mb-0">Navbar Fixed</h6>
                    <div class="form-check form-switch ps-0 ms-auto my-auto">
                        <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed" onclick="navbarFixed(this)">
                    </div>
                </div>
                <hr class="horizontal dark my-3">
                <div class="mt-2 d-flex">
                    <h6 class="mb-0">Light / Dark</h6>
                    <div class="form-check form-switch ps-0 ms-auto my-auto">
                        <input class="form-check-input mt-1 ms-auto" type="checkbox" id="dark-version" onclick="darkMode(this)">
                    </div>
                </div>
                <hr class="horizontal dark my-sm-4">
                <a class="btn btn-outline-dark w-100" href="">View documentation</a>
                <div class="w-100 text-center">
                    <a class="github-button" href="https://github.com/creativetimofficial/material-dashboard" data-icon="octicon-star" data-size="large" data-show-count="true" aria-label="Star creativetimofficial/material-dashboard on GitHub">Star</a>
                    <h6 class="mt-3">Thank you for sharing!</h6>
                    <a href="https://twitter.com/intent/tweet?text=Check%20Material%20UI%20Dashboard%20made%20by%20%40CreativeTim%20%23webdesign%20%23dashboard%20%23bootstrap5&amp;url=https%3A%2F%2Fwww.creative-tim.com%2Fproduct%2Fsoft-ui-dashboard" class="btn btn-dark mb-0 me-2" target="_blank">
                        <i class="fab fa-twitter me-1" aria-hidden="true"></i> Tweet
                    </a>
                    <a href="https://www.facebook.com/sharer/sharer.php?u=https://www.creative-tim.com/product/material-dashboard" class="btn btn-dark mb-0 me-2" target="_blank">
                        <i class="fab fa-facebook-square me-1" aria-hidden="true"></i> Share
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!--   Core JS Files   -->
    <script src="assets/js/core/popper.min.js"></script>
    <script src="assets/js/core/bootstrap.min.js"></script>
    <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="assets/js/material-dashboard.min.js?v=3.0.0"></script>
</body>

</html>