<?php
session_start();
header("Content-Type:text/html;   charset=utf-8"); 
require_once("lib/lib_logincheck.php");
require_once("module_header_div.php");
require_once("module_application_div.php");
require_once("module_flash_div.php");
require_once "lib/libClass.php";
require_once("lib/userClass.php");
require_once("lib/friendsClass.php");
require_once("lib/spaceClass.php");
require_once("lib/visitorClass.php");
require_once("lib/diaryClass.php");
require_once("lib/imageClass.php");
require_once("lib/recordClass.php");

$lib=new libClass();
$userdb=new userClass();
$frienddb=new friendsClass();
$spacedb=new spaceClass();
$visitordb=new visitorClass();
$diarydb = new diaryClass();
$imagedb = new imageClass();
$recorddb = new recordClass();
$jqscript;
$script;

//动态需要
require_once("lib/dynamicClass.php");
$dynamicdb = new dynamicClass();

global $userID;
$mode=$_GET['mode'];
$flashbackground;
$spaceID;
$details_link;

if($mode=="me")
{
	$userID=$_SESSION['userID'];
	//空间显示处理
	$spacedata=$spacedb->getSpaceInfo($userID);
	global $spaceID;
	$spaceID=$spacedata['spaceID'];
	global $title;
	if($title=$spacedata['title']=="")
	{
		$address="还没有标题呢";
	}
	$frontcover=$spacedata['frontCover'];
	global $flashbackground;
	$flashbackground=setFlashBackground($spacedata['flashbg']);
	global $mood;
	$recorddata=$recorddb->getNewRecordInfo($userID);
	if($recorddata!="")
	{
		$mood=$recorddata['content']."  ".$recorddata['addTime']."发表";
	}else
	{
		$mood="还没有发表过心情呢？";
	}
	
	//显示用户信息简介
	$userdata=$userdb->getUserInfo($userID);
	global $username;
	$username="<b>".$userdata['realName']."</b>";
	global $status;
	switch($userdata['statue'])
	{
		case 1:$status="学生";break;
		case 2:$status="工作者";break;
		case 3:$status="未知身份";break;
	}
	global $birthday;
	if(($birthday=$userdata['birthday'])=="")
	{
		$birthday="未填写";
	}
	global $address;
	if(($address=$userdata['location'])=="")
	{
		$address="未填写";
	}
	global $avatar;
	$avatar='<a href="account.php"><img width="160" height="160" style="margin:auto;" src="'.$userdata['photo'].'" style="z-index:995;"/></a>';
	global $details_link;
	$details_link="user_details.php?userID=".$userID;
}else
{
	$userID=$_GET['userID'];
	$visitorID=$_SESSION['userID'];
	//访客信息处理	
	global $visitordb;
	if(($visitordb->checkVisitorInSpaceExitst($userID,$visitorID))!=1)
	{
		$visitordb->setVisitorInfo($visitorID,$userID,$userID);
	}else
	{
		$visitordb->updVisitorCount($visitorID,$userID);
	}
		
	//空间显示处理
	$spacedata=$spacedb->getSpaceInfo($userID);
	global $spaceID;
	$spaceID=$spacedata['spaceID'];
	global $title;
	if($title=$spacedata['title']=="")
	{
		$address="还没有标题呢";
	}
	$frontcover=$spacedata['frontCover'];
	global $flashbackground;
	$flashbackground=setFlashBackground($spacedata['flashbg']);
	global $mood;
	$recorddata=$recorddb->getNewRecordInfo($userID);
	if($recorddata!="")
	{
		$mood=$recorddata['content']."  ".$recorddata['addTime']."发表";
	}else
	{
		$mood="还没有发表过心情呢？";
	}
	
	//显示用户信息简介
	$userdata=$userdb->getUserInfo($userID);
	global $username;
	$username="<b>".$userdata['realName']."</b>";
	global $status;
	switch($userdata['status'])
	{
		case 1:$status="学生";break;
		case 2:$status="工作者";break;
		case 3:$status="未知身份";break;
	}
	global $birthday;
	if(($birthday=$userdata['birthday'])=="")
	{
		$birthday="未填写";
	}
	global $address;
	if(($address=$userdata['location'])=="")
	{
		$address="未填写";
	}
	global $avatar;
	$avatar='<a href="account.php"><img width="160" height="160" style="margin:auto;" src="'.$userdata['photo'].'" style="z-index:995;"/></a>';
	global $details_link;
	$details_link="user_details.php?userID=".$userID;
}

/*
//显示更多好友列表
global $more_friend_list;
$morefriendresult=$userdb->getRandomUserInfo();
while($morefrienddata=mysql_fetch_array($morefriendresult))
{
	$moredata=$userdb->getUserInfo($morefrienddata[userID]);
	$more_friend_list .='<div id="more_friend_list_div">
			<div class="friend_avatar_div">
				<img src="'.$moredata[photo].'" width="50px" height="50px"/>
				<a href="friend.php?mode=add&finduserID='.$moredata[userID].'"><h4>'.$moredata[realName].'</h4></a>
			</div>
			</div>';
}
*/

//显示我的好友列表
global $whoFriend;
if($mode=="me")
{
	$whoFriend='<a href="friend.php?mode=show"><h3>我的好友</h3></a>';
}else if($mode=="he")
{
	$whoFriend='<h3>他的好友</h3>';
}

global $friend_list;
$friendnum=$frienddb->getAllFriendNum($userID);
if($friendnum==0)
{
	global $friend_list;
	global $friend_dynamic_list;
	if($mode=="me")
	{
		$friend_list='<h4>你还没有好友，快<a href="friend.php?mode=add">添加好友</a>吧！</h4>';
		$friend_dynamic_list='<h4>还没有好友动态，快<a href="friend.php?mode=add">添加更多好友</a>吧！</h4>';
	}else
	{
		$friend_list='<h4>他还没有好友，快<a href="friend.php?mode=add&finduserID='.$userID.'">加他为好友</a>吧！</h4>';
		$friend_dynamic_list='<h4>还没有他动态，快<a href="writeMessage.php?sendUserID='.$userID.'">提醒他</a>吧！</h4>';
	}
}else
{
	$friendresult=$frienddb->getAllFriendInfo($userID);
	while($friendata=mysql_fetch_array($friendresult))
	{
		$frienduserdata=$userdb->getUserInfo($friendata[friendID]);
		//通过编号搜索好友动态
		show_friend_dynamic($friendata[friendID]);
		
		global $friend_list;
		if($visitoruserdata[userID]==$_SESSION['userID'])
		{
			$friend_list .='
				<div id="friend_list_div">
					<div class="friend_avatar_div">
                	<a href="space.php?mode=me&userID='.$frienduserdata[userID].'"><img src="'.$frienduserdata[photo].'" width="50px" height="50px"/></a>
                    <a href="user_details.php?userID='.$frienduserdata[userID].'"><h4>'.$frienduserdata[realName].'('.$frienduserdata[count].')</h4></a>
                    </div>
                </div>';
		}else
		{
			$friend_list .='<div id="friend_list_div">
					<div class="friend_avatar_div">
                	<a href="space.php?mode=he&userID='.$frienduserdata[userID].'"><img src="'.$frienduserdata[photo].'" width="50px" height="50px"/></a>
                    <a href="user_details.php?userID='.$frienduserdata[userID].'"><h4>'.$frienduserdata[realName].'('.$frienduserdata[count].')</h4></a>
                    </div>
                </div>';
		}
	}
}

//显示最近访客
global $visitor;
$visitnum;
$visitornum=$visitordb->getAllVisitorNum($spaceID);
if($visitornum==0)
{
	$visitor_list='<h4>还没有人踏进你空间！</h4>';
	global $visitnum;
	$visitnum="0";
}else
{
	$visitnum=$visitordb->getAllVisitNum($spaceID);
	$visitnum;
	$visitorresult=$visitordb->getAllVisitorData($userID);
	while($visitordata=mysql_fetch_array($visitorresult))
	{
		$visitoruserdata=$userdb->getUserInfo($visitordata[visitorID]);
		//通过编号搜索访客信息
		global $visitor_list;
		if($visitoruserdata[userID]==$_SESSION['userID'])
		{
			$visitor_list .='<div id="friend_list_div">
					<div class="friend_avatar_div">
                	<a href="space.php?mode=me&userID='.$visitoruserdata[userID].'"><img src="'.$visitoruserdata[photo].'" width="50px" height="50px"/></a>
                    <a href="user_details.php?userID='.$visitoruserdata[userID].'"><h4>'.$visitoruserdata[realName].'('.$visitordata[count].')</h4></a>
                    </div>
                </div>';
		}else
		{
			$visitor_list .='<div id="friend_list_div">
					<div class="friend_avatar_div">
                	<a href="space.php?mode=he&userID='.$visitoruserdata[userID].'"><img src="'.$visitoruserdata[photo].'" width="50px" height="50px"/></a>
                    <a href="user_details.php?userID='.$visitoruserdata[userID].'"><h4>'.$visitoruserdata[realName].'('.$visitordata[count].')</h4></a>
                    </div>
                </div>';
		}
		
	}
}

//好友动态列表
global $friend_dynamic_list;
global $frienddynamicdata;
static $friend_dynamic_maxnum=20;
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
		while($frienddynamicdata=mysql_fetch_array($frienddynamicresult))
		{
			global $friend_dynamic_maxnum;
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
						$msg='<a href="home.php?mode=he&userID='.$userdata[userID].'">'.$userdata[realName].'</a>分享了一张'.$typename.'<a href="image_view.php?imageID='.$diarydata[diaryID].'">'.$frienddynamicdata[actionObject].'</a>,快去看看吧！';
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
						$msg='<a href="home.php?mode=he&userID='.$fuserdata[userID].'">'.$userdata[realName].'</a>和<a href="home.php?mode=he&userID='.$tuserdata[userID].'">'.$frienddynamicdata[actionObject].'</a>成为了好友！';
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
												<img width="60" height="60" src="'.$userdata[photo].'" />
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
						$msg='<a href="home.php?mode=he&userID='.$userdata[userID].'">'.$userdata[realName].'</a>分享了一篇'.$typename.'<a href="diary_show.php?diaryID='.$diarydata[diaryID].'">'.$frienddynamicdata[actionObject].'</a>,快去看看吧！';
						break;
				case 3:
						//不提供
						$typename="文章";
						break;
				case 4:
						$typename="照片";
						$condition="and imageName=$frienddynamicdata[actionObject]";
						$diarydata=$imagedb->getImageIDForUserAndCondition($friendID,$condition);
						$msg='<a href="home.php?mode=he&userID='.$userdata[userID].'">'.$userdata[realName].'</a>分享了一张'.$typename.'<a href="image_view.php?imageID='.$diarydata[diaryID].'">'.$frienddynamicdata[actionObject].'</a>,快去看看吧！';
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
						$msg='<a href="home.php?mode=he&userID='.$fuserdata[userID].'">'.$userdata[realName].'</a>和<a href="home.php?mode=he&userID='.$tuserdata[userID].'">'.$frienddynamicdata[actionObject].'</a>成为了好友！';
						break;
				case 9:
						$typename="添加关注";
						$msg="不提供";
						break;
				case 10:
						$typename="新人报道";
						$userdata=$userdb->getUserInfo($friendID);
						$msg='欢迎<a href="home.php?mode=he&userID='.$userdata[userID].'">'.$userdata[realName].'</a>加入社区！';
						break;
				default :
						$msg ="错误参数";
						break;
		}
			if($msg!="不提供"&&$msg!="错误参数")
			{
				$all_dynamic_list.='<div class="dynamic_div">
											<div class="dynamic_head_div">
												<img width="60" height="60" src="'.$userdata[photo].'" />
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

if($mode!="me")
{
	$lib->setvars("if_show_view_write_div","<!--");
	$lib->setvars("sure_show_view_write_div","-->");
}else
{
	$lib->setvars("if_show_view_write_div"," ");
	$lib->setvars("sure_show_view_write_div"," ");
}

//模板替换
$lib->setvars("flash_background",$flashbackground);
$lib->setvars("front_Cover",$frontcover);
$lib->setvars("user_avatar",$avatar);
$lib->setvars("user_name",$username);
$lib->setvars("user_status",$status);
$lib->setvars("user_birthday","生于".$birthday);
$lib->setvars("user_address","住在".$address);
$lib->setvars("record_content",$mood);
$lib->setvars("user_details_link",$details_link);

$lib->setvars("visit_num",$visitnum);
$lib->setvars("who_friend",$whoFriend);

$lib->setvars("friend_list",$friend_list);
$lib->setvars("visitor_list",$visitor_list);
$lib->setvars("friend_dynamic_list",$friend_dynamic_list);
$lib->setvars("all_dynamic_list",$all_dynamic_list);

$f=array("f1"=>"space");
require_once("module_public_setvars.php");

?>