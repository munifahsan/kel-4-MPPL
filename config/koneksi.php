<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "dbabsensi";

$con = mysqli_connect($server,$username,$password,$database);

if ($con) {
	//echo "koneksi sukses";
} else {
	die("error: ".mysqli_connect_error());
}
?>
