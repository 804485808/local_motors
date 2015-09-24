<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>left</title>
<meta name="robots" content="noindex,nofollow">
<link rel="stylesheet" href="<?php echo base_url("skin/css/style.css")?>" type="text/css">
<script type="text/javascript">window.onerror= function(){return true;}</script>
<script type="text/javascript" src="<?php echo base_url("skin/js/lang.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/config.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/jquery.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/common.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/admin.js")?>"></script>
<script type="text/javascript">window.onload=function (){show(2);}</script>
<!--<base target="main">--><base href="." target="main">
<style type="text/css">html{overflow-x:hidden;overflow-y:auto;}</style>
</head>
<body>
<table cellpadding="0" cellspacing="0" width="188" height="100%">
<tbody><tr>
<td id="bar" class="bar" valign="top" align="center">
<img src="<?php echo main_url(base_url("skin/images/bar2.gif"));?>" width="25" height="85" alt="" id="b_2" onclick="show(2);" title="我的面板">
<img src="<?php echo main_url(base_url("skin/images/barnav.gif"));?>" width="19" height="1" alt="" id="n_2" style="width: 25px;">
<img src="<?php echo main_url(base_url("skin/images/bar3.gif"));?>" width="25" height="85" alt="" id="b_3" onclick="show(3);" title="功能模块">
<img src="<?php echo main_url(base_url("skin/images/barnav.gif"));?>" width="19" height="1" alt="" id="n_3" style="width: 25px;">
<img src="<?php echo main_url(base_url("skin/images/bar4.gif"));?>" width="25" height="85" alt="" id="b_4" onclick="show(4);" title="会员管理">
<img src="<?php echo main_url(base_url("skin/images/barnav.gif"));?>" width="19" height="1" alt="" id="n_4" style="width: 19px;"></td>
<td valign="top" class="barmain">
<div class="bartop">
<table cellpadding="0" cellspacing="0" width="100%">
<tbody><tr height="20">
<td width="5"></td>
<td id="name">功能模块</td>
<td width="60" align="right">
<a href="<?php echo site_main();?>" target="_blank"><img src="<?php echo base_url("skin/images/home.gif")?>" width="8" height="8" title="网站首页"></a>&nbsp;
<a href="<?php echo site_url("my_menu/main/index")?>" target="_top"><img src="<?php echo base_url("skin/images/reload.gif")?>" width="8" height="8" title="刷新(返回后台起始页)"></a>&nbsp;
<!-- <a href="" target="main"><img src="< ?php echo base_url("skin/images/search.gif")?>" width="8" height="8" title="后台功能搜索"></a>&nbsp; -->
<a href="<?php echo site_url("reg_login/logout")?>" target="_top" onclick="if(!confirm('确实要注销登录吗?')) return false;"><img src="<?php echo base_url("skin/images/quit.gif")?>" width="8" height="8" title="注销登录"></a>
</td>
<td width="5"></td>
</tr>
</tbody></table>
</div>
<div id="menu">	
</div>
</td>
</tr>
</tbody></table>
<div style="display:none;">
	<div id="m_2">
	<dl>
		<dt onclick="s(this)" onmouseover="this.className='dt_on';" onmouseout="this.className='';">我的面板</dt>
		<dd onclick="c(this);"><a href="<?php echo site_url("my_menu/main/index2")?>">系统首页</a></dd>
		<dd onclick="c(this);"><a href="<?php echo site_url("my_menu/setting/base_set")?>">网站设置</a></dd>
		<dd onclick="c(this);"><a href="<?php echo site_url("my_menu/area/area_list")?>">地区管理</a></dd>
		<dd onclick="c(this);"><a href="<?php echo site_url("my_menu/manager/manager_list")?>">管理员管理</a></dd>		
		<dd onclick="c(this);"><a href="<?php echo site_url("my_menu/single_page/page_list")?>">单页管理</a></dd>
	</dl>
	<dl>
		<dt onclick="s(this)" onmouseover="this.className='dt_on';" onmouseout="this.className='';">系统工具</dt>
		<dd onclick="c(this);"><a href="<?php echo site_url("my_menu/tools/info_stats")?>">信息统计</a></dd>
		<!-- dd onclick="c(this);"><a href="< ?php echo site_url("my_menu/tools/banword")?>">词语过滤</a></dd>
		<dd onclick="c(this);"><a href="< ?php echo site_url("my_menu/tools/banip")?>">禁止IP</a></dd> -->
	</dl>
	
	</div>
	<div id="m_3">
	<dl id="dl_5">
		<dt onclick="m(5);" onmouseover="this.className='dt_on';" onmouseout="this.className='';">供应管理</dt>
		<dd onclick="c(this);"><a href="<?php echo site_url("module/sell/add_sell2")?>">添加供应</a></dd>
		<dd onclick="c(this);"><a href="<?php echo site_url("module/sell/sell_list2")?>">供应列表</a></dd>
		<dd onclick="c(this);"><a href="<?php echo site_url("module/sell/unapproved_sell2")?>">审核供应</a></dd>
		<dd onclick="c(this);"><a href="<?php echo site_url("module/sell/expire_sell2")?>">过期供应</a></dd>
		<dd onclick="c(this);"><a href="<?php echo site_url("module/sell/rejected_sell2")?>">未通过供应</a></dd>
		<dd onclick="c(this);"><a href="<?php echo site_url("module/sell/trash2")?>">回收站</a></dd>
		<dd onclick="c(this);"><a href="<?php echo site_url("module/sell/cat_list2")?>">行业分类</a></dd>
	</dl>
	<dl id="dl_7">
		<dt onclick="m(7);" onmouseover="this.className='dt_on';" onmouseout="this.className='';">询单管理</dt>
		<dd onclick="c(this);"><a href="<?php echo site_url("module/inquiry/inquiry_list2")?>">询单列表</a></dd>
		<dd onclick="c(this);"><a href="<?php echo site_url("module/inquiry/inquiry_clear2")?>">询单清理</a></dd>
	</dl>
	<dl id="dl_8">
		<dt onclick="m(8);" onmouseover="this.className='dt_on';" onmouseout="this.className='';">资讯管理</dt>
		<dd onclick="c(this);"><a href="<?php echo site_url("archives/archives_list")?>">资讯列表</a></dd>
		<dd onclick="c(this);"><a href="<?php echo site_url("archives/archives_add")?>">发布资讯</a></dd>
        <dd onclick="c(this);"><a href="<?php echo site_url("archives/archives_class_list")?>">资讯分类</a></dd>
        <dd onclick="c(this);"><a href="<?php echo site_url("archives/review")?>">评论</a></dd>
		<dd onclick="c(this);"><a href="<?php echo site_url("archives/archives_recycle")?>">回收站 </a></dd>
	</dl>
    <dl id="dl_9">
        <dt onclick="m(9);" onmouseover="this.className='dt_on';" onmouseout="this.className='';">品牌管理</dt>
        <dd onclick="c(this);"><a href="<?php echo site_url("brand/brand_add")?>">添加品牌</a></dd>
        <dd onclick="c(this);"><a href="<?php echo site_url("brand/brand_list")?>">品牌列表</a></dd>
    </dl>
	</div>	
	<div id="m_4">
	<dl id="dl_2">
		<dt id="dt_2" onclick="s(this);" onmouseover="this.className='dt_on';" onmouseout="this.className='';">管理</dt>
		<dd onclick="c(this);"><a href="<?php echo site_url("member/member/member_add2")?>">添加会员</a></dd>
		<dd onclick="c(this);"><a href="<?php echo site_url("member/member/member_list2")?>">会员列表</a></dd>
		<dd onclick="c(this);"><a href="<?php echo site_url("member/member/member_check2")?>">审核会员</a></dd>
		<dd onclick="c(this);"><a href="<?php echo site_url("member/vip/vip_list2")?>">VIP管理</a></dd>
		<dd onclick="c(this);"><a href="<?php echo site_url("member/member/member_contact2")?>">联系会员</a></dd>
		<dd onclick="c(this);"><a href="<?php echo site_url("member/member/member_online2")?>">在线会员</a></dd>
	</dl>	
	<dl id="dl_4">
		<dt id="dt_4" onclick="s(this);h(Dd('dt_pay'));h(Dd('dt_oth'));" onmouseover="this.className='dt_on';" onmouseout="this.className='';">公司管理</dt>
		<dd onclick="c(this);"><a href="<?php echo site_url("member/company/company_list2")?>">公司列表</a></dd>
	</dl>	

<dl id="dl_oth"> 
	<dt id="dt_oth" onclick="s(this);h(Dd('dt_pay'));h(Dd('dt_4'));" onmouseover="this.className='dt_on';" onmouseout="this.className='';">会员相关</dt> 
	<dd onclick="c(this);"><a href="<?php echo site_url("member/validate/validate_list2")?>">资料认证</a></dd>
	<dd onclick="c(this);"><a href="<?php echo site_url("member/message/msg_list2")?>">站内信件</a></dd>
	<dd onclick="c(this);"><a href="<?php echo site_url("member/friend/friend_list2")?>">会员商友</a></dd>
</dl>
</div>
</div>
<script type="text/javascript">
var names = ['', '', '我的面板', '功能模块', '会员管理'];
function show(ID) {
	//alert(ID);
	var imgdir = '<?php echo $site['main_domain'];?>skin/images/';
	Dd('menu').innerHTML = Dd('m_'+ID).innerHTML;
	Dd('name').innerHTML = names[ID];
	for(i=2;i<names.length;i++) {
		if(i==ID) {
			Dd('b_'+i).src = imgdir+'bar'+i+'on.gif';
			Dd('n_'+i).style.width = '25px';
		} else {
			Dd('b_'+i).src = imgdir+'bar'+i+'.gif';
		}
		Dd('b_'+i).title = names[i];
	}
}
show(2);
</script>
<script type="text/javascript">
function c(o) {
	var dds = Dd('menu').getElementsByTagName('dd');
	for(var i=0;i<dds.length;i++) {
		dds[i].className = dds[i] == o ? 'dd_on' : '';
		if(dds[i] == o) o.firstChild.blur();
	}
}
function s(o) {
	var dds = o.parentNode.getElementsByTagName('dd');
	for(var i=0;i<dds.length;i++) {
		dds[i].style.display = dds[i].style.display == 'none' ? '' : 'none';
	}
}
function h(o) {
	var dds = o.parentNode.getElementsByTagName('dd');
	for(var i=0;i<dds.length;i++) {
		dds[i].style.display = 'none';
	}
}
function m(ID) {
	var dls = Dd('m_3').getElementsByTagName('dl');
	for(var i=0;i<dls.length;i++) {
		var dds = Dd(dls[i].id).getElementsByTagName('dd');
		for(var j=0;j<dds.length;j++) {
			dds[j].style.display = dls[i].id == 'dl_'+ID ? dds[j].style.display == 'none' ? '' : 'none' : 'none';
		}
	}
}
</script>

</body>
</html>