<?php
$dt = @fopen("iplist.txt", "r");
if ($dt) {
    while (!feof($dt)) {
        $tampon = fgets($dt, 4096);
        echo $tampon;
    }
    fclose($dt);
}
?>
