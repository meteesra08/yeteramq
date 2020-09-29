<?php

error_reporting(0);

session_start();


include ("baglanti.php");
date_default_timezone_set('Europe/Istanbul');

$veri_cek = $db->query("SELECT * FROM ayar");
$veri_cek->execute();		
if($veri_cek->rowCount() != 0){
									
	foreach ($veri_cek as $veri_oku) {

$yazi_limit = $veri_oku['sayfalimit'];

}
}
?>
