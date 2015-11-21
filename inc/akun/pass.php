<?php
require_once('inc/core/konek.php');
require_once('inc/core/fungsi.php');

if(dia_dosen() || dia_mahasiswa()) {
  include_once('inc/core/header.php');
  include_once('inc/core/nav_menu.php');

  $dt_nama  = isset($dt_nama)    ? $dt_nama  : null;
  $dt_email = isset($dt_email)   ? $dt_email : null;
  $dt_telp  = isset($dt_telp)    ? $dt_telp  : null;
  $dt_nama  = isset($dt_tipe)    ? $dt_tipe  : null;
  $q   = mysql_query("select * from akun where id='" . $_SESSION['id'] . "'");
  $ada = mysql_num_rows($q);
  if($ada > 0) {
    while($data = mysql_fetch_array($q)) {
      $pass  = $data['password'];
      $uid   = $data['id'];
      $data++;
    }
  }
?>
          <!-- Page Content -->
          <div id="page-wrapper">
              <div class="container-fluid">
                  <div class="row">
                      <div class="col-lg-12">
                          <h1 class="page-header"><i class="fa fa-key"></i> Ganti password</h1>

                              <div class="panel panel-info">
                                  <div class="panel-heading">
                                    <i class="fa fa-shield"></i> <b>Formulir ganti password</b>
                                  </div>
                                <div class="panel-body">
                                    <form role="form" action="akun.php?aksi=ganti_pass" method="post">
                                            <fieldset>
                                                <div class="form-group">
                                                    <label for="disabledInput">Password lama:</label>
                                                    <input name="p_lama" class="form-control" id="disabledInput" type="password" value="" placeholder="Password lama.." autofocus>
                                                    <label for="disabledInput">Password baru:</label>
                                                    <input name="p_baru" class="form-control" id="disabledInput" type="text" value="" placeholder="Password baru..">
                                                </div>
                                      </div>
                                      <div class="panel-footer">
                                          <button name="edit" class="btn btn-success btn-fw pull-right">
                                            <i class="fa fa-edit"></i> Perbarui</button>
                                            <a class="btn btn-danger btn-fw pull-left" href="akun.php">
                                              <i class="fa fa-reply"></i> Kembali</a><br><br>
                                              <?php

                                              if(isset($_POST['edit'])) {
                                                //buang undefined index
                                                $p_lama   = isset($_POST['p_lama'])  ? $_POST['p_lama']  : null;
                                                $p_baru   = isset($_POST['p_baru'])  ? $_POST['p_baru']  : null;
                                                if(empty($p_lama) || empty($p_baru))
                                                  pesan('danger', 'Semua formulir harus diisi.');
                                                else {
                                                	if(md5($p_lama) == $pass) {
                                                  		$q = mysql_query("update akun set password='"     . md5(parse($p_baru))       . "' where id='" . $uid . "'");
                                                  		if($q) {
                                                    		pesan('success', 'Sandi anda berhasil diubah menjadi "<b>'. $p_baru .'</b>"');
                                                  		} else {
                                                    		pesan('danger', 'Gagal menyunting user.');
                                                  		}
                                                	} else {
                                                		pesan('danger', 'Password lama salah.');
                                                	}
                                                }
                                              }
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
