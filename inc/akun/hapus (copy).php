<?php
require_once('inc/core/konek.php');
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
                <h1 class="page-header"><i class="fa fa-times"></i> Hapus akun</h1>
                <div class="panel panel-info">
                    <div class="panel-heading">
                      <i class="fa fa-times"></i> <b>Hapus akun</b>
                    </div>
                          <div class="panel-body">
<?php
  $uid = isset($_GET['id']) ? $_GET['id'] : null;
  $uid = parse($uid);

  $berkas = mysql_query("select * from berkas where uid='" . $uid . "'");
  $cek = mysql_num_rows($berkas);
  if($cek > 0) {
    while($dt = mysql_fetch_array($berkas)) {
      $hps = unlink($dt['url']);
      $dt++;
    }
  }

  $hps = unlink('berkas/mhs-' . $uid . '/index.php');
  $hps = rmdir('berkas/mhs-' . $uid);
  if($hps) {
    $q = mysql_query("delete from akun where id='" . $uid . "'");
    $q = mysql_query("delete from berkas where uid='" . $uid . "'");
    if($q)  {
      pesan('success', 'User berhasil dihapus');
    } else {
      pesan('danger', 'User gagal dihapus');
    }
  } else {
    pesan('danger', 'Gagal meghapus direktori user.');
  }
    ?>
                            </div>
                          <div class="panel-footer">
                              <a class="btn btn-primary btn-fw" href="dosen.php?aksi=list_akun">
                                  <i class="fa fa-reply"></i> Kembali</a>
                          </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

    <?php
  include_once('inc/core/footer.php');
} else
  lempar('akun.php');
?>
