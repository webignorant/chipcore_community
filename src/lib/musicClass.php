<?php
require_once("mysqlClass.php");
class musicClass extends mysqlClass
{
    var $dbtable = "music_info";
    var $musicID;
    var $musicName;
    var $addTime;
    var $specialID;
    var $musicPath;
    var $musicRemark;

    var $commentID;
    var $userID;
    var $content;

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

	//检查音乐文件是否存在
    function checkMusicFileExitst()
    {

    }

	//检查音乐记录是否存在
    function checkMusicExitst($musicID)
    {
        $sql = "select musicID from " . $this->dbtable . " where musicID=$musicID";
    }

	//插入音乐记录
    function setMusicInfo($musicName, $addTime, $specialID, $musicPath, $musicRemark)
    {
        $sql = "insert into musicView(musicName,addTime,specialID,musicPath,musicRemark) values('$musicName','$addTime',$specialID,'$musicPath','$musicRemark')";
    }

	//插入上传音乐
    function setMusicFile($userID, $musicName, $musicPath)
    {
        $sql = "insert into " . $this->dbtable . "(userID,musicName,musicPath) values($userID,'$musicName','$musicPath')";
        return parent::query($sql);
    }

	//删除音乐记录
    function delMusicInfo($musicID)
    {
        $sql = "delete from " . $this->dbtable . " where musicID=$musicID";
        return parent::query($sql);
    }

	//通过用户ID和指定条件查询音乐记录
    function getMusicIDForUserAndCondition($userID, $condition)
    {
        $sql = "select * from " . $this->dbtable . " where userID=$userID $condition";
        return parent::get_one($sql);
    }

	//查询音乐记录
    function getMusicInfo($MusicID)
    {
        $sql = "select * from " . $this->dbtable . " where MusicID=$MusicID";
        return parent::get_one($sql);
    }

	//查询指定用户的所有音乐记录的结果集
    function getAllMusicInfo($userID)
    {
        $sql = "select * from " . $this->dbtable . " where userID=$userID";
        return parent::query($sql);
    }

	//查询指定用户公开的所有音乐记录的数目
    function getAllMusicNum($userID)
    {
        $sql = "select * from " . $this->dbtable . " where userID=$userID";
        $result = parent::query($sql);
        return parent::num_rows($result);
    }


	//插入音乐评论信息
    function setMusicComment($musicID, $userID, $content)
    {
        $sql = "insert into " . $this->dbtable . "(musicID,userID,content) values($musicID,$userID,'$content')";
    }

	//获取音乐评论信息
    function getMusicComment($commentID)
    {
        $sql = "select * from " . $this->dbtable . " where commentID=$commentID";
    }

	//删除音乐评论信息
    function delMusicComment($commentID)
    {
        $sql = "delete from " . $this->dbtable . " where commentID=$commentID";
    }

}
