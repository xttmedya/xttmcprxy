<?php 
/********************** MYSETTINGS.PHP**************************
This updates user settings and password
************************************************************/
include 'dbc.php';
page_protect();

$err = array();
$msg = array();

if($_POST['doUpdate'] == 'Degistir')  
{


$rs_pwd = mysql_query("select pwd from users where id='$_SESSION[user_id]'");
list($old) = mysql_fetch_row($rs_pwd);
 $old_salt = substr($old,0,9);

//check for old password in md5 format
//	if($old === PwdHash($_POST['pwd_old'],$old_salt))
        if($old == $_POST['pwd_old'])
	{
//	$newsha1 = PwdHash($_POST['pwd_new']);
        $newsha1 = ($_POST['pwd_new']);
	mysql_query("update users set pwd='$newsha1' where id='$_SESSION[user_id]'");
	$msg[] = "Yeni sifreniz kaydedildi ...";
	//header("Location: mysettings.php?msg=Yeni sifreniz kaydedildi");
	} else
	{
	 $err[] = "Eski sifreniz hatali";
	 //header("Location: mysettings.php?msg=Eski sifreniz hatali");
	}

}

if($_POST['doSave'] == 'Kaydet')  
{
// Filter POST data for harmful code (sanitize)
foreach($_POST as $key => $value) {
	$data[$key] = filter($value);
}


mysql_query("UPDATE users SET
			`full_name` = '$data[name]',
			`address` = '$data[address]',
			`tel` = '$data[tel]',
			`fax` = '$data[fax]',
			`country` = '$data[country]',
			`website` = '$data[web]'
			 WHERE id='$_SESSION[user_id]'
			") or die(mysql_error());

//header("Location: mysettings.php?msg=Profilinizdeki degisiklikler yapildi");
$msg[] = "Profilinizdeki degisiklikler yapildi";
 }
 
$rs_settings = mysql_query("select * from users where id='$_SESSION[user_id]'"); 
?>
<html>
<head>
<title>Profilim </title>
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


  <a href="admin.php?q=&qoption=recent&doSearch=Ara"><img src="kul.gif" alt=""></a><br>



 <?php echo $_SESSION['user_name'] ?>
      <p> 
<?php } ?>

  <br><a href="logout.php"><img src="cik.gif" alt=""></a>
</td>
    <td width="3500" valign="top"><p>&nbsp;</p>

<h3 class="titlehdr">Profilim ...</h3> 
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
	  <?php while ($row_settings = mysql_fetch_array($rs_settings)) {?>
      <form action="mysettings.php" method="post" name="myform" id="myform">
        <table width="90%" border="0" align="center" cellpadding="3" cellspacing="3" class="forms">

          <tr> 
            <td colspan="2"> Adiniz<br> <input name="name" type="text" id="name"  class="required" value="<?php echo $row_settings['full_name']; ?>" size="50"> 
          </tr>
          <tr> 
            <td colspan="2">Addres <br> 
              <textarea name="address" cols="40" rows="4" class="required" id="address"><?php echo $row_settings['address']; ?></textarea> 
            </td>
          </tr>
          <tr> 
            <td>Country</td>
            <td><input name="Ulke" type="text" id="country" value="<?php echo $row_settings['country']; ?>" ></td>
          </tr>
          <tr> 
            <td width="27%">Telefon</td>
            <td width="73%"><input name="tel" type="text" id="tel" class="required" value="<?php echo $row_settings['tel']; ?>"></td>
          </tr>
          <tr> 
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr> 
            <td>User Name</td>
            <td><input name="user_name" type="text" id="web2" value="<?php echo $row_settings['user_name']; ?>" disabled></td>
          </tr>
          <tr> 
            <td>Email</td>
            <td><input name="user_email" type="text" id="web3"  value="<?php echo $row_settings['user_email']; ?>" disabled></td>
          </tr>
        </table>
        <p align="center"> 
          <input name="doSave" type="submit" id="doSave" value="Kaydet">
        </p>
      </form>
	  <?php } ?>
      <h3 class="titlehdr">Sifre Degistir...</h3>
      <p>Eger sifrenizi degistirmek istiyorsaniz eski ve yeni sifrenizi giriniz ...</p>
      <form name="pform" id="pform" method="post" action="">
        <table width="80%" border="0" align="center" cellpadding="3" cellspacing="3" class="forms">
          <tr> 
            <td width="31%">Eski Sifre</td>
            <td width="69%"><input name="pwd_old" type="password" class="required password"  id="pwd_old"></td>
          </tr>
          <tr> 
            <td>Yeni Sifre</td>
            <td><input name="pwd_new" type="password" id="pwd_new" class="required password"  ></td>
          </tr>
        </table>
        <p align="center"> 
          <input name="doUpdate" type="submit" id="doUpdate" value="Degistir">
        </p>
        <p>&nbsp; </p>
      </form>
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
