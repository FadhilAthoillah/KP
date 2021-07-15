<?php
$host ='localhost';
$user ='root';
$pass ='';
$db ='penjualan';
$koneksi = mysql_connect($host, $user, $pass);
if(!$koneksi){
    die("cannot connect to database.");
}
mysql_select_db($db);
?>