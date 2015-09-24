<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>添加单页</title>
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
<td id="Tab0" class="tab_on"><a href="<?php echo site_url("my_menu/single_page/add_page")?>">添加单页</a></td><td class="tab_nav">&nbsp;</td>
<td id="Tab1" class="tab"><a href="<?php echo site_url("my_menu/single_page/page_list")?>">单页列表</a></td><td class="tab_nav">&nbsp;</td>
<td id="Tab2" class="tab"><a href="<?php echo site_url("my_menu/single_page/create_page")?>">生成单页</a></td><td class="tab_nav">&nbsp;</td>
</tr></tbody></table>
</td>
<td width="110"><div>
<img src="<?php echo base_url("skin/images/spacer.gif")?>" title="刷新" onclick="window.location.reload();" style="cursor:pointer;" alt="" height="24" width="40">
<img src="<?php echo base_url("skin/images/spacer.gif")?>" title="后退" onclick="history.back(-1);" style="cursor:pointer;" alt="" height="24" width="20">
<img src="<?php echo base_url("skin/images/spacer.gif")?>" title="前进" onclick="history.go(1);" style="cursor:pointer;" alt="" height="24" width="20">
<img src="<?php echo base_url("skin/images/spacer.gif")?>" title="帮助" onclick="" style="cursor:help;" alt="" height="24" width="20"></div></td>
</tr>
</tbody></table>
</div><form method="post" action="<?php echo site_url("my_menu/single_page/save_page")?>" id="dform" onsubmit="return check();">
<input name="file" value="webpage" type="hidden">
<input name="action" value="add" type="hidden">
<input name="itemid" value="0" type="hidden">
<div class="tt">添加单页</div>
<table class="tb" cellpadding="2" cellspacing="1">
<tbody><tr>
<td class="tl"><span class="f_red">*</span> 单页标题</td>
<td><input name="post[title]" id="title" size="50" type="text"> 
<script type="text/javascript" src="<?php echo base_url("skin/js/color.js")?>"></script>
<style type="text/css">.color_div_o {width:16px;height:16px;padding:4px 0 0 4px;background:#B6BDD2;cursor:crosshair;}.color_div_t {width:16px;height:16px;padding:4px 0 0 4px;background:#F1F2F3;}.color_div {border:#808080 1px solid;width:10px;height:10px;line-height:10px;font-size:1px;}</style>
<input name="post[style]" id="color_input_1" value="" type="hidden">
<img src="<?php echo base_url("skin/images/color.gif")?>" id="color_img_1" style="cursor:pointer;background:" onclick="color_show(1, Dd('color_input_1').value, this);" height="18" align="absmiddle" width="21">&nbsp; 
<select name="post[level]"><option selected="selected" value="0">级别</option><option value="1">1 级</option><option value="2">2 级</option><option value="3">3 级</option>
<option value="4">4 级</option><option value="5">5 级</option><option value="6">6 级</option><option value="7">7 级</option>
<option value="8">8 级</option><option value="9">9 级</option></select> &nbsp;<br>
<span id="dtitle" class="f_red"></span></td>
</tr>
<tr id="link">
<td class="tl"><span class="f_red">*</span> 链接地址<br/>(即文件名，如:xx.php)</td>
<td><input name="post[linkurl]" id="linkurl" size="100" type="text" value=""> 
<span id="dlinkurl" class="f_red"></span></td>
</tr>
</tbody><tbody id="basic" style="display:;">
<tr>
<td class="tl"><span class="f_hid">*</span> 单页内容</td>
<td>
<textarea name="post[content]" rows="20" cols="100" id="content"></textarea>
</td>
</tr>
<!-- <tr>
<td class="tl"><span class="f_hid">*</span> 保存路径</td>
<td><input name="post[filepath]" size="20" value="about/" type="text"> <span class="f_gray">如不填写则生成在网站根目录，否则请以‘/’结尾，例如‘about/’</span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 文件名称</td>
<td><input name="post[filename]" size="20" type="text"> <span class="f_gray">如不填写则自动按ID生成文件名，例如‘page-1.html’</span></td>
</tr> -->
<tr>
<td class="tl"><span class="f_hid">*</span> 绑定域名</td>
<td><input name="post[domain]" size="60" type="text"> <img src="<?php echo base_url("skin/images/help.png")?>" title="例如设置的生成路径为machine/index.html&lt;br/&gt;那么可以绑定machine.xxx.com至machine目录&lt;br/&gt;此处填写http://machine.xxx.com/" alt="tips" class="c_p" onclick="Dconfirm(this.title, '', 450);" height="11" width="11"></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> SEO标题</td>
<td><input name="post[seo_title]" size="60" type="text"></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> SEO关键词</td>
<td><input name="post[seo_keywords]" size="60" type="text"></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> SEO描述</td>
<td><input name="post[seo_description]" size="60" type="text"></td>
</tr>
</tbody>
<tbody><tr>
<td class="tl"><span class="f_hid">*</span> 分组标识</td>
<td><input name="post[item]" size="10" value="1" type="text"> <img src="<?php echo base_url("skin/images/help.png")?>" title="单页的分组标识，如果不理解含义，请勿修改" alt="tips" class="c_p" onclick="Dconfirm(this.title, '', 450);" height="11" width="11"></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 内容模板</td>
<td><span id="destoon_template_1"><select name="post[template]"><option selected="selected" value="">默认模板</option></select></span>&nbsp;&nbsp;<a href="javascript:tpl_edit('webpage',%20'extend',%201);" class="t">[修改]</a> &nbsp;<a href="javascript:tpl_add('webpage',%20'extend');" class="t">[新建]</a></td>
</tr>
</tbody></table>
<div class="sbt"><input name="submit" value=" 确 定 " class="btn" type="submit">&nbsp;&nbsp;&nbsp;&nbsp;<input name="reset" value=" 重 置 " class="btn" type="reset"></div>
</form>
<script type="text/javascript" src="<?php echo base_url("skin/js/clear.js")?>"></script>
<script type="text/javascript">
function check() {
	var l;
	var f;
	f = 'title';
	l = Dd(f).value.length;
	if(l < 2) {
		Dmsg('标题最少2字，当前已输入'+l+'字', f);
		return false;
	}
	if(Dd('islink').checked) {
		f = 'linkurl';
		l = Dd(f).value.length;
		if(l <= 2) {
			Dmsg('请输入正确的链接地址', f);
			return false;
		}
	}
	return true;
}
</script>
<script type="text/javascript">Menuon(0);</script>

<iframe style="position: absolute; z-index: 10000;" src="javascript:void(0)" frameborder="0" height="0" scrolling="no" width="0"></iframe><iframe style="position: absolute; z-index: 10000;" src="javascript:void(0)" frameborder="0" height="0" scrolling="no" width="0"></iframe><iframe style="position: absolute; z-index: 10000;" src="javascript:void(0)" frameborder="0" height="0" scrolling="no" width="0"></iframe><iframe style="position: absolute; z-index: 10000;" src="javascript:void(0)" frameborder="0" height="0" scrolling="no" width="0"></iframe><iframe style="position: absolute; z-index: 10000;" src="javascript:void(0)" frameborder="0" height="0" scrolling="no" width="0"></iframe></body></html>