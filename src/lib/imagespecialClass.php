<?php
require_once("mysqlClass.php");
class imagespecialClass extends libClass
{
    var $dbtable = "image_Special";
    var $specialID;
    var $specialName;
    var $imagePath;
    var $addTime;
    var $modifyTime;
    var $specialRemark;
    var $callPurview;


    function imagespecialClass()
    {
        //构造函数
        $this->conn_selectdb();
        $this->query("SET NAMES UTF8");
    }

	//检查相册专辑是否存在
    function checkImageSpecialExist($specialID)
    {
        $sql = "select specialID from " . $this->dbtable . " where $specialID";
        $this->query($sql);
        if ($this->fetch_array($result) > 0) {
            return true;
        } else {
            return false;
        }
    }

	//插入相册专辑信息
    function setImageSpecialInfo()
    {
    }
}
