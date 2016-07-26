<?php
require_once("mysqlClass.php");
class diaryClass extends mysqlClass
{
	var $dbtable="diary_info";
	var $diaryID;
	var $title;
	var $content;
	var $userID;
	var $addTime;
	var $callPurview;
	var $forwardingNumber;
	var $comments;
	
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
	
	//检查日记记录是否存在
	function checkDiaryExitst($diaryID)
	{
		$sql="select diaryID from ".$this->dbtable." where diaryID=$diaryID";
		return parent::query($sql);
	}
	
	//插入日记记录
	function setDiaryInfo($title,$content,$userID,$callPurview)
	{
		$sql="insert into ".$this->dbtable."(title,content,userID,callPurview) values('$title','$content',$userID,'$callPurview')";
		return parent::query($sql);
	}
	
	//删除日记记录
	function delDiaryInfo($diaryID)
	{
		$sql="delete from ".$this->dbtable." where diaryID=$diaryID";
		return parent::query($sql);
	}
	
	//修改日记记录
	function updDiaryInfo($diaryID,$title,$content,$callpurview)
	{
		$sql="update ".$this->dbtable." set title='$title',content='$content',callpurview=$callpurview where diaryID=$diaryID";
		return parent::query($sql);
	}
	
	//根据权限查询指定日记记录
	function getLegalDiaryInfo($diaryID,$callPurview)
	{
		$sql="select * from ".$this->dbtable."  where diaryID=$diaryID and callPurview=$callPriview";
		return parent::get_one($sql);
	}
	
	//根据权限查询所有日记记录
	function getLegalAllDiaryInfo($diaryID,$callPurview)
	{
		$sql="select * from ".$this->dbtable."  where diaryID=$diaryID and callPurview=$callPriview";
		return parent::get_all($sql);
	}
	
	//查询指定用户的日记数目
	function getUserDiaryNum($userID)
	{
		$sql="select diaryID from ".$this->dbtable." where userID=$userID";
		$result=parent::query($sql);
		return parent::num_rows($result);
	}
	
	//查询指定用户日记记录的结果集
	function getUserDiaryDataInfo($userID)
	{
		$sql="select * from ".$this->dbtable." where userID=$userID";
		return parent::query($sql);
	}
	
	//通过指定条件查询日记记录的结果集
	function getDiaryDataInfoForCondition($condition)
	{
		$sql="select * from ".$this->dbtable."  where $condition";
		return parent::query($sql);
	}
	
	//通过用户ID和指定条件查询日记记录
	function getDiaryIDForUserAndCondition($userID,$condition)
	{
		$sql="select * from ".$this->dbtable." where userID=$userID $condition";
		return parent::get_one($sql);
	}
	
	//查询结果集的数目
	function getDiaryDataNumForCondition($condition)
	{
		$sql="select * from ".$this->dbtable."  where $condition";
		$result=parent::query($sql);
		return parent::num_rows($result);
	}
	
	//查询用户所有日记记录
	function getAllDiaryInfo($userID,$callPurview)
	{
		$sql="select * from ".$this->dbtable."  where userID=$userID and callPurview=$callPriview";
		return parent::get_all($sql);
	}
	
	//查询指定日记记录
	function getDiaryInfo($diaryID)
	{
		$sql="select * from ".$this->dbtable."  where diaryID=$diaryID";
		return parent::get_one($sql);
	}
	
	//插入日记评论
	function setDiaryComment($diaryID,$userID,$content)
	{
		$sql="insert into ".$this->dbtable." (diaryID,userID,content) values($diaryID,$userID,'$content')";
		return parent::query($sql);
	}
	
	//删除日记评论
	function delDiaryComment($diaryID)
	{
		$sql="delete from diary_Comment where diaryID=$diaryID";
		return parent::query($sql);
	}
	
	//更新日记评论
	function updDiaryComment()
	{
		//不提供
	}
	
	//查询日记评论
	function getDiaryComment($diaryID,$observerID)
	{
		$sql="select * from diary_Comment where diaryID=$diaryID and observer=$observerID";
		return parent::get_all($sql);
	}
	
}

?>