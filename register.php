<?php
header("Content-Type:text/html;   charset=utf-8"); 
require_once("lib/libClass.php");
$lib=new libClass();

$theme_style='<link href="public/theme/Default.css" rel="stylesheet" type="text/css" />';
$lib->setvars("theme_style",$theme_style);

$file=array("f1"=>"register");
$lib->setfile($file);
$lib->replace($file);
$lib->showpage($file);

?>