<?php 

session_start(); //session işlemini başlatıyoruz.
if(!isset($_SESSION['user_nick']))//session varmı die kontrol ediyoruz. yok ise buraya giricek
{
	header("Location:index.php");//eğer session yok ise bizi giris.php gönderecek.
}
?>
<?php
if (!file_exists("baglanti.php")){
		require("install.php");
		die;
	}
include("baglanti.php");
include("meta.php");
error_reporting(0);
session_start();
ob_start();

$ayarsor=$db->prepare("SELECT * FROM ayar where ayar_id = ?");
$ayarsor->execute(array(0));
$ayarcek=$ayarsor->fetch();

$kullanicisor = $db->prepare("select * from authme where username=:username");
$kullanicisor->execute(array('username' => $_SESSION['user_nick']));

$kullanici = $kullanicisor->fetch(PDO::FETCH_ASSOC);

?>
	<!DOCTYPE html>
		<html>
			<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
				<title><?php echo $ayarcek['site_title']; ?></title>
				
				<meta name="viewport" content="width=device-width, initial-scale=1">
				<meta http-equiv="X-UA-Compatible" content="IE=edge">
				<link rel="stylesheet" type="text/css" href="libs/css/main.css" >
				<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/balloon-css/0.4.0/balloon.min.css">
				<link rel="stylesheet" type="text/css" href="libs/ion/css/ionicons.min.css">
				<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
				<link rel="stylesheet" type="text/css" href="libs/bootstrap/css/bootstrap.css">
				<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
				<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
				<link href="https://fonts.googleapis.com/css?family=Noto+Sans:400,700|Montserrat:400,700|Share+Tech+Mono" rel="stylesheet">
 <style type="text/css">
					.swal2-popup {
  font-size: 1.6rem !important;
}

				</style>
 
 <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>
  (adsbygoogle = window.adsbygoogle || []).push({
    google_ad_client: "ca-pub-5031375987916829",
    enable_page_level_ads: true
  });
</script>
				<style>
					body,h1,h2,h3,h4,h5,p,li {font-family: 'Montserrat', sans-serif;}
				 
				</style>
			</head>
 
<body>
<div class="header">
	<br>
	<br>
	<center>
		<img src="libs/img/logo.png" width="30%" />
	</center>
 
	<div class="container">
	 

		<div id="navbar" class="navbar navbar-default nav"> 

			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#joseph-photos-nav-collapse" aria-expanded="false"> 
					<i class="ion-navicon-round"></i>
					</button>
				</div>
				<?php include "topbar.php"; ?>
			</div> 
 
		</div> 

 
<br>
<div class="content-2">
	<div class="col-lg-8">
		<center>
<?php
		
						$ticket_kontrol = $db->prepare("SELECT * FROM tickets WHERE id = ? and nick = ?");
						$ticket_kontrol->execute(array($_GET["id"],$_SESSION['user_nick']));	
						$ticket_oku = $ticket_kontrol->fetch();	
							if($ticket_kontrol->rowCount() != 0){
					?>
					<div style="border: 0px solid; border-radius: 10px;" class="MainNews">
				<div style="border: 0px solid; border-radius: 10px;" class="NewsTitle">
					<h3><b>Siz:</b></h3>
				</div>
		 
				<div style="border: 0px solid; border-radius: 10px;" class="NewsATT">
				 
					<div>&nbsp;</div>
					<p><?php echo $ticket_oku["mesaj"]; ?></p> 
				</div>
  
			</div>
            		<br>
            		<?php
							if($ticket_oku["cevap"] != NULL){
						?>
						<div style="border: 0px solid; border-radius: 10px;" class="MainNews">
				<div style="border: 0px solid; border-radius: 10px;" class="NewsTitle">
					<h3><b>Cevap:</b></h3>
				</div>
		 
				<div style="border: 0px solid; border-radius: 10px;" class="NewsATT">
				 
					<div>&nbsp;</div>
					<p><?php echo $ticket_oku["cevap"]; ?></p> 
				</div>
  
			</div>
			<br>
            	<?php } ?>
            	<?php
							$tickets_sc = $db->prepare("SELECT * FROM tickets_sc WHERE nick = ? and ticket_id = ?");
							$tickets_sc->execute(array($_SESSION['user_nick'],$_GET["id"]));

							if($tickets_sc->rowCount() != 0){

								foreach ($tickets_sc as $tickets_sc_oku) {

									if($tickets_sc_oku["soru"] != NULL){
						?>
					<div class="MainNews">
				<div class="NewsTitle">
					<h3><b>Siz:</b></h3>
				</div>
		 
				<div class="NewsATT">
				 
					<div>&nbsp;</div>
					<p><?php echo $tickets_sc_oku["soru"]; ?></p> 
				</div>
  
			</div>
            		<br>
            		<?php 
								
								}
							if($tickets_sc_oku["cevap"] != NULL){
						?>
						<div class="MainNews">
				<div class="NewsTitle">
					<h3><b>Cevap:</b></h3>
				</div>
		 
				<div class="NewsATT">
				 
					<div>&nbsp;</div>
					<p><?php echo $tickets_sc_oku["cevap"]; ?></p>

				</div>
  
			</div>
			<br>
					<?php } ?>

					<?php
								}
							}
						}

						?>
						<?php

if($ticket_oku["durum"] != 3){

if(isset($_POST['soru_gonder'])){
$soru 		= strip_tags($_POST['soru']);
$durum 		= "2";
$guncelleme = date('YmdHis');

if($_POST["soru"] == ""){
	echo '
             <h2 style="color:red">Boş alan bırakmayın!</h2>
	';
}
else{
		$cevap_gonder = $db->prepare("INSERT INTO tickets_sc (nick,ticket_id,soru) VALUES(?,?,?)");
		$cevap_gonder->execute(array($_SESSION['user_nick'],$_GET["id"],$soru));

		$durum_guncelle =  $db->prepare("UPDATE tickets SET durum = ?, son_guncelleme = ? WHERE nick = ? and id = ?");
		$durum_guncelle->execute(array($durum,$guncelleme,$_SESSION['user_nick'],$_GET["id"]));

		echo '<meta http-equiv="refresh" content="0;URL=dst-goster.php?id='.$_GET["id"].'">';
}
}
}
?>
<form action="" method="post">
<textarea required name="soru" class="form-control" placeholder="Destek ekibimize bırakmak istediğiniz mesajı yazınız." rows="5"></textarea>
<br>
<button class="btn btn-success" name="soru_gonder" type="submit">Gönder</button>
<br>
</form>
<br>
<br>
</center>
</div> 
</div>
 

<?php include "sag.php"; ?>
 <?php include "footer.php"; ?>
 
 
<div>&nbsp;</div>


<script type="text/javascript" src="libs/bootstrap/js/bootstrap.min.js"></script>


<script>
window.onscroll = function() {myFunction()};

var navbar = document.getElementById("navbar");
var sticky = navbar.offsetTop;

function myFunction() {
  if (window.pageYOffset >= sticky) {
    navbar.classList.add("navbar-fixed")
  } else {
    navbar.classList.remove("navbar-fixed");
  }
}
</script> 

 <script>
		$(function() {
		  $(window).on("scroll", function() {
			if($(window).scrollTop() > 290) {
			  $("#lk2").addClass("sticky");
			} else {
			  $("#lk2").removeClass("sticky");
			}
		  });
		});
</script>
</body>
 
 
 
 
 
 
 
 
 
 
</html>




























<?php 
/*
session_start(); //session işlemini başlatıyoruz.
if(!isset($_SESSION['user_nick']))//session varmı die kontrol ediyoruz. yok ise buraya giricek
{
	header("Location:girisyap.php");//eğer session yok ise bizi giris.php gönderecek.
}
?>
<?php
include("baglanti.php");
include("meta.php");
error_reporting(0);
session_start();
ob_start();

$ayarsor=$db->prepare("SELECT * FROM ayar where ayar_id = ?");
$ayarsor->execute(array(0));
$ayarcek=$ayarsor->fetch();

$kullanicisor = $db->prepare("select * from authme where username=:username");
$kullanicisor->execute(array('username' => $_SESSION['user_nick']));

$kullanici = $kullanicisor->fetch(PDO::FETCH_ASSOC);

$config['base_url'] = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
$config['base_url'] .= "://".$_SERVER['HTTP_HOST'];
$config['base_url'] .= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);

?>

<!DOCTYPE HTML>
<!--
	Industrious by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html>
	<head>
		<base href="<?php echo $config['base_url']; ?>">
		<title><?php echo $ayarcek['site_title']; ?></title>
		
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<meta name="description" content="<?php echo $descri ?>" />
		<meta name="keywords" content="<?php echo $keyword ?>" />
		<link rel="stylesheet" href="yenitema/assets/css/main.css" />
		<link rel="stylesheet" href="css/haber.css" />
	</head>
	<body class="is-preload">

		<!-- Header -->
			<header id="header">
				<a class="logo" href="index.php"><?php echo $ayarcek['sunucu_isim']; ?></a>
				<nav>
					<a href="#menu">Menü</a>
				</nav>
			</header>

		<!-- Nav -->
			<?php include('menu.php'); ?>

		<!-- Banner -->
			<section id="banner">
				<div class="inner">
					<h1><?php echo $ayarcek['sunucu_isim']; ?></h1>
					<p>Destek talebinizi görmek ve mesaj yazmak için sayfayı aşağı kaydırın.</p>
				</div>
			</section>

		<!-- Highlights -->
			<section class="wrapper">
				<div class="inner">
					<header class="special">
					</header>
					<!-------------
					--------------
					------------->
            <div class="haberBaslik">
                <div class="haberBaslikYazi">Destek Talepleri > Talep Göster</div>
                <a href="dst.php"><div class="haberBaslikTarih"><-- Geri Dön</div></a>
            </div>
            <div class="haberIcerik">

            	<center>
            		<?php
		
						$ticket_kontrol = $db->prepare("SELECT * FROM tickets WHERE id = ? and nick = ?");
						$ticket_kontrol->execute(array($_GET["id"],$_SESSION['user_nick']));	
						$ticket_oku = $ticket_kontrol->fetch();	
							if($ticket_kontrol->rowCount() != 0){
					?>
            		<h2>Siz:</h2>
            		<p><?php echo $ticket_oku["mesaj"]; ?></p>
            		<br>
            		<?php
							if($ticket_oku["cevap"] != NULL){
						?>
						<h2>Cevap:</h2>
					<p><?php echo $ticket_oku["cevap"]; ?></p>
            	<?php } ?>
            	<?php
							$tickets_sc = $db->prepare("SELECT * FROM tickets_sc WHERE nick = ? and ticket_id = ?");
							$tickets_sc->execute(array($_SESSION['user_nick'],$_GET["id"]));

							if($tickets_sc->rowCount() != 0){

								foreach ($tickets_sc as $tickets_sc_oku) {

									if($tickets_sc_oku["soru"] != NULL){
						?>
					<h2>Siz:</h2>
            		<p><?php echo $tickets_sc_oku["soru"]; ?></p>
            		<br>
            		<?php 
								
								}
							if($tickets_sc_oku["cevap"] != NULL){
						?>
						<h2>Cevap:</h2>
						<p><?php echo $tickets_sc_oku["cevap"]; ?></p>
					<?php } ?>

					<?php
								}
							}
						}

						?>
						<?php

if($ticket_oku["durum"] != 3){

if(isset($_POST['soru_gonder'])){
$soru 		= strip_tags($_POST['soru']);
$durum 		= "2";
$guncelleme = date('YmdHis');

if($_POST["soru"] == ""){
	echo '
             <h2 style="color:red">Boş alan bırakmayın!</h2>
	';
}
else{
		$cevap_gonder = $db->prepare("INSERT INTO tickets_sc (nick,ticket_id,soru) VALUES(?,?,?)");
		$cevap_gonder->execute(array($_SESSION['user_nick'],$_GET["id"],$soru));

		$durum_guncelle =  $db->prepare("UPDATE tickets SET durum = ?, son_guncelleme = ? WHERE nick = ? and id = ?");
		$durum_guncelle->execute(array($durum,$guncelleme,$_SESSION['user_nick'],$_GET["id"]));

		echo '<meta http-equiv="refresh" content="0;URL=dst-goster.php?id='.$_GET["id"].'">';
}
}
}
?>
<form action="" method="post">
<textarea required name="soru" placeholder="Destek ekibimize bırakmak istediğiniz mesajı yazınız." rows="5"></textarea>
<br>
<button name="soru_gonder" type="submit">Gönder</button>
</form>
            	</center>

				</div>
            <div class="cizgi"></div>
					<!------------
					--------------
					-------------->
					<div class="highlights">
					</div>
				</div>
			</section>

		<!-- Footer -->
			<?php
			include("foot.php");
			?>

		<!-- Scripts -->
			<script src="yenitema/assets/js/jquery.min.js"></script>
			<script src="yenitema/assets/js/browser.min.js"></script>
			<script src="yenitema/assets/js/breakpoints.min.js"></script>
			<script src="yenitema/assets/js/util.js"></script>
			<script src="yenitema/assets/js/main.js"></script>

	</body>
</html>