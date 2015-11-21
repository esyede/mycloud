<?php
require_once('inc/core/konek.php');
require_once('inc/core/fungsi.php');

if(dia_dosen() || dia_mahasiswa()) {
  include_once('inc/core/header.php');
  include_once('inc/core/nav_menu.php');

  $uid = isset($_SESSION['id']) ? $_SESSION['id'] : null;
  ?>
          <!-- Page Content -->
          <div id="page-wrapper">
              <div class="container-fluid">
                  <div class="row">
                      <div class="col-lg-12">
                          <h1 class="page-header"><i class="fa fa-user-md"></i> Profil anggota</h1>

                              <div class="panel panel-info">
                                  <div class="panel-heading">
                                    <i class="fa fa-user"></i> <b><?php echo $_SESSION['nama']; ?></b>
                                  </div>
                                <div class="panel-body">
                                    <?php
                                    $q = mysql_query("select * from akun where id='" . $uid . "'");
                                    $ada = mysql_num_rows($q);
                                    if($ada > 0) {
                                      while($data = mysql_fetch_array($q)) {
                                        if($data['tipe'] =='dosen')
                                        $jabatan = 'Dosen (admin)';
                                        else
                                        $jabatan = 'Mahasiswa';

                                        echo '<form role="form">
                                            <fieldset disabled="">
                                                <div class="form-group">
                                                    <label for="disabledInput">Nama anda:</label>
                                                    <input class="form-control" id="disabledInput" type="text" value="'. $data['nama'] .'" disabled="">

                                                    <label for="disabledInput">Kelas:</label>
                                                    <input class="form-control" id="disabledInput" type="text" value="'. $data['kelas'] .'" disabled="">

                                                    <label for="disabledInput">Email (login):</label>
                                                    <input class="form-control" id="disabledInput" type="text" value="'. $data['email'] .'" disabled="">

                                                    <label for="disabledInput">Nomor telepon:</label>
                                                    <input class="form-control" id="disabledInput" type="text" value="'. $data['telp'] .'" disabled="">

                                                    <label for="disabledInput">Tipe akun:</label>
                                                    <input class="form-control" id="disabledInput" type="text" value="'. $jabatan .'" disabled="">
                                                </div>';
                                        $data++;
                                      }
                                    } else
                                      pesan('danger', 'Data user tidak ditemukan');
                                    ?>
                                </div>
                                <div class="panel-footer">
                                    <a class="btn btn-info btn-fw pull-right" href="akun.php?aksi=edit_profil&amp;id=<?php echo $uid; ?>">
                                      <i class="fa fa-wrench"></i> Sunting akun</a><br><br>
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
