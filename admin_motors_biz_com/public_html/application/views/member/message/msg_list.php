<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>会员信件列表</title>
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

function check_s(){
	var pattern=/^\d+$/; 
	if(!pattern.test(Dd("psize").value)){
		alert('每页记录数只能为数字');
		Dd("psize").value=20;
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
<td id="Tab0" class="tab"><a href="<?php echo site_url("member/message/msg_send2")?>">发送信件</a></td><td class="tab_nav">&nbsp;</td>
<td id="Tab1" class="tab_on"><a href="<?php echo site_url("member/message/msg_list2")?>">会员信件</a></td><td class="tab_nav">&nbsp;</td>
<td id="Tab2" class="tab"><a href="<?php echo site_url("member/message/msg_system2")?>">系统信件</a></td><td class="tab_nav">&nbsp;</td>
<td id="Tab4" class="tab"><a href="<?php echo site_url("member/message/msg_clear2")?>">信件清理</a></td><td class="tab_nav">&nbsp;</td></tr>
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
<form action="<?php echo site_url('member/message/search');?>" method="post"  onsubmit="return check_s();">
<input type="hidden" name="action" value="msg_list2">
<div class="tt">会员信件搜索</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tbody><tr>
<td>
&nbsp;<select name="fields">
<option value="0" selected="selected">标题</option>
<option value="1">发件人</option>
<option value="2">收件人</option>
<option value="3">IP</option>
<option value="4">内容</option>
</select>&nbsp;
<input type="text" size="30" name="kw" value="" title="关键词">&nbsp;
<select name="status">
<option value="" selected="selected">状态</option>
<option value="0">垃圾箱</option>
<option value="2">草稿箱</option>
</select>&nbsp;
<select name="type">
<option value="">类型</option>
<option value="0">普通</option>
<option value="1">询价</option>
<option value="2">报价</option>
<option value="3">信使</option>
</select>&nbsp;
<select name="read">
<option value="">阅读</option>
<option value="1">已读</option>
<option value="0">未读</option>
</select>&nbsp;
<select name="send">
<option value="">转发</option>
<option value="1">已发</option>
<option value="0">未发</option>
</select>
&nbsp;
<input type="text" name="psize" id="psize" value="20" size="2" class="t_c" title="条/页">
<input type="submit" value="搜 索" class="btn">&nbsp;
<input type="reset" value="重 置" class="btn">
</td>
</tr>
</tbody></table>
</form>
<form method="post">
<div class="tt">会员信件管理</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tbody><tr>
<th width="25"><input type="checkbox" onclick="checkall(this.form);"></th>
<th width="35">类型</th>
<th width="60">状态</th>
<th>标题</th>
<th>收件人</th>
<th>发件人</th>
<th>发送时间</th>
<th width="30">已读</th>
<th width="30">已发</th>
<th width="100">发送IP</th>
<th width="30">删除</th>
</tr>
<?php foreach ($messages as $v){?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td><input type="checkbox" name="itemid[]" value="<?php echo $v['mid']?>"></td>
<td><a href="<?php echo site_url("member/message/msg_list2/type-".$v['typeid']."/isread-".$v['isread'])?>">
<img src="<?php echo base_url("skin/images/".$v["type_img"])?>" width="16" height="16" title="<?php echo $v['type_name']?>" alt=""></a></td>
<td><?php echo $v['status']?></td>
<td align="left"><a href="<?php echo site_url("member/message/msg_show2/".$v['mid'])?>" title="<?php echo $v['title']?>">&nbsp;<?php echo $v['title']?></a></td>
<td><a href="<?php echo site_url("member/member/get_detail/{$v['touser']}");?>"><?php echo $v['touser']?></a></td>
<td><a href="<?php echo site_url("member/member/get_detail/{$v['fromuser']}");?>"><?php echo $v['fromuser']?></a></td>
<td class="px11"><?php echo date('Y-m-d H:i:s',$v['addtime']);?></td>
<td><?php echo $v['isread']?'是':'否';?></td>
<td><?php echo $v['issend']?'是':'否';?></td>
<td class="px11"><a href="javascript:get_ip('<?php echo $v['ip']?>');" title="显示IP所在地"><?php echo $v['ip']?></a></td>
<td>
<a href="<?php echo site_url("member/message/del_msg/".$v['mid'])?>" onclick="return _delete();">
<img src="<?php echo base_url("skin/images/delete.png")?>" width="16" height="16" title="删除" alt=""></a>
</td>
</tr>
<?php }?>
</tbody></table>
<div class="btns">
<input type="submit" value=" 删 除 " class="btn" onclick="if(confirm('确定要删除选中信件吗？此操作将不可撤销')){this.form.action='<?php echo site_url("member/message/del_msg")?>'}else{return false;}">
</div>
</form>
<div class="pages"><?php echo $pages?>
<cite>共<?php echo $messages_count?>条/<?php echo $total_page?>页</cite>&nbsp;
<input type="text" class="pages_inp" id="destoon_pageno" value="1" onkeydown="if(event.keyCode==13 && this.value && this.value>=1  && this.value<=<?php echo $total_page?>) {var page_size=<?php echo $page_size?>;var page=(this.value-1)*page_size;window.location.href='<?php echo substr($base_url,0,-5)?>/'+page;return false;}"> 
<input type="button" class="pages_btn" value="GO" onclick="if(Dd('destoon_pageno').value>=1 && Dd('destoon_pageno').value<=<?php echo $total_page?>){var page_size=<?php echo $page_size?>;var page=(Dd('destoon_pageno').value-1)*page_size;window.location.href='<?php echo substr($base_url,0,-5)?>/'+page;}else{Dmsg('页码不正确，请重填', 'go');}"><span id="dgo" class="f_red"></span></div>
<script type="text/javascript">Menuon(1);</script>
<br>

</body></html>