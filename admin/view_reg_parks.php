<?php
include "../connection.php";

include "parks_controller.php"
?>

<?php include('include/header.php'); ?>

<div class="container">


    <div class="card-header">
        <div class="row">
            <div class="col-md-9 font-weight-bold"><i class="fas fa-users"></i> Registered Parks List</div>
            <div class="col-md-3" align="right">
                <!-- <button type="button" id="add_button" class="btn btn-primary btn-sm">Create New User</button> -->
            </div>
        </div>

        <div class="row">
            <div class="col-6">Search</div>
            <div class="col-6">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search Parks" aria-label="Recipient's username" aria-describedby="basic-addon2">
                    <div class="input-group-append mr-2">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                    <button type="reset" class="btn btn-secondary" onClick="window.location.reload();">reset</button>
                </div>
            </div>
        </div>
    </div>

    <div class="card-body">

        <div class="table-responsive">
            <table class="table table-bordered" width="100">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Park Name</th>
                        <th scope="col">Address</th>
                        <th scope="col">Attendant 1</th>
                        <th scope="col">Attendant 1 Phone</th>
                        <th scope="col">Park Chairman</th>
                        <th scope="col">Park Chairman Phone</th>
                    </tr>
                </thead>
                <tbody>
                    <?php getparks(); ?>
                </tbody>
            </table>
        </div>


    </div>
</div>




<?php include('include/footer.php'); ?>