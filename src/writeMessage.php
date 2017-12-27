<?php
//发送短消息页面
session_start();
header("Content-Type:text/html;   charset=utf-8");
require_once("module_header_div.php");
require_once("module_application_div.php");
require_once("lib/libClass.php");
require_once("lib/userClass.php");
$lib = new libClass();
$userdb = new userClass();
$jqscript;
$script;

$send_userID = $_REQUEST['sendUserID'];

//查询该用户所有信息
if ($send_userID != "") {
    $userdata = $userdb->getUserInfo($send_userID);
    $send_username = $userdata['realName'];
    $send_email = $userdata['email'];
    $lib->setvars("send_userID", $send_userID);
    $lib->setvars("send_username", $send_username);
    $lib->setvars("send_email", $send_email);
}

//模板替换
$lib->setvars("application_div", $application_div);

$f = array("f1" => "writeMessage");
require_once("module_public_setvars.php");
