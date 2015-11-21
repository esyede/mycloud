<?php
require_once('inc/core/fungsi.php');

if(dia_dosen() || dia_mahasiswa()) {
  include_once('inc/core/header.php');
  include_once('inc/core/nav_menu.php');
?>

  <div id="page-wrapper">
      <div class="container-fluid">
          <div class="row">
              <div class="col-lg-12">
                  <h1 class="page-header"><i class="fa fa-file-o"></i> Daftar Berkas</h1>
                  <div class="table-responsive">
                                <table class="table table-hover">

<?php
if(dia_dosen())
  $q  = mysql_query("select * from berkas inner join akun on berkas.uid = akun.id order by berkas.fnama asc");
if(dia_mahasiswa())
  $q = mysql_query("select * from berkas where uid='" . $_SESSION['id'] . "' order by fnama asc");
$ada = mysql_num_rows($q);
if($ada > 0) {
  echo '<thead>
                                        <tr>
                                            <th class="text text-info">No.</th>
                                            <th class="text text-info">Nama Berkas</th>';
if(dia_dosen()) {
  echo                                     '<th class="text text-info">Pemilik</th>
                                            <th class="text text-info">Kelas</th>';
}
echo                                       '<th class="text text-info">Tanggal</th>
                                            <th class="text text-info">Jenis</th>
                                            <th class="text text-info">Ukuran</th>
                                            <th class="text text-info">Aksi</th>
                                        </tr>
                                    </thead>';


  $i = 1;
  while($data = mysql_fetch_array($q)) {
    echo                              '<tbody>
                                          <tr>
                                            <td>'. $i .'.</td>
                                            <td><b><a href="berkas/mhs-' . $data['uid'] . '/' . $data['fnama'] . '" title="unduh berkas">'. $data['fnama'] . '</a></b></td>';
    if(dia_dosen()) {
      if($data['tipe'] == 'dosen')
        $pemilik = '<span class="text text-success">' . $data['nama']              . '</span>';
      else
        $pemilik = '<span class="text text-info">'    . $data['nama']              . '</span>';

      echo                                 '<td>'     . $pemilik                   . '</td>';
    }
    if(dia_dosen())
      echo                                 '<td>'     . $data['kelas']             . '</td>';

    echo                                   '<td>'     . $data['ftanggal']          . '</td>
                                            <td>'     . strtoupper($data['ftipe']) . '</td>
                                            <td>'     . bulatkan($data['ukuran'])  . '</td>
                                            <td>
                                              <a class="btn btn-danger btn-circle btn-xs" href="akun.php?aksi=hapus_berkas&fid=' . $data['fid'] .'" title="hapus berkas"><i class="fa fa-times"></i></a>
                                            </td>
                                        </tr>';
    $i++;
    $data++;
    }
  } else {
    pesan('danger', 'Belum ada berkas yang diunggah.');
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
