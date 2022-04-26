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

<?php function mainfunc()
{   ?>

    <h5>New Location</h5>
    <p>Select State <select name="dto_state[]" id="dto_state" class="form-select" style="padding: 12px; border: 1px solid #aaaaaa; border-radius: 0;">
            <?php
            getstates();
            ?>
        </select></p>

    <p>Select LGA <select name="dto_lga[]" id="dto_lga" class="form-select" style="padding: 12px; border: 1px solid #aaaaaa; border-radius: 0;">
            <option value="">Select State First</option>
        </select></p>


    <p>Park Name<input type="text" placeholder="Park Name" oninput="this.className = ''" name="dto_park_name[]"></p>
    <p>Handler<input type="number" placeholder="Phone number of Attendant" oninput="this.className = ''" name="dto_handler1[]"></p>


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

<?php } ?>