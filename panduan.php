<?php
session_start();
require_once('inc/core/fungsi.php');

if(dia_dosen() || dia_mahasiswa()) {
  include_once('inc/core/header.php');
  include_once('inc/core/nav_menu.php');

  $baca = isset($_GET['baca'])  ? $_GET['baca'] : null;
  ?>
    <!-- Page Content -->
          <div id="page-wrapper">
              <div class="container-fluid">
                  <div class="row">
                      <div class="col-lg-12">
                          <h1 class="page-header"><i class="fa fa-book"></i> Panduan</h1>

                              <div class="panel panel-info">
                                  <?php
                                  switch($baca) {
                                    case 'unggah_berkas' :
                                      $konten = panduan(
                                                        'Mengunggah Berkas',
                                                        'success',
                                                        'warning',
                                                        'danger',
                                                        '1. Klik Pada Nama Akun',
                                                        '2. Isi Semua Formulir',
                                                        '3. Sandi Berhasil Diubah',
                                                        '<img src="assets/images/panduan/1a.png"><br>
                                                        <h3>..atau lewat navigasi kiri..<h3>
                                                        <img src="assets/images/panduan/1b.png">',
                                                        '<h3>..isi semua formulir dan klik "Perbarui"..<h3>
                                                        <img src="assets/images/panduan/2.png">',
                                                        '<img src="assets/images/panduan/3.png">
                                                        <h3>Selesai..<h3>'
                                                    );
                                      break;

                                      case 'ganti_pass' :
                                        $konten = panduan(
                                                          'Mengunggah Berkas',
                                                          'success',
                                                          'warning',
                                                          'danger',
                                                          '1. Klik Pada Nama Akun',
                                                          '2. Isi Semua Formulir',
                                                          '3. Sandi Berhasil Diubah',
                                                          '<img src="assets/images/panduan/1a.png"><br>
                                                          <h3>..atau lewat navigasi kiri..<h3>
                                                          <img src="assets/images/panduan/1b.png">',
                                                          '<h3>..isi semua formulir dan klik "Perbarui"..<h3>
                                                          <img src="assets/images/panduan/2.png">',
                                                          '<img src="assets/images/panduan/3.png">
                                                          <h3>Selesai..<h3>'
                                                      );
                                        break;
                                      default:
                                      lempar('?baca=unggah_berkas');
                                  }

                                  echo $konten;

                                ?>
                                <div class="panel-footer">
                                  <a class="btn btn-default btn-fw pull-left" href="index.php">
                                    <i class="fa  fa-times"></i> Tutup</a>
                                      <a class="btn btn-default btn-fw pull-right" href="panduan.php?baca=ganti_pass">
                                      Lanjut <i class="fa  fa-arrow-circle-right"></i></a>
                                    <a class="btn btn-default btn-fw pull-right" href="panduan.php?baca=unggah_berkas">
                                      <i class="fa  fa-arrow-circle-left"></i> Balik</a><br><br>
                                </div>
                              </div>
                      </div>
                  </div>
              </div>
          </div>

  <?php
  include_once('inc/core/footer.php');
} else
  lempar('masuk.php');
?>
