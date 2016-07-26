<?php
//删除日记
session_start();
header("Content-Type:text/html;   charset=utf-8"); 
require_once("plugins/artDialog/artDialog.php");   //对话框
require_once("lib/lib_logincheck.php");  //用户非法访问检测
require_once "lib/libClass.php";
require_once("lib/diaryClass.php");

$lib=new libClass();
$diarydb=new diaryClass();

$diaryID=$_REQUEST['diaryID'];

$diaryresult=$diarydb->delDiaryInfo($diaryID);
if($diaryresult)
{
	echo good_showArtDialog("日记处理","删除日记成功!","diary.php",2000);
	exit;
}else
{
	echo bad_showArtDialog("日记处理","删除日记失败!","diary.php",2000);
	exit;
}



?>