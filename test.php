<?php

$price = 3000  / 11;

//echo $price;

$costFee = (float)number_format((float)$price,2,".",".");
$difference =  abs(3000 - $costFee * 10);
$eleventCutota = number_format($difference,2,".",".");
echo $costFee * 10 + $difference;