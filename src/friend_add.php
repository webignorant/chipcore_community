<?php
session_start();
header("Content-Type:text/html;   charset=utf-8");
require_once("plugins/artDialog/artDialog.php");   //对话框
require_once("lib/lib_logincheck.php");  //用户非法访问检测
//好友添加处理
require_once("lib/userClass.php");
require_once("lib/friendsClass.php");
require_once("lib/dynamicClass.php");
$dynamicdb = new dynamicClass();
$userdb = new userClass();
$friendsdb = new friendsClass();

$userID = $_SESSION['userID'];
$friendID = $_REQUEST['friendID'];

$meresult = $friendsdb->setFriendInfo($userID, $friendID);
$heresult = $friendsdb->setFriendInfo($friendID, $userID);
if ($meresult && $heresult) {
    $userdata = $userdb->getUserInfo($friendID);
    $dynamicdb->setUserDynamic($userID, 8, $userdata['realName']);
    echo good_showArtDialog("添加好友", "添加好友成功!", "friend.php", 2000);
    exit;
} else {
    echo good_showArtDialog("添加好友", "添加好友失败!", "friend.php", 2000);
    exit;
}
