<?php
//显示图片
session_start();
header("Content-Type:text/html;   charset=utf-8"); 
require_once("lib/lib_logincheck.php");
require_once("module_header_div.php");
require_once("module_application_div.php");
require_once "lib/libClass.php";
require_once("lib/userClass.php");
require_once("lib/imageClass.php");
require_once("lib/sharecommentClass.php");
$sharecommentdb=new sharecommentClass();
$lib=new libClass();
$userdb=new userClass();
$imagedb=new imageClass();

$imageID=$_GET['imageID'];

//显示图片代码
global $image_view;
$imagedata=$imagedb->getImageInfo($imageID);
$image_view ='<img width="800" height="600" src="'.$imagedata[imagePath].'" />';

$comment_show;
//显示评论代码
global $comment_show;
$comment_show.='
		<div class="image_comment_div">
			<form action="share_comment_check.php?type=image&shareID='.$imagedata[imageID].'&observerID='.$imagedata[userID].'" method="post"">
				<img width="50" height="50" src="'.$userAvatar.'" />
				<textarea name="comment" class="imagecomment" value="我也来说一句"></textarea>
				<div style="float:right">
					<input type="submit" class="reg_button" value="评论" />
				</div>
			</form>
		</div> '; 

//显示评论代码
$shareUserID=$imagedata[userID];
$shareType=4;
$shareID=$imageID;
$commentresult=$sharecommentdb->getUserAndTypeShareComment($shareUserID,$shareType,$shareID);
if($commentresult==true)
{
	global $comment_show;
	$userdata=$userdb->getUserInfo($imagedata[userID]);
	while($commentdata=mysql_fetch_array($commentresult))
	{
		$commentUser;
		if($diarydata[userID]==$_SESSION['userID'])
		{
			$commentUser="我";
		}else
		{
			$commentUser=$userdata[realName];
		}
		$comment_show.='       <div class="diary_comment_show_div">
									<div style=" width:50px; height:50px; float:left">
										<img width="50" height="50" src="'.$userAvatar.'" />
									</div>
									<div style="float:right">
										<div style="width:480px; height:25px;">
											<a href="home.php?userID='.$userdata[userID].'">'.$commentUser.'</a> : '.$commentdata[content].'
										</div>
										<div style="width:480px; height:25px;">
											<a href="home.php?userID='.$userdata[userID].'">回复</a>&nbsp;&nbsp;&nbsp;&nbsp;'.$commentdata[addTime].'
										</div>
									</div>
								<div>';
	}
}else
{
	$comment_show.='<div class="diary_comment_show_div"><h4>还没有过评论，快发表评论吧!</h4></div>';
}


//通过模板替换网页
$lib->setvars("image_view",$image_view);
$lib->setvars("imageID",$imageID);
$lib->setvars("user_Avatar",$userAvatar);
$lib->setvars("comment_show",$comment_show);

$f=array("f1"=>"image_view");
require_once("module_public_setvars.php");


?>