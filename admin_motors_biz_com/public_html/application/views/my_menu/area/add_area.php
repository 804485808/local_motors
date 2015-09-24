<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>添加地区</title>
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
<td id="Tab0" class="tab_on"><a href="<?php echo site_url("my_menu/area/add_area")?>">地区添加</a></td><td class="tab_nav">&nbsp;</td>
<td id="Tab1" class="tab"><a href="<?php echo site_url("my_menu/area/area_list")?>">地区管理</a></td><td class="tab_nav">&nbsp;</td></tr>
</tbody></table>
</td>
<td width="110"><div>
<img src="<?php echo base_url("skin/images/spacer.gif")?>" width="40" height="24" title="刷新" onclick="window.location.reload();" style="cursor:pointer;" alt="">
<img src="<?php echo base_url("skin/images/spacer.gif")?>" width="20" height="24" title="后退" onclick="history.back(-1);" style="cursor:pointer;" alt="">
<img src="<?php echo base_url("skin/images/spacer.gif")?>" width="20" height="24" title="前进" onclick="history.go(1);" style="cursor:pointer;" alt="">
<img src="<?php echo base_url("skin/images/spacer.gif")?>" width="20" height="24" title="帮助" onclick="" style="cursor:help;" alt=""></div></td>
</tr>
</tbody></table>
</div><div class="tt">地区添加</div>
<form method="post" action="<?php echo site_url("my_menu/area/save_area")?>" onsubmit="return Dcheck();">
<input name="action" value="add" type="hidden">
<input name="area[parentid]" value="<?php echo $parentid?>" type="hidden">
<table class="tb" cellpadding="2" cellspacing="1">
<tbody>
<?php if (isset($parentname)){?><tr>
<td class="tl"><span class="f_hid">*</span> 上级地区</td>
<td><?php echo $parentname?></td>
</tr><?php }?>
<tr>
<td class="tl"><span class="f_hid">*</span> 地区名称</td>
<td><textarea name="area[areaname]" id="areaname" style="width:200px;height:100px;overflow:visible;"></textarea> 
<img src="<?php echo base_url("skin/images/help.png")?>" title="允许批量添加，一行一个，点回车换行" alt="tips" class="c_p" onclick="Dconfirm(this.title, '', 450);" height="11" width="11"></td>
</tr>
</tbody></table>
<div class="sbt"><input name="submit" value="确 定" class="btn" type="submit">&nbsp;&nbsp;&nbsp;&nbsp;<input name="reset" value="重 置" class="btn" type="reset"></div>
</form>
<script type="text/javascript">
function Dcheck() {
	if(Dd('areaname').value == '') {
		Dtip('请填写地区名称。允许批量添加，一行一个，点回车换行');
		Dd('areaname').focus();
		return false;
	}
	return true;
}
</script>
<script type="text/javascript">Menuon(0);</script>

</body></html>