<?php
require_once('inc/core/konek.php');
require_once('inc/core/fungsi.php');
?>
<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>MyCloud</title>

    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/metisMenu.min.css" rel="stylesheet">
    <link href="assets/css/custom.css" rel="stylesheet">
    <link href="assets/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <link href="assets/images/ikon.png" rel="shortcut icon">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="assets/js/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Navigasi</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php"><i class="fa fa-cloud"></i> MyCloud</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <?php

                        $q =  mysql_query("select * from akun where id='" . $_SESSION['id'] . "'");
                        while($akun = mysql_fetch_array($q)) {
                          $nama = $akun['nama'];
                          $akun++;
                        }
                        echo $nama . ' <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>';
?>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="akun.php"><i class="fa fa-user fa-fw"></i> Profil saya</a>
                        </li>
                        <li><a href="akun.php?aksi=ganti_pass"><i class="fa fa-gear fa-fw"></i> Ganti sandi</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="keluar.php"><i class="fa fa-power-off fa-fw"></i> Keluar</a>
                        </li>
                    </ul>
                </li>
            </ul>
