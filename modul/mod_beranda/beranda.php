<?php
 // Apabila user belum login
if (empty($_SESSION['username']) AND empty($_SESSION['password'])){
  echo "<center><h1>Untuk mengakses halaman, Anda harus login dulu.</h1></center>
        <p><center><a href=\"../../index.php\">LOGIN</a></center></p>";  
}
// Apabila user sudah login dengan benar, maka terbentuklah session
else{

?> 
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
                    <h2 class="card-inside-title">Masukkan NIM </h2>
                    <div class="row clearfix">
                        <div class="col-sm-12">
                            <form method="POST" action="">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="carinim" class="form-control" pplaceholder="Type NIM Here .." autofocus="">
                                    </div>
                                </div>
                                <input type="submit" name="cari" value="SEARCH" class="btn btn-lg btn-success" />         
                            </form>
                        </div>
                    </div>      
                </div>
            </div>
        </div>
    </div>
</div>
<?php
}
?>