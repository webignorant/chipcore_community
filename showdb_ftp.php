<?php
header("Content-Type:text/html;   charset=utf-8"); 
$mode=$_GET['mode'];
$link=mysql_connect("127.0.0.1","cluster","123456") or die("数据库连接失败".mysql_error());
mysql_query("set names utf8");

if(mysql_query("use cluster;",$link))
{
	echo "选择数据库成功"."<br>";
}else
{
	echo "选择数据库失败".mysql_error();
  exit;
}
//

//显示数据表信息
$result = mysql_query("select * from user_custom",$link);
while($value=mysql_fetch_row($result))
{
	echo "表名：$value[0]  数据：$value[1] 数据：$value[2]"."<br>";
}

echo "<hr>";
if($result)
{
	exit;
}

?>