<?php
session_start();
header("Content-Type:text/html;   charset=utf-8");
require_once("lib/lib_logincheck.php");
require_once("module_header_div.php");
require_once("module_application_div.php");
require_once "lib/libClass.php";
require_once("lib/friendsClass.php");
require_once("lib/userClass.php");
require_once("lib/friendgroupClass.php");
$lib = new libClass();
$friendsdb = new friendsClass();
$userdb = new userClass();
$friendgroupdb = new friendgroupClass();
$jqscript;
$script;

$mode = $_GET['mode'];
$finduserID = $_GET['finduserID'];
if ($finduserID == "") {
    $finduserID = "不提供直接输入用户编号";
}
//设置显示模式
if ($mode == "show") {
    $script = '<script>setFriendTab(1);</script>';
} else if ($mode == "add") {
    $script = '<script>setFriendTab(2);</script>';
} else {
    $script = '<script>setFriendTab(1);</script>';
}


//生成好友列表代码
global $friend_list;
$friendnum = $friendsdb->getAllFriendNum($userID);
if ($friendnum == 0) {
    $friend_list = '<h4>你还没有好友，快<a href="friend.php?mode=add">添加好友</a>吧！</h4>';
} else {
    $friendresult = $friendsdb->getAllFriendInfo($userID);
    while ($friendata = mysql_fetch_array($friendresult)) {
        $userdata = $userdb->getUserInfo($friendata[friendID]);
        $friendgroupdata = $friendgroupdb->getFriendGroup($friendata[groupID]);
        $friend_list .= '<div class="show_friend_div">
		<div class="show_friend_info">
			<a href="space.php?mode=he&userID=' . $friendata[friendID] . '"><img width="50px" height="50px" src="' . $userdata[photo] . '" style=" position:absolute;left:10px;top:10px;"/></a>
			<div class="friend_info">
				<dl>
					<dd><h5>姓名：<a href="user_details.php?userID=' . $friendata[friendID] . '">' . $userdata[realName] . '</a></h5></dd>
					<dd><h5>组名：' . $friendgroupdata[groupName] . '</h5></dd>
				</dl>
			</div>
		</div>
		<div class="show_friend_operate_div">
			<dl>
				<dd><a href="writeMessage.php?sendUserID=' . $friendata[friendID] . '">发消息</a></dd>
			</dl>
		</div>
	 </div>
	 ';
    }
}


//通过模板替换网页
$lib->setvars("script", $script);
$lib->setvars("friend_list", $friend_list);
$lib->setvars("finduserID", $finduserID);

$f = array("f1" => "friend");
require_once("module_public_setvars.php");
