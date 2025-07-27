 <?php
///
$host="localhost";
$kullanici="fast";
$sifre="fast1122";
$database="iptvdb";
///
$link = mysql_connect("$host", "$kullanici", "$sifre") or die(mysql_error());
$db = mysql_select_db("$database", $link) or die (mysql_error());
?> 
