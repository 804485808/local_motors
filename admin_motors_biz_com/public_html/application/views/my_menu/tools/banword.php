<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>词语过滤</title>
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
<td id="Tab0" class="tab_on"><a href="admin(2).htm">词语过滤</a></td><td class="tab_nav">&nbsp;</td></tr>
</tbody></table>
</td>
<td width="110"><div>
<img src="<?php echo base_url("skin/images/spacer.gif")?>" width="40" height="24" title="刷新" onclick="window.location.reload();" style="cursor:pointer;" alt="">
<img src="<?php echo base_url("skin/images/spacer.gif")?>" width="20" height="24" title="后退" onclick="history.back(-1);" style="cursor:pointer;" alt="">
<img src="<?php echo base_url("skin/images/spacer.gif")?>" width="20" height="24" title="前进" onclick="history.go(1);" style="cursor:pointer;" alt="">
<img src="<?php echo base_url("skin/images/spacer.gif")?>" width="20" height="24" title="帮助" onclick="" style="cursor:help;" alt=""></div></td>
</tr>
</tbody></table>
</div><form action="">
<div class="tt">词语搜索</div>
<input type="hidden" name="file" value="banword">
<table cellpadding="2" cellspacing="1" class="tb">
<tbody><tr>
<td>&nbsp;
<input type="text" size="50" name="kw" value="" title="关键词">&nbsp;
<input type="text" name="psize" value="20" size="2" class="t_c" title="条/页">
<input type="submit" value="搜 索" class="btn">&nbsp;
<input type="button" value="重 置" class="btn" onclick="Go(&#39;?file=banword&#39;);">
</td>
</tr>
</tbody></table>
</form>
<script type="text/javascript">
var _del = 0;
</script>
<form method="post" action="">
<input type="hidden" name="file" value="banword">
<div class="tt">词语管理</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tbody><tr>
<th width="60"><input type="checkbox" onclick="checkall(this.form);"></th>
<th>查找词语</th>
<th>替换为</th>
<th width="120">拦截</th>
</tr>
<tr onmouseover="this.className=&#39;on&#39;;" onmouseout="this.className=&#39;&#39;;" align="center">
<td class="f_red">新增</td>
<td><textarea name="post[0][replacefrom]" rows="10" cols="40"></textarea></td>
<td><textarea name="post[0][replaceto]" rows="10" cols="40"></textarea></td>
<td>
<input name="post[0][deny]" type="radio" value="1"> 是
<input name="post[0][deny]" type="radio" value="0" checked=""> 否
</td>
</tr>
<tr>
<td> </td>
<td height="30" colspan="3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="submit" value="更 新" onclick="if(_del &amp;&amp; !confirm(&#39;提示:您选择删除&#39;+_del+&#39;个词语？确定要删除吗？&#39;)) return false;" class="btn">&nbsp;&nbsp;<input type="submit" name="submit" value="删除选中" onclick="if(_del &amp;&amp; !confirm(&#39;提示:您选择删除&#39;+_del+&#39;个词语？确定要删除吗？&#39;)) return false;" class="btn"></td>
</tr>
<tr>
<td colspan="4"><div class="pages"></div></td>
</tr>
<tr>
<td> </td>
<td colspan="3">
&nbsp;&nbsp;1、批量添加时，查找和替换词语一行一个，互相对应<br>
&nbsp;&nbsp;2、如果选择拦截，则匹配到查找词语时直接提示，拒绝提交<br>
&nbsp;&nbsp;3、例如“您*好”格式，可替换“您好”之间的干扰字符<br>
&nbsp;&nbsp;4、为不影响程序效率，请不要设置过多过滤内容<br>
&nbsp;&nbsp;5、过滤仅对前台会员提交信息生效，后台不受限制<br>
</td>
</tr>
</tbody></table>
</form>
<script type="text/javascript">Menuon(0);</script>

</body></html>