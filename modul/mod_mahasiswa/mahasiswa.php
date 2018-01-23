<?php
 // Apabila user belum login
if (empty($_SESSION['username']) AND empty($_SESSION['password'])){
  echo "<center><h1>Untuk mengakses halaman, Anda harus login dulu.</h1></center>
        <p><center><a href=\"index.php\">LOGIN</a></center></p>";  
}
// Apabila user sudah login dengan benar, maka terbentuklah session
else{

  $aksi = "modul/mod_mahasiswa/aksi_mahasiswa.php";

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
    // Tampil Mahasiswa
    default:
  
    $query  = "SELECT m.id_mahasiswa, m.nim, m.nama, f.nama_fak, p.nama_prodi, m.semester, m.kamar FROM tbmahasiswa m, prodi p, fakultas f WHERE p.id_prodi=m.id_prodi AND f.id_fak=m.id_fak ORDER BY m.id_mahasiswa;";
    $tampil = mysqli_query($con, $query);
?> 
                <div class="header">
                    <h2> Data Seluruh Mahasiswa UNIDA Gontor </h2>
                </div>
                <div class="body">
                <?php if (isset($_SESSION['username'])): ?>
                  <a href="add-mahasiswa" style="margin-bottom: 10px;" class="btn btn-md bg-green"><i class="material-icons">person_add</i><span> Add Mahasiswa</span></a>
                <?php endif; ?>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>NIM</th>
                                    <th>NAMA</th>
                                    <th>FAKULTAS</th>
                                    <th>PRODI</th>
                                    <th>SEMESTER</th>
                                    <th>KAMAR</th>
                                    <th>AKSI</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>NO</th>
                                    <th>NIM</th>
                                    <th>NAMA</th>
                                    <th>FAKULTAS</th>
                                    <th>PRODI</th>
                                    <th>SEMESTER</th>
                                    <th>KAMAR</th>
                                    <th>AKSI</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php
                                $no = 1;
                                while ($r=mysqli_fetch_array($tampil)){
                                ?>
                                <tr>
                                    <td align="center"><?php echo $no; ?></td>
                                    <td><?php echo $r['nim']?></td>
                                    <td><?php echo $r['nama']?></td>
                                    <td><?php echo $r['nama_fak']?></td>
                                    <td><?php echo $r['nama_prodi']?></td>
                                    <td><?php echo $r['semester']?></td>
                                    <td><?php echo $r['kamar']?></td>
                                    <td>
                                        <a class="tip-top" title="Edit" <?php echo "href=\"edit-mahasiswa-$r[id_mahasiswa]\""; ?>><i class="material-icons">edit</i></a> 
                                        <a class="tip-top" title="Delete" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')" <?php echo "href=\"$aksi?module=mahasiswa&act=delete&id=$r[id_mahasiswa]\""; ?>><i class="material-icons">delete_forever</i></a>
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

     //Tambah Data Mahasiwwa
    case "tambah":
    ?>          
                <div class="header">
                  <h2>Masukkan Data Mahasiswa</h2>
                </div>
                <div class="body">
                  <form id="form_validation" method="POST" <?php echo "action=\"$aksi?module=mahasiswa&act=input\""; ?>>
                    <div class="row clearfix">
                      <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                        <label>NIM</label>
                      </div>
                      <div class="col-lg-9 col-md-9 col-sm-6 col-xs-5">
                        <div class="form-group">
                          <div class="form-line">
                            <input type="text" class="form-control" name="nim" required>
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
                            <input type="text" class="form-control" name="nama" required>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row clearfix">
                      <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                        <label>Fakultas</label>
                      </div>
                      <div class="col-lg-9 col-md-9 col-sm-6 col-xs-5">
                        <div class="form-group">
                          <div class="form-line">
                            <select class="form-control" name="fakultas" required>
                              <option>- Pilih Fakultas -</option>
                                <?php
                                  $fakultas = mysqli_query($con, "SELECT * FROM fakultas ORDER BY nama_fak");
                                  while($p=mysqli_fetch_array($fakultas)){
                                  echo "<option value=\"$p[id_fak]\">$p[nama_fak]</option>\n";
                                  }
                                ?>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row clearfix">
                      <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                        <label>Prodi</label>
                      </div>
                      <div class="col-lg-9 col-md-9 col-sm-6 col-xs-5">
                        <div class="form-group">
                          <div class="form-line">
                            <select class="form-control" name="prodi">
                              <option selected="selected">- Pilih Prodi -</option>
                                <?php
                                  $prodi = mysqli_query($con, "SELECT * FROM prodi ORDER BY nama_prodi");
                                  while($p=mysqli_fetch_array($prodi)){
                                  echo "<option value=\"$p[id_prodi]\">$p[nama_prodi]</option>\n";
                                  }
                                ?>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row clearfix">
                      <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                        <label>Semester</label>
                      </div>
                      <div class="col-lg-9 col-md-9 col-sm-6 col-xs-5">
                        <div class="form-group">
                          <div class="form-line">
                            <input type="text" class="form-control" name="semester" required>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row clearfix">
                      <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                        <label>Kamar</label>
                      </div>
                      <div class="col-lg-9 col-md-9 col-sm-6 col-xs-5">
                        <div class="form-group">
                          <div class="form-line">
                            <input type="text" class="form-control" name="kamar" required>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row clearfix">
                      <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                        <label>Alamat</label>
                      </div>
                      <div class="col-lg-9 col-md-9 col-sm-6 col-xs-5">
                        <div class="form-group">
                          <div class="form-line">
                            <input type="text" class="form-control" name="alamat" required>
                          </div>
                        </div>
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-xs-9 p-t-5">
                            
                        </div>
                        <div class="col-xs-3">
                            <button class="btn btn-success waves-effect" type="submit"><i class="material-icons">save</i><span>SAVE</span></button>
                            <button type="reset" class="btn btn-warning"><i class="material-icons">delete</i><span>RESET</span></button>
                            <button type="button" class="btn btn-danger" onclick="window.location = 'data-mahasiswa';"><i class="material-icons">cancel</i><span>BATAL</span></button>
                        </div>
                    </div>
                  </form>
                </div>
    <?php
    break;

    //Edit Data Mahasiwwa
    case "edit":
      $query = "SELECT * FROM tbmahasiswa m, prodi p, fakultas f WHERE p.id_prodi=m.id_prodi AND f.id_fak=m.id_fak AND m.id_mahasiswa='$_GET[id]'";
      $hasil = mysqli_query($con, $query);

      //cek error pada database
      if (!$hasil) {
        printf("Error: %s\n", mysqli_error($con));
      exit();
}
      $r     = mysqli_fetch_array($hasil);
    ?>
              <div class="header">
                  <h2>Edit Data Mahasisa</h2>
                </div>
                <div class="body">
                  <form id="form_validation" method="POST" <?php echo "action=\"$aksi?module=mahasiswa&act=update\""; ?>>
                    <!-- text input -->
                    <input type="hidden" name="id" value="<?php echo $r['id_mahasiswa']; ?>">
                    <div class="row clearfix">
                      <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                        <label>NIM</label>
                      </div>
                      <div class="col-lg-9 col-md-9 col-sm-6 col-xs-5">
                        <div class="form-group">
                          <div class="form-line">
                            <input type="text" class="form-control" name="nim" value="<?php echo $r['nim'] ?>" required>
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
                            <input type="text" class="form-control" name="nama" value="<?php echo $r['nama'] ?>" required>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row clearfix">
                      <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                        <label>Fakultas</label>
                      </div>
                      <div class="col-lg-9 col-md-9 col-sm-6 col-xs-5">
                        <div class="form-group">
                          <div class="form-line">
                            <select name="fakultas" class="form-control" required>
                              <?php
                              if ($r['id_fak']==0){
                              ?>
                                  <option value="0" selected>- Pilih Fakultas -</option>
                              <?php
                              }   
                              
                                $fakultas = mysqli_query($con, "SELECT * FROM fakultas ORDER BY id_fak");
                                while($p=mysqli_fetch_array($fakultas)){
                                  if ($r['id_fak']==$p['id_fak']){
                                    echo "<option value=\"$p[id_fak]\" selected>$p[nama_fak]</option>";
                                  }
                                  else{
                                    echo "<option value=\"$p[id_fak]\">$p[nama_fak]</option>";
                                  }
                                }
                              ?>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row clearfix">
                      <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                        <label>Prodi</label>
                      </div>
                      <div class="col-lg-9 col-md-9 col-sm-6 col-xs-5">
                        <div class="form-group">
                          <div class="form-line">
                            <select name="prodi" class="form-control" required="">
                            <?php
                              if ($r['id_prodi']==0){
                              ?>
                                  <option value="0" selected>- Pilih Prodi -</option>
                              <?php
                              }   
                              
                                $prodi = mysqli_query($con, "SELECT * FROM prodi  ORDER BY id_prodi");
                                while($p=mysqli_fetch_array($prodi)){
                                  if ($r['id_prodi']==$p['id_prodi']){
                                    echo "<option value=\"$p[id_prodi]\" selected>$p[nama_prodi]</option>";
                                  }
                                  else{
                                    echo "<option value=\"$p[id_prodi]\">$p[nama_prodi]</option>";
                                  }
                                }
                              ?>
                        </select>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row clearfix">
                      <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                        <label>Semester</label>
                      </div>
                      <div class="col-lg-9 col-md-9 col-sm-6 col-xs-5">
                        <div class="form-group">
                          <div class="form-line">
                            <input type="text" class="form-control" name="semester" value="<?php echo $r['semester'] ?>" required>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row clearfix">
                      <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                        <label>Kamar</label>
                      </div>
                      <div class="col-lg-9 col-md-9 col-sm-6 col-xs-5">
                        <div class="form-group">
                          <div class="form-line">
                            <input type="text" class="form-control" name="kamar" value="<?php echo $r['kamar'] ?>" required>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row clearfix">
                      <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                        <label>Alamat</label>
                      </div>
                      <div class="col-lg-9 col-md-9 col-sm-6 col-xs-5">
                        <div class="form-group">
                          <div class="form-line">
                            <input type="text" class="form-control" name="alamat" value="<?php echo $r['alamat'] ?>" required>
                          </div>
                        </div>
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-xs-9 p-t-5">
                            
                        </div>
                        <div class="col-xs-3">
                            <button class="btn btn-success waves-effect" type="submit"><i class="material-icons">save</i><span>SAVE</span></button>
                            <button type="reset" class="btn btn-warning"><i class="material-icons">delete</i><span>RESET</span></button>
                            <button type="button" class="btn btn-danger" onclick="window.location = 'data-mahasiswa';"><i class="material-icons">cancel</i><span>BATAL</span></button>
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