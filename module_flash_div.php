<?php
header("Content-Type:text/html;   charset=utf-8"); 
require_once("lib/lib_logincheck.php");
require_once("lib/libClass.php");
$lib=new libClass();

$flashPath;
function setFlashBackground($path)
{
	global $flashPath;
	$flashPath=$path;
	global $flashbackground;
	return $flashbackground='<div id="flash_background "style="position:absolute; left:0; top:0; width:100%; height:100%; z-index:1">
 <div align="center">
     <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
     codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/
    swflash.cab#version=9,0,28,0" width="100%" height="1024">
    <param name="movie" value="'.$flashPath.'" />
    <param name="quality" value="high" />
    <param name="wmode" value="transparent" />
    <embed src="'.$flashPath.'" quality="high" width="100%" height="1024" wmode="transparent"
     pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash"
     type="application/x-shockwave-flash"></embed>
    </object>
 </div>
</div>';
}

?>