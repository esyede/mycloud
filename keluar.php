<?php
session_start();
session_destroy();
ob_flush();
header('location: masuk.php');
?>
