<?php
require_once('inc/core/konek.php');
require_once('inc/core/fungsi.php');

if(dia_dosen() || dia_mahasiswa()) {
  include_once('inc/core/header.php');
  include_once('inc/core/nav_menu.php');

  $kelas = isset($kelas) ? $kelas : null;
  $kelas = array(
              '1A', '1B', '1C', '1D', '1E', '1F', '1G', '1H', '1I', '1J',
              '2A', '2B', '2C', '2D', '2E', '2F', '2G', '2H', '2I', '2J',
              '3A', '3B', '3C', '3D', '3E', '3F', '3G', '3H', '3I', '3J',
              '4A', '4B', '4C', '4D', '4E', '4F', '4G', '4H', '4I', '4J',
              '5A', '5B', '5C', '5D', '5E', '5F', '5G', '5H', '5I', '5J',
              '6A', '6B', '6C', '6D', '6E', '6F', '6G', '6H', '6I', '6J',
              '7A', '7B', '7C', '7D', '7E', '7F', '7G', '7H', '7I', '7J',
              '8A', '8B', '8C', '8D', '8E', '8F', '8G', '8H', '8I', '8J'
            );


  $uid      = isset($_GET['id']) ? $_GET['id'] : null;
  $dt_nama  = isset($dt_nama)    ? $dt_nama    : null;
  $dt_email = isset($dt_email)   ? $dt_email   : null;
  $dt_telp  = isset($dt_telp)    ? $dt_telp    : null;
  $dt_nama  = isset($dt_tipe)    ? $dt_tipe    : null;

  $q = mysql_query("select * from akun where id='" . parse($uid). "'");
  $ada = mysql_num_rows($q);
  if($ada > 0) {
    while($data = mysql_fetch_array($q)) {
      $dt_nama   = $data['nama'];
      $dt_kelas  = $data['kelas'];
      $dt_email  = $data['email'];
      $dt_telp   = $data['telp'];
      $dt_tipe   = $data['tipe'];
      $data++;
    }
  }
  ?>
            <!-- Page Content -->
            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header"><i class="fa fa-edit"></i> Edit akun</h1>

                                <div class="panel panel-info">
                                    <div class="panel-heading">
                                      <i class="fa fa-shield"></i> <b>Formulir edit akun</b>
                                    </div>
                                  <div class="panel-body">
                                      <form role="form" action="akun.php?aksi=edit_profil&amp;id=<?php echo $uid; ?>" method="post">
                                              <fieldset>
                                                  <div class="form-group">
                                                    <label for="disabledInput">Nama anda:</label>
                                                      <input <?php if(dia_mahasiswa()) echo 'disabled="yes"'; ?> name="i_nama" class="form-control" id="disabledInput" type="text" value="<?php echo $dt_nama; ?>" autofocus="">
                                                      <label for="disabledInput">Kelas:</label>
                                                        <?php
                                                        if(dia_dosen()) {
                                                          echo '<select name="i_kelas" class="form-control">
                                                                <option value="">--pilih satu--</option>';
                                                          foreach($kelas as $kls)
                                                            echo '<option value="' . $kls . '">Kelas ' . $kls . '</option>';
                                                          echo '</select>';
                                                        }
                                                        ?>
                                                      <label for="disabledInput">Email (login):</label>
                                                      <input name="i_email" class="form-control" id="disabledInput" type="text" value="mahasiswa.sableng@student.unsika.ac.id">
                                                      <label for="disabledInput">Nomor telepon:</label>
                                                      <input name="i_telp" class="form-control" id="disabledInput" type="text" value="<?php echo $dt_telp; ?>">
                                                      <?php
                                                      if(dia_dosen()) {
                                                        echo '<label for="disabledInput">Tipe akun:</label>
                                                              <select name="i_tipe" class="form-control">
                                                              <option value="">--pilih satu--</option>
                                                              <option value="mahasiswa">Mahsasiswa</option>
                                                              <option value="dosen">Dosen (admin)</option>
                                                              </select>';
                                                      }
                                                      ?>

                                                  </div>
                                        </div>
                                        <div class="panel-footer">
                                            <button name="edit" class="btn btn-success btn-fw pull-right">
                                              <i class="fa fa-edit"></i> Perbarui</button>
                                              <?php
                                              if(dia_dosen())
                                                $link = 'dosen.php?aksi=list_akun';
                                              else
                                                $link = 'akun.php';
                                              ?>
                                              <a class="btn btn-danger btn-fw pull-left" href="<?php echo $link; ?>">
                                                <i class="fa fa-reply"></i> Kembali</a><br><br>
                                                <?php

                                                if(isset($_POST['edit'])) {
                                                  if(dia_dosen()) {
                                                    $i_email = isset($_POST['i_email']) ? $_POST['i_email'] : null;
                                                    $i_telp  = isset($_POST['i_telp'])  ? $_POST['i_telp']  : null;
                                                    $i_nama  = isset($_POST['i_nama'])  ? $_POST['i_nama']  : null;
                                                    $i_kelas = isset($_POST['i_kelas']) ? $_POST['i_kelas'] : null;
                                                    $i_tipe  = isset($_POST['i_tipe'])  ? $_POST['i_tipe']  : null;
                                                  } else {
                                                    $i_email = isset($_POST['i_email']) ? $_POST['i_email'] : null;
                                                    $i_telp  = isset($_POST['i_telp'])  ? $_POST['i_telp']  : null;
                                                    $i_nama  = $dt_nama;
                                                    $i_kelas = $dt_kelas;
                                                    $i_tipe  = $dt_telp;
                                                  }

                                                  if(empty($i_nama) || empty($i_kelas) || empty($i_email) || empty($i_telp) || empty($i_tipe))
                                                    pesan('danger', 'Semua formulir harus diisi.');
                                                  else {
                                                    $q1 = "update akun set nama='"     . parse($i_nama)       . "' where id=" . $uid . ";";
                                                    $q2 = "update akun set kelas='"    . parse($i_kelas)      . "' where id=" . $uid . ";";
                                                    $q3 = "update akun set email='"    . parse($i_email)      . "' where id=" . $uid . ";";
                                                    $q4 = "update akun set telp='"     . parse($i_telp)       . "' where id=" . $uid . ";";
                                                    $q5 = "update akun set tipe='"     . parse($i_tipe)       . "' where id=" . $uid . ";";

                                                    $sql  = mysql_query($q1);
                                                    $sql .= mysql_query($q2);
                                                    $sql .= mysql_query($q3);
                                                    $sql .= mysql_query($q4);
                                                    $sql .= mysql_query($q5);
                                                    if($sql) {
                                                      $_SESSION['nama'] = parse($i_nama);
                                                      pesan('success', 'Berhasil menyunting user.');
                                                    } else {
                                                      pesan('danger', 'Gagal menyunting user.');
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
