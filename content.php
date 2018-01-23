<?php
 // Apabila user belum login
if (empty($_SESSION['username']) AND empty($_SESSION['password'])){
  echo "<center><h1>Untuk mengakses halaman, Anda harus login dulu.</h1></center>
        <p><center><a href=\"login\">LOGIN</a></center></p>";  
}
// Apabila user sudah login dengan benar, maka terbentuklah session
else{
require_once "config/koneksi.php";

	if ($_GET['module']=='beranda') {
		if ($_SESSION['leveluser']   == 'admin' or $_SESSION['leveluser']   == 'satpam' ) {
			if (isset($_POST['cari'])) {
				include "modul/mod_beranda/cari.php";
			}
			else{
				include "modul/mod_beranda/beranda.php";
			}			
		}
	}

	elseif ($_GET['module']=='user'){
		if ($_SESSION['leveluser']   == 'admin') {
			include "modul/mod_user/user.php";
		}else{
			echo "<center><h3>Anda tidak berhak mengakses halaman ini</h3></center>";
		}
	}

	elseif ($_GET['module']=='profile'){
		if ($_SESSION['leveluser']   == 'admin') {
			include "modul/mod_user/profile.php";
		}else{
			echo "<center><h3>Anda tidak berhak mengakses halaman ini</h3></center>";
		}
	}

	elseif ($_GET['module']=='mahasiswa'){
		if ($_SESSION['leveluser']   == 'admin') {
			include "modul/mod_mahasiswa/mahasiswa.php";
		}else{
			echo "<center><h3>Anda tidak berhak mengakses halaman ini</h3></center>";
		}
	}

	elseif ($_GET['module']=='absen') {
		if ($_SESSION['leveluser']   == 'admin' or $_SESSION['leveluser']   == 'satpam') {
			include "modul/mod_absensi/absen.php";
		}
	}
}
?>