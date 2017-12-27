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
require_once("lib/sharecommentClass.php");

$lib = new libClass();
$userdb = new userClass();
$diarydb = new diaryClass();
$sharecommentdb = new sharecommentClass();
$jqscript;
$script;

$diaryID = $_REQUEST['diaryID'];

//显示日记代码
global $diary_show;
$diarydata = $diarydb->getDiaryInfo($diaryID);
$diary_show = '
            <div class="show_diary_div">
                <div class="show_diary_title_div">
                        <a href=""><h3>' . $diarydata[title] . '</h3></a>
                        发表时间：' . $diarydata[addTime] . ' 分类：' . $diarydata[typeID] . ' 日记权限：' . $diarydata[callPurview] . '
                </div>
                <div class="show_diary_operating_div">
                <dl>
                    <dd><a href="writeDiary_advanced.php?mode=edit&diaryID=' . $diarydata[diaryID] . '">编辑</a></dd>
                    <dd><a href="">删除</a></dd>
                </dl>
                </div>

                <div class="show_diary_content">
                    ' . $diarydata[content] . '
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
             <br />
             <br />';


$comment_show;
//显示评论代码
global $comment_show;
$comment_show .= '
        <div class="diary_comment_div">
            <form action="share_comment_check.php?type=diary&shareID=' . $diarydata[diaryID] . '&observerID=' . $diarydata[userID] . '" method="post"">
                <img width="50" height="50" src="' . $userAvatar . '" />
                <textarea name="comment" id="comment" class="diarycomment" value="我也来说一句"></textarea>
                <div style="float:right">
                    <input type="submit" class="reg_button" value="评论" />
                </div>
            </form>
        </div> ';

//显示评论代码
$shareUserID = $diarydata[userID];
$shareType = 2;
$shareID = $diarydata[diaryID];
$commentresult = $sharecommentdb->getUserAndTypeShareComment($shareUserID, $shareType, $shareID);
if ($commentresult == true) {
    global $comment_show;
    $userdata = $userdb->getUserInfo($diarydata[userID]);
    while ($commentdata = mysql_fetch_array($commentresult)) {
        $commentUser;
        if ($diarydata[userID] == $_SESSION['userID']) {
            $commentUser = "我";
        } else {
            $commentUser = $userdata[realName];
        }
        $comment_show .= '       <div class="diary_comment_show_div">
                                    <div style=" width:50px; height:50px; float:left">
                                        <img width="50" height="50" src="' . $userAvatar . '" />
                                    </div>
                                    <div style="float:right">
                                        <div style="width:480px; height:25px;">
                                            <a href="home.php?userID=' . $userdata[userID] . '">' . $commentUser . '</a> : ' . $commentdata[content] . '
                                        </div>
                                        <div style="width:480px; height:25px;">
                                            <a href="home.php?userID=' . $userdata[userID] . '">回复</a>&nbsp;&nbsp;&nbsp;&nbsp;' . $commentdata[addTime] . '
                                        </div>
                                    </div>
                                <div>';
    }
} else {
    $comment_show .= '<div class="diary_comment_show_div"><h4>还没有评论，快发表评论吧!</h4></div>';
}

//通过模板替换网页
$lib->setvars("diary_show", $diary_show);
$lib->setvars("comment_show", $comment_show);


$f = array("f1" => "diary_show");
require_once("module_public_setvars.php");
