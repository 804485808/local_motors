<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>风格管理</title>
<meta name="robots" content="noindex,nofollow">
<script type="text/javascript">window.onerror= function(){return true;}</script><link rel="stylesheet" href="<?php echo base_url("skin/css/style.css")?>" type="text/css">
<script type="text/javascript" src="<?php echo base_url("skin/js/lang.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/config.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/jquery.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/common.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/admin.js")?>"></script>
</head>
<body>
<div class="menu">
<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody><tr>
<td valign="bottom">
<table cellpadding="0" cellspacing="0">
<tbody>
<tr>
<td width="10">&nbsp;</td>
<td id="Tab0" class="tab_on"><a href="<?php echo site_url("my_menu/page_style/style_add")?>">添加风格</a></td><td class="tab_nav">&nbsp;</td>
<td id="Tab1" class="tab"><a href="<?php echo site_url("my_menu/page_style/style_setting")?>">风格管理</a></td><td class="tab_nav">&nbsp;</td>
<td id="Tab2" class="tab"><a href="<?php echo site_url("my_menu/page_style/page_setting")?>">模块配置</a></td><td class="tab_nav">&nbsp;</td>
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
</div>
<form method="post" action="<?php echo site_url("my_menu/page_style/style_add");?>" id="dform" onsubmit="return check();">
<div class="tt">添加风格</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tbody>
<tr>
<td class="tl"><span class="f_red">*</span> 风格名称</td>
<td><input name="title" type="text" id="title" size="30"> <span>风格名称为数字、字母、"-"、"_"组合</span><span id="dtitle" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 风格目录</td>
<td><input name="skin" type="text" id="skin" size="30"> <span>请上传预览图至 ./skin/styles/ 名称为数字、字母、"-"、"_"组合</span><span id="dtitle" class="f_red"></span></td>
</tr>
</tbody></table>
<div class="sbt"><input type="submit" name="submit" value=" 确 定 " class="btn">&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value=" 重 置 " class="btn"></div>
</form>
<script type="text/javascript">
function check() {
	var f;
	f = 'title';
	if(Dd(f).value == '') {
		Dmsg('请填写风格名称', f);
		return false;
	}
	f = 'skin';
	if(Dd(f).value == '') {
		Dmsg('请填写风格目录', f);
		return false;
	}
	return true;
}
</script>
<script type="text/javascript">Menuon(0);</script>

</body></html>