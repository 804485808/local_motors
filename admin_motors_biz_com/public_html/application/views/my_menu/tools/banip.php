<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ip禁止</title>
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
<td id="Tab0" class="tab_on"><a href="admin(2).htm">IP禁止</a></td><td class="tab_nav">&nbsp;</td><td id="Tab1" class="tab"><a href="">清空过期</a></td><td class="tab_nav">&nbsp;</td><td id="Tab2" class="tab"><a href="">登录锁定</a></td><td class="tab_nav">&nbsp;</td></tr>
</tbody></table>
</td>
<td width="110"><div>
<img src="<?php echo base_url("skin/images/spacer.gif")?>" width="40" height="24" title="刷新" onclick="window.location.reload();" style="cursor:pointer;" alt="">
<img src="<?php echo base_url("skin/images/spacer.gif")?>" width="20" height="24" title="后退" onclick="history.back(-1);" style="cursor:pointer;" alt="">
<img src="<?php echo base_url("skin/images/spacer.gif")?>" width="20" height="24" title="前进" onclick="history.go(1);" style="cursor:pointer;" alt="">
<img src="<?php echo base_url("skin/images/spacer.gif")?>" width="20" height="24" title="帮助" onclick="" style="cursor:help;" alt=""></div></td>
</tr>
</tbody></table>
</div><div class="tt">IP禁止</div>
<form action="" method="post">
<input type="hidden" name="file" value="banip">
<input type="hidden" name="action" value="add">
<table cellpadding="2" cellspacing="1" class="tb">
<tbody><tr>
<td>&nbsp;
IP地址/段 <input type="text" size="30" name="ip">&nbsp;
有效期至 <script type="text/javascript" src="<?php echo base_url("skin/js/calendar.js")?>"></script><input type="text" name="todate" id="todate" value="" size="10" onfocus="ca_show(&#39;todate&#39;, this, &#39;-&#39;);" readonly="" ondblclick="this.value=&#39;&#39;;"> <img src="<?php echo base_url("skin/images/calendar.gif")?>" align="absmiddle" onclick="ca_show(&#39;todate&#39;, this, &#39;-&#39;);" style="cursor:pointer;">&nbsp;
<input type="submit" value="添 加" class="btn">&nbsp;
</td>
</tr>
<tr>
<td>
&nbsp;1、IP禁止仅对网站前台生效，建议不要添加过多，以免影响程序效率<br>
&nbsp;2、支持禁用IP段，例如填192.168.*.*将禁用所有192.168开头的IP<br>
&nbsp;3、有效期不填表示永久禁用<br>
</td>
</tr>
</tbody></table>
</form>
<form method="post">
<div class="tt">禁止列表</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tbody><tr>
<th width="25"><input type="checkbox" onclick="checkall(this.form);"></th>
<th>IP地址/段</th>
<th>地区</th>
<th>有效期至</th>
<th>状态</th>
<th>操作人</th>
<th>禁止时间</th>
<th width="25"></th>
</tr>
</tbody></table>
<div class="btns">
<input type="submit" value=" 批量删除 " class="btn" onclick="if(confirm(&#39;确定要删除选中记录吗？此操作将不可撤销&#39;)){this.form.action=&#39;?file=banip&amp;action=delete&#39;}else{return false;}">
</div>
</form>
<div class="pages"></div>
<script type="text/javascript">Menuon(0);</script>

</body></html>