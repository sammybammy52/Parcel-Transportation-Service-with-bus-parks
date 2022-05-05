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
                    <?php if (isset($_GET['error'])) { ?>

                        <div class="alert alert-danger alert-dismissible text-white m-3" role="alert">
                            <span class="text-sm"><?php echo $_GET['error']; ?></span>
                            <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>

                       

                    <?php } ?>

                    <div class="card-body px-0 pb-2 position-relative">

                        <div class="titles">

                            <center>
                                <h3 id="register" class="mb-2">Park Registration</h3>
                                <p class="mb-2 ms-4">Gain Access With the Number You Were Contacted On to Register Your Park </p>
                            </center>

                        </div>
                        <center><img src="image10.png" alt="" height="355" width="600"></center>

                        <br>

                        <center><button type="button" class="btn btn-primary m-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Proceed
                            </button></center>


                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <h5>Enter The Phone Number We Contacted You On</h5>
                                        <form id="regForm" method="POST" action="login_controller.php">
                                            <input type="number" name="handler1" placeholder="Phone No." required>
                                            <button type="submit" class="btn btn-primary mt-2" name="login_handler">Get Access</button>
                                        </form>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                                    </div>
                                </div>
                            </div>
                        </div>




                        <script>
                            var myModal = document.getElementById('myModal')
                            var myInput = document.getElementById('myInput')

                            myModal.addEventListener('shown.bs.modal', function() {
                                myInput.focus()
                            })
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

            $('#state').on('change', function() {
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
                        $("#lga").html(result);


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