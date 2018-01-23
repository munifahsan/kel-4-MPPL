<?php
 // Apabila user belum login
if (empty($_SESSION['username']) AND empty($_SESSION['password'])){
  echo "<center><h1>Untuk mengakses halaman, Anda harus login dulu.</h1></center>
        <p><center><a href=\"../../login\">LOGIN</a></center></p>";  
}
// Apabila user sudah login dengan benar, maka terbentuklah session
else{

  $aksi = "modul/mod_user/aksi_user.php";

  // mengatasi variabel yang belum di definisikan (notice undefined index)
  $act = isset($_GET['act']) ? $_GET['act'] : '';
?>
<div class="container-fluid"> 
  <!-- Exportable Table -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
<?php
  switch($act){
    // Tampil User 
    default:
  
    $query  = "SELECT * FROM tbuser ORDER BY id_user";
    $tampil = mysqli_query($con, $query);
?>
                <div class="header">
                    <h2> Data User </h2>
                    
                </div>
                <div class="body">
                <?php if (isset($_SESSION['username'])): ?>
                  <a href="add-user" style="margin-bottom: 10px;" class="btn btn-md bg-green"><i class="material-icons">person_add</i><span> Add User</span></a>
                <?php endif; ?>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                  <th>NO</th>
                                  <th>NAMA</th>
                                  <th>USERNAME</th>
                                  <th>PASSWORD</th>
                                  <th>EMAIL</th>
                                  <th>LEVEL</th>
                                  <th>AKSI</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                  <th>NO</th>
                                  <th>NAMA</th>
                                  <th>USERNAME</th>
                                  <th>PASSWORD</th>
                                  <th>EMAIL</th>
                                  <th>LEVEL</th>
                                  <th>AKSI</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php
                                $no = 1;
                                while ($r=mysqli_fetch_array($tampil)){
                                ?>
                                <tr>
                                    <td align="center" "><?php echo $no; ?></td>          
                                    <td><?php echo $r['nama_lengkap']?></td>
                                    <td><?php echo $r['username']?></td>
                                    <td><?php echo $r['password']?></td>
                                    <td><?php echo $r['email']?></td>
                                    <td><?php echo $r['level']?></td>
                                    <td>
                                      <a class="tip-top" title="Edit" <?php echo "href=\"edit-user-$r[id_user]\""; ?>><i class="material-icons">edit</i></a> 
                                      <a class="tip-top" title="Delete" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')" <?php echo "href=\"$aksi?module=user&act=delete&id=$r[id_user]\""; ?>><i class="material-icons">delete_forever</i></a></td>
                                    </td>
                                </tr>
                                <?php
                            $no++;
                        }
                        ?>
                            </tbody>
                        </table>
                    </div>
                </div>
    <?php
    break;

    case "tambahuser":
    ?>
                <div class="header">
                  <h2>Masukkan Data User</h2>
                </div>
                <div class="body">
                  <form id="form_validation" method="POST" <?php echo "action=\"$aksi?module=user&act=input\""; ?>>
                    <div class="row clearfix">
                      <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                        <label>Username</label>
                      </div>
                      <div class="col-lg-9 col-md-9 col-sm-6 col-xs-5">
                        <div class="form-group">
                          <div class="form-line">
                            <input type="text" class="form-control" name="username" required>
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
                            <input type="text" class="form-control" name="nama_lengkap" required>
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
                            <input type="email" class="form-control" name="email" required>
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
                            <input type="password" class="form-control" name="password" required>
                          </div>
                        </div>
                      </div>
                    </div>
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
                              <option value="satpam">Satpam</option>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
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
    <?php
    break;

    case "edituser":
      $query = "SELECT * FROM tbuser WHERE id_user='$_GET[id]'";
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
    <?php
    break;
  }
    ?>
            </div>
        </div>
    </div>
    <!-- #END# Exportable Table -->
</div>
<?php
}
?>