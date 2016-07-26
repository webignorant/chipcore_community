<?php
//短消息发送处理
session_start();
header("Content-Type:text/html;   charset=utf-8"); 
require_once("plugins/artDialog/artDialog.php");   //对话框
require_once("lib/lib_logincheck.php");  //用户非法访问检测
require_once("lib/messageClass.php");
require_once("lib/userClass.php");
require_once("lib/dynamicClass.php");
$dynamicdb=new dynamicClass();
$messagedb= new messageClass();
$userdb= new userClass();

$send_userID=$_SESSION['userID'];
global $condition;

if(($email=$_POST['sendEmail'])!="")
{
	$condition="email='$email'";
}
if(($realName=$_POST['sendUserName'])!="")
{
	$condition="realName='$realName'";
}
if(($content=$_POST['sendMessage'])=="")
{
	echo bad_showArtDialog("发送消息","发送内容不能为空！","writeMessage.php",2000);
	exit;
}

$receiveuserdata=$userdb->findUserInfoDataForCondition($condition);
$receive_userID=$receiveuserdata['userID'];
if($receive_userID=="")
{
	echo bad_showArtDialog("发送消息","该用户名或电子邮件不存在！","writeMessage.php",2000);
	exit;
}

$messageresult=$messagedb->setMessage($send_userID,$receive_userID,$content);
if($messageresult)
{
	echo good_showArtDialog("发送消息","消息发送成功！","message.php",2000);
	exit;
}else
{
	echo bad_showArtDialog("发送消息","消息失败成功！","message.php",2000);
	exit;
}

?>
