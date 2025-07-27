<?php 
include 'dbc.php';
page_protect();


?>
<html>
<head>
<title>Istatistik</title>
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


    <td width="4000" valign="top"><p>&nbsp;</p>

      <h3 class="titlehdr">Yayin Istatistikleri ...</h3>
<p>KULLANICI BILGILERI 5 DAKIKA SURE ILE GUNCELLENMEKTEDIR</p>
	  <?php	
include 'stat.html';

	  	  
	  ?>
      <p></p>

	 
      </td>
    <td width="196" valign="top">&nbsp;</td>
  </tr>
  <tr> 
    <td colspan="3">&nbsp;</td>
  </tr>
</table>

</body>
</html>
