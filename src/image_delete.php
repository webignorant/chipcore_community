<?php
//删除图片
session_start();
header("Content-Type:text/html;   charset=utf-8");
require_once("plugins/artDialog/artDialog.php");   //对话框
require_once("lib/lib_logincheck.php");  //用户非法访问检测
require_once "lib/libClass.php";
require_once("lib/imageClass.php");
require_once("lib/dynamicClass.php");
$dynamicdb = new dynamicClass();
$lib = new libClass();
$imagedb = new imageClass();

$imageID = $_REQUEST['imageID'];

$imagelink = $imagedb->getImageInfo($imageID);
$imagePath = $imagelink[imagePath];
$imageresult = $imagedb->delImageInfo($imageID);

$msg;

if ($imageresult) {
    global $msg;
    $msg = "删除图片记录成功！" . "<br>";
    global $del;
    $del = unlink($imagePath);
    if ($del) {
        $msg .= "删除图片文件成功！" . "<br>";
    } else {
        $msg .= "删除图片文件失败！" . "<br>";
    }
} else {
    global $msg;
    $msg = "删除图片记录失败！" . "<br>";
}
if ($imageresult && $del) {
    global $msg;
    $msg .= "删除图片成功！";
    echo good_showArtDialog("图片处理", $msg, "pictrue.php", 2000);
} else {
    global $msg;
    $msg .= "删除图片失败！";
    echo bad_showArtDialog("图片处理", $msg, "pictrue.php", 2000);
    exit;
}
