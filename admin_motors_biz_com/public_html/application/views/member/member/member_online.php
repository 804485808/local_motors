<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>在线会员</title>
<meta name="robots" content="noindex,nofollow">
<script type="text/javascript">window.onerror= function(){return true;}</script>
<link rel="stylesheet" href="<?php echo base_url("skin/css/style.css");?>" type="text/css">
<script type="text/javascript" src="<?php echo base_url("skin/js/lang.js");?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/config.js");?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/jquery.js");?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/common.js");?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/admin.js");?>"></script>
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
<tbody><tr>
<td width="10">&nbsp;</td>
<td id="Tab0" class="tab_on"><a href="<?php echo site_url("member/member/member_online2")?>">在线会员</a></td>
<td class="tab_nav">&nbsp;</td>
</tr>
</tbody></table>
</td>
<td width="110"><div>
<img src="<?php echo base_url("skin/images/spacer.gif");?>" width="40" height="24" title="刷新" onclick="window.location.reload();" style="cursor:pointer;" alt="">
<img src="<?php echo base_url("skin/images/spacer.gif");?>" width="20" height="24" title="后退" onclick="history.back(-1);" style="cursor:pointer;" alt="">
<img src="<?php echo base_url("skin/images/spacer.gif");?>" width="20" height="24" title="前进" onclick="history.go(1);" style="cursor:pointer;" alt="">
<img src="<?php echo base_url("skin/images/spacer.gif");?>" width="20" height="24" title="帮助" onclick="" style="cursor:help;" alt=""></div></td>
</tr>
</tbody></table>
</div>
<div class="tt">在线会员</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tbody>
<tr>
<th width="60">会员ID</th>
<th>会员名</th>
<th>姓名</th>
<th>性别</th>
<th>状态</th>
<th>电话</th>
<th>Email</th>
<th>IP</th>
<th>访问时间</th>
<th width="50">操作</th>
</tr>
<?php foreach ($member as $v){?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center" class="">
<td><?php echo $v['userid'];?></td>
<td><a href="<?php echo site_url("member/member/get_detail/{$v['username']}");?>"><?php echo $v['username'];?></a></td>
<td><?php echo $v['truename'];?></td>
<td><?php echo $v['gender']?"女士":"男士";?></td>
<td><?php echo $v['online'] ? "<span class='f_green'>在线</span>" : "<span class='f_gray'>离线</span>";?></td></td>
<td><?php echo $v['mobile'];?></td>
<td><?php echo $v['email'];?></td>
<td><a href="javascript:get_ip('<?php echo $v['loginip']?>');" title="显示IP所在地"><?php echo $v['loginip']?></a></td>
<td><?php echo date("Y-m-d H:i:s",$v['logintime']);?></td>
<td width="100px">
<a href="<?php echo site_url("member/member/get_detail/{$v['username']}");?>"><img src="<?php echo base_url('skin/images/view.png');?>" width="16" height="16" title="会员[<?php echo $v['username'];?>]详细资料" alt=""></a>&nbsp;
<a href="<?php echo site_url("member/member/login/{$v['userid']}/{$v['username']}")?>" target="_blank"><img src="<?php echo base_url('skin/images/set.png');?>" width="16" height="16" title="进入会员商务中心" alt=""></a> 
</td>
</tr>
<?php }?>
</tbody></table>
<div class="pages">
	<?php echo $pages?>
	&nbsp;<cite>共<?php echo $mem_count?>条/<?php echo $total_page?>页</cite>&nbsp;
	<input type="text" class="pages_inp" id="destoon_pageno" value="1" onkeydown="if(event.keyCode==13 && this.value && this.value>=1 && this.value<=<?php echo $total_page?>) {var page_size=<?php echo $page_size?>;var page=(this.value-1)*page_size;window.location.href='<?php echo substr($base_url,0,-5)?>/'+page;return false;}"> 
	<input type="button" class="pages_btn" value="GO" onclick="if(Dd('destoon_pageno').value>=1 && Dd('destoon_pageno').value<=<?php echo $total_page?>){var page_size=<?php echo $page_size?>;var page=(Dd('destoon_pageno').value-1)*page_size;window.location.href='<?php echo substr($base_url,0,-5)?>/'+page;}else{Dmsg('页码不正确，请重填', 'go');}"><span id="dgo" class="f_red"></span>
</div>
<br>
<script type="text/javascript">Menuon(0);</script>

</body></html>