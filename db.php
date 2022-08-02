<?php 
	$hostname = 'localhost';
	$username = 'root';
	$password = '';
    $port = '3306';
	$dbname   = 'db_tokonabila';

	$conn = mysqli_connect($hostname, $username, $password, $dbname,$port) or die ('Gagal terhubung ke database');
 ?>