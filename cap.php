<?php
$r1Array=range(0,9);
$r2Array=range(9,1);
$rand1=array_rand($r1Array);
$rand2=array_rand($r2Array);
$pat=$rand1." + ".$rand2." = ?";
$capsum=$rand1+$rand2;
?>