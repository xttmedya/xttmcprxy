<?php
include('baglan.php');
$bancalistir = mysql_query("select * from ban  order by ban_id");
$kac=mysql_num_rows($bancalistir); //kaç tane banlı IP olduğuna bakıyoruz
echo "<div class='ban'><div style='float:left'>Toplam Banlı IP: </div>"; 
echo '<div><b>'.$kac.'</b></div></div><div class="clr"></div>'; //banlı IP sayısını yazdırıyoruz
while($banoku=mysql_fetch_assoc($bancalistir))
  {
  ?>
<div><div style="float:left"><strong>BAN ID</strong>:&nbsp;</div>
<div style="float:left"><?php echo $banoku['ban_id']; ?></div>
<div style="float:left"><strong>BANLI IP:&nbsp;</strong></div>
<div><?PHP echo $banoku['ban_ip']; ?></div></div>
<div class="clr"></div><div class="clr"></div>
  <?PHP } //while döngüsü ile ban id ve banlı IPleri yazdırdık
?><br />
<?php echo '<div>Ban atmak için IP numarasını gir.</div>
<div>Ban silmek için ID numarasını gir.</div>
'; ?>
<form name="ip_ban" method="get" action="banning.php" >
&nbsp;<input type="text" name="ban_ip" />
<input type="submit" value="Banla" />
</form>
<form name="ip_ban_sil" method="get" action="banning.php" >
&nbsp;<input type="text" name="ban_id_sil" />
<input type="submit" value="Ban Sil" />
</form>