<?php
require_once("mysqlClass.php");
class activityClass extends mysqlClass
{
	//创建新活动
	function setActivity($userID,$time_Cteate,$time_End,$address,$states,$topic,$content,$num_Max,$num_Current=0)
	{
		$sql="insert into activity_info(userID,time_Cteate,time_End,address,states,topic,content,num_Max,num_Current) values($userID,$time_Cteate,$time_End,$address,$states,$topic,$content,$num_Max,$num_Current)";
		return this->query($sql);
	}
	
	//删除活动
	function delActivity($activityID)
	{
		$sql="delete activity_info where activityID=$activityID";
		return this->query($sql);
	}
	
	//修改活动
	function updActivity($userID,$time_End,$address,$states,$topic,$content,$num_Max)
	{
		$sql="update activity_info set time_End=$time_End,address=$address,states=$states,topic=$topic,content=$content,num_Max=$num_Max where userID=$userID";
		return this->query($sql);
	}
	
	//查询活动
	function getActivity($activityID)
	{
		$sql="selete * from activity_info where activityID=$activityID";
		return this->get_all($sql);
	}
	
}
	
?>

