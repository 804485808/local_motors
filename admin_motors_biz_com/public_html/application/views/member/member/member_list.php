<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>会员列表</title>
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
<td id="Tab0" class="tab"><a href="<?php echo site_url('member/member/member_add2');?>">添加会员</a></td>
<td class="tab_nav">&nbsp;</td>
<td id="Tab1" class="tab_on"><a href="<?php echo site_url('member/member/member_list2');?>">会员列表</a></td>
<td class="tab_nav">&nbsp;</td><td id="Tab2" class="tab"><a href="<?php echo site_url('member/member/member_check2');?>">审核会员</a></td>
<td class="tab_nav">&nbsp;</td><td id="Tab4" class="tab"><a href="<?php echo site_url('member/member/member_contact2');?>">联系会员</a></td>
<td class="tab_nav">&nbsp;</td><td id="Tab5" class="tab"><a href="<?php echo site_url('member/company/company_list2');?>">公司列表</a></td>
<td class="tab_nav">&nbsp;</td><td id="Tab6" class="tab"><a href="<?php echo site_url('member/vip/vip_list2');?>">VIP列表</a></td>
<td class="tab_nav">&nbsp;</td></tr>
</tbody></table>
</td>
<td width="110"><div>
<img src="<?php echo base_url("skin/images/spacer.gif");?>" width="40" height="24" title="刷新" onclick="window.location.reload();" style="cursor:pointer;" alt="">
<img src="<?php echo base_url("skin/images/spacer.gif");?>" width="20" height="24" title="后退" onclick="history.back(-1);" style="cursor:pointer;" alt="">
<img src="<?php echo base_url("skin/images/spacer.gif");?>" width="20" height="24" title="前进" onclick="history.go(1);" style="cursor:pointer;" alt="">
</div></td>
</tr>
</tbody></table>
</div>
<form action="<?php echo site_url('member/member/search');?>" method="post" onsubmit="return check_s();">
<input type="hidden" name="action" value="member_list2">
<div class="tt">会员搜索</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tbody><tr>
<td>&nbsp;
<select name="fields">
<option value="0" selected="selected">按条件</option>
<option value="1">公司名</option>
<option value="2">会员名</option>
<option value="3">通行证名</option>
<option value="4">姓名</option>
<option value="5">手机号码</option>
<option value="6">部门</option>
<option value="7">职位</option>
<option value="8">Email</option>
<option value="9">QQ</option>
<option value="10">MSN</option>
<option value="11">阿里旺旺</option>
<option value="12">Skype</option>
<option value="13">注册IP</option>
<option value="14">登录IP</option>
<option value="19">推荐人</option>
</select>&nbsp;
<input type="text" size="20" name="kw" title="关键词">&nbsp;
<select name="groupid">
<option value="0">会员组</option>
<option value="1">管理员</option>
<option value="2">禁止访问</option>
<option value="3">游客</option>
<option value="4">待审核会员</option>
<option value="5">个人会员</option>
<option value="6">企业会员</option>
<option value="7">VIP会员</option>
</select>&nbsp;
<select name="gender">
<option value="" selected="selected">性别</option>
<option value="0">先生</option>
<option value="1">女士</option>
</select>&nbsp;
<select name="areaid">
<option value="0">所在地区</option>
<?php foreach ($area as $k => $v){?>
<option value="<?php echo $v['areaid'];?>"><?php echo $v['areaname'];?></option>
<?php }?>
</select> 
<select name="order">
<option value="0" selected="selected">结果排序方式</option>
<option value="1">注册时间降序</option>
<option value="2">注册时间升序</option>
<option value="3">登录时间降序</option>
<option value="4">登录时间升序</option>
<option value="5">登录次数降序</option>
<option value="6">登录次数升序</option>
<option value="7">会员ID降序</option>
<option value="8">会员ID升序</option>
</select>&nbsp;
<input type="text" name="psize" value="20" size="2" class="t_c" title="条/页" id="psize">
</td>
</tr>
<tr>
<td>&nbsp;
<select name="timetype">
<option value="regtime" selected="selected">注册时间</option>
<option value="logintime">登录时间</option>
</select>&nbsp;
<script type="text/javascript" src="<?php echo base_url("skin/js/calendar.js");?>"></script>
<input type="text" name="fromtime" id="fromtime" value="" size="10" onfocus="ca_show('fromtime', this, '');" readonly="" ondblclick="this.value='';"> 
<img src="<?php echo base_url("skin/images/calendar.gif");?>" align="absmiddle" onclick="ca_show('fromtime', this, '');" style="cursor:pointer;"> 至 
<input type="text" name="totime" id="totime" value="" size="10" onfocus="ca_show('totime', this, '');" readonly="" ondblclick="this.value='';"> 
<img src="<?php echo base_url("skin/images/calendar.gif");?>" align="absmiddle" onclick="ca_show('totime', this, '');" style="cursor:pointer;">&nbsp;
<select name="vmail">
<option value="0" selected="selected">邮件</option>
<option value="1">已认证</option>
<option value="2">未认证</option>
</select>
<select name="vtruename">
<option value="0" selected="selected">实名</option>
<option value="1">已认证</option>
<option value="2">未认证</option>
</select>
<select name="vcompany">
<option value="0" selected="selected">公司</option>
<option value="1">已认证</option>
<option value="2">未认证</option>
</select>
会员名：<input type="text" name="username" value="" size="8">&nbsp;
会员ID：<input type="text" name="uid" value="" size="4" id="id_input">
<input type="submit" value="搜 索" class="btn">&nbsp;
<input type="reset" value="重 置" class="btn">&nbsp;
</td>
</tr>
</tbody></table>
</form>
<form method="post">
<div class="tt">会员管理</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tbody><tr>
<th width="25"><input type="checkbox" onclick="checkall(this.form);"></th>
<th>会员ID</th>
<th>会员名称</th>
<th width="360">公司</th>
<th>地区</th>
<th>资金</th>
<th>积分</th>
<th>短信</th>
<th>性别</th>
<th>会员组</th>
<th>注册时间</th>
<th>最后登录</th>
<th width="60">登录次数</th>
<th width="100">操作</th>
</tr>
<?php foreach ($member as $v){?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center" title="会员名:<?php echo $v['username']."\r\n";?>会员ID:<?php echo $v['userid']."\r\n";?>会员组:<?php if ($v['groupid']==1){echo "管理员";}else if ($v['groupid']==2){echo "禁止访问";}else if ($v['groupid']==3){echo "游客";}else if ($v['groupid']==4){echo "待审核会员";}else if ($v['groupid']==5){echo "个人会员";}else if ($v['groupid']==6){echo "企业会员";}else if ($v['groupid']==7){echo "VIP会员";}else{echo "会员组";}?>">
<td><input type="checkbox" name="userid[]" value="<?php echo $v['userid'];?>" id="checkbox_1"></td>
<td class="px11"><?php echo $v['userid'];?></td>
<td align="left">&nbsp;<a href="<?php echo site_url("member/member/get_detail/{$v['username']}");?>" title="<?php echo $v['truename'];?>"><?php echo $v['username'];?></a></td>
<td align="left">&nbsp;
	<a href="<?php echo company_url(site_url(),$v['username']);?>" rel="nofollow" target="_blank"><?php echo $v['company'];?></a> 
	<?php if ($v['mcompany']['thumb']){?><a href="javascript:_preview('<?php echo $site['image_domain'].$v['mcompany']['thumb'];?>');"><img width="10" height="10" alt="" title="标题图,点击预览" src="<?php echo base_url("skin/images/img.gif")?>"></a><?php }?>
</td>
<td><?php echo $v['areaname'];?></td>
<td class="px11"><a href="javascript:Dwidget('<?php echo site_url('member/member/record/'.$v['username']);?>', '[<?php echo $v['username'];?>] 资金记录');">0.00</a></td>
<td class="px11"><a href="javascript:Dwidget('<?php echo site_url('member/member/credit/'.$v['username']);?>', '[<?php echo $v['username'];?>] 积分记录');"><?php echo $v['credit'];?></a></td>
<td class="px11"><a href="javascript:Dwidget('<?php echo site_url('member/member/sms/'.$v['username']);?>', '[<?php echo $v['username'];?>] 短信记录');"><?php echo $v['message'];?></a></td>
<td><?php echo $v['gender']?"女士":"先生";?></td>
<td>
	<a href="<?php echo site_url("member/member/{$v['action']}/group-{$v['groupid']}");?>">
	<?php if ($v['groupid']==1){echo "管理员";}else if ($v['groupid']==2){echo "禁止访问";}else if ($v['groupid']==3){echo "游客";}else if ($v['groupid']==4){echo "待审核会员";}else if ($v['groupid']==5){echo "个人会员";}else if ($v['groupid']==6){echo "企业会员";}else if ($v['groupid']==7){echo "VIP会员";}else{echo "会员组";}?>
	</a>
</td>
<td class="px11"><?php echo date("Y-m-d H:i:s",$v['regtime']);?></td>
<td class="px11"><?php echo date("Y-m-d H:i:s",$v['logintime']);?></td>
<td class="px11"><?php echo $v['logintimes'];?></td>
<td>
	<a href="<?php echo site_url("member/member/member_edit2/{$v['userid']}");?>"><img src="<?php echo base_url('skin/images/edit.png');?>" width="16" height="16" title="修改" alt=""></a>&nbsp;
	<a href="<?php echo site_url("member/member/get_detail/{$v['username']}");?>" title="<?php echo $v['truename'];?>"><img src="<?php echo base_url('skin/images/view.png');?>" width="16" height="16" title="会员[<?php echo $v['username'];?>]详细资料" alt=""></a>&nbsp;
	<a href="<?php echo site_url("member/member/login/{$v['userid']}/{$v['username']}")?>" target="_blank"><img src="<?php echo base_url('skin/images/set.png');?>" width="16" height="16" title="进入会员商务中心" alt=""></a>&nbsp;
	<a href="<?php echo site_url("member/member/del/{$v['userid']}/{$v['username']}");?>" onclick="if(!confirm('确定危险！！要删除此会员吗？系统将删除选中用户所有信息，此操作将不可撤销')) return false;">
		<img src="<?php echo base_url('skin/images/delete.png');?>" width="16" height="16" title="删除" alt="">
	</a>
</td>
</tr>
<?php }?>
</tbody></table>
<div class="btns">
<input type="submit" value=" 删除会员 " class="btn" onclick="if(confirm('确定要删除选中会员吗？系统将删除选中用户所有信息，此操作将不可撤销')){this.form.action='<?php echo site_url('member/member/del')?>'}else{return false;}">&nbsp;
<input type="submit" value=" 禁止访问 " class="btn" onclick="if(confirm('确定要禁止选中会员访问吗？')){this.form.action='<?php echo site_url('member/member/check/forbid')?>'}else{return false;}">&nbsp;
<input type="submit" value=" 设置VIP " class="btn" onclick="this.form.action='<?php echo site_url('member/vip/vip_add2');?>';">&nbsp;
<input type="submit" value=" 发送消息 " class="btn" onclick="this.form.action='<?php echo site_url("member/message/msg_send2");?>'">&nbsp;
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
	<?php echo $pages;?>
	&nbsp;<cite>共<?php echo $mem_count;?>条/<?php echo $total_page?>页</cite>&nbsp;
	<input type="text" class="pages_inp" id="destoon_pageno" value="1" onkeydown="if(event.keyCode==13 && this.value && this.value>=1 && this.value<=<?php echo $total_page?>) {var page_size=<?php echo $page_size?>;var page=(this.value-1)*page_size;window.location.href='<?php echo substr($base_url,0,-5)?>/'+page;return false;}"> 
	<input type="button" class="pages_btn" value="GO" onclick="if(Dd('destoon_pageno').value>=1 && Dd('destoon_pageno').value<=<?php echo $total_page?>){var page_size=<?php echo $page_size?>;var page=(Dd('destoon_pageno').value-1)*page_size;window.location.href='<?php echo substr($base_url,0,-5)?>/'+page;}else{Dmsg('页码不正确，请重填', 'go');}"><span id="dgo" class="f_red"></span>
</div>
</body>
</html>