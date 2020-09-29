
<?php 

session_start(); //session işlemini başlatıyoruz.
if(!isset($_SESSION['user_nick']))//session varmı die kontrol ediyoruz. yok ise buraya giricek
{ 

?>
<?php
include("baglanti.php");

?>
	
	<div class="col-lg-4">
			<div style="border: 0px solid; border-radius: 10px;" class="MainNews">
				<div style="border: 0px solid; border-radius: 10px;" class="NewsTitle text-center">
					<h4><b>Giriş Yap / Kayıt Ol</b></h4>
				</div>
		 
				<div class="NewsATT ">
					<div>&nbsp;</div>
					<center>
						<form action="" method="post">
							<h5>Minecraft Kullanıcı adı:</h5>
							<input class="form-control" type="text" name="kadi"></input><br>
							<h5>Şifre:</h5>
							<input class="form-control" type="password" name="sifre"></input>
							<br>
							<input value="Giriş yap" type="submit" class="btn btn-success"></input>
						</form>
						<br>
						<h4>Üye değil misin? <a href="kaydol.php">Hemen üye olun</a></h4>
					</center>
				</div>
			</div>
						<br>
<div class="col-lg-20">
			<div style="border: 0px solid; border-radius: 10px;" class="MainNews">
				<div style="border: 0px solid; border-radius: 10px;" class="NewsTitle text-center">
					<h4><b>SUNUCU BİLGİLERİ</b></h4>
				</div>
		 
				<div class="NewsATT ">
					<div>&nbsp;</div>
					<center><h4 class="Main-Sidebar-Block-Content">
<?php
//Get the status and decode the JSON
$status = json_decode(file_get_contents('https://api.mcsrvstat.us/2/'.$ayarcek['sunucu_ip'].''));

$sayioyuncu = $status->players->online;

if ($sayioyuncu > 0){
	?>
	<h5><center>Sunucu Durumu:</center></h5>
	<style type="text/css">.badge-acik, .label-acik {
    background-color: #8cc152;
    border-color: #8cc152;
}</style>
<span class="label label-acik" id="durum">Açık</span>
<hr>
	<h5><center>Sunucudaki Kişi Sayısı:</center></h5>
	<style type="text/css">.badge-online, .label-online {
    background-color: #f6bb42;
    border-color: #f6bb42;
}</style>
<span class="label label-online" id="durum"><?php echo $sayioyuncu; ?></span>
	<?php
}else{
?>
<h5><center>Sunucu Durumu:</center></h5>
	<style type="text/css">.badge-kapali, .label-kapali {
    background-color: #da4453;
    border-color: #da4453;
}</style>
<span class="label label-kapali" id="durum">Kapalı</span>
<?php
}

?>

			<br><hr>
			<h5><center>Kayıtlı Kişi Sayısı:</center></h5>
	<style type="text/css">.badge-warning, .label-warning {
    background-color: #f6bb42;
    border-color: #f6bb42;
}</style>
<span class="label label-warning" id="durum">
			<?php
				$kayit_cek = $db->prepare("SELECT * FROM authme ORDER BY id DESC LIMIT 1");
				$kayit_cek->execute();
				$kayit_oku = $kayit_cek->fetch();
											
				if($kayit_cek->rowCount() != 0){
				echo $kayit_oku["id"];
				}
				else{
					echo "0";
				}
			?>
			</span>
			<br><hr>
			<h5><center>Sunucu IP Adresi:</center></h5>
	<style type="text/css">.badge-success, .label-success {
    background-color: #da4453;
    border-color: #da4453;
}</style>
<span class="label label-success" id="durum"><?php echo $ayarcek['sunucu_ip']; ?></span>

				</div>
			</div>	
			<br>
<div class="col-lg-20">
			<div style="border: 0px solid; border-radius: 10px;" class="MainNews">
				<div style="border: 0px solid; border-radius: 10px;" class="NewsTitle text-center">
					<h4><b>SON ALINAN 3 ÜRÜN</b></h4>
				</div>
		 
				<div class="NewsATT ">
					<div>&nbsp;</div>
					<table id="example2" class="table table-bordered table-hover">
                <thead>

                <tr>
                  <th>#</th>
                  <th><center>Kullanıcı adı</center></th>
                  <th><center>Ürün</center></th>
                </tr>

                </thead>
                <tbody>

                <?php 
                $urunsor=$db->prepare("SELECT * FROM alinanurun order by urun_id desc limit 0, 3");
				$urunsor->execute();
				while($uruncek=$urunsor->fetch(PDO::FETCH_ASSOC)) {?>

                <tr>
                  <td><center><img style="border: 0px solid; border-radius: 4px;" src="https://cravatar.eu/avatar/<?php echo $uruncek['username']; ?>/24.png"></center></td>
                  <td><center><?php echo $uruncek['username']; ?></center></td>
                  <td><center><?php echo $uruncek['urun_isim']; ?> (<?php echo $uruncek['urun_fiyat']; ?>₺)</center></td>
                </tr>

            	<?php } ?>

                </tbody>
              </table>
				</div>
			</div>	
			<br>
<div class="col-lg-20">
			<div style="border: 0px solid; border-radius: 10px;" class="MainNews">
				<div style="border: 0px solid; border-radius: 10px;" class="NewsTitle text-center">
					<h4><b>SON ALINAN 3 KREDİ</b></h4>
				</div>
		 
				<div class="NewsATT ">
					<div>&nbsp;</div>
					<table id="example2" class="table table-bordered table-hover">
                <thead>

                <tr>
                  <th>#</th>
                  <th><center>Kullanıcı adı</center></th>
                  <th><center>Yüklenen Kredi</center></th>
                  <th><center>Ödeme Yöntemi</center></th>
                </tr>

                </thead>
                <tbody>

                <?php 
                $kredisor=$db->prepare("SELECT * FROM krediler order by id desc limit 0, 3");
				$kredisor->execute();
				while($kredicek=$kredisor->fetch(PDO::FETCH_ASSOC)) {?>

                <tr>
                  <td><center><img style="border: 0px solid; border-radius: 4px;" src="https://cravatar.eu/avatar/<?php echo $kredicek['username']; ?>/24.png"></center></td>
                  <td><center><?php echo $kredicek['username']; ?></center></td>
                  <td><center><?php echo $kredicek['miktar']; ?></center></td>
                  <td><center><?php echo $kredicek['metod']; ?></center></td>
                </tr>

            	<?php } ?>

                </tbody>
              </table>
				</div>
			</div>	
	</div>	
	</div>	
	</div>		
	</div>
	<div>&nbsp;</div>
	<div>&nbsp;</div>
<?php }else{//HG
?>

		<div class="col-lg-4">
			<div style="border: 0px solid; border-radius: 10px;" class="MainNews">
				<div style="border: 0px solid; border-radius: 10px;" class="NewsTitle text-center">
					<h4><b>Hesabım</b></h4>
				</div> 

				<div class="NewsATT">
					<center>
						<br><br>
					<?php
					include "baglanti.php";
		$kullanicisor=$db->prepare("SELECT * FROM authme WHERE username=:username");
		$kullanicisor->execute(array(
		'username' => $_SESSION['user_nick']
		));
		$kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC);
					?>
					<br>
					<img style="border: 0px solid; border-radius: 10px;" src="https://cravatar.eu/avatar/<?php echo $kullanicicek['username']; ?>/100.png">
					<h3><b>Hoşgeldin, <?php echo $_SESSION['user_nick']; ?></b>
					<h4>Krediniz: <?php echo $kullanicicek['kredi']; ?> TL <a href="krediyukle.php"><button class="btn btn-danger"><i style="font-size: 13px; color: #fffff;" class="fa fa-plus-circle"></i></button></a></h4>
					
					<h4>E-Posta: <?php echo $kullanicicek['email']; ?></h4>
					
					</h3>
					<?php
					if ($kullanicicek['yetki'] == 1) {
						?>
						<br>
						<a href="admin"><button class="btn btn-success">Admin Paneli</button></a>
						<?php
					}
					?>
					</center>
				</div>
			</div>
			<div>&nbsp;</div> 
			<br>
<div class="col-lg-20">
			<div style="border: 0px solid; border-radius: 10px;" class="MainNews">
				<div style="border: 0px solid; border-radius: 10px;" class="NewsTitle text-center">
					<h4><b>SUNUCU BİLGİLERİ</b></h4>
				</div>
		 
				<div class="NewsATT ">
					<div>&nbsp;</div>
					<center><h4 class="Main-Sidebar-Block-Content">
<?php
//Get the status and decode the JSON
$status = json_decode(file_get_contents('https://api.mcsrvstat.us/2/'.$ayarcek['sunucu_ip'].''));

$sayioyuncu = $status->players->online;

if ($sayioyuncu > 0){
	?>
	<h5><center>Sunucu Durumu:</center></h5>
	<style type="text/css">.badge-acik, .label-acik {
    background-color: #8cc152;
    border-color: #8cc152;
}</style>
<span class="label label-acik" id="durum">Açık</span>
<hr>
	<h5><center>Sunucudaki Kişi Sayısı:</center></h5>
	<style type="text/css">.badge-online, .label-online {
    background-color: #f6bb42;
    border-color: #f6bb42;
}</style>
<span class="label label-online" id="durum"><?php echo $sayioyuncu; ?></span>
	<?php
}else{
?>
<h5><center>Sunucu Durumu:</center></h5>
	<style type="text/css">.badge-kapali, .label-kapali {
    background-color: #da4453;
    border-color: #da4453;
}</style>
<span class="label label-kapali" id="durum">Kapalı</span>
<?php
}

?>

			<br><hr>
			<h5><center>Kayıtlı Kişi Sayısı:</center></h5>
	<style type="text/css">.badge-warning, .label-warning {
    background-color: #f6bb42;
    border-color: #f6bb42;
}</style>
<span class="label label-warning" id="durum">
			<?php
				$kayit_cek = $db->prepare("SELECT * FROM authme ORDER BY id DESC LIMIT 1");
				$kayit_cek->execute();
				$kayit_oku = $kayit_cek->fetch();
											
				if($kayit_cek->rowCount() != 0){
				echo $kayit_oku["id"];
				}
				else{
					echo "0";
				}
			?>
			</span>
			<br><hr>
			<h5><center>Sunucu IP Adresi:</center></h5>
	<style type="text/css">.badge-success, .label-success {
    background-color: #da4453;
    border-color: #da4453;
}</style>
<span class="label label-success" id="durum"><?php echo $ayarcek['sunucu_ip']; ?></span>

				</div>
			</div>	
			<br>
<div class="col-lg-20">
			<div style="border: 0px solid; border-radius: 10px;" class="MainNews">
				<div style="border: 0px solid; border-radius: 10px;" class="NewsTitle text-center">
					<h4><b>SON ALINAN 3 ÜRÜN</b></h4>
				</div>
		 
				<div class="NewsATT ">
					<div>&nbsp;</div>
					<table id="example2" class="table table-bordered table-hover">
                <thead>

                <tr>
                  <th>#</th>
                  <th><center>Kullanıcı adı</center></th>
                  <th><center>Ürün</center></th>
                </tr>

                </thead>
                <tbody>

                <?php 
                $urunsor=$db->prepare("SELECT * FROM alinanurun order by urun_id desc limit 0, 3");
				$urunsor->execute();
				while($uruncek=$urunsor->fetch(PDO::FETCH_ASSOC)) {?>

                <tr>
                  <td><center><img style="border: 0px solid; border-radius: 4px;" src="https://cravatar.eu/avatar/<?php echo $uruncek['username']; ?>/24.png"></center></td>
                  <td><center><?php echo $uruncek['username']; ?></center></td>
                  <td><center><?php echo $uruncek['urun_isim']; ?> (<?php echo $uruncek['urun_fiyat']; ?>₺)</center></td>
                </tr>

            	<?php } ?>

                </tbody>
              </table>
				</div>
			</div>	
			<br>
<div class="col-lg-20">
			<div style="border: 0px solid; border-radius: 10px;" class="MainNews">
				<div style="border: 0px solid; border-radius: 10px;" class="NewsTitle text-center">
					<h4><b>SON ALINAN 3 KREDİ</b></h4>
				</div>
		 
				<div class="NewsATT ">
					<div>&nbsp;</div>
					<table id="example2" class="table table-bordered table-hover">
                <thead>

                <tr>
                  <th>#</th>
                  <th><center>Kullanıcı adı</center></th>
                  <th><center>Yüklenen Kredi</center></th>
                  <th><center>Ödeme Yöntemi</center></th>
                </tr>

                </thead>
                <tbody>

                <?php 
                $kredisor=$db->prepare("SELECT * FROM krediler order by id desc limit 0, 3");
				$kredisor->execute();
				while($kredicek=$kredisor->fetch(PDO::FETCH_ASSOC)) {?>

                <tr>
                  <td><center><img style="border: 0px solid; border-radius: 4px;" src="https://cravatar.eu/avatar/<?php echo $kredicek['username']; ?>/24.png"></center></td>
                  <td><center><?php echo $kredicek['username']; ?></center></td>
                  <td><center><?php echo $kredicek['miktar']; ?></center></td>
                  <td><center><?php echo $kredicek['metod']; ?></center></td>
                </tr>

            	<?php } ?>

                </tbody>
              </table>
				</div>
			</div>	
	</div>	
	</div>	
	</div>	
		</div> 
	 		
 
 <?php } ?>
<div>&nbsp;</div>

 </div>

</div>
