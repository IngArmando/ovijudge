<?php
$a=fgets(STDIN);
$cant=strlen($a);
if($cant>3){
	$c=$a[$cant-1];
	$b=$a[$cant-2];
	$t=$c.$b;
}else{
	$t=$a;
	}
if(($t%4)==0){
    echo "YES";
}else{
    echo "NO";
}
?>