<?php
session_start();
// Apabila user belum login
if (empty($_SESSION['username']) AND empty($_SESSION['password'])){
   echo "<link href=\"assets/css/style_login.css\" rel=\"stylesheet\" type=\"text/css\" />
        <div id=\"login\"><center><h1 class=\"fail\">Untuk mengakses halaman, Anda harus login dulu.</h1></center>
        <p class=\"fail\"><center><a href=\"index.php\">LOGIN</a></center></p></div>";
}
    // Apabila user sudah login dengan benar, maka terbentuklah session
else{
	require_once('../../config/koneksi.php');
	require_once "../../config/fungsi_antiinjection.php";

    $module = $_GET['module'];
  	$act	= $_GET['act'];

  	// Input user
	if ($module=='mahasiswa' AND $act=='input'){
		//echo "masuk";
		$nim          = $_POST['nim'];
		$nama         = anti_injection($_POST['nama']);
		$fakultas     = anti_injection($_POST['fakultas']);
		$prodi        = anti_injection($_POST['prodi']);
		$kamar        = anti_injection($_POST['kamar']);
		$alamat       = anti_injection($_POST['alamat']);



		$input = "INSERT INTO tbmahasiswa(nim,
			                            nama,
			                            id_fak,
			                            id_prodi,
			                            kamar,
			                            alamat)
				          VALUES('$nim',
			                         '$nama',
			                         '$fakultas',
			                          '$prodi',
			                          '$kamar',
			                          '$alamat')";
		mysqli_query($con, $input);
		header("location:../../data-mahasiswa");
	}

	// Update mahasiswa
	elseif ($module=='mahasiswa' AND $act=='update'){
		$id 		  = $_POST['id'];
		$nim          = $_POST['nim'];
		$nama         = anti_injection($_POST['nama']);
		$fakultas       = anti_injection($_POST['fakultas']);
		$prodi     = anti_injection($_POST['prodi']);
		$kamar        = anti_injection($_POST['kamar']);
		$alamat       = anti_injection($_POST['alamat']);


		$update = "UPDATE tbmahasiswa SET   nim      = '$_POST[nim]',
											                  nama     = '$nama',
		      								              id_fak   = '$fakultas',
		                                    id_prodi = '$prodi',
		                                    kamar    = '$kamar',
		                                    alamat   = '$alamat'
		                               WHERE id_mahasiswa = '$id'";
		mysqli_query($con, $update);

		header("location:../../data-mahasiswa");
	}

	// Delete User
	elseif($module=='mahasiswa' AND $act=='delete'){
		//echo "data dihapus";
		mysqli_query($con, "DELETE FROM tbmahasiswa WHERE id_mahasiswa='$_GET[id]'");
		header("location:../../data-mahasiswa");
	}
}
?>
