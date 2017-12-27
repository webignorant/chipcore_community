<?php
require_once("mysqlClass.php");

class userClass extends mysqlClass
{
    var $tableuser = "user_info";
    var $tablework = "user_worksinfo";
    var $tableschool = "user_schoolinfo";
    var $tablecustom = "user_custom";
    private $userID;
    private $nickName;
    private $password;
    private $regTime;
    private $lastTimeOnline;
    private $statue;
    private $photo;
    private $priateSet;

    private $realName;
    private $sex;
    private $birthday;
    private $bloodType;
    private $about;
    private $status;
    private $location;
    private $homeCity;
    private $email;
    private $qq;
    private $MSN;

    private $workID;
    private $companyName;
    private $departmentName;
    private $enterTime;
    private $leaveTime;

    private $schoolID;
    private $schoolType;
    private $schoolName;
    private $grade;
    private $classes;
    private $joinTime;
    private $departureTime;

    //parent::__constract($pra1,$pra2);
    /*
    function __construct()
    {
        //构造函数
        parent::__constract($pra1,$pra2);
    }

    function __destruct()
    {
        //析构函数
    }
     */

    public function __get($property_name)
    {
        if (isset($this->$property_name)) {
            return ($this->$property_name);
        } else {
            return (null);
        }
    }

    public function __set($property_name, $value)
    {
        $this->$property_name = $value;
    }

    //插入用户注册信息
    function setUserRegister($email, $password, $realName, $sex, $birthday, $location, $status)
    {
        $sql = "insert into " . $this->tableuser . "(email,password,realName,sex,birthday,location,status) values('$email','$password','$realName','$sex','$birthday','$location',$status)";
        return parent::query($sql);
    }

    //插入用户工作信息
    function setUserWorkInfo($userID, $companyName, $departmentName, $joinTime, $departureTime)
    {
        $sql = "insert into " . $this->tablework . "(userID,companyName,departmentName,joinTime,departureTime) values($userID,'$companyName','$departmentName','$joinTime','$departureTime')";
        return parent::query($sql);
    }

    //插入用户学校信息
    function setUserSchoolInfo($userID, $schoolType, $schoolName, $grade, $classes)
    {
        $sql = "insert " . $this->tableschool . "(userID,schoolType,schoolName,grade,classes) values($userID,'$schoolType','$schoolName','$grade','$classes')";
        return parent::query($sql);
    }

    //通过userID删除用户
    function delUser($userID)
    {
        return parent::delete("" . $this->tableuser . "", "userID=" . $userID);
    }

    //更新用户个人信息
    function updateUserInfo(
        $userID,
        $nickName,
        $password,
        $photo,
        $priateSet,
        $realName,
        $sex,
        $birthday,
        $bloodType,
        $about,
        $status,
        $locaotion,
        $homeCity,
        $email,
        $qq,
        $MSN,
        $companyName,
        $departmentName,
        $enterTime,
        $leaveTime,
        $schoolType,
        $schoolName,
        $grade,
        $classes){
        $value = array(
            "nickName" => $nickName, "password" => $password, "photo" => $photo, "priateSet" => $priateSet,
            "realName" => $realName, "sex" => $sex, "birthday" => $birthday, "bloodType" => $bloodType, "about" => $about, "status" => $status,
            "location" => $locaotion, "homeCity" => $homeCity, "email" => $email, "qq" => $qq, "MSN" => $MSN,
            "companyName" => $companyName, "departmentName" => $departmentName, "enterTime" => $enterTime, "leaveTime" => $leaveTime,
            "schoolType" => $schoolType, "schoolName" => $schoolName, "grade" => $grade, "classes" => $classes, "enterTime" => $enterTime, "leaveTime" => $leaveTime
        );
        return parent::update('".$this->tableuser."', $value, "userID=" . $userID);
    }

    //用户离开时间记录
    function setUserLeaveTimeForEmail($email, $time)
    {
        $value = array("lastTimeOnline" => $time);
        return parent::update($value, "email='$email'");
    }

    //更新用户为登录状态
    function setUserLogin($userID)
    {
        $value = array("statue" => 1);
        return parent::update($this->tableuser, $value, "userID=" . $userID);
    }

    //更新用户为离线状态
    function setUserLogout($userID)
    {
        $value = array("statue" => 0);
        return parent::update($this->tableuser, $value, "userID=" . $userID);
    }

    //更新对用户进行冻结
    function setUserFreeze($userID)
    {
        $value = array("statue" => 4);
        return parent::update($this->tableuser, $value, "userID=" . $userID);
    }

    //更新对用户进行解冻
    function setUserThaw($userID)
    {
        $value = array("statue" => 3);
        return parent::update($this->tableuser, $value, "userID=" . $userID);
    }

    //更新用户头像信息
    function updUserAvatarInfo($userID, $avatar_path)
    {
        $sql = "UPDATE " . $this->tableuser . " SET photo ='$avatar_path' WHERE userID =$userID ";
        return parent::query($sql);
    }

    //更新用户基本信息
    function updUserBasicInfo($userID, $nickName, $realName, $sex, $birthday, $bloodType, $about, $status, $location, $homeCity, $email, $QQ, $MSN)
    {
        $sql = "UPDATE " . $this->tableuser . " SET nickName ='$nickName',realName ='$realName',sex='$sex',birthday ='$birthday',bloodType ='$bloodType',about ='$about',status ='$status',location ='$location',homeCity ='$homeCity',
                email = '$email',QQ = '$QQ',MSN = '$MSN'
                WHERE userID =$userID ";
        return parent::query($sql);
    }

    //更新用户工作信息
    function updUserWorkInfo($userID, $companyName, $departmentName, $joinTime, $depatureTime)
    {
        $sql = "UPDATE " . $this->tablework . " SET nickName = '$nickName',companyName = '$companyName',departmentName='$departmentName',joinTime = '$joinTime',depatureTime = '$depatureTime' WHERE userID =$userID ";
        return parent::query($sql);
    }

    //更新用户学校信息
    function updUserSchoolInfo($userID, $schoolType, $schoolName, $grade, $classes, $admissionTime)
    {
        $sql = "UPDATE " . $this->tableschool . " SET schoolType ='$schoolType',schoolName = '$schoolName',grade='$grade',classes = '$classes',admissionTime = '$admissionTime' WHERE userID =$userID ";
        return parent::query($sql);
    }

    //更新用户密码信息
    function updUserPasswordInfo($userID, $password)
    {
        $sql = "UPDATE " . $this->tableuser . " SET password = '$password' WHERE userID =$userID ";
        return parent::query($sql);
    }

    //检查用户工作信息表是否存在记录
    function checkUserWorksExitst($userID)
    {
        $sql = "select * from " . $this->tablework . " where userID = $userID";
        $result = parent::query($sql);
        return parent::num_rows($result);
    }

    //检查用户学校信息表是否存在记录
    function checkUserSchoolExitst($userID)
    {
        $sql = "select schoolID from " . $this->tableschool . " where userID = $userID";
        $result = parent::query($sql);
        return parent::num_rows($result);
    }

    //检查用户是否存在记录
    function checkUserExitst($email)
    {
        $sql = "select * from " . $this->tableuser . " where email = '$email'";
        $result = parent::query($sql);
        return parent::num_rows($result);
    }

    //检查用户是否在线
    function checkUserLoginStatue($email)
    {
        $sql = "select statue from " . $this->tableuser . " where email='$email'";
        $data = parent::get_one($sql);
        if ($data['statue'] == 1) {
            return true;
        }
    }

    //查询所有用户数目
    function getUserMaxNum()
    {
        $sql = "select userID from " . $this->tableuser;
        $result = parent::query($sql);
        return parent::num_rows($result);
    }

    //查询所有在线用户数目
    function getOnlineUserMaxNum()
    {
        $sql = "select userID from " . $this->tableuser . " where statue=1";
        $result = parent::query($sql);
        return parent::num_rows($result);
    }

    //随机查询N条用户信息,并且不和好友数组重复
    function getRandomUserInfoForArray($friendarray, $n = 6)
    {
        global $arrstr;
        global $i;
        $sql;
        $n;
        foreach ($friendarray as $i => $value) {
            $friendarray[$i];
        }
        $i;
        $friendnum = ($i);
        $max = $this->getUserMaxNum();
        if (($max - $friendnum) < $n) {
            $n = $max - $friendnum;
        }
        if ($n == 0) {
            return false;
        }
        if ($max < $n) {
            $n = $max;
            $sql = "select * from " . $this->tableuser;
        } else {
            for ($r = 1; $r <= $n; $r++) {
                $random;
                $findarray = array();
                $istrue = "true";
                $random = rand(1, $max);
                foreach ($friendarray as $i => $value) {
                    if ($random == $friendarray[$i]) {
                        $istrue = "false";
                        continue;
                    }
                    $findarray[$r] = $random;
                }

                if ($istrue == "true") {

                }

                if ($istrue == "true") {
                    //&&(in_array($random,$findarray)
                    if ($r == $n) {
                        $arrstr = $arrstr . $random;
                    } else {
                        $arrstr = $arrstr . $random . ",";
                    }
                } else {
                    $r--;
                }
            }
            global $sql;
            $sql = "select * from " . $this->tableuser . " where userID in ($arrstr)";
        }
        return parent::query($sql);
    }

    //随机查询N条用户信息
    function getRandomUserInfo($n = 6)
    {
        global $arr;
        global $arrstr;
        if ($n == 0) {
            return "";
        }
        $max = $this->getUserMaxNum();
        if ($max < $n) {
            $n = $max;
            $sql = "select * from " . $this->tableuser;
        } else {
            for ($r = 1; $r <= $n; $r++) {
                $random = rand(1, $max);
                if ($r == $n) {
                    $arrstr = $arrstr . $random;
                } else {
                    $arrstr = $arrstr . $random . ",";
                }
            }
            echo $sql = "select * from " . $this->tableuser . " where userID in ($arrstr)";
        }
        return parent::query($sql);
    }

    //查询用户登录信息
    function checkUserLogin($email, $password)
    {
        $sql = "select * from " . $this->tableuser . " where email='$email' and password='$password'";
        return parent::get_one($sql);
    }

    //查询用户密码信息
    function getUserPassword($userID)
    {
        $sql = "select password from " . $this->tableuser . " where userID=$userID";
        return parent::get_one($sql);
    }

    //通过email获取用户ID
    function getUserID($email)
    {
        $sql = "select userID from " . $this->tableuser . " where email='$email'";
        return parent::get_one($sql);
    }

    //通过userID获取指定用户全部信息
    function getUserInfo($userID)
    {
        $sql = "select * from " . $this->tableuser . " where userID=" . $userID;
        return parent::get_one($sql);
    }

    //通过email获得用户登录所需信息
    function getUserLoginInfoForEmail($email)
    {
        $sql = "select userID,email,password,realName from " . $this->tableuser . " where email='$email'";
        return parent::get_one($sql);
    }

    //通过指定条件查询指定用户全部信息结果集
    function findUserInfoForCondition($condition)
    {
        $sql = "select * from " . $this->tableuser . " where $condition";
        return parent::query($sql);
    }

    //通过指定条件查询指定用户全部信息
    function findUserInfoDataForCondition($condition)
    {
        $sql = "select * from " . $this->tableuser . " where $condition";
        return parent::get_one($sql);
    }

    //通过指定条件查询指定用户全部数目
    function findUserNumForCondition($condition)
    {
        $sql = "select userID from " . $this->tableuser . " where $condition";
        $result = parent::query($sql);
        return parent::num_rows($result);
    }

    //通过用户视图获取所有用户信息
    function getUserViewInfo($userID)
    {
        $sql = "select * from userView where userID=$userID";
        return parent::get_one($sql);
    }

    //查询指定用户基本信息
    function getUserBasicInfo($userID)
    {
        $sql = "select * from " . $this->tableuser . " where userID=" . $userID;
        return parent::get_one($sql);
    }

    //查询指定用户工作信息
    function getUserWorksInfo($userID)
    {
        $sql = "select * from " . $this->tablework . " where userID=" . $userID;
        return parent::get_one($sql);
    }

    //查询指定用户学校信息
    function getUserSchoolInfo($userID)
    {
        $sql = "select * from " . $this->tableschool . " where userID=" . $userID;
        return parent::get_one($sql);
    }

/*网站用户自定义表**********************************/

    //添加用户自定义记录
    function setUserCustom($userID)
    {
        $sql = "insert into " . $this->tablecustom . "(userID) value($userID)";
        return parent::query($sql);
    }

    //删除用户自定义
    function delUserCustom()
    {
        //不提供
    }

    //修改用户自定义
    function updUserCustom($userID)
    {
        //未完成
    }

    //修改用户自定义网页主题
    function updUserCustomTheme($userID, $theme)
    {
        $sql = "update " . $this->tablecustom . " set theme='$theme' where userID=$userID";
        return parent::query($sql);
    }

    //查询用户自定义
    function getUserCustom($userID)
    {
        $sql = "select * from " . $this->tablecustom . " where userID=$userID";
        return parent::get_one($sql);
    }

    //根据条件查询用户自定义结果集
    function getUserCustomForCondition($condition)
    {
        $sql = "select * from " . $this->tablecustom . " where $condition";
        return parent::query($sql);
    }

}
