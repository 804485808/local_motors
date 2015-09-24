<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>管理员管理</title>
<meta name="robots" content="noindex,nofollow">
<script type="text/javascript">window.onerror= function(){return true;}</script>
<link rel="stylesheet" href="<?php echo base_url("skin/css/style.css")?>" type="text/css">
<script type="text/javascript" src="<?php echo base_url("skin/js/lang.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/config.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/jquery.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/common.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/admin.js")?>"></script>
<script type="text/javascript">
function get_ip(ip){
	$.post("<?php echo site_url("pub/get_ip")?>",{ip:ip},
			function (data){
				alert(ip+"所在地区为：\n"+data);		
	});
}
</script>
</head>
<body>
<div id="msgbox" onmouseover="closemsg();" style="display:none;"></div>
<div class="menu" onselectstart="return false" id="destoon_menu">
<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody><tr>
<td valign="bottom">
<table cellpadding="0" cellspacing="0">
<tbody>
<tr>
	<td width="10">&nbsp;</td>
	<td id="Tab0" class="tab"><a href="<?php echo site_url("my_menu/manager/manager_add")?>">添加管理员</a></td><td class="tab_nav">&nbsp;</td>
	<td id="Tab1" class="tab_on"><a href="<?php echo site_url("my_menu/manager/manager_list")?>">管理员管理</a></td><td class="tab_nav">&nbsp;</td>
</tr>
</tbody></table>
</td>
<td width="110">
	<div>
	<img src="<?php echo base_url("skin/images/spacer.gif")?>" width="40" height="24" title="刷新" onclick="window.location.reload();" style="cursor:pointer;" alt="">
	<img src="<?php echo base_url("skin/images/spacer.gif")?>" width="20" height="24" title="后退" onclick="history.back(-1);" style="cursor:pointer;" alt="">
	<img src="<?php echo base_url("skin/images/spacer.gif")?>" width="20" height="24" title="前进" onclick="history.go(1);" style="cursor:pointer;" alt="">
	<img src="<?php echo base_url("skin/images/spacer.gif")?>" width="20" height="24" title="帮助" onclick="" style="cursor:help;" alt="">
	</div>
</td>
</tr>
</tbody></table>
</div>
<!-- <div class="tt">管理员搜索</div>
<form action="">
<input type="hidden" name="file" value="admin">
<table cellpadding="2" cellspacing="1" class="tb">
<tbody><tr>
<td>&nbsp;
<select name="fields"><option value="0" selected="selected">按条件</option><option value="1">用户名</option><option value="2">姓名</option><option value="3">角色</option></select>&nbsp;
<input type="text" size="30" name="kw" value="" title="关键词">&nbsp;
<select name="type">
<option value="0">管理员类型</option>
<option value="1">超级管理员</option>
<option value="2">普通管理员</option>
</select>&nbsp;
<input name="areaid" id="areaid_1" type="hidden" value="0">
<span id="load_area_1">
	<select onchange="load_area(this.value, 1);">
		<option value="0">所属分站</option>
		<?php foreach ($area as $k => $v){?>
		<option value="<?php echo $v['areaid'];?>"><?php echo $v['areaname'];?></option>
		<?php }?>
		<option value="395">其他</option>
	</select> 
</span>
<script type="text/javascript">var area_title = new Array;area_title[1]='所属分站';var area_extend = new Array;area_extend[1]='';var area_areaid = new Array;area_areaid[1]='0';var area_deep = new Array;area_deep[1]='0';</script><script type="text/javascript" src="<?php echo base_url("skin/js/area.js")?>"></script>&nbsp;
<input type="text" name="psize" value="20" size="2" class="t_c" title="条/页">
<input type="submit" value="搜 索" class="btn">&nbsp;
<input type="button" value="重 置" class="btn" onclick="Go('?file=admin');">
</td>
</tr>
</tbody></table>
</form> -->
<form method="post" action="">
<input type="hidden" name="file" value="admin">
<input type="hidden" name="action" value="add">
<div class="tt">管理员管理</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tbody><tr>
<th>姓名</th>
<th>用户名</th>
<th>管理级别</th>
<th>所属分站</th>
<th>上次登录时间</th>
<th>登录IP</th>
<th>登录地区</th>
<th>登录次数</th>
<th width="150">管理</th>
</tr>
<?php foreach ($manager as $v){?>
<tr align="center" onmouseover="this.className='on';" onmouseout="this.className='';">
<td><?php echo $v['truename'];?></td>
<td><a href="<?php echo site_url("member/member/get_detail/{$v['username']}");?>"><?php echo $v['username'];?></a></td>
<td><?php echo $v['admin'] == 1 ? "<span class='f_blue'>超级管理员</span>" : "普通管理员";?></td>
<td><?php echo $v['areaname'];?></td>
<td class="px11"><?php echo date("Y-m-d H:i:s",$v['lasttime']);?></td>
<td class="px11"><a href="javascript:get_ip('<?php echo $v['lastip']?>');" title="显示IP所在地"><?php echo $v['lastip']?></a></td>
<td>LAN</td>
<td><?php echo $v['logintimes'];?></td>
<td>
<a href="<?php echo site_url('my_menu/manager/manager_edit/'.$v['userid']);?>" title="修改管理级别、角色、分站">修改</a> | 
<a href="<?php echo site_url('my_menu/manager/del/'.$v['userid']);?>" onclick="return _delete();" title="撤销管理员">撤销</a>
</td>
</tr>
<?php }?>
</tbody></table>
<div class="pages">
	<?php echo $pages?>
	&nbsp;<cite>共<?php echo $man_count?>条/<?php echo $total_page?>页</cite>&nbsp;
	<input type="text" class="pages_inp" id="destoon_pageno" value="1" onkeydown="if(event.keyCode==13 && this.value && this.value>=1 && this.value<=<?php echo $total_page?>) {var page_size=<?php echo $page_size?>;var page=(this.value-1)*page_size;window.location.href='<?php echo substr($base_url,0,-5)?>/'+page;return false;}"> 
	<input type="button" class="pages_btn" value="GO" onclick="if(Dd('destoon_pageno').value>=1 && Dd('destoon_pageno').value<=<?php echo $total_page?>){var page_size=<?php echo $page_size?>;var page=(Dd('destoon_pageno').value-1)*page_size;window.location.href='<?php echo substr($base_url,0,-5)?>/'+page;}else{Dmsg('页码不正确，请重填', 'go');}"><span id="dgo" class="f_red"></span>
</div>
<br>
</form></body></html>