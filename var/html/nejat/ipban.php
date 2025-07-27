<?php

$Banlanan_IP=$_GET['banip'];
echo "Banlanan IP Adresi : ".$Banlanan_IP."<br>".


system("sudo /sbin/iptables -A INPUT -s $Banlanan_IP -j DROP");


?>

 <INPUT TYPE="button" VALUE="Go Back" onClick="history.back()">  
