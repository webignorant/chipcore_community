<?php

//PHP获取中英文混合字符串长度,1中文=1位，2英文=1位，可自行修改
function strLength($str,$charset='utf-8')
{  
	if($charset=='utf-8') $str = iconv('utf-8','gb2312',$str);  
	$num = strlen($str);  
	$cnNum = 0;  
	for($i=0;$i<$num;$i++){  
	if(ord(substr($str,$i+1,1))>127){  
	$cnNum++;  
	$i++;  
	}  
	}  
	$enNum = $num-($cnNum*2);  
	$number = ($enNum/2)+$cnNum;  
	return ceil($number);  
}  

//截取字符串函数-UTF8编码
function msubstrutf($str, $start, $len) {
	$tmpstr = "";
	$strlen = $start + $len;
	for($i = 0; $i < $strlen; $i++){
		if(ord(substr($str, $i, 1)) > 127){
			$tmpstr.=substr($str, $i, 3);
			$i+=2;
		}else
			$tmpstr.= substr($str, $i, 1);
	}
	return $tmpstr;
}

//截取字符串函数-GBK编码
function msubstr($str, $start, $len) {   //ȡ
   $tmpstr = "";
   $strlen = $start + $len;
   if(preg_match('/[/d/s]{2,}/',$str)){$strlen=$strlen-2;}
   for($i = 0; $i < $strlen; $i++) {
       if(ord(substr($str, $i, 1)) > 0xa0) {
           $tmpstr .= substr($str, $i, 2);
           $i++;
       } else
           $tmpstr .= substr($str, $i, 1);
     }
   return $tmpstr;
 }

//截取字符串函数-编码兼容性良好的函数
function cc_msubstr($str, $start=0, $length, $charset="utf-8", $suffix=true)
{
	if(function_exists("mb_substr"))
		return mb_substr($str, $start, $length, $charset);
	elseif(function_exists('iconv_substr')) {
		return iconv_substr($str,$start,$length,$charset);
	}
	$re['utf-8']   = "/[/x01-/x7f]|[/xc2-/xdf][/x80-/xbf]|[/xe0-/xef][/x80-/xbf]{2}|[/xf0-/xff][/x80-/xbf]{3}/";
	$re['gb2312'] = "/[/x01-/x7f]|[/xb0-/xf7][/xa0-/xfe]/";
	$re['gbk']	  = "/[/x01-/x7f]|[/x81-/xfe][/x40-/xfe]/";
	$re['big5']	  = "/[/x01-/x7f]|[/x81-/xfe]([/x40-/x7e]|/xa1-/xfe])/";
	preg_match_all($re[$charset], $str, $match);
	$slice = join("",array_slice($match[0], $start, $length));
	if($suffix) return $slice."…";
	return $slice;
}


?>