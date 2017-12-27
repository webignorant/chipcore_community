<?php
require_once("mysqlClass.php");

class musicspecialClass extends mysqlClass
{
    function __construct()
    {
        //构造函数
        $dbtable = "music_specialinfo";
        $specialID = NULL;
        $specialName = NULL;
        $addTime = NULL;
        $modifyTime = NULL;
        $userID = NULL;
        $specialRemark = NULL;
    }

    function __desstruct()
    {
		//析构函数
    }

	//检查音乐专辑记录是否存在
    function checkMusicSpecialExitst($specialID)
    {
        $sql = "select specialID from " . $this->dbtable . " where specialID=$specialID";
    }

	//插入音乐专辑
    function setMusicSpecailInfo($specialName, $addTime, $modifyTime, $userID, $specialRemark, $callPurview)
    {
        $sql = "insert into(specialName,addTime,modifyTime,userID,specialRemark,callPurview) values('$specialName','$addTime','$modifyTime',$userID,'$specialRemark','$callPurview')";
    }

	//删除音乐专辑
    function delMusicSpecialInfo($specialID)
    {
        $sql = "delete from " . $this->dbtable . " where specialID=$specialID";
    }

	//获取所有音乐专辑信息
    function getMusicSpecialInfo($specialID)
    {
        $sql = "select * from " . $this->dbtable . " where specialID=$specialID";
    }

}

?>
