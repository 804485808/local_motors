<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>地区列表</title>
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
<td id="Tab0" class="tab"><a href="<?php echo site_url("my_menu/area/add_area")?>">地区添加</a></td><td class="tab_nav">&nbsp;</td>
<td id="Tab1" class="tab_on"><a href="<?php echo site_url("my_menu/area/area_list")?>">地区管理</a></td><td class="tab_nav">&nbsp;</td>
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
</div><form method="post" action="<?php echo site_url("my_menu/area/search_area")?>">
<input type="hidden" name="file" value="area">
<div class="tt">地区搜索</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tbody><tr>
<td>&nbsp;
<input type="text" size="30" name="kw" value="" title="关键词">&nbsp;
<input type="submit" name="submit" value="搜 索" class="btn">&nbsp;
<input type="button" value="重置" class="btn" onclick="this.form.reset();">&nbsp;
</td>
</tr>
</tbody></table>

</form>
<div class="tt">地区管理</div>
<form method="post">
<table cellpadding="2" cellspacing="1" class="tb">
<tbody><tr>
<th width="25"><input type="checkbox" onclick="checkall(this.form);"></th>
<th width="100">排序</th>
<th width="100">ID</th>
<th>上级ID</th>
<th>地区名</th>
<th width="80">子地区</th>
<th width="120">操作</th>
</tr>

<?php foreach ($areas as $v){?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td><input type="checkbox" name="areaids[]" value="<?php echo $v['areaid']?>"></td>
<td><input name="area[<?php echo $v['areaid']?>][listorder]" type="text" size="5" value="<?php echo $v['listorder']?>"></td>
<td>&nbsp;<?php echo $v['areaid']?></td>
<td><input name="area[<?php echo $v['areaid']?>][parentid]" type="text" size="10" value="<?php echo $v['parentid']?>" disabled></td>
<td><input name="area[<?php echo $v['areaid']?>][areaname]" type="text" size="20" value="<?php echo $v['areaname']?>"></td>
<td>&nbsp;<a href="<?php echo site_url("my_menu/area/area_list/sub-".$v['areaid'])?>"><?php echo $v['subarea_count']?></a></td>
<td>
<a href="<?php echo site_url("my_menu/area/area_list/sub-".$v['areaid'])?>"><img src="<?php echo base_url("skin/images/child.png")?>" width="16" height="16" title="管理子地区，当前有<?php echo $v['subarea_count']?>个子地区" alt=""></a>&nbsp;
<a href="<?php echo site_url("my_menu/area/add_area/".$v['areaid'])?>"><img src="<?php echo base_url("skin/images/new.png")?>" width="16" height="16" title="添加子地区" alt=""></a>&nbsp;
<a href="<?php echo site_url("my_menu/area/del_area/".$v['areaid'])?>" onclick="return _delete();"><img src="<?php echo base_url("skin/images/delete.png")?>" width="16" height="16" title="删除" alt=""></a></td>
</tr>
<?php }?>

</tbody></table>
<div class="btns">
<span class="f_r">
地区总数:<strong class="f_red"><?php echo $area_count?></strong>&nbsp;&nbsp;
当前目录:<strong class="f_blue"><?php echo $cur_area_count?></strong>&nbsp;&nbsp;
</span>
<input type="submit" name="submit" value="更新地区" class="btn" onclick="this.form.action='<?php echo site_url("my_menu/area/update_area")?>'">&nbsp;&nbsp;
<input type="submit" value="删除选中" class="btn" onclick="if(confirm('确定要删除选中地区吗？此操作将不可撤销')){this.form.action='<?php echo site_url("my_menu/area/del_area/")?>'}else{return false;}">&nbsp;&nbsp;
</div>
</form>
<div class="pages">
<?php echo $pages?>
&nbsp;<cite>共<?php echo $area_count?>条/<?php echo $total_page?>页</cite>&nbsp;
<input type="text" class="pages_inp" id="destoon_pageno" value="1" onkeydown="if(event.keyCode==13 && this.value && this.value>=1 && this.value<=<?php echo $total_page?>) {var page_size=<?php echo $page_size?>;var page=(this.value-1)*page_size;window.location.href='<?php echo substr($base_url,0,-5)?>/'+page;return false;}"> 
<input type="button" class="pages_btn" value="GO" onclick="if(Dd('destoon_pageno').value>=1 && Dd('destoon_pageno').value<=<?php echo $total_page?>){var page_size=<?php echo $page_size?>;var page=(Dd('destoon_pageno').value-1)*page_size;window.location.href='<?php echo substr($base_url,0,-5)?>/'+page;}else{Dmsg('页码不正确，请重填', 'go');}"><span id="dgo" class="f_red"></span></div>
<br/>
<!-- <form method="post" action="">
<div class="tt">快捷操作</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tbody><tr align="center">
<td>
<div style="float:left;padding:10px;">
<input name="aid" id="areaid_1" type="hidden" value="0"><span id="load_area_1"><select onchange="load_area(this.value, 1);" size="2" style="width:200px;height:130px;" id="aid"><option value="0">地区结构</option><option value="1">北京</option><option value="2">上海</option><option value="3">天津</option><option value="4">重庆</option><option value="5">河北</option><option value="6">山西</option><option value="7">内蒙古</option><option value="8">辽宁</option><option value="9">吉林</option><option value="10">黑龙江</option><option value="11">江苏</option><option value="12">浙江</option><option value="13">安徽</option><option value="14">福建</option><option value="15">江西</option><option value="16">山东</option><option value="17">河南</option><option value="18">湖北</option><option value="19">湖南</option><option value="20">广东</option><option value="21">广西</option><option value="22">海南</option><option value="23">四川</option><option value="24">贵州</option><option value="25">云南</option><option value="26">西藏</option><option value="27">陕西</option><option value="28">甘肃</option><option value="29">青海</option><option value="30">宁夏</option><option value="31">新疆</option><option value="32">台湾</option><option value="33">香港</option><option value="34">澳门</option><option value="395">其他</option></select> </span><script type="text/javascript">var area_title = new Array;area_title[1]='地区结构';var area_extend = new Array;area_extend[1]='size="2" style="width:200px;height:130px;" id="aid"';var area_areaid = new Array;area_areaid[1]='0';var area_deep = new Array;area_deep[1]='0';</script><script type="text/javascript" src="<?php echo base_url("skin/js/area.js")?>"></script></div>
<div style="float:left;padding:10px;">
	<table>
	<tbody><tr>
	<td><input type="submit" value="管理地区" class="btn" onclick="this.form.action='?file=area&amp;parentid='+Dd('aid').value;"></td>
	</tr>
	<tr>
	<td><input type="submit" value="添加地区" class="btn" onclick="this.form.action='?file=area&amp;action=add&amp;parentid='+Dd('aid').value;"></td>
	</tr>
	<tr>
	<td><input type="submit" value="删除地区" class="btn" onclick="if(confirm('确定要删除选中地区吗？此操作将不可撤销')){this.form.action='?file=area&amp;action=delete&amp;areaid='+Dd('aid').value;}else{return false;}"></td>
	</tr>
	</tbody></table>
</div>
</td>
</tr>
</tbody></table>

</form> -->
<br>
<br>
<br>
<script type="text/javascript">Menuon(1);</script>

</body></html>