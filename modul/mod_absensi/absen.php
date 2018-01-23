<?php
 // Apabila user belum login
if (empty($_SESSION['username']) AND empty($_SESSION['password'])){
  echo "<center><h1>Untuk mengakses halaman, Anda harus login dulu.</h1></center>
        <p><center><a href=\"index.php\">LOGIN</a></center></p>";  
}
// Apabila user sudah login dengan benar, maka terbentuklah session
else{

	$aksi = "modul/mod_absensi/aksi_absen.php";

  	// mengatasi variabel yang belum di definisikan (notice undefined index)
  	$act = isset($_GET['act']) ? $_GET['act'] : '';
	
	$query  = "SELECT b.nim, b.nama, c.nama_fak, e.nama_prodi, b.kamar, a.waktu_keluar, a.waktu_masuk, a.id_absen, a.alasan from tbabsen a, tbmahasiswa b, fakultas c, prodi e where a.id_mahasiswa=b.id_mahasiswa and c.id_fak=b.id_fak and e.id_prodi=b.id_prodi ORDER BY a.id_absen";
	    
	$tampil = mysqli_query($con, $query);

?> 
<div class="container-fluid"> 
	<!-- Exportable Table -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2> Data Mahasiswa Check In and Check Out </h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>NIM</th>
                                    <th>NAMA</th>
                                    <th>FAKULTAS</th>
                                    <th>PRODI</th>
                                    <th>KAMAR</th>
                                    <th>ALASAN</th>
                                    <th>WAKTU KELUAR</th>
                                    <th>WAKTU MASUK</th>
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
                                    <th>KAMAR</th>
                                    <th>ALASAN</th>
                                    <th>WAKTU KELUAR</th>
                                    <th>WAKTU MASUK</th>
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
                                    <td><?php echo $r['kamar']?></td>
                                    <td><?php echo $r['alasan']?> </td>
                                    <td><?php echo $r['waktu_keluar']?></td>
                                    <td><?php echo $r['waktu_masuk']?></td>
                                    <td align="center">
                                        <a class="tip-top" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')" data-original-title="Delete" <?php echo "href=\"$aksi?module=absen&act=delete&id=$r[id_absen]\""; ?>>
                                        	<i class="material-icons">delete_forever</i>
                                        </a>
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
            </div>
        </div>
    </div>
    <!-- #END# Exportable Table -->
</div>
<?php
}
?>