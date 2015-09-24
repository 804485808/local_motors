<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>会员询单列表</title>
<meta name="robots" content="noindex,nofollow">
<script type="text/javascript">
window.onerror= function(){return true;}
</script>
<link rel="stylesheet" href="<?php echo base_url("skin/css/style.css")?>" type="text/css">
<script type="text/javascript" src="<?php echo base_url("skin/js/lang.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/config.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/jquery.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/common.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/admin.js")?>"></script>
<script type="text/javascript">
//function get_ip(ip){
//	$.post("<?php echo site_url("pub/get_ip")?>",{ip:ip},
//			function (data){
//				alert(ip+"所在地区为：\n"+data);		
//	});
//}


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
<td id="Tab0" class="<?php echo $class=='all' ? 'tab_on' : 'tab';?>"><a href="<?php echo site_url("module/inquiry/inquiry_list2")?>">所有询单</a></td><td class="tab_nav">&nbsp;</td>
<td id="Tab2" class="<?php echo $class=='need' ? 'tab_on' : 'tab';?>"><a href="<?php echo site_url("module/inquiry/unapproved_list2")?>">未审核询单</a></td><td class="tab_nav">&nbsp;</td>
<td id="Tab3" class="<?php echo $class=='approved' ? 'tab_on' : 'tab';?>"><a href="<?php echo site_url("module/inquiry/app_list2")?>">已通过的询单</a></td><td class="tab_nav">&nbsp;</td>
<td id="Tab5" class="<?php echo $class=='unapproved' ? 'tab_on' : 'tab';?>"><a href="<?php echo site_url("module/inquiry/rejected_list2")?>">未通过的询单</a></td><td class="tab_nav">&nbsp;</td>
<td id="Tab5" class="<?php echo $class=='unassign' ? 'tab_on' : 'tab';?>"><a href="<?php echo site_url("module/inquiry/unassign_list")?>">未分配的询单</a></td><td class="tab_nav">&nbsp;</td>
<td id="Tab6" class="<?php echo $class=='unfinished' ? 'tab_on' : 'tab';?>"><a href="<?php echo site_url("module/inquiry/unfinished_list")?>">未联系的询单</a></td><td class="tab_nav">&nbsp;</td>
<td id="Tab7" class="<?php echo $class=='rejected' ? 'tab_on' : 'tab';?>"><a href="<?php echo site_url("module/inquiry/rejected_list")?>">联系被拒的询单</a></td><td class="tab_nav">&nbsp;</td>
<td id="Tab8" class="<?php echo $class=='finished1' ? 'tab_on' : 'tab';?>"><a href="<?php echo site_url("module/inquiry/finished_list1")?>">已联系(有意向)的询单</a></td><td class="tab_nav">&nbsp;</td>
<td id="Tab9" class="<?php echo $class=='finished2' ? 'tab_on' : 'tab';?>"><a href="<?php echo site_url("module/inquiry/finished_list2")?>">已联系(无意向)的询单</a></td><td class="tab_nav">&nbsp;</td>
<td id="Tab10" class="<?php echo $class=='finished3' ? 'tab_on' : 'tab';?>"><a href="<?php echo site_url("module/inquiry/finished_list3")?>">已联系(意向不明)的询单</a></td><td class="tab_nav">&nbsp;</td>
<td id="Tab11" class="tab"><a href="<?php echo site_url("module/inquiry/auto_assign")?>">自动分配询单</a></td><td class="tab_nav">&nbsp;</td>
<td id="Tab12" class="<?php echo $class=='clear' ? 'tab_on' : 'tab';?>"><a href="<?php echo site_url("module/inquiry/inquiry_clear2")?>">询单清理</a></td><td class="tab_nav">&nbsp;</td></tr>
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

<?php if ($class == 'all'){?>
<form action="<?php echo site_url("module/inquiry/search")?>" method="post">
<input type="hidden" name="action" value="inquiry_list">
<div class="tt">会员询单搜索</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tbody><tr>
<td>&nbsp;
<select name="fields">
<option value="1" selected="selected">标题</option>
<option value="2">询单人</option>
<option value="3">供应商</option>
<option value="4">产品ID</option>
</select>&nbsp;
<input type="text" size="25" name="kw" value="" title="关键词">&nbsp;
询单时间：
<script type="text/javascript" src="<?php echo base_url("skin/js/calendar.js");?>"></script>
<input type="text" name="postdate" id="postdate" value="" size="10" onfocus="ca_show('postdate', this, '-');" readonly="" ondblclick="this.value='';"> 
<img src="<?php echo base_url("skin/images/calendar.gif");?>" align="absmiddle" onclick="ca_show('postdate', this, '-');" style="cursor:pointer;">
<select name="status">
<option value="" selected="selected">审核状态</option>
<option value="1">审核通过</option>
<option value="0">未审核</option>
<option value="2">审核被拒</option>
</select>&nbsp;
<select name="typeid">
<option value="">类型</option>
<option value="0">询价</option>
<option value="1">回复询单</option>
</select>
&nbsp;
<input type="submit" value="搜 索" class="btn">&nbsp;
<input type="button" value="重 置" class="btn" onclick="this.form.reset();">
</form>
<form method="post">
&nbsp;&nbsp;<select name="salesman" onchange="this.form.action='<?php echo substr(site_url("module/inquiry/one_list/"),0,-5)?>/'+this.value;this.form.submit();">
<option value="">业务员</option>
<?php if (is_array($salesman)){foreach ($salesman as $v){?>
<option value="<?php echo $v['username']?>"><?php echo $v['username']?></option>
<?php }}?>
</select>&nbsp;
<select name="sstatus" onchange="if(this.value==-1){this.form.action='<?php echo site_url("module/inquiry/rejected_list")?>';this.form.submit();}else if(this.value==0){this.form.action='<?php echo site_url("module/inquiry/unfinished_list")?>';this.form.submit();}else if(this.value==1){this.form.action='<?php echo site_url("module/inquiry/finished_list1")?>';this.form.submit();}else if(this.value==2){this.form.action='<?php echo site_url("module/inquiry/finished_list2")?>';this.form.submit();}else if(this.value==3){this.form.action='<?php echo site_url("module/inquiry/finished_list3")?>';this.form.submit();}">
<option value="">联系状态</option>
<option value="-1">联系被拒</option>
<option value="0">未联系</option>
<option value="1">已联系(有意向)</option>
<option value="2">已联系(无意向)</option>
<option value="3">已联系(意向不明)</option>
</select>
</form>
<?php }?>
</td>
</tr>
</tbody></table>
<form method="post">
<div class="tt">会员询单管理</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tbody><tr>
<th width="1%"><input type="checkbox" onclick="checkall(this.form);"></th>
<th width="2%">类型</th>
<th width="4%">审核状态</th>
<th width="24%">标题</th>
<th width="4%">产品ID</th>
<th width="4%">询单人</th>
<th width="4%">供应商</th>
<th width="10%">电话</th>
<th width="8%">手机号码</th>
<th width="10%">邮箱</th>
<th width="8%">发送时间</th>
<th width="4%">回复询单</th>
<th width="4%">询单IP</th>
<th width="4%">分配状态</th>
<th width="3%">业务员</th>
<th width="4%">联系状态</th>
<th width="2%">删除</th>
</tr>
<?php foreach ($inquiry as $v){?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td><input type="checkbox" name="itemid[]" value="<?php echo $v['id']?>"></td>
<td><?php echo $v['pid']?'回复询单':'询单'?></td>
<td><?php if ($v['status']==0){echo '未审核';}elseif ($v['status']==1){echo '通过';}elseif ($v['status']){echo '未通过';}?></td>
<td align="left"><a href="<?php echo site_url("module/inquiry/inq_show2/".$class."/".$v['id'])?>" title="<?php echo $v['title']?>">&nbsp;<?php echo $v['title']?></a></td>
<td><a href="<?php echo company_url(site_url("content/index/".$v['sid']."/".$v['item_url']),$v['username']);?>" target="_blank"><?php echo $v['sid']?></a></td>
<td><a href="<?php echo site_url("member/member/get_detail/{$v['fromuser']}");?>"><?php echo $v['fromuser']?></a></td>
<td><a href="<?php echo site_url("member/member/get_detail/{$v['touser']}");?>"><?php echo $v['touser']?></a></td>
<td><?php echo $v['telephone']?></td>
<td><?php echo $v['mobile']?></td>
<td><?php echo $v['email']?></td>
<td class="px11"><?php echo date('Y-m-d H:i:s',$v['postdate']);?></td>
<td>
<?php if ($v['re_count']){?>
<a href="<?php echo site_url("module/inquiry/inquiry_list2/sub-".$v['id'])?>"><?php echo $v['re_count']?>条</a>
<?php }else{ echo $v['re_count'].'条';}?>
</td>
<td class="px11"><?php echo $v['ip']?></td>
<td><?php if ($v['assign']=='未分配'){echo "<a href='",site_url("module/inquiry/unassign_list"),"'>",$v['assign'],"</a>";}else{echo $v['assign'];}?></td>
<td><a href="<?php echo site_url("module/inquiry/one_list/".$v['salesman'])?>"><?php echo $v['salesman']?></a></td>
<td title="<?php echo $v['note']?>">
<?php if ($v['sstatus']==0){
	echo "<a href='".site_url("module/inquiry/unfinished_list")."'>未联系</a>";
}elseif ($v['sstatus']==1){
	echo "<a href='".site_url("module/inquiry/finished_list1")."'>已联系(有意向)</a>";
}elseif ($v['sstatus']==-1){
	echo "<a href='".site_url("module/inquiry/rejected_list")."'>联系被拒</a>";
}elseif ($v['sstatus']==2){
	echo "<a href='".site_url("module/inquiry/finished_list2")."'>已联系(无意向)</a>";
}elseif ($v['sstatus']==3){
	echo "<a href='".site_url("module/inquiry/finished_list3")."'>已联系(意向不明)</a>";
}?>

</td>
<td>
<a href="<?php echo site_url("module/inquiry/del_inquiry/".$v['id'])?>" onclick="return _delete();">
<img src="<?php echo base_url("skin/images/delete.png")?>" width="16" height="16" title="删除" alt=""></a>
</td>
</tr>
<?php }?>
</tbody></table>
<div class="btns">
<?php if ($class!='approved'){?><input type="submit" value=" 通过审核 " class="btn" onclick="this.form.action='<?php echo site_url("module/inquiry/approve_inquiry/check/")?>';">&nbsp;<?php }?>
<?php if ($class!='unapproved'){?><input type="submit" value=" 拒 绝 " class="btn" onclick="this.form.action='<?php echo site_url("module/inquiry/approve_inquiry/reject/")?>';">&nbsp;<?php }?>
<input type="submit" value=" 删 除 " class="btn" onclick="if(confirm('确定要删除选中询单吗？此操作将不可撤销')){this.form.action='<?php echo site_url("module/inquiry/del_inquiry")?>'}else{return false;}">&nbsp;
<select name="salesman" onchange="this.form.action='<?php echo site_url("module/inquiry/assign/")?>';this.form.submit();">
<option value="0">分配给</option>
<?php if (is_array($salesman)){foreach ($salesman as $v){?>
<option value="<?php echo $v['username']?>"><?php echo $v['username']?></option>
<?php }}?></select>
</div>
</form>
<div class="pages"><?php echo $pages?>
<cite>共<?php echo $inquiry_count?>条/<?php echo $total_page?>页</cite>&nbsp;
<input type="text" class="pages_inp" id="destoon_pageno" value="1" onkeydown="if(event.keyCode==13 && this.value && this.value>=1 && this.value<=<?php echo $total_page?>) {var page_size=<?php echo $page_size?>;var page=(this.value-1)*page_size;window.location.href='<?php echo substr($base_url,0,-5)?>/'+page;return false;}"> 
<input type="button" class="pages_btn" value="GO" onclick="if(Dd('destoon_pageno').value>=1 && Dd('destoon_pageno').value<=<?php echo $total_page?>){var page_size=<?php echo $page_size?>;var page=(Dd('destoon_pageno').value-1)*page_size;window.location.href='<?php echo substr($base_url,0,-5)?>/'+page;}else{Dmsg('页码不正确，请重填', 'go');}"><span id="dgo" class="f_red"></span></div>
<script type="text/javascript">Menuon(1);</script>
<br>

</body></html>