<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<title>修改密码</title>
<meta name="robots" content="noindex,nofollow">
<script type="text/javascript">window.onerror= function(){return true;}</script><link rel="stylesheet" href="<?php echo base_url("skin/css/style.css")?>" type="text/css">
<script type="text/javascript" src="<?php echo base_url("skin/js/lang.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/config.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/jquery.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/common.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/admin.js")?>"></script>
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
<td id="Tab0" class="tab"><a href="<?php echo site_url("my_menu/main/index2")?>">系统首页</a></td><td class="tab_nav">&nbsp;</td>
<td id="Tab1" class="tab_on"><a href="<?php echo site_url("my_menu/main/change_pwd")?>">修改密码</a></td><td class="tab_nav">&nbsp;</td>
<td id="Tab2" class="tab"><a href="<?php echo site_url("my_menu/tools/info_stats")?>">信息统计</a></td><td class="tab_nav">&nbsp;</td>
<td id="Tab3" class="tab"><a href="<?php echo site_url("my_menu/main/center")?>" target="_blank">商务中心</a></td><td class="tab_nav">&nbsp;</td>
<td id="Tab4" class="tab"><a href="<?php echo $site['sell_domain']?>" target="_blank">网站首页</a></td><td class="tab_nav">&nbsp;</td>
<td id="Tab5" class="tab"><a href="<?php echo site_url("reg_login/logout")?>" target="_top" onclick="return confirm(&#39;确定要退出系统吗?&#39;);">安全退出</a></td><td class="tab_nav">&nbsp;</td></tr>
</tbody></table>
</td>
<td width="110"><div>
<img src="<?php echo base_url("skin/images/spacer.gif")?>" width="40" height="24" title="刷新" onclick="window.location.reload();" style="cursor:pointer;" alt="">
<img src="<?php echo base_url("skin/images/spacer.gif")?>" width="20" height="24" title="后退" onclick="history.back(-1);" style="cursor:pointer;" alt="">
<img src="<?php echo base_url("skin/images/spacer.gif")?>" width="20" height="24" title="前进" onclick="history.go(1);" style="cursor:pointer;" alt="">
<img src="<?php echo base_url("skin/images/spacer.gif")?>" width="20" height="24" title="帮助" onclick="" style="cursor:help;" alt=""></div></td>
</tr>
</tbody></table>
</div><div class="tt">修改密码</div>
<form method="post" action="<?php echo site_url("my_menu/main/save_pwd")?>" onsubmit="return check();">
<input type="hidden" name="action" value="password">
<table cellpadding="2" cellspacing="1" class="tb">
<tbody><tr>
<td class="tl"><span class="f_red">*</span> 新登录密码</td>
<td><input type="password" name="password" size="30" id="password" autocomplete="off"> <span id="dpassword" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 重复新密码</td>
<td><input type="password" name="cpassword" size="30" id="cpassword" autocomplete="off"> <span id="dcpassword" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 现有密码</td>
<td><input type="password" name="oldpassword" size="30" id="oldpassword" autocomplete="off"> <span id="doldpassword" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"> </td>
<td><input type="submit" name="submit" value="修 改" class="btn"></td>
</tr>

</tbody></table>
<script type="text/javascript">
function check() {
	var l;
	var f;
	f = 'password';
	l = Dd(f).value.length;
	if(l < 6) {
		Dmsg('新登录密码最少6位，当前已输入'+l+'位', f);
		return false;
	}
	f = 'cpassword';
	l = Dd(f).value;
	if(l != Dd('password').value) {
		Dmsg('重复新密码与新登录密码不一致', f);
		return false;
	}
	f = 'oldpassword';
	l = Dd(f).value.length;
	if(l < 6) {
		Dmsg('现有密码最少6位，当前已输入'+l+'位', f);
		return false;
	}
	if(Dd('password').value == Dd('oldpassword').value) {
		Dmsg('新密码与旧密码不能相同', f);
		return false;
	}
	return true;
}
</script>
<script type="text/javascript">Menuon(1);</script>

</form></body></html>