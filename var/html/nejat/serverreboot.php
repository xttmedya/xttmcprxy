<?php
include 'dbc.php';
page_protect();

if(!checkAdmin()) {
header("Location: login.php");
exit();
}


system("sudo /sbin/reboot");
?>
