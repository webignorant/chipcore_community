<?php
session_start();
header("Content-Type:text/html;   charset=utf-8");
require_once("lib/lib_logincheck.php");
require_once("module_header_div.php");
require_once("module_application_div.php");
require_once("lib/libClass.php");
require_once("lib/musicClass.php");
require_once("lib/dynamicClass.php");
$dynamicdb = new dynamicClass();
$lib = new libClass();
$musicdb = new musicClass();
$jqscript;
$script;

$userID = $_SESSION['userID'];

global $showinfo;//处理信息
global $music_name;
global $music_path;
global $dest_folder;

//音乐上传处理
if ($_POST['upload'] == "上传") {
	//创建文件夹
	/*
	if(!file_exists($dest_folder="upload/"))
	{
		mkdir($dest_folder);
	}
	if(!file_exists($dest_folder="upload/user/"))
	{
		mkdir($dest_folder);
	}
	if(!file_exists($dest_folder="upload/user/".$userID."/"))
	{
		mkdir($dest_folder);
	}
     */
    if (!file_exists($dest_folder = "upload/user/" . $userID . "/music/")) {
        mkdir($dest_folder, 0700, true);
    }

	//循环判断文件
    if ($_FILES['file']['error'] > 0) {
        $showinfo = '!problem:';
        switch ($_FILES['file']['error']) {
            case 1:
                $showinfo .= '文件大小超过服务器限制';
                showinfo($showinfo);
                break;
            case 2:
                $showinfo .= '文件太大！';
                showinfo($showinfo);
                break;
            case 3:
                $showinfo .= '文件只加载了一部分！';
                showinfo($showinfo);
                break;
            case 4:
                $showinfo .= '文件加载失败！';
                showinfo($showinfo);
                break;
        }
        showinfo($showinfo);
    }
    if ($_FILES['file']['size'] > 15000000) {
        $showinfo = '文件过大！';
        showinfo($showinfo);
    }

    if ($_FILES['file']['type'] != 'audio/mpeg' && $_FILES['file']['type'] != 'audio/wav' && $_FILES['file']['type'] != 'audio/x-ms-wma') {
        $showinfo = '只支持MP3、WAV和WMA类型的音乐！';
        showinfo($showinfo);
    }

	//上传音乐，并且重新命名
    $image_name = $_FILES['file']['name'];
    $image_path = $dest_folder . $image_name; //上传的路径

	//上传音乐
    if (is_uploaded_file($_FILES['file']['tmp_name'])) {
        if (!move_uploaded_file($_FILES['file']['tmp_name'], iconv("UTF-8", "gb2312", $image_path))) {
            $showinfo = '移动文件失败！';
            showinfo($showinfo);
        }
    } else {
        $showinfo = 'problem!';
        showinfo($showinfo);
    }

	//存入数据库
    $result = $musicdb->setMusicFile($userID, $image_name, $image_path);
    if ($result) {
        $showinfo = "<h3>上传音乐成功</h3>" . "<br>";
		/*
		$showinfo.= "3秒后跳转...";
		$url="'pictrue.php'";
		$showinfo.= '<script type="text/javascript">javascript:setTimeout("location.href='.$url.'",3000)</script>';
         */
    } else {
        $showinfo = "上传音乐失败" . "<br>";
        $showinfo .= "3秒后跳转...";
        $url = "'image_upload.php'";
        $showinfo .= '<script type="text/javascript">javascript:setTimeout("location.href=' . $url . '",3000)</script>';
    }

}

//模板替换
function showinfo($msg)
{
    echo $msg;
    echo "<hr>";
    $url = "'image_upload.php'";
    echo '<script type="text/javascript">javascript:setTimeout("location.href=' . $url . '",3000)</script>';
    exit;
}

if ($showinfo != "") {
    $lib->setvars("show_info", $showinfo);
}

$f = array("f1" => "music_upload");
require_once("module_public_setvars.php");
