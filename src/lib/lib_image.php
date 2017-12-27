<?php

//上传头像
function uploadAvatar()
{
    //创建文件夹
    if (!file_exists($dest_folder = "upload/user/" . $userID . "/avatar/")) {
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

/*
if($_POST['upload']=="Send")
{
    global $dest_folder;
    //创建文件夹
    if(!file_exists($dest_folder="picture/"))
    {
        mkdir($dest_folder);
    }
    if(!file_exists($dest_folder="picture/user/"))
    {
        mkdir($dest_folder);
    }
    if(!file_exists($dest_folder="picture/user/image/"))
    {
        mkdir($dest_folder);
    }

    //循环判断文件
    if($_FILES['file']['error'] > 0)
    {
        echo '!problem:';
        switch($_FILES['file']['error'])
        {
            case 1: echo '文件大小超过服务器限制';
            break;
            case 2: echo '文件太大！';
            break;
            case 3: echo '文件只加载了一部分！';
            break;
            case 4: echo '文件加载失败！';
            break;
        }
        exit;
    }
    if($_FILES['file']['size'] > 1000000)
    {
        echo '文件过大！';
        exit;
    }
    if($_FILES['file']['type']!='image/jpeg' && $_FILES['file']['type']!='image/gif')
    {
        echo '文件不是JPG或者GIF图片！';
        exit;
    }

    //上传图片，并且重新命名
    $today = date("YmdHis");
    $filetype = $_FILES['file']['type'];
    if($filetype == 'image/jpeg')
    {
        $type = '.jpg';
    }
    if($filetype == 'image/gif')
    {
        $type = '.gif';
    }
    $dest_folder = $dest_folder . $today . $type; //上传的路径
    if(is_uploaded_file($_FILES['file']['tmp_name']))
    {
        if(!move_uploaded_file($_FILES['file']['tmp_name'], $dest_folder))
        {
            echo '移动文件失败！';
            exit;
        }
    }
    else
    {
        echo 'problem!';
        exit;
    }

    //输出成功信息
    echo '<h1>success!</h1><br>';
    echo '文件大小：' . $_FILES['file']['size'] . '字节' . '<Br>';
    echo '文件路径：' . $dest_folder;
    echo '<hr with="100%" />' . '<p>';

    //读取文件
    $dirr = $dest_folder;
    $dir = opendir($dirr);
    echo $dirr . '--Listing:<ul>';
    while($file = readdir($dir))
    {
        echo "<li>$file</li>";
    }
    echo '</ul>';
    closedir($dir);
}
 */
/*//第二种
<?php
if(empty($_GET[submit]))
{
?>
<form enctype="multipart/form-data" action="<?php $_SERVER['PHP_SELF']?>?submit=1" method="post">
Send this file: <input name="filename" type="file">
<input type="submit" value="确定上传">
</form>
<?php
}else{
$path="uploadfiles/"; //上传路径
//echo $_FILES["filename"]["type"];
if(!file_exists($path))
{
//检查是否有该文件夹，如果没有就创建，并给予最高权限
mkdir("$path", 0700);
}//END IF
//允许上传的文件格式
$tp = array("image/gif","image/pjpeg","image/png");
//检查上传文件是否在允许上传的类型
if(!in_array($_FILES["filename"]["type"],$tp))
{
echo "格式不对";
exit;
}//END IF
if($_FILES["filename"]["name"])
{
$file1=$_FILES["filename"]["name"];
$file2 = $path.time().$file1;
$flag=1;
}//END IF
if($flag) $result=move_uploaded_file($_FILES["filename"]["tmp_name"],$file2);
//特别注意这里传递给move_uploaded_file的第一个参数为上传到服务器上的临时文件
if($result)
{
//echo "上传成功!".$file2;
echo "<script language='javascript'>";
echo "alert(\"上传成功！\");";
echo " location='add_aaa.php?pname=$file2'";
echo "</script>";
}//END IF
}
?>
 */

/*
function upload($file,$path,$type){
$state = array();
$state['error'] = "true";
$alltype = ""; // 所有可以上传的类型，用"/"连接起来
$path = trim($path);
//为$path末尾加上"/"
if(strlen(strrchr($path,‘/‘)) <= 1){
$path .= "/";
}
//为类型加上开头“.”
//将所有类型合成字符串，用"/"连接起来<span id="more-78"></span>
foreach($type as $key=>$typeone){
$type[$key] = $typeone = trim($typeone);
if(strlen(strchr($typeone,".")) != strlen($typeone)){
$type[$key] = ".".$typeone;}
$alltype .= $typeone.‘/‘;
}
$alltype = substr($alltype,0,strlen($alltype)-1); //去掉最后的“/”
if(empty($file['name'])){
$state['error'] = "没有上传{$alltype}类型文件！";
$state['errorid'] = 8;
return $state;
} else {
if (!$file['error']) {
$state['name'] = $file['name'];
$state['type'] = strrchr($state['name'],‘.‘);
if(in_array($state['type'],$type)){
$time = date("U");
$state['upname'] = $time.rand(1000,9999).$state['type']; //文件命名
if(copy($file['tmp_name'],$path.$state['upname'])){
$state['time'] = date("U"); //上传的时间
$state['error'] = false;
return $state;
} else {
switch($file(‘error‘)){
case 1: $state['error'] = $state['name']."上传失败，文件大小超出了服务器的空间大小！";$state['errorid'] = 1;return $state;
case 2: $state['error'] = $state['name']."上传失败，要上传的文件大小超出浏览器限制！";$state['errorid'] = 2;return $state;
case 3: $state['error'] = $state['name']."上传失败，文件仅部分被上传！";$state['errorid'] = 3;return $state;
case 4: $state['error'] = $state['name']."上传失败，没有找到要上传的文件！";$state['errorid'] = 4;return $state;
case 5: $state['error'] = $state['name']."上传失败，服务器临时文件夹丢失！";$state['errorid'] = 5;return $state;
case 6: $state['error'] = $state['name']."上传失败，文件写入到临时文件夹出错！";$state['errorid'] = 6;return $state;
default: $state['error'] = $state['name']."上传失败，位置错误！";$state['errorid'] = 10;return $state;
}
}
} else {
$state['error'] = $state['name']."上传失败！不符合所要上传的文件类型！({$alltype})";
$state['errorid'] = 10;
return $state;
}
}
}
 */

/*
if($_POST['upload']=="上传")
    foreach ($_FILES["pictures"]["error"] as $key => $error)
    {
        if ($error == UPLOAD_ERR_OK)
        {
            $tmp_name = $_FILES["pictures"]["tmp_name"][$key];
            $name    = $_FILES["pictures"]["name"][$key];
            $uploadfile = $dest_folder.$name;
            move_uploaded_file($tmp_name, $uploadfile);
        } else
        {
            $showinfo="图片上传失败！";
        }
    }

    //echo '<script>javascript:alert("上传的不是图片格式");</script>';
    //echo '<script>javascript:window.location.href="imageLoad.php";</script>';
}
*/
