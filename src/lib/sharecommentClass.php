<?php
require_once("mysqlClass.php");

class sharecommentClass extends mysqlClass
{
    var $table = "share_comment";
    var $commentID;
    var $shareType;
    var $shareUserID;
    var $reviewersID;
    var $shareID;
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

    //插入分享评论
    function setShareComment($shareType, $shareUserID, $reviewersID, $shareID, $content)
    {
        $sql = "insert into " . $this->table . "(shareType,shareUserID,reviewersID,shareID,content) values($shareType,$shareUserID,$reviewersID,$shareID,'$content')";
        return parent::query($sql);
    }

    //删除一条分享评论
    function delShareComment($commentID)
    {
        $sql = "delete from " . $this->table . " where commentID=$commentID";
        return parent::query($sql);
    }

    //修改一条分享评论
    function updShareComment($commentID, $content)
    {
        $sql = "update from " . $this->table . " set content=$content where commentID=$commentID";
        return parent::query($sql);
    }

    //检查指定分享是否存在评论
    function checkShareCommentExists($shareID)
    {
        $sql = "select shareID from " . $this->table . " where shareID=$shareID";
        return parent::query($sql);
    }

    //查询指定用户发表全部评论的结果集
    function getAllUserSendShareCommentData($shareUserID)
    {
        $sql = "select * from " . $this->table . " where shareUserID=$shareUserID";
        return parent::query($sql);
    }

    //查询指定用户全部被别人评论的结果集
    function getAllUserReceiveShareCommentData($reviewersID)
    {
        $sql = "select * from " . $this->table . " where reviewersID=$reviewersID";
        return parent::query($sql);
    }

    //根据指定用户和分享编号查询评论结果集
    function getUserAndTypeShareComment($shareUserID, $shareType, $shareID)
    {
        switch ($shareType) {
            case "moon":
                $shareType = 1;
                break;
            case "diary":
                $shareType = 2;
                break;
            case "aricte":
                $shareType = 3;
                break;
            case "image":
                $shareType = 4;
                break;
            case "music":
                $shareType = 5;
                break;
            case "video":
                $shareType = 6;
                break;
            case "file":
                $shareType = 7;
                break;
        }
        $sql = "select * from " . $this->table . " where shareUserID=$shareUserID and shareType=$shareType and shareID=$shareID";
        $result = parent::query($sql);
        if (parent::num_rows($result) > 0) {
            return parent::query($sql);
        } else {
            return false;
        }
    }

    //根据分享评论编号查询一条评论
    function getShareComment($commentID)
    {
        $sql = "select * from " . $this->table . " where commentID=$commentID";
        return parent::get_one($sql);
    }
}
