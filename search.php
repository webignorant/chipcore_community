<?php
//搜索页面
header("Content-Type:text/html;   charset=utf-8"); 
require_once("module_header_div.php");
require_once("module_application_div.php");
require_once("lib/libClass.php");
require_once("lib/userClass.php");

$lib=new libClass();
$userdb=new userClass();
$jqscript;
$script;

//搜索值接收//生成搜索条件
global $find_condition;
$find_condition="";
if($_POST['searchtype']=="friendname")
{
	$find_condition.="realName='$_POST[searchcontent]' and ";
}
if(($find_username=$_REQUEST['find_username'])!="")
{
	$find_condition.="realName='$find_username' and ";
}
if(($find_email=$_REQUEST['find_email'])!="")
{
	$find_condition.="email='$find_email' and ";
}
$find_condition.="1";
if(($find_userID=$_REQUEST['find_userID'])!=""&&($_REQUEST['find_userID']!="不提供直接输入用户编号"))
{
	$find_condition="userID=$find_userID";
}

//搜索并显示
global $search_list;
$findnum=$userdb->findUserNumForCondition($find_condition);
if($findnum==0)
{
	$search_list = '<h4>没有该用户，请到<a href="friend.php?mode=add">这里</a>重新搜索吧！</h4>';
}else
{
	$findresult=$userdb->findUserInfoForCondition($find_condition);
	while($finddata=mysql_fetch_array($findresult))
	{
		global $search_list;
		if($finddata[userID]==$_SESSION[userID])
		{
			continue;
		}
		$search_list .='<div class="show_friend_div">
		<div class="show_friend_info">
			<img width="50px" height="50px" src="'.$finddata[photo].'" class="search_friend_image"/>
			<div class="search_friend_name">
				<dl>
					<dd><h5>姓名：<a href="home.php?mode=other;userID='.$finddata[userID].'">'.$finddata[realName].'</a></h5></dd>
				</dl>
			</div>
		</div>
		<div class="show_friend_operate_div">
			<dl>
				<dd><a href="friend_add.php?friendID='.$finddata[userID].'">加为好友</a></dd>
			</dl>
		</div>
	 </div>
	 <br /><br />';
	}
	if($search_list==" ")
	{
		$search_list='<h4>人气不旺，叫叫亲朋好友来这里吧！</h4>';
	}
}

//模板替换
$lib->setvars("search_list",$search_list);

$f=array("f1"=>"search");
require_once("module_public_setvars.php");

?>