<!--Code to connect to database-->
<?php 
	session_start();
	$connection =mysqli_connect("localhost","root","bidoo","pet_finder") or die("Connection Failed");
?>	