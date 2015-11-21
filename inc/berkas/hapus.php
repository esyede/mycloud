<?php
require_once('inc/core/konek.php');
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
                <h1 class="page-header"><i class="fa fa-times"></i> Hapus berkas</h1>
                <div class="panel panel-info">
                    <div class="panel-heading">
                      <i class="fa fa-times"></i> <b>Hapus berkas</b>
                    </div>
                          <div class="panel-body">
<?php
  $fid    = isset($_GET['fid']) ? $_GET['fid'] : null;
  $fid    = parse($fid);

  if(dia_dosen())
    $q  = mysql_query("select * from berkas inner join akun on berkas.uid = akun.id where berkas.fid=' ". $fid . "'");
  if(dia_mahasiswa())
    $q = mysql_query("select * from berkas where fid='" . $fid . "' and uid='" . $_SESSION['id'] . "'");

  $ada = mysql_num_rows($q);
  if($ada > 0) {
    while($data = mysql_fetch_array($q)) {
      $path = $data['url'];
      $data++;
    }
  } else {
    pesan('danger', 'Data berkas tidak ditemukan di database.');
  }

  $cek = file_exists($path);
  if($cek) {
    if(unlink($path))
      $hps = true;
    else
      $hps = false;

    if($hps) {
      $q   = mysql_query("delete from berkas where fid='" . $fid . "'");
      if($q)
        pesan('success', 'Berkas berhasil dihapus');
      else
        pesan('danger', 'Kesalahan di database');
    } else
      pesan('danger', 'Berkas gagal dihapus, cek hak akses pada berkas.');
  } else
    pesan('danger', 'Berkas tidak ditemukan.');
?>
                          </div>
                        <div class="panel-footer">
                            <a class="btn btn-primary btn-fw" href="akun.php?aksi=lihat_berkas">
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
