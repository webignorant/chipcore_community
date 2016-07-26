<?php
//显示照片
session_start();
header("Content-Type:text/html;   charset=utf-8"); 
require_once("lib/lib_logincheck.php");
require_once("module_header_div.php");
require_once("module_application_div.php");
require_once "lib/libClass.php";
require_once("lib/friendsClass.php");
require_once("lib/userClass.php");
require_once("lib/imageClass.php");
$lib=new libClass();
$friendsdb=new friendsClass();
$userdb=new userClass();
$imagedb=new imageClass();
$jqscript;
$script;

//生成我的照片列表代码
global $my_image_list;
$myimagenum=$imagedb->getAllImageNum($userID);
if($myimagenum==0)
{
	$my_image_list = '<h4>你还没有图片，快<a href="image_upload.php">上传图片</a>吧！</h4>';
}else
{
	$imageresult=$imagedb->getAllImageInfo($userID);
	while($imagedata=mysql_fetch_array($imageresult))
	{
		$my_image_list .='<div class="show_image_info">
                            	<div class="show_image_preview"><a href="image_view.php?imageID='.$imagedata[imageID].'"><img width="250" height="188" src="'.$imagedata[imagePath].'" /></a></div>
                                <div class="show_image_title"><a href="image_view.php?imageID='.$imagedata[imageID].'">'.$imagedata[imageName].'</a></div>
                            </div>
                        ';
	}
}

//通过模板替换网页
$lib->setvars("my_image_list",$my_image_list);

$f=array("f1"=>"pictrue");
require_once("module_public_setvars.php");

?>