<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>基本设置</title>
<meta name="robots" content="noindex,nofollow">
<script type="text/javascript">window.onerror= function(){return true;}</script>
<link rel="stylesheet" href="<?php echo base_url("skin/css/style.css")?>" type="text/css">
<script type="text/javascript" src="<?php echo base_url("skin/js/lang.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/config.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/jquery.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/common.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/admin.js")?>"></script>
<script type="text/javascript">
function selectit(){
	$("#url_suffixid").find("option").eq('<?php echo $url_suffix?>').attr("selected","selected"); 
};
</script>
</head>
<body onload="selectit()">
<div id="msgbox" onmouseover="closemsg();" style="display:none;"></div>
<div class="menu" onselectstart="return false" id="destoon_menu">
<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody><tr>
<td valign="bottom">
<table cellpadding="0" cellspacing="0">
<tbody><tr><td width="10">&nbsp;</td>
<td id="Tab0" class="tab_on"><a href="<?php echo site_url("my_menu/setting/base_set")?>">基本设置</a></td><td class="tab_nav">&nbsp;</td>
<td id="Tab5" class="tab"><a href="<?php echo site_url("my_menu/setting/mail")?>">邮件发送</a></td><td class="tab_nav">&nbsp;</td>
</tr>
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

<div id="Tabs0">
<div class="tt">基本设置</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tbody>
<form method="post" action="<?php echo site_url("my_menu/setting/save_setting")?>">
<input type="hidden" name="act" value="set_site">
<tr>
<td class="tl">网站名称</td>
<td><input name="site[site_name]" type="text" value="<?php echo $site['site_name']?>" size="40"></td>
</tr>

<tr>
<td class="tl">网站地址</td>
<td><input name="site[main_domain]" type="text" value="<?php echo $site['main_domain']?>" size="40">
 <img src="<?php echo base_url("skin/images/help.png")?>" width="11" height="11" title="请添写完整URL地址,例如<?php echo $site['main_domain']?><br/>注意以 / 结尾" alt="tips" class="c_p" onclick="Dconfirm(this.title, '', 450);"></td>
</tr>

<tr>
<td class="tl">销售域名</td>
<td><input name="site[sell_domain]" type="text" value="<?php echo $site['sell_domain']?>" size="40"></td>
</tr>

<tr>
<td class="tl">公司域名</td>
<td><input name="site[company_domain]" type="text" value="<?php echo $site['company_domain']?>" size="40">
<input type="hidden" name="site[sphinx_host]" value="<?php echo $site['sphinx_host']?>"></td>
</tr>

<tr>
<td class="tl">图片域名</td>
<td><input name="site[image_domain]" type="text" value="<?php echo $site['image_domain']?>" size="40"></td>
</tr>

<tr>
<td class="tl">联系人</td>
<td><input name="site[linkman]" type="text" value="<?php echo $site['linkman']?>" size="40"></td>
</tr>

<tr>
<td class="tl">客服电话</td>
<td><input name="site[tel]" type="text" value="<?php echo $site['tel']?>" size="20"></td>
</tr>

<tr>
<td class="tl">联系邮箱</td>
<td><input name="site[email]" type="text" value="<?php echo $site['email']?>" size="40"></td>
</tr>

<tr>
<td class="tl">联系QQ</td>
<td><input name="site[qq]" type="text" value="<?php echo $site['qq']?>" size="40"></td>
</tr>

<tr>
<td class="tl">对应公司子网站主域名</td>
<td><input name="site[site_url]" type="text" value="<?php echo $site['site_url']?> " size="40"></td>
</tr>

<tr>
<td class="tl">网站config目录</td>
<td><input name="image[site_file]" type="text" value="<?php echo $site_file;?> " size="40"></td>
</tr>

<tr>
<td class="tl">管理员后台config目录</td>
<td><input name="image[admin_site_file]" type="text" value="<?php echo $admin_site_file;?> " size="40"></td>
</tr>

<tr>
<td class="tl"></td>
<td><input type="submit" name="submit" value="确 定" class="btn">&nbsp;&nbsp;&nbsp;&nbsp;
<input type="button" value="重置" id="ShowAll" class="btn" onclick="this.form.reset();" title="重置所有选项"></td>
</tr>
</form>

<form method="post" action="<?php echo site_url("my_menu/setting/save_setting")?>">
<input type="hidden" name="act" value="set_image">
<tr>
<td class="tl">图片上传路径</td>
<td><input name="image[img_rootpath]" type="text" value="<?php echo $img_rootpath?>" size="40"></td>
</tr>

<tr>
<td class="tl">图片最大尺寸</td>
<td><input name="image[max_size]" type="text" value="<?php echo $max_size?> " size="20"></td>
</tr>

<tr>
<td class="tl">图片最大高度</td>
<td><input name="image[max_height]" type="text" value="<?php echo $max_height?> " size="20"></td>
</tr>

<tr>
<td class="tl">图片最大宽度</td>
<td><input name="image[max_width]" type="text" value="<?php echo $max_width?> " size="20"></td>
</tr>

<tr>
<td class="tl"></td>
<td><input type="submit" name="submit" value="确 定" class="btn">&nbsp;&nbsp;&nbsp;&nbsp;
<input type="button" value="重置" id="ShowAll" class="btn" onclick="this.form.reset();" title="重置所有选项"></td>
</tr>
</form>

<form method="post" action="<?php echo site_url("my_menu/setting/save_setting")?>">
<input type="hidden" name="act" value="set_others">
<!-- <tr>
<td class="tl">网站LOGO</td>
<td><input name="setting[logo]" type="text" value="" id="logo" size="58"> 
<span onclick="Dthumb(1,180,60, Dd('logo').value, 0, 'logo');" class="jt">[上传]</span>&nbsp;&nbsp;
<span onclick="if(Dd('logo').value){Dd('showlogo').src=Dd('logo').value;}" class="jt">[预览]</span>&nbsp;&nbsp;
<span onclick="Dd('logo').value='';Dd('showlogo').src='../../skin/default/image/logo.gif';" class="jt">[删除]</span><br>
<a href="< ?php echo $site['main_domain']?>" target="_blank">
<img src="< ?php echo base_url("skin/images/logo.png")?>" style="margin:2px;" id="showlogo"></a></td>
</tr>

<tr>
<td class="tl">网站状态</td>
<td>
<input type="radio" name="setting[close]" value="0" checked="" onclick="Dh('dclose');"> 开启&nbsp;&nbsp;
<input type="radio" name="setting[close]" value="1" onclick="Ds('dclose');"> 关闭
</td>
</tr>
<tr id="dclose" style="display:none">
<td class="tl">关闭原因</td>
<td><textarea name="setting[close_reason]" id="close_reason" style="width:500px;height:50px;overflow:visible;">网站维护中，请稍候访问...</textarea><br>支持HTML语法，网站关闭不影响后台管理
</td> 
</tr>

<tr>
<td class="tl">404错误日志</td>
<td>
<input type="radio" name="setting[log_404]" value="1"> 开启&nbsp;&nbsp;
<input type="radio" name="setting[log_404]" value="0" checked=""> 关闭&nbsp;&nbsp;
<a href="javascript:Dwidget('?file=404', '404错误日志');" class="t">[查看日志]</a>
 <img src="<?php echo base_url("skin/images/help.png")?>" width="11" height="11" title="开启404日志有利于分析站内死链接和用户或搜索引擎蜘蛛的错误记录<br/>同时需要设置站点的404页面至网站根目录404.php" alt="tips" class="c_p" onclick="Dconfirm(this.title, '', 450);"></td>
</tr>-->

<tr>
<td class="tl">网站默认语言</td>
<td>
<select name="config[language]">
<option value="zh-cn" <?php echo $language=='zh-cn'?"selected":"";?>>简体中文</option>
<option value="english" <?php echo $language=='english'?"selected":"";?>>英文</option>
</select></td> 
</tr>

<tr>
<td class="tl">生成文件扩展名</td>
<td>
<select name="config[url_suffix]" id="url_suffixid">
<option value=".html">.html</option>
<option value=".htm">.htm</option>
<option value=".shtm">.shtm</option>
<option value=".shtml">.shtml</option>
</select>
</td>
</tr>

<tr>
<td class="tl"></td>
<td><input type="submit" name="submit" value="确 定" class="btn">&nbsp;&nbsp;&nbsp;&nbsp;
<input type="button" value="重置" id="ShowAll" class="btn" onclick="this.form.reset();" title="重置所有选项"></td>
</tr>
</form>
</tbody>
</table>
</body></html>