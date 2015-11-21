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

    <title>Masuk || MyCloud</title>

    <link href="assets/images/ikon.png" rel="shortcut icon">

    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/metisMenu.min.css" rel="stylesheet">
    <link href="assets/css/custom.css" rel="stylesheet">
    <link href="assets/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="assets/js/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-cloud"></i> MyCloud</h3>
                    </div>
                    <div class="panel-body">
                    <center>
                    <img src="assets/images/ikon.png" alt="logo">
                    <br><br>
                    </center>
                        <form role="form" action="masuk.php" method="post">
                            <fieldset>
                                <div class="form-group input-group">
                                  <span class="input-group-addon">@</i></span>
                                  <input type="email" class="form-control" name="email" placeholder="E-mail" autofocus>
                                </div>

                                <div class="form-group input-group">
                                  <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                  <input type="password" class="form-control" name="password" placeholder="Kata sandi">
                                </div>
                                <button name="masuk" class="btn btn-lg btn-success btn-block">Masuk</button><br>
                                 <?php
                                if(isset($_POST['masuk'])) {
                                  session_start();
                                  ob_start();

                                  $usr = parse($_POST['email']);
                                  $pwd = md5(parse($_POST['password']));

                                  $q   = mysql_query("select * from akun where email = '" . $usr . "' AND password = '" . $pwd . "'") or die(mysql_error());
                                  $ada = mysql_num_rows($q);
                                  if($ada > 0) {
                                    while($data = mysql_fetch_array($q)) {
                                      $_SESSION['id']   = $data['id'];
                                      $_SESSION['user'] = $data['email'];
                                      $_SESSION['pass'] = $data['password'];
                                      $_SESSION['tipe'] = $data['tipe'];
                                      $_SESSION['nama'] = $data['nama'];
                                      $_SESSION['telp'] = $data['telp'];
                                      $data++;
                                    }

                                    if($_SESSION['tipe'] == 'dosen' || $_SESSION['tipe'] == 'mahasiswa')
                                      lempar('index.php');

                                  } else {
                                    pesan('danger', 'Email atau kata sandi anda salah');
                                    ob_end_flush();
                                  }

                                } else
                                  ob_end_flush();


                                ?>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/metisMenu.min.js"></script>
    <script src="assets/js/custom.js"></script>

</body>

</html>
