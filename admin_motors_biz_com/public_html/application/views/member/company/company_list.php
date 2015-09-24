<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>公司列表</title>
<meta name="robots" content="noindex,nofollow">
<script type="text/javascript">window.onerror= function(){return true;}</script>
<link rel="stylesheet" href="<?php echo base_url("skin/css/style.css");?>" type="text/css">
<script type="text/javascript" src="<?php echo base_url("skin/js/lang.js");?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/config.js");?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/jquery.js");?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/common.js");?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/admin.js");?>"></script>
<script type="text/javascript">
function check_s(){
	var pattern=/^\d+$/; 
	if(Dd("id_input").value && !pattern.test(Dd("id_input").value)){
		alert('会员ID只能为数字');
		Dd("id_input").value='';
		return false;
	}
	if(!pattern.test(Dd("psize").value)){
		alert('每页记录数只能为数字');
		Dd("psize").value=20;
		return false;
	}
	return true;
}
</script>
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
<td id="Tab0" class="tab_on"><a href="<?php echo site_url("member/company/company_list2")?>">公司列表</a></td>
<td class="tab_nav">&nbsp;</td><td id="Tab2" class="tab"><a href="<?php echo site_url('member/vip/vip_list2');?>">VIP管理</a></td>
<td class="tab_nav">&nbsp;</td><td id="Tab3" class="tab"><a href="<?php echo site_url('member/member/member_list2');?>">会员列表</a></td>
<td class="tab_nav">&nbsp;</td></tr>
</tbody></table>
</td>
<td width="110"><div>
<img src="<?php echo base_url("skin/images/spacer.gif");?>" width="40" height="24" title="刷新" onclick="window.location.reload();" style="cursor:pointer;" alt="">
<img src="<?php echo base_url("skin/images/spacer.gif");?>" width="20" height="24" title="后退" onclick="history.back(-1);" style="cursor:pointer;" alt="">
<img src="<?php echo base_url("skin/images/spacer.gif");?>" width="20" height="24" title="前进" onclick="history.go(1);" style="cursor:pointer;" alt="">
<img src="<?php echo base_url("skin/images/spacer.gif");?>" width="20" height="24" title="帮助" onclick="" style="cursor:help;" alt=""></div></td>
</tr>
</tbody></table>
</div>
<form action="<?php echo site_url('member/company/search');?>" method="post" onsubmit="return check_s();">
<input type="hidden" name="action" value="company_list2">
<div class="tt">公司搜索</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tbody><tr>
<td>&nbsp;
<select name="fields">
<option value="0" selected="selected">按条件</option>
<option value="1">公司名</option>
<option value="2">会员名</option>
<option value="3">注册年份</option>
</select>&nbsp;
<input type="text" size="25" name="kw" value="" title="关键词">&nbsp;
<select name="vip">
<option value="0">VIP级别</option>
<option value="1">1 级</option>
<option value="2">2 级</option>
<option value="3">3 级</option>
<option value="4">4 级</option>
<option value="5">5 级</option>
<option value="6">6 级</option>
<option value="7">7 级</option>
<option value="8">8 级</option>
<option value="9">9 级</option>
<option value="10">10 级</option>
</select>&nbsp;
<select name="order">
<option value="0" selected="selected">结果排序方式</option>
<option value="1">VIP指数降序</option>
<option value="2">VIP指数升序</option>
<option value="7">服务开始降序</option>
<option value="8">服务开始升序</option>
<option value="9">服务结束降序</option>
<option value="10">服务结束升序</option>
<option value="11">浏览人气降序</option>
<option value="12">浏览人气升序</option>
</select>&nbsp;

会员名：<input type="text" name="username" value="" size="10">&nbsp;
会员ID：<input type="text" name="uid" value="" size="10" id="id_input">&nbsp;
<input type="text" name="psize" value="20" size="2" class="t_c" title="条/页" id="psize">
<input type="submit" value="搜 索" class="btn">&nbsp;
<input type="reset" value="重 置" class="btn">
</td>
</tr>
</tbody></table>
</form>
<form method="post">
<div class="tt">公司管理</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tbody><tr>
<th width="25"><input type="checkbox" onclick="checkall(this.form);"></th>
<th> 公司ID</th>
<th width="350">公司名称</th>
<th width="530">所在地</th>
<th>地区</th>
<th>注册年份</th>
<th>注册资本</th>
<th width="60">VIP指数</th>
<th>人气</th>
<th width="100">操作</th>
</tr>
<?php foreach ($company as $v){?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center" title="公司类型:<?php echo $v['ctype']."\r\n";?>公司规模:<?php echo $v['size'];?>">
<td><input type="checkbox" name="userid[]" value="<?php echo $v['userid'];?>"></td>
<td><?php echo $v['userid'];?></td>
<td align="left">
	&nbsp;<a href="<?php echo company_url(site_url(),$v['username']);?>" rel="nofollow" target="_blank"><?php echo $v['company'];?></a> 
	<?php if ($v['thumb']){?><a href="javascript:_preview('<?php echo $site['image_domain'].$v['thumb'];?>');"><img width="10" height="10" alt="" title="标题图,点击预览" src="<?php echo base_url("skin/images/img.gif")?>"></a><?php }?>
</td>
<td align="left">&nbsp;<?php echo $v['address'];?></td>
<td><?php echo $v['areaname'];?></td>
<td><?php echo $v['regyear'];?></td>
<td><?php echo $v['capital']>"0"." ".$v['regunit']?$v['capital']." ".$v['regunit']:"未填";?></td>
<td><img src="<?php echo base_url("skin/images/vip_{$v['vip']}.gif");?>"></td>
<td>3</td>
<td><a href="<?php echo site_url("member/member/member_edit2/{$v['userid']}");?>"><img src="<?php echo base_url("skin/images/edit.png");?>" width="16" height="16" title="修改会员[<?php echo $v['username'];?>]资料" alt=""></a>&nbsp;
<a href="<?php echo site_url("member/member/get_detail/{$v['username']}");?>"><img src="<?php echo base_url("skin/images/view.png");?>" width="16" height="16" title="会员[<?php echo $v['username'];?>]详细资料" alt=""></a>&nbsp;
<a href="<?php echo site_url("member/member/login/{$v['userid']}/{$v['username']}")?>" target="_blank"><img src="<?php echo base_url("skin/images/set.png");?>" width="16" height="16" title="进入会员商务中心" alt=""></a>&nbsp;
<a href="<?php echo site_url("member/company/del/{$v['userid']}/{$v['username']}");?>" onclick="return _delete();"><img src="<?php echo base_url("skin/images/delete.png");?>" width="16" height="16" title="删除" alt=""></a></td>
</tr>
<?php }?>
</tbody></table>
<div class="btns">
<input type="submit" value=" 删除公司 " class="btn" onclick="if(confirm('确定要删除选中会员吗？系统将删除选中用户所有信息，此操作将不可撤销')){this.form.action='<?php echo site_url('member/company/del')?>'}else{return false;}">&nbsp;
<input type="submit" value=" 禁止访问 " class="btn" onclick="if(confirm('确定要禁止选中会员访问吗？')){this.form.action='<?php echo site_url('member/company/check/forbid')?>'}else{return false;}">&nbsp;
<input type="submit" value=" 设置VIP " class="btn" onclick="this.form.action='?moduleid=4&amp;file=vip&amp;action=add';">&nbsp;
<input type="submit" value=" 移动至 " class="btn" onclick="if(Dd('mgroupid').value==0){alert('请选择会员组');Dd('mgroupid').focus();return false;}this.form.action='<?php echo site_url('member/member/check/move')?>';">
 <select name="groupid" id="mgroupid">
 <option value="0">会员组</option>
 <option value="1">管理员</option>
 <option value="2">禁止访问</option>
 <option value="3">游客</option>
 <option value="4">待审核会员</option>
 <option value="5">个人会员</option>
 <option value="6">企业会员</option>
 <option value="7">VIP会员</option>
 </select> 
</div>
</form>
<div class="pages">
	<?php echo $pages?>
	&nbsp;<cite>共<?php echo $mem_count?>条/<?php echo $total_page?>页</cite>&nbsp;
	<input type="text" class="pages_inp" id="destoon_pageno" value="1" onkeydown="if(event.keyCode==13 && this.value && this.value>=1 && this.value<=<?php echo $total_page?>) {var page_size=<?php echo $page_size?>;var page=(this.value-1)*page_size;window.location.href='<?php echo substr($base_url,0,-5)?>/'+page;return false;}"> 
	<input type="button" class="pages_btn" value="GO" onclick="if(Dd('destoon_pageno').value>=1 && Dd('destoon_pageno').value<=<?php echo $total_page?>){var page_size=<?php echo $page_size?>;var page=(Dd('destoon_pageno').value-1)*page_size;window.location.href='<?php echo substr($base_url,0,-5)?>/'+page;}else{Dmsg('页码不正确，请重填', 'go');}"><span id="dgo" class="f_red"></span>
</div>
<br>
<script type="text/javascript">Menuon(0);</script>

</body></html>