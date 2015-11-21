<?php
include_once('inc/core/konek.php');
require_once('inc/core/fungsi.php');

if(dia_dosen() || dia_mahasiswa()) {
  include_once('inc/core/header.php');
  include_once('inc/core/nav_menu.php');
?>
          <!-- Page Content -->
          <div id="page-wrapper">
              <div class="container-fluid">
                  <div class="row">
                      <div class="col-lg-12">
                          <h1 class="page-header"><i class="fa fa-tasks"></i> Unggah berkas</h1>

                              <div class="panel panel-info">
                                  <div class="panel-heading">
                                    <i class="fa fa-upload"></i> <b>Formulir unggah berkas</b>
                                  </div>
                                <div class="panel-body">
                                  <div class="alert alert-warning alert-dismissible" role="alert">
                                      <button type="button" class="close" data-dismiss="alert" aria-label="Tutup">
                                      <span aria-hidden="true">&times;</span></button>
                                      <i class="fa fa-warning"></i>
                                      Untuk sementara, jenis berkas yang diijinkan hanya:<br>
                                      <b>zip, rar, 7z, tar, bz, bz2, tar.bz2, tar.gz, gz</b><br>
                                      ukuran berkas minimal <b>1 KiB</b> dan maksimal <b>10 MiB</b>.
                                  </div>
                                    <form role="form" action="akun.php?aksi=unggah_berkas" method="post" enctype="multipart/form-data">
                                            <fieldset>
                                              <div class="input-group">
                                                <input type="hidden" name="MAX_FILE_SIZE" value="10485760">
                                                  <input name="berkas" id="btn-input" type="file" class="form-control input-sm" placeholder="Pilih berkas..">
                                                    <span class="input-group-btn">
                                                  <button class="btn btn-success btn-sm" id="btn-chat" name="unggah">
                                                    Unggah</button>
                                                </span>
                                              </div><br><br>
                                            </fieldset>
                                            <?php

                                            if(isset($_POST['unggah'])) {
                                              if($_FILES['berkas']['size'] > 1024 && $_FILES['berkas']['size'] < 10485760) { // 1024 byte = 1 KiB, 10485760 byte = 10 MiB
                                                $f_nama   = $_FILES['berkas']['name'];
                                                $f_nm_tmp = $_FILES['berkas']['tmp_name'];
                                                $f_ukuran = $_FILES['berkas']['size'];
                                                $f_tgl    = date('d M, Y');
                                                $f_tipe   = pathinfo($f_nama, PATHINFO_EXTENSION);
                                                $f_tipe   = (get_magic_quotes_gpc() == 0 ? mysql_real_escape_string(pathinfo($f_nama, PATHINFO_EXTENSION)) : mysql_real_escape_string(stripslashes($_FILES['berkas'])));

                                                $tipe_diizinkan = array(
                                                                    'zip',
                                                                    'rar',
                                                                    '7z',
                                                                    'tar',
                                                                    'bz',
                                                                    'bz2',
                                                                    'tar.bz2',
                                                                    'tar.gz',
                                                                    'gz'
                                                                  );

                                                if(!get_magic_quotes_gpc())
                                                  $f_nama = addslashes($f_nama);
                                                if(in_array($f_tipe, $tipe_diizinkan)) {
                                                  $f_nama = str_replace(' ', '_', $f_nama);
                                                  $f_nama = preg_replace('/[^a-zA-Z0-9_.-]/', '', $f_nama);
                                                  $f_nama = parse($f_nama);
                                                  $uid    = $_SESSION['id'];
                                                  $url    = 'berkas/mhs-'. $uid . '/' .$f_nama;
                                                  $pndh   = move_uploaded_file($f_nm_tmp, $url);
                                                  chmod($url, 0666);

                                                  if($pndh) {
                                                    $q      = mysql_query("insert into berkas (uid, fnama, url, ukuran, ftipe, ftanggal) values (". $uid .", '" . $f_nama . "', '" . $url . "', '" . $f_ukuran . "', '" . $f_tipe . "', '" . $f_tgl . "');");
                                                    if($q) {
                                                      pesan('success', 'Berkas <b>' . $f_nama .' (' . bulatkan($f_ukuran) .')</b> berhasil diunggah.');
                                                    } else {
                                                      pesan('danger', 'Upload gagal. Kesalalahn query ke database.');
                                                      if(file_exists($url))
                                                        unlink($url);
                                                    }
                                                  } else {
                                                    pesan('danger', 'Gagal memindahkan berkas. Cek hak akses direktori berkas.');
                                                  }
                                                } else {
                                                    pesan('danger', 'Berkas tipe ini tidak diijinkan.');
                                                }
                                              } else {
                                                pesan('danger', 'Ukuran berkas harus lebih dari 1 KiB dan kurang dari 10 MiB');
                                              }
                                        } //isset unggah
                                            ?>


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
