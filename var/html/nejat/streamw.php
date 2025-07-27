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


if($_POST['doSave'] == 'Kaydet Yayin 1')  
{
// Filter POST data for harmful code (sanitize)
foreach($_POST as $key => $value) {
	$data[$key] = filter($value);
}


mysql_query("UPDATE stream SET
			`stream_server` = '$data[yayin1]'
			 WHERE id='1'
			") or die(mysql_error());


//header("Location: stream.php?msg=Yayin 1 Icin Stream Ayarlari Degistirildi .... ");
$msg[] = "Yayin 1 Icin Stream Ayarlari Degistirildi ....  ";
 }
 

if($_POST['doSave'] == 'Kaydet Yayin 2')
{
// Filter POST data for harmful code (sanitize)
foreach($_POST as $key => $value) {
        $data[$key] = filter($value);
}               


mysql_query("UPDATE stream SET
                        `stream_server` = '$data[yayin2]'
                         WHERE id='2'
                        ") or die(mysql_error());


//header("Location: stream.php?msg=Yayin 2 Icin Stream Ayarlari Degistirildi ....  ");
$msg[] = "Yayin 2 Icin Stream Ayarlari Degistirildi .... ";
 }     

if($_POST['doSave'] == 'Kaydet Yayin 3')  
{
// Filter POST data for harmful code (sanitize)
foreach($_POST as $key => $value) {
	$data[$key] = filter($value);
}


mysql_query("UPDATE stream SET
			`stream_server` = '$data[yayin3]'
			 WHERE id='3'
			") or die(mysql_error());


//header("Location: stream.php?msg=Yayin 3 Icin Stream Ayarlari Degistirildi .... ");
$msg[] = "Yayin 3 Icin Stream Ayarlari Degistirildi ....  ";
 }
 

if($_POST['doSave'] == 'Kaydet Yayin 4')
{
// Filter POST data for harmful code (sanitize)
foreach($_POST as $key => $value) {
        $data[$key] = filter($value);
}               


mysql_query("UPDATE stream SET
                        `stream_server` = '$data[yayin4]'
                         WHERE id='4'
                        ") or die(mysql_error());


//header("Location: stream.php?msg=Yayin 4 Icin Stream Ayarlari Degistirildi ....  ");
$msg[] = "Yayin 4 Icin Stream Ayarlari Degistirildi .... ";
 }   


if($_POST['doSave'] == 'Kaydet Yayin 5')
{
// Filter POST data for harmful code (sanitize)
foreach($_POST as $key => $value) {
        $data[$key] = filter($value);
}               


mysql_query("UPDATE stream SET
                        `stream_server` = '$data[yayin5]'
                         WHERE id='5'
                        ") or die(mysql_error());


//header("Location: stream.php?msg=Yayin 5 Icin Stream Ayarlari Degistirildi ....  ");
$msg[] = "Yayin 5 Icin Stream Ayarlari Degistirildi .... ";
 }   

if($_POST['doSave'] == 'Kaydet Yayin 6')
{
// Filter POST data for harmful code (sanitize)
foreach($_POST as $key => $value) {
        $data[$key] = filter($value);
}               


mysql_query("UPDATE stream SET
                        `stream_server` = '$data[yayin6]'
                         WHERE id='6'
                        ") or die(mysql_error());


//header("Location: stream.php?msg=Yayin 6 Icin Stream Ayarlari Degistirildi ....  ");
$msg[] = "Yayin 6 Icin Stream Ayarlari Degistirildi .... ";
 }   

if($_POST['doSave'] == 'Kaydet Yayin 7')
{
// Filter POST data for harmful code (sanitize)
foreach($_POST as $key => $value) {
        $data[$key] = filter($value);
}               


mysql_query("UPDATE stream SET
                        `stream_server` = '$data[yayin7]'
                         WHERE id='7'
                        ") or die(mysql_error());


//header("Location: stream.php?msg=Yayin 7 Icin Stream Ayarlari Degistirildi ....  ");
$msg[] = "Yayin 7 Icin Stream Ayarlari Degistirildi .... ";
 }   

if($_POST['doSave'] == 'Kaydet Yayin 8')
{
// Filter POST data for harmful code (sanitize)
foreach($_POST as $key => $value) {
        $data[$key] = filter($value);
}               


mysql_query("UPDATE stream SET
                        `stream_server` = '$data[yayin8]'
                         WHERE id='8'
                        ") or die(mysql_error());


//header("Location: stream.php?msg=Yayin 8 Icin Stream Ayarlari Degistirildi ....  ");
$msg[] = "Yayin 8 Icin Stream Ayarlari Degistirildi .... ";
 }   

if($_POST['doSave'] == 'Kaydet Yayin 9')
{
// Filter POST data for harmful code (sanitize)
foreach($_POST as $key => $value) {
        $data[$key] = filter($value);
}               


mysql_query("UPDATE stream SET
                        `stream_server` = '$data[yayin9]'
                         WHERE id='9'
                        ") or die(mysql_error());


//header("Location: stream.php?msg=Yayin 9 Icin Stream Ayarlari Degistirildi ....  ");
$msg[] = "Yayin 9 Icin Stream Ayarlari Degistirildi .... ";
 }   


if($_POST['doSave'] == 'Kaydet Yayin 10')
{
// Filter POST data for harmful code (sanitize)
foreach($_POST as $key => $value) {
        $data[$key] = filter($value);
}               


mysql_query("UPDATE stream SET
                        `stream_server` = '$data[yayin10]'
                         WHERE id='10'
                        ") or die(mysql_error());


//header("Location: stream.php?msg=Yayin 10 Icin Stream Ayarlari Degistirildi ....  ");
$msg[] = "Yayin 10 Icin Stream Ayarlari Degistirildi .... ";
 }   


if($_POST['doSave'] == 'Restart Yayin 1')
{
foreach($_POST as $key => $value) {
        $data[$key] = filter($value);
}

$output = shell_exec("sudo -u iptv /home/iptv/ligtv/restart_stream stream1");

//header("Location: stream.php?msg=Yayin 1 Restart Edildi ... ");
$msg[] = "$output . Yayin 1 Restart Edildi ...";
 }

if($_POST['doSave'] == 'Restart Yayin 2')
{
foreach($_POST as $key => $value) {
        $data[$key] = filter($value);
}

$output = shell_exec("sudo -u iptv /home/iptv/ligtv/restart_stream stream2");

//header("Location: stream.php?msg=Yayin 2 Restart Edildi ... ");
$msg[] = "$output . Yayin 2 Restart Edildi ...";
 }

if($_POST['doSave'] == 'Restart Yayin 3')
{
foreach($_POST as $key => $value) {
        $data[$key] = filter($value);
}

$output = shell_exec("sudo -u iptv /home/iptv/ligtv/restart_stream stream3");

//header("Location: stream.php?msg=Yayin 3 Restart Edildi ... ");
$msg[] = "$output . Yayin 3 Restart Edildi ...";
 }


if($_POST['doSave'] == 'Restart Yayin 4')
{
foreach($_POST as $key => $value) {
        $data[$key] = filter($value);
}

$output = shell_exec("sudo -u iptv /home/iptv/ligtv/restart_stream stream4");

//header("Location: stream.php?msg=Yayin 4 Restart Edildi ... ");
$msg[] = "$output . Yayin 4 Restart Edildi ...";
 }

if($_POST['doSave'] == 'Restart Yayin 5')
{
foreach($_POST as $key => $value) {
        $data[$key] = filter($value);
}

$output = shell_exec("sudo -u iptv /home/iptv/ligtv/restart_stream stream5");

//header("Location: stream.php?msg=Yayin 5 Restart Edildi ... ");
$msg[] = "$output . Yayin 5 Restart Edildi ...";
 }


if($_POST['doSave'] == 'Restart Yayin 6')
{
foreach($_POST as $key => $value) {
        $data[$key] = filter($value);
}

$output = shell_exec("sudo -u iptv /home/iptv/ligtv/restart_stream stream6");

//header("Location: stream.php?msg=Yayin 6 Restart Edildi ... ");
$msg[] = "$output . Yayin 6 Restart Edildi ...";
 }
if($_POST['doSave'] == 'Restart Yayin 7')
{
foreach($_POST as $key => $value) {
        $data[$key] = filter($value);
}

$output = shell_exec("sudo -u iptv /home/iptv/ligtv/restart_stream stream7");

//header("Location: stream.php?msg=Yayin 7 Restart Edildi ... ");
$msg[] = "$output . Yayin 7 Restart Edildi ...";
 }

if($_POST['doSave'] == 'Restart Yayin 8')
{
foreach($_POST as $key => $value) {
        $data[$key] = filter($value);
}

$output = shell_exec("sudo -u iptv /home/iptv/ligtv/restart_stream stream8");

//header("Location: stream.php?msg=Yayin 8 Restart Edildi ... ");
$msg[] = "$output . Yayin 8 Restart Edildi ...";
 }

if($_POST['doSave'] == 'Restart Yayin 9')
{
foreach($_POST as $key => $value) {
        $data[$key] = filter($value);
}

$output = shell_exec("sudo -u iptv /home/iptv/ligtv/restart_stream stream9");

//header("Location: stream.php?msg=Yayin 9 Restart Edildi ... ");
$msg[] = "$output . Yayin 9 Restart Edildi ...";
 }

if($_POST['doSave'] == 'Restart Yayin 10')
{
foreach($_POST as $key => $value) {
        $data[$key] = filter($value);
}

$output = shell_exec("sudo -u iptv /home/iptv/ligtv/restart_stream stream10");

//header("Location: stream.php?msg=Yayin 10 Restart Edildi ... ");
$msg[] = "$output . Yayin 10 Restart Edildi ...";
 }


if($_POST['doSave'] == 'Kapat Yayin 1')
{
foreach($_POST as $key => $value) {
        $data[$key] = filter($value);
}

$output = shell_exec("sudo -u iptv /home/iptv/ligtv/stop_stream stream1");

//header("Location: stream.php?msg=Yayin 1 Kapat ... ");
$msg[] = "$output . Yayin 1 Kapat...";
 }


if($_POST['doSave'] == 'Kapat Yayin 1')
{
foreach($_POST as $key => $value) {
        $data[$key] = filter($value);
}

$output = shell_exec("sudo -u iptv /home/iptv/ligtv/stop_stream stream1");

//header("Location: stream.php?msg=Yayin 1 Kapat ... ");
$msg[] = "$output . Yayin 1 Kapat...";
 }


if($_POST['doSave'] == 'Kapat Yayin 2')
{
foreach($_POST as $key => $value) {
        $data[$key] = filter($value);
}

$output = shell_exec("sudo -u iptv /home/iptv/ligtv/stop_stream stream2");

//header("Location: stream.php?msg=Yayin 2 Kapat ... ");
$msg[] = "$output . Yayin 2 Kapat...";
 }


if($_POST['doSave'] == 'Kapat Yayin 3')
{
foreach($_POST as $key => $value) {
        $data[$key] = filter($value);
}

$output = shell_exec("sudo -u iptv /home/iptv/ligtv/stop_stream stream3");

//header("Location: stream.php?msg=Yayin 3 Kapat ... ");
$msg[] = "$output . Yayin 3 Kapat...";
 }


if($_POST['doSave'] == 'Kapat Yayin 4')
{
foreach($_POST as $key => $value) {
        $data[$key] = filter($value);
}

$output = shell_exec("sudo -u iptv /home/iptv/ligtv/stop_stream stream4");

//header("Location: stream.php?msg=Yayin 4 Kapat ... ");
$msg[] = "$output . Yayin 4 Kapat...";
 }


if($_POST['doSave'] == 'Kapat Yayin 5')
{
foreach($_POST as $key => $value) {
        $data[$key] = filter($value);
}

$output = shell_exec("sudo -u iptv /home/iptv/ligtv/stop_stream stream5");

//header("Location: stream.php?msg=Yayin 5 Kapat ... ");
$msg[] = "$output . Yayin 5 Kapat...";
 }


if($_POST['doSave'] == 'Kapat Yayin 6')
{
foreach($_POST as $key => $value) {
        $data[$key] = filter($value);
}

$output = shell_exec("sudo -u iptv /home/iptv/ligtv/stop_stream stream6");

//header("Location: stream.php?msg=Yayin 1 Kapat ... ");
$msg[] = "$output . Yayin 6 Kapat...";
 }


if($_POST['doSave'] == 'Kapat Yayin 7')
{
foreach($_POST as $key => $value) {
        $data[$key] = filter($value);
}

$output = shell_exec("sudo -u iptv /home/iptv/ligtv/stop_stream stream7");

//header("Location: stream.php?msg=Yayin 7 Kapat ... ");
$msg[] = "$output . Yayin 7 Kapat...";
 }


if($_POST['doSave'] == 'Kapat Yayin 8')
{
foreach($_POST as $key => $value) {
        $data[$key] = filter($value);
}

$output = shell_exec("sudo -u iptv /home/iptv/ligtv/stop_stream stream8");

//header("Location: stream.php?msg=Yayin 1 Kapat ... ");
$msg[] = "$output . Yayin 8 Kapat...";
 }


if($_POST['doSave'] == 'Kapat Yayin 9')
{
foreach($_POST as $key => $value) {
        $data[$key] = filter($value);
}

$output = shell_exec("sudo -u iptv /home/iptv/ligtv/stop_stream stream9");

//header("Location: stream.php?msg=Yayin 1 Kapat ... ");
$msg[] = "$output . Yayin 9 Kapat...";
 }
 
 
 
if($_POST['doSave'] == 'Kapat Yayin 10')
{
foreach($_POST as $key => $value) {
        $data[$key] = filter($value);
}

$output = shell_exec("sudo -u iptv /home/iptv/ligtv/stop_stream stream10");

//header("Location: stream.php?msg=Yayin 1 Kapat ... ");
$msg[] = "$output . Yayin 10 Kapat...";
 }






$rs_settings1 = mysql_query("select * from stream WHERE id='1' "); 
$rs_settings2 = mysql_query("select * from stream WHERE id='2' ");
$rs_settings3 = mysql_query("select * from stream WHERE id='3' ");
$rs_settings4 = mysql_query("select * from stream WHERE id='4' ");
$rs_settings5 = mysql_query("select * from stream WHERE id='5' ");
$rs_settings6 = mysql_query("select * from stream WHERE id='6' ");
$rs_settings7 = mysql_query("select * from stream WHERE id='7' ");
$rs_settings8 = mysql_query("select * from stream WHERE id='8' ");
$rs_settings9 = mysql_query("select * from stream WHERE id='9' ");
$rs_settings10 = mysql_query("select * from stream WHERE id='10' ");
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

  <br><a href="logout.php"><img src="exit.png" alt=""></a>
</td>

    <td width="3500" valign="top"><p>&nbsp;</p>
<h3 class="titlehdr">Yayin Ayarlari ...</h3>
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

          <?php while ($row_settings = mysql_fetch_array($rs_settings1)) {?>
      <form action="stream.php" method="post" name="myform" id="myform">
        <table width="70%" border="0" align="left" cellpadding="3" cellspacing="3" class="forms">
          <tr>
            <td colspan="2"><strong>YAYIN 1 -  PORT 5001</strong><br> <input name="yayin1" type="text" id="yayin1"  class="required" value="<?php echo $row_settings['stream_server']; ?>" size="75">
          </tr>
<?php } ?>

        </table>
        <p align="center">
          <input name="doSave" type="submit" id="doSave" value="Kaydet Yayin 1">
          <input name="doSave" type="submit" id="doSave" value="Restart Yayin 1">
		  <input name="doSave" type="submit" id="doSave" value="Kapat Yayin 1">
      </form>

     <br>
     <br>

          <?php while ($row_settings = mysql_fetch_array($rs_settings2)) {?>
      <form action="stream.php" method="post" name="myform" id="myform">
        <table width="70%" border="0" align="left" cellpadding="3" cellspacing="3" class="forms">
          <tr>
            <td colspan="2"><strong>YAYIN 2 -  PORT 5002</strong><br> <input name="yayin2" type="text" id="yayin2"  class="required" value="<?php echo $row_settings['stream_server']; ?>" size="75">
          </tr>
<?php } ?>

        </table>
        <p align="center">           
          <input name="doSave" type="submit" id="doSave" value="Kaydet Yayin 2">
          <input name="doSave" type="submit" id="doSave" value="Restart Yayin 2">
 <input name="doSave" type="submit" id="doSave" value="Kapat Yayin 2">
      </form>

 <br>
     <br>


<?php while ($row_settings = mysql_fetch_array($rs_settings3)) {?>
      <form action="stream.php" method="post" name="myform" id="myform">
        <table width="70%" border="0" align="left" cellpadding="3" cellspacing="3" class="forms">
          <tr>
            <td colspan="2"><strong>YAYIN 3 -  PORT 5003</strong><br> <input name="yayin3" type="text" id="yayin3"  class="required" value="<?php echo $row_settings['stream_server']; ?>" size="75">
          </tr>
<?php } ?>

        </table>
        <p align="center">
          <input name="doSave" type="submit" id="doSave" value="Kaydet Yayin 3">
          <input name="doSave" type="submit" id="doSave" value="Restart Yayin 3">
		   <input name="doSave" type="submit" id="doSave" value="Kapat Yayin 3">
      </form>

<br>
     <br>
<?php while ($row_settings = mysql_fetch_array($rs_settings4)) {?>
      <form action="stream.php" method="post" name="myform" id="myform">
        <table width="70%" border="0" align="left" cellpadding="3" cellspacing="3" class="forms">
          <tr>
            <td colspan="2"><strong>YAYIN 4 -  PORT 5004</strong><br> <input name="yayin4" type="text" id="yayin4"  class="required" value="<?php echo $row_settings['stream_server']; ?>" size="75">
          </tr>
<?php } ?>

        </table>
        <p align="center">           
          <input name="doSave" type="submit" id="doSave" value="Kaydet Yayin 4">
          <input name="doSave" type="submit" id="doSave" value="Restart Yayin 4">
		   <input name="doSave" type="submit" id="doSave" value="Kapat Yayin 4">

      </form>

 <br>
     <br>


<?php while ($row_settings = mysql_fetch_array($rs_settings5)) {?>
      <form action="stream.php" method="post" name="myform" id="myform">
        <table width="70%" border="0" align="left" cellpadding="3" cellspacing="3" class="forms">
          <tr>
            <td colspan="2"><strong>YAYIN 5 -  PORT 5005</strong><br> <input name="yayin5" type="text" id="yayin5"  class="required" value="<?php echo $row_settings['stream_server']; ?>" size="75">
          </tr>
<?php } ?>

        </table>
        <p align="center">           
          <input name="doSave" type="submit" id="doSave" value="Kaydet Yayin 5">
          <input name="doSave" type="submit" id="doSave" value="Restart Yayin 5">
		   <input name="doSave" type="submit" id="doSave" value="Kapat Yayin5">

      </form>

 <br>
     <br>



<?php while ($row_settings = mysql_fetch_array($rs_settings6)) {?>
      <form action="stream.php" method="post" name="myform" id="myform">
        <table width="70%" border="0" align="left" cellpadding="3" cellspacing="3" class="forms">
          <tr>
            <td colspan="2"><strong>YAYIN 6 -  PORT 5006</strong><br> <input name="yayin6" type="text" id="yayin6"  class="required" value="<?php echo $row_settings['stream_server']; ?>" size="75">
          </tr>
<?php } ?>

        </table>
        <p align="center">           
          <input name="doSave" type="submit" id="doSave" value="Kaydet Yayin 6">
          <input name="doSave" type="submit" id="doSave" value="Restart Yayin 6">
		   <input name="doSave" type="submit" id="doSave" value="Kapat Yayin 6">

      </form>

 <br>
     <br>


<?php while ($row_settings = mysql_fetch_array($rs_settings7)) {?>
      <form action="stream.php" method="post" name="myform" id="myform">
        <table width="70%" border="0" align="left" cellpadding="3" cellspacing="3" class="forms">
          <tr>
            <td colspan="2"><strong>YAYIN 7 -  PORT 5007</strong><br> <input name="yayin7" type="text" id="yayin7"  class="required" value="<?php echo $row_settings['stream_server']; ?>" size="75">
          </tr>
<?php } ?>

        </table>
        <p align="center">           
          <input name="doSave" type="submit" id="doSave" value="Kaydet Yayin 7">
          <input name="doSave" type="submit" id="doSave" value="Restart Yayin 7">
		   <input name="doSave" type="submit" id="doSave" value="Kapat Yayin 7">

      </form>

 <br>
     <br>

<?php while ($row_settings = mysql_fetch_array($rs_settings8)) {?>
      <form action="stream.php" method="post" name="myform" id="myform">
        <table width="70%" border="0" align="left" cellpadding="3" cellspacing="3" class="forms">
          <tr>
            <td colspan="2"><strong>YAYIN 8 -  PORT 5008</strong><br> <input name="yayin8" type="text" id="yayin8"  class="required" value="<?php echo $row_settings['stream_server']; ?>" size="75">
          </tr>
<?php } ?>

        </table>
        <p align="center">           
          <input name="doSave" type="submit" id="doSave" value="Kaydet Yayin 8">
          <input name="doSave" type="submit" id="doSave" value="Restart Yayin 8">
		   <input name="doSave" type="submit" id="doSave" value="Kapat Yayin 8">

      </form>

 <br>
     <br>

<?php while ($row_settings = mysql_fetch_array($rs_settings9)) {?>
      <form action="stream.php" method="post" name="myform" id="myform">
        <table width="70%" border="0" align="left" cellpadding="3" cellspacing="3" class="forms">
          <tr>
            <td colspan="2"><strong>YAYIN 9 -  PORT 5009</strong><br> <input name="yayin9" type="text" id="yayin9"  class="required" value="<?php echo $row_settings['stream_server']; ?>" size="75">
          </tr>
<?php } ?>

        </table>
        <p align="center">           
          <input name="doSave" type="submit" id="doSave" value="Kaydet Yayin 9">
          <input name="doSave" type="submit" id="doSave" value="Restart Yayin 9">
		   <input name="doSave" type="submit" id="doSave" value="Kapat Yayin 9">

      </form>

 <br>
     <br>
<?php while ($row_settings = mysql_fetch_array($rs_settings10)) {?>
      <form action="stream.php" method="post" name="myform" id="myform">
        <table width="70%" border="0" align="left" cellpadding="3" cellspacing="3" class="forms">
          <tr>
            <td colspan="2"><strong>YAYIN 10 - PORT 5010 SADECE BU PORTTA VLC PLAYER CALISIR !!!</strong><br> <input name="yayin10" type="text" id="yayin10"  class="required" value="<?php echo $row_settings['stream_server']; ?>" size="75">
          </tr>
<?php } ?>

       
        <p align="center">           
          <input name="doSave" type="submit" id="doSave" value="Kaydet Yayin 10">
          <input name="doSave" type="submit" id="doSave" value="Restart Yayin 10">
		   <input name="doSave" type="submit" id="doSave" value="Kapat Yayin 10">

      </form>
 </table>
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
