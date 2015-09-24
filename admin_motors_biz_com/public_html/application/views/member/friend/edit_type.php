<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>修改商友类别</title>
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
<td id="Tab1" class="tab"><a href="<?php echo site_url("member/friend/friend_list2")?>">商友列表</a></td><td class="tab_nav">&nbsp;</td>
<td id="Tab0" class="tab_on"><a href="<?php echo site_url("member/friend/type_list2")?>">商友类别列表</a></td><td class="tab_nav">&nbsp;</td></tr>
</tbody></table>
</td>
<td width="110"><div>
<img src="<?php echo base_url("skin/images/spacer.gif")?>" title="刷新" onclick="window.location.reload();" style="cursor:pointer;" alt="" height="24" width="40">
<img src="<?php echo base_url("skin/images/spacer.gif")?>" title="后退" onclick="history.back(-1);" style="cursor:pointer;" alt="" height="24" width="20">
<img src="<?php echo base_url("skin/images/spacer.gif")?>" title="前进" onclick="history.go(1);" style="cursor:pointer;" alt="" height="24" width="20">
<img src="<?php echo base_url("skin/images/spacer.gif")?>" title="帮助" onclick="" style="cursor:help;" alt="" height="24" width="20"></div></td>
</tr>
</tbody></table>
</div><form method="post" action="<?php echo site_url("member/friend/save_type")?>" id="dform" onsubmit="return check();">
<input name="moduleid" value="2" type="hidden">
<input name="file" value="friend_type" type="hidden">
<input name="action" value="edit" type="hidden">
<input name="tid" value="<?php echo $type['tid']?>" type="hidden">
<div class="tt">修改商友类别 </div>
<table class="tb" cellpadding="2" cellspacing="1">
<tbody><tr>
<td class="tl"><span class="f_red">*</span> 类别名称</td>
<td class="tr"><input size="20" name="post[tname]" id="tname" maxlength="100" value="<?php echo $type['tname']?>" type="text"> 
<span id="dtname" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 排序</td>
<td class="tr"><input size="20" name="post[listorder]" id="listorder" value="<?php echo $type['listorder']?>" type="text">
<span id="dlistorder" class="f_red"></span></td></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 会员编号</td>
<td class="tr"><input size="20" readonly name="post[userid]" id="userid" value="<?php echo $type['userid']?>" type="text">
<span id="duserid" class="f_red"></span></td></td>
</tr>

</tbody></table>
<div class="sbt"><input name="submit" value=" 确 定 " class="btn" type="submit">&nbsp;&nbsp;&nbsp;&nbsp;
<input name="reset" value=" 重 置 " class="btn" type="reset"></div>
</form>
<script type="text/javascript">
function check() {
	if(Dd('tname').value == '') {
		Dmsg('请填写类别名称', 'tname');
		return false;
	}
	if(Dd('tname').value.length > 100) {
		Dmsg('类别名称的长度不能大于100个字节', 'tname');
		return false;
	}
	if(Dd('listorder').value == '') {
		Dmsg('请填写排序', 'listorder');
		return false;
	}
	if(Dd('listorder').value == '') {
		Dmsg('请填写排序', 'listorder');
		return false;
	}
	var pattern=/^\d+$/;
	if(!pattern.test(Dd('listorder').value)){
		Dmsg('排序字段只能为数字', 'listorder');
		return false;
	}
	return true;
}
</script>
<script type="text/javascript">Menuon(0);</script>

</body></html>