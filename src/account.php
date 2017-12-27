<?php
session_start();
header("Content-Type:text/html;   charset=utf-8");
require_once("lib/lib_logincheck.php");
require_once("module_header_div.php");
require_once("module_application_div.php");
require_once "lib/libClass.php";
require_once("lib/userClass.php");
require_once("lib/spaceClass.php");
$lib = new libClass();
$userdb = new userClass();
$spacedb = new spaceClass();
$jqscript;
$script;

$mode = $_GET['mode'];
//设置显示模式
if ($mode == "basic") {
    $script .= 'setAccountSettingTab(1);';
} else if ($mode == "work") {
    $script .= 'setAccountSettingTab(2);';
} else if ($mode == "school") {
    $script .= 'setAccountSettingTab(3);';
} else if ($mode == "password") {
    $script .= 'setAccountSettingTab(4);';
} else if ($mode == "setting") {
    $script .= 'setAccountSettingTab(5);';
} else {
    $script .= 'setAccountSettingTab(1);';
}

$userID = $_SESSION['userID'];

//获取用户所有与信息
$userdatabasic = $userdb->getUserBasicInfo($userID);
$userdataworks = $userdb->getUserWorksInfo($userID);
$userdataschool = $userdb->getUserSchoolInfo($userID);
$userdatacustom = $userdb->getUserCustom($userID);
$spacedata = $spacedb->getSpaceInfo($userID);
//基本信息
$nickName = $userdatabasic['nickName'];
$photo = $userdatabasic['photo'];

$realName = $userdatabasic['realName'];
$sex = $userdatabasic['sex'];
$birthday = $userdatabasic['birthday'];
$bloodType = $userdatabasic['bloodType'];
$about = $userdatabasic['about'];
$status = $userdatabasic['status'];
$location = $userdatabasic['location'];
$homeCity = $userdatabasic['homeCity'];
$email = $userdatabasic['email'];
$QQ = $userdatabasic['QQ'];
$MSN = $userdatabasic['MSN'];
//工作信息
$companyName = $userdataworks['companyName'];
$departmentName = $userdataworks['departmentName'];
$joinTime = $userdataworks['joinTime'];
$departureTime = $userdataworks['departureTime'];
//教育信息
$schoolType = $userdataschool['schoolType'];
$schoolName = $userdataschool['schoolName'];
$grade = $userdataschool['grade'];
$classes = $userdataschool['classes'];
$admissionTime = $userdataschool['admissionTime'];
//用户自定义信息
$theme = $userdatacustom['theme'];
$frontCover = $spacedata['frontCover'];
$flashbg = $spacedata['flashbg'];

//数据处理
/*PHP5.3适用
$datatime=new DataTime($birthday);
$bir_year=$datatime->format('Y');
 */
$bir_ymd = explode(" ", $birthday);
$bir_ymd_arr = (explode('-', $bir_ymd[0]));
$bir_year = $bir_ymd_arr[0];
$bir_month = $bir_ymd_arr[1];
$bir_day = $bir_ymd_arr[2];


//通过模板显示用户信息
if ($nickName) {
    $lib->setvars("nickname", $nickName);
}
if ($photo) {
    $lib->setvars("avatar", $photo);
}
if ($realName) {
    $lib->setvars("realname", $realName);
}
if ($sex) {
    if ($sex == "man") {
        $sex = "'1'";
    } else {
        $sex = "'2'";
    }
    $jqscript = '$("#sex option[value=' . $sex . ']").attr("selected","true");';
}
if ($bir_year) {
    $bir_year = "'$bir_year'";
    $jqscript .= '$("#bir_year option[value=' . $bir_year . ']").attr("selected","true");';
}
if ($bir_month) {
    $bir_month = ereg_replace("^0", "", $bir_month);
    $bir_month = "'$bir_month'";
    $jqscript .= '$("#bir_month option[value=' . $bir_month . ']").attr("selected","true");';
}
if ($bir_day) {
    $bir_day = ereg_replace("^0", "", $bir_day);
    $bir_day = "'$bir_day'";
    $jqscript .= '$("#bir_day option[value=' . $bir_day . ']").attr("selected","true");';
}
if ($bloodType) {
    $bloodType = "'$bloodType'";
    $jqscript .= '$("#bloodType option[value=' . $bloodType . ']").attr("selected","true");';
}
if ($location) {
    $lib->setvars("location", $location);
}
if ($homeCity) {
    $lib->setvars("homeCity", $homeCity);
}
if ($status) {
    if ($status == 1) {
        $status = "'1'";
    } else if ($status == 2) {
        $status = "'2'";
    } else {
        $status = "'3'";
    }
    $jqscript .= '$("#status option[value=' . $status . ']").attr("selected","true");';
}
if ($email) {
    $lib->setvars("email", $email);
}
if ($QQ) {
    $lib->setvars("qq", $QQ);
}
if ($MSN) {
    $lib->setvars("msn", $MSN);
}
if ($about) {
    $lib->setvars("about", $about);
}

if ($companyName) {
    $lib->setvars("companyname", $companyName);
}
if ($departmentName) {
    $lib->setvars("departmentname", $departmentName);
}
if ($joinTime) {
    $lib->setvars("joinTime", $joinTime);
}
if ($departureTime) {
    $lib->setvars("departuretime", $departureTime);
}

if ($schoolType) {
    $schoolType = "'$schoolType'";
    $jqscript .= '$("#schoolType option[value=' . $schoolType . ']").attr("selected","true");';
}
if ($schoolName) {
    $lib->setvars("schoolName", $schoolName);
}
if ($grade) {
    $lib->setvars("grade", $grade);
}
if ($classes) {
    $lib->setvars("classes", $classes);
}

if ($theme) {
    $theme = split("/", $theme, 3);
    $theme = ereg_replace(".css", "", $theme[2]);
    $theme = "'$theme'";
    $jqscript .= '$("#theme option[value=' . $theme . ']").attr("selected","true");';
}
if ($frontCover) {
    $space_image = split("/", $frontCover, 4);
    $space_image = "'$space_image[3]'";
    $jqscript .= '$("#space_image option[value=' . $space_image . ']").attr("selected","true");';
}
if ($flashbg) {
    $space_flash = split("/", $flashbg, 4);
    $space_flash = ereg_replace(".swf", "", $space_flash[3]);
    $space_flash = "'$space_flash'";
    $jqscript .= '$("#space_flash option[value=' . $space_flash . ']").attr("selected","true");';
}

//通过模板替换网页

if ($jqscript) {
	//$jqscript='<script language="javascript">'.$jqscript.'</script>';
    $jqscript = '<script language="javascript">$(document).ready(function() { ' . $jqscript . '}); </script>';
	//$jqscript='<script language="javascript">window.onload = function() { '.$jqscript.' }; </script>';
    $lib->setvars("jqscript", $jqscript);
}
$script = '<script language="javascript">' . $script . '</script>';
$lib->setvars("script", $script);

$f = array("f1" => "account");
require_once("module_public_setvars.php");
