<?php
session_start();
require_once('inc/core/fungsi.php');
if(dia_dosen() || dia_mahasiswa()) {
  include_once('inc/core/header.php');
  include_once('inc/core/nav_menu.php');

  $kamu = explode(' ', $_SESSION['nama']);
  $kamu = $kamu[0];
  ?>
          <!-- Page Content -->
          <div id="page-wrapper">
              <div class="container-fluid">
                  <div class="row">
                      <div class="col-lg-12">
                          <h1 class="page-header"><i class="fa fa-dashboard"></i> Dasbor</h1>
                          <?php pengumuman(); ?>
                          <div class="jumbotron">
                        <h1><i class="fa fa-thumbs-o-up"></i> Halo, <?php echo $kamu; ?>!</h1>
                        <p>
                          Selamat datang di MyCloud. Gunakan menu di sisi kiri layar anda untuk mengelola berkas, menyunting akun serta mengubah kata sandi anda, atau sempatkan waktu anda sejenak untuk membaca panduan penggunaan.
                        </p><br><br>
                        <p><a class="btn btn-primary btn-lg" role="button" href="panduan.php"><i class="fa fa-github"></i> Baca panduan</a> ..atau.. <a class="btn btn-success btn-lg" role="button" href="akun.php?aksi=unggah_berkas"><i class="fa fa-upload"></i> Unggah berkas</a>
                        </p>
                    </div>
                      </div>
                  </div>
              </div>
          </div>

  <?php
  include_once('inc/core/footer.php');
} else {
  lempar('masuk.php');
}
?>
