<?php
require_once('inc/core/konek.php');
require_once('inc/core/fungsi.php');

if(dia_dosen()) {
  include_once('inc/core/header.php');
  include_once('inc/core/nav_menu.php');

  $idx = isset($_GET['id']) ? $_GET['id'] : null;
  $idx = parse($idx);
  $q1  = mysql_query("select * from akun where id='" . $idx . "'");

  if(mysql_num_rows($q1) > 0) {
    while($usr = mysql_fetch_array($q1)) {
      $user = $usr['nama'];
      $usr++;
    }
  } else {
    $user = 'siapa?';
    pesan('danger', 'Pengguna tidak ditemukan');
  }

?>
            <!-- Page Content -->
            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header"><i class="fa fa-user-md"></i> Berkas pengguna</h1>

                            <div class="panel panel-info">
                      <div class="panel-heading">
                          <b><i class="fa fa-tasks"></i> Berkas <?php echo parse($user); ?></b>
                      </div>
                      <div class="panel-body">
                          <div class="table-responsive">
                              <table class="table table-hover">
                                      <?php
                                      $q2 = mysql_query("select * from berkas where uid='" . $idx . "'");
                                      $cek = mysql_num_rows($q2);
                                      if($cek > 0) {
                                        echo '<thead>
                                                  <tr>
                                                  <th>No.</th>
                                                  <th>#ID</th>
                                                  <th>Nama Berkas</th>
                                                  <th>Tanggal</th>
                                                  <th>Tipe</th>
                                                  <th>Ukuran</th>
                                                  <th>Aksi</th>
                                              </tr>
                                          </thead>
                                          <tbody>';
                                        $i = 1;
                                        while($data = mysql_fetch_array($q2)) {
                                          echo '<tr>
                                                  <td>'      . $i                                  . '.</td>
                                                  <td>#'     . $data['fid']                        . '</td>
                                                  <td><b><a href="' . $data['url']. '" title="unduh berkas">' . $data['fnama'] . '</a></b></td>
                                                  <td>'      . $data['ftanggal']                   . '</td>
                                                  <td>'      . strtoupper($data['ftipe'])          . '</td>
                                                  <td>'      . bulatkan($data['ukuran'])           . '</td>
                                                  <td>
                                                    <a class="btn btn-danger btn-circle btn-xs" href="akun.php?aksi=hapus_berkas&fid=' . $data['fid'] .'" title="hapus berkas"><i class="fa fa-times"></i></a>
                                                  </td>
                                                </tr>';
                                          $i++;
                                          $data++;
                                        }
                                      } else {
                                          pesan('danger', 'Pengguna ini belum pernah mengunggah berkas.');
                                        }
                                      ?>
                                  </tbody>
                              </table>
                          </div>
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
