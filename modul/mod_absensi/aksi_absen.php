<?php
session_start();
// Apabila user belum login
if (empty($_SESSION['username']) AND empty($_SESSION['password'])){
  echo "<center><h1>Untuk mengakses halaman, Anda harus login dulu.</h1></center>
        <p><center><a href=\"index.php\">LOGIN</a></center></p>";  
}
    // Apabila user sudah login dengan benar, maka terbentuklah session
else{
	require_once('../../config/koneksi.php');
	//membuat fungsi anti injeksi
		function menghalangi_injection($data)
		{
	  		$validasi_input = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
	  		return $validasi_input;
		}

    $module = $_GET['module'];
  	$act	= $_GET['act'];

	// Delete User
	if($module=='absen' AND $act=='delete'){
		//echo "data dihapus";
		mysqli_query($con, "DELETE FROM tbabsen WHERE id_absen='$_GET[id]'");
		header("location:../../data-absen");
	}
}
?>