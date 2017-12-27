<?php
require_once("mysqlClass.php");
class recordClass extends mysqlClass
{
    var $dbtable = "record_info";
    var $moodID;
    var $emotion;
    var $content;
    var $userID;
    var $addTime;

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

	//发表心情记录
    function setRecordInfo($emotion, $content, $userID)
    {
        $sql = "insert into " . $this->dbtable . "(emotion,content,userID) values($emotion,'$content',$userID)";
        return parent::query($sql);
    }

	//删除心情记录
    function delRecordInfo($recordID)
    {
        $sql = "delete from " . $this->dbtable . " where recordID=$recordID";
        return parent::query($sql);
    }

	//修改心情记录
    function updRecordInfo()
    {
		//不提供
    }

	//查询指定用户的所有记录信息
    function getAllRecordInfo($userID)
    {
        $sql = "select * from " . $this->dbtable . " where userID=$userID";
        return parent::get_all($sql);
    }

	//查询指定用户的所有记录信息结果集
    function getAllRecordData($userID)
    {
        $sql = "select * from " . $this->dbtable . " where userID=$userID";
        return parent::query($sql);
    }

	//查询指定用户的所有记录信息数目
    function getUserRecordNum($userID)
    {
        $sql = "select recordID from " . $this->dbtable . " where userID=$userID";
        $result = parent::query($sql);
        return parent::num_rows($result);
    }

	//查询指定用户的某条心情记录
    function getRecordInfo($userID, $recordID)
    {
        $sql = "select * from " . $this->dbtable . " where userID=$userID and recordID=$recordID";
        return parent::get_one($sql);
    }

	//查询指定用户最新的心情记录
    function getNewRecordInfo($userID)
    {
        $sql = "select * from " . $this->dbtable . " where userID=$userID order by addTime desc limit 1";
        return parent::get_one($sql);
    }

}
