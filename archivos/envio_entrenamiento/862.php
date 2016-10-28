<?php
$a=fgets(STDIN);
$cant=strlen($a);
$c=$a[$cant-1];
$b=$a[$cant-2];
$t=$c.$b;
if(($t%4)==0){
    echo "YES";
}else{
    echo "NO";
}

?>
