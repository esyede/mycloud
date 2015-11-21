<?php
include_once('inc/core/konek.php');
require_once('inc/core/fungsi.php');

if(dia_dosen()) {
  include_once('inc/core/header.php');
  include_once('inc/core/nav_menu.php');

?>
          <!-- Page Content -->
          <div id="page-wrapper">
              <div class="container-fluid">
                  <div class="row">
                      <div class="col-lg-12">
                          <h1 class="page-header"><i class="fa fa-plus"></i> Buat Informasi</h1>

                              <div class="panel panel-info">
                                  <div class="panel-heading">
                                    <i class="fa fa-shield"></i> <b>Formulir buat informasi</b>
                                  </div>
                                <div class="panel-body">
                                    <form role="form" action="dosen.php?aksi=buat_info" method="post">
                                            <fieldset>
                                                <div class="form-group">
                                                  <label>Isi informasi:</label>
                                                  <textarea class="form-control" rows="3" name="i_berita" id="berita" autofocus>
<?php
                                                    $q = mysql_query("select * from berita");
                                                    $ada = mysql_num_rows($q);
                                                    if($ada > 0) {
                                                      while($data = mysql_fetch_array($q)) {
                                                        $berita = $data['isi'];
                                                        $data++;
                                                      }
                                                    }
                                                    echo $berita;
?>
                                                    </textarea>
                                                    <p class="text text-muted"><small>*) Klik tombol <strong>'Hapus'</strong> untuk menghapus informasi</small></p>
                                                </div>
                                      </div>
                                      <div class="panel-footer">
                                          <button name="simpan" class="btn btn-success btn-fw pull-right" id="simpan">
                                          <i class="fa fa-save"></i> Simpan
                                          </button>
                                            <button name="hapus" class="btn btn-danger btn-fw pull-left" id="hapus">
                                              <i class="fa fa-reply"></i> Hapus</button><br><br>
<?php
                                              //buang undefined index
                                              if(isset($_POST['simpan'])) {
                                                $i_berita  = $_POST['i_berita'];
                                                $q         = mysql_query("update berita set isi = '" . parse($i_berita) . "' where bid = 1");
                                                if($q) {
                                                  $berita = $data['isi'];
                                                  pesan('success', 'Berita telah diperbarui.');
                                                } else
                                                  pesan('danger', 'Gagal memperbarui berita.');
                                                }

                                                if(isset($_POST['hapus'])) {
                                                  $q = mysql_query("update berita set isi = '' where bid = 1");
                                                  if($q) {
                                                    pesan('success', 'Berita telah dihapus, silahkan kembali ke dasbor.');
                                                  } else
                                                    pesan('danger', 'Gagal menghapus berita, silahkan kembali ke dasbor.');
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
