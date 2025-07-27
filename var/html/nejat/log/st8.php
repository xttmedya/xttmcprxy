<?php
$cont8=file_get_contents("log/stream8.txt");
preg_match_all("#\[(.*)\] (.*) \| (.*)#m",$cont8,$res);
echo "<tr>";
$arr=1;
$elem=0;
$count=0;
while(isset($res[$arr][$elem])){
    echo "<td>".$res[$arr][$elem]."</td>";
    $arr++;
    if($arr >= 4){
        $arr=1;
        $elem++;
        echo "</tr><tr>";
        $count++;
        if($count >= 50)
            break;
    }
}
echo "</tr></table>";  
	   
	  