<?php 
include 'dbc.php';
page_protect();

if(!checkAdmin()) {
header("Location: login.php");
exit();
}
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
	<th scope="col"><a href="loglar.php"><img src="reset.jpg" alt=""></a></th>
  </tr>
  </table>

  <br>
  
   <br>
 
</td>

    <td width="3500" valign="top"><p>&nbsp;</p>
      <h3 class="titlehdr">Merhaba    <?php echo $_SESSION['user_name'];?></h3> 

	  
	  <table class="hovertable">
<p>Port: 5001</p>
<tr onMouseOver="this.style.backgroundColor='#ffff66';" onMouseOut="this.style.backgroundColor='#d4e3e5';">
<?php include("log/st1.php")?>
</tr>


</table>

<table class="hovertable">

<br>
<p>Port: 5002</p>
<tr onMouseOver="this.style.backgroundColor='#ffff66';" onMouseOut="this.style.backgroundColor='#d4e3e5';">
<?php include("log/st2.php")?>
</tr>
</table>


<table class="hovertable">
<br>
<p>Port: 5003</p>
<tr onMouseOver="this.style.backgroundColor='#ffff66';" onMouseOut="this.style.backgroundColor='#d4e3e5';">
<?php include("log/st3.php")?>
</tr>
</table>

<table class="hovertable">
<br>
<p>Port: 5004</p>
<tr onMouseOver="this.style.backgroundColor='#ffff66';" onMouseOut="this.style.backgroundColor='#d4e3e5';">
<?php include("log/st4.php")?>
</tr>
</table>


<table class="hovertable"><br>
<p>Port: 5005</p>
<tr onMouseOver="this.style.backgroundColor='#ffff66';" onMouseOut="this.style.backgroundColor='#d4e3e5';">
<?php include("log/st5.php")?>
</tr>
</table>

<table class="hovertable"><br>
<p>Port: 5006</p>
<tr onMouseOver="this.style.backgroundColor='#ffff66';" onMouseOut="this.style.backgroundColor='#d4e3e5';">
<?php include("log/st6.php")?>
</tr>
</table>

<table class="hovertable"><br>
<p>Port: 5007</p>
<tr onMouseOver="this.style.backgroundColor='#ffff66';" onMouseOut="this.style.backgroundColor='#d4e3e5';">
<?php include("log/st7.php")?>
</tr>
</table>

<table class="hovertable"><br>
<p>Port: 5008</p>
<tr onMouseOver="this.style.backgroundColor='#ffff66';" onMouseOut="this.style.backgroundColor='#d4e3e5';">
<?php include("log/st8.php")?>
</tr>
</table>

<table class="hovertable"><br>
<p>Port: 5009</p>
<tr onMouseOver="this.style.backgroundColor='#ffff66';" onMouseOut="this.style.backgroundColor='#d4e3e5';">
<?php include("log/st9.php")?>
</tr>
</table>

<table class="hovertable"><br>
<p>Port: 5010</p>
<tr onMouseOver="this.style.backgroundColor='#ffff66';" onMouseOut="this.style.backgroundColor='#d4e3e5';">
<?php include("log/st10.php")?>
</tr>
</table>

<table class="hovertable"><br>
<p>Port: 5011</p>
<tr onMouseOver="this.style.backgroundColor='#ffff66';" onMouseOut="this.style.backgroundColor='#d4e3e5';">
<?php include("log/st11.php")?>
</tr>
</table>

<table class="hovertable"><br>
<p>Port: 5012</p>
<tr onMouseOver="this.style.backgroundColor='#ffff66';" onMouseOut="this.style.backgroundColor='#d4e3e5';">
<?php include("log/st12.php")?>
</tr>
</table>

<br>
<table class="hovertable"><p>Port: 5013</p>
<tr onMouseOver="this.style.backgroundColor='#ffff66';" onMouseOut="this.style.backgroundColor='#d4e3e5';">
<?php include("log/st13.php")?>
</tr>
</table>

<table class="hovertable"><br>
<p>Port: 5014</p>
<tr onMouseOver="this.style.backgroundColor='#ffff66';" onMouseOut="this.style.backgroundColor='#d4e3e5';">
<?php include("log/st14.php")?>
</tr>
</table>

<table class="hovertable"><br>
<p>Port: 5015</p>
<tr onMouseOver="this.style.backgroundColor='#ffff66';" onMouseOut="this.style.backgroundColor='#d4e3e5';">
<?php include("log/st15.php")?>
</tr>
</table>

<table class="hovertable"><br>
<p>Port: 5016</p>
<tr onMouseOver="this.style.backgroundColor='#ffff66';" onMouseOut="this.style.backgroundColor='#d4e3e5';">
<?php include("log/st15.php")?>
</tr>
</table>

<table class="hovertable"><br>
<p>Port: 5016</p>
<tr onMouseOver="this.style.backgroundColor='#ffff66';" onMouseOut="this.style.backgroundColor='#d4e3e5';">
<?php include("log/st16.php")?>
</tr>
</table>

<table class="hovertable"><br>
<p>Port: 5017</p>
<tr onMouseOver="this.style.backgroundColor='#ffff66';" onMouseOut="this.style.backgroundColor='#d4e3e5';">
<?php include("log/st17.php")?>
</tr>
</table>

<table class="hovertable"><br>
<p>Port: 5018</p>
<tr onMouseOver="this.style.backgroundColor='#ffff66';" onMouseOut="this.style.backgroundColor='#d4e3e5';">
<?php include("log/st18.php")?>
</tr>
</table>

<table class="hovertable"><br>
<p>Port: 5019</p>
<tr onMouseOver="this.style.backgroundColor='#ffff66';" onMouseOut="this.style.backgroundColor='#d4e3e5';">
<?php include("log/st19.php")?>
</tr>
</table>

<table class="hovertable"><br>
<p>Port: 5020</p>
<tr onMouseOver="this.style.backgroundColor='#ffff66';" onMouseOut="this.style.backgroundColor='#d4e3e5';">
<?php include("log/st20.php")?>
</tr>
</table>



         
      
      





    </body>


      </td>
    <td width="196" valign="top">&nbsp;</td>
  </tr>
  <tr> 
    <td colspan="3">&nbsp;</td>
  </tr>
</table>

</body>
</html>
