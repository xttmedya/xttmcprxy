<?php 
include 'dbc.php';
page_protect();

if(!checkAdmin()) {
header("Location: login.php");
exit();
}

$page_limit = 30;


$host  = $_SERVER['HTTP_HOST'];
$host_upper = strtoupper($host);
$login_path = @ereg_replace('admin','',dirname($_SERVER['PHP_SELF']));
$path   = rtrim($login_path, '/\\');

// filter GET values
foreach($_GET as $key => $value) {
	$get[$key] = filter($value);
}

foreach($_POST as $key => $value) {
	$post[$key] = filter($value);
}

if($post['doBan'] == 'Askiya Al') {

if(!empty($_POST['u'])) {
	foreach ($_POST['u'] as $uid) {
		$id = filter($uid);
		mysql_query("update users set banned='1' where id='$id' and `user_name` <> 'admin'");
update_user_file();

	}
 }
 $ret = $_SERVER['PHP_SELF'] . '?'.$_POST['query_str'];;
 
 header("Location: $ret");
 exit();
}

if($_POST['doUnban'] == 'Aktif Et') {

if(!empty($_POST['u'])) {
	foreach ($_POST['u'] as $uid) {
		$id = filter($uid);
		mysql_query("update users set banned='0' where id='$id'");
update_user_file();

	}
 }
 $ret = $_SERVER['PHP_SELF'] . '?'.$_POST['query_str'];;
 
 header("Location: $ret");
 exit();
}

if($_POST['doDelete'] == 'Sil') {

if(!empty($_POST['u'])) {
	foreach ($_POST['u'] as $uid) {
		$id = filter($uid);
		mysql_query("delete from users where id='$id' and `user_name` <> 'admin'");
update_user_file();

	}
 }
 $ret = $_SERVER['PHP_SELF'] . '?'.$_POST['query_str'];;
 
 header("Location: $ret");
 exit();
}

if($_POST['doApprove'] == 'Approve') {

if(!empty($_POST['u'])) {
	foreach ($_POST['u'] as $uid) {
		$id = filter($uid);
		mysql_query("update users set approved='1' where id='$id'");
		
	list($to_email) = mysql_fetch_row(mysql_query("select user_email from users where id='$uid'"));	
 
$message = 
"Hello,\n
Thank you for registering with us. Your account has been activated...\n

*****LOGIN LINK*****\n
http://$host$path/login.php

Thank You

Administrator
$host_upper
______________________________________________________
THIS IS AN AUTOMATED RESPONSE. 
***DO NOT RESPOND TO THIS EMAIL****
";

@mail($to_email, "User Activation", $message,
    "From: \"Member Registration\" <auto-reply@$host>\r\n" .
     "X-Mailer: PHP/" . phpversion()); 
	 
	}
 }
 
 $ret = $_SERVER['PHP_SELF'] . '?'.$_POST['query_str'];	 
 header("Location: $ret");
 exit();
}
$hamza = $_SESSION['user_id'];

$rs_all = mysql_query("select count(*) as total_all from users WHERE `user_client` = $hamza and `user_name` <> 'monster'") or die(mysql_error());
$rs_active = mysql_query("select count(*) as total_active from users where `user_client` = $hamza and banned='0' AND `user_name` <> 'monster'") or die(mysql_error());
$rs_total_pending = mysql_query("select count(*) as tot from users where `user_client` = $hamza and banned='1' AND `user_name` <> 'monster'");						   

list($total_pending) = mysql_fetch_row($rs_total_pending);
list($all) = mysql_fetch_row($rs_all);
list($active) = mysql_fetch_row($rs_active);




?>
<html>
<head>
<title>Kullanicilar</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="styles.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="js/jquery-1.3.2.min.js"></script>

</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="5" class="main">
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td width="160" valign="top"><?php


if (isset($_SESSION['user_id'])) {?>
<div class="myaccount">
  <p><strong></strong></p>
<a href="myaccount.php"><img src="ana.gif" alt=""></a><br>
  <a href="mysettings.php"><img src="pro.gif" alt=""></a><br>
<?php }
if (checkAdmin()) {
?>
  <a href="admin.php?q=&qoption=recent&doSearch=Ara"><img src="kul.gif" alt=""></a><br>
 



<?php } ?>

  <br><a href="logout.php"><img src="cik.gif" alt=""></a>
</td>
<td width="3500" valign="top"><p>&nbsp;</p>



   <td width="74%" valign="top" style="padding: 10px;"><p>&nbsp;</p>

<h3 class="titlehdr">Kullanici Ayarlari ...</h3>
      <p>

      <table width="100%" border="0" cellpadding="5" cellspacing="0" class="myaccount">
        <tr>

          <td><font color="#FF0000"><b>Toplam Kullanici:</b></font> <?php echo $all;?></td>
          <td><font color="#FF0000"><b>Aktif Kullanici:</b></font> <?php echo $active; ?></td>
          <td><font color="#FF0000"><b>Askiya Alinan Kullanici:</b></font> <?php echo $total_pending; ?></td>
        </tr>
      </table>
      <p><?php 
	  if(!empty($msg)) {
	  echo $msg[0];
	  }
	  ?></p>
     <table width="80%" border="0" align="left" cellpadding="10" cellspacing="0" style="background-color: #E4F8FA;padding: 2px 5px;border: 1px solid #CAE4FF;" >
        <tr>
          <td><form name="form1" method="get" action="admin.php">
              <p align="center">Kullanici Ara 
                <input name="q" type="text" id="q" size="40">
                <br>
                [Kullanici adi yada email adresi yazin] </p>
              <p align="center"> 
                <input type="radio" name="qoption" value="recent">
                Kayitli Kullaniclar 
                <input type="radio" name="qoption" value="banned">
                Askiya Alinan Kullanicilar <br>
                <br>
                [Yukaridaki opsiyonlari kullanarak arama yapmak icin search satirini os birakabilirsiniz]</p>
              <p align="center"> 
                <input name="doSearch" type="submit" id="doSearch2" value="Ara">
              </p>
              </form></td>
        </tr>
      </table>

      <p>
        <?php if ($get['doSearch'] == 'Ara') {
	  $cond = '';
	  if($get['qoption'] == 'pending') {
	  $cond = "where `user_client` = $hamza and`approved`='0'  order by date desc";
	  }
	  if($get['qoption'] == 'recent') {
	  $cond = "where `user_client` = $hamza and `user_name` <> 'monster' order by date desc";
	  }
	  if($get['qoption'] == 'banned') {
	  $cond = "where `user_client` = $hamza and `banned`='1'  <> 'monster' order by date desc";
	  }

	  if($get['qoption'] == 'bayi') {
	  $cond = "where `user_client` = $hamza  <> 'monster' order by date desc";
	  }
	  
	  if($get['q'] == '') { 
//	  $sql = "select * from users $cond "; 
          $sql = "select * from users $cond ";
	  } 
	  else { 
	  $sql = "select * from users where `user_email` = '$_REQUEST[q]' or `user_name`='$_REQUEST[q]' and  `user_name`   <> 'monster' ";
	  }


	  
	  $rs_total = mysql_query($sql ) or die(mysql_error());
	  $total = mysql_num_rows($rs_total);
	  
	  if (!isset($_GET['page']) )
		{ $start=0; } else
		{ $start = ($_GET['page'] - 1) * $page_limit; }
	  
	  $rs_results = mysql_query($sql . " limit $start,$page_limit") or die(mysql_error());
	  $total_pages = ceil($total/$page_limit);
	  
	  ?>
      <p align="right"> 
        <?php 
	  
	  // outputting the pages
		if ($total > $page_limit)
		{
		echo "<div><strong>Sayfa:</strong> ";
		$i = 0;
		while ($i < $total/$page_limit)
		{
		
		
		$page_no = $i+1;
		$qstr = ereg_replace("&page=[0-9]+","",$_SERVER['QUERY_STRING']);
		echo "<a href=\"admin.php?$qstr&page=$page_no\">$page_no</a> ";
		$i++;
		}
		echo "</div>";
		}  ?>
		</p>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>





		 <h2><font color="#0066FF">Yeni Kullanici Ekle</font></h2>
      <table width="80%" border="0" cellpadding="5" cellspacing="2" class="myaccount">
        <tr>
          <td><form name="form1" method="post" action="admin.php">
              <p><font color="#000000"><b>Kullanici Adi:</b></font>
                <input name="user_name" type="text" id="user_name">
                </p>
                   <p><font color="#000000"><b>Sifre:</b></font> 
                <input name="pwd" type="text" id="pwd">
                <b>(Lutfen sifre alanini bos birakmayiniz...)</b></p>
              <p><font color="#000000"><b>Email:</b></font> 
                <input name="user_email" type="text" id="user_email">
				                <input name="user_client" type="hidden" id="user_client" value="<?php echo $_SESSION['user_id']?>">
								<input name="user_client_name" type="hidden" id="user_client_name" value="<?php echo $_SESSION['user_name']?>">

              </p>
              <p><font color="#000000"><b>Seviye:</b></font> 
                <select name="user_level" id="user_level">
                  <option value="1">User</option>
                 
                </select>
              </p>
             



              <p><font color="#000000"><b>Gecerlilik:</b></font>
                <select name="valid_day" id="valid_day">
                  <option value="1">1 Gun</option>
                  <option value="5">5 Gun</option>
                  <option value="30">1 Ay</option>
                  <option value="60">2 Ay</option>
                  <option value="90">3 Ay</option>
                  <option value="180">6 Ay</option>
                  <option value="365">1 Yil</option>


                </select>
              </p>                 





               <p>
                <input name="doSubmit" type="submit" id="doSubmit" value="Ekle">
              </p>
            </form>
</td>
        </tr>
      </table>
	  
	  <?php } ?>
      &nbsp;</p>
	  <?php
	  if($_POST['doSubmit'] == 'Ekle')
{

$exp_date = date ("Y-m-d", mktime (0,0,0,date("m"),(date("d")+$post[valid_day]),date("Y")));

$rs_dup = mysql_query("select count(*) as total from users where user_name='$post[user_name]' OR user_email='$post[user_email]'") or die(mysql_error());
//$rs_dup = mysql_query("select count(*) as total from users where user_name='$post[user_name]'") or die(mysql_error());
list($dups) = mysql_fetch_row($rs_dup);

if($dups > 0) {
	die("The user name or email already exists in the system");
	}

if(!empty($_POST['pwd'])) {
  $pwd = $post['pwd'];	
//  $hash = PwdHash($post['pwd']);
  $hash = $pwd ;
 }  
 else
 {
  $pwd = GenPwd();
//  $hash = PwdHash($pwd);
  $hash = $pwd ;
 }

 
 mysql_query("INSERT INTO users (`user_name`,`user_client`,`user_client_name`,`user_client_sure`,`user_email`,`pwd`,`approved`,`date`,`user_level`,`exp_date`)
			 VALUES ('$post[user_name]','$post[user_client]','$post[user_client_name]','$post[valid_day]','$post[user_email]','$hash','1',now(),'$post[user_level]','$exp_date')
			 ") or die(mysql_error()); 
update_user_file();



$message = 
"Thank you for registering with us. Here are your login details...\n
User Email: $post[user_email] \n
Passwd: $pwd \n

*****LOGIN LINK*****\n
http://$host$path/login.php

Thank You

Administrator
$host_upper
______________________________________________________
THIS IS AN AUTOMATED RESPONSE. 
***DO NOT RESPOND TO THIS EMAIL****


";

if($_POST['send'] == '1') {

	mail($post['user_email'], "Login Details", $message,
    "From: \"Member Registration\" <auto-reply@$host>\r\n" .
     "X-Mailer: PHP/" . phpversion()); 
 }
echo "<div class=\"msg\">Kullanici sifresi $post[user_name] olarak olusturuldu....</div>"; 
echo "<div class=\"msg\">Kullanici adı $pwd olarak olusturuldu....</div>"; 
echo "<div class=\"msg\">http://$post[user_name]:$pwd@$host:5001</div>"; 
echo "<div class=\"msg\">http://$post[user_name]:$pwd@$host:5002</div>"; 
echo "<div class=\"msg\">http://$post[user_name]:$pwd@$host:5003</div>"; 
echo "<div class=\"msg\">http://$post[user_name]:$pwd@$host:5004</div>"; 
echo "<div class=\"msg\">http://$post[user_name]:$pwd@$host:5005</div>"; 
echo "<div class=\"msg\">http://$post[user_name]:$pwd@$host:5006</div>"; 
echo "<div class=\"msg\">http://$post[user_name]:$pwd@$host:5007</div>"; 
echo "<div class=\"msg\">http://$post[user_name]:$pwd@$host:5008</div>"; 
echo "<div class=\"msg\">http://$post[user_name]:$pwd@$host:5009</div>"; 
echo "<div class=\"msg\">http://$post[user_name]:$pwd@$host:5010</div>"; 
echo "<div class=\"msg\">http://$post[user_name]:$pwd@$host:5011</div>"; 
echo "<div class=\"msg\">http://$post[user_name]:$pwd@$host:5012</div>"; 
echo "<div class=\"msg\">http://$post[user_name]:$pwd@$host:5013</div>"; 
echo "<div class=\"msg\">http://$post[user_name]:$pwd@$host:5014</div>"; 
echo "<div class=\"msg\">http://$post[user_name]:$pwd@$host:5015</div>"; 




}

	  ?>
	   
	   
	  <h2><font color="#0066FF">Kullanici Bilgileri</font></h2>
<form name "searchform" action="admin.php" method="post">
       <table width="100%" border="0" align="center" cellpadding="2" cellspacing="0" class="table.hovertable">
          <tr bgcolor="#E6F3F9"> 
            <td width="4%"><strong>ID</strong></td>
            <td> <strong>Eklenme Tarihi</strong></td>
            <td><div align="center"><strong>Kullanici Adi</strong></div></td>
            <td ><strong>Email</strong></td>
            <td ><strong>Bitis Tarihi</strong></td> 
           <td > <strong>Aski</strong></td>
            <td ><strong>Ekleyen Bayi</strong></td>
            <td ><strong>Süre</strong></td>
            <td ><strong>Tarih</strong></td>


          </tr>
          <tr> 
            <td>&nbsp;</td>
            <td >&nbsp;</td>
            <td ><div align="center"></div></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <?php while ($rrows = mysql_fetch_array($rs_results)) {?>
          <tr> 
            <td><input name="u[]" type="checkbox" value="<?php echo $rrows['id']; ?>" id="u[]"></td>
            <td><?php echo $rrows['date']; ?></td>
            <td> <div align="left"><?php echo $rrows['user_name'];?></div></td>
            <td><?php echo $rrows['user_email']; ?></td>
            <td><?php echo $rrows['exp_date']; ?></td>
            <td><span id="ban<?php echo $rrows['id']; ?>"> 
              <?php if(!$rrows['banned']) { echo "Hayir"; } else {echo "Evet"; }?>
              </span> </td>
			  <td><?php echo $rrows['user_client_name']; ?></td>
			  <td><?php echo $rrows['user_client_sure']; ?> Gün</td>
			  <td><?php echo $rrows['user_client_data']; ?></td>
              </span> </td>
              </font> </td>
          </tr>
          <tr> 
            <td colspan="7">
			
			<div style="display:none;font: normal 11px arial; padding:10px; background: #e6f3f9" id="edit<?php echo $rrows['id']; ?>">
			
			<input type="hidden" name="id<?php echo $rrows['id']; ?>" id="id<?php echo $rrows['id']; ?>" value="<?php echo $rrows['id']; ?>">
			Kullanici Adi: <input name="user_name<?php echo $rrows['id']; ?>" id="user_name<?php echo $rrows['id']; ?>" type="text" size="10" value="<?php echo $rrows['user_name']; ?>" >
			<br><br>Yeni Sifre: <input id="pass<?php echo $rrows['id']; ?>" name="pass<?php echo $rrows['id']; ?>" type="text" size="20" value="" > (leave blank)
			Email:<input id="user_email<?php echo $rrows['id']; ?>" name="user_email<?php echo $rrows['id']; ?>" type="text" size="20" value="<?php echo $rrows['user_email']; ?>" >
                     Gecerlilik : <input id="exp_date<?php echo $rrows['id']; ?>" name="exp_date<?php echo $rrows['id']; ?>" type="text" size="5" value="<?php echo $rrows['exp_date']; ?>" > Yil-Ay-Gun Ornek 2012-01-15
			<input name="doSave" type="button" id="doSave" value="Save" 
			onclick='$.get("do.php",{ cmd: "edit", pass:$("input#pass<?php echo $rrows['id']; ?>").val(),user_level:$("input#user_level<?php echo $rrows['id']; ?>").val(),user_email:$("input#user_email<?php echo $rrows['id']; ?>").val(),exp_date:$("input#exp_date<?php echo $rrows['id']; ?>").val(),user_name: $("input#user_name<?php echo $rrows['id']; ?>").val(),id: $("input#id<?php echo $rrows['id']; ?>").val() } ,function(data){ $("#msg<?php echo $rrows['id']; ?>").html(data); });'> 
			<a  onclick='$("#edit<?php echo $rrows['id'];?>").hide();' href="javascript:void(0);">close</a>
		 
		  <div style="color:red" id="msg<?php echo $rrows['id']; ?>" name="msg<?php echo $rrows['id']; ?>"></div>
		  </div>
		  
		  </td>
          </tr>
          <?php } ?>
        </table>

       <?php 

          // outputting the pages   
                if ($total > $page_limit)
                {         
                echo "<div><strong>Sayfa:</strong> ";
                $i = 0;
                while ($i < $total/$page_limit)
                {


                $page_no = $i+1;
                $qstr = ereg_replace("&page=[0-9]+","",$_SERVER['QUERY_STRING']);
                echo "<a href=\"admin.php?$qstr&page=$page_no\">$page_no</a> ";
                $i++;
                }
                echo "</div>";
                }  ?>

	    <p><br>
          <input name="doBan" type="submit" id="doBan" value="Askiya Al">
          <input name="doUnban" type="submit" id="doUnban" value="Aktif Et">
          <input name="doDelete" type="submit" id="doDelete" value="Sil">
          <input name="query_str" type="hidden" id="query_str" value="<?php echo $_SERVER['QUERY_STRING']; ?>">
 </p>

      </form>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="12%">&nbsp;</td>
  </tr>
</table>
</body>
</html>
