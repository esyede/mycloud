<?php
date_default_timezone_set("Asia/Jakarta"); //set zona waktu buat waktu unggah berkas
$db = array( //array database
  'host' => 'localhost', //host database
  'user' => 'root',      //username database
  'pass' => '',          //password database
  'db'   => 'mycloud'    //nama databasenya
);

$kon = mysql_connect($db['host'], $db['user'], $db['pass']); //konek
if($kon) { //ok
  mysql_select_db($db['db'], $kon) or die('<h2>Gagal memilih database!</h2>
  Pesan: '. mysql_error()); //pilih db
} else { //gagal
  die('<h2>Gagal konek ke database!</h2>
  Pesan: '. mysql_error());
}

?>
