<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>会员信件查看</title>
<meta name="robots" content="noindex,nofollow">
<script type="text/javascript">window.onerror= function(){return true;}</script>
<link rel="stylesheet" href="<?php echo base_url("skin/css/style.css")?>" type="text/css">
<script type="text/javascript" src="<?php echo base_url("skin/js/lang.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/config.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/jquery.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/common.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/admin.js")?>"></script>
</head>
<body>
<div class="menu" onselectstart="return false" id="destoon_menu">
<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody><tr>
<td valign="bottom">
<table cellpadding="0" cellspacing="0">
<tbody><tr>
<td width="10">&nbsp;</td>
<td id="Tab0" class="<?php echo $type=='all' ? 'tab_on' : 'tab';?>"><a href="<?php echo site_url("module/salesman_inquiry/inquiry_list")?>">所有询单</a></td><td class="tab_nav">&nbsp;</td>
<td id="Tab2" class="<?php echo $type=='unfinished' ? 'tab_on' : 'tab';?>"><a href="<?php echo site_url("module/salesman_inquiry/unfinished_list")?>">未联系的询单</a></td><td class="tab_nav">&nbsp;</td>
<td id="Tab3" class="<?php echo $type=='finished1' ? 'tab_on' : 'tab';?>"><a href="<?php echo site_url("module/salesman_inquiry/finished_list1")?>">已联系(有意向)的询单</a></td><td class="tab_nav">&nbsp;</td>
<td id="Tab4" class="<?php echo $type=='finished2' ? 'tab_on' : 'tab';?>"><a href="<?php echo site_url("module/salesman_inquiry/finished_list2")?>">已联系(无意向)的询单</a></td><td class="tab_nav">&nbsp;</td>
<td id="Tab5" class="<?php echo $type=='finished3' ? 'tab_on' : 'tab';?>"><a href="<?php echo site_url("module/salesman_inquiry/finished_list3")?>">已联系(意向不明)的询单</a></td><td class="tab_nav">&nbsp;</td>
<td id="Tab6" class="<?php echo $type=='rejected' ? 'tab_on' : 'tab';?>"><a href="<?php echo site_url("module/salesman_inquiry/rejected_list")?>">联系被拒的询单</a></td><td class="tab_nav">&nbsp;</td>
<td id="Tab7" class="<?php echo $type=='changepwd' ? 'tab_on' : 'tab';?>"><a href="<?php echo site_url("module/salesman_inquiry/change_pwd")?>">修改密码</a></td><td class="tab_nav">&nbsp;</td>
<td id="Tab8" class="tab"><a href="<?php echo site_url("reg_login/logout")?>" target="_top" onclick="if(!confirm('确实要注销登录吗?')) return false;"">安全退出</a></td><td class="tab_nav">&nbsp;</td>
</tr>
</tbody></table>
</td>
<td width="110"><div>
<img src="<?php echo base_url("skin/images/spacer.gif")?>" title="刷新" onclick="window.location.reload();" style="cursor:pointer;" alt="" height="24" width="40">
<img src="<?php echo base_url("skin/images/spacer.gif")?>" title="后退" onclick="history.back(-1);" style="cursor:pointer;" alt="" height="24" width="20">
<img src="<?php echo base_url("skin/images/spacer.gif")?>" title="前进" onclick="history.go(1);" style="cursor:pointer;" alt="" height="24" width="20">
<img src="<?php echo base_url("skin/images/spacer.gif")?>" title="帮助" onclick="" style="cursor:help;" alt="" height="24" width="20"></div></td>
</tr>
</tbody></table>
</div><div class="tt">询单详情</div>
<form method="post" action="<?php echo site_url("module/salesman_inquiry/save_inotice")?>" id="dform">
<input type="hidden" name="iid" value="<?php echo $inquiry_detail['id']?>"/>
<table class="tb" cellpadding="2" cellspacing="1">
<tbody><tr>
<td class="tl">询单标题</td>
<td class="f_b"><?php echo $inquiry_detail['title']?></td>
</tr>
<tr>
<td class="tl">询盘产品ID</td>
<td><a href="<?php echo sell_url(company_url("content/index/".$inquiry_detail['sid']."/".$inquiry_detail['item_url']),$inquiry_detail['username']);?>" target="_blank"><?php echo $inquiry_detail['sid']?></a></td>
</tr>
<tr>
<td class="tl">供应商</td>
<td><a href="<?php echo site_url("member/member/get_detail/{$inquiry_detail['touser']}");?>"><?php echo $inquiry_detail['touser']?></a></td>
</tr>
<tr>
<td class="tl">询盘人所在地区</td>
<td><?php echo $inquiry_detail['country']?></td>
</tr>
<tr>
<td class="tl">询盘时间</td>
<td><?php echo date('Y-m-d H:i:s',$inquiry_detail['postdate'])?></td>
</tr>
<tr>
<td class="tl">询盘地址</td>
<td><?php echo $inquiry_detail['ip']?></td>
</tr>
<tr>
<td class="tl">询盘内容</td>
<td><?php echo $inquiry_detail['inquiry_data']['message']?></td>
</tr>
<tr>
<td class="tl">操作人</td>
<td><?php echo $inquiry_detail['username']?></td>
</tr>
<?php if ($inquiry_detail['addtime']){?>
<tr>
<td class="tl">操作时间</td>
<td><?php echo date('Y-m-d H:i:s',$inquiry_detail['addtime'])?></td>
</tr>
<?php }?>
<tr>
<td class="tl">状态</td>
<td><select name="status">
<?php foreach ($status as $k=>$v){?>
	<option value="<?php echo $k?>" <?php if ($k==$inquiry_detail['sstatus']){echo 'selected';}?>><?php echo $v?></option>
<?php }?></select></td>
</tr>
<tr>
<td class="tl">备注</td>
<td><textarea rows="10" cols="50" name="note"><?php echo $inquiry_detail['note']?></textarea></td>
</tr>
</tbody>
</table>
<div class="sbt">
<div class="sbt"><input name="submit" value=" 确 定 " class="btn" type="submit">&nbsp;&nbsp;&nbsp;&nbsp;
<input value=" 返 回 " class="btn" onclick="history.back(-1);" type="button"></div>
</form>
<script type="text/javascript">Menuon(1);</script>

</body></html>