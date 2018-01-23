<?php
session_start();
// Apabila user belum login
if (empty($_SESSION['username']) AND empty($_SESSION['password'])){
  echo "<center><h1>Untuk mengakses halaman, Anda harus login dulu.</h1></center>
        <p><center><a href=\"../../login\">LOGIN</a></center></p>";  
}
    // Apabila user sudah login dengan benar, maka terbentuklah session
else{
	require_once "../../config/koneksi.php";
	require_once "../../config/fungsi_antiinjection.php";


    $module = $_GET['module'];
  	$act	= $_GET['act'];

  	// Input user
	if ($module=='user' AND $act=='input'){
		$username     = anti_injection($_POST['username']);
		$password     = anti_injection($_POST['password']);
		$nama_lengkap = anti_injection($_POST['nama_lengkap']); 
		$email        = anti_injection($_POST['email']);
		$level        = anti_injection($_POST['level']);

		// perlu dibuat sebarang pengacak
		$pengacak  = "B4P@KUN!D490nToR102496B15M!LL4H";

		// mengenkripsi password dengan md5() dan pengacak
		$pass_enkripsi = md5($pengacak . md5($password));
			    
		$input = "INSERT INTO tbuser(id_user, username, 
			                            password, 
			                            email,
			                            nama_lengkap,
			                            level) 
				          VALUES(NULL,'$username','$pass_enkripsi','$email','$nama_lengkap','$level')";
		mysqli_query($con, $input);
		header("location:../../users");
	}

	// Update user
	elseif ($module=='user' AND $act=='update'){
		$id           = $_POST['id_user'];
		$username     = anti_injection($_POST['username']);
		$password     = anti_injection($_POST['password']);
		$nama_lengkap = anti_injection($_POST['nama_lengkap']); 
		$email        = anti_injection($_POST['email']);
		$level        = anti_injection($_POST['level']);

		// perlu dibuat sebarang pengacak
		$pengacak  = "B4P@KUN!D490nToR102496B15M!LL4H";

		// mengenkripsi password dengan md5() dan pengacak
		$pass_enkripsi = md5($pengacak . md5($password));
	 
	    // Apabila password tidak diubah (kosong)
		if (empty($password)) {
		    $update = "UPDATE tbuser SET nama_lengkap = '$nama_lengkap',
		                                    username = '$username',
		                                       email = '$email',
		                                       level = '$level'   
		                               WHERE id_user = '$id'";
		    mysqli_query($con, $update);
		}
		// Apabila password diubah
		else{
		    $update = "UPDATE tbuser SET nama_lengkap = '$nama_lengkap',
		      								username = '$username',
		                                    password = '$pass_enkripsi',
		                                       email = '$email',
		                                       level = '$level'   
		                               WHERE id_user = '$id'";
		    mysqli_query($con, $update);
		}
		//echo "masuk ke update";
		header("location:../../users");
	}

	// Delete User
	elseif($module=='user' AND $act=='delete'){
		//echo "data dihapus";
		mysqli_query($con, "DELETE FROM tbuser WHERE id_user='$_GET[id]'");
		header("location:../../users");
	}
}
?>