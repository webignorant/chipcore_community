<?php
require_once("mysqlClass.php");
class dynamicClass extends mysqlClass
{
	var $dbtable="user_dynamic";
	var $dynamicID;
	var $userID;
	var $actionType;
	var $actionObejct;
	var $actionTime;
	
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
	
	//新建用户动态
	//用户动作： 1分享心情 2分享日记 3分享文章 4分享照片 5分享音乐 6分享视频 7分享文件 8添加好友 9添加关注 10新人报道
	//动作对象 用户之间存用户名 分享之间存标题
	function setUserDynamic($userID,$actionType,$actionObject)
	{
		$sql="insert into ".$this->dbtable."(userID,actionType,actionObject) values($userID,$actionType,'$actionObject')";
		return parent::query($sql);
	}
	
	//删除用户动态
	function delUserDynamic($dynamicID)
	{
		$sql="delete from ".$this->dbtable." where dynamicID=$dynamicID";
		return parent::query($sql);
	}
	
	//修改用户动态
	function updUserDynamic()
	{
		//不提供
	}
	
	//查询指定用户动态
	function getUserDynamic($userID)
	{
		$sql="select * from ".$this->dbtable." where userID=$userID";
		return parent::get_one($sql);
	}
	
	//查询指定用户动态结果集
	function getUserDataDynamic($userID)
	{
		$sql="select * from ".$this->dbtable." where userID=$userID";
		return parent::query($sql);
	}
	
	//查询指定用户动态数目
	function getUserNumDynamic($userID)
	{
		$sql="select dynamicID from ".$this->dbtable." where userID=$userID";
		$result=parent::query($sql);
		return parent::num_rows($result);
	}
	
	//根据条件查询指定用户动态结果集
	function getUserDataDynamicForCondition($userID,$condition)
	{
		$sql="select * from ".$this->dbtable." where userID=$userID $condition";
		return parent::query($sql);
	}
	
	//根据条件查询所有用户动态结果集
	function getAllUserDataDynamicForCondition($condition)
	{
		$sql="select * from ".$this->dbtable." $condition";
		return parent::query($sql);
	}
	
	
	
}

?>