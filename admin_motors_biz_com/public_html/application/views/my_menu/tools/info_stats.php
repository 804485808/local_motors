<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>信息统计</title>
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
<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody><tr>
<td valign="bottom">
<table cellpadding="0" cellspacing="0">
<tbody><tr>
<td width="10">&nbsp;</td>
<td id="Tab0" class="tab_on"><a href="<?php echo site_url("my_menu/tools/info_stats")?>">信息统计</a></td><td class="tab_nav">&nbsp;</td></tr>
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
<!--<form action="">
<div class="tt">统计报表</div>
<input type="hidden" name="file" value="count">
<input type="hidden" name="action" value="">
<input type="hidden" name="itemid" value="0">
<table cellpadding="2" cellspacing="1" class="tb">
<tbody><tr>
<td>&nbsp;
<select name="mid">
<option value="2">会员</option>
<option value="16">商城</option>
<option value="5">供应</option>
<option value="6">求购</option>
<option value="7">行情</option>
<option value="17">团购</option>
<option value="8">展会</option>
<option value="9">人才</option>
<option value="13">品牌</option>
<option value="10">知道</option>
<option value="11">专题</option>
<option value="12">图库</option>
<option value="14">视频</option>
<option value="15">下载</option>
<option value="21">资讯</option>
<option value="22">招商</option>
</select>&nbsp;
<select name="year">
<option value="0">选择年</option>
<option value="2013" selected="">2013年</option>
<option value="2012">2012年</option>
<option value="2011">2011年</option>
<option value="2010">2010年</option>
<option value="2009">2009年</option>
<option value="2008">2008年</option>
<option value="2007">2007年</option>
<option value="2006">2006年</option>
<option value="2005">2005年</option>
<option value="2004">2004年</option>
<option value="2003">2003年</option>
<option value="2002">2002年</option>
<option value="2001">2001年</option>
<option value="2000">2000年</option>
</select>&nbsp;
<select name="month">
<option value="0">选择月</option>
<option value="1">1月</option>
<option value="2">2月</option>
<option value="3">3月</option>
<option value="4">4月</option>
<option value="5">5月</option>
<option value="6">6月</option>
<option value="7">7月</option>
<option value="8">8月</option>
<option value="9">9月</option>
<option value="10">10月</option>
<option value="11">11月</option>
<option value="12">12月</option>
</select>&nbsp;
<input type="submit" value="生成报表" class="btn">&nbsp;
<input type="button" value="重 置" class="btn" onclick="Go(&#39;?file=count&amp;action=&amp;mid=0&amp;itemid=0&#39;);">
</td>
</tr>
</tbody></table>
</form>-->
<div class="tt">统计概况</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tbody>

<tr>
<td class="tl"><a href="<?php echo site_url("member/member/member_list2")?>" class="t">会员</a></td>
<td width="10%">&nbsp;<a href="<?php echo site_url("member/member/member_list2")?>"><span id="member"><?php echo $stats['member_total']?></span></a></td>
<td class="tl"><a href="<?php echo site_url("member/member/member_online2")?>" class="t">在线会员</a></td>
<td width="10%">&nbsp;<a href="<?php echo site_url("member/member/member_online2")?>"><span id="member_check"><?php echo $stats['member_online']?></span></a></td>
<td class="tl"><a href="<?php echo site_url("member/company/company_list2")?>" class="t">公司</a></td>
<td width="10%">&nbsp;<a href="<?php echo site_url("member/company/company_list2")?>"><span id="member"><?php echo $stats['company_total']?></span></a></td>
<td class="tl"><span class="t">今日新增</span></td>
<td width="10%">&nbsp;<span id="member_new"><?php echo $stats['member_add']?></span></td>
</tr>

<tr>
<td class="tl"><span class="t">供应</span></td>
<td>&nbsp;<span id="m_5"><?php echo $stats['sell_total']?></span></td>
<td class="tl"><a href="<?php echo site_url("module/sell/sell_list2")?>" class="t">已发布</a></td>
<td>&nbsp;<a href="<?php echo site_url("module/sell/sell_list2")?>"><span id="m_5_1"><?php echo $stats['sell_published']?></span></a></td>
<td class="tl"><a href="<?php echo site_url("module/sell/unapproved_sell2")?>" class="t">待审核</a></td>
<td>&nbsp;<a href="<?php echo site_url("module/sell/unapproved_sell2")?>"><span id="m_5_2"><strong class="f_red"><?php echo $stats['sell_unapproved']?></strong></span></a></td>
<td class="tl"><span class="t">今日新增</span></td>
<td>&nbsp;<span id="m_5_3"><?php echo $stats['sell_add']?></span></td>
</tr>

<tr>
<td class="tl"><a href="<?php echo site_url("module/inquiry/inquiry_list2")?>" class="t">询单</a></td>
<td>&nbsp;<a href="<?php echo site_url("module/inquiry/inquiry_list2")?>"><span id="m_5"><?php echo $stats['inquiry_total']?></span></a></td>
<td class="tl"><a href="<?php echo site_url("module/inquiry/unapproved_list2")?>" class="t">待审核</a></td>
<td>&nbsp;<a href="<?php echo site_url("module/inquiry/unapproved_list2")?>"><span id="m_5_2"><strong class="f_red"><?php echo $stats['inquiry_unapproved']?></strong></span></a></td>
<td class="tl"><a href="<?php echo site_url("module/inquiry/unassign_list")?>" class="t">待分配</a></td>
<td>&nbsp;<a href="<?php echo site_url("module/inquiry/unassign_list")?>"><span id="m_5_2"><strong class="f_red"><?php echo $stats['inquiry_unassigned']?></strong></span></a></td>
<td class="tl"><span class="t">今日新增</span></td>
<td>&nbsp;<span id="m_5_3"><?php echo $stats['inquiry_add']?></span></td>
</tr>

<tr>
<td class="tl">业务员</td>
<td>&nbsp;<span id="m_5"><?php echo $stats['salesman_total']?></span></td>
<td class="tl"><a href="<?php echo site_url("module/inquiry/unfinished_list")?>" class="t">待联系的询单</a></td>
<td>&nbsp;<a href="<?php echo site_url("module/inquiry/unfinished_list")?>"><span id="m_5_2"><strong class="f_red"><?php echo $stats['inquiry_unnoticed']?></strong></span></a></td>
<td class="tl"><a href="<?php echo site_url("module/inquiry/rejected_list")?>" class="t">联系被拒的询单</a></td>
<td>&nbsp;<a href="<?php echo site_url("module/inquiry/rejected_list")?>"><span id="m_5_2"><strong class="f_red"><?php echo $stats['inquiry_rejected']?></strong></span></a></td>
<td class="tl"><a href="<?php echo site_url("module/inquiry/finished_list1")?>" class="t">已联系(有意向)的询单</a></td>
<td>&nbsp;<a href="<?php echo site_url("module/inquiry/finished_list1")?>"><span id="m_5_2"><strong class="f_red"><?php echo $stats['inquiry_finished1']?></strong></span></a></td>
</tr>

<tr>
<td class="tl"><a href="<?php echo site_url("my_menu/area/area_list")?>" class="t">地区</a></td>
<td>&nbsp;<a href="<?php echo site_url("my_menu/area/area_list")?>"><span id="m_5"><?php echo $stats['area_total']?></span></a></td>
<td class="tl">管理员</td>
<td>&nbsp;<span id="m_5_2"><?php echo $stats['manager_total']?></span></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
</tbody></table>
<script type="text/javascript">Menuon(0);</script>
<script type="text/javascript" src="<?php echo base_url("skin/js/admin.js")?>"></script>

</body></html>