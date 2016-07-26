<?php
header("Content-Type:text/html;   charset=utf-8"); 
session_start();
require_once("plugins/artDialog/artDialog.php");
require_once("lib/userClass.php");
require_once("lib/friendgroupClass.php");
require_once("lib/spaceClass.php");
require_once("lib/dynamicClass.php");
$dynamicdb=new dynamicClass();
$userdb = new userClass();
$friendgroupdb=new friendgroupClass();
$spacedb=new spaceClass();
if(($email=$_POST['email'])=="")
{
	$errormsg = "邮箱不能为空！";
	errorAndExit($errormsg);
	exit;
}
if(($password=$_POST['password'])=="")
{
	$errormsg = "密码不能为空！";
	errorAndExit($errormsg);
	exit;
}
if(($otherPassword=$_POST['otherpassword'])=="")
{
	$errormsg = "检测密码不能为空！";
	errorAndExit($errormsg);
	exit;
}
if(($realName=$_POST['realname'])=="")
{
	$errormsg = "真实姓名不能为空！";
	errorAndExit($errormsg);
	exit;
}
if(($sex=$_POST['sex'])=="")
{
	$errormsg = "性别不能为空！";
	errorAndExit($errormsg);
	exit;
}
if(($year=$_POST['year'])=="")
{
	$errormsg = "年份不能为空";
	errorAndExit($errormsg);
	exit;
}
if(($month=$_POST['month'])=="")
{
	$errormsg = "月份不能为空";
	errorAndExit($errormsg);
	exit;
}
if(($day=$_POST['day'])=="")
{
	$errormsg = "天数不能为空！";
	errorAndExit($errormsg);
	exit;
}
if(($location=$_POST['location'])=="")
{
	$errormsg = "地址不能为空！";
	errorAndExit($errormsg);
	exit;
}
if(($status=$_POST['status'])=="")
{
	$errormsg = "身份不能为空！";
	errorAndExit($errormsg);
	exit;
}

function errorAndExit($errormsg)
{
	echo bad_showArtDialog("用户注册",$errormsg."<br>"."请注意填写"."<br>",'register.php',3000);
}

$password=md5($password);
$birthday=$year."-".$month."-".$day;

//检查用户是否存在
$userresult=$userdb->checkUserExitst($email);
if($userresult>0)
{
	echo bad_showArtDialog("用户注册","电子邮件已被注册"."<br>"."请重新填写"."<br>",'register.php',3000);
}

$result=$userdb->setUserRegister($email,$password,$realName,$sex,$birthday,$location,$status);
if($result)
{
	//用户初始化
	$userdata=$userdb->getUserID($email);	
	$userID=$userdata['userID'];
	$userdata=$userdb->setUserCustom($userID);
	$friendgroupdb->setFriendGroup($userID,1,'我的好友');
	$spacedb->setSpaceInfo($userID);
	//新人报道动态
	$dynamicdb->setUserDynamic($userID,10,$realName);
	
	echo good_showArtDialog("用户注册","注册成功",'index.php',3000);
}else
{
	echo bad_showArtDialog("用户注册","注册失败<br>待会再尝试...",'register.php',3000);
}

?>