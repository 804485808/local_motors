<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>系统首页</title>
<meta name="robots" content="noindex,nofollow">
<script type="text/javascript">window.onerror= function(){return true;}</script>
<link rel="stylesheet" href="<?php echo base_url("skin/css/style.css");?>" type="text/css">
<script type="text/javascript" src="<?php echo base_url("skin/js/lang.js");?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/config.js");?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/jquery.js");?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/common.js");?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/admin.js");?>"></script>
</head>
<body> 
<div id="msgbox" onmouseover="closemsg();" style="display:none;"></div>
<div class="menu" onselectstart="return false" id="destoon_menu">
<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody><tr>
<td valign="bottom">
<table cellpadding="0" cellspacing="0">
<tbody><tr>
<td width="10">&nbsp;</td>
<td id="Tab0" class="tab_on"><a href="<?php echo site_url("my_menu/main/index2")?>">系统首页</a></td><td class="tab_nav">&nbsp;</td>
<td id="Tab1" class="tab"><a href="<?php echo site_url("my_menu/main/change_pwd")?>">修改密码</a></td><td class="tab_nav">&nbsp;</td>
<td id="Tab2" class="tab"><a href="<?php echo site_url("my_menu/tools/info_stats")?>">信息统计</a></td><td class="tab_nav">&nbsp;</td>
<td id="Tab3" class="tab"><a href="<?php echo site_url("my_menu/main/center")?>" target="_blank">商务中心</a></td><td class="tab_nav">&nbsp;</td>
<td id="Tab4" class="tab"><a href="<?php echo $site['sell_domain']?>" target="_blank">网站首页</a></td><td class="tab_nav">&nbsp;</td>
<td id="Tab5" class="tab"><a href="<?php echo site_url("reg_login/logout")?>" target="_top" onclick="return confirm(&#39;确定要退出系统吗?&#39;);">安全退出</a></td><td class="tab_nav">&nbsp;</td></tr>
</tbody></table>
</td>
<td width="110"><div>
<img src="<?php echo base_url("skin/images/spacer.gif");?>" width="40" height="24" title="刷新" onclick="window.location.reload();" style="cursor:pointer;" alt="">
<img src="<?php echo base_url("skin/images/spacer.gif");?>" width="20" height="24" title="后退" onclick="history.back(-1);" style="cursor:pointer;" alt="">
<img src="<?php echo base_url("skin/images/spacer.gif");?>" width="20" height="24" title="前进" onclick="history.go(1);" style="cursor:pointer;" alt="">
<img src="<?php echo base_url("skin/images/spacer.gif");?>" width="20" height="24" title="帮助" onclick="Go('');" style="cursor:help;" alt=""></div></td>
</tr>
</tbody></table>
</div>
<form method="post">
<div id="tips_update">
<div class="tt">系统更新提示</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td><div style="padding:20px 30px 20px 20px;" >
<img src="<?php echo base_url("skin/images/tips_update.gif");?>" width="32" height="32" align="absmiddle"/>&nbsp;&nbsp; <a href="http://147.255.205.178/index.php/update_online/index" target="_balnk">在线更新</a>
</div>
</td>
</tr>
</table>
</div>
</form>
<div class="tt"><span class="f_r">IP:<?php echo $my_info['loginip']?>&nbsp;&nbsp;</span>欢迎您，<?php echo $my_info['username']?></div>
<table cellpadding="2" cellspacing="1" class="tb">
<tbody>
<tr>
<td class="tl">管理级别</td>
<td width="30%">&nbsp;超级管理员</td>
<td class="tl">登录次数</td>
<td width="30%">&nbsp;<?php echo $my_info['logintimes']?> 次</td>
</tr>
<tr>
<td class="tl">站内信件</td>
<td>&nbsp;<a href="<?php echo site_url("my_menu/main/center/inbox")?>" target="_blank">收件箱[0]</a></td>
<td class="tl">登录时间</td>
<td>&nbsp;<?php echo date("Y-m-d H:i:s",$my_info['logintime'])?> </td>
</tr>
<tr>
<td class="tl">账户余额</td>
<td>&nbsp;0.00</td>
<td class="tl">会员积分</td>
<td>&nbsp;<?php echo $my_info['credit']?> </td>
</tr>
</tbody></table>
<div class="tt">系统信息</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tbody>
<tr>
<td class="tl">程序信息</td>
<td>&nbsp;<?php strtoupper($site['site_name']);?> B2B Version <?php echo $this_version;?> Release <?php echo $this_release;?> <?php echo $charset;?> <?php echo $language;?> </td>
</tr>
<tr>
<td class="tl">服务器时间</td>
<td>&nbsp;<?php echo date('Y-m-d H:i:s l',time());?></td>
</tr>
<tr>
<td class="tl">服务器信息</td>
<td>&nbsp;<?php echo PHP_OS.'&nbsp;'.$_SERVER["SERVER_SOFTWARE"];?> [<?php echo gethostbyname($_SERVER['SERVER_NAME']);?>:<?php echo $_SERVER["SERVER_PORT"];?>]</td>
</tr>
<tr>
<td class="tl">数据库版本</td>
<td>&nbsp;MySQL 5.0.51b-community-nt</td>
</tr>
<tr>
<td class="tl">站点路径</td>
<td>&nbsp;<?php echo str_replace("\\", '/', dirname(__FILE__));?></td>
</tr>
</tbody></table>
<script type="text/javascript">Menuon(0);</script>

</body></html>