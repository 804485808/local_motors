<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>添加管理员</title>
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
<tbody>
<tr>
	<td width="10">&nbsp;</td>
	<td id="Tab0" class="tab_on"><a href="<?php echo site_url("my_menu/manager/manager_add")?>">添加管理员</a></td><td class="tab_nav">&nbsp;</td>
	<td id="Tab1" class="tab"><a href="<?php echo site_url("my_menu/manager/manager_list")?>">管理员管理</a></td><td class="tab_nav">&nbsp;</td>
</tr>
</tbody></table>
</td>
<td width="110">
	<div>
	<img src="<?php echo base_url("skin/images/spacer.gif")?>" width="40" height="24" title="刷新" onclick="window.location.reload();" style="cursor:pointer;" alt="">
	<img src="<?php echo base_url("skin/images/spacer.gif")?>" width="20" height="24" title="后退" onclick="history.back(-1);" style="cursor:pointer;" alt="">
	<img src="<?php echo base_url("skin/images/spacer.gif")?>" width="20" height="24" title="前进" onclick="history.go(1);" style="cursor:pointer;" alt="">
	<img src="<?php echo base_url("skin/images/spacer.gif")?>" width="20" height="24" title="帮助" onclick="" style="cursor:help;" alt="">
	</div>
</td>
</tr>
</tbody></table>
</div>
<form method="post" action="<?php echo site_url('my_menu/manager/save');?>" onsubmit="return check();">
<div class="tt">添加管理员</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tbody><tr>
<td class="tl"><span class="f_red">*</span> 会员名</td>
<td>
<input type="text" size="20" name="username" id="username" value="">
&nbsp;&nbsp;<a href="<?php echo site_url('member/member/member_add2');?>" class="t" title="如果会员还没有注册，请点这里添加">[注册会员]</a>
<span id="dusername" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 管理员类别</td>
<td>
<div class="b10">&nbsp;</div>
<input type="radio" name="admin" value="1" id="admin_1" onclick="Dh('ro');" checked=""><label for="admin_1"> 超级管理员</label> <span class="f_gray">拥有除创始人特权外的所有权限</span>
<div class="b10">&nbsp;</div>
<input type="radio" name="admin" value="2" id="admin_2" onclick="Ds('ro');"><label for="admin_2"> 普通管理员</label> <span class="f_gray">拥有系统分配的权限</span>
<div class="b10">&nbsp;</div>
<style type="text/css">
#ro {padding:5px 10px 10px 10px;border-top:#FFFFFF 1px solid;}
#ro div {width:25%;float:left;height:30px;}
#ro p {margin:2px;color:#FF6600;}
</style>
<div id="ro" style="display:none;">
<!-- <p>↓快捷选择一个管理角色(非必选)</p> -->
<!-- <div><input type="checkbox" name="roles[]" value="2" id="ro_2"><label for="ro_2"> 会员模块管理员</label></div> -->
<!-- <!-- <div><input type="checkbox" name="roles[16]" value="1" id="ro_16"><label for="ro_16"> 商城模块管理员</label></div> - -> -->
<!-- <div><input type="checkbox" name="roles[]" value="5" id="ro_5"><label for="ro_5"> 供应模块管理员</label></div> -->
<!-- <div><input type="checkbox" name="roles[]" value="6" id="ro_6"><label for="ro_6"> 求购模块管理员</label></div> -->
<!-- <!-- <div><input type="checkbox" name="roles[7]" value="1" id="ro_7"><label for="ro_7"> 行情模块管理员</label></div> - -> -->
<!-- <div><input type="checkbox" name="roles[]" value="4" id="ro_4"><label for="ro_4"> 公司模块管理员</label></div> -->
<!-- <!-- <div><input type="checkbox" name="roles[17]" value="1" id="ro_17"><label for="ro_17"> 团购模块管理员</label></div> - -> -->
<!-- <!-- <div><input type="checkbox" name="roles[8]" value="1" id="ro_8"><label for="ro_8"> 展会模块管理员</label></div> - -> -->
<!-- <!-- <div><input type="checkbox" name="roles[9]" value="1" id="ro_9"><label for="ro_9"> 人才模块管理员</label></div> - -> -- >
<!-- <!-- <div><input type="checkbox" name="roles[13]" value="1" id="ro_13"><label for="ro_13"> 品牌模块管理员</label></div> -- > -->
<!-- <!-- <div><input type="checkbox" name="roles[10]" value="1" id="ro_10"><label for="ro_10"> 知道模块管理员</label></div> - -> -->
<!-- <!-- <div><input type="checkbox" name="roles[11]" value="1" id="ro_11"><label for="ro_11"> 专题模块管理员</label></div> - -> -->
<!-- <!-- <div><input type="checkbox" name="roles[12]" value="1" id="ro_12"><label for="ro_12"> 图库模块管理员</label></div> - -> -->
<!-- <!-- <div><input type="checkbox" name="roles[14]" value="1" id="ro_14"><label for="ro_14"> 视频模块管理员</label></div> - -> -->
<!-- <!-- <div><input type="checkbox" name="roles[15]" value="1" id="ro_15"><label for="ro_15"> 下载模块管理员</label></div> - -> -->
<!-- <!-- <div><input type="checkbox" name="roles[21]" value="1" id="ro_21"><label for="ro_21"> 资讯模块管理员</label></div> - -> -->
<!-- <!-- <div><input type="checkbox" name="roles[22]" value="1" id="ro_22"><label for="ro_22"> 招商模块管理员</label></div> - -> -->
<!-- <!-- <div><input type="checkbox" name="roles[template]" value="1" id="ro_template"><label for="ro_template"> 模板风格管理员</label></div> - -> -->
<!-- <!-- <div><input type="checkbox" name="roles[database]" value="1" id="ro_database"><label for="ro_database"> 数据库管理员</label></div> - -> -->
<!-- <br />
<div><input type="checkbox" onclick="checkall(this.form);" id="ro_all"><label for="ro_all"> 全选/反选</label></div> -->
<p>
<span id="load_area_1">
<select name="aid">
	<option value="0">分站权限</option>
	<?php foreach ($area as $k => $v){?>
	<option value="<?php echo $v['areaid'];?>"><?php echo $v['areaname'];?></option>
	<?php }?>
</select> 
</span>
</p>
</div>
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 角色名称</td>
<td><input type="text" size="20" name="role" id="role"> <span class="f_gray">可以为角色名称，例如编辑、美工、某分站编辑等，也可以为该管理员的备注</span></td>
</tr>
</tbody></table>
<div class="sbt"><input type="submit" name="submit" value="提交" class="btn"></div>
</form>
<script type="text/javascript">
function check() {
	var l;
	var f;
	f = 'username';
	l = Dd(f).value;
	if(l == '') {
		Dmsg('请填写会员名', f);
		return false;
	}
	return true;
}
</script>
<script type="text/javascript">Menuon(0);</script>

</body></html>