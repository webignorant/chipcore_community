<?php
ob_start();
session_start();
header("Content-Type:text/html;   charset=utf-8");
require_once("plugins/artDialog/artDialog.php");   //对话框
require_once("lib/lib_logincheck.php");  //用户非法访问检测
require_once("lib/diaryClass.php");
require_once("lib/lib_string.php");
require_once("lib/dynamicClass.php");
$diarydb = new diaryClass();
$dynamicdb = new dynamicClass();

if (($title = $_POST['title']) == "") {
    echo bad_showArtDialog("发表日记", "标题不能为空!", "diary.php", 2000);
    exit;
}
if (($content = $_POST['content']) == "") {
    echo bad_showArtDialog("发表日记", "日记内容不能为空!", "diary.php", 2000);
    exit;
}
if (strLength($content) > 180) {
    echo bad_showArtDialog("发表日记", "记录内容不能大于180个长度!", "diary.php", 2000);
    exit;
}

$mode = $_REQUEST['mode'];
$callpurview = $_POST['callpurview'];
$diaryID = $_REQUEST['diaryID'];

if ($mode != "edit") {
    $result = $diarydb->setDiaryInfo($title, $content, $_SESSION['userID'], $callpurview);
    if ($result) {
		//日记分享动态
        if ($callpurview == 1 || $purviewcall == 2) {
            $dynamicdb->setUserDynamic($_SESSION['userID'], 2, $title);
        }
        echo good_showArtDialog("发表日记", "日记发表成功！", "diary.php", 2000);
        exit;
    } else {
        echo bad_showArtDialog("发表日记", "日记发表失败！", "diary.php", 2000);
        exit;
    }
} else {
    $result = $diarydb->updDiaryInfo($diaryID, $title, $content, $callpurview);
    if ($result) {
        echo good_showArtDialog("发表日记", "日记修改成功！", "diary.php", 2000);
    } else {
        echo bad_showArtDialog("发表日记", "日记修改失败！", "diary.php", 2000);
        exit;
    }
}
