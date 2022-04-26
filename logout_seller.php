<?php
	session_start();
	session_destroy();
	header("location:login_seller.html");
?>