<?php
//显示音乐
session_start();
header("Content-Type:text/html;   charset=utf-8"); 
require_once("lib/lib_logincheck.php");
require_once("module_header_div.php");
require_once("module_application_div.php");
require_once "lib/libClass.php";
require_once("lib/friendsClass.php");
require_once("lib/userClass.php");
require_once("lib/musicClass.php");
$lib=new libClass();
$friendsdb=new friendsClass();
$userdb=new userClass();
$musicdb=new musicClass();
$jqscript;
$script;

//生成我的音乐列表代码
global $my_music_list;
$mymusicnum=$musicdb->getAllmusicNum($userID);
if($mymusicnum==0)
{
	$my_music_list = '<h4>你还没有音乐，快<a href="music_upload.php">上传音乐</a>吧！</h4>';
}else
{
	$musicresult=$musicdb->getAllmusicInfo($userID);
	while($musicdata=mysql_fetch_array($musicresult))
	{
		$my_music_list .='<div class="show_music_info">
                                <div class="show_music_title"><a href="music_view.php?musicID='.$musicdata[musicID].'">'.$musicdata[musicName].'</a></div>
                            </div>
                        ';
	}
}

//通过模板替换网页
$lib->setvars("my_music_list",$my_music_list);

$f=array("f1"=>"music");
require_once("module_public_setvars.php");


?>