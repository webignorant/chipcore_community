<?php
ob_start(); 
session_start();
header("Content-Type:text/html;   charset=utf-8"); 
require_once("lib/libClass.php");
$lib=new libClass();
require_once("lib/userClass.php");
$userdb=new userClass();

$max_user_num=$userdb->getUserMaxNum();
$online_user_num=$userdb->getOnlineUserMaxNum();

//判断cookie
if(isset($_COOKIE['cookie_cc_email'])&&isset($_COOKIE['cook_cc_pass']))
{
	$_SESSION['email']=$_COOKIE['cookie_cc_email'];
	$url = "home.php"; 
	echo "<script>window.location.href='$url'</script>";
}

//判断session
if(isset($_SESSION['userID'])&&($_SESSION['realName']!="游客"))
{
	$url = "home.php"; 
	echo "<script>window.location.href='$url'</script>";
}

if($max_user_num==0)
{
	$max_user_num="0";
}
$lib->setvars("max_user_num",$max_user_num);
if($online_user_num==0)
{
	$online_user_num="0";
}
$lib->setvars("online_user_num",$online_user_num);
$theme_style='<link href="public/theme/Default.css" rel="stylesheet" type="text/css" />';
$lib->setvars("theme_style",$theme_style);

$f=array("f1"=>"index");
$lib->setfile($f);
$lib->replace($f);
$lib->showpage($f);

?>
