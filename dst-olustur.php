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
<?php

include("ayar.php");
$baslik=$_POST['baslik'];
$icerik=$_POST['icerik'];
$kategori=$_POST['kategori'];
$kanit=$_POST['kanit'];
$ipadres = $_SERVER['REMOTE_ADDR'];
$guncelleme = date('YmdHis');
$durum = "0";

if($baslik == "" || $kategori == "" || $icerik == ""){
    
}
else{
        $ticket_olustur = $db->prepare("INSERT INTO tickets (nick,baslik,kategori,mesaj,durum,son_guncelleme,kanit) VALUES(?,?,?,?,?,?,?)");
        $ticket_olustur->execute(array($_SESSION["user_nick"],strip_tags($baslik),strip_tags($kategori),strip_tags($icerik),strip_tags($durum),strip_tags($guncelleme),strip_tags($kanit)));
        header("location:dst.php");
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
			<div style="border: 0px solid; border-radius: 10px;" class="MainNews">
				<div style="border: 0px solid; border-radius: 10px;" class="NewsTitle"><center>
					<h3><b>  DESTEK</b></h3>
					<h5><b>  OLUŞTUR</b></h5></center>
				</div>
		 
				<div style="border: 0px solid; border-radius: 10px;" class="NewsATT">
				 
					<div>&nbsp;</div>
					<p>
						<form action="" method="POST">
Başlık:

<input class="form-control" required type="text" id="baslik" name="baslik" maxlength="70" style="width: 100%" placeholder="Bir Başlık Belirleyiniz." />
<br>
Konu: *
   <select class="form-control" name="kategori" id="kategori" style="width: 101%">
       <option value="Genel">Genel</option>
       <option value="Öneri">Öneri</option>
       <option value="Şikayet">Şikayet</option>
       <option value="Hile Bildirimi">Hile Bildirimi</option>
       <option value="Ödeme Bildirimi">Ödeme Bildirimi</option>
       <option value="Diger islemler">Diğer işlemler</option>
   </select>
<br>
Kanıt URL (Zorunlu değil.):
<input class="form-control" type="text" id="kanit" name="kanit" style="width: 100%;" placeholder="Resim veya video bağlantı adresini girin." />
<br>
Mesajınız:
<textarea class="form-control" style="width: 100%; height: 120px;" required type="text" id="icerik" name="icerik"placeholder="Destek ekibimize iletmek istediğiniz mesajı yazın."></textarea>
<br>
<button class="btn btn-success" type="submit" name="destekAc">Gönder</button>
                    </table>
                </form>
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
