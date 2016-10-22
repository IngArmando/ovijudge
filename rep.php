<?php
ini_set('display_errors','ON');
error_reporting(E_ALL ^E_NOTICE ^E_DEPRECATED);
session_start();
require_once('reporte/rep_'.$_GET['rep'].'.php');
?>
