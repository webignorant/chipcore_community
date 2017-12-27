<?php
//显示日记
session_start();
header("Content-Type:text/html;   charset=utf-8");
require_once("lib/lib_logincheck.php");
require_once("module_header_div.php");
require_once("module_application_div.php");
require_once "lib/libClass.php";
require_once("lib/friendsClass.php");
require_once("lib/userClass.php");
require_once("lib/diaryClass.php");
$lib = new libClass();
$friendsdb = new friendsClass();
$userdb = new userClass();
$diarydb = new diaryClass();
$jqscript;
$script;

//生成我的日记列表代码
global $my_diary_list;
$mydiarynum = $diarydb->getUserDiaryNum($userID);
if ($mydiarynum == 0) {
    $my_diary_list = '<h4>你还没有日记，快<a href="writeDiary_advanced.php">编写日记</a>吧！</h4>';
} else {
    $diaryresult = $diarydb->getUserDiaryDataInfo($userID);
    while ($diarydata = mysql_fetch_array($diaryresult)) {
        global $diarycontent;
        $diarycontent = $diarydata[content];
        if (strlen($diarycontent) > 120) {
            $diarycontent = strip_tags($diarycontent);
            $diarycontent = substr($diarycontent, 0, 120);
            $diarycontent .= "......";
        }
        $my_diary_list .= '
				<div class="show_diary_div">
					<div class="show_diary_top">
						<div class="show_diary_title">
							<a href="diary_show.php?diaryID=' . $diarydata[diaryID] . '">' . $diarydata[title] . '</a>
						</div>
						<div class="show_diary_operating_div">
							<dl>
								<dd><a href="writeDiary_advanced.php?mode=edit&diaryID=' . $diarydata[diaryID] . '">编辑</a></dd>
								<dd><a href="diary_delete.php?mode=edit&diaryID=' . $diarydata[diaryID] . '">删除</a></dd>
							</dl>
						</div>
					</div>
					<div class="show_diary_info">
						<dl>
							<dl>发表时间：' . $diarydata[addTime] . ' 分类：' . $diarydata[typeID] . ' 日记权限：' . $diarydata[callPurview] . '</dl>
							<dl>' . $diarycontent . '</dl>
						</dl>
					</div>
					<!--
					<div class="show_diary_interactive_div">
						<dl>
							<dd><a href="">转发</a></dd>
							<dd><a href="">评论</a></dd>
							<dd><a href="">赞</a></dd>
						</dl>
					</div>
					-->
				 </div>';
    }
}

//生成查询好友日记的条件
global $condition;
$friendnum = $friendsdb->getAllFriendNum($userID);
if ($friendnum == 0) {
    $condition = 0;
} else {
    $friendresult = $friendsdb->getAllFriendInfo($userID);
    while ($frienddata = mysql_fetch_array($friendresult)) {
        $condition .= ($frienddata[friendID] . ",");
    }
}
$condition = "userID in(" . $condition . "0) and callPurview=1";

//生成好友的日记列表代码
global $friend_diary_list;
$frienddiarynum = $diarydb->getDiaryDataNumForCondition($condition);
if ($frienddiarynum == 0) {
    $friend_diary_list = '<h4>你还没有好友的日记，快<a href="friend.php?mode=add">添加好友</a>吧！</h4>';
} else {

    $frienddiaryresult = $diarydb->getDiaryDataInfoForCondition($condition);
    while ($frienddiarydata = mysql_fetch_array($frienddiaryresult)) {
        global $frienddiarycontent;
        $frienddiarycontent = $frienddiarydata[content];
        if (strlen($frienddiarycontent) > 120) {
            $frienddiarycontent = strip_tags($frienddiarycontent);
            $frienddiarycontent = substr($frienddiarycontent, 0, 120);
            $frienddiarycontent .= "......";
        }
        $friend_diary_list .= '<div class="show_diary_div">
								<div class="show_diary_title">
									<div style="float:left">
										<a href="diary_show.php?diaryID=' . $frienddiarydata[diaryID] . '">' . $frienddiarydata[title] . '</a>
									</div>
									<!--
									<div class="show_diary_operating_div">
									<dl>
										<dd><a href="writeDiary_advanced.php?mode=edit&diaryID=' . $frienddiarydata[diaryID] . '">编辑</a></dd>
										<dd><a href="">删除</a></dd>
									</dl>
									</div>
									-->
								</div>
								<div></div>
								<div class="show_diary_info">
									<dl>
										<dl>发表时间：' . $frienddiarydata[addTime] . ' 分类：' . $frienddiarydata[typeID] . ' 日记权限：' . $frienddiarydata[callPurview] . '</dl>
										<dl>' . $frienddiarycontent . '</dl>
									</dl>
								</div>
								<!--
								<div class="show_diary_interactive_div">
									<dl>
										<dd><a href="">转发</a></dd>
										<dd><a href="">评论</a></dd>
										<dd><a href="">赞</a></dd>
									</dl>
								</div>
								-->
							 </div>
							 <br /><hr />';
    }
}


//通过模板替换网页
$lib->setvars("my_diary_list", $my_diary_list);
$lib->setvars("friend_diary_list", $friend_diary_list);

$f = array("f1" => "diary");
require_once("module_public_setvars.php");
