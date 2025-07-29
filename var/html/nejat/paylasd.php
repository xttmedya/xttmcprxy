<?php 
/********************** MYSETTINGS.PHP**************************
This updates user settings and password
************************************************************/
include 'dbc.php';
page_protect();

$err = array();
$msg = array();


if($_POST['doSave'] == 'Kaydet Yayin 11')  
{
// Filter POST data for harmful code (sanitize)
foreach($_POST as $key => $value) {
	$data[$key] = filter($value);
}


mysql_query("UPDATE stream SET
			`stream_server` = '$data[yayin11]'
			 WHERE id='11'
			") or die(mysql_error());


//header("Location: stream.php?msg=Yayin 11 Icin Stream Ayarlari Degistirildi .... ");
$msg[] = "Yayin 11 Icin Stream Ayarlari Degistirildi ....  ";
 }
 

if($_POST['doSave'] == 'Kaydet Yayin 12')
{
// Filter POST data for harmful code (sanitize)
foreach($_POST as $key => $value) {
        $data[$key] = filter($value);
}               


mysql_query("UPDATE stream SET
                        `stream_server` = '$data[yayin12]'
                         WHERE id='12'
                        ") or die(mysql_error());


//header("Location: stream.php?msg=Yayin 12 Icin Stream Ayarlari Degistirildi ....  ");
$msg[] = "Yayin 12 Icin Stream Ayarlari Degistirildi .... ";
 }     

if($_POST['doSave'] == 'Kaydet Yayin 13')  
{
// Filter POST data for harmful code (sanitize)
foreach($_POST as $key => $value) {
	$data[$key] = filter($value);
}


mysql_query("UPDATE stream SET
			`stream_server` = '$data[yayin13]'
			 WHERE id='13'
			") or die(mysql_error());


//header("Location: stream.php?msg=Yayin 13 Icin Stream Ayarlari Degistirildi .... ");
$msg[] = "Yayin 13 Icin Stream Ayarlari Degistirildi ....  ";
 }
 

if($_POST['doSave'] == 'Kaydet Yayin 14')
{
// Filter POST data for harmful code (sanitize)
foreach($_POST as $key => $value) {
        $data[$key] = filter($value);
}               


mysql_query("UPDATE stream SET
                        `stream_server` = '$data[yayin14]'
                         WHERE id='14'
                        ") or die(mysql_error());


//header("Location: stream.php?msg=Yayin 14 Icin Stream Ayarlari Degistirildi ....  ");
$msg[] = "Yayin 14 Icin Stream Ayarlari Degistirildi .... ";
 }   


if($_POST['doSave'] == 'Kaydet Yayin 15')
{
// Filter POST data for harmful code (sanitize)
foreach($_POST as $key => $value) {
        $data[$key] = filter($value);
}               


mysql_query("UPDATE stream SET
                        `stream_server` = '$data[yayin15]'
                         WHERE id='15'
                        ") or die(mysql_error());


//header("Location: stream.php?msg=Yayin 15 Icin Stream Ayarlari Degistirildi ....  ");
$msg[] = "Yayin 15 Icin Stream Ayarlari Degistirildi .... ";
 }   


if($_POST['doSave'] == 'Restart Yayin 11')
{
foreach($_POST as $key => $value) {
        $data[$key] = filter($value);
}

$output = shell_exec("sudo -u iptv /home/iptv/ligtv/restart_stream stream11");

//header("Location: stream.php?msg=Yayin 11 Restart Edildi ... ");
$msg[] = "$output . Yayin 11 Restart Edildi ...";
 }

if($_POST['doSave'] == 'Restart Yayin 12')
{
foreach($_POST as $key => $value) {
        $data[$key] = filter($value);
}

$output = shell_exec("sudo -u iptv /home/iptv/ligtv/restart_stream stream12");

//header("Location: stream.php?msg=Yayin 12 Restart Edildi ... ");
$msg[] = "$output . Yayin 12 Restart Edildi ...";
 }

if($_POST['doSave'] == 'Restart Yayin 13')
{
foreach($_POST as $key => $value) {
        $data[$key] = filter($value);
}

$output = shell_exec("sudo -u iptv /home/iptv/ligtv/restart_stream stream13");

//header("Location: stream.php?msg=Yayin 13 Restart Edildi ... ");
$msg[] = "$output . Yayin 13 Restart Edildi ...";
 }


if($_POST['doSave'] == 'Restart Yayin 14')
{
foreach($_POST as $key => $value) {
        $data[$key] = filter($value);
}

$output = shell_exec("sudo -u iptv /home/iptv/ligtv/restart_stream stream14");

//header("Location: stream.php?msg=Yayin 14 Restart Edildi ... ");
$msg[] = "$output . Yayin 14 Restart Edildi ...";
 }

if($_POST['doSave'] == 'Restart Yayin 15')
{
foreach($_POST as $key => $value) {
        $data[$key] = filter($value);
}

$output = shell_exec("sudo -u iptv /home/iptv/ligtv/restart_stream stream15");

//header("Location: stream.php?msg=Yayin 15 Restart Edildi ... ");
$msg[] = "$output . Yayin 15 Restart Edildi ...";
 }


$rs_settings11 = mysql_query("select * from stream WHERE id='11' "); 
$rs_settings12 = mysql_query("select * from stream WHERE id='12' ");
$rs_settings13 = mysql_query("select * from stream WHERE id='13' ");
$rs_settings14 = mysql_query("select * from stream WHERE id='14' ");
$rs_settings15 = mysql_query("select * from stream WHERE id='15' ");
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
  <p><strong></strong></p>
  <a href="myaccount.php"><img src="ana.gif" alt=""></a><br>
  <a href="mysettings.php"><img src="pro.gif" alt=""></a><br>
<?php }
if (checkAdmin()) {
?>
  <a href="stat.php"><img src="ist.gif" alt=""></a><br>
  <a href="admin.php?q=&qoption=recent&doSearch=Ara"><img src="kul.gif" alt=""></a><br>
  <a href="stream.php"><img src="yay.gif" alt=""></a><br>
  <a href="paylas.php"><img src="paylas.gif" alt=""></a><br>


<?php } ?>

  <br><a href="logout.php"><img src="cik.gif" alt=""></a>
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
            <td colspan="2"><strong>YAYIN 11 - PORT 8146</strong><br> <input name="yayin11" type="text" id="yayin11"  class="required" value="<?php echo $row_settings['stream_server']; ?>" size="75">
          </tr>
<?php } ?>

        </table>
        <p align="center">
          <input name="doSave" type="submit" id="doSave" value="Kaydet Yayin 11">
          <input name="doSave" type="submit" id="doSave" value="Restart Yayin 11">
      </form>

     <br>
     <br>

          <?php while ($row_settings = mysql_fetch_array($rs_settings12)) {?>
      <form action="paylas.php" method="post" name="myform" id="myform">
        <table width="70%" border="0" align="left" cellpadding="3" cellspacing="3" class="forms">
          <tr>
            <td colspan="2"><strong>YAYIN 12 - PORT 8147</strong><br> <input name="yayin12" type="text" id="yayin12"  class="required" value="<?php echo $row_settings['stream_server']; ?>" size="75">
          </tr>
<?php } ?>

        </table>
        <p align="center">           
          <input name="doSave" type="submit" id="doSave" value="Kaydet Yayin 12">
          <input name="doSave" type="submit" id="doSave" value="Restart Yayin 12">

      </form>

 <br>
     <br>


<?php while ($row_settings = mysql_fetch_array($rs_settings13)) {?>
      <form action="paylas.php" method="post" name="myform" id="myform">
        <table width="70%" border="0" align="left" cellpadding="3" cellspacing="3" class="forms">
          <tr>
            <td colspan="2"><strong>YAYIN 3 - PORT 8148</strong><br> <input name="yayin13" type="text" id="yayin13"  class="required" value="<?php echo $row_settings['stream_server']; ?>" size="75">
          </tr>
<?php } ?>

        </table>
        <p align="center">
          <input name="doSave" type="submit" id="doSave" value="Kaydet Yayin 13">
          <input name="doSave" type="submit" id="doSave" value="Restart Yayin 13">
      </form>

<br>
     <br>
<?php while ($row_settings = mysql_fetch_array($rs_settings14)) {?>
      <form action="paylas.php" method="post" name="myform" id="myform">
        <table width="70%" border="0" align="left" cellpadding="3" cellspacing="3" class="forms">
          <tr>
            <td colspan="2"><strong>YAYIN 14 - PORT 8149</strong><br> <input name="yayin14" type="text" id="yayin14"  class="required" value="<?php echo $row_settings['stream_server']; ?>" size="75">
          </tr>
<?php } ?>

        </table>
        <p align="center">           
          <input name="doSave" type="submit" id="doSave" value="Kaydet Yayin 14">
          <input name="doSave" type="submit" id="doSave" value="Restart Yayin 14">

      </form>

 <br>
     <br>


<?php while ($row_settings = mysql_fetch_array($rs_settings15)) {?>
      <form action="paylas.php" method="post" name="myform" id="myform">
        <table width="70%" border="0" align="left" cellpadding="3" cellspacing="3" class="forms">
          <tr>
            <td colspan="2"><strong>YAYIN 15 - PORT 8150</strong><br> <input name="yayin15" type="text" id="yayin15"  class="required" value="<?php echo $row_settings['stream_server']; ?>" size="75">
          </tr>
<?php } ?>

        </table>
        <p align="center">           
          <input name="doSave" type="submit" id="doSave" value="Kaydet Yayin 15">
          <input name="doSave" type="submit" id="doSave" value="Restart Yayin 15">

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
<br><center></a><body background="panelli.jpg"><br></center> 
</body>
</html>
