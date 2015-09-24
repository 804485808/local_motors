<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>会员详细资料</title>
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
<div class="tt">会员资料</div>
<table class="tb" cellpadding="2" cellspacing="1">
<tbody>
<tr>
<td rowspan="9" class="f_gray" align="center" width="160">
<img src="<?php echo $company['thumb'] ? $site['image_domain'].$company['thumb'] : base_url("skin/images/show.jpg");?>" width= "120" height="100">
<div style="padding:5px 0 0 0;">
<a href="<?php echo site_url("member/member/login/".$user['userid']."/".$user['username']);?>" class="t" target="_blank" title="点击登入会员商务中心">会员前台</a> | 
<a href="<?php echo site_url("member/member/member_edit2/".$user['userid']);?>" class="t">修改资料</a>
</div>
<div style="padding:2px 0 2px 0;">
<a href="<?php echo site_url("member/member/check/forbid/".$user['userid']);?>" class="t" onclick="return confirm('确定要禁止此会员访问吗？');">禁止访问</a> | 
<a href="<?php echo site_url("member/member/del/".$user['userid']."/".$user['userid']);?>" class="t" onclick="return confirm('确定要删除此会员吗？系统将删除选中用户所有信息，此操作将不可撤销');">删除会员</a><br>
</div>

<a href="javascript:Dwidget('<?php echo site_url("member/message/msg_send2/".$user['username']);?>', '发送消息');"><img width="16" height="16" src="<?php echo base_url("skin/images/msg.gif")?>" title="发送消息" alt=""></a>
<a href=""><img src="<?php echo base_url("skin/images/mobile.gif");?>" title="发送短信" alt=""></a>
<a href="mailto:<?php echo $user['email']?>"><img width="16" height="16" src="<?php echo base_url("skin/images/email.gif");?>" title="发送邮件" alt=""></a>
<?php if ($user['qq']){?>
<A href="tencent://message/?uin=<?php echo $user['qq']?>&amp;Menu=yes" target=blank><IMG title="点击这里给我发消息" src="http://wpa.qq.com/pa?p=4:<?php echo $user['qq']?>:4" border=0>
</A><?php }?>
<?php if ($user['skype']){?>
<a rel="nofollow" href="skype:<?php echo $user['skype']?>">
<img align="absmiddle" alt="" title="点击Skype通话" src="http://mystatus.skype.com/smallicon/<?php echo $user['skype']?>">
</a><?php }?>
<?php if ($user['ali']){?>
<a href="http://web.im.alisoft.com/msg.aw?v=2&amp;uid=<?php echo $user['ali']?>&amp;site=cnalichn&amp;s=1" target="_blank">
<img alt="发送旺旺即时消息" src="http://amos.im.alisoft.com/online.aw?v=2&uid=<?php echo $user['ali']?>&site=cnalichn&s=6"/></a>
<?php }?>
</td>
<td class="tl">会员名</td>
<td>&nbsp;<?php echo $user['username'];?>&nbsp;
[<span class="f_gray"><?php echo $user['online']?"上线":"离线"?></span>]
</td>
<td class="tl">会员ID</td>
<td>&nbsp;<?php echo $user['userid'];?>&nbsp;&nbsp;
</td>
</tr>
<tr>
<td class="tl">通行证名</td>
<td>&nbsp;<?php echo $user['passport'];?></td>
<td class="tl">会员组</td>
<td class="f_red">&nbsp;企业会员</td>
</tr>

<tr>
<td class="tl">姓 名</td>
<td>&nbsp;<?php echo $user['truename'];?></td>
<td class="tl">性 别</td>
<td>&nbsp;<?php echo $user['gender']?"女士":"男士";?></td>
</tr>
<tr>
<td class="tl">VIP指数</td>
<td>&nbsp;<img src="<?php echo base_url("skin/images/vip_0.gif")?>"></td>
<td class="tl">登录次数</td>
<td>&nbsp;<?php echo $user['logintimes'];?></td>
</tr>
<tr>
<td class="tl">上次登录</td>
<td>&nbsp;<?php echo date('Y-m-d H:i:s',$user['logintime']);?></td>
<td class="tl">登录IP</td>
<td>&nbsp;<a href="javascript:get_ip('<?php echo $user['loginip']?>');" title="显示IP所在地"><?php echo $user['loginip']?></a></td>
</tr>
<tr>
<td class="tl">注册时间</td>
<td>&nbsp;<?php echo date('Y-m-d H:i:s',$user['regtime']);?></td>
<td class="tl">注册IP</td>
<td>&nbsp;<a href="javascript:get_ip('<?php echo $user['regip']?>');" title="显示IP所在地"><?php echo $user['regip']?></a></td>
</tr>
<tr>
<td class="tl">资金余额</td>
<td>&nbsp;<strong class="f_red"><?php echo sprintf('%1.0f',$company['capital']);?></strong> <?php echo $company['regunit'];?></td>
<td class="tl">会员积分</td>
<td>&nbsp;<strong class="f_blue"><?php echo $user['credit']?></strong> 点</td>
</tr>
<tr>
<th class="tl" colspan="4">
<a href="<?php echo site_url("module/sell/view_list/".$user['username']);?>" class="t" title="查看该会员供应产品">供应产品列表</a>(<?php echo $sell_count;?>)&nbsp;&nbsp;|&nbsp;&nbsp;
<a href="<?php echo site_url("module/inquiry/view_list/".$user['username']);?>" class="t" title="查看该会员询单">询单列表</a>(<?php echo $inquiry_count;?>)&nbsp;&nbsp;|&nbsp;&nbsp;
<a href="<?php echo site_url("member/message/view_list/".$user['username']);?>" class="t" title="查看该会员站内信">站内信列表</a>(<?php echo $msg_count;?>)&nbsp;&nbsp;|&nbsp;&nbsp;
<a href="<?php echo site_url("member/friend/view_list/".$user['username']);?>" class="t" title="查看该会员商友">会员商友列表</a>(<?php echo $friend_count;?>)&nbsp;&nbsp;
</th>
</tr>
</tbody></table>
<div class="tt">公司资料</div>
<table class="tb" cellpadding="2" cellspacing="1">
<tbody><tr>
<td class="tl">公司主页</td>
<td colspan="3">&nbsp;<?php echo $company['homepage'];?>
</tr>
<tr>
<td class="tl">公司名称</td>
<td>&nbsp;<?php echo $company['company'];?></td>
<td class="tl">公司类型</td>
<td>&nbsp;<?php echo $company['ctype'];?></td>
</tr>
<tr><td class="tl">经营模式</td>
<td>&nbsp;<?php echo $company['mode'];?></td>
<td class="tl">主营范围</td>
<td>&nbsp;<?php echo $company['business'];?></td>
</tr>
<tr>
<td class="tl">注册资本</td>
<td>&nbsp;<?php echo sprintf('%1.0f',$company['capital']);?> <?php echo $company['regunit'];?></td>
<td class="tl">公司规模</td>
<td>&nbsp;<?php echo $company['size'];?></td>
</tr>
<tr>
<td class="tl">成立年份</td>
<td>&nbsp;<?php echo $company['regyear'];?></td>
<td class="tl">公司所在地</td>
<td>&nbsp;<?php echo $company['regcity'];?></td>
</tr>
</tbody></table>

<div class="tt">联系方式</div>
<table class="tb" cellpadding="2" cellspacing="1">
<tbody><tr>
<td class="tl">姓 名</td>
<td>&nbsp;<?php echo $user['truename'];?></td>
<td class="tl">手 机</td>
<td>&nbsp;<a href=""><img src="<?php echo base_url("skin/images/mobile.gif")?>" title="发送短信" align="absmiddle"></a><?php echo $user['mobile'];?></td>
</tr>
<tr>
<td class="tl">部 门</td>
<td>&nbsp;<?php echo $user['department'];?></td>
<td class="tl">职 位</td>
<td>&nbsp;<?php echo $user['career'];?></td>
</tr>
<tr>
<td class="tl">电 话</td>
<td>&nbsp;<?php echo $company['telephone'];?></td>
<td class="tl">传 真</td>
<td>&nbsp;</td>
</tr>
<tr>
<td class="tl">Email (不公开)</td>
<td>&nbsp;
<a href="mailto:<?php echo $user['email']?>"><img width="16" height="16" src="<?php echo base_url("skin/images/email.gif")?>" title="发送邮件" alt=""></a>
 <?php echo $user['email'];?></td>
<td class="tl">Email (公开)</td>
<td>&nbsp;<a href="mailto:<?php echo $company['mail']?>"><img width="16" height="16" src="<?php echo base_url("skin/images/email.gif")?>" title="发送邮件" alt=""></a>
<?php echo $company['mail'];?></td>
</tr>
<tr>
<td class="tl">QQ</td>
<td>&nbsp; <?php if ($user['qq']){?>
<A href="tencent://message/?uin=<?php echo $user['qq']?>&amp;Menu=yes" target=blank><IMG title="点击这里给我发消息" src="http://wpa.qq.com/pa?p=4:<?php echo $user['qq']?>:4" border=0>
</A><?php } echo $user['qq'];?></td>
<td class="tl">阿里旺旺</td>
<td>&nbsp;<?php if ($user['ali']){?>
<a href="http://web.im.alisoft.com/msg.aw?v=2&amp;uid=<?php echo $user['ali']?>&amp;site=cnalichn&amp;s=1" target="_blank">
<img alt="发送旺旺即时消息" src="http://amos.im.alisoft.com/online.aw?v=2&uid=<?php echo $user['ali']?>&site=cnalichn&s=6"/></a>
<?php }echo $user['ali'];?></td>
</tr>
<tr>
<td class="tl">Skype</td>
<td>&nbsp; <?php if ($user['skype']){?>
<a rel="nofollow" href="skype:<?php echo $user['skype']?>">
<img align="absmiddle" alt="" title="点击Skype通话" src="http://mystatus.skype.com/smallicon/<?php echo $user['skype']?>">
</a><?php } echo $user['skype'];?></td>
<td class="tl">邮 编</td>
<td>&nbsp;<?php echo $company['zipcode'];?></td>
</tr>
<tr>
<td class="tl">网 址</td>
<td>&nbsp;<?php echo $company['homepage'];?></td>
<td class="tl">公司经营地址</td>
<td colspan="3">&nbsp;<?php echo $company['address'];?></td>
</tr>
</tbody></table>
<div class="tt">其他信息</div>
<table class="tb" cellpadding="2" cellspacing="1">
<tbody>
<tr>
<td class="tl">推荐注册人</td>
<td>&nbsp;<a href="#" target="_blank"><?php echo $user['inviter'];?></a></td>
</tr>
<tr>
<td class="tl">公司认证是否通过</td>
<td>&nbsp;<?php echo $user['vcompany']?"是":"否";?></td>
</tr>
<tr>
<td class="tl">实名认证是否通过</td>
<td>&nbsp;<?php echo $user['vtruename']?"是":"否";?></td>
</tr>
<tr>
 <td class="tl">注册号</td>
<td>&nbsp;<?php echo $company['regno'];?></td>
</tr>
<tr>
 <td class="tl">发证机关</td>
<td>&nbsp;<?php echo $company['authority'];?></td>
</tr>
<tr>
<td class="tl">资料更新时间</td>
<td>&nbsp;<?php echo date("Y-m-d H:i:d",$user['edittime']);?></td>
</tr>
</tbody></table>
<div class="sbt">
<input type="button" value=" 修 改 " class="btn" onclick="Go('<?php echo site_url("member/member/member_edit2/{$user['userid']}");?>');">&nbsp;&nbsp;
<input type="button" value=" 前 台 " class="btn" onclick="window.open('<?php echo site_url("member/member/login/{$user['userid']}/{$user['username']}")?>');">&nbsp;&nbsp;
<input type="button" value=" 返 回 " class="btn" onclick="history.back(-1);"></div>
</body></html>