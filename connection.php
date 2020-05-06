<?php

// For Database connection  - to insert github user data into users table of petfinder database

$connection = mysqli_connect("localhost", "admin", "monarchs", "pet_finder") or die("Connection Failed");