<?php

class libClass
{
	var $temp_db;
 
	var $files=array();            //模板文件名
	var $file_ext=".html";         //模板文件后辍
	var $file_dir="temps";         //模板文件目录
 
	var $unknown="remove";         //若没有找到替换的变量的处理方法
                                  //del 删除变量   undo 保持不变  comment 替换为注释
																	
	var $halt_on_error="yes";       //在发生错误时停止程序
 
	var $error="";                 //最后一个错误内容
 
	var $vars=array();              //存放元素索引
	var $vals=array();              //存放元素值
	var $pagecontent;
	
	function libClass($dir="",$ext="")
	{
		if($dir)
			$this->file_dir=$dir;
		if($ext)
			$this->file_ext=$ext;
	}


 
//================输出错误
 
 function wrong($mes)
 {
  $this->error=$mes;
	echo "<font color=\"#FF0000\">".$mes."</font>";
	
	if($this->halt_on_error=="yes")
	 exit();
 }
 
//================输出信息
 function showmes($mes)
 {
  $f=array("f1"=>"header","f2"=>"top_table","f3"=>"message_table","f4"=>"footer");
	$this->setfile($f);
	$this->setvars("message",$mes);
	$this->replace($f);
	$this->p($f);
 }


//================模板处理   模板数据库
 
 function maketemp_db($name)
 {
  $tag_name=str_replace(",","','",$name);
  $query="select * from td_sh_temp where tag_name in('$tag_name')";
	$vars=explode(",",$name);
	$res=$this->query($query);
  for($i=0;$i<sizeof($vars);$i++)
	{
   $x=$this->fetch_arr($res);
	 $this->temp_db[$x['tag_name']]="<!-- ".$x['tag_name']." -->\n".$x['tag_value']."\n<!-- /".$x['tag_name']." -->\n\n";
	}
 }

//******************************************** 
//================模板处理   模板文件

 //-----------------在$vars和$vals中设定变量
    //若有多个变量设置，则设置在$handle数组中 
 function setvars($handle,$value="")
 {
  if(!is_array($handle))
	{
	 if($value=="")
	 {
	  $this->wrong("变量".$handle."的值为空！");
		return false;
	 }
	 $this->vars[$handle]=$handle;
	 $this->vals[$handle]=$value;
	}
	else
	{
	 reset($handle);
	 while(list($k,$v)=each($handle))
	 {
	  $this->vars[$k]=$k;
		$this->vals[$k]=$v;
	 }
	}
 }

 //-----------------设置模板文件名
 function filename($file)
 {
	$filename=$this->file_dir."/".$file.$this->file_ext;
	return $filename;
 }
 
 //-----------------将文件名存放在数组$files中
    //若有多个文件，则设置在$handle数组中 
 function setfile($handle,$file="")
 {
  if(is_array($handle))
	{
	 while(list($k,$v)=each($handle))
	 {
	  $this->files[$k]=$this->filename($v);
	 }
	}
	else
	{
	 if($file=="")
	 {
	  $this->wrong("文件名为空！");
	 }
	 else
	 {
	  $this->files[$handle]=$this->filename($file);
	 }
	}
 }
 
 //------------------读取变量$file中$handle对应的文件，将存放在数组$vars和$vals中
 function loadfile($handle)
 {
  if(!is_array($handle))
	{
	 if($this->vars[$handle]&&$this->vals[$handle])
	  return true;
	 if(!isset($this->files[$handle])) //没有设定$handle对应的文件
	 {
	  $this->wrong("句柄".$handle."没有设置！");
	 }
	 else
	 {
	  $f=@file($this->files[$handle]);  //读入文件
	  $f=@implode("",$f);
	  if(empty($f))
	  {
	   $this->wrong("文件".$this->files[$handle]."为空或者不存在！");
	 	return false;
	  }
	  $this->setvars($handle,$f);
	  return true;
	 }
	}
	else
	{
	 while(list($k,$v)=each($handle))
	 {
	  $this->loadfile($k);
	 }
	}
 }

 //-----------------变量替换1
 function rep($handle)
 {
	 $str=$this->vals[$handle];
	 reset($this->vars);
	 reset($this->vals);
	 while(list($k,$v)=each($this->vars))
	 {
	  $str=str_replace("{*".$this->vars[$k]."*}",$this->vals[$k],$str);
	  $str=str_replace("{**".$this->vars[$k]."**}",$this->vals[$k],$str);		
	 }
	 return $str; 
 }
 
 //-----------------变量替换2
 function replace($handle,$target="")
 {
	$this->loadfile($handle);
	if(!is_array($handle))
	{
	 $str=$this->rep($handle);

   $this->setvars($target,$str);
	}
	else
	{
	 reset($handle);
	 while(list($k,$v)=each($handle))
	 {
	  $str=$this->rep($k);
		$this->setvars($k,$str);
	 }
	}
 }
 
 //-----------------块变量替换
 function block_rep($s_b_name,$handle) //$s_b_name 表示原文件中的Block name ,$handle 表示设置后的替换名称
 {
  $str=$this->rep($s_b_name);
	$repped=$this->vals[$handle];
	$repped.=$str;
	$this->setvars($handle,$repped);
 } 
  
 //-----------------删除无法替换的内容
 function rem($str)
 {
  $str=eregi_replace("\{\*[_a-z]+\*\}","&nbsp;",$str);
  $str=eregi_replace("\{\*\*[_0-9a-z]+\*\*\}","",$str);	
	return $str;
 }
 
 //-----------------获取静态页面到页面变量
 function getHtmlContent($url)
 {
	$pagecontent=file_get_contents($url);
 }
 	
 //-----------------显示模板网页
 function showpage($target)
 {
  if(!is_array($target))
	{
	 echo $this->rem($this->vals[$target]);
	}
	else
	{
	 while(list($k,$v)=each($target))
	 {
	  echo $this->rem($this->vals[$k])."\n";
	 }
	} 
 }
 
 //------------------设置 Block
  function setblock($parent,$block_name,$name)  //将$parent中的名称为$block_name的Block替换成{*$name*}
	{
    if(!$this->loadfile($parent))
		{
      $this->wrong("无法装载".$parent."！");
      return false;
    }

    $str=$this->vals[$parent];
    $reg = "/<!--\s+Begin $block_name\s+-->(.*)<!--\s+End $block_name\s+-->/sm";
    preg_match_all($reg,$str,$m);
    $str=preg_replace($reg,"{*$name*}",$str); //置换Block部分为 {*$name*} 形式
//    $this->setvars($name,$m[1][0]);
		$this->setvars($block_name,$m[1][0]);
    $this->setvars($parent,$str);
  }
  
}