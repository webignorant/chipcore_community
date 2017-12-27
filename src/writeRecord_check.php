<?php
ob_start();
session_start();
header("Content-Type:text/html;   charset=utf-8");
require_once("plugins/artDialog/artDialog.php");   //对话框
require_once("lib/lib_logincheck.php");  //用户非法访问检测
require_once("lib/recordClass.php");
require_once("lib/lib_string.php");
require_once("lib/dynamicClass.php");
$dynamicdb = new dynamicClass();
$db = new recordClass();

if (($mood = $_POST['mood']) == "") {
    echo bad_showArtDialog("发表心情", "心情不能为空", "record.php", 2000);
    exit;
}
if (($content = $_POST['content']) == "") {
    echo bad_showArtDialog("发表心情", "记录内容不能为空", "record.php", 2000);
    exit;
}
if (strLength($content) > 50) {
    echo bad_showArtDialog("发表心情", "记录内容不能大于50个长度", "record.php", 2000);
    exit;
}


$url = "'record.php'";
$result = $db->setRecordInfo($mood, $content, $_SESSION['userID']);
if ($result) {
	//心情记录动态分享
	//不提供
    echo good_showArtDialog("发表心情", "心情记录发表成功！", "record.php", 2000);
    exit;
} else {
    echo bad_showArtDialog("发表心情", "心情记录发表失败！", "record.php", 2000);
    exit;
}
