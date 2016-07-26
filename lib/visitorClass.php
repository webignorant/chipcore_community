<?php
require_once("mysqlClass.php");

class visitorClass extends mysqlClass
{
	var $dbtable="space_visitor";
	private $userID;
	private $visitorID;
	private $spaceID;
	private $count;
	
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
	
	
	//插入访客记录
	function setVisitorInfo($visitorID,$userID,$spaceID)
	{
		$sql="insert into ".$this->dbtable."(visitorID,userID,spaceID,count) values($visitorID,$userID,$spaceID,1)";
		return parent::query($sql);
	}
	
	//删除访客记录
	function delVisitorInfo($visitorID)
	{
		$sql="delete from ".$this->dbtable." where visitorID=$visitorID";
		return parent::query($sql);
	}
	
	//修改访客访问记录+1
	function updVisitorCount($visitorID,$spaceID)
	{
		$data=$this->getVisitorInfo($visitorID,$spaceID);
		$count =($data['count']+1);
		$sql="update ".$this->dbtable." set count=$count where visitorID=$visitorID and spaceID=$spaceID";
		return parent::query($sql);
	}
	
	//判断访客记录是否存在
	function checkVisitorExitst($visitorID)
	{
		$sql="select spaceID from ".$this->dbtable." where visitorID=$visitorID";
		$result=parent::query($sql);
		if(parent::num_rows($result)>0)
		{
			return true;
		}else
		{
			return false;
		}
	}
	
	//判断指定空间是否存在指定访客记录
	function checkVisitorInSpaceExitst($spaceID,$visitorID)
	{
		$sql="select spaceID from ".$this->dbtable." where visitorID=$visitorID and spaceID=$spaceID";
		$result=parent::query($sql);
		if(parent::num_rows($result)>0)
		{
			return true;
		}else
		{
			return false;
		}
	}
	
	//查询指定空间所有访客数目
	function getAllVisitorNum($spaceID)
	{
		$sql="select visitorID from ".$this->dbtable." where spaceID=$spaceID";
		$result=parent::query($sql);
		return parent::num_rows($result);
	}
	
	//空间总共访问次数
	function getAllVisitNum($spaceID)
	{
		$count=0;
		$visitorresult=$this->getAllVisitorData($spaceID);
		while($visitordata=mysql_fetch_array($visitorresult))
		{
			$count+=$visitordata[count];
		}
		return $count;
	}
	
	//查询指定空间的访客结果集
	function getAllVisitorData($spaceID)
	{
		$sql="select * from ".$this->dbtable." where spaceID=$spaceID";
		return parent::query($sql);
	}
	
	//查询指定访客记录结果集
	function getUserVisitorData($visitorID,$spaceID)
	{
		$sql="select * from ".$this->dbtable." where visitorID=$visitorID and spaceID=$spaceID";
		return parent::query($sql);
	}
	
	//查询指定空间指定访客记录信息
	function getVisitorInfo($visitorID,$spaceID)
	{
		$sql="select * from ".$this->dbtable." where visitorID=$visitorID and spaceID=$spaceID";
		return parent::get_one($sql);
	}
	
	//根据条件查询指定访客记录信息
	function getVisitorInfoForCondition($visitorID,$condition)
	{
		$sql="select * from ".$this->dbtable." where $condition";
		return parent::get_one($sql);
	}
	
}

?>