<?php
ob_start(); 
session_start();
header("Content-Type:text/html;   charset=utf-8"); 
require_once("lib/lib_logincheck.php");
//导航层公共网页
require_once "lib/libClass.php";
$lib=new libClass();

//查询登录用户信息
$userID = $_SESSION['userID'];

//显示导航层层
$url="'index.php'";
$speText="''";
$header_div='	
	<div class="dingwei">
        <div id="navigation">
            <div id="nav_logo_div" onclick="javascript:window.location.href='.$url.'">

            </div>
            <div id="nav_main_div">
				<div id="nav_left_div">
                	<ul id="nav_list">
                    	<li><b><a href="index.php">首页</a></b></li>
                        <li><b><a href="space.php?mode=me">个人主页</a></b></li>
                        <li><b><a href="friend.php">好友</a></b></li>
                        <li><b><a href="message.php">消息</a></b></li>
                    </ul>
				</div>
				
            	<div id="nav_right_div">
                <form action="search.php" method="post">
                	<select name="searchtype" class="search_selete">
                	  <option value="friendname" selected="selected">好友名</option>
                	</select>
               	  	<input name="searchcontent" class="search_textInput" type="text" value="请输入用户姓名" onblur="if(this.value.replace(/ /ig,'.$speText.')=='.$speText.')this.value=this.defaultValue" onfocus="if(this.value!='.$speText.'){this.value='.$speText.';}"/>
                  	<input name="提交" class="search_btn" type="submit" value=""/>
                  </form>
                </div>
            </div>
        </div>
    </div>';
            
//模板替换


?>