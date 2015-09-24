<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>会员信件查看</title>
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
<td id="Tab0" class="tab"><a href="<?php echo site_url("member/message/msg_send2")?>">发送信件</a></td><td class="tab_nav">&nbsp;</td>
<td id="Tab1" class="tab_on"><a href="<?php echo site_url("member/message/msg_list2")?>">会员信件</a></td><td class="tab_nav">&nbsp;</td>
<td id="Tab2" class="tab"><a href="<?php echo site_url("member/message/msg_system2")?>">系统信件</a></td><td class="tab_nav">&nbsp;</td>
<td id="Tab4" class="tab"><a href="<?php echo site_url("member/message/msg_clear2")?>">信件清理</a></td><td class="tab_nav">&nbsp;</td></tr>
</tbody></table>
</td>
<td width="110"><div>
<img src="<?php echo base_url("skin/images/spacer.gif")?>" title="刷新" onclick="window.location.reload();" style="cursor:pointer;" alt="" height="24" width="40">
<img src="<?php echo base_url("skin/images/spacer.gif")?>" title="后退" onclick="history.back(-1);" style="cursor:pointer;" alt="" height="24" width="20">
<img src="<?php echo base_url("skin/images/spacer.gif")?>" title="前进" onclick="history.go(1);" style="cursor:pointer;" alt="" height="24" width="20">
<img src="<?php echo base_url("skin/images/spacer.gif")?>" title="帮助" onclick="" style="cursor:help;" alt="" height="24" width="20"></div></td>
</tr>
</tbody></table>
</div><div class="tt">站内信件</div>
<table class="tb" cellpadding="2" cellspacing="1">
<tbody><tr>
<td class="tl">标题</td>
<td class="f_b"><?php echo $msg_detail['title']?></td>
</tr>
<tr>
<td class="tl">发件人</td>
<td><?php echo $msg_detail['fromuser']?></td>
</tr>
<tr>
<td class="tl">收件人</td>
<td><?php echo $msg_detail['touser']?></td>
</tr>
<tr>
<td class="tl">发信时间</td>
<td><?php echo date('Y-m-d H:i:s',$msg_detail['addtime'])?></td>
</tr>
<tr>
<td class="tl">发信IP</td>
<td><?php echo $msg_detail['ip']?></td>
</tr>
<tr>
<td class="tl">内容</td>
<td><?php echo $msg_detail['content']?></td>
</tr>
</tbody>
</table>
<div class="sbt"><input value=" 删 除 " class="btn" onclick="if(confirm('确定要删除吗？此操作将不可撤销')) {Go('<?php echo site_url("member/message/del_msg/".$msg_detail['mid'])?>');}" type="button">&nbsp;&nbsp;
<input value=" 返 回 " class="btn" onclick="history.back(-1);" type="button"></div>
<script type="text/javascript">Menuon(1);</script>

</body></html>