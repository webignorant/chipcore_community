<?php
header("Content-Type:text/html;   charset=utf-8"); 
require_once("lib/lib_logincheck.php");
require_once("lib/userClass.php");
$userdb=new userClass();

$userID=$_SESSION['userID'];

$userdata=$userdb->getUserCustom($userID);
$themePath=$userdata['theme'];
global $theme_style;
$theme_style='<link href="'.$themePath.'" rel="stylesheet" type="text/css" />';


?>