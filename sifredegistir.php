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
				<style type="text/css"><?php //SAS ?>
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
			<div class="MainNews">
				<div class="NewsTitle"><center>
					<h3><b>  PROFİL</b></h3>
					<h5><b>  Şifre Değiştir</b></h5></center>
				</div>
		 
				<div class="NewsATT">
				 
					<div>&nbsp;</div>
					<p>
						<center>
							<?php 	
		if(isset($_POST['sifredegis'])){

		$kadi = htmlspecialchars($_POST["kadi"]);
		$epass=$_POST["esifre"];
		$ypass = $_POST["ysifre"];
		$ypass2 = $_POST["ysifre2"];
		$e_password=md5($epass);
		$kullanicisor=$db->prepare("select * from authme where password=:password");
		$kullanicisor->execute(array('password' => $e_password));
		$say=$kullanicisor->rowCount();
		if($say==0)
		{
			?>
               <div>
			<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
			<script type="text/javascript">swal.fire("Hata!", "Girdiğiniz eski şifre hatalı.", "error");
			</script>
			</div>
               <?php
		}
		else
		{
			if($ypass != $ypass2)
			{
				?>
               <div>
			<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
			<script type="text/javascript">swal.fire("Hata!", "Girdiğiniz şifreler uyuşmuyor.", "error");
			</script>
			</div>
               <?php
			}
			else
			{
				if(strlen($ypass)<=3)
				{
					?>
               <div>
			<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
			<script type="text/javascript">swal.fire("Hata!", "Şifreniz 4 karakterden uzun olmalıdır.", "error");
			</script>
			</div>
               <?php
				}
				else
				{
					$sifre = md5($ypass);
					$kullanicikaydet=$db->prepare("UPDATE authme SET password=:password WHERE username=:username");

				
					$insert=$kullanicikaydet->execute(array(
						'password' => $sifre, 'username' => $_SESSION['user_nick']));
					if($insert){
						session_destroy();
						?>
               <div>
			<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
			<script type="text/javascript">swal.fire("Başarılı!", "Şifreniz değiştirildi. Ana sayfaya yönlendiriliyorsunuz..", "success");
			</script>
			</div>
               <?php
               header("refresh:3; url=index.php");
					}
					else
					{
						?>
               <div>
			<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
			<script type="text/javascript">swal.fire("Hata!", "Şifre değiştirilirken bir hata oluştu.", "error");
			</script>
			</div>
               <?php
					}
				}
			}
		}
	} ?>
			<form method="post" action="">
			<br>
			<strong>Kullanıcı adın: <?php echo $_SESSION['user_nick']; ?></strong>
			<br><br>
			<strong>Eski şifre</strong> 
			<br>
			<input class="form-control" type="password" minlength="4" maxlength="16" type="text" name="esifre" />
			<br><br>
			<strong>Yeni Şifre</strong> 
			<br>
			<input class="form-control" type="password" minlength="4" maxlength="16" type="text" name="ysifre" />
			<br><br>
			<strong>Yeni Şifre Tekrar</strong>
			<br>
			<input class="form-control" type="password" minlength="4" maxlength="16" type="text" name="ysifre2" />
			<br>
			<input class="btn btn-success" type="submit" name="sifredegis" value="Tıkla, şifre değiştir" style="margin-top: 15px">
			<br><br>
			</form>
		</div>
			</center>
						</center>
					</p> 
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