<?php
session_start(); 
// Apabila user belum login
if (empty($_SESSION['username']) AND empty($_SESSION['password'])){
    echo "<center><h1>Untuk mengakses halaman, Anda harus login dulu.</h1></center>
        <p><center><a href=\"../../index.php\">LOGIN</a></center></p>";  
}
    // Apabila user sudah login dengan benar, maka terbentuklah session
else{
	require_once "../../config/koneksi.php";
  require_once "../../config/fungsi_antiinjection.php";
	//membuat fungsi anti injeksi
		/*function menghalangi_injection($data)
		{
	  		$validasi_input = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
	  		return $validasi_input;
		}*/

    $module = $_GET['module'];
  	$act	= $_GET['act'];
  	$id 	= $_POST['id_mahasiswa'];// 16
  	$keluar = $_POST['waktu_keluar'];
  	$masuk  = $_POST['waktu_masuk'];
  	//$status = $_POST['status'];
  	//echo "$id";//33
  	$caridata  = mysqli_query($con, "SELECT * FROM tbabsen WHERE id_mahasiswa = '$id'"); //33
  	$ambildata = mysqli_num_rows($caridata);

  	$caristatus  = mysqli_query($con, "SELECT status FROM tbabsen WHERE id_mahasiswa = '$id' AND waktu_masuk = '0000-00-00 00:00:00'"); //33
  	$ambilstatus = mysqli_fetch_array($caristatus);

  	$absen  = mysqli_query($con, "SELECT id_absen FROM tbabsen WHERE id_mahasiswa = '$id' AND status = '0'");
  	$ambilabsen = mysqli_fetch_array($absen);
  	
  		$a = mysqli_fetch_array($caridata);
  		//echo $a['id_absen'];
  		//echo"<br>";
  		//echo $a['waktu_keluar'];
  		if($ambilstatus['status'] == '0'){
  			if ($module=='beranda' AND $act=='input'){
	  		$update = "UPDATE tbabsen SET waktu_masuk = NOW(), status = '1' WHERE id_absen = '$ambilabsen[id_absen]'";
	  		mysqli_query($con, $update);
	  		echo "<script>alert('Data telah diubah, Anda telah kembali.');
			window.location = '../../media.php?module=beranda'</script>";
	  		}
  		} else{
  			if ($module=='beranda' AND $act=='input'){
			$id           = $_POST['id_mahasiswa'];
			$alasan       = anti_injection($_POST['alasan']);
			
			//$waktu_masuk  = menghalangi_injection($_POST['waktu_masuk']);
			//echo $id;
			$input = "INSERT INTO tbabsen (id_mahasiswa, alasan, waktu_keluar, waktu_masuk, status) VALUES ('$id', '$alasan', NOW(), 'NULL', '0')";
			mysqli_query($con, $input) or die (mysqli_error($con)); 
			echo "<script>alert('Data Tersimpan, Silahkan keluar.');
			window.location = '../../media.php?module=beranda'</script>";
			}
  		}
  	//}
  	/*else{
	  	echo "<script>alert('Data absen tidak terditemukan');
			window.location = '../../media.php?module=beranda'</script>";
  	}*/

  	
}
?>