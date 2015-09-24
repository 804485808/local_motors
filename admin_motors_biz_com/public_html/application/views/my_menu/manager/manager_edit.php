<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>修改管理员</title>
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
<table cellspacing="0" border="0" cellpadding="0" width="100%">
<tbody><tr>
<td valign="bottom">
<table cellspacing="0" cellpadding="0">
<tbody>
<tr>
	<td width="10">&nbsp;</td>
	<td id="Tab0" class="tab"><a href="<?php echo site_url("my_menu/manager/manager_add")?>">添加管理员</a></td><td class="tab_nav">&nbsp;</td>
	<td id="Tab1" class="tab_on"><a href="<?php echo site_url("my_menu/manager/manager_list")?>">管理员管理</a></td><td class="tab_nav">&nbsp;</td>
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
<form method="post" action="<?php echo site_url('my_menu/manager/save/edit');?>">
<div class="tt">修改管理员</div>
<table class="tb" cellspacing="1" cellpadding="2">
<tbody>
<tr>
<input name=username type="hidden" value="<?php echo $user['username'];?>">
<td class="tl"><span class="f_hid">*</span> 会员名</td>
<td><a href="<?php echo site_url("member/member/get_detail/{$user['username']}");?>" class="t"> [<?php echo $user['username'];?>]</a> <span id="dusername" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 管理员类别</td>
<td>
<div class="b10">&nbsp;</div>
<input name="admin" value="1" id="admin_1" type="radio" <?php echo $user['admin'] ==1 ? 'checked' : "";?>><label for="admin_1"> 超级管理员</label> <span class="f_gray">拥有除创始人特权外的所有权限</span>
<div class="b10">&nbsp;</div>
<input name="admin" value="2" id="admin_2"  type="radio" <?php echo $user['admin'] == 2 ? 'checked' : "";?>><label for="admin_2"> 普通管理员</label> <span class="f_gray">拥有系统分配的权限</span>
<div class="b10">&nbsp;</div>
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 分站权限</td>
<td>
<span id="load_area_1">
<select name="aid">
	<option selected="selected" value="0">请选择</option>
	<?php foreach ($area as $k => $v){?>
	<option value="<?php echo $v['areaid'];?>" <?php //if ($aid==$v['areaid']){echo "selected";}?>><?php echo $v['areaname'];?></option>
	<?php }?>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 角色名称</td>
<td><input size="20" name="role" id="role" type="text" value="<?php echo isset($user['role'])?$user['role']:'';?>"> <span class="f_gray">可以为角色名称，例如编辑、美工、某分站编辑等，也可以为该管理员的备注</span></td>
</tr>
</tbody></table>
<div class="sbt"><input name="submit" value="修 改" class="btn" type="submit"></div>
</form>
<script type="text/javascript">Menuon(1);</script>

</body></html>