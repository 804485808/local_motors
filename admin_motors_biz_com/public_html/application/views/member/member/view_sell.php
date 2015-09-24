<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>供应列表</title>
<meta name="robots" content="noindex,nofollow">
<script type="text/javascript">window.onerror= function(){return true;}</script><link rel="stylesheet" href="<?php echo base_url("skin/css/style.css")?>" type="text/css">
<script type="text/javascript" src="<?php echo base_url("skin/js/lang.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/config.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/jquery.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/common.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/admin.js")?>"></script>
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
<td id="Tab0" class="<?php echo $class == "all" ? "tab_on" : "tab";?>"><a href="<?php echo site_url("module/sell/view_list/".$username)?>">供应列表</a></td><td class="tab_nav">&nbsp;</td>
<td id="Tab2" class="<?php echo $class == "unapproved" ? "tab_on" : "tab";?>"><a href="<?php echo site_url("module/sell/view_list1/".$username)?>">待审核供应</a></td><td class="tab_nav">&nbsp;</td>
<td id="Tab3" class="<?php echo $class == "expire" ? "tab_on" : "tab";?>"><a href="<?php echo site_url("module/sell/view_list2/".$username)?>">过期供应</a></td><td class="tab_nav">&nbsp;</td>
<td id="Tab4" class="<?php echo $class == "rejected" ? "tab_on" : "tab";?>"><a href="<?php echo site_url("module/sell/view_list3/".$username)?>">未通过供应</a></td><td class="tab_nav">&nbsp;</td>
<td id="Tab5" class="<?php echo $class == "trash" ? "tab_on" : "tab";?>"><a href="<?php echo site_url("module/sell/view_list4/".$username)?>">回收站</a></td><td class="tab_nav">&nbsp;</td>
<td id="Tab6" class="tab"><a href="<?php echo site_url("member/member/get_detail/".$username);?>">返回</a></td><td class="tab_nav">&nbsp;</td>
</tr>
</tbody></table>
</td>
<td width="110"><div>
<img src="<?php echo base_url("skin/images/spacer.gif")?>" width="40" height="24" title="刷新" onclick="window.location.reload();" style="cursor:pointer;" alt="">
<img src="<?php echo base_url("skin/images/spacer.gif")?>" width="20" height="24" title="后退" onclick="history.back(-1);" style="cursor:pointer;" alt="">
<img src="<?php echo base_url("skin/images/spacer.gif")?>" width="20" height="24" title="前进" onclick="history.go(1);" style="cursor:pointer;" alt="">
</tr>
</tbody></table>
</div>
<?php if ($class == 'all'){?>
<form action="<?php echo site_url("module/sell/search")?>" method="post" onsubmit="return check_s();">
<input type="hidden" name="action" value="view_sell">
<input type="hidden" name="username" value="<?php echo $username;?>">
<div class="tt">供应搜索</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tbody><tr>
<td>
&nbsp;<select name="fields">
<option value="0" selected="selected">模糊</option>
<option value="1">标题</option>
<option value="2">产品品牌</option>
<option value="3">计量单位</option>
<option value="4">简介</option>
<option value="5">公司名</option>
<option value="6">联系人</option>
<option value="7">联系电话</option>
<option value="8">联系地址</option>
<option value="9">电子邮件</option>
<option value="10">会员名</option>
<option value="11">IP</option>
</select>&nbsp;
<input type="text" size="25" name="kw" value="" title="关键词">&nbsp;
<select name="level">
<option value="0">级别</option>
<option value="1">1 级 推荐信息</option>
<option value="2">2 级</option>
<option value="3">3 级</option>
<option value="4">4 级</option>
<option value="5">5 级</option>
<option value="6">6 级</option>
<option value="7">7 级</option>
<option value="8">8 级</option>
<option value="9">9 级</option>
</select>&nbsp;
<select name="order">
<option value="0" selected="selected">结果排序方式</option>
<option value="1">更新时间降序</option>
<option value="2">更新时间升序</option>
<option value="3">添加时间降序</option>
<option value="4">添加时间升序</option>
<option value="5">VIP级别降序</option>
<option value="6">VIP级别升序</option>
<option value="7">产品单价降序</option>
<option value="8">产品单价升序</option>
<option value="9">供货总量降序</option>
<option value="10">供货总量升序</option>
<option value="11">最小起订降序</option>
<option value="12">最小起订升序</option>
<option value="13">浏览次数降序</option>
<option value="14">浏览次数升序</option>
<option value="15">信息ID降序</option>
<option value="16">信息ID升序</option>
</select>&nbsp;
<input type="text" name="psize" value="20" size="2" class="t_c" id="psize" title="条/页">
</td>
</tr>
<tr>
<td>
&nbsp;<select name="datetype">
<option value="edittime" selected=selected>更新日期</option>
<option value="addtime">发布日期</option>
<option value="totime">到期日期</option>
</select>&nbsp;
<script type="text/javascript" src="<?php echo base_url("skin/js/calendar.js")?>"></script>
<input type="text" name="fromdate" id="fromdate" value="" size="10" onfocus="ca_show('fromdate', this, '');" readonly="" ondblclick="this.value='';"> 
<img src="<?php echo base_url("skin/images/calendar.gif")?>" align="absmiddle" onclick="ca_show('fromdate', this, '');" style="cursor:pointer;"> 至 
<input type="text" name="todate" id="todate" value="" size="10" onfocus="ca_show('todate', this, '');" readonly="" ondblclick="this.value='';"> 
<img src="<?php echo base_url("skin/images/calendar.gif")?>" align="absmiddle" onclick="ca_show('todate', this, '');" style="cursor:pointer;">&nbsp;
ID：<input type="text" size="4" name="itemid" value="" id="id_input">&nbsp;
<input type="checkbox" name="thumb" value="1">图片&nbsp;
<input type="checkbox" name="vip" value="1">VIP&nbsp;
</td>
</tr>
<tr>
<td>
&nbsp;单价：<input type="text" size="4" name="minprice" value=""> ~ <input type="text" size="4" name="maxprice" value="">&nbsp;
供货：<input type="text" size="4" name="minamount" value=""> ~ <input type="text" size="4" name="maxamount" value="">&nbsp;
起订：<input type="text" size="4" name="minminamount" value=""> ~ <input type="text" size="4" name="maxminamount" value="">&nbsp;
VIP：<input type="text" size="2" name="minvip" value=""> ~ <input type="text" size="4" name="maxvip" value="">&nbsp;
<input type="submit" value="搜 索" class="btn">&nbsp;
<input type="button" value="重 置" class="btn" onclick="this.form.reset();">
</td>
</tr>
</tbody></table>
</form>
<?php }?>
<form method="post">
<div class="tt">供应列表</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tbody><tr>
<th width="25"><input type="checkbox" onclick="checkall(this.form);"></th>

<th width="160">行业</th>
<th>类型</th>
<th width="14"> </th>
<th>图片</th>
<th>标 题</th>
<th width="180">价格</th>
<th width="70">会员</th>
<th width="145">更新时间</th>
<th>浏览</th>
<th width="50">操作</th>
</tr>
<?php foreach ($sell as $v){?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td><input type="checkbox" name="itemid[]" value="<?php echo $v['itemid']?>"></td>
<td><a href="<?php echo site_main(site_url("clist/index/".$v['all_linkurl']));?>" target="_blank"><?php echo $v['catname']?></a></td>
<td><?php echo $type;?></td>
<td><?php if ($v['level']){echo "<img alt='' title='",$v['level'],"级' src='",base_url("skin/images/level_".$v['level'].".gif"),"'>";}?></td>
<td><a href="javascript:_preview('<?php echo $site['image_domain'].$v['thumb'];?>');">
<img src="<?php echo $site['image_domain'].$v['thumb'];?>" alt="<?php echo $v['title'];?>" width="60" style="padding:5px;"></a></td>
<td align="left">&nbsp;<a href="<?php echo company_url(site_url("content/index/".$v['itemid']."/".$v['linkurl']),$v['username']);?>" target="_blank"><?php echo $v['title']?></a></td>
<td><?php echo $v['currency'],' ',$v['minprice'],'—',$v['maxprice'],'/',$v['unit']?></td>
<td>
<a href="<?php echo site_url("member/member/get_detail/{$v['username']}");?>"><?php echo $v['username']?></a>
</td>
<td class="px11" title="添加时间<?php echo $v['adddate']?>"><?php echo $v['adddate']?></td>
<td class="px11"><?php echo $v['hits']?></td>
<td>
<a href="<?php echo site_url("module/sell/edit_sell2/".$v['itemid'])?>"><img src="<?php echo base_url("skin/images/edit.png")?>" width="16" height="16" title="修改" alt=""></a>&nbsp;
<a href="<?php echo site_url("module/sell/del_sell/delete/".$v['itemid'])?>" onclick="return _delete();"><img src="<?php echo base_url("skin/images/delete.png")?>" width="16" height="16" title="删除" alt=""></a>
</td>
</tr>
<?php }?>
</tbody></table>
<div class="btns">
<input type="submit" value=" 回收站 " class="btn" onclick="this.form.action='<?php echo site_url("module/sell/del_sell/trash/")?>';">&nbsp;
<input type="submit" value=" 彻底删除 " class="btn" onclick="if(confirm('确定要删除选中供应吗？此操作将不可撤销')){this.form.action='<?php echo site_url("module/sell/del_sell/pack/")?>'}else{return false;}">&nbsp;
<input type="submit" value=" 移动分类 " class="btn" onclick="this.form.action='<?php echo site_url("module/sell/move_cat2")?>';">&nbsp;
<select name="level" onchange="this.form.action='<?php echo site_url("module/sell/modify_sell/set_level")?>';this.form.submit();">
<option value="0">设置级别为</option>
<option value="0">取消</option><option value="1">1 级 推荐信息</option><option value="2">2 级</option>
<option value="3">3 级</option><option value="4">4 级</option><option value="5">5 级</option>
<option value="6">6 级</option><option value="7">7 级</option><option value="8">8 级</option>
<option value="9">9 级</option></select>&nbsp;
<select name="tid" onchange="this.form.action='<?php echo site_url("module/sell/modify_sell/set_status")?>';this.form.submit();">
<option value="">设置状态为</option>
<option value="0">删除</option>
<option value="1">待审核</option>
<option value="2">审核未通过</option>
<option value="3">审核通过</option>
</select>
</div>
</form>
<div class="pages">
<?php echo $pages?>
&nbsp;<cite>共<?php echo $sell_count?>条/<?php echo $total_page?>页</cite>&nbsp;
<input type="text" class="pages_inp" id="destoon_pageno" value="1" onkeydown="if(event.keyCode==13 && this.value && this.value>=1 && this.value<=<?php echo $total_page?>) {var page_size=<?php echo $page_size?>;var page=(this.value-1)*page_size;window.location.href='<?php echo substr($base_url,0,-5)?>/'+page;return false;}"> 
<input type="button" class="pages_btn" value="GO" onclick="if(Dd('destoon_pageno').value>=1 && Dd('destoon_pageno').value<=<?php echo $total_page?>){var page_size=<?php echo $page_size?>;var page=(Dd('destoon_pageno').value-1)*page_size;window.location.href='<?php echo substr($base_url,0,-5)?>/'+page;}else{Dmsg('页码不正确，请重填', 'go');}"><span id="dgo" class="f_red"></span></div>
<br>
<script type="text/javascript">Menuon(1);</script>

</body></html>