<?php
//删除音乐
session_start();
header("Content-Type:text/html;   charset=utf-8");
require_once("plugins/artDialog/artDialog.php");   //对话框
require_once("lib/lib_logincheck.php");  //用户非法访问检测
require_once "lib/libClass.php";
require_once("lib/musicClass.php");

$lib = new libClass();
$musicdb = new musicClass();
$jqscript;
$script;

$musicID = $_REQUEST['musicID'];

$musiclink = $musicdb->getMusicInfo($musicID);
$musicPath = $musiclink[musicPath];
$musicresult = $musicdb->delmusicInfo($musicID);

$msg;

if ($musicresult) {
    global $msg;
    $msg = "删除音乐记录成功！" . "<br>";
    global $del;
    echo $musicPath . "<hr>";
    echo $del = unlink("$musicPath");
    exit;
    if ($del) {
        $msg .= "删除音乐文件成功！" . "<br>";
    } else {
        $msg .= "删除音乐文件失败！" . "<br>";
    }
} else {
    global $msg;
    $msg .= "删除音乐记录失败！" . "<br>";
}
if ($musicresult && $del) {
    global $msg;
    $msg . "删除音乐成功！";
    echo good_showArtDialog("音乐处理", $msg, "music.php", 2000);
    exit;
} else {
    global $msg;
    $msg . "删除音乐失败！";
    echo bad_showArtDialog("音乐处理", $msg, "music.php", 2000);
    exit;
}
