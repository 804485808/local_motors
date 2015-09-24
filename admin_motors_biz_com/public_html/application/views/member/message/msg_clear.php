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
<td id="Tab0" class="tab"><a href="<?php echo site_url("member/message/msg_send2")?>">发送信件</a></td><td class="tab_nav">&nbsp;</td>
<td id="Tab1" class="tab"><a href="<?php echo site_url("member/message/msg_list2")?>">会员信件</a></td><td class="tab_nav">&nbsp;</td>
<td id="Tab2" class="tab"><a href="<?php echo site_url("member/message/msg_system2")?>">系统信件</a></td><td class="tab_nav">&nbsp;</td>
<td id="Tab4" class="tab_on"><a href="<?php echo site_url("member/message/msg_clear2")?>">信件清理</a></td><td class="tab_nav">&nbsp;</td></tr>
</tbody></table>
</td>
<td width="110"><div>
<img src="<?php echo base_url("skin/images/spacer.gif")?>" width="40" height="24" title="刷新" onclick="window.location.reload();" style="cursor:pointer;" alt="">
<img src="<?php echo base_url("skin/images/spacer.gif")?>" width="20" height="24" title="后退" onclick="history.back(-1);" style="cursor:pointer;" alt="">
<img src="<?php echo base_url("skin/images/spacer.gif")?>" width="20" height="24" title="前进" onclick="history.go(1);" style="cursor:pointer;" alt="">
<img src="<?php echo base_url("skin/images/spacer.gif")?>" width="20" height="24" title="帮助" onclick="" style="cursor:help;" alt=""></div></td>
</tr>
</tbody></table>
</div><div class="tt">站内信件清理</div>
<form method="post" action="<?php echo site_url("member/message/msg_clear2")?>">
<input type="hidden" name="file" value="message">
<input type="hidden" name="action" value="clear">
<table cellpadding="2" cellspacing="1" class="tb">
<tbody><tr>
<td class="tl">信件(默认是全部)</td>
<td>
<input type="radio" value="1" name="status"> 已发送
<input type="radio" value="2" name="status"> 草稿箱
<input type="radio" value="0" name="status"> 垃圾箱
</td>
</tr>
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
<input type="checkbox" value="1" name="unread" checked="checked"> 保留未读信件
</td>
</tr>
</tbody>
</table>
<div class="sbt"><input type="submit" name="submit" value=" 清 理 " class="btn" onclick="if(!confirm(&#39;确定要清理吗？此操作将不可撤销&#39;)) return false;">&nbsp;&nbsp;&nbsp;&nbsp;
<input type="reset" name="reset" value=" 重 置 " class="btn"></div>
</form>
<script type="text/javascript">Menuon(4);</script>

</body></html>