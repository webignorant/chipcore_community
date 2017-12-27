<?php
//播放音乐
session_start();
header("Content-Type:text/html;   charset=utf-8");
require_once("lib/lib_logincheck.php");
require_once("module_header_div.php");
require_once("module_application_div.php");
require_once "lib/libClass.php";
require_once("lib/userClass.php");
require_once("lib/musicClass.php");
require_once("lib/dynamicClass.php");
$dynamicdb = new dynamicClass();
$lib = new libClass();
$userdb = new userClass();
$musicdb = new musicClass();
$jqscript;
$script;

$musicID = $_GET['musicID'];

//播放音乐代码
global $music_view;
$musicdata = $musicdb->getmusicInfo($musicID);
$music_view = '<div class="music_view_title">
                	<h3>正在播放 ' . $musicdata[musicName] . '</h3>
                </div>
                <div class="music_view_operate">
                	<span class="span_button"><a href="music_delete.php?musicID=' . $musicdata[musicID] . '">删除</a></span>
                </div>
                <div class="music_view_content"><EMBED style=”FILTER: gray()” src="' . $musicdata[musicPath] . '" width=798 height=68 type=audio/mpeg autostart=true loop=-1 volume=0 showstatusbar=1></EMBED></div>
                </div>
				';

//通过模板替换网页
$lib->setvars("music_view", $music_view);
$lib->setvars("user_Avatar", $userAvatar);

$f = array("f1" => "music_view");
require_once("module_public_setvars.php");
