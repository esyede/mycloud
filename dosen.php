<?php
session_start();
require_once('inc/core/fungsi.php');

if(dia_dosen()) {
  include_once('inc/core/header.php');
  include_once('inc/core/nav_menu.php');

  $aksi = isset($_GET['aksi']) ? $_GET['aksi'] : null;
  switch($aksi) {
    case 'list_akun':
      include_once('inc/dosen/list_akun.php');
      break;
      case 'tambah_akun':
        include_once('inc/dosen/tambah_akun.php');
        break;
      case 'buat_info':
        include_once('inc/dosen/buat_info.php');
        break;
      case 'hapus_akun':
        include_once('inc/dosen/hapus_akun.php');
        break;
    default:
      include_once('inc/akun/list.php');
      break;
    }
  } else
    lempar('masuk.php');

?>
