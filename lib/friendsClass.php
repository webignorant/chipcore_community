<?php
require_once("mysqlClass.php");

class friendsClass extends mysqlClass
{
	var $dbtable="friends";
	private $userID;
	private $friendID;
	private $groupID;
	private $friendComment;
	
	private function __get($property_name)
	{
		if(isset($this->$property_name))
		{
			return($this->$property_name);
		}else
		{
			return(NULL);
		}
	}
		
	private function __set($property_name, $value)
	{
		$this->$property_name = $value;
	}
	
	//判断好友信息是否存在
	function checkFriendExitst($friendID)
	{
		$sql="select friendID from ".$this->dbtable." where friendID=$friendID";
		$result=parent::query($sql);
		if(parent::num_rows($result)!=0)
		{
			return true;
		}else
		{
			return false;
		}
	}
	
	//查询所有好友信息
	function getAllFriendInfo($userID)
	{
		$sql="select * from ".$this->dbtable." where userID=$userID";
		return parent::query($sql);
	}
	
	//查询用户所有好友数目
	function getAllFriendNum($userID)
	{
		$sql="select id from ".$this->dbtable." where userID=$userID";
		$result=parent::query($sql);
		return parent::num_rows($result);
	}
	
	//查询某个好友信息
	function getFriendNum($userID,$friendID)
	{
		$sql="select * from ".$this->dbtable." where userID=$userID and friendID=$friendID";
		return parent::get_one($sql);
	}
	
	//插入好友信息
	function setFriendInfo($userID,$friendID)
	{
		$sql="insert into ".$this->dbtable."(userID,friendID) values($userID,$friendID)";
		return parent::query($sql);
	}
	
	//删除好友信息
	function delFriendInfo($friendID)
	{
		$sql="delete from ".$this->dbtable." where friendID=$friendID";
		return parent::query($sql);
	}
	
	//更新好友信息
	function updateFriendInfo($userID,$friendID,$groupID,$friendComment)
	{
		$sql="update ".$this->dbtable." set friendID=$friendID,groupID=$groupID,friendComment=$friendComment where userID=$userID";
		return parent::query($sql);
	}
	
	//设置好友分组
	
	
}

?>