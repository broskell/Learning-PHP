<?php
$sno = $_REQUEST["sno"];
$sname = $_REQUEST["sname"];
$m1 = $_REQUEST["m1"];
$m2 = $_REQUEST["m2"];
$m3 = $_REQUEST["m3"];
$m4 = $_REQUEST["m4"];

$total = $m1 + $m2 + $m3 + $m4;
$avg   = $total / 4;

$result = ($m1 < 40 || $m2 < 40 || $m3 < 40 || $m4 < 40) ? "Fail" : "Pass";

if ($total >= 350){$grade ="first class";}
else if($total >= 275){$grade = "B grade";}
else if($total >= 200){$grade ="distinction";}
else if($total < 200){$grade = "fail";}

echo("student no : ".$sno);
echo("<br> student name :".$sname);
echo("<br> marks :".$m1.",".$m2.",".$m3.",".$m4);
echo("<br> total : ".$total);
echo("<br> avg : ".$avg);
echo("<br> result :".$result);
echo("<br> grade :".$grade);

?>