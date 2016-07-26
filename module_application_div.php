<?php
session_start();
header("Content-Type:text/html;   charset=utf-8"); 
require_once("lib/lib_logincheck.php");
//应用程序层公共网页
require_once("lib/libClass.php");
require_once("lib/applicationClass.php");
require_once("lib/friendlinkClass.php");
require_once("lib/userClass.php");
global $lib;
$lib=new libClass();
global $applicationdb;
$applicationdb = new applicationClass();
global $friendinkdb;
$friendlinkdb = new friendlinkClass();
global $userdb;
$userdb = new userClass();

$mode=$_GET['mode'];

//查询登录用户信息
global $userID;
if($mode=="me")
{
	$userID = $_SESSION['userID'];
	$username = $_SESSION['realName'];
	$usernamelink='<a href="home.php?mode=me&userID='.$userID.'">'.$username.'</a>';
	$userdata=$userdb->getUserInfo($userID);
	$userAvatar=$userdata['photo'];
}else if($mode=="he")
{
	$userID = $_GET['userID'];
	$username = $_SESSION['realName'];
	$usernamelink='<a href="home.php?mode=me&userID='.$userID.'">'.$username.'</a>';
	$userdata=$userdb->getUserInfo($userID);
	$userAvatar=$userdata['photo'];
}else
{
	$userID = $_SESSION['userID'];
	$username = $_SESSION['realName'];
	$usernamelink='<a href="home.php?mode=me&userID='.$userID.'">'.$username.'</a>';
	$userdata=$userdb->getUserInfo($userID);
	$userAvatar=$userdata['photo'];
}


//查询应用信息
global $application_list;
$applicationnum=$applicationdb->getApplicationMaxNum();
if($applicationnum==0)
{
	$application_list='<h4>你还没有添加应用！</h4>';
}else
{
	$applicationresult=$applicationdb->getAllApplicationInfo();
	while($applicationdata=mysql_fetch_array($applicationresult))
	{
		$application_list .='
        	<div class="application_content_div">
            	<span style="float:left;">
                	<img width="32" height="32" src="'.$applicationdata[logo].'" title="'.$applicationdata[name].'"/>      
                </span>
                <span style="float:left; margin-left:5px;">
					<a href="'.$applicationdata[url].'">'.$applicationdata[name].'</a>
				</span>
                <span style="float:right;">
                	<a href=""></a>
                </span>
            </div>
			';
	}
}

//查询友情链接信息
global $friendlink_list;
$friendlinknum=$friendlinkdb->getFriendLinkMaxNum();
if($friendlinknum==0)
{
	$friendlink_list='<h4>暂无友情链接！</h4>';
}else
{
	$friendlinkresult=$friendlinkdb->getAllFriendLinkInfo();
	while($friendlinkdata=mysql_fetch_array($friendlinkresult))
	{
		$friendlink_list .='
            	<div class="friend_link_into">
                	<img width="32" height="32" src="'.$friendlinkdata[logo].'" title="'.$friendlinkdata[name].'" style="float:left;" />
                    <a href='.$friendlinkdata[url].' style="float:left; margin-left:5px;">'.$friendlinkdata[name].'</a>
                </div>  
            ';
	}
}

//显示应用层
global $application_div;
if($mode=="me")
{
	$application_div='
			<div style="width:195px; height:120px;">
            	<div style="width:195px; height:50px;">

                </div>
                <div class="username_div" style=" width:195px; height:70px;">
                	<dl>
                    	<dd><a href="account.php?mode=basic">更换头像</a></dd>
                        <dd><a href="account.php?mode=basic">修改资料</a></dd>
                    </dl>
                </div>
            </div>
            '.$application_list.'
            <hr />
            <div class="friend_link_div">
				<p>友情链接：</p>
				'.$friendlink_list.'
			</div>';
}else if($mode=="he")
{
	$application_div='
			<div style="width:195px; height:120px;">
            	<div style="width:195px; height:50px;">

                </div>
                <div class="username_div" style=" width:195px; height:70px;">
                	<dl>
                        <dd><a href="user_details.php?userID='.$userID.'">查看资料</a></dd>
                    </dl>
                </div>
            </div>
            '.$application_list.'
            <hr />
            <div class="friend_link_div">
				<p>友情链接：</p>
				'.$friendlink_list.'
			</div>';
}else
{
	$application_div='
        	<div class="application_user_div">
            	<div class="application_user_avatar">
                	<a href="account.php"><img class="user_avatar_img" src="'.$userAvatar.'"/></a>
                </div>
                <div class="application_user_about">
                	<dl>
                    	<dd>'.$username.'</dd>
                        <dd><a href="logout.php">注销</a></dd>
                    </dl>
                </div>
            </div>
            '.$application_list.'
            <hr />
            <div class="friend_link_div">
				<p>友情链接：</p>
				'.$friendlink_list.'
			</div>';
}

            
//模板替换


?>