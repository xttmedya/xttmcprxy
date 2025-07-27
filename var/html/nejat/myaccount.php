<?php 
include 'dbc.php';
page_protect();


?>
<html>
<head>
<title>Fast IP Tv Control Panel V6</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<link href="styles.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="5" class="main">
  <tr> 
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr> 
    <td width="160" valign="top">
<?php 
/*********************** MYACCOUNT MENU ****************************
This code shows my account menu only to logged in users. 
Copy this code till END and place it in a new html or php where
you want to show myaccount options. This is only visible to logged in users
*******************************************************************/
if (isset($_SESSION['user_id'])) {?>
<div class="myaccount">
<a href="http://iptv.gen.tr"><img src="logo.png" alt=""></a><br>
  <p><strong></strong></p>
  <a href="myaccount.php"><img src="home.png" alt=""></a><br>
  <a href="mysettings.php"><img src="settings.png" alt=""></a><br>


<?php }
if (checkAdmin()) {
?>
  <a href="stat.php"><img src="stats.png" alt=""></a><br>
  <a href="admin.php?q=&qoption=recent&doSearch=Ara"><img src="users.png" alt=""></a><br>
  <a href="stream.php"><img src="stream.png" alt=""></a><br>
  <a href="paylas.php"><img src="streamsh.png" alt=""></a><br>
   <a href="streamlog.php"><img src="streamlog.png" alt=""></a><br>



<?php } ?>
<br>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <th scope="col"><a href="logout.php"><img src="exit.png" alt=""></a></th>
    <th scope="col"><a href="serverreboot.php"><img src="reboot1.jpg" alt="SUNUCUYU REBOOT EDER"></a></th>
  </tr>
  </table>

  <br>
  
   <br>
 
</td>
    <td width="3500" valign="top"><p>&nbsp;</p>
      <h3 class="titlehdr">Merhaba    <?php echo $_SESSION['user_name'];?></h3> 
<?php

	
      if (isset($_GET['msg'])) {
	  echo "<div class=\"error\">$_GET[msg]</div>";
	  }
	  	  
	  ?>
      <p></p>

<body bgcolor="white" text="black" link="blue" vlink="purple" alink="red">
<h3><a href="http://www.dosya.tc/server20/UTHSwI/nStreamPlayer.rar.html"><u><font face="Comic Sans MS">Nstream Player Indir</font></u><font face="Comic Sans MS"> </font></a><font face="Comic Sans MS">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u><a href="http://www.dailymotion.com/video/xsff5f_nstreamplayeryukleme_shortfilms">Nstream Player Kurulum
Videosu</a></u></font></h3>
<h3><u><font face="Comic Sans MS"><a href="http://tr.rghost.net/37568409">Simpletv Indir</a></font></u><font face="Comic Sans MS">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u><a href="http://www.youtube.com/watch?v=A8ldxe-KAJg">Simpletv Player Kurulum Videosu</a></u></font></h3>
<h3><u><font face="Comic Sans MS"><a href="http://sourceforge.net/projects/vlc/files/latest/download?_test=redirect&utm_expid=6384-3&utm_referrer=http%3A%2F%2Fwww.gezginler.net%2Findir%2Fvlc-videolan.html">Vlc Player Indir</a></font></u><font face="Comic Sans MS"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a
href="http://liveonsat.com/quickindex.html">HANGI MAC HANGI KANALDA ?</a></font></h3>
<p><font face="Comic Sans MS"><a href="http://www.utrace.de"><b>IP SORGULA</b></a><b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></font></p>
<p>&nbsp;</p>
</body>


      </td>
    <td width="196" valign="top">&nbsp;</td>
  </tr>
  <tr> 
    <td colspan="3">&nbsp;</td>
  </tr>
</table>
<br><center></a><body background="panelli.jpg"><br></center> 
</body>
</html>
