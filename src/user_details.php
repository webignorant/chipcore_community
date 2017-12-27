<?php
session_start();
header("Content-Type:text/html;   charset=utf-8");
require_once("lib/lib_logincheck.php");
require_once("module_header_div.php");
require_once("module_application_div.php");
require_once "lib/libClass.php";
require_once("lib/userClass.php");


$lib = new libClass();
$userdb = new userClass();

$jqscript;
$script;

$userID = $_GET['userID'];

$userdata = $userdb->getUserInfo($userID);
$user_title;
if ($userID == $_SESSION['userID']) {
    $user_title = '<a href="space.php?mode=me&userID=' . $userID . '"><img width="32" height="32" src="' . $userdata[photo] . '" /></a>
				<a href="user_details.php?userID=' . $userID . '">' . $userdata[realName] . '</a>的详细资料';
} else {
    $user_title = '<a href="space.php?mode=he&userID=' . $userID . '"><img width="32" height="32" src="' . $userdata[photo] . '" /></a>
				<a href="user_details.php?userID=' . $userID . '">' . $userdata[realName] . '</a>的详细资料';
}

$user_details_list = '
	<dl>
		<dt><b>基本信息</b></dt>
			<dd>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;真实姓名:' . $userdata[realName] . '</dd>
			<dd>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;性别:' . $userdata[sex] . '</dd>
			<dd>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;生日:' . $userdata[birthday] . '</dd>
			<dd>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;血型:' . $userdata[bloodType] . '</dd>
			<dd>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;身份:' . $userdata[status] . '</dd>
		<dt><b>联系信息</b></dt>
			<dd>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;居住地址:' . $userdata[location] . '</dd>
			<dd>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;家乡:' . $userdata[homeCity] . '</dd>
			<dd>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;电子邮件:' . $userdata[email] . '</dd>
			<dd>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;QQ:' . $userdata[QQ] . '</dd>
			<dd>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;MSN:' . $userdata[MSN] . '</dd>
		<dt><b>工作信息</b></dt>
			<dd>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;工作单位:' . $userdata[companyName] . '</dd>
			<dd>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;部门名称:' . $userdata[departmentName] . '</dd>
		<dt><b>教育信息</b></dt>
			<dd>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;学校名称:' . $userdata[schoolName] . '</dd>
			<dd>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;班级:' . $userdata[classes] . '</dd>
	</dl
';

//模板替换
$lib->setvars("user_details", $user_details_list);
$lib->setvars("user_title", $user_title);

$f = array("f1" => "user_details");
require_once("module_public_setvars.php");
