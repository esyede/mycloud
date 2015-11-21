<?php
function panduan($sub, $pan1, $pan2, $pan3, $p1, $p2, $p3, $isi1, $isi2, $isi3) {
echo '<div class="panel-heading">
        <i class="fa fa-bookmark"></i> <b>' . $sub . '</b>
      </div>
      <div class="panel-body">
      <div class="panel-group" id="accordion">
                <div class="panel panel-' . $pan1 . '">
                <div class="panel-heading">
                <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" class="collapsed">
                ' . $p1 . '</a>
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" class="collapsed">
                <i class="fa fa-arrow-circle-down pull-right"></i></a>
                </h4>
                </div>
                <div id="collapseOne" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                <div class="panel-body">
                ' . $isi1 . '
                </div>
                </div>
                </div>
                <div class="panel panel-' . $pan2 . '">
                <div class="panel-heading">
                <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" class="collapsed" aria-expanded="false">' . $p2 . '</a>
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" class="collapsed">
                <i class="fa fa-arrow-circle-down pull-right"></i></a>
                </h4>
                </div>
                <div id="collapseTwo" class="panel-collapse collapse" aria-expanded="false">
                <div class="panel-body">
                ' . $isi2 . '
                </div>
                </div>
                </div>
                <div class="panel panel-' . $pan3 . '">
                <div class="panel-heading">
                <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" class="collapsed" aria-expanded="false">' . $p3 . '</a>
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" class="collapsed">
                <i class="fa fa-arrow-circle-down pull-right"></i></a>
                </h4>
                </div>
                <div id="collapseThree" class="panel-collapse collapse" aria-expanded="false">
                <div class="panel-body">
                ' . $isi3 . '
                </div>
                </div>
                </div>
                </div>
        </div>';

}

function pengumuman() {
  $q = mysql_query("select * from berita");
  $ada = mysql_num_rows($q);
  if($ada > 0) {
    while($data = mysql_fetch_array($q)) {
      if($data['isi'] != null) {
        echo '<div class="alert alert-info alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Tutup">
            <span aria-hidden="true">&times;</span></button>
            <h4><i class="fa fa-bullhorn"></i> Pengumuman:</h4>
            ' . $data['isi']. '
            </div>';
            }
            $data++;
    }
  }
}

function pesan($alert, $pesan) {
  echo '<div class="alert alert-' . $alert . ' alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Tutup">
        <span aria-hidden="true">&times;</span></button>
        ' . $pesan . '
        </div>';
}

function lempar($url) {
  echo '<script>
      function lempar() {
          var link = "'.$url.'";
          document.location = link;
      }
        lempar();
      </script>';
}

function parse($query) {
  $query = trim(htmlentities(stripslashes(mysql_real_escape_string($query))));
  return $query;
}

function dia_dosen() {
  $tipe = isset($_SESSION['tipe']) ? $_SESSION['tipe'] : null;
  if($tipe == 'dosen')
    return true;
  else
    return false;
}

function dia_mahasiswa() {
  $tipe = isset($_SESSION['tipe']) ? $_SESSION['tipe'] : null;
  if($tipe == 'mahasiswa')
    return true;
  else
    return false;
}

function bulatkan($ukuran) {
  if($ukuran >= 1073741824) {
    $ukuran = number_format($ukuran / 1073741824, 2) . ' GiB';
  } elseif($ukuran >= 1048576) {
    $ukuran = number_format($ukuran / 1048576, 2) . ' MiB';
  } elseif($ukuran >= 1024) {
    $ukuran = number_format($ukuran / 1024, 2) . ' KiB';
  } elseif($ukuran > 1) {
    $ukuran = $ukuran . ' bytes';
  } elseif($ukuran == 1) {
    $ukuran = $ukuran . ' byte';
  } else {
    $ukuran = '0 bytes';
  }
  return $ukuran;
}

?>
