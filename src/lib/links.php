<?
 //get this page url/filename
$url_all = $_SERVER['PHP_SELF'];
$location = strrpos($url_all, "/");
$url = substr($url_all, $location + 1);

 //declare logged?  show defferent function bar
if ($u_name) {
    $links = "<table width=\"480\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\"><tr align=\"center\" valign=\"bottom\">";
    if ($url == "index.php")
        $links .= "<td bgcolor=\"#7BAA00\" width=\"60\">首&nbsp;&nbsp;&nbsp;&nbsp;页</td>";
    else
        $links .= "<td width=\"60\"><a href=\"index.php\">首&nbsp;&nbsp;&nbsp;&nbsp;页</a></td>";

    if ($url == "search.php")
        $links .= "<td bgcolor=\"#7BAA00\" width=\"60\">搜&nbsp;&nbsp;&nbsp;&nbsp;索</td>";
    else
        $links .= "<td width=\"60\"><a href=\"search.php\" title=\"搜索商品信息\">搜&nbsp;&nbsp;&nbsp;&nbsp;索</a></td>";

    if ($url == "newinfo.php")
        $links .= "<td width=\"60\" bgcolor=\"#7BAA00\">发布信息</td>";
    else
        $links .= "<td width=\"60\"><a href=\"newinfo.php\" title=\"发布你的商品信息\">发布信息</a></td>";

    if ($url == "infostate.php")
        $links .= "<td width=\"60\" bgcolor=\"#7BAA00\">信息状态</td>";
    else
        $links .= "<td width=\"60\"><a href=\"infostate.php\" title=\"隐藏/显示你的商品信息\">信息状态</a></td>";

    if ($url == "modify_info.php")
        $links .= "<td width=\"60\" bgcolor=\"#7BAA00\">修改信息</td>";
    else
        $links .= "<td width=\"60\"><a href=\"modify_info.php\" title=\"修改/删除你发布的商品信息\">修改信息</a></td>";

    if ($url == "modify_myinfo.php")
        $links .= "<td width=\"60\" bgcolor=\"#7BAA00\">修改资料</td>";
    else
        $links .= "<td width=\"60\"><a href=\"modify_myinfo.php\" title=\"添加/修改你的个人资料\">修改资料</a></td>";

    if ($url == "modify_psw.php")
        $links .= "<td width=\"60\" bgcolor=\"#7BAA00\">修改密码</td>";
    else
        $links .= "<td width=\"60\"><a href=\"modify_psw.php\" title=\"修改你的登录密码\">修改密码</a></td>";

    $links .= "<td width=\"60\"><a href=\"logout.php\" title=\"退出登录\">退&nbsp;&nbsp;&nbsp;&nbsp;出</a></td>";
    $links .= "</tr></table>";
} else {
    $links = "<table width=\"300\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\"><tr align=\"center\" valign=\"bottom\">";

    if ($url == "index.php")
        $links .= "<td width=\"60\" bgcolor=\"#7BAA00\">首&nbsp;&nbsp;&nbsp;&nbsp;页</td>";
    else
        $links .= "<td width=\"60\"><a href=\"index.php\">首&nbsp;&nbsp;&nbsp;&nbsp;页</a></td>";

    if ($url == "search.php")
        $links .= "<td bgcolor=\"#7BAA00\" width=\"60\">搜&nbsp;&nbsp;&nbsp;&nbsp;索</td>";
    else
        $links .= "<td width=\"60\"><a href=\"search.php\">搜&nbsp;&nbsp;&nbsp;&nbsp;索</a></td>";

    if ($url == "reg.php")
        $links .= "<td bgcolor=\"#7BAA00\" width=\"60\">注&nbsp;&nbsp;&nbsp;&nbsp;册</td>";
    else
        $links .= "<td width=\"60\"><a href=\"reg.php\">注&nbsp;&nbsp;&nbsp;&nbsp;册</a></td>";

    if ($url == "log.php")
        $links .= "<td bgcolor=\"#7BAA00\" width=\"60\">登&nbsp;&nbsp;&nbsp;&nbsp;录</td>";
    else
        $links .= "<td width=\"60\"><a href=\"log.php\">登&nbsp;&nbsp;&nbsp;&nbsp;录</a></td>";

    if ($url == "findpsw.php")
        $links .= "<td bgcolor=\"#7BAA00\" width=\"60\">忘记密码</td>";
    else
        $links .= "<td width=\"60\"><a href=\"findpsw.php\">忘记密码</a></td>";

    $links .= "</tr></table>";
}
$my->setvars("links", $links);
