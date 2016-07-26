<?php
session_start();
header("Content-Type:text/html;   charset=utf-8"); 
require_once("lib/lib_logincheck.php");
require_once("module_header_div.php");
require_once("module_application_div.php");
require_once("lib/libClass.php");
require_once("lib/userClass.php");
require_once("lib/messageClass.php");
$lib=new libClass();
$userdb=new userClass();
$messagedb=new messageClass();
$jqscript;
$script;

//显示收件箱内容
global $inbox_list;
$inboxnum=$messagedb->getInBoxMessageNum($userID);
if($inboxnum==0)
{
	$inbox_list='<h4>你还没有接受过短消息</h4>';
}else
{
	$inboxresult=$messagedb->getInBoxUserMessage($userID);
	while($inboxdata=mysql_fetch_array($inboxresult))
	{
		$userdata=$userdb->getUserInfo($inboxdata[sendUserID]);
		$inbox_list.='<div id="inbox_list">
                        	<div class="message_user">
                            	<a href="home.php?mode=he&userID='.$inboxdata[receiveUserID].'">'.$userdata[realName].'</a>
                            </div>
                            <div class="message_content">
                            	'.$inboxdata[message].'
                            </div>
                            <div class="message_operate">
                            	<a href="writeMessage.php?sendUserID='.$inboxdata[sendUserID].'">回复消息</a>
                            </div>
                        </div>';
	}
}

//显示发件箱内容
global $outbox_list;
$outboxnum=$messagedb->getOutBoxMessageNum($userID);
if($outboxnum==0)
{
	$outbox_list='<h4>你还没有发送过短消息</h4>';
}else
{
	$outboxresult=$messagedb->getOutBoxUserMessage($userID);
	while($outboxdata=mysql_fetch_array($outboxresult))
	{
		$userdata=$userdb->getUserInfo($outboxdata[receiveUserID]);
		$outbox_list.='<div id="outbox_list">
                        	<div class="message_user"">
                            	<a href="home.php?mode=he&userID='.$outboxdata[receiveUserID].'">'.$userdata[realName].'</a>
                            </div>
                            <div class="message_content"">
                            	'.$outboxdata[message].'
                            </div>
                            <div class="message_operate"">
                            	<a href="writeMessage.php?sendUserID='.$outboxdata[sendUserID].'">查看消息</a>
                            </div>
                        </div>';
	}
}
    

//模板替换
$lib->setvars("outbox_content",$outbox_list);
$lib->setvars("inbox_content",$inbox_list);                    

$f=array("f1"=>"message");
require_once("module_public_setvars.php");

?>