<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>认证列表</title>
<meta name="robots" content="noindex,nofollow">
<script type="text/javascript">window.onerror= function(){return true;}</script>
<link rel="stylesheet" href="<?php echo base_url("skin/css/style.css")?>" type="text/css">
<script type="text/javascript" src="<?php echo base_url("skin/js/lang.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/config.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/jquery.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/common.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/admin.js")?>"></script>
<script type="text/javascript">
function get_ip(ip){
	$.post("<?php echo site_url("pub/get_ip")?>",{ip:ip},
			function (data){
				alert(ip+"所在地区为：\n"+data);		
	});
}
function check_s(){
	var pattern=/^\d+$/; 
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
<td id="Tab0" class="tab_on"><a href="<?php echo site_url('member/validate/validate_list2');?>">公司认证</a></td>
<td class="tab_nav">&nbsp;</td></tr>
</tbody></table>
</td>
<td width="110"><div>
<img src="<?php echo base_url("skin/images/spacer.gif")?>" width="40" height="24" title="刷新" onclick="window.location.reload();" style="cursor:pointer;" alt="">
<img src="<?php echo base_url("skin/images/spacer.gif")?>" width="20" height="24" title="后退" onclick="history.back(-1);" style="cursor:pointer;" alt="">
<img src="<?php echo base_url("skin/images/spacer.gif")?>" width="20" height="24" title="前进" onclick="history.go(1);" style="cursor:pointer;" alt="">
<img src="<?php echo base_url("skin/images/spacer.gif")?>" width="20" height="24" title="帮助" onclick="" style="cursor:help;" alt=""></div></td>
</tr>
</tbody></table>
</div><div class="tt">记录搜索</div>
<form action="<?php echo site_url('member/validate/search');?>" method="post" onsubmit="return check_s();" >
<input type="hidden" name="action" value="validate_list2">
<table cellpadding="2" cellspacing="1" class="tb">
<tbody><tr>
<td>
<select name="fields">
<option value="0" selected="selected">按条件</option>
<option value="1">会员名</option>
<option value="2">操作人</option>
</select>&nbsp;
<input type="text" size="20" name="kw" value="">
&nbsp;
<script type="text/javascript" src="<?php echo base_url("skin/js/calendar.js")?>"></script>
<input type="text" name="fromtime" id="fromtime" value="" size="10" onfocus="ca_show('fromtime', this, '');" readonly="" ondblclick="this.value='';"> <img src="<?php echo base_url("skin/images/calendar.gif")?>" align="absmiddle" onclick="ca_show('fromtime', this, '');" style="cursor:pointer;"> 至 <input type="text" name="totime" id="totime" value="" size="10" onfocus="ca_show('totime', this, '');" readonly="" ondblclick="this.value='';"> <img src="<?php echo base_url("skin/images/calendar.gif")?>" align="absmiddle" onclick="ca_show('totime', this, '');" style="cursor:pointer;">&nbsp;
<select name="type">
<option value="" selected="selected">认证类型</option>
<option value="company">公司认证</option>
</select>&nbsp;
<select name="status">
<option value="">状态</option>
<option value="0">已认证</option>
<option value="1">未认证</option>
</select>&nbsp;
<input type="text" name="psize" value="20" size="2" class="t_c" title="条/页" id="psize">&nbsp;
<input type="submit" value="搜 索" class="btn">&nbsp;
<input type="reset" value="重 置" class="btn">
</td>
</tr>
</tbody></table>
</form>
<form method="post" action="<?php echo site_url('member/validate/validate_do');?>">
<div class="tt">认证记录</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tbody><tr>
<th width="25"><input type="checkbox" onclick="checkall(this.form);"></th>
<th>类型</th>
<th>认证名称</th>
<th>证件1</th>
<th>证件2</th>
<th>证件3</th>
<th>会员</th>
<th>IP</th>
<th width="120">提交时间</th>
<th>操作人</th>
<th>状态</th>
</tr>
<?php foreach ($validate as $v){?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center" class="">
<td><input type="checkbox" name="itemid[]" value="<?php echo $v['itemid'];?>"></td>
<td><?php echo $v['type'];?></td>
<td><?php echo $v['title'];?></td>
<td> <?php if($v['thumb']){?><a href="javascript:_preview('<?php echo $site['image_domain']."/".$v['thumb'];?>');"><img src="<?php echo base_url("skin/images/img.gif")?>" width="10" height="10" alt=""></a><?php }?></td>
<td> <?php if($v['thumb1']){?><a href="javascript:_preview('<?php echo $site['image_domain']."/".$v['thumb1'];?>');"><img src="<?php echo base_url("skin/images/img.gif")?>" width="10" height="10" alt=""></a><?php }?></td>
<td> <?php if($v['thumb2']){?><a href="javascript:_preview('<?php echo $site['image_domain']."/".$v['thumb2'];?>');"><img src="<?php echo base_url("skin/images/img.gif")?>" width="10" height="10" alt=""></a><?php }?></td>
<td><a href="<?php echo site_url("member/member/get_detail/{$v['username']}");?>"><?php echo $v['username'];?></a></td>
<td class="px11"><a href="javascript:get_ip('<?php echo $v['ip']?>');" title="显示IP所在地"><?php echo $v['ip']?></a></td>
<td class="px11"><?php echo date('Y-m-d H:i',$v['addtime']);?></td>
<td title="<?php echo date('Y-m-d H:i:s',$v['addtime']);?>"><?php echo $v['editor'];?></td>
<td><?php echo $v['status'] == 0 ? '<span class="f_red">未认证</span>' : ($v['status'] == 1 ? '<span class="f_green">已认证</span>' : '');?></td>
</tr>
<?php }?>
</tbody></table>
<table>
<tbody><tr>
<td>
&nbsp;<textarea style="width:300px;height:40px;" name="reason" id="reason" onfocus="if(this.value=='')this.value='操作原因';">操作原因</textarea> 
</td>
<td>
<input type="checkbox" name="msg" id="msg" value="1" checked=""> 消息通知
</td>
</tr>
</tbody></table>
<div class="btns">
<input type="submit" value=" 通过认证 " class="btn" onclick="if(_check()){this.form.action='<?php echo site_url('member/validate/validate_do/check');?>';}else{return false;}">&nbsp;
<input type="submit" value=" 拒绝认证 " class="btn" onclick="if(_reject()){this.form.action='<?php echo site_url('member/validate/validate_do/reject');?>';}else{return false;}">&nbsp;
<input type="submit" value=" 取消认证 " class="btn" onclick="if(_cancel()){this.form.action='<?php echo site_url('member/validate/validate_do/cancel');?>';}else{return false;}">
</div>
</form>
<div class="pages">
	<?php echo $pages;?>
	&nbsp;<cite>共<?php echo $val_count?>条/<?php echo $total_page?>页</cite>&nbsp;
	<input type="text" class="pages_inp" id="destoon_pageno" value="1" onkeydown="if(event.keyCode==13 && this.value && this.value>=1 && this.value<=<?php echo $total_page?>) {var page_size=<?php echo $page_size?>;var page=(this.value-1)*page_size;window.location.href='<?php echo substr($base_url,0,-5)?>/'+page;return false;}"> 
	<input type="button" class="pages_btn" value="GO" onclick="if(Dd('destoon_pageno').value>=1 && Dd('destoon_pageno').value<=<?php echo $total_page?>){var page_size=<?php echo $page_size?>;var page=(Dd('destoon_pageno').value-1)*page_size;window.location.href='<?php echo substr($base_url,0,-5)?>/'+page;}else{Dmsg('页码不正确，请重填', 'go');}"><span id="dgo" class="f_red"></span>
</div>
<script type="text/javascript">
Menuon(0);
function is_reason() {
	return Dd('reason').value.length > 2 && Dd('reason').value != '操作原因';
}
function _check() {
	return true;
}
function _reject() {
	if((Dd('msg').checked || Dd('sms').checked) && !is_reason()) {
		alert('请填写操作原因或者取消通知');
		return false;
	}
	if(is_reason() && (!Dd('msg').checked && !Dd('sms').checked)) {
		alert('至少需要选择一种通知方式');
		return false;
	}
	return true;
}
function _cancel() {
	if((Dd('msg').checked || Dd('sms').checked) && !is_reason()) {
		alert('请填写操作原因或者取消通知');
		return false;
	}
	if(is_reason() && (!Dd('msg').checked && !Dd('sms').checked)) {
		alert('至少需要选择一种通知方式');
		return false;
	}
	return confirm('此操作不可撤销，确定要继续吗？');
}
</script>
<br>
</body></html>