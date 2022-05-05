
<?php

session_start();

if (!isset($_SESSION["handler1"])) {
  header('location: login_handler.php');
}

?>



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
							<h6 class="text-white text-capitalize ps-3">Register Park</h6>
						</div>
					</div>
					<div class="card-body px-0 pb-2 position-relative">


						<form id="regForm" method="POST" action="registerpark.php">
							<div class="titles">
								<h1 id="register" class="mb-2">Park Registration</h1>
								<h3 class="mb-2">Park Details</h3>
							</div>


							<p>Park Name<input type="text" placeholder="Park Name" oninput="this.className = ''" name="park_name" required></p>
							<p>Park Address<input type="text" placeholder="Address" oninput="this.className = ''" name="address" required></p>
							<p> Select State <select id="state" name="state" class="form-select" style="padding: 12px; border: 1px solid #aaaaaa; border-radius: 0;">
									<option selected>Select State</option>

									<?php


									getstates();



									?>
								</select></p>

							<p> Select LGA <select id="lga" name="lga" class="form-select" style="padding: 12px; border: 1px solid #aaaaaa; border-radius: 0;">
									<option>Select State First</option>
								</select></p>


							<div class="row">
								<div class="col-4">
									<p>Handler Name<input type="text" placeholder="Name of Attendant" oninput="this.className = ''" name="name1" required></p>
									<p>Handler Number<input type="number" placeholder="Phone number of Attendant" oninput="this.className = ''" name="handler1" required></p>

								</div>
								<div class="col-4">
									<p>Handler Name<input type="text" placeholder="Name of Attendant" oninput="this.className = ''" name="name2"></p>
									<p>Handler Number<input type="number" placeholder="Phone number of Attendant" oninput="this.className = ''" name="handler2"></p>
								</div>
								<div class="col-4">
									<p>Handler Name<input type="text" placeholder="Name of Attendant" oninput="this.className = ''" name="name3"></p>
									<p>Handler Number<input type="number" placeholder="Phone number of Attendant" oninput="this.className = ''" name="handler3"></p>
								</div>
							</div>
							<p>Are You Physically Present at the park now?</p>
							<div class="form-check">
								<input class="form-check-input" type="radio" name="flexRadioDefault" id="radioyes" value="yes" onclick="getLocation()">
								<label class="form-check-label" for="flexRadioDefault1">
									Yes
								</label>
							</div>
							<div class="form-check">
								<input class="form-check-input" type="radio" name="flexRadioDefault" id="radiono" checked value="no">
								<label class="form-check-label" for="flexRadioDefault2">
									No
								</label>
							</div>
							<p>Latitude<input type="hidden" placeholder="latitude" oninput="this.className = ''" name="latitude" id="lat" required></p>
							<p>Longitude<input type="hidden" placeholder="longitude" oninput="this.className = ''" name="longitude" id="long" required></p>

							<p>Park Chairman's Name<input type="text" placeholder="Name of Park Chairman" oninput="this.className = ''" name="park_chairman" required></p>
							<p>Park Chairman's Number<input type="number" placeholder="Phone number of Chairman" oninput="this.className = ''" name="pc_number" required></p>



							<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
								Proceed
							</button>

							<!-- Modal -->
							<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
											<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
										</div>
										<div class="modal-body">
											<h5>Are You Sure You want to Proceed?</h5>

										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
											<button type="submit" name="submit_park" class="btn btn-primary">Save changes</button>
										</div>
									</div>
								</div>
							</div>


						</form>

						<script>
							var myModal = document.getElementById('myModal')
							var myInput = document.getElementById('myInput')

							myModal.addEventListener('shown.bs.modal', function() {
								myInput.focus()
							})
						</script>

						<script>



						function getLocation() {
							if (navigator.geolocation) {
								navigator.geolocation.getCurrentPosition(showPosition);
							}
						}

						function showPosition(position) {
							var lat = document.getElementById('lat');
							var long = document.getElementById('long');

							lat.value = position.coords.latitude;	
							long.value = position.coords.longitude;
						}

						function clear() {
							var lat = document.getElementById('lat');
							var long = document.getElementById('long');

							lat.value = NULL;	
							long.value = NULL;
						}

						var radiono = document.getElementById('radiono');

						radiono.addEventListener('onclick', clear());
						
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