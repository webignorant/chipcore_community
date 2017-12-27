<?php
require_once("mysqlClass.php");

class messageClass extends mysqlClass
{
    var $dbtable = "message_short";
    var $messageID;
    var $sendUserID;
    var $receiveUserID;
    var $sendTime;
    var $message;
    var $isIgnored;
    var $status;

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

	//添加一条信息
    function setMessage($sendUserID, $receiveUserID, $message)
    {
        $sql = "insert into " . $this->dbtable . "(sendUserID,receiveUserID,message) values($sendUserID,$receiveUserID,'$message')";
        return parent::query($sql);
    }

	//删除一条信息
    function delMessage($messageID)
    {
        $sql = "delete from " . $this->dbtable . " where messageID=$messageID";
        return parent::query($sql);
    }

	//修改一条信息状态
    function updMessageStatue($messageID, $statue)
    {
        $sql = "update from " . $this->dbtable . " set statue=$statue where messageID=$messageID";
        return parent::query($sql);
    }

	//修改一条信息内容
    function updMessage($messageID, $message)
    {
        $sql = "update from " . $this->dbtable . " set message=$message where messageID=$messageID";
        return parent::query($sql);
    }

	//查询用户收件箱信息内容
    function getInBoxUserMessage($receiveUserID)
    {
        $sql = "select * from " . $this->dbtable . " where receiveUserID=$receiveUserID";
        return parent::query($sql);
    }

	//查询用户收件箱信息数目
    function getInBoxMessageNum($receiveUserID)
    {
        $sql = "select messageID from " . $this->dbtable . " where receiveUserID=$receiveUserID";
        $result = parent::query($sql);
        return parent::num_rows($result);
    }

	//查询用户发件箱信息内容
    function getOutBoxUserMessage($sendUserID)
    {
        $sql = "select * from " . $this->dbtable . " where sendUserID=$sendUserID";
        return parent::query($sql);
    }

	//查询用户发件箱信息数目
    function getOutBoxMessageNum($sendUserID)
    {
        $sql = "select * from " . $this->dbtable . " where sendUserID=$sendUserID";
        $result = parent::query($sql);
        return parent::num_rows($result);
    }

}
