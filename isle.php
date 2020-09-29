<?php 
function curlCall($strURL)
{
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_HEADER, 0);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_URL, $strURL);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
  $rsData = curl_exec($ch);
  curl_close($ch);
  return $rsData;
}
function indir($adres,$ad)
{
    if (!extension_loaded(curl)) {
        die("cURL eklentisi sunucunuzda bulunamadı.");
    }

    $ch = curl_init("$adres");
    if (!$ch) {
        die("Oturum açılamadı");
    }
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    $data = curl_exec($ch);
    curl_close($ch);

    $islem = fopen("$ad", "a+");
    fwrite($islem, $data);
    fclose($islem);
    if (!$islem) {
        echo "API iletişimi başarısız";
    }
}

$lastversion = curlCall('https://mycraftupdate.netlify.com/lastversion.txt');
indir("https://mycraftupdate.netlify.com/updates/".$lastversion.".zip","".$lastversion.".zip");

$zipArchive = new ZipArchive();
$result = $zipArchive->open("".$lastversion.".zip");
if ($result === TRUE) {
    $zipArchive ->extractTo(__DIR__);
    $zipArchive ->close();
    unlink("".$lastversion.".zip");
    $open = fopen("admin/version.ver", "w");
    ?>
    <meta http-equiv="refresh" content="3;url=admin"> 
    <div>
      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
      <script type="text/javascript">swal("Güncelleme tamamlandı!", "MyCraft başarıyla güncellendi!", "success");
      </script>
      </div> 
    <?php
  $write = fwrite($open, $lastversion);
} else {
    echo "0";
}
 ?>