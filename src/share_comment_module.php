<?php
//评论模块
require_once("lib/lib_logincheck.php");
require_once("lib/sharecommentClass.php");
$sharecommentdb = new sharecommentClass();

$comment_show;
//显示评论代码
global $comment_show;
$comment_show .= '<div class="diary_comment_div">
		<form action="share_comment_check.php?type=diary&shareID=' . $diarydata[diaryID] . '&observerID=' . $diarydata[userID] . '" method="post"">
			<img width="50" height="50" src="' . $userAvatar . '" />
			<textarea name="comment" id="comment" value="我也来说一句" style="width:480px; height:50px; margin-left:5px;"}"></textarea>
			<div style="float:right">
				<input type="submit" class="reg_button" value="评论" />
			</div>
		</form>
		</div> ';

//显示评论代码
$shareUserID = $diarydata[userID];
$shareID = $diarydata[diaryID];
$commentresult = $sharecommentdb->getUserAndTypeShareComment($shareUserID, $shareID);
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
    $comment_show .= '<div class="diary_comment_show_div"><h4>还没有，快发表评论吧!</h4></div>';
}
