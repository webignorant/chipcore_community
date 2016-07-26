<?php
header("Content-Type:text/html;   charset=utf-8"); 
//给PHP动态页面直接调用
//require_once("plugins/artDialog/artDialog.php");

//背景色#011a15
//默认风格
//$artdialog='<script src="plugins/artDialog/artDialog.js?skin=default"></script>';
//aero风格
$artdialog='<script src="plugins/artDialog/artDialog.js?skin=aero"></script>';
//网页标题
$webtitle;
//执行语句
$artDialogScript;
//输出生成的网页
function showWebpage()
{
	global $webtitle;
	global $artdialog;
	global $artDialogScript;
	return $webpage='
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>'.$webtitle.'</title>
	<style>
	*{
		padding:0px;
		margin:0px;
	}
	html,body{
		overflow:hidden;
		height:100%;
		width:100%;
		text-align:center;
		background:#011a15
		
	}
	</style>
	'.$artdialog.'
	</head>
	<body>
	'.$artDialogScript.'
	</body>
	</html>
';
}
		
//php空白页面使用对话框方法
function login_showArtDialog($title,$artScript)
{
	global $webtitle;
	$webtitle=$title;
	global $artDialogScript;
	$artDialogScript=$artScript;
	return showWebpage();
}

//成功提示-通用对话框-定时跳转
function good_showArtDialog($webtitle,$content,$url,$time)
{
	global $webtitle;
	$webtitle=$title;
	$url="'".$url."'";
	$script= 'javascript:setTimeout("location.href='.$url.'",'.$time.');';	
	global $artDialogScript;
	$artDialogScript = "<script>art.dialog({
		title:'用户设置',
		content:'".$content."',
		icon: 'succeed',
		lock:true,
		opacity:0.6,
		drag:true,
		init:function(){
			$script
		}
	})</script>";
	return showwebpage();
}

//错误提示-通用对话框-定时跳转
function bad_showArtDialog($title,$content,$url,$time)
{
	global $webtitle;
	$webtitle=$title;
	$url="'".$url."'";
	$script= 'javascript:setTimeout("location.href='.$url.'",'.$time.');';	
	global $artDialogScript;
	$artDialogScript = "<script>art.dialog({
		title:'".$title."',
		content:'".$content."',
		icon: 'error',
		lock:true,
		opacity:0.6,
		init:function(){
			$script
		}
	})</script>";
	return showwebpage();
}

?>