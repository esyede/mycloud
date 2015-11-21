<?php
require_once('inc/core/fungsi.php');
if(dia_dosen()) {
  include_once('inc/core/header.php');
  include_once('inc/core/nav_menu.php');
?>

  <div id="page-wrapper">
      <div class="container-fluid">
          <div class="row">
              <div class="col-lg-12">
                  <h1 class="page-header"><i class="fa fa-sitemap"></i> List akun</h1>
                  <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text text-info">No.</th>
                                            <th class="text text-info">Nama Lengkap</th>
                                            <th class="text text-info">Kelas</th>
                                            <th class="text text-info">Email</th>
                                            <th class="text text-info">#ID</th>
                                            <th class="text text-info">Telepon</th>
                                            <th class="text text-info">Jabatan</th>
                                            <th class="text text-info">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php
$q   = mysql_query("select * from akun");
$ada = mysql_num_rows($q);

if($ada > 0) {
  $i = 1;
  while($data = mysql_fetch_array($q)) {
    if($data['tipe'] == 'dosen')
      $tipe = '<div class="text text-success">Dosen (admin)</div>';
    else
      $tipe = '<div class="text text-primary">Mahasiswa</div>';
    echo                              '<tr>
                                            <td>' . $i             . '.</td>
                                            <td>' . $data['nama']  . '</td>
                                            <td>' . $data['kelas'] . '</td>
                                            <td>' . $data['email'] . '</td>
                                            <td>#'. $data['id']    . '</td>
                                            <td>' . $data['telp']  . '</td>
                                            <td>' . $tipe          . '</td>
                                            <td>
                                              <a class="btn btn-success btn-circle btn-xs" href="akun.php?aksi=berkas_dia&amp;id=' . $data['id'] .'" title="berkas milik user ini"><i class="fa fa-tasks"></i></a>
                                              <a class="btn btn-info btn-circle btn-xs" href="akun.php?aksi=edit_profil&amp;id=' . $data['id'] .'" title="sunting akun"><i class="fa fa-wrench"></i></a>
                                              <a class="btn btn-danger btn-circle btn-xs" href="akun.php?aksi=hapus_akun&amp;id=' . $data['id'] .'" title="hapus akun"><i class="fa fa-times"></i></a>
                                            </td>
                                        </tr>';
    $i++;
    $data++;
    }
  }
?>
                                    </tbody>
                                </table>
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
