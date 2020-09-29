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

if($_POST){
		$kadi = $_POST["kadi"];
		$sifre = md5($_POST["sifre"]);
		$yetki = "a";
		$kullanicisor=$db->prepare("SELECT * FROM authme WHERE username=? and password=?");
		$kullanicisor->execute(array($kadi,$sifre));
		$islem=$kullanicisor->fetch();
		$yetkisor=$db->prepare("SELECT * FROM authme WHERE yetki=? and id=?");
		
		if($islem){
			$_SESSION['user_nick'] = $islem['username'];
			$_SESSION['yetki'] = $islem['yetki'];
			$_SESSION['uyeid'] = $islem['id'];
			echo "<script>alert('Giriş başarılı!')</script>";
			echo '<meta http-equiv="refresh" content="0;URL=index.php">';
			exit;
		} else{
			echo "<script>alert('Giriş bilgileri hatalı. Tekrar deneyin.')</script>";
			echo '<meta http-equiv="refresh" content="0;URL=index.php">';
		} 
	}
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
				<div class="collapse navbar-collapse" id="joseph-photos-nav-collapse">
					<ul class="nav navbar-nav">
						<li><a href="index.php"><i class="fa fa-home"></i>   Ana Sayfa</a></li>
						<?php 
					session_start();
 
					if(isset($_SESSION["user_nick"])){
					echo '<li><a href="profil"><i class="fa fa-user"></i>   Profil</a></li>';
					echo '<li style="font-family: Raleway;"><a href="destek"><i class="fa fa-ticket"></i>   Destek</a></li>';
    				echo '<li style="font-family: Raleway;"><a href="market"><i class="fa fa-shopping-cart"></i>   Market</a></li>';
    				echo '<li style="font-family: Raleway;"><a href="kredi"><i class="fa fa-plus-circle"></i>   Kredi Yükle</a></li>';
    				echo '<li style="font-family: Raleway;"><a href="kupon"><i class="fa fa-ticket"></i>   Kupon Kodu Kullan</a></li>';
    				echo '<li style="font-family: Raleway;"><a href="cikis"><i class="fa fa-sign-out"></i>   Çıkış Yap</a></li>';
					}else{

					}
					
					?>		
					</ul>
				</div>
			</div> 
 
		</div> 

 
<br>
<div class="content-2">
		<div class="col-lg-8">
			<div class="MainNews">
				<div class="NewsTitle">
					<center>
					<h3><b>  ÖDEME BAŞARILI</b></h3>
					<h5><b>  Desteğiniz için teşekkür ederiz.</b></h5></center>
				</div>
		 
				<div class="NewsATT">
				 
					<div>&nbsp;</div>
					<p>
						<center>
						<img width="200" height="200" src="https://kansersavas.com/wp-content/uploads/2018/05/t%C4%B1k.png">
						<br>
						<h2>Ödeme başarılı! Krediniz hesabınıza eklendi. Yönlendiriliyorsunuz..</h2>
						<meta http-equiv="refresh" content="3;URL=index.php"></center>
					</p> 
				</div>

			</div>
 
<div>&nbsp;</div>
 
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