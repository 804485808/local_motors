<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>单页列表</title>
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
<td id="Tab0" class="tab"><a href="<?php echo site_url("my_menu/single_page/add_page")?>">添加单页</a></td><td class="tab_nav">&nbsp;</td>
<td id="Tab1" class="tab_on"><a href="<?php echo site_url("my_menu/single_page/page_list")?>">单页列表</a></td><td class="tab_nav">&nbsp;</td>
<td id="Tab2" class="tab"><a href="<?php echo site_url("my_menu/single_page/create_page")?>">生成单页</a></td><td class="tab_nav">&nbsp;</td></tr>
</tbody></table>
</td>
<td width="110"><div>
<img src="<?php echo base_url("skin/images/spacer.gif")?>" title="刷新" onclick="window.location.reload();" style="cursor:pointer;" alt="" height="24" width="40">
<img src="<?php echo base_url("skin/images/spacer.gif")?>" title="后退" onclick="history.back(-1);" style="cursor:pointer;" alt="" height="24" width="20">
<img src="<?php echo base_url("skin/images/spacer.gif")?>" title="前进" onclick="history.go(1);" style="cursor:pointer;" alt="" height="24" width="20">
<img src="<?php echo base_url("skin/images/spacer.gif")?>" title="帮助" onclick="" style="cursor:help;" alt="" height="24" width="20"></div></td>
</tr>
</tbody></table>
</div>
<!-- <form action="?">
<div class="tt">单页搜索</div>
<input name="moduleid" value="3" type="hidden">
<input name="file" value="webpage" type="hidden">
<input name="item" value="1" type="hidden">
<input name="itemid" value="0" type="hidden">
<table class="tb" cellpadding="2" cellspacing="1">
<tbody><tr>
<td>
&nbsp;<select name="fields"><option value="0" selected="selected">按条件</option><option value="1">标题</option><option value="2">链接地址</option><option value="3">内容</option><option value="4">绑定域名</option></select>&nbsp;
<input size="30" name="kw" title="关键词" type="text">&nbsp;
<select name="level"><option selected="selected" value="0">级别</option><option value="1">1 级</option><option value="2">2 级</option><option value="3">3 级</option><option value="4">4 级</option><option value="5">5 级</option><option value="6">6 级</option><option value="7">7 级</option><option value="8">8 级</option><option value="9">9 级</option></select>&nbsp;
<select name="order"><option value="0" selected="selected">结果排序方式</option><option value="1">更新时间降序</option><option value="2">更新时间升序</option><option value="3">浏览次数降序</option><option value="4">浏览次数升序</option></select>&nbsp;
<input name="psize" value="20" size="2" class="t_c" title="条/页" type="text">
<input value="搜 索" class="btn" type="submit">&nbsp;
<input value="重 置" class="btn" onclick="Go('?moduleid=3&file=webpage&item=1&itemid=0');" type="button">
</td>
</tr>
</tbody></table>
</form> -->
<form method="post">
<input name="item" value="1" type="hidden">
<input name="itemid" value="0" type="hidden">
<div class="tt">管理单页</div>
<table class="tb" cellpadding="2" cellspacing="1">
<tbody><tr>
<th width="25"><input onclick="checkall(this.form);" type="checkbox"></th>
<th width="50">排序</th>
<th width="14"> </th>
<th>标 题</th>
<th>地 址</th>
<th>浏览次数</th>
<th width="150">更新时间</th>
<th width="50">操作</th>
</tr>
<?php foreach ($webpages as $v){?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td><input name="itemid[]" value="<?php echo $v['itemid']?>" type="checkbox"></td>
<td><input size="2" name="listorder[<?php echo $v['itemid']?>]" value="<?php echo $v['listorder']?>" type="text"></td>
<td><?php if ($v['level']){echo "<img alt='' title='",$v['level'],"级' src='",base_url("skin/images/level_".$v['level'].".gif"),"'>";}?></td>
<td align="left">&nbsp;<a href="" target="_blank" style="color:<?php echo $v['style']?>"><?php echo $v['title']?></a></td>
<td align="left">&nbsp;<a href="" target="_blank"><?php echo ROOT_PATH.$v['linkurl']?></a></td>
<td class="px11"><?php echo $v['hits']?></td>
<td class="px11"><?php echo date("Y-m-d H:i:s",$v['edittime'])?></td>
<td>
<a href="<?php echo site_url("my_menu/single_page/edit_page/".$v['itemid'])?>"><img src="<?php echo base_url("skin/images/edit.png")?>" title="修改" alt="" height="16" width="16"></a>&nbsp;
<a href="<?php echo site_url("my_menu/single_page/del_page/".$v['itemid'])?>" onclick="return _delete();"><img src="<?php echo base_url("skin/images/delete.png")?>" title="删除" alt="" height="16" width="16"></a>
</td>
</tr>
<?php }?>

</tbody></table>
<div class="btns">
<input value=" 更新排序 " class="btn" onclick="this.form.action='<?php echo site_url("my_menu/single_page/modify_page/uplist")?>';" type="submit">&nbsp;
<input value=" 删 除 " class="btn" onclick="if(confirm('确定要删除选中单页和相关文件吗？此操作将不可撤销')){this.form.action='<?php echo site_url("my_menu/single_page/del_page/")?>'}else{return false;}" type="submit">&nbsp;
<select name="level" onchange="this.form.action='<?php echo site_url("my_menu/single_page/modify_page/set_level")?>';this.form.submit();">
<option selected="selected" value="0">设置级别为</option><option value="0">取消</option><option value="1">1 级</option><option value="2">2 级</option><option value="3">3 级</option><option value="4">4 级</option><option value="5">5 级</option><option value="6">6 级</option><option value="7">7 级</option><option value="8">8 级</option><option value="9">9 级</option></select>&nbsp;
</div>
</form>
<div class="pages">
<?php echo $pages?>&nbsp;<cite>共<?php echo $pages_count?>条/<?php echo $total_page?>页</cite>&nbsp;
<input type="text" class="pages_inp" id="destoon_pageno" value="1" onkeydown="if(event.keyCode==13 && this.value && this.value>=1 && this.value<=<?php echo $total_page?>) {var page_size=<?php echo $page_size?>;var page=(this.value-1)*page_size;window.location.href='<?php echo substr($base_url,0,-5)?>/'+page;return false;}"> 
<input type="button" class="pages_btn" value="GO" onclick="if(Dd('destoon_pageno').value>=1 && Dd('destoon_pageno').value<=<?php echo $total_page?>){var page_size=<?php echo $page_size?>;var page=(Dd('destoon_pageno').value-1)*page_size;window.location.href='<?php echo substr($base_url,0,-5)?>/'+page;}else{Dmsg('页码不正确，请重填', 'go');}"><span id="dgo" class="f_red"></span></div>
<br>
<script type="text/javascript">Menuon(1);</script>

</body></html>