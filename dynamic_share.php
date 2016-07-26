<?php
//分享动态处理
session_start();
header("Content-Type:text/html;   charset=utf-8"); 
require_once("plugins/artDialog/artDialog.php");   //对话框
require_once("lib/lib_logincheck.php");  //用户非法访问检测
require_once("lib/dynamicClass.php");
$dynamicdb=new dynamicClass();

//数据接收
$userID=$_SESSION['userID'];
$object=$_REQUEST['object'];

//处理模式
global $typename;
$mode=$_REQUEST['mode'];
switch($mode)
{
	case 'record':
			setDynamicShare(1,$object);
			$typename="心情记录";
			break;
	case 'diary':
			setDynamicShare(2,$object);
			$typename="日记";
			break;
	case 'article':
			setDynamicShare(3,$object);
			$typename="文章";
			break;
	case 'pictrue':
			setDynamicShare(4,$object);
			$typename="照片";
			break;
	case 'music':
			setDynamicShare(5,$object);
			$typename="音乐";
			break;
	case 'video':
			setDynamicShare(6,$object);
			$typename="视频";
			break;
	case 'file':
			setDynamicShare(7,$object);
			$typename="文件";
			break;
	default :
			echo "错误参数";
			break;
}

function setDynamicShare($type,$object)
{
	$result=$dynamicdb->setUserDynamic($userID,$type,$object);	
	if($result)
	{
		echo good_showArtDialog("分享动态",$typename."成功","home.php",2000);
		exit;
	}else
	{
		echo good_showArtDialog("分享动态",$typename."失败","home.php",2000);
		exit;
	}
}

?>