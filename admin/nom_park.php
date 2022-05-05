<?php include('include/header.php'); ?>

<?php

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


?>

<center>
<div class="container m-3 border border-primary rounded">
    <form id="regForm" method="POST" action="parks_controller.php">

        <?php

        if ($_COOKIE["result"] == "success") {
            echo '<div class="alert alert-success alert-dismissible text-white m-3" role="alert">
    <span class="text-sm">Park Successfully nominated <br> You can add more</span>
    <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">×</span>
    </button>
  </div>';
        }
        ?>

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
</div>

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
</center>






<?php include('include/footer.php'); ?>