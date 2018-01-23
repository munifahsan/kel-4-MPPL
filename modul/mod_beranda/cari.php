<div class="container-fluid">      
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Check In and Check Out
                    </h2>
                </div>
                <div class="body">
                    <div class="row clearfix">
                        <div class="col-sm-12">
                            <?php
                            $input_cari = @$_POST['carinim']; 
                            $cari = @$_POST['cari'];

                            if($input_cari != "") {
                                // query mysql untuk mencari berdasarkan nim. .
                                $sql = mysqli_query($con, "SELECT tbmahasiswa.id_mahasiswa, tbmahasiswa.nim, tbmahasiswa.nama, fakultas.nama_fak, prodi.nama_prodi, tbmahasiswa.semester, tbmahasiswa.alamat, tbmahasiswa.kamar FROM tbmahasiswa, prodi, fakultas where prodi.id_prodi=tbmahasiswa.id_prodi and fakultas.id_fak=tbmahasiswa.id_fak and nim like '%$input_cari%'") or die (mysqli_error()); 
                                // mengecek data
                                $cek = mysqli_num_rows($sql);

                                if($cek < 1) {
                                ?>
                                    <div class="form-group">
                                        <center>
                                            <h3>Data Tidak Ditemukan</h3>
                                            <button type="button" class="btn btn-primary m-t-15 waves-effect" onclick="self.history.back()">KEMBALI</button>
                                        </center>
                                    </div>
                                <?php
                                }
                                else {
                                    $r=mysqli_fetch_array($sql);
                                    $aksi="modul/mod_beranda/aksi_beranda.php";

                                    //update
                                    $panggil=mysqli_query($con, "select * from tbabsen where id_mahasiswa='$r[id_mahasiswa]'");//17
                                    $panggil2 = mysqli_fetch_array($panggil);
                                ?>
                                    <center>
                                       <h3>Data Mahasiswa Ditemukan </h3><br><br> 
                                       <div id="aniimated-thumbnials" class="list-unstyled row clearfix">
                                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                <a href="images/no-user.jpg" data-sub-html="<?php echo $r['nama'] ?>">
                                                    <img class="img-responsive thumbnail" src="images/no-user.jpg" width="60%" height="60%">
                                                </a>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                            </div>
                                        </div>
                                    </center>
                                    <form role="form" method="post" class="form-horizontal" <?php echo "action=\"$aksi?module=beranda&act=input\""; ?>>
                                                       
                                    
                                        <input type="hidden" name="id_mahasiswa" value="<?php echo $r['id_mahasiswa'] ?>" />
                                        <input type="hidden" name="id_absen" value="<?php echo $panggil2['id_absen'] ?>" />
                                        <input type="hidden" name="waktu_keluar" value="<?php echo $panggil2['waktu_keluar'] ?>" />
                                        <input type="hidden" name="waktu_masuk" value="<?php echo $panggil2['waktu_masuk'] ?>" />
                                    
                                        
                                        <div class="row clearfix">
                                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                <label for="email_address_2">NIM</label>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-6 col-xs-5">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" disabled="" class="form-control" value="<?php echo $r['nim'] ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row clearfix">
                                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                <label for="email_address_2">Nama</label>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-6 col-xs-5">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" disabled="" class="form-control" value="<?php echo $r['nama'] ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row clearfix">
                                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                <label for="email_address_2">Fakultas</label>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-6 col-xs-5">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" disabled="" class="form-control" value="<?php echo $r['nama_fak'] ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row clearfix">
                                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                <label for="email_address_2">prodi</label>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-6 col-xs-5">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" disabled="" class="form-control" value="<?php echo $r['nama_prodi'] ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row clearfix">
                                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                <label for="email_address_2">Kamar</label>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-6 col-xs-5">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" disabled="" class="form-control" value="<?php echo $r['kamar'] ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row clearfix">
                                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                <label for="email_address_2">Alamat</label>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-6 col-xs-5">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" disabled="" class="form-control" value="<?php echo $r['alamat'] ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row clearfix">
                                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                <label for="email_address_2">Alasan</label>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-6 col-xs-5">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <select class="form-control" name="alasan">
                                                            <option>Pilih</option>
                                                            <option value="Ke Kota Ponorogo">Ke Kota Ponorogo</option>
                                                            <option value="Ke Madiun">Ke Madiun</option>
                                                            <option value="Terminal">Terminal</option>
                                                            <option value="Stasiun">Stasiun</option>
                                                            <option value="Ngambil Uang">Ngambil Uang</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row clearfix">
                                            <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                                <button type="submit" class="btn btn-success m-t-15 waves-effect"><i class="material-icons">save</i> <span>BOLEH</span></button>
                                                <button type="button" class="btn btn-warning m-t-15 waves-effect" onclick="self.history.back()"><i class="material-icons">cancel</i> <span>TIDAK</span></button>
                                            </div>
                                        </div>
                                    </form>
                                <?php
                                }
                            } 
                            else {
                                $sql = mysqli_query($con, "SELECT * FROM tbmahasiswa") or die (mysqli_error());
                            }
                            ?>
                        </div>
                    </div>      
                </div>
            </div>
        </div>
    </div>
</div>
