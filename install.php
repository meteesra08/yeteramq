<?php

if(file_exists('baglanti.php')){
  die("Kurulum zaten yapilmis!");
}
else{

$sifre = $_POST['sifre'];
$sifremd5 = md5($sifre);

$kadi = $_POST['ak'];

  if ($_POST){
    
    $host = $_POST["host"];
    $username = $_POST["username"];
    $pass = $_POST["pass"];
    $veritabani = $_POST["db"];
    $url = $_POST["url"];

    try {

$sql = "
CREATE TABLE `alinanurun` (
  `urun_id` int(11) NOT NULL,
  `urun_isim` varchar(50) NOT NULL,
  `username` varchar(30) NOT NULL,
  `urun_fiyat` int(3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
";
$sql2 = "
CREATE TABLE `authme` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `ip` varchar(40) NOT NULL,
  `lastlogin` bigint(20) DEFAULT NULL,
  `x` smallint(6) DEFAULT '0',
  `y` smallint(6) DEFAULT '0',
  `z` smallint(6) DEFAULT '0',
  `yetki` tinyint(4) NOT NULL DEFAULT '0',
  `kredi` smallint(6) NOT NULL DEFAULT '0',
  `email` varchar(255) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `authme` (`id`, `username`, `password`, `ip`, `lastlogin`, `x`, `y`, `z`, `yetki`, `kredi`) VALUES
(1, '$kadi', '$sifremd5', '', NULL, 0, 0, 0, 1, 0);
";
$sql3 = "
CREATE TABLE `ayar` (
  `ayar_id` int(11) NOT NULL,
  `site_title` varchar(50) NOT NULL,
  `sunucu_ip` varchar(50) NOT NULL,
  `sunucu_isim` varchar(200) NOT NULL,
  `websend_sayisalip` varchar(20) NOT NULL,
  `websend_sifre` varchar(100) NOT NULL,
  `websend_port` varchar(10) NOT NULL,
  `batihost_id` varchar(10) NOT NULL,
  `batihost_email` varchar(100) NOT NULL,
  `batihost_token` varchar(255) NOT NULL,
  `keyword` varchar(255) NOT NULL,
  `descri` varchar(255) NOT NULL,
  `sayfalimit` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `ayar` (`ayar_id`, `site_title`, `sunucu_ip`, `sunucu_isim`, `websend_sayisalip`, `websend_sifre`, `websend_port`, `batihost_id`, `batihost_email`, `batihost_token`, `sayfalimit`) VALUES
(0, 'MyCraft Minecraft Web Scripti', 'play.mycraft.com', 'MyCraft v3', '127.0.0.1', 'mycraft', '4445', '0000', 'mail@mail.com', 'wbny', '3');
";
$sql4 = "
CREATE TABLE `krediler` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `metod` varchar(10) NOT NULL,
  `miktar` varchar(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
";
$sql5 = "
CREATE TABLE `urunler` (
  `urun_id` int(11) NOT NULL,
  `urun_isim` varchar(50) NOT NULL,
  `urun_fiyat` int(11) NOT NULL,
  `urun_komut` varchar(255) NOT NULL,
  `urun_komut2` varchar(255) NOT NULL,
  `urun_komut3` varchar(255) NOT NULL,
  `sunucu` varchar(255) NOT NULL,
  `urun_acikla` varchar(255) NOT NULL,
  `sunucu_link` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
";
$sql6 = "
CREATE TABLE `yazilar` (
  `id` int(11) NOT NULL,
  `baslik` varchar(255) NOT NULL,
  `yazi` text NOT NULL,
  `yazar` varchar(255) NOT NULL,
  `tarih` varchar(255) NOT NULL,
  `kategori` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `yazilar` (`id`, `baslik`, `yazi`, `yazar`, `tarih`, `kategori`) VALUES
(9, 'MyCraft Test Haber', 'Web siteniz başarılı bir şekilde kurulmuştur. Bu yazıyı admin panelinden (siteadresi.com/admin) silebilirsiniz.', 'MyCraft', '05:24 - 23.03.2019', 'Duyuru');
";
$sql7 = "
ALTER TABLE `alinanurun`
  ADD PRIMARY KEY (`urun_id`);

ALTER TABLE `authme`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `krediler`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `urunler`
  ADD PRIMARY KEY (`urun_id`);

ALTER TABLE `yazilar`
  ADD PRIMARY KEY (`id`);
";
$sql8 = "
ALTER TABLE `alinanurun`
  MODIFY `urun_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `authme`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `krediler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `urunler`
  MODIFY `urun_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `yazilar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
";
$sql9 = "
CREATE TABLE IF NOT EXISTS `tickets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nick` varchar(255) NOT NULL,
  `baslik` varchar(255) NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `mesaj` text NOT NULL,
  `durum` varchar(255) NOT NULL,
  `son_guncelleme` varchar(255) NOT NULL,
  `kanit` text NOT NULL,
  `cevap` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
";
$sql10 = "
CREATE TABLE IF NOT EXISTS `tickets_sc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nick` varchar(255) NOT NULL,
  `soru` text NOT NULL,
  `cevap` text NOT NULL,
  `ticket_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
";
$sql11 = "
CREATE TABLE IF NOT EXISTS `Sunucular` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sunucu_resim` text NOT NULL,
  `ip` varchar(255) NOT NULL,
  `sunucu` varchar(255) NOT NULL,
  `port` varchar(255) NOT NULL,
  `sunucu_sifre` varchar(255) NOT NULL,
  `sunucu_link` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
";
$sql12 = "
CREATE TABLE IF NOT EXISTS `kupon` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kod` varchar(255) NOT NULL,
  `deger` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
";

         $db = new PDO("mysql:host=$host;dbname=$veritabani;charset=utf8", "$username", "$pass");
         $db->query($sql);
         $db->query($sql2);
         $db->query($sql3);
         $db->query($sql4);
         $db->query($sql5);
         $db->query($sql6);
         $db->query($sql7);
         $db->query($sql8);
         $db->query($sql9);
         $db->query($sql10);
           $db->query($sql11);
           $db->query($sql12);

    } catch ( PDOException $e ){

        ?>
        <div>
      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
      <script type="text/javascript">swal("Kurulum tamamlanamadı!", "MySQL veritabanına bağlanılamadı!", "error");
      </script>
      </div>  
        <?php

        header("refresh:3;url=install.php");

    }
    if($db){

      $olustur = touch("baglanti.php");

      if($olustur){
        $ac     = fopen('baglanti.php', 'w');
        $icerik = '
<?php

// MyCraft veritabanı bağlantı sayfasıdır. Dokunmayınız.

$host = "'.$host.'"; //sunucu
$kullanici = "'.$username.'"; //kullanici adi
$sifre = "'.$pass.'"; //sifre
$db = "'.$veritabani.'";//veritabani ismi 

try {
     $db = new PDO("mysql:host=$host;dbname=$db;charset=utf8", "$kullanici", "$sifre");
} catch ( PDOException $e ){
     print $e->getMessage();
}

?>
';

        $kaydet = fwrite($ac, $icerik);

        ?>
       <!DOCTYPE html>
<html>
  <head>
    
    <title>MyCraft - Kurulum</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.1/css/bulma.css" />
    <style type="text/css">
    body, html {
    background: #F7F7F7;
    }
    </style>
  </head>
  <body>
    <div class="container main_body"> <div class="section" >
      <div class="column is-6 is-offset-3">
        <center><h1 class="title" style="padding-top: 20px">
        MyCraft | Kurulum
        </h1><br></center>
        <div class="box">
            <div class="notification is-success"><b>BAŞARILI!</b> MyCraft başarıyla kuruldu. İyi kullanımlar.</div>
</body>
</html>
        <?php

        header("refresh:2;url=index.php");
      }

    


  }else{
    header("Location: install.php");
  }
}else{

?>
<!DOCTYPE html>
<html>
  <head>
    
    <title>MyCraft - Kurulum</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.1/css/bulma.css" />
    <style type="text/css">
    body, html {
    background: #F7F7F7;
    }
    </style>
  </head>
  <body>
    <div class="container main_body"> <div class="section" >
      <div class="column is-6 is-offset-3">
        <center><h1 class="title" style="padding-top: 20px">
        MyCraft | Kurulum
        </h1><br></center>
        <div class="box">
          <form action="" method="POST">
            <div class="notification is-primary">MyCraft kurulumuna hoşgeldiniz!</div>
            <div class="field">
              <label class="label">MySQL Sunucu (HOST)</label>
              <div class="control">
                <input class="input" type="text" placeholder="MySQL sunucu adresiniz." name="host" required>
              </div>
            </div>
            <div class="field">
              <label class="label">MySQL Kullanıcı Adı</label>
              <div class="control">
                <input class="input" type="text" placeholder="MySQL kullanıcı adınız." name="username" required>
              </div>
            </div>
            <div class="field">
              <label class="label">MySQL Veritabanı Adı</label>
              <div class="control">
                <input class="input" type="text" placeholder="MySQL veritabanınızın adı." name="db" required>
              </div>
            </div>
            <div class="field">
              <label class="label">MySQL Şifre</label>
              <div class="control">
                <input class="input" type="password" placeholder="MySQL sunucu şifreniz." name="pass" required>
              </div>
            </div>
            <div class="field">
              <label class="label">Admin Kullanıcı Adı</label>
              <div class="control">
                <input class="input" type="text" placeholder="İstediğiniz admin kullanıcı adını yazınız." name="ak" required>
              </div>
            </div>
            <div class="field">
              <label class="label">Admin Şifresi</label>
              <div class="control">
                <input class="input" type="password" placeholder="İstediğiniz admin şifresini yazınız." name="sifre" required>
              </div>
            </div>
            <div style='text-align: right;'>
              <button type="submit" class="button is-link">Kurulumu Başlat</button>
            </div>
          </form>
<?php } } ?> 
</body>
</html>