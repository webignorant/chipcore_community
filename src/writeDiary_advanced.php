<?php
//发表日记页面
session_start();
header("Content-Type:text/html;   charset=utf-8");
require_once("module_header_div.php");
require_once("module_application_div.php");
require_once("lib/libClass.php");
require_once("lib/userClass.php");
require_once("lib/diaryClass.php");
$lib = new libClass();
$userdb = new userClass();
$diarydb = new diaryClass();
$jqscript;
$script;
$url;

//接收值
if (($mode = $_REQUEST['mode']) == "edit") {
    $diaryID = $_REQUEST['diaryID'];
    $diarydata = $diarydb->getDiaryInfo($diaryID);
    $lib->setvars("title", $diarydata['title']);
    $lib->setvars("content", $diarydata['content']);
    global $url;
    $url = "writeDiary_check.php?mode=edit&diaryID=" . $diarydata[diaryID];
} else {
    $lib->setvars("title", "请输入标题");
	//$lib->setvars("content","");
    global $url;
    $url = "writeDiary_check.php";
}

//模板替换
$lib->setvars("address", $url);

$f = array("f1" => "writeDiary_advanced");
require_once("module_public_setvars.php");
