<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>商友类别列表</title>
<meta name="robots" content="noindex,nofollow">
<script type="text/javascript">window.onerror= function(){return true;}</script>
<link rel="stylesheet" href="<?php echo base_url("skin/css/style.css")?>" type="text/css">
<script type="text/javascript" src="<?php echo base_url("skin/js/lang.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/config.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/jquery.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/common.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/admin.js")?>"></script>
<script type="text/javascript">
function check_s(){
	var pattern=/^\d+$/; 
	if(!pattern.test(Dd("user_input").value)){
		alert('会员ID只能为数字');
		Dd("user_input").value='';
		return false;
	}
	return true;
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
<tbody><tr>
<td width="10">&nbsp;</td>
<td id="Tab1" class="tab"><a href="<?php echo site_url("member/friend/friend_list2")?>">商友列表</a></td><td class="tab_nav">&nbsp;</td>
<td id="Tab0" class="tab_on"><a href="<?php echo site_url("member/friend/type_list2")?>">商友类别列表</a></td><td class="tab_nav">&nbsp;</td></tr>
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
<form action="<?php echo site_url("member/friend/search_type")?>" method="post" onsubmit="return check_s();">
<input type="hidden" name="action" value="type_list">
<div class="tt">商友列表搜索</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tbody><tr><td>
&nbsp;<select name="fields">
<option value="0" selected="selected">按条件</option>
<option value="1">按类别ID</option>
<option value="2">按类别名称</option>
</select>&nbsp;
<input type="text" size="50" name="kw" value="" title="关键词">&nbsp;
会员ID:<input type="text" name="userid" value="" size="5" id="user_input" >&nbsp;
<input type="submit" value="搜 索" class="btn">&nbsp;
<input type="button" value="重 置" class="btn" onclick="this.form.reset();">
</td>
</tr>
</tbody></table>
</form>
<form method="post">
<div class="tt">管理商友列表</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tbody><tr>
<th width="25"><input type="checkbox" onclick="checkall(this.form);"></th>
<th>类别id</th>
<th>类别名称</th>
<th>排序</th>
<th>会员ID</th>
<th>商友数量</th>
<th width="50">操作</th>
</tr>
<?php foreach ($types as $v){?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center" title="备注:">
<td><input type="checkbox" name="itemid[]" value="<?php echo $v['tid']?>"></td>
<td><?php echo $v['tid']?></td>
<td align="left">&nbsp;<?php echo $v['tname']?></td>
<td><?php echo $v['listorder']?></td>
<td><a href="<?php echo site_url("member/member/get_detail/{$v['username']}");?>"><?php echo $v['userid']?></a></td>
<td><?php if ($v['friends_count']){?>
<a href="javascript:Dwidget('<?php echo site_url("member/friend/friend_list2/tid-".$v["tid"])?>', '<?php echo $v["tname"]?>类别下的所用商友');"><?php echo $v['friends_count']?></a>
<?php }else{echo $v['friends_count'];}?></td>
<td>
<a href="<?php echo site_url("member/friend/edit_type2/".$v['tid'])?>"><img src="<?php echo base_url("skin/images/edit.png")?>" width="16" height="16" title="修改" alt=""></a>&nbsp;
<a href="<?php echo site_url("member/friend/del_type/".$v['tid'])?>" onclick="return _delete();"><img src="<?php echo base_url("skin/images/delete.png")?>" width="16" height="16" title="删除" alt=""></a>
</td>
</tr>
<?php }?>
</tbody></table>
<div class="btns">
<input type="submit" value=" 删 除 " class="btn" onclick="if(confirm('确定要删除选中商友吗？此操作将不可撤销')){this.form.action='<?php echo site_url("member/friend/del_type")?>'}else{return false;}">&nbsp;&nbsp;&nbsp;备注：会员ID代表商友类别的添加人(拥有者)
</div>
</form>
<div class="pages">
<?php echo $pages?>&nbsp;<cite>共<?php echo $type_count?>条/<?php echo $total_page?>页</cite>&nbsp;
<input type="text" class="pages_inp" id="destoon_pageno" value="1" onkeydown="if(event.keyCode==13 && this.value && this.value>=1 && this.value<=<?php echo $total_page?>) {var page_size=<?php echo $page_size?>;var page=(this.value-1)*page_size;window.location.href='<?php echo substr($base_url,0,-5)?>/'+page;return false;}"> 
<input type="button" class="pages_btn" value="GO" onclick="if(Dd('destoon_pageno').value>=1 && Dd('destoon_pageno').value<=<?php echo $total_page?>){var page_size=<?php echo $page_size?>;var page=(Dd('destoon_pageno').value-1)*page_size;window.location.href='<?php echo substr($base_url,0,-5)?>/'+page;}else{Dmsg('页码不正确，请重填', 'go');}"><span id="dgo" class="f_red"></span></div>
<br>
<script type="text/javascript">Menuon(0);</script>

</body></html>