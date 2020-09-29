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
include("Websend.php");
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

$sunucu = $_GET["sunucu"];

if (!empty($_GET['uid'])) {
$ayarsor=$db->prepare("SELECT * FROM ayar where ayar_id = ?");
$ayarsor->execute(array(0));
$ayarcek=$ayarsor->fetch();

$urunsor=$db->prepare("SELECT * FROM urunler WHERE urun_id=:id");
$urunsor->execute(array('id' => $_GET['uid']));
$uruncek=$urunsor->fetch(PDO::FETCH_ASSOC);

$sec = $db->prepare("SELECT * FROM Sunucular WHERE sunucu_link = ?");
$sec->execute(array($uruncek["sunucu_link"]));	
$oku = $sec->fetch();

$kullanicisor = $db->prepare("select * from authme where username=:username");
$kullanicisor->execute(array('username' => $_SESSION['user_nick']));

$kullanici = $kullanicisor->fetch(PDO::FETCH_ASSOC);

if ($kullanici['kredi'] >= $uruncek['urun_fiyat']) {

		$ykredi= $kullanici['kredi'] - $uruncek['urun_fiyat'];

		$duzenle=$db->prepare("UPDATE authme SET kredi=:kredi WHERE id=:id");
		$azalt=$duzenle->execute(array('kredi' => $ykredi, 'id' => $kullanici['id']));

		$ekle=$db->prepare("INSERT INTO alinanurun SET urun_isim=:urun_isim, username=:username, urun_fiyat=:urun_fiyat");
		$yeniekle=$ekle->execute(array('urun_isim' => $uruncek['urun_isim'], 'username' => $kullanici['username'], 'urun_fiyat' => $uruncek['urun_fiyat']));

		if ($yeniekle) {
            $komut=$uruncek['urun_komut'];
            $komut2=$uruncek['urun_komut2'];
            $komut3=$uruncek['urun_komut3'];

            $ws = new Websend("".$oku['ip']."");
            $ws->password = "".$oku['sunucu_sifre']."";
            $ws->port = "".$oku['port']."";

            if($ws->connect()) {
                $ws->doCommandAsConsole(str_ireplace("%player%","".$_SESSION['user_nick']."","".$komut.""));
                if (!empty($komut2)) {
                	$ws->doCommandAsConsole(str_ireplace("%player%","".$_SESSION['user_nick']."","".$komut2.""));
                }
                if (!empty($komut3)) {
                	$ws->doCommandAsConsole(str_ireplace("%player%","".$_SESSION['user_nick']."","".$komut3.""));
                }
                ?>
                	<div>
			<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
			<script type="text/javascript">swal.fire("Başarılı!", "Ürün başarıyla satın alındı.", "success");
			</script>
			</div>
                <?php
                header("Refresh:3; url=index.php");
            }else{
               ?>
               <div>
			<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
			<script type="text/javascript">swal.fire("Hata!", "Ürün satın alınırken bir hata oluştu.", "error");
			</script>
			</div>
               <?php
               header("Refresh:3; url=index.php");
            }
            $ws->disconnect();
		} else {
			?>
               <div>
               	
			<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
			<script type="text/javascript">swal.fire("Hata!", "Ürün satın alınırken bir hata oluştu.", "error");
			</script>
			</div>
               <?php
              header("Refresh:3; url=index.php");
		}
	}
	else
	{
		?>
		<div>
			<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
			<script type="text/javascript">swal.fire("Hata!", "Krediniz yetersiz.", "error");
			</script>
			</div>
		<?php
		header("Refresh:3; url=index.php");
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
			<?php
			$urun_cek = $db->prepare("SELECT * FROM Urunler WHERE sunucu_link = ?");
			$urun_cek->execute(array($sunucu));
				if($urun_cek->rowCount() != 0){
					echo "<br>";
					foreach ($urun_cek as $urun_oku) {

			?>
         <section>
			<div style="border: 0px solid; border-radius: 10px;" class="MainNews">
				<div style="border: 0px solid; border-radius: 10px;" class="NewsTitle">
					<h3><b>  <?php echo $urun_oku['urun_isim']; ?></b></h3>
				</div>
		 
				<div class="NewsATT">
				 
					<div>&nbsp;</div>
					<p>
						<?php echo $urun_oku['urun_acikla']; ?>
					</p> 
				</div>
  
    		<div style="border: 0px solid; border-radius: 10px;" class="NewsFooter text-center">
    			<h4>Fiyat: <?php echo $urun_oku['urun_fiyat']; ?> TL</h4>
			<button class="button-1 moblie"><a class="btn-al" href="market2.php?uid=<?php echo $urun_oku['urun_id']; ?>"><i class="ion-arrow-right-c "></i> <b>Satın Al</b></a></button>

		</div><?php //CDN ?>
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
				<script>
					$('.btn-al').on('click', function(e) {
						e.preventDefault();
						const href = $(this).attr('href')
						swal.fire({
							title: "Oyunda mısınız?",
  							text: "Eğer bu ürünü aldığınız sunucuda değilseniz bu ürün elinize ulaşmayacaktır!",
  							icon: "warning",
  							showCancelButton: true,
  							confirmButtonColor: '#3085d6',
  							cancelButtonColor: '#d33',
  							cancelButtonText: 'Oyunda değilim!',
  							confirmButtonText: 'Oyundayım!',
						}).then((result) => {
							if (result.value) {
								document.location.href = href;
							}
						})
					})
				</script>

			</div>
<div>&nbsp;</div>
		</section>
		<br>
		<?php
			}
			}
			if(($urun_cek->rowCount() == 0)){
				if (empty($_GET['uid'])) {
				
					?><div>
			<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
			<script type="text/javascript">swal.fire("Hata", "Markete hiç ürün eklenmemiş.", "error");
			</script>
			</div><?php
				}

						}
?>
 
<div>&nbsp;</div>
</section>
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