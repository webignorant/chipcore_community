<?php

require_once("mysqlClass.php");

class friendgroupClass extends mysqlClass
{
	var $dbtable="friendgroup";
	private $groupID;
	private	$userID;
	private $groupName;
	
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
	
	//检测好友分组是否存在
	function checkFriendGroupExitst($groupID)
	{
		$sql="select groupID from ".$this->dbtable." where groupID=".$groupID;
		$result=parent::query($sql);
		if(parent::num_rows($result)!=0)
		{
			return true;
		}else
		{
			return false;
		}
	}
	
	//获取某个好友分组
	function getFriendGroup($groupID)
	{
		$sql="select * from ".$this->dbtable." where id=$groupID";
		return parent::get_one($sql);
	}
	
	//获取用户的所有好友分组
	function getAllFriendGroup($userID)
	{
		$sql="select * from ".$this->dbtable." where userID=$userID";
		return parent::get_all($sql);
	}
	
	//插入某个用户的好友分组
	function setFriendGroup($userID,$groupID,$groupName)
	{
		$sql="insert into ".$this->dbtable."(userID,groupID,groupName) values($userID,$groupID,'$groupName')";
		return parent::query($sql);
	}
	
	//删除某个用户的好友分组
	function delFriendGroup($groupID)
	{
		$sql="delete from ".$this->dbtable." where groupID=$groupID";
		return parent::query($sql);
	}
	
	//更新某个用户的好友分组信息
	function setFriendGroupName($groupID,$userID,$groupName)
	{
		$sql="update ".$this->dbtable." set groupName=$groupName where groupID=$groupID and groupName=$groupName";
		return parent::query($sql);
	}

}

?>