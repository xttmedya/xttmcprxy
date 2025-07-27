 <?php
include('baglan.php');
$ban_ip         = $_GET['ban_ip'];
$ban_id_sil         = $_GET['ban_id_sil'];
$saat         = date("H:i",(time()+0)); //bu seçenek değişebilir saat bazen Türkiye saatini göstermiyor olabilir ona göre 0 yerine 3600 (1saat) ekleyip yada çıkartabilirsiniz.
$tarih            = date("d.m.Y"); //tarih bilgilerini rakam olarak girer. örn: 13.08.2011
if ($ban_ip==0) { //buradaki mantık size kalmış o zaman daha az bilgiye sahiptim ve böyle bir mantıkla yol almışım
    echo  ""; }
    else {
$ban = mysql_query("insert into ban (ban_id, ban_ip, saat, tarih) values (NULL, '$ban_ip', '$saat', '$tarih')"); }
if ($ban_id_sil==0){ //buradaki mantık size kalmış o zaman daha az bilgiye sahiptim ve böyle bir mantıkla yol almışım
 echo ""; }
 else {
$bansil = mysql_query("delete from ban where ban_id='$ban_id_sil'");}

echo "Listeye Yönlendiriliyorsunuz...<meta http-equiv='refresh' content='3;URL=index.php' />"
?> 