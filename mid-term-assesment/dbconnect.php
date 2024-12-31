<?php

$servername = 'localhost';
$username = 'root';
$password = '';
$databaseName = 'hotelmanagement';


$databaseConnection = mysqli_connect($servername, $username, $password, $databaseName)
    or die("Connection failed: " . mysqli_connect_error());
