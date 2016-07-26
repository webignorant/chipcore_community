<?php
ob_start(); 
session_start();
header("Content-Type:text/html;   charset=utf-8"); 
require_once("lib/lib_logincheck.php");
require_once("module_header_div.php");
require_once("module_application_div.php");
require_once "lib/libClass.php";
require_once("lib/userClass.php");
require_once("lib/friendsClass.php");

$lib=new libClass();
$userdb=new userClass();
$frienddb=new friendsClass();
$jqscript;
$script;

//动态需要
require_once("lib/dynamicClass.php");
global $dynamicdb;
$dynamicdb = new dynamicClass();
require_once("lib/diaryClass.php");
$diarydb = new diaryClass();
require_once("lib/imageClass.php");
$imagedb = new imageClass();


/*
//查询本人信息
global $userID;
$userID = $_SESSION['userID'];
$username = $_SESSION['realName'];
$usernamelink='<a href="home.php?mode=me&userID='.$userID.'">'.$username.'</a>';
$userdata=$userdb->getUserInfo($userID);
$userAvatar=$userdata['photo'];
*/
//显示我的好友列表
global $friend_list;
$friendnum=$frienddb->getAllFriendNum($userID);
if($friendnum==0)
{
	$friend_list='<h4>你还没有好友，快<a href="friend.php?mode=add">添加好友</a>吧！</h4>';
	$friend_dynamic_list='<h4>还没有好友动态，快<a href="friend.php?mode=add">添加更多好友</a>吧！</h4>';
}else
{
	$friendresult=$frienddb->getAllFriendInfo($userID);
	while($friendata=mysql_fetch_array($friendresult))
	{
		$frienduserdata=$userdb->getUserInfo($friendata[friendID]);
		//通过编号搜索好友动态
		show_friend_dynamic($friendata[friendID]);
		
		$friend_list .='
				<div id="friend_list_div">
					<div class="friend_avatar_div">
                	<a href="space.php?mode=he&userID='.$frienduserdata[userID].'"><img src="'.$frienduserdata[photo].'" width="50px" height="50px"/></a>
                    <a href="user_details.php?userID='.$frienduserdata[userID].'"><h4>'.$frienduserdata[realName].'('.$frienduserdata[count].')</h4></a>
                    </div>
                </div>';
	}
}

//显示更多好友列表
/*
global $more_friend_list;
//查出用户所有好友编号存到数组去
$friendresult=$frienddb->getAllFriendInfo($_SESSION['userID']);
$friendarraylist; //好友列表数组
$i=0;
while($frienddata=mysql_fetch_array($friendresult))
{
	$friendarraylist[$i]=$frienddata[friendID];
	$i++;
}
print_r($friendarraylist);
exit;
$morefriendarraylist; //更多好友列表数组
$i=0;
$userdb->getRandomUserInfoForArray($friendarray);
while($morefrienddata=mysql_fetch_array($friendresult))
{
	$morefriendarraylist[$i]=$frienddata[friendID];
	$i++;
}


print_r($friendarraylist);
exit;
*/
global $more_friend_list;
//查出用户所有好友编号存到数组去
$friendresult=$frienddb->getAllFriendInfo($_SESSION['userID']);
$friendarraylist; //好友列表数组
$i=0;
while($frienddata=mysql_fetch_array($friendresult))
{
	$friendarraylist[$i]=$frienddata[friendID];
	$i++;
}
//添加当前用户编号
$i=$i+1;
$friendarraylist[$i]=$_SESSION['userID'];
/*
$usermaxnum=$userdb->getUserMaxNum();
$friendnum=$frienddb->getAllFriendNum($_SESSION['userID']);
$morefriendnum=($usermaxnum-$friendnum-1);
*/
$morefriendresult=$userdb->getRandomUserInfoForArray($friendarraylist);
if($morefriendresult!="")
{
	while($morefrienddata=mysql_fetch_array($morefriendresult))
	{
		$moredata=$userdb->getUserInfo($morefrienddata[userID]);
		global $more_friend_list;
		$more_friend_list .='
			<div id="more_friend_list_div">
				<div class="friend_avatar_div">
					<a href="space.php?mode=he&userID='.$moredata[userID].'"><img src="'.$moredata[photo].'" width="50px" height="50px"/></a>
					<a href="friend.php?mode=add&finduserID='.$moredata[userID].'"><h4>'.$moredata[realName].'</h4></a>
				</div>
			</div>';
	}
}else
{
	$more_friend_list='<h4>人气不旺，叫叫亲朋好友来这里吧！</h4>';
}


//好友动态列表
global $friend_dynamic_list;
global $frienddynamicdata;
function show_friend_dynamic($friendID)
{
	global $dynamicdb;
	global $userdb;
	$friend_dynamic_num=10;//好友动态最大条数
	$condition="order by actionTime desc LIMIT 0,$friend_dynamic_num";
	$frienddynamicresult=$dynamicdb->getUserDataDynamicForCondition($friendID,$condition);
	if(!$frienddynamicresult)
	{
		$friend_dynamic_list='<h4>还没有好友动态，快<a href="friend.php?mode=add">添加更多好友</a>吧！</h4>';
	}else
	{
		$friend_dynamic_maxnum=20;		
		while($frienddynamicdata=mysql_fetch_array($frienddynamicresult))
		{
			global $friend_dynamic_list;
			global $userdb;
			global $msg;
			global $diarydb;
			$friend_dynamic_maxnum--;
			$userdata=$userdb->getUserInfo($friendID);
			if(($friend_dynamic_maxnum--)<0)
			{
				break;
			}
			switch($frienddynamicdata['actionType'])
			{
				case 1:
						//不提供
						$typename="心情记录";
						break;
				case 2:
						$typename="日记";
						$condition="and title='$frienddynamicdata[actionObject]'";
						$diarydata=$diarydb->getDiaryIDForUserAndCondition($friendID,$condition);
						$msg='<a href="home.php?mode=he&userID='.$userdata[userID].'">'.$userdata[realName].'</a>分享了一篇'.$typename.'<a href="diary_show.php?diaryID='.$diarydata[diaryID].'">'.$frienddynamicdata[actionObject].'</a>,快去看看吧！';
						break;
				case 3:
						//不提供
						$typename="文章";
						$msg="不提供";
						break;
				case 4:
						$typename="照片";
						$condition="and imageName=$frienddynamicdata[actionObject]";
						$diarydata=$imagedb->getImageIDForUserAndCondition($friendID,$condition);
						$msg='<a href="space.php?mode=he&userID='.$userdata[userID].'">'.$userdata[realName].'</a>分享了一张'.$typename.'<a href="image_view.php?imageID='.$diarydata[diaryID].'">'.$frienddynamicdata[actionObject].'</a>,快去看看吧！';
						break;
				case 5:
						//不提供
						$typename="音乐";
						$msg="不提供";
						break;
				case 6:
						//不提供
						$typename="视频";
						$msg="不提供";
						break;
				case 7:
						//不提供
						$typename="文件";
						$msg="不提供";
						break;
				case 8:
						//不提供
						$typename="添加好友";
						//$msg="不提供";
						$condition="realName='$frienddynamicdata[actionObject]'";
						$fuserdata=$userdb->getUserInfo($friendID);
						$tuserdata=$userdb->findUserInfoDataForCondition($condition);
						$msg='<a href="space.php?mode=he&userID='.$fuserdata[userID].'">'.$userdata[realName].'</a>和<a href="space.php?mode=he&userID='.$tuserdata[userID].'">'.$frienddynamicdata[actionObject].'</a>成为了好友！';
						break;
				case 9:
						$typename="添加关注";
						$msg="不提供";
						break;
				case 10:
						$typename="新人报道";
						//$userdata=$userdb->getUserInfo($friendID);
						//$msg='欢迎<a href="home?mode=he&userID='.$userdata[userID].'">'.$userdata[realName].'</a>加入社区！';
						$msg="不提供";
						break;
				default :
						$msg = "错误参数";
						break;
			}
			global $friend_dynamic_list;
			if($msg!="不提供"&&$msg!="错误参数")
			{
				$friend_dynamic_list.='<div class="dynamic_div">
											<div class="dynamic_head_div">
												<a href="space.php?mode=he&userID='.$userdata[userID].'"><img src="'.$userdata[photo].'" width="60px" height="60px"/></a>
											</div>
											<div class="dynamic_content_div">
												'.$msg.'
											</div>
										</div>';
			}else if($msg=="不提供")
			{
				$friend_dynamic_list.=' ';
			}else
			{
				$friend_dynamic_list.=' ';
			}
		}
	}
}

//全部动态列表
global $all_dynamic_list;
global $frienddynamicdata;
global $msg;
static $dynamic_maxnum=20;//动态最大条数
$friend_dynamic_num=10;
$condition="order by actionTime desc LIMIT 0,$friend_dynamic_num";
$frienddynamicresult=$dynamicdb->getAllUserDataDynamicForCondition($condition);
if(!$frienddynamicresult)
{
	$all_dynamic_list='<h4>还没有动态，快发表动态吧！</h4>';
}else
{
	while($frienddynamicdata=mysql_fetch_array($frienddynamicresult))
	{
		$friendID=$frienddynamicdata['userID'];
		$userdata=$userdb->getUserInfo($friendID);
		$friend_dynamic_maxnum--;
		if(($friend_dynamic_maxnum--)<0)
		{
			break;
		}
		global $msg;
		switch($frienddynamicdata['actionType'])
		{
				case 1:
						//不提供
						$typename="心情记录";
						$msg="不提供";
						break;
				case 2:
						$typename="日记";
						$condition="and title='$frienddynamicdata[actionObject]'";
						$diarydata=$diarydb->getDiaryIDForUserAndCondition($friendID,$condition);
						$msg='<a href="space.php?mode=he&userID='.$userdata[userID].'">'.$userdata[realName].'</a>分享了一篇'.$typename.'<a href="diary_show.php?diaryID='.$diarydata[diaryID].'">'.$frienddynamicdata[actionObject].'</a>,快去看看吧！';
						break;
				case 3:
						//不提供
						$typename="文章";
						break;
				case 4:
						$typename="照片";
						$condition="and imageName=$frienddynamicdata[actionObject]";
						$diarydata=$imagedb->getImageIDForUserAndCondition($friendID,$condition);
						$msg='<a href="space.php?mode=he&userID='.$userdata[userID].'">'.$userdata[realName].'</a>分享了一张'.$typename.'<a href="image_view.php?imageID='.$diarydata[diaryID].'">'.$frienddynamicdata[actionObject].'</a>,快去看看吧！';
						break;
				case 5:
						//不提供
						$typename="音乐";
						$msg="不提供";
						break;
				case 6:
						//不提供
						$typename="视频";
						$msg="不提供";
						break;
				case 7:
						//不提供
						$typename="文件";
						$msg="不提供";
						break;
				case 8:
						//不提供
						$typename="添加好友";
						//$msg="不提供";
						$condition="realName='$frienddynamicdata[actionObject]'";
						$fuserdata=$userdb->getUserInfo($friendID);
						$tuserdata=$userdb->findUserInfoDataForCondition($condition);
						$msg='<a href="space.php?mode=he&userID='.$fuserdata[userID].'">'.$userdata[realName].'</a>和<a href="space.php?mode=he&userID='.$tuserdata[userID].'">'.$frienddynamicdata[actionObject].'</a>成为了好友！';
						break;
				case 9:
						$typename="添加关注";
						$msg="不提供";
						break;
				case 10:
						$typename="新人报道";
						$userdata=$userdb->getUserInfo($friendID);
						$msg='欢迎<a href="space.php?mode=he&userID='.$userdata[userID].'">'.$userdata[realName].'</a>加入社区！';
						break;
				default :
						$msg ="错误参数";
						break;
		}
			if($msg!="不提供"&&$msg!="错误参数")
			{
				$all_dynamic_list.='<div class="dynamic_div">
											<div class="dynamic_head_div">
												<a href="space.php?mode=he&userID='.$userdata[userID].'"><img src="'.$userdata[photo].'" width="60px" height="60px"/></a>
											</div>
											<div class="dynamic_content_div">
												'.$msg.'
											</div>
										</div>';
			}else
			{
				$all_dynamic_list.="";
			}
	}
}


//模板替换
$lib->setvars("friend_list",$friend_list);
$lib->setvars("more_friend",$more_friend_list);

if($friend_dynamic_list==" ")
{		
	$friend_dynamic_list='<h4>还没有好友动态，快<a href="friend.php?mode=add">添加更多好友</a>吧！</h4>';
}
$lib->setvars("friend_dynamic_list",$friend_dynamic_list);
$lib->setvars("all_dynamic_list",$all_dynamic_list);

$f=array("f1"=>"home");
require_once("module_public_setvars.php");

?>