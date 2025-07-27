<?php 
/********************** MYSETTINGS.PHP**************************
This updates user settings and password
************************************************************/
include 'dbc.php';
page_protect();

if(!checkAdmin()) {
header("Location: login.php");
exit();
}

$err = array();
$msg = array();


if($_POST['doSave'] == 'Kaydet Yayin 16')  
{
// Filter POST data for harmful code (sanitize)
foreach($_POST as $key => $value) {
	$data[$key] = filter($value);
}


mysql_query("UPDATE stream SET
			`stream_server` = '$data[yayin16]'
			 WHERE id='16'
			") or die(mysql_error());


//header("Location: stream.php?msg=Yayin 16 Icin Stream Ayarlari Degistirildi .... ");
$msg[] = "Yayin 16 Icin Stream Ayarlari Degistirildi ....  ";
 }
 

if($_POST['doSave'] == 'Kaydet Yayin 17')
{
// Filter POST data for harmful code (sanitize)
foreach($_POST as $key => $value) {
        $data[$key] = filter($value);
}               


mysql_query("UPDATE stream SET
                        `stream_server` = '$data[yayin17]'
                         WHERE id='17'
                        ") or die(mysql_error());


//header("Location: stream.php?msg=Yayin 17 Icin Stream Ayarlari Degistirildi ....  ");
$msg[] = "Yayin 17 Icin Stream Ayarlari Degistirildi .... ";
 }     

if($_POST['doSave'] == 'Kaydet Yayin 18')  
{
// Filter POST data for harmful code (sanitize)
foreach($_POST as $key => $value) {
	$data[$key] = filter($value);
}


mysql_query("UPDATE stream SET
			`stream_server` = '$data[yayin18]'
			 WHERE id='18'
			") or die(mysql_error());


//header("Location: stream.php?msg=Yayin 18 Icin Stream Ayarlari Degistirildi .... ");
$msg[] = "Yayin 18 Icin Stream Ayarlari Degistirildi ....  ";
 }
 

if($_POST['doSave'] == 'Kaydet Yayin 19')
{
// Filter POST data for harmful code (sanitize)
foreach($_POST as $key => $value) {
        $data[$key] = filter($value);
}               


mysql_query("UPDATE stream SET
                        `stream_server` = '$data[yayin19]'
                         WHERE id='19'
                        ") or die(mysql_error());


//header("Location: stream.php?msg=Yayin 19 Icin Stream Ayarlari Degistirildi ....  ");
$msg[] = "Yayin 19 Icin Stream Ayarlari Degistirildi .... ";
 }   


if($_POST['doSave'] == 'Kaydet Yayin 20')
{
// Filter POST data for harmful code (sanitize)
foreach($_POST as $key => $value) {
        $data[$key] = filter($value);
}               


mysql_query("UPDATE stream SET
                        `stream_server` = '$data[yayin20]'
                         WHERE id='20'
                        ") or die(mysql_error());


//header("Location: stream.php?msg=Yayin 20 Icin Stream Ayarlari Degistirildi ....  ");
$msg[] = "Yayin 20 Icin Stream Ayarlari Degistirildi .... ";
 }   


if($_POST['doSave'] == 'Restart Yayin 16')
{
foreach($_POST as $key => $value) {
        $data[$key] = filter($value);
}

$output = shell_exec("sudo -u iptv /home/iptv/ligtv/restart_stream stream16");

//header("Location: stream.php?msg=Yayin 16 Restart Edildi ... ");
$msg[] = "$output . Yayin 16 Restart Edildi ...";
 }

if($_POST['doSave'] == 'Restart Yayin 17')
{
foreach($_POST as $key => $value) {
        $data[$key] = filter($value);
}

$output = shell_exec("sudo -u iptv /home/iptv/ligtv/restart_stream stream17");

//header("Location: stream.php?msg=Yayin 17 Restart Edildi ... ");
$msg[] = "$output . Yayin 17 Restart Edildi ...";
 }

if($_POST['doSave'] == 'Restart Yayin 18')
{
foreach($_POST as $key => $value) {
        $data[$key] = filter($value);
}

$output = shell_exec("sudo -u iptv /home/iptv/ligtv/restart_stream stream18");

//header("Location: stream.php?msg=Yayin 18 Restart Edildi ... ");
$msg[] = "$output . Yayin 18 Restart Edildi ...";
 }


if($_POST['doSave'] == 'Restart Yayin 19')
{
foreach($_POST as $key => $value) {
        $data[$key] = filter($value);
}

$output = shell_exec("sudo -u iptv /home/iptv/ligtv/restart_stream stream19");

//header("Location: stream.php?msg=Yayin 19 Restart Edildi ... ");
$msg[] = "$output . Yayin 19 Restart Edildi ...";
 }

if($_POST['doSave'] == 'Restart Yayin 20')
{
foreach($_POST as $key => $value) {
        $data[$key] = filter($value);
}

$output = shell_exec("sudo -u iptv /home/iptv/ligtv/restart_stream stream20");

//header("Location: stream.php?msg=Yayin 20 Restart Edildi ... ");
$msg[] = "$output . Yayin 20 Restart Edildi ...";
 }


$rs_settings11 = mysql_query("select * from stream WHERE id='16' "); 
$rs_settings12 = mysql_query("select * from stream WHERE id='17' ");
$rs_settings13 = mysql_query("select * from stream WHERE id='18' ");
$rs_settings14 = mysql_query("select * from stream WHERE id='19' ");
$rs_settings15 = mysql_query("select * from stream WHERE id='20' ");
?>
<html>
<head>
<title>Yayin Ayarlari</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript" type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<script language="JavaScript" type="text/javascript" src="js/jquery.validate.js"></script>
  <script>
  $(document).ready(function(){
    $("#myform").validate();
	 $("#pform").validate();
  });
  </script>
<link href="styles.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="5" class="main">
  <tr> 
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr> 
    <td width="160" valign="top"><?php 
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
<h3 class="titlehdr">Yayin Ayarlari ...</h3>
<p>LUTFEN DIKKAT BU BOLUMDEN YAYIN &nbsp;VERECEGINIZ USERLER SINIRSIZ BAGLANMA VLC PALYERDE CALISMA YETKISINE SAHIP OLACAKTIR !!!</p>
<p>EGER BU BOLUM ILE ILGILI BILGINIZ YOKSA  BU PORTLARA YAYIN EKLEMEYINIZ VE HIC BIR KULLANICIYA VERMEYINIZ</p>
      <p> 
        <?php	
	if(!empty($err))  {
	   echo "<div class=\"msg\">";
	  foreach ($err as $e) {
	    echo "* Hata - $e <br>";
	    }
	  echo "</div>";	
	   }
	   if(!empty($msg))  {
	    echo "<div class=\"msg\">" . $msg[0] . "</div>";

	   }
	  ?>
      </p>

          <?php while ($row_settings = mysql_fetch_array($rs_settings11)) {?>
      <form action="paylas.php" method="post" name="myform" id="myform">
        <table width="70%" border="0" align="left" cellpadding="3" cellspacing="3" class="forms">
          <tr>
            <td colspan="2"><strong>YAYIN 16 - PORT 5016</strong><br> <input name="yayin16" type="text" id="yayin16"  class="required" value="<?php echo $row_settings['stream_server']; ?>" size="75">
          </tr>
<?php } ?>

        </table>
        <p align="center">
          <input name="doSave" type="submit" id="doSave" value="Kaydet Yayin 16">
          <input name="doSave" type="submit" id="doSave" value="Restart Yayin 16">
      </form>

     <br>
     <br>

          <?php while ($row_settings = mysql_fetch_array($rs_settings12)) {?>
      <form action="paylas.php" method="post" name="myform" id="myform">
        <table width="70%" border="0" align="left" cellpadding="3" cellspacing="3" class="forms">
          <tr>
            <td colspan="2"><strong>YAYIN 17 - PORT 5017</strong><br> <input name="yayin17" type="text" id="yayin17"  class="required" value="<?php echo $row_settings['stream_server']; ?>" size="75">
          </tr>
<?php } ?>

        </table>
        <p align="center">           
          <input name="doSave" type="submit" id="doSave" value="Kaydet Yayin 17">
          <input name="doSave" type="submit" id="doSave" value="Restart Yayin 17">

      </form>

 <br>
     <br>


<?php while ($row_settings = mysql_fetch_array($rs_settings13)) {?>
      <form action="paylas.php" method="post" name="myform" id="myform">
        <table width="70%" border="0" align="left" cellpadding="3" cellspacing="3" class="forms">
          <tr>
            <td colspan="2"><strong>YAYIN 18 - PORT 5018</strong><br> <input name="yayin18" type="text" id="yayin18"  class="required" value="<?php echo $row_settings['stream_server']; ?>" size="75">
          </tr>
<?php } ?>

        </table>
        <p align="center">
          <input name="doSave" type="submit" id="doSave" value="Kaydet Yayin 18">
          <input name="doSave" type="submit" id="doSave" value="Restart Yayin 18">
      </form>

<br>
     <br>
<?php while ($row_settings = mysql_fetch_array($rs_settings14)) {?>
      <form action="paylas.php" method="post" name="myform" id="myform">
        <table width="70%" border="0" align="left" cellpadding="3" cellspacing="3" class="forms">
          <tr>
            <td colspan="2"><strong>YAYIN 19 - PORT 5019</strong><br> <input name="yayin19" type="text" id="yayin19"  class="required" value="<?php echo $row_settings['stream_server']; ?>" size="75">
          </tr>
<?php } ?>

        </table>
        <p align="center">           
          <input name="doSave" type="submit" id="doSave" value="Kaydet Yayin 19">
          <input name="doSave" type="submit" id="doSave" value="Restart Yayin 19">

      </form>

 <br>
     <br>


<?php while ($row_settings = mysql_fetch_array($rs_settings15)) {?>
      <form action="paylas.php" method="post" name="myform" id="myform">
        <table width="70%" border="0" align="left" cellpadding="3" cellspacing="3" class="forms">
          <tr>
            <td colspan="2"><strong>YAYIN 20 - PORT 5020</strong><br> <input name="yayin20" type="text" id="yayin20"  class="required" value="<?php echo $row_settings['stream_server']; ?>" size="75">
          </tr>
<?php } ?>

        </table>
        <p align="center">           
          <input name="doSave" type="submit" id="doSave" value="Kaydet Yayin 20">
          <input name="doSave" type="submit" id="doSave" value="Restart Yayin 20">

      </form>

 <br>
     <br>


      </form>

 <br>
     <br>

        </p>
      <p>&nbsp; </p>
      <p>&nbsp;</p>
	   
      <p align="right">&nbsp; </p></td>
    <td width="196" valign="top">&nbsp;</td>
  </tr>
  <tr> 
    <td colspan="3">&nbsp;</td>
  </tr>
</table>

</body>
</html>
