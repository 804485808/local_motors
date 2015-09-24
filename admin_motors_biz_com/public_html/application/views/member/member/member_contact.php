<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>联系会员</title>
<meta name="robots" content="noindex,nofollow">
<script type="text/javascript">window.onerror= function(){return true;}</script>
<link rel="stylesheet" href="<?php echo base_url("skin/css/style.css");?>" type="text/css">
<script type="text/javascript" src="<?php echo base_url("skin/js/lang.js");?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/config.js");?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/jquery.js");?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/common.js");?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/admin.js");?>"></script>
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
<td id="Tab0" class="tab"><a href="<?php echo site_url('member/member/member_add2');?>">添加会员</a></td>
<td class="tab_nav">&nbsp;</td>
<td id="Tab1" class="tab"><a href="<?php echo site_url('member/member/member_list2');?>">会员列表</a></td>
<td class="tab_nav">&nbsp;</td><td id="Tab2" class="tab"><a href="<?php echo site_url('member/member/member_check2');?>">审核会员</a></td>
<td class="tab_nav">&nbsp;</td><td id="Tab4" class="tab_on"><a href="<?php echo site_url('member/member/member_contact2');?>">联系会员</a></td>
<td class="tab_nav">&nbsp;</td><td id="Tab5" class="tab"><a href="<?php echo site_url('member/company/company_list2');?>">公司列表</a></td>
<td class="tab_nav">&nbsp;</td><td id="Tab6" class="tab"><a href="<?php echo site_url('member/vip/vip_list2');?>">VIP列表</a></td>
<td class="tab_nav">&nbsp;</td></tr>
</tbody></table>
</td>
<td width="110"><div>
<img src="<?php echo base_url("skin/images/spacer.gif");?>" width="40" height="24" title="刷新" onclick="window.location.reload();" style="cursor:pointer;" alt="">
<img src="<?php echo base_url("skin/images/spacer.gif");?>" width="20" height="24" title="后退" onclick="history.back(-1);" style="cursor:pointer;" alt="">
<img src="<?php echo base_url("skin/images/spacer.gif");?>" width="20" height="24" title="前进" onclick="history.go(1);" style="cursor:pointer;" alt="">
</div></td>
</tr>
</tbody></table>
</div>
<div class="tt">联系会员</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tbody><tr>
<th>公司</th>
<th>会员名称</th>
<th width="200">姓名</th>
<th>职位</th>
<th>性别</th>
<th>电话</th>
<th>手机</th>
<th colspan="6">联系方式</th>
<th width="40">状态</th>
<th width="50">操作</th>
</tr>
<?php foreach ($member as $v){?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center" title="会员名:<?php echo $v['username']."\r\n";?>会员ID:<?php echo $v['userid']."\r\n";?>会员组:<?php if ($v['groupid']==1){echo "管理员";}else if ($v['groupid']==2){echo "禁止访问";}else if ($v['groupid']==3){echo "游客";}else if ($v['groupid']==4){echo "待审核会员";}else if ($v['groupid']==5){echo "个人会员";}else if ($v['groupid']==6){echo "企业会员";}else if ($v['groupid']==7){echo "VIP会员";}else{echo "会员组";}?>">
<td align="left">&nbsp;<a href="<?php echo company_url(site_url(),$v['username']);?>" rel="nofollow" target="_blank">&nbsp;&nbsp;<?php echo $v['company'];?></a></td>
<td align="left">&nbsp;<a href="<?php echo site_url("member/member/get_detail/{$v['username']}");?>" title="<?php echo $v['truename'];?>"><?php echo $v['username'];?></a></td>
<td align="left">&nbsp;<?php echo $v['truename'];?></td>
<td><?php echo $v['career'];?></td>
<td><?php echo $v['gender']?"女士":"男士";?></td>
<td><?php echo $v['mcompany']['telephone']?></td>
<td><?php echo $v['mobile'];?></td>
<td width="20"><?php if ($v['mobile']){?>
<a href="#"><img src="<?php echo base_url("skin/images/mobile.gif")?>" title="发送短信" alt=""></a>
<?php }?></td>
<td width="20">
<a href="javascript:Dwidget('<?php echo site_url("member/message/msg_send2/".$v['username']);?>', '发送消息');"><img width="16" height="16" src="<?php echo base_url("skin/images/msg.gif")?>" title="发送消息" alt=""></a>
</td> 
<td width="20"><a href="mailto:<?php echo $v['email']?>"><img width="16" height="16" src="<?php echo base_url("skin/images/email.gif")?>" title="发送邮件" alt=""></a></td>
<td width="20">
<?php if ($v['qq']){?>
<A href="tencent://message/?uin=<?php echo $v['qq']?>&amp;Menu=yes" target=blank><IMG title="点击这里给我发消息" src="http://wpa.qq.com/pa?p=4:<?php echo $v['qq']?>:4" border=0>
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

<td><span class="f_gray"><?php echo $v['online']?"上线":"离线"?></span></td>

<td>
<a href="<?php echo site_url("member/member/get_detail/{$v['username']}");?>"><img src="<?php echo base_url("skin/images/view.png");?>" width="16" height="16" title="会员<?php echo $v['username'];?>详细资料" alt=""></a> 
<a href="<?php echo site_url("member/member/login/{$v['userid']}/{$v['username']}")?>" target="_blank"><img src="<?php echo base_url("skin/images/set.png");?>" width="16" height="16" title="进入会员商务中心" alt=""></a> 
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
<script type="text/javascript">Menuon(4);</script>

</body></html>