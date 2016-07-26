<?php
//用户非法访问检查

require_once("plugins/artDialog/artDialog.php");   //对话框
require_once("lib/lib_logincheck.php");  //用户非法访问检测

if(!isset($_SESSION['userID']))
{
	echo bad_showArtDialog("非法访问","用户没有登录!","index.php",2000);
	exit;
}

?>