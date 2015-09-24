<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>修改分类</title>
<meta name="robots" content="noindex,nofollow">
<script type="text/javascript">window.onerror= function(){return true;}</script>
<link rel="stylesheet" href="<?php echo base_url("skin/css/style.css")?>" type="text/css">
<script type="text/javascript" src="<?php echo base_url("skin/js/lang.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/config.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/jquery.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/common.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/admin.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/ae.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/jquery-1.4.js")?>"></script>
<SCRIPT type="text/javascript">
function load_category(catid){	
		$("#catid").val(catid);
}
</SCRIPT>
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
<td id="Tab0" class="tab"><a href="<?php echo site_url("module/sell/add_cat2")?>">添加分类</a></td><td class="tab_nav">&nbsp;</td>
<td id="Tab1" class="tab_on"><a href="<?php echo site_url("module/sell/cat_list2")?>">管理分类</a></td><td class="tab_nav">&nbsp;</td></tr>
</tbody></table>
</td>
<td width="110"><div>
<img src="<?php echo base_url("skin/images/spacer.gif")?>" title="刷新" onclick="window.location.reload();" style="cursor:pointer;" alt="" height="24" width="40">
<img src="<?php echo base_url("skin/images/spacer.gif")?>" title="后退" onclick="history.back(-1);" style="cursor:pointer;" alt="" height="24" width="20">
<img src="<?php echo base_url("skin/images/spacer.gif")?>" title="前进" onclick="history.go(1);" style="cursor:pointer;" alt="" height="24" width="20">
<img src="<?php echo base_url("skin/images/spacer.gif")?>" title="帮助" onclick="" style="cursor:help;" alt="" height="24" width="20"></div></td>
</tr>
</tbody></table>
</div>
<form method="post" action="<?php echo site_url("archives/save_cat")?>" onsubmit="return check();">
<input name="file" value="category" type="hidden">
<input name="action" value="edit" type="hidden">
<input name="catid" value="<?php echo $cat['catid']?>" type="hidden">
<div class="tt">分类修改</div>
<table class="tb" cellpadding="2" cellspacing="1">
<tr>
<td class="tl"><span class="f_red">*</span> 分类名称</td>
<td><input name="category[catname]" id="catname" size="20" value="<?php echo $cat['catname']?>" type="text">
</td>
    </tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 排序</td>
<td><input name="category[listorder]" type="text" size="2" value="<?php echo $cat['listorder']?>"></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 级别</td>
<td><input name="category[level]" size="2" value="<?php echo $cat['level']?>" type="text"> <img src="<?php echo base_url("skin/images/help.png")?>" title="0 - 不在首页显示 1 - 正常显示 2 - 首页和上级分类并列显示" alt="tips" class="c_p" onclick="Dconfirm(this.title, '', 450);" height="11" width="11"></td>
</tr>
</tbody></table>


<div class="sbt"><input name="submit" value="确 定" class="btn" type="submit">&nbsp;&nbsp;&nbsp;&nbsp;<input name="reset" value="重 置" class="btn" type="reset"></div>
</form>
<script type="text/javascript">
function ckDir() {
	if(Dd('catdir').value == '') {
		Dtip('请填写分类目录');
		Dd('catdir').focus();
		return false;
	}
	var url = '?file=category&action=ckdir&mid=5&catdir='+Dd('catdir').value;
	Diframe(url, 0, 0, 1);
}
function check() {
	if(Dd('catname').value == '') {
		Dmsg('请填写分类名称', 'catname');
		return false;
	}
	if(Dd('catdir').value == '') {
		Dmsg('请填写分类目录', 'catdir');
		return false;
	}
	return true;
}
</script>

<script type="text/javascript">Menuon(1);</script>

</body></html>