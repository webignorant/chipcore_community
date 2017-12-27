<?php
require_once("mysqlClass.php");
class applicationClass extends mysqlClass
{
    var $dbtable = "common_application";
    var $application_id;
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

	//检查应用记录是否存在
    function checkApplicationExitst($application_id)
    {
        $sql = "select application_id from " . $this->dbtable . " where diaryID=$application_id";
        return parent::query($sql);
    }

	//插入应用记录
    function setApplicationInfo($displayorder, $name, $url, $description, $logo, $ifshow, $type)
    {
        $sql = "insert into " . $this->dbtable . "(displayorder,name,url,description,logo,ifshow,type) values($displayorder,'$name','$url','$description','$logo',$ifshow,$type)";
        return parent::query($sql);
    }

	//删除应用记录
    function delApplicationInfo($application_id)
    {
        $sql = "delete from " . $this->dbtable . " where diaryID=$application_id";
        return parent::query($sql);
    }

	//修改应用记录
    function updApplicationInfo($displayorder, $name, $url, $description, $logo, $ifshow, $type)
    {
        $sql = "update from " . $this->dbtable . " set displayorder=$displayorder,name='$name',url='$url',description='$description',logo='$logo',ifshow=$ifshow,type=$type";
        return parent::query($sql);
    }

	//直接查询所有应用记录
    function getAllApplicationInfo()
    {
        $sql = "select * from " . $this->dbtable . " where ifshow=1 order by displayorder";
        return parent::query($sql);
    }

	//查询所有显示应用数目
    function getApplicationMaxNum()
    {
        $sql = "select application_id from " . $this->dbtable . " where ifshow=1";
        $result = parent::query($sql);
        return parent::num_rows($result);
    }

}
