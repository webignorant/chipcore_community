<?php
require_once("mysqlClass.php");
class imageClass extends mysqlClass
{
    var $dbtable = "image_info";
    var $imageID;
    var $imageName;
    var $addTime;
    var $speciaID;
    var $imagePath;
    var $imageRemark;

	//检查图片是否存在
    function checkImageExist($imageID)
    {
        $sql = "select imageID from " . $this->dbtable . " where $imageID";
        $result = parent::query($sql);
        if (parent::fetch_array($result) > 0) {
            return true;
        } else {
            return false;
        }
    }

	//插入所上传图片记录
    function setImageInfo($imageName, $specialID, $imagePath, $imageRemark)
    {
        $sql = "insert into " . $this->dbtable . "(imageName,specialID,imagePath,imageRemark) values('$imageName',$specialID,'$imagePath','$imageRemark')";
        return parent::query($sql);
    }

	//插入上传图片
    function setImageFile($userID, $imageName, $imagePath)
    {
        $sql = "insert into " . $this->dbtable . "(userID,imageName,imagePath) values($userID,'$imageName','$imagePath')";
        return parent::query($sql);
    }

	//删除图片记录
    function delImageInfo($imageID)
    {
        $sql = "delete from " . $this->dbtable . " where imageID=$imageID";
        return parent::query($sql);
    }

	//更改图片记录
    function updImageInfo()
    {
		//不提供
    }

	//通过用户ID和指定条件查询图片记录
    function getImageIDForUserAndCondition($userID, $condition)
    {
        $sql = "select * from " . $this->dbtable . " where userID=$userID $condition";
        return parent::get_one($sql);
    }

	//查询图片记录
    function getImageInfo($imageID)
    {
        $sql = "select * from " . $this->dbtable . " where imageID=$imageID";
        return parent::get_one($sql);
    }

	//查询指定用户的所有图片记录的结果集
    function getAllImageInfo($userID)
    {
        $sql = "select * from " . $this->dbtable . " where userID=$userID";
        return parent::query($sql);
    }

	//查询指定用户公开的所有照片记录的数目
    function getAllImageNum($userID)
    {
        $sql = "select * from " . $this->dbtable . " where userID=$userID";
        $result = parent::query($sql);
        return parent::num_rows($result);
    }

}
