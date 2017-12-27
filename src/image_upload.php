<?php
session_start();
header("Content-Type:text/html;   charset=utf-8");
require_once("lib/lib_logincheck.php");
require_once("module_header_div.php");
require_once("module_application_div.php");
require_once("lib/libClass.php");
require_once("lib/imageClass.php");
require_once("lib/dynamicClass.php");
$dynamicdb = new dynamicClass();
$lib = new libClass();
$imagedb = new imageClass();

$userID = $_SESSION['userID'];

global $showinfo;//处理信息
global $image_name;
global $image_path;
global $dest_folder;

//图片上传处理
if ($_POST['upload'] == "上传") {
    //创建文件夹
    /*
    if(!file_exists($dest_folder="upload/"))
    {
        mkdir($dest_folder,0700);
    }
    if(!file_exists($dest_folder="upload/user/"))
    {
        mkdir($dest_folder,0700);
    }
    if(!file_exists($dest_folder="upload/user/".$userID."/"))
    {
        mkdir($dest_folder,0700);
    }
    if(!file_exists($dest_folder="upload/user/".$userID."/image/"))
    {
        mkdir($dest_folder,0700);
    }
    if(!file_exists($dest_folder="upload/user/".$userID."/avatar"))
    {
        mkdir($dest_folder,0700);
    }
     */
    if (!file_exists($dest_folder = "upload/user/" . $userID . "/image/")) {
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
        exit;
    }
    if ($_FILES['file']['size'] > 1000000) {
        $showinfo = '文件过大！';
        showinfo($showinfo);
    }
    echo $_FILES['file']['type'];
    if ($_FILES['file']['type'] != 'image/pjpeg' && $_FILES['file']['type'] != 'image/gif' && $_FILES['file']['type'] != 'image/png' && $_FILES['file']['type'] != 'image/x-png') {
        $showinfo = '只支持JPG、GIF和PNG类型的图片！';
        showinfo($showinfo);
    }

    //上传图片，并且重新命名
    $today = date("YmdHis");
    $filetype = $_FILES['file']['type'];
    if ($filetype == 'image/pjpeg') {
        $type = '.jpg';
    }
    if ($filetype == 'image/gif') {
        $type = '.gif';
    }
    if ($filetype == 'image/png') {
        $type = '.png';
    }
    if ($filetype == 'image/x-png') {
        $type = '.png';
    }
    $image_name = $today . $type;
    $image_path = $dest_folder . $today . $type; //上传的路径

    if (is_uploaded_file($_FILES['file']['tmp_name'])) {
        if (!move_uploaded_file($_FILES['file']['tmp_name'], $image_path)) {
            $showinfo = '移动文件失败！';
            showinfo($showinfo);
        }
    } else {
        $showinfo = 'problem!';
        showinfo($showinfo);
    }

    //存入数据库
    $result = $imagedb->setImageFile($userID, $image_name, $image_path);
    if ($result) {
        $showinfo = "<h3>上传图片成功</h3>" . "<br>";
        /*
        $showinfo.= "3秒后跳转...";
        $url="'pictrue.php'";
        $showinfo.= '<script type="text/javascript">javascript:setTimeout("location.href='.$url.'",3000)</script>';
         */
    } else {
        $showinfo = "上传图片失败" . "<br>";
        /*
        $showinfo .= "3秒后跳转...";
        $url="'image_upload.php'";
        $showinfo .= '<script type="text/javascript">javascript:setTimeout("location.href='.$url.'",3000)</script>';
         */
    }

}

//模板替换
function showinfo($msg)
{
    echo $msg;
    exit;
}

if ($showinfo != "") {
    $lib->setvars("show_info", $showinfo);
}

$f = array("f1" => "image_upload");
require_once("module_public_setvars.php");
