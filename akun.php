<?php
session_start();
require_once('inc/core/fungsi.php');

if(dia_dosen() || dia_mahasiswa()) {
  include_once('inc/core/header.php');
  include_once('inc/core/nav_menu.php');

  $aksi = isset($_GET['aksi']) ? $_GET['aksi'] : null;
  switch($aksi) {
    case 'unggah_berkas':
      include_once('inc/berkas/unggah.php');
      break;
    case 'lihat_berkas':
      include_once('inc/berkas/list.php');
      break;
    case 'berkas_dia':
      include_once('inc/berkas/berkas_dia.php');
      break;
    case 'hapus_berkas':
      include_once('inc/berkas/hapus.php');
      break;
    case 'ganti_pass':
      include_once('inc/akun/pass.php');
      break;
    case 'edit_profil':
      include_once('inc/akun/edit.php');
      break;
    case 'hapus_akun':
      include_once('inc/akun/hapus.php');
      break;
    case 'buat_info':
      include_once('inc/dosen/buat_info.php');
      break;
    default:
      include_once('inc/akun/list.php');
      break;
  }
} else
  lempar('masuk.php');
?>
