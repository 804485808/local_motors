<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>VIP列表</title>
<meta name="robots" content="noindex,nofollow">
<script type="text/javascript">window.onerror= function(){return true;}</script>
<link rel="stylesheet" href="<?php echo base_url("skin/css/style.css");?>" type="text/css">
<script type="text/javascript" src="<?php echo base_url("skin/js/lang.js");?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/config.js");?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/jquery.js");?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/common.js");?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/admin.js");?>"></script>
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
<td id="Tab0" class="tab"><a href="<?php echo site_url("member/vip/vip_add2")?>">添加VIP</a></td><td class="tab_nav">&nbsp;</td>
<td id="Tab1" class="tab_on"><a href="<?php echo site_url("member/vip/vip_list2")?>">VIP列表</a></td><td class="tab_nav">&nbsp;</td>
<td id="Tab2" class="tab"><a href="<?php echo site_url("member/vip/vip_expire2")?>">过期VIP</a></td>
<td class="tab_nav">&nbsp;</td><td id="Tab3" class="tab"><a href="<?php echo site_url("member/company/company_list2")?>">公司列表</a></td>
<td class="tab_nav">&nbsp;</td><td id="Tab4" class="tab"><a href="<?php echo site_url("member/member/member_list2")?>">会员列表</a></td>
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
<form action="<?php echo site_url('member/vip/search');?>" method="post">
<input type="hidden" name="action" value="vip_list2">
<div class="tt">VIP搜索</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tbody><tr>
<td>&nbsp;
<select name="fields">
<option value="0" selected="selected">按条件</option>
<option value="1">公司名</option>
<option value="2">会员名</option>
</select>&nbsp;
<input type="text" size="30" name="kw" value="" title="关键词">&nbsp;
<select name="order">
<option value="0" selected="selected">结果排序方式</option>
<option value="1">服务开始降序</option>
<option value="2">服务开始升序</option>
<option value="3">服务结束降序</option>
<option value="4">服务结束升序</option>
<option value="5">VIP指数降序</option>
<option value="6">VIP指数升序</option>
<option value="7">会员ID降序</option>
<option value="8">会员ID升序</option>
</select>&nbsp;
<input type="text" name="psize" size="2" class="t_c" value="20" title="条/页" onblur="var pattern=/^\d+$/; if(!pattern.test(this.value)){alert('会员ID只能为数字');}">
<input type="submit" value="搜 索" class="btn">&nbsp;
<input type="reset" value="重 置" class="btn">
</td>
</tr>
<tr>
<td>&nbsp;
<select name="timetype">
<option value="fromtime" selected="">开通时间</option>
<option value="totime">到期时间</option>
</select>&nbsp;
<script type="text/javascript" src="<?php echo base_url('skin/js/calendar.js');?>"></script>
<input type="text" name="dfromtime" id="dfromtime" value="" size="10" onfocus="ca_show('dfromtime', this, '-');" readonly="" ondblclick="this.value='';"> 
<img src="<?php echo base_url('skin/images/calendar.gif');?>" align="absmiddle" onclick="ca_show('dfromtime', this, '-');" style="cursor:pointer;"> 至 
<input type="text" name="dtotime" id="dtotime" value="" size="10" onfocus="ca_show('dtotime', this, '-');" readonly="" ondblclick="this.value='';"> 
<img src="<?php echo base_url("skin/images/calendar.gif");?>" align="absmiddle" onclick="ca_show('dtotime', this, '-');" style="cursor:pointer;">&nbsp;

<select name="vip">
<option value="0">VIP指数</option>
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
会员名：<input type="text" name="username" value="" size="8">&nbsp;
会员ID：<input type="text" name="uid" value="" size="4">
</td>
</tr>
</tbody></table>
</form>
<form method="post">
<div class="tt">VIP管理</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tbody>
<tr>
<th width="25"><input type="checkbox" onclick="checkall(this.form);"></th>
<th>会员ID</th>
<th>公司名称</th>
<th>会员名</th>
<th>会员组</th>
<th>开通时间</th>
<th>到期时间</th>
<th>VIP指数</th>
<th>理论值</th>
<th>修正值</th>
<th>管理</th>
</tr>
<?php foreach ($vip_list as $v){?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center" title="会员名:<?php echo $v['username']."\r\n";?>VIP指数:<?php echo $v['vip'];?>">
<td><input type="checkbox" name="userid[]" value="<?php echo $v['userid'];?>"></td>
<td><?php echo $v['userid'];?></td>
<td align="left">&nbsp;<a href="#" target="_blank"><?php echo $v['company'];?></a></td>
<td><?php echo $v['username'];?></td>
<td>VIP会员</td>
<td><?php echo date('Y-m-d H:i:s',$v['fromtime']);?></td>
<td><?php echo date('Y-m-d H:i:s',$v['totime']);?></td>
<td><img src="<?php echo base_url("skin/images/vip_{$v['vip']}.gif");?>"></td>
<td><?php echo $v['vipt'];?></td>
<td><?php echo $v['vipr'];?></td>
<td>
<a href="<?php echo site_url("member/vip/vip_edit2/{$v['userid']}");?>"><img src="<?php echo base_url("skin/images/edit.png");?>" width="16" height="16" title="修改会员[<?php echo $v['username'];?>]资料" alt=""></a>&nbsp;
<a href="<?php echo site_url("member/member/get_detail/{$v['username']}");?>"><img src="<?php echo base_url("skin/images/view.png");?>" width="16" height="16" title="会员[<?php echo $v['username'];?>]详细资料" alt=""></a>&nbsp;
<a href="<?php echo site_url("member/member/login/{$v['userid']}/{$v['username']}")?>" target="_blank"><img src="<?php echo base_url("skin/images/set.png");?>" width="16" height="16" title="进入会员商务中心" alt=""></a>&nbsp;
</tr>
<?php }?>

</tbody></table>
<div class="btns">
<input type="submit" value=" 撤销VIP " class="btn" onclick="if(confirm('确定要撤销选中公司VIP资格吗吗？')){this.form.action='<?php echo site_url('member/vip/repeal');?>'}else{return false;}">&nbsp;
</div>
</form>
<div class="pages">
	<?php echo $pages;?>
	&nbsp;<cite>共<?php echo $vip_count?>条/<?php echo $total_page?>页</cite>&nbsp;
	<input type="text" class="pages_inp" id="destoon_pageno" value="1" onkeydown="if(event.keyCode==13 && this.value && this.value>=1 && this.value<=<?php echo $total_page?>) {var page_size=<?php echo $page_size?>;var page=(this.value-1)*page_size;window.location.href='<?php echo substr($base_url,0,-5)?>/'+page;return false;}"> 
	<input type="button" class="pages_btn" value="GO" onclick="if(Dd('destoon_pageno').value>=1 && Dd('destoon_pageno').value<=<?php echo $total_page?>){var page_size=<?php echo $page_size?>;var page=(Dd('destoon_pageno').value-1)*page_size;window.location.href='<?php echo substr($base_url,0,-5)?>/'+page;}else{Dmsg('页码不正确，请重填', 'go');}"><span id="dgo" class="f_red"></span>
</div>
<div class="tt">名词解释</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tbody><tr>
<td class="tl">VIP指数</td>
<td class="f_gray">VIP指数，是对VIP会员的综合评分的一组1-10的数字，是理论值和修正值之和。指数越大，会员的级别、实力、可信度等越高，信息排名越靠前</td>
</tr>
<tr>
<td class="tl">理论值</td>
<td class="f_gray">理论值是由系统根据管理员设置的评分标准计算出的VIP指数值</td>
</tr>
<tr>
<td class="tl">修正值</td>
<td class="f_gray">为了消除理论值与会员实际综合实力的误差，由管理员进行人工干预的数值，可为正数，也可为负数</td>
</tr>
</tbody></table>
<script type="text/javascript">Menuon(1);</script>

</body></html>