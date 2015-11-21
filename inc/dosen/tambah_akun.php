<?php
require_once('inc/core/fungsi.php');

if(dia_dosen()) {
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
?>
          <!-- Page Content -->
          <div id="page-wrapper">
              <div class="container-fluid">
                  <div class="row">
                      <div class="col-lg-12">
                          <h1 class="page-header"><i class="fa fa-plus"></i> Tambah akun</h1>

                              <div class="panel panel-info">
                                  <div class="panel-heading">
                                    <i class="fa fa-shield"></i> <b>Formulir tambah akun</b>
                                  </div>
                                <div class="panel-body">
                                    <form role="form" action="dosen.php?aksi=tambah_akun" method="post">
                                            <fieldset>
                                                <div class="form-group">
                                                    <label for="disabledInput">Nama anda:</label>
                                                    <input name="i_nama" class="form-control" id="disabledInput" type="text" placeholder="nama user.." autofocus>
                                                    <label for="disabledInput">Kelas:</label>
                                                      <select name="i_kelas" class="form-control">
                                                        <option value="" selected="yes">--pilih satu--</option>
<?php
                                                        foreach($kelas as $kls)
                                                          echo '<option value="' . $kls . '">Kelas ' . $kls . '</option>';
?>
                                                      </select>
                                                    <label for="disabledInput">Email (login):</label>
                                                    <input name="i_email" class="form-control" id="disabledInput" type="email" placeholder="email user..">

                                                    <label for="disabledInput">Password (login):</label>
                                                    <input name="i_pass" class="form-control" id="disabledInput" type="password" placeholder="password..">

                                                    <label for="disabledInput">Nomor telepon:</label>
                                                    <input name="i_telp" class="form-control" id="disabledInput" type="text" placeholder="nomor telepon..">

                                                    <label for="disabledInput">Tipe akun:</label>
                                                    <select name="i_tipe" class="form-control">
                                                      <option value="mahasiswa">Mahsasiswa</option>
                                                      <option value="dosen">Dosen (admin)</option>
                                                    </select>

                                                </div>
                                      </div>
                                      <div class="panel-footer">
                                          <button name="tambah" class="btn btn-success btn-fw pull-right">
                                            <i class="fa fa-plus"></i> Tambah</button>
                                            <a class="btn btn-danger btn-fw pull-left" href="dosen.php?aksi=list_akun">
                                              <i class="fa fa-reply"></i> Kembali</a><br><br>
<?php
                                              //buang undefined index
                                              if(isset($_POST['tambah'])) {
                                                $i_nama  = isset($_POST['i_nama'])  ? $_POST['i_nama']  : '';
                                                $i_kelas = isset($_POST['i_kelas']) ? $_POST['i_kelas'] : '';
                                                $i_email = isset($_POST['i_email']) ? $_POST['i_email'] : '';
                                                $i_pass  = isset($_POST['i_pass'])  ? $_POST['i_pass']  : '';
                                                $i_telp  = isset($_POST['i_telp'])  ? $_POST['i_telp']  : '';
                                                $i_tipe  = isset($_POST['i_tipe'])  ? $_POST['i_tipe']  : '';

                                                $i_pass = md5(parse($i_pass));

                                                if(empty($i_nama) || empty($i_kelas) || empty($i_email) || empty($i_pass) || empty($i_telp) || empty($i_tipe))
                                                  pesan('danger', 'Semua formulir harus diisi.');
                                                else {
                                                  $q = mysql_query("insert into `akun` (`nama`, `kelas`, `telp`, `email`, `password`, `tipe`) values
                                                        ('". parse($i_nama) ."', '". parse($i_kelas) ."', '". parse($i_telp) ."', '". parse($i_email) ."', '". $i_pass ."', '". parse($i_tipe) ."')");
                                                  $q = mysql_query("select * from akun where email='" . parse($i_email) . "' and password='" . $i_pass . "'");

                                                  if(mysql_num_rows($q) > 0) {
                                                    $ada = true;
                                                    while($data = mysql_fetch_array($q)) {
                                                      $idx = $data['id'];
                                                      $data++;
                                                    }
                                                  } else
                                                    $ada = false;

                                                  if($q && $ada) {
                                                    $dir_mhs = 'berkas/mhs-' . $idx;
                                                    mkdir($dir_mhs);
                                                    chmod($dir_mhs, 0777);
                                                    $f = fopen('berkas/mhs-' . $idx . '/index.php', 'w');
                                                    fwrite($f, '<?php header("location: ../../index.php"); ?>');
                                                    fclose($f);
                                                    chmod('berkas/mhs-' . $idx . '/index.php', 0666);
                                                    pesan('success', 'User berhasil ditambahkan.');
                                                  } else {
                                                    //hapus lagi data di db kalo mkdir() dan fopen() gagal
                                                    mysql_query("delete from akun where id=" . $idx);
                                                    pesan('danger', 'Gagal menambah user. kesalaha pada database atau hak akses folder');
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
