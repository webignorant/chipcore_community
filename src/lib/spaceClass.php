<?php
require_once("mysqlClass.php");

class spaceClass extends mysqlClass
{
    var $dbtable = "user_space";
    private $userID;
    private $spaceID;
    private $groupID;
    private $friendComment;

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


    //插入空间记录
    function setSpaceInfo($userID)
    {
        $sql = "insert into " . $this->dbtable . "(userID,spaceID,callPurview) values($userID,$userID,1)";
        return parent::query($sql);
    }

    //删除空间记录
    function delSpaceInfo($spaceID)
    {
        $sql = "delete from " . $this->dbtable . " where spaceID=$spaceID";
        return parent::query($sql);
    }

    //更新空间封面
    function updateSpaceFrontCover($spaceID, $frontcover)
    {
        $sql = "update " . $this->dbtable . " set frontCover='$frontcover' where spaceID=$spaceID";
        return parent::query($sql);
    }

    //更新空间标题
    function updateSpaceTitle($spaceID, $frontcover)
    {
        $sql = "update " . $this->dbtable . " set title='$title' where spaceID=$spaceID";
        return parent::query($sql);
    }

    //更新空间背景风格
    function updateSpaceFlashbg($spaceID, $flashbg)
    {
        $sql = "update " . $this->dbtable . " set flashbg='$flashbg' where spaceID=$spaceID";
        return parent::query($sql);
    }

    //更新空间访问权限
    function updateSpaceCallPurview($spaceID, $callPurview)
    {
        $sql = "update " . $this->dbtable . " set callPurview=$callPurview where spaceID=$spaceID";
        return parent::query($sql);
    }

    //判断空间记录是否存在
    function checkSpaceExitst($spaceID)
    {
        $sql = "select spaceID from " . $this->dbtable . " where spaceID=$spaceID";
        $result = parent::query($sql);
        if (parent::num_rows($result) != 0) {
            return true;
        } else {
            return false;
        }
    }

    //查询所有空间信息
    function getAllSpaceInfo()
    {
        $sql = "select * from " . $this->dbtable;
        return parent::query($sql);
    }

    //查询所有空间数目
    function getAllSpaceNum()
    {
        $sql = "select id from " . $this->dbtable;
        $result = parent::query($sql);
        return parent::num_rows($result);
    }

    //查询指定空间信息
    function getSpaceInfo($spaceID)
    {
        $sql = "select * from " . $this->dbtable . " where spaceID=$spaceID";
        return parent::get_one($sql);
    }

    //根据条件查询指定空间信息
    function getSpaceInfoForCondition($spaceID, $condition)
    {
        $sql = "select * from " . $this->dbtable . " where $condition";
        return parent::get_one($sql);
    }

}
