<?php
//分享评论处理
ob_start();
session_start();
header("Content-Type:text/html;   charset=utf-8");
require_once("plugins/artDialog/artDialog.php");   //对话框
require_once("lib/lib_logincheck.php");  //用户非法访问检测
require_once("lib/lib_logincheck.php");
require_once("lib/sharecommentClass.php");
require_once("lib/lib_string.php");
require_once("lib/dynamicClass.php");
$dynamicdb = new dynamicClass();
$sharecommentdb = new sharecommentClass();

if (($shareType = $_REQUEST['type']) == "") {
    echo bad_showArtDialog("分享评论", "分享类型为空!", "diary.php", 2000);
    exit;
}
if (($observerID = $_REQUEST['observerID']) == "") {
    echo bad_showArtDialog("分享评论", "被评论者编号为空!", "diary.php", 2000);
    exit;
}
if (($reviewersID = $_SESSION['userID']) == "") {
    echo bad_showArtDialog("分享评论", "评论者编号为空!", "diary.php", 2000);
    exit;
}
if (($shareID = $_REQUEST['shareID']) == "") {
    echo bad_showArtDialog("分享评论", "被评论的分享编号为空!", "diary.php", 2000);
    exit;
}
if (($comment = $_POST['comment']) == "") {
    echo bad_showArtDialog("分享评论", "评论内容不能为空!", "diary.php", 2000);
    exit;
}

$urlLink;
switch ($shareType) {
    case "mood":
        $shareType = 1;
        $urlLink = "'mood_show.php?moodID=$shareID'";
        break;
    case "diary":
        $shareType = 2;
        $urlLink = "'diary_show.php?diaryID=$shareID'";
        break;
    case "article":
        $shareType = 3;
        $urlLink = "'article_show.php?id=$shareID'";
        break;
    case "image":
        $shareType = 4;
        $urlLink = "'image_view.php?imageID=$shareID'";
        break;
    case "music":
        $shareType = 5;
        $urlLink = "'music_view.php?musicID=$shareID'";
        break;
    case "video":
        $shareType = 6;
        $urlLink = "'video_view.php?videoID=$shareID'";
        break;
    case "file":
        $shareType = 7;
        $urlLink = "'file_show.php?fileID=$shareID'";
        break;
}


$result = $sharecommentdb->setShareComment($shareType, $observerID, $reviewersID, $shareID, $comment);
if ($result) {
	//评论动态分享
    $dynamicdb->setUserDynamic($_SESSION['userID'], 11, $title);

    echo good_showArtDialog("分享评论", "评论发表成功!", "diary.php", 2000);
    exit;
} else {
    echo bad_showArtDialog("分享评论", "评论发表失败!", "diary.php", 2000);
    exit;
}
