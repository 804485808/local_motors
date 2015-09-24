<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>供应列表</title>
<meta name="robots" content="noindex,nofollow">
<script type="text/javascript">window.onerror= function(){return true;}</script>
<link rel="stylesheet" href="<?php echo base_url("skin/css/style.css");?>" type="text/css">
<script type="text/javascript" src="<?php echo base_url("skin/js/lang.js");?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/config.js");?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/jquery.js");?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/common.js");?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/admin.js");?>"></script>
<script type="text/javascript">
function get_ip(ip){
	$.post("<?php echo site_url("pub/get_ip")?>",{ip:ip},
			function (data){
				alert(ip+"所在地区为：\n"+data);		
	});
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
<td id="Tab1" class="tab"><a href="<?php echo site_url('member/member/member_list2');?>">会员列表</a></td>
<td class="tab_nav">&nbsp;</td><td id="Tab2" class="tab_on"><a href="<?php echo site_url('member/member/member_check2');?>">审核会员</a></td>
<td class="tab_nav">&nbsp;</td><td id="Tab4" class="tab"><a href="<?php echo site_url('member/member/member_contact2');?>">联系会员</a></td>
<td class="tab_nav">&nbsp;</td><td id="Tab5" class="tab"><a href="<?php echo site_url('member/company/company_list2');?>">公司列表</a></td>
<td class="tab_nav">&nbsp;</td><td id="Tab6" class="tab"><a href="<?php echo site_url('member/member/vip_list2');?>">VIP列表</a></td>
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
<form method="post">
<div class="tt">会员审核</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tbody><tr>
<th width="25">
<input type="checkbox" onclick="checkall(this.form);"></th>
<th>会员ID</th>
<th>会员名称</th>
<th>公司名称</th>
<th>性别</th>
<th>待审会员组</th>
<th>注册时间</th>
<th>注册IP</th>
<th width="80">操作</th>
</tr>
<?php foreach ($member as $v){?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td><input type="checkbox" name="userid[]" value="<?php echo $v['userid'];?>"></td>
<td width="100px"><?php echo $v['userid'];?></td>
<td width="190px">&nbsp;<a href="<?php echo site_url("member/member/get_detail/{$v['username']}");?>" title="<?php echo $v['truename'];?>"><?php echo $v['username'];?></a></td>
<td align="left">&nbsp;<a href="<?php echo company_url(site_url(),$v['username']);?>" rel="nofollow" target="_blank"><?php echo $v['company'];?></a></td>
<td width="120px"><?php echo $v['gender']?"女士":"男士";?></td>
<td width="200px"><a href="<?php echo site_url("member/member/member_check2/{$v['userid']}/{$v['groupid']}");?>">待审会员</a></td>
<td width="180px"><?php echo date("Y-m-d H:i:s",$v['regtime']);?></td>
<td width="120px"><a href="javascript:get_ip('<?php echo $v['regip']?>');" title="显示IP所在地"><?php echo $v['regip']?></a></td>
<td width="150px">
	<a href="<?php echo site_url("member/member/member_edit2/{$v['userid']}");?>"><img src="<?php echo base_url('skin/images/edit.png');?>" width="16" height="16" title="修改" alt=""></a>&nbsp;
	<a href="<?php echo site_url("member/member/get_detail/{$v['username']}");?>" title="<?php echo $v['truename'];?>"><img src="<?php echo base_url('skin/images/view.png');?>" width="16" height="16" title="会员[lunvue8840]详细资料" alt=""></a>&nbsp;
	<a href="<?php echo site_url("member/member/login/{$v['userid']}/{$v['username']}")?>" target="_blank"><img src="<?php echo base_url('skin/images/set.png');?>" width="16" height="16" title="进入会员商务中心" alt=""></a>&nbsp;
	<a href="<?php echo site_url("member/member/del/{$v['userid']}/{$v['username']}");?>" onclick="if(!confirm('确定危险！！要删除此会员吗？系统将删除选中用户所有信息，此操作将不可撤销')) return false;">
		<img src="<?php echo base_url('skin/images/delete.png');?>" width="16" height="16" title="删除" alt="">
	</a>
</td>
</tr>
<?php }?>
</tbody></table>
<div class="btns">
<input type="submit" value=" 通过审核 " class="btn" onclick="this.form.action='<?php echo site_url('member/member/check/verify')?>';">&nbsp;
<input type="submit" value=" 删除会员 " class="btn" onclick="if(confirm('确定要删除选中会员吗？此操作将不可撤销')){this.form.action='<?php echo site_url('member/member/del')?>'}else{return false;}">&nbsp;
<input type="submit" value=" 禁止访问 " class="btn" onclick="if(confirm('确定要禁止选中会员访问吗？')){this.form.action='<?php echo site_url('member/member/check/forbid')?>'}else{return false;}">&nbsp;
<input type="submit" value=" 发送消息 " class="btn" onclick="this.form.action='<?php echo site_url("member/message/msg_send2");?>';">&nbsp;
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
</body></html>