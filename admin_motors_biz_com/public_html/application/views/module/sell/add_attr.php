<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php if ($type=='add_attr'){echo '添加属性';}else{echo '修改属性';}?></title>
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
<div id="msgbox" onmouseover="closemsg();" style="display:none;"></div>
<div class="menu" onselectstart="return false" id="destoon_menu">
<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody><tr>
<td valign="bottom">
<table cellpadding="0" cellspacing="0">
<tbody><tr>
<td width="10">&nbsp;</td>
<td id="Tab0" class="tab_on"><a href="<?php echo site_url("module/category/add_attr2/".$catid)?>">添加属性</a></td><td class="tab_nav">&nbsp;</td>
<td id="Tab1" class="tab"><a href="<?php echo site_url("module/category/attr_list2/".$catid)?>">属性参数</a></td><td class="tab_nav">&nbsp;</td></tr>
</tbody></table>
</td>
<td width="110"><div>
<img src="<?php echo base_url("skin/images/spacer.gif")?>" title="刷新" onclick="window.location.reload();" style="cursor:pointer;" alt="" height="24" width="40">
<img src="<?php echo base_url("skin/images/spacer.gif")?>" title="后退" onclick="history.back(-1);" style="cursor:pointer;" alt="" height="24" width="20">
<img src="<?php echo base_url("skin/images/spacer.gif")?>" title="前进" onclick="history.go(1);" style="cursor:pointer;" alt="" height="24" width="20">
<img src="<?php echo base_url("skin/images/spacer.gif")?>" title="帮助" onclick="" style="cursor:help;" alt="" height="24" width="20"></div></td>
</tr>
</tbody></table>
</div><form method="post" action="<?php echo site_url("module/category/save_attr")?>" id="dform" onsubmit="return check();">
<input name="action" value="add" type="hidden">
<input name="catid" value="<?php echo $catid?>" type="hidden">
<input name="post[catid]" value="<?php echo $catid?>" type="hidden">
<input name="oid" value="" type="hidden">
<div class="tt">添加属性</div>
<table class="tb" cellpadding="2" cellspacing="1">
<tbody><tr>
<td class="tl"><span class="f_red">*</span> 属性名称</td>
<td><input name="post[name]" size="30" id="name" maxlength="50" type="text" > <span id="dname" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 添加方式</td>
<td>
<input name="post[type]" value="0" id="t_0" onclick="c(0)" type="radio"><label for="t_0"> 单行文本(text)</label>
<input name="post[type]" value="1" id="t_1" onclick="c(1)" type="radio"><label for="t_1"> 多行文本(textarea)</label>
<input name="post[type]" value="2" id="t_2" onclick="c(2)" checked="checked" type="radio"><label for="t_2"> 列表选择(select)</label>
<input name="post[type]" value="3" id="t_3" onclick="c(3)" type="radio"><label for="t_3"> 复选框(checkbox)</label>
</td>
</tr>
<tr style="display:">
<td class="tl" id="v_l"><span class="f_red">*</span> 备选值</td>
<td><textarea name="post[value]" style="width:98%;height:30px;overflow:visible;" id="value"></textarea><br><span id="dvalue" class="f_red"></span><br/><span id="v_r">多个选项用 | 分隔，例如 红色|绿色(*)|蓝色 (*)表示默认选中</span></td>
</tr>

</tbody></table>
<div class="sbt"><input name="submit" value=" 确 定 " class="btn" type="submit">&nbsp;&nbsp;&nbsp;&nbsp;
<input value=" 关 闭 " class="btn" onclick="window.parent.location.reload();" type="button"></div>
</form>
<script type="text/javascript">
function c(id) {
	if(id == 2 || id == 3) {
		Dd('v_l').innerHTML = '<span class="f_red">*</span> 备选值';
		Dd('v_r').innerHTML = '多个选项用 | 分隔，例如 红色|绿色(*)|蓝色 (*)表示默认选中';
		Ds('s_c');
	} else if(id == 0 || id == 1) {
		Dd('v_l').innerHTML = '<span class="f_hid">*</span> 默认值';
		Dd('v_r').innerHTML = '';
		Dh('s_c');
	}
}
c(2);
function check() {
	var l;
	var f;
	f = 'name';
	l = Dd(f).value.length;
	var m;
	var n;
	n = 'value';
	m = Dd(n).value.length;
	if(l < 1) {
		Dmsg('请填写属性名称', f);
		return false;
	}
	if(l > 50) {
		Dmsg('属性名称长度不得大于50个字节', f);
		return false;
	}
	if(m > 255) {
		Dmsg('属性值长度不得大于255个字节', n);
		return false;
	}
	return true;
}
</script>
<script type="text/javascript">Menuon(0);</script>

</body></html>