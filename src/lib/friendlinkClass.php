<?php
require_once("mysqlClass.php");

class friendlinkClass extends mysqlClass
{
    var $dbtable = "common_friendlink";
    var $friendlink_id;
    var $displayorder;
    var $name;
    var $url;
    var $description;
    var $logo;
    var $ifshow;
    var $type;

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

	//检查友情链接记录是否存在
    function checkfriendlinkExitst($friendlink_id)
    {
        $sql = "select friendlink_id from " . $this->dbtable . " where diaryID=$friendlink_id";
        return parent::query($sql);
    }

	//插入友情链接记录
    function setfriendlinkInfo($displayorder, $name, $url, $description, $logo, $ifshow, $type)
    {
        $sql = "insert into " . $this->dbtable . "(displayorder,name,url,description,logo,ifshow,type) values($displayorder,'$name','$url','$description','$logo',$ifshow,$type)";
        return parent::query($sql);
    }

	//删除友情链接记录
    function delfriendlinkInfo($friendlink_id)
    {
        $sql = "delete from " . $this->dbtable . " where diaryID=$friendlink_id";
        return parent::query($sql);
    }

	//修改友情链接记录
    function updfriendlinkInfo($displayorder, $name, $url, $description, $logo, $ifshow, $type)
    {
        $sql = "update from " . $this->dbtable . " set displayorder=$displayorder,name='$name',url='$url',description='$description',logo='$logo',ifshow=$ifshow,type=$type";
        return parent::query($sql);
    }

	//直接查询所有友情链接记录
    function getAllFriendLinkInfo()
    {
        $sql = "select * from " . $this->dbtable . " where ifshow=1 order by displayorder";
        return parent::query($sql);
    }

	//查询显示所有友情链接数目
    function getFriendLinkMaxNum()
    {
        $sql = "select friendlink_id from " . $this->dbtable . " where ifshow=1";
        $result = parent::query($sql);
        return parent::num_rows($result);
    }

}
