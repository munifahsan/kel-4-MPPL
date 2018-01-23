<?php
require_once "config/koneksi.php";
require_once "config/fungsi_antiinjection.php";

$username = anti_injection($_POST['username']);
$password = anti_injection($_POST['password']);

    // perlu dibuat sebarang pengacak
    //$pengacak  = "B4P@KUN!D490nToR102496B15M!LL4H";

    // mengenkripsi password dengan md5() dan pengacak
    //$pass_enkripsi = md5($pengacak . md5($password));

// menghindari sql injection
$injeksi_username = mysqli_real_escape_string($con, $username);
$injeksi_password = mysqli_real_escape_string($con, $password);

// pastikan username dan password adalah berupa huruf atau angka.
if (!ctype_alnum($injeksi_username) OR !ctype_alnum($injeksi_password)){
  echo "<h1>Sekarang loginnya tidak bisa di injeksi lho..</h1>";
    echo "<p><a href=\"login\">Ulangi Lagi</a></p>";
}
else{
  $query  = "SELECT * FROM tbuser WHERE username='$username' AND password='$password'";
  $login  = mysqli_query($con, $query);
  $ketemu = mysqli_num_rows($login);
  $r      = mysqli_fetch_array($login);

  // Apabila username dan password ditemukan (benar)
  if ($ketemu > 0){
    session_start();

    // bikin variabel session
    $_SESSION['id_user']     = $r['id_user'];
    $_SESSION['emailuser']   = $r['email'];
    $_SESSION['username']    = $r['username'];
    $_SESSION['passuser']    = $r['password'];
    $_SESSION['namalengkap'] = $r['nama_lengkap'];
    $_SESSION['leveluser']   = $r['level'];

    header("location:home");
  }
  else{
    echo "<h1>Login Gagal! Username & Password salah.</h1>";
    echo "<p><a href=\"login\">Ulangi Lagi</a></p>";
  }
}
?>
