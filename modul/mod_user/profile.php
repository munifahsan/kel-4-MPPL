<?php
 // Apabila user belum login
if (empty($_SESSION['username']) AND empty($_SESSION['password'])){
  echo "<center><h1>Untuk mengakses halaman, Anda harus login dulu.</h1></center>
        <p><center><a href=\"../../login\">LOGIN</a></center></p>";  
}
// Apabila user sudah login dengan benar, maka terbentuklah session
else{

  $aksi = "modul/mod_user/aksi_user.php";


?>
<div class="container-fluid"> 
  <!-- Exportable Table -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
    <?php

      $query = "SELECT * FROM tbuser WHERE id_user='$_SESSION[id_user]'";
      $hasil = mysqli_query($con, $query);

      //cek error pada database
      if (!$hasil) {
        printf("Error: %s\n", mysqli_error($con));
      exit();
}
      $r     = mysqli_fetch_array($hasil);
    ?>
              <div class="header">
                  <h2>Edit Data User</h2>
                </div>
                <div class="body">
                  <form id="form_validation" method="POST" <?php echo "action=\"$aksi?module=user&act=update\""; ?>>
                    <!-- text input -->
                    <input type="hidden" name="id_user" value="<?php echo $r['id_user']; ?>">
                    
                    <div class="row clearfix">
                      <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                        <label>Username</label>
                      </div>
                      <div class="col-lg-9 col-md-9 col-sm-6 col-xs-5">
                        <div class="form-group">
                          <div class="form-line">
                            <input type="text" class="form-control" name="username" value="<?php echo $r['username'] ?>" required>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row clearfix">
                      <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                        <label>Nama Lengkap</label>
                      </div>
                      <div class="col-lg-9 col-md-9 col-sm-6 col-xs-5">
                        <div class="form-group">
                          <div class="form-line">
                            <input type="text" class="form-control" name="nama_lengkap" value="<?php echo $r['nama_lengkap'] ?>" required>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row clearfix">
                      <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                        <label>Email</label>
                      </div>
                      <div class="col-lg-9 col-md-9 col-sm-6 col-xs-5">
                        <div class="form-group">
                          <div class="form-line">
                            <input type="email" class="form-control" name="email" value="<?php echo $r['email'] ?>" required>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row clearfix">
                      <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                        <label>Password</label>
                      </div>
                      <div class="col-lg-9 col-md-9 col-sm-6 col-xs-5">
                        <div class="form-group">
                          <div class="form-line">
                            <input type="password" class="form-control" name="password" placeholder="*Jika password tidak diganti, maka kosongkan saja.">
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php
                    if ($r['level']=='admin') {
                    ?>
                    <div class="row clearfix">
                      <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                        <label>Level</label>
                      </div>
                      <div class="col-lg-9 col-md-9 col-sm-6 col-xs-5">
                        <div class="form-group">
                          <div class="form-line">
                            <select class="form-control" name="level" required="">
                              <option>Pilih Level</option>
                              <option value="admin" selected>Admin</option>
                              <option value="satpam">Satpam</option>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php
                    }
                    else{
                    ?>
                    <div class="row clearfix">
                      <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                        <label>Level</label>
                      </div>
                      <div class="col-lg-9 col-md-9 col-sm-6 col-xs-5">
                        <div class="form-group">
                          <div class="form-line">
                            <select class="form-control" name="level" required="">
                              <option>Pilih Level</option>
                              <option value="admin">Admin</option>
                              <option value="satpam" selected>Satpam</option>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php
                    }
                    ?>
                    
                    <div class="row">
                        <div class="col-xs-9 p-t-5">
                        </div>
                        <div class="col-xs-3">
                            <button class="btn btn-success waves-effect" type="submit"><i class="material-icons">save</i><span>SAVE</span></button>
                            <button type="reset" class="btn btn-warning"><i class="material-icons">delete</i><span>RESET</span></button>
                            <button type="button" class="btn btn-danger" onclick="window.location = 'users';"><i class="material-icons">cancel</i><span>BATAL</span></button>
                        </div>
                    </div>
                  </form>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Exportable Table -->
</div>
<?php
}
?>