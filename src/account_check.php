<?php
ob_start();
session_start();
header("Content-Type:text/html;   charset=utf-8");
require_once("plugins/artDialog/artDialog.php");   //对话框
require_once("lib/lib_logincheck.php");  //用户非法访问检测
require_once("lib/userClass.php");
require_once("lib/spaceClass.php");
$userdb = new userClass();
$spacedb = new spaceClass();

//数据接收
$userID = $_SESSION['userID'];
$realName = $_SESSION['realName'];
$email = $_SESSION['email'];
//头像信息
$photo = $_POST['file'];
//基本信息
$nickName = $_POST['nickName'];
$realName = $_POST['realName'];
$sex = $_POST['sex'];
$bir_year = $_POST['bir_year'];
$bir_month = $_POST['bir_month'];
$bir_day = $_POST['bir_day'];
$bloodType = $_POST['bloodType'];
$about = $_POST['about'];
$status = $_POST['status'];
$location = $_POST['location'];
$homeCity = $_POST['homeCity'];
$email = $_POST['email'];
$QQ = $_POST['qq'];
$MSN = $_POST['msn'];
//工作信息
$companyName = $_POST['companyName'];
$departmentName = $_POST['departmentName'];
$joinTime = $_POST['joinTime'];
$depatureTime = $_POST['departureTime'];
//教育信息
$schoolType = $_POST['schoolType'];
$schoolName = $_POST['schoolName'];
$grade = $_POST['grade'];
$classes = $_POST['classes'];
$admissionTime = $_POST['admissionTime'];
//密码信息
$newpassword = $_POST['newpassword'];
$checkpassword = $_POST['checkpassword'];

$birthday = $bir_year . "-" . $bir_month . "-" . $bir_day;
//主题信息
$theme = $_POST['theme'];
$space_image = $_POST['space_image'];
$space_flash = $_POST['space_flash'];

//处理模式
if ($_GET['mode'] == "avatar") {
    //创建文件夹
    if (!file_exists($dest_folder = "upload/user/" . $userID . "/avatar/")) {
        mkdir($dest_folder, 0700, true);
    }

    $showinfo;
    //循环判断文件
    if ($_FILES['file']['error'] > 0) {
        $showinfo = '出现如下错误<br>';
        switch ($_FILES['file']['error']) {
            case 1:
                $showinfo .= '文件大小超过服务器限制';
                break;
            case 2:
                $showinfo .= '文件太大！';
                break;
            case 3:
                $showinfo .= '文件只加载了一部分！';
                break;
            case 4:
                $showinfo .= '文件加载失败！';
                break;
        }
        echo bad_showArtDialog("用户头像设置", $showinfo, "account.php?mode=basic", 2000);
        exit;
    }
    if ($_FILES['file']['size'] > 1000000) {
        $showinfo = '文件过大！';
        echo bad_showArtDialog("用户头像设置", $showinfo, "account.php?mode=basic", 2000);
        exit;
    }

    if ($_FILES['file']['type'] != 'image/pjpeg' && $_FILES['file']['type'] != 'image/gif' && $_FILES['file']['type'] != 'image/png' && $_FILES['file']['type'] != 'image/x-png') {
        $showinfo = '只支持JPG、GIF和PNG类型的图片！';
        echo bad_showArtDialog("用户头像设置", $showinfo, "account.php?mode=basic", 2000);
        exit;
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
    $avatar_path = $dest_folder . $today . $type; //上传的路径

    if (is_uploaded_file($_FILES['file']['tmp_name'])) {
        if (!move_uploaded_file($_FILES['file']['tmp_name'], $avatar_path)) {
            $showinfo = '移动文件失败！';
            echo bad_showArtDialog("用户头像设置", $showinfo, "account.php?mode=basic", 2000);
            exit;
        }
    } else {
        $showinfo = 'problem!';
        echo bad_showArtDialog("用户头像设置", $showinfo, "account.php?mode=basic", 2000);
    }

    //存入数据库
    $result = $userdb->updUserAvatarInfo($userID, $avatar_path);
    if ($result) {
        $showinfo = "<h3>上传头像成功</h3>" . "<br>";
        echo good_showArtDialog("用户头像设置", $showinfo, "account.php?mode=basic", 2000);
    } else {
        $showinfo = "上传头像失败" . "<br>";
        echo bad_showArtDialog("用户头像设置", $showinfo, "account.php?mode=basic", 2000);
    }
} else if ($_GET['mode'] == "basic") {
    $result = $userdb->updUserBasicInfo($userID, $nickName, $realName, $sex, $birthday, $bloodType, $about, $status, $location, $homeCity, $email, $QQ, $MSN);
    if ($result) {
        echo good_showArtDialog("用户基本信息设置", "用户信息修改成功!", "account.php?mode=basic", 2000);
    } else {
        echo bad_showArtDialog("用户基本信息设置", "用户信息修改失败!", "account.php?mode=basic", 2000);
        exit;
    }
} else if ($_GET['mode'] == "work") {
    $check = $userdb->checkUserWorksExitst($userID);
    if ($check) {
        $result = $userdb->updUserWorkInfo($userID, $companyName, $departmentName, $joinTime, $depatureTime);
    } else {
        $result = $userdb->setUserWorkInfo($userID, $companyName, $departmentName, $joinTime, $depatureTime);
    }
    if ($result) {
        echo good_showArtDialog("用户工作信息设置", "用户工作信息修改成功!", "account.php?mode=work", 2000);
    } else {
        echo bad_showArtDialog("用户工作信息设置", "用户工作信息修改失败!", "account.php?mode=work", 2000);
        exit;
    }
} else if ($_GET['mode'] == "school") {
    $check = $userdb->checkUserSchoolExitst($userID);
    if ($check) {
        $result = $userdb->updUserSchoolInfo($userID, $schoolType, $schoolName, $grade, $classes, $admissionTime);
    } else {
        $result = $userdb->setUserSchoolInfo($userID, $schoolType, $schoolName, $grade, $classes, $admissionTime);
    }
    if ($result) {
        echo good_showArtDialog("用户学校信息设置", "用户学校信息修改成功!", "account.php?mode=school", 2000);
    } else {
        echo bad_showArtDialog("用户学校信息设置", "用户学校信息修改失败!", "account.php?mode=school", 2000);
        exit;
    }
} else if ($_GET['mode'] == "password") {
    if ($newpassword != $checkpassword) {
        echo good_showArtDialog("用户密码信息设置", "新密码和验证密码不相同!", "account.php?mode=password", 2000);
        exit;
    }
    $check = $userdb->getUserPassword($userID);
    $newpassword = md5($newpassword);
    if ($check[password] == $newpassword) {
        $result = $userdb->updUserPasswordInfo($userID, $newpassword);
        if ($result) {
            echo good_showArtDialog("用户密码信息设置", "用户密码修改成功!", "account.php?mode=password", 2000);
        } else {
            echo bad_showArtDialog("用户密码信息设置", "用户密码修改失败!", "account.php?mode=password", 2000);
            exit;
        }
    } else {
        echo bad_showArtDialog("用户密码信息设置", "用户当前密码错误!", "account.php?mode=password", 2000);
        exit;
    }
} else if ($_GET['mode'] == "setting") {
    if (($space_image == " ") && ($space_flash == " ")) {
        echo bad_showArtDialog("用户网站设置", "没有可靠的传值!", "account.php?mode=setting", 2000);
        exit;
    }

    $spaceID = $_SESSION['userID'];
    $frontcover = "public/image/front_cover/" . $space_image;
    $flashbg = "public/flash/space/" . $space_flash . ".swf";
    if ($theme == "Default") {
        $theme = "public/theme/Default.css";
    } else {
        $theme = "public/theme/" . $theme . ".css";
    }

    $theme_result = $userdb->updUserCustomTheme($userID, $theme);
    if ($theme_result) {
        echo good_showArtDialog("用户网站设置", "修改网站主题成功!", "account.php?mode=setting", 2000);
    } else {
        echo bad_showArtDialog("用户网站设置", "修改网站主题失败!", "account.php?mode=setting", 2000);
        exit;
    }

    $image_result = $spacedb->updateSpaceFrontCover($spaceID, $frontcover);
    if ($image_result) {
        echo good_showArtDialog("用户网站设置", "修改空间封面成功!", "account.php?mode=setting", 2000);
    } else {
        echo bad_showArtDialog("用户网站设置", "修改空间封面失败!", "account.php?mode=setting", 2000);
        exit;
    }
    $flash_result = $spacedb->updateSpaceFlashbg($spaceID, $flashbg);
    if ($flash_result) {
        echo bad_showArtDialog("用户网站设置", "修改空间背景成功!", "account.php?mode=setting", 2000);
    } else {
        echo bad_showArtDialog("用户网站设置", "修改空间背景失败!", "account.php?mode=setting", 2000);
        exit;
    }
}
