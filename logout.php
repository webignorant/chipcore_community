<?php
session_start();
header("Content-Type:text/html;   charset=utf-8"); 
require_once("plugins/artDialog/artDialog.php");   //对话框
require_once("lib/lib_logincheck.php");  //用户非法访问检测
require_once("lib/userClass.php");
require_once("lib/dynamicClass.php");
$dynamicdb=new dynamicClass();
$db=new userClass();
//修改用户状态
if($db->setUserLogout($_SESSION['userID']))
{
	session_destroy();
	unset($_SESSION['userID']);
	unset($_SESSION['email']);
	unset($_SESSION['realName']);
	setcookie("cook_cc_user_name","",time());
	setcookie("cook_cc_pass","",time());
	unset($_COOKIE['cook_cc_user_name']);
	unset($_COOKIE['cook_cc_pass']);
	unset($userID);
	echo good_showArtDialog("用户退出","注销成功!","index.php",2000);
	exit;
}
?>