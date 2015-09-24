<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>会员商友</title>
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
	if(Dd("id_input").value && !pattern.test(Dd("user_input").value)){
		alert('会员ID只能为数字');
		Dd("user_input").value='';
		return false;
	}
	return true;
}
</script>
</head>
<body>
<div class="menu" onselectstart="return false" id="destoon_menu">
<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody><tr>
<td valign="bottom">
<table cellpadding="0" cellspacing="0">
<tbody><tr>
<td width="10">&nbsp;</td>
<td id="Tab0" class="tab_on"><a href="<?php echo site_url("member/friend/friend_list2")?>">商友列表</a></td><td class="tab_nav">&nbsp;</td>
<td id="Tab1" class="tab"><a href="<?php echo site_url("member/friend/type_list2")?>">商友类别列表</a></td><td class="tab_nav">&nbsp;</td></tr>
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
<form action="<?php echo site_url("member/friend/search")?>" method="post" onsubmit="return check_s();">
<input type="hidden" name="action" value="friend_list">
<div class="tt">商友搜索</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tbody><tr>
<td>&nbsp;
<select name="fields">
<option value="0" selected="selected">按条件</option>
<option value="1">按会员名</option>
<option value="2">按真实姓名</option>
</select>&nbsp;
<input type="text" size="50" name="kw" value="" title="关键词">&nbsp;
会员ID:<input type="text" name="userid" value="" size="5" id="user_input">&nbsp;
<input type="submit" value="搜 索" class="btn">&nbsp;
<input type="button" value="重 置" class="btn" onclick="this.form.reset();">
</td>
</tr>
</tbody></table>
</form>
<form method="post">
<div class="tt">管理商友</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tbody><tr>
<th width="25"><input type="checkbox" onclick="checkall(this.form);"></th>
<th>姓名</th>
<th width="150">所属类别</th>
<th>会员</th>
<th>公司</th>
<th colspan="7">联系方式</th>
<th width="100">会员ID</th>
<th width="150">添加时间</th>
<th width="50">操作</th>
</tr>
<?php foreach ($friends as $v){?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center" title="备注:">
<td><input type="checkbox" name="itemid[]" value="<?php echo $v['fid']?>"></td>
<td align="left">&nbsp;<?php echo $v['truename'];if ($v['career']){echo '('.$v['career'].')';}?></td>
<td align="left">&nbsp;
<?php if ($v['tname']){?>
<a href="<?php echo site_url("member/friend/friend_list2/tid-".$v['typeid'])?>"><?php echo $v['tname'];?></a>
<?php }?></td>
<td><a href="<?php echo site_url("member/member/get_detail/{$v['username']}");?>"><?php echo $v['username']?></a></td>
<td align="left">&nbsp;<?php echo $v['company']?></td>
<td width="20">
<?php if ($v['homepage']){?>
<a href="<?php echo $v['homepage']?>" target="_blank">
<img width="16" height="16" src="<?php echo base_url("skin/images/homepage.gif")?>" title="公司主页" alt=""></a>
<?php }?></td>
<td width="20">
<?php if ($v['mobile']){?>
<a href="">
<img src="<?php echo base_url("skin/images/mobile.gif")?>" title="发送短信" alt=""></a>
<?php }?></td>
<td width="20">
<a href="javascript:Dwidget('<?php echo site_url("member/message/msg_send2/".$v['username']);?>', '发送消息');"><img width="16" height="16" src="<?php echo base_url("skin/images/msg.gif")?>" title="发送消息" alt=""></a>
</td> 
<td width="20"><a href="mailto:<?php echo $v['email']?>"><img width="16" height="16" src="<?php echo base_url("skin/images/email.gif")?>" title="发送邮件" alt=""></a></td>
<td width="20">
<?php if ($v['qq']){?>
<A href="tencent://message/?uin=<?php echo $v['qq']?>&amp;Menu=yes" 
target=blank><IMG title="点击这里给我发消息" src="http://wpa.qq.com/pa?p=4:<?php echo $v['qq']?>:4" border=0>
</A><?php }?>
</td>
<td width="20">
<?php if ($v['skype']){?>
<a rel="nofollow" href="skype:<?php echo $v['skype']?>">
<img align="absmiddle" alt="" title="点击Skype通话" src="http://mystatus.skype.com/smallicon/<?php echo $v['skype']?>">
</a><?php }?>
</td>
<td width="20"><?php if ($v['ali']){?>
<a href="http://web.im.alisoft.com/msg.aw?v=2&amp;uid=<?php echo $v['ali']?>&amp;site=cnalichn&amp;s=1" target="_blank">
<img alt="发送旺旺即时消息" src="http://amos.im.alisoft.com/online.aw?v=2&uid=<?php echo $v['ali']?>&site=cnalichn&s=6"/></a>
<?php }?></td>
<td><a href="<?php echo site_url("member/member/get_detail/{$v['username']}");?>"><?php echo $v['userid']?></a></td>
<td class="px11"><?php echo date('Y-m-d H:i:s',$v['addtime'])?></td>
<td>
<a href="<?php echo site_url("member/friend/edit_friend2/".$v['fid'])?>"><img src="<?php echo base_url("skin/images/edit.png")?>" width="16" height="16" title="修改" alt=""></a>&nbsp;
<a href="<?php echo site_url("member/friend/del_fri/".$v['fid'])?>" onclick="return _delete();"><img src="<?php echo base_url("skin/images/delete.png")?>" width="16" height="16" title="删除" alt=""></a>
</td>
</tr>
<?php }?>
</tbody></table>
<div class="btns">
<input type="submit" value=" 删 除 " class="btn" onclick="if(confirm('确定要删除选中商友吗？此操作将不可撤销')){this.form.action='<?php echo site_url("member/friend/del_fri")?>'}else{return false;}">&nbsp;&nbsp;&nbsp;备注：会员ID代表商友的添加人(拥有者)
</div>
</form>
<div class="pages">
<?php echo $pages?>&nbsp;<cite>共<?php echo $friends_count?>条/<?php echo $total_page?>页</cite>&nbsp;
<input type="text" class="pages_inp" id="destoon_pageno" value="1" onkeydown="if(event.keyCode==13 && this.value && this.value>=1 && this.value<=<?php echo $total_page?>) {var page_size=<?php echo $page_size?>;var page=(this.value-1)*page_size;window.location.href='<?php echo substr($base_url,0,-5)?>/'+page;return false;}"> 
<input type="button" class="pages_btn" value="GO" onclick="if(Dd('destoon_pageno').value>=1 && Dd('destoon_pageno').value<=<?php echo $total_page?>){var page_size=<?php echo $page_size?>;var page=(Dd('destoon_pageno').value-1)*page_size;window.location.href='<?php echo substr($base_url,0,-5)?>/'+page;}else{Dmsg('页码不正确，请重填', 'go');}"><span id="dgo" class="f_red"></span></div>
<br>
<script type="text/javascript">Menuon(0);</script>

</body></html>