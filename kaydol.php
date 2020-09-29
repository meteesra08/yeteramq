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
		$kadi = htmlspecialchars($_POST["kadi"]);
		$pass = $_POST["sifre"];
		$passtkr = $_POST["sifretkr"];
		$email = $_POST["email"];
		if ($pass == $passtkr) {
		
		if(strlen($kadi)>=4 && strlen($pass)>=4)
		{

			$sifre = md5($pass);
			$sorgu = $db->prepare("insert into authme (username, password, ip, lastlogin, x, y, z, email) values ('$kadi', '$sifre', '0', 'null', '0', '0', '0', '$email')");
			$sorgu->execute();
			
			if($sorgu){
				$_SESSION['user_nick'] = $kadi;
				?>
               <div>
			<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
			<script type="text/javascript">swal.fire("Başarılı!", "Kayıt tamamlandı. Ana sayfaya yönlendiriliyorsunuz..", "success");
			</script>
			</div>
               <?php
				echo '<meta http-equiv="refresh" content="3;URL=index.php">';
			} else{
				?>
               <div>
			<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
			<script type="text/javascript">swal.fire("Hata!", "Bu kullanıcı zaten kayıtlı.", "error");
			</script>
			</div>
               <?php
			}
		}
		else
		{
			?>
               <div>
			<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
			<script type="text/javascript">swal.fire("Hata!", "Lütfen boş alan bırakmayın.", "error");
			</script>
			</div>
               <?php
		}
	} else {
	?>
	<div>
			<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
			<script type="text/javascript">swal.fire("Hata!", "Şifreleriniz eşleşmiyor.", "error");
			</script>
			</div>
	<?php
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
				<style type="text/css"><?php //SAS ?>
					.swal2-popup {
  font-size: 1.6rem !important;
}

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
						
					</ul>
				</div>
			</div> 
 
		</div> 

 
<br>
<div class="content-2">
		<div class="col-lg-8">
			<div style="border: 0px solid; border-radius: 10px;" class="MainNews">
				<div style="border: 0px solid; border-radius: 10px;" class="NewsTitle">
					<center>
					<h3><b>KAYIT OL</b></h3>
					<h5><b>KAYIT ÜCRETSİZDİR.</b></h5>
					</center>
				</div>
		 
				<div style="border: 0px solid; border-radius: 10px;" class="NewsATT">
				 
					<div>&nbsp;</div>
					<p>
					<center>
						<form action="" method="post">
							<h5>Minecraft Kullanıcı adı:</h5>
							<input class="form-control" type="text" name="kadi"></input><br>
							<h5>E-Posta Adresi:</h5>
							<input class="form-control" type="text" name="email"></input><br>
							<h5>Şifre:</h5>
							<input class="form-control" type="password" name="sifre"></input><br>
							<h5>Şifre Tekrar:</h5>
							<input class="form-control" type="password" name="sifretkr"></input>
							<br>
							<b>
							<input value="Kayıt ol" type="submit" class="btn btn-success"></input></b>
						</form>
					</center>
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