<?php
//显示心情记录
session_start();
header("Content-Type:text/html;   charset=utf-8");
require_once("lib/lib_logincheck.php");
require_once("module_header_div.php");
require_once("module_application_div.php");
require_once "lib/libClass.php";
require_once("lib/friendsClass.php");
require_once("lib/userClass.php");
require_once("lib/recordClass.php");
$lib = new libClass();
$friendsdb = new friendsClass();
$userdb = new userClass();
$recorddb = new recordClass();
$jqscript;
$script;

//生成我的心情记录列表代码
global $my_record_list;
$myrecordnum = $recorddb->getUserRecordNum($userID);
if ($myrecordnum == 0) {
    $my_record_list = '<h4>你还没有心情记录，快<a href="home.php">编写心情记录</a>吧！</h4>';
} else {
    $recordresult = $recorddb->getAllRecordData($userID);
    while ($recorddata = mysql_fetch_array($recordresult)) {
        $userdata = $userdb->getUserInfo($recorddata['userID']);
        $my_record_list .= '<div id="show_record_div">
                	<div class="show_record_image">
                    	<a href="space.php?mode=me&userID=' . $userID . '"><img width="64" height="64" src="' . $userAvatar . '" /></a>
                    </div>
                    <div class="show_record_content">
                    	<div class="show_record_user">
                        	<span class="record_username_span"><h4><a href="user_details.php?userID=' . $userID . '">' . $userdata[realName] . '</a></h4></span>
                            <span class="record_time_span">
                            	' . $recorddata[addTime] . '
                            </span>
                        </div>
                        <div class="record_content_div">
                        	' . $recorddata[content] . '
                        </div>
                    </div>
                </div>';
    }
}

//通过模板替换网页
$lib->setvars("my_record_list", $my_record_list);

$f = array("f1" => "record");
require_once("module_public_setvars.php");
