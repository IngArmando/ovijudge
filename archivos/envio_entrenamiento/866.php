<?php
$a=fgets(STDIN);
$cant=strlen($a);
if($cant>3){
	$t=substr($a, -1, 2);
}else{
	$t=$a;
	}
if(($t%4)==0){
    echo "YES";
}else{
    echo "NO";
}
?>