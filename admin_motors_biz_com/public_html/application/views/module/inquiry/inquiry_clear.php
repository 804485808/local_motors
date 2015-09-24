<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>信件清理</title>
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
</div><div class="tt">站内询单清理<?php echo $class?></div>
<form method="post" action="<?php echo site_url("module/inquiry/inquiry_clear2")?>">
<input type="hidden" name="file" value="inquiry">
<input type="hidden" name="action" value="clear">
<table cellpadding="2" cellspacing="1" class="tb">
<tbody>
<tr>
<td class="tl">日期范围</td>
<td>
<script type="text/javascript" src="<?php echo base_url("skin/js/calendar.js")?>"></script>
<input type="text" name="fromdate" id="messagefromdate" value="" size="10" onfocus="ca_show(&#39;messagefromdate&#39;, this, &#39;-&#39;);" readonly="" ondblclick="this.value=&#39;&#39;;">
 <img src="<?php echo base_url("skin/images/calendar.gif")?>" align="absmiddle" onclick="ca_show(&#39;messagefromdate&#39;, this, &#39;-&#39;);" style="cursor:pointer;"> 
 至 <input type="text" name="todate" id="messagetodate" value="" size="10" onfocus="ca_show(&#39;messagetodate&#39;, this, &#39;-&#39;);" readonly="" ondblclick="this.value=&#39;&#39;;"> 
 <img src="<?php echo base_url("skin/images/calendar.gif")?>" align="absmiddle" onclick="ca_show(&#39;messagetodate&#39;, this, &#39;-&#39;);" style="cursor:pointer;"> 不指定表示不限
</td>
</tr>
<tr>
<td class="tl">选项</td>
<td>
<input type="checkbox" value="1" name="status" checked="checked"> 保留未审核询单
</td>
</tr>
</tbody>
</table>
<div class="sbt"><input type="submit" name="submit" value=" 清 理 " class="btn" onclick="if(!confirm(&#39;确定要清理吗？此操作将不可撤销&#39;)) return false;">&nbsp;&nbsp;&nbsp;&nbsp;
<input type="reset" name="reset" value=" 重 置 " class="btn"></div>
</form>
<script type="text/javascript">Menuon(4);</script>

</body></html>