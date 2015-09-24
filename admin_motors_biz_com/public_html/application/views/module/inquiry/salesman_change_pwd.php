<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<title>修改密码</title>
<meta name="robots" content="noindex,nofollow">
<script type="text/javascript">window.onerror= function(){return true;}</script>
<link rel="stylesheet" href="<?php echo base_url("skin/css/style.css")?>" type="text/css">
<script type="text/javascript" src="<?php echo base_url("skin/js/lang.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/config.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/jquery.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/common.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/admin.js")?>"></script>
</head>
<body>
<div class="menu" onselectstart="return false" id="destoon_menu">
<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody><tr>
<td valign="bottom">
<table cellpadding="0" cellspacing="0">
<tbody><tr>
<td width="10">&nbsp;</td>
<td id="Tab0" class="<?php echo $type=='all' ? 'tab_on' : 'tab';?>"><a href="<?php echo site_url("module/salesman_inquiry/inquiry_list")?>">所有询单</a></td><td class="tab_nav">&nbsp;</td>
<td id="Tab2" class="<?php echo $type=='unfinished' ? 'tab_on' : 'tab';?>"><a href="<?php echo site_url("module/salesman_inquiry/unfinished_list")?>">未联系的询单</a></td><td class="tab_nav">&nbsp;</td>
<td id="Tab3" class="<?php echo $type=='finished1' ? 'tab_on' : 'tab';?>"><a href="<?php echo site_url("module/salesman_inquiry/finished_list1")?>">已联系(有意向)的询单</a></td><td class="tab_nav">&nbsp;</td>
<td id="Tab4" class="<?php echo $type=='finished2' ? 'tab_on' : 'tab';?>"><a href="<?php echo site_url("module/salesman_inquiry/finished_list2")?>">已联系(无意向)的询单</a></td><td class="tab_nav">&nbsp;</td>
<td id="Tab5" class="<?php echo $type=='finished3' ? 'tab_on' : 'tab';?>"><a href="<?php echo site_url("module/salesman_inquiry/finished_list3")?>">已联系(意向不明)的询单</a></td><td class="tab_nav">&nbsp;</td>
<td id="Tab6" class="<?php echo $type=='rejected' ? 'tab_on' : 'tab';?>"><a href="<?php echo site_url("module/salesman_inquiry/rejected_list")?>">联系被拒的询单</a></td><td class="tab_nav">&nbsp;</td>
<td id="Tab7" class="<?php echo $type=='changepwd' ? 'tab_on' : 'tab';?>"><a href="<?php echo site_url("module/salesman_inquiry/change_pwd")?>">修改密码</a></td><td class="tab_nav">&nbsp;</td>
<td id="Tab8" class="tab"><a href="<?php echo site_url("reg_login/logout")?>" target="_top" onclick="if(!confirm('确实要注销登录吗?')) return false;"">安全退出</a></td><td class="tab_nav">&nbsp;</td>
</tr>
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
<form method="post" action="<?php echo site_url("module/salesman_inquiry/save_pwd")?>" onsubmit="return check();">
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
		//Dmsg('重复新密码与新登录密码不一致', f);
	//	return false;
	}
	f = 'oldpassword';
	l = Dd(f).value.length;
	if(l < 6) {
		Dmsg('现有密码最少6位，当前已输入'+l+'位', f);
		return false;
	}
	return true;
}
</script>
<script type="text/javascript">Menuon(1);</script>

</form></body></html>