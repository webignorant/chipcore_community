<?php
ob_start();
session_start();
header("Content-Type:text/html;   charset=utf-8");
require_once("plugins/artDialog/artDialog.php");
require_once("lib/userClass.php");
$userdb = new userClass();

//登录模式
/*
if($_GET['mode']=="guest")
{
	$_SESSION['mode']="guest";
	$_SESSION['userID']=0;
	echo $_SESSION['realName']="游客";
	echo "用户登录成功"."<br>";
	echo "3秒钟后跳转...";
	$url="'home.php'";
	echo '<script type="text/javascript">javascript:setTimeout("location.href='.$url.'",3000)</script>';
	exit;
}
 */

if (($email = $_POST['email']) == "") {
    echo bad_showArtDialog("登录提示", $_SESSION[realName] . "电子邮件不能为空!", "index.php", 2000);
}
if (($password = $_POST['password']) == "") {
    echo bad_showArtDialog("登录提示", $_SESSION[realName] . "密码不能为空!", "index.php", 2000);
}
$checkcookie = $_POST['checkcookie'];

$password = md5($password);

$data = $userdb->getUserLoginInfoForEmail($email);
if ($data != "") {
    if (($email == $data['email']) && (($password == $data['password']) == $password)) {
        $userID = $data['userID'];
        $_SESSION['userID'] = $userID;
        $_SESSION['email'] = $email;
        $_SESSION['realName'] = $data['realName'];
        if ($checkcookie[0] == 1) {
            setcookie("cook_cc_email", $email, time() + 3600 * 24 * 30);
            setcookie("cook_cc_pass", $password, time() + 3600 * 24);
        }
        ob_end_flush();
        $_COOKIE['cook_cc_email'];
        $_COOKIE['cook_cc_pass'];

        if ($userdb->setUserLogin($userID)) {
            echo good_showArtDialog("登录提示", $_SESSION[realName] . "用户登录成功!", "home.php", 2000);
        }

    } else {
        echo bad_showArtDialog("登录提示", $_SESSION[realName] . "用户名或密码错误!", "index.php", 2000);
    }
} else {
    echo bad_showArtDialog("登录提示", $_SESSION[realName] . "不存在该用户!", "index.php", 2000);
}


?>
