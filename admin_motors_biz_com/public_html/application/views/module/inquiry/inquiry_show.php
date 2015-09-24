<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>询单查看</title>
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
<td id="Tab0" class="<?php echo $class=='all' ? 'tab_on' : 'tab';?>"><a href="<?php echo site_url("module/inquiry/inquiry_list2")?>">所有询单</a></td><td class="tab_nav">&nbsp;</td>
<td id="Tab2" class="<?php echo $class=='need' ? 'tab_on' : 'tab';?>"><a href="<?php echo site_url("module/inquiry/unapproved_list2")?>">未审核询单</a></td><td class="tab_nav">&nbsp;</td>
<td id="Tab3" class="<?php echo $class=='approved' ? 'tab_on' : 'tab';?>"><a href="<?php echo site_url("module/inquiry/app_list2")?>">已通过的询单</a></td><td class="tab_nav">&nbsp;</td>
<td id="Tab5" class="<?php echo $class=='unapproved' ? 'tab_on' : 'tab';?>"><a href="<?php echo site_url("module/inquiry/rejected_list2")?>">未通过的询单</a></td><td class="tab_nav">&nbsp;</td>
<td id="Tab5" class="<?php echo $class=='unassign' ? 'tab_on' : 'tab';?>"><a href="<?php echo site_url("module/inquiry/unassign_list")?>">未分配的询单</a></td><td class="tab_nav">&nbsp;</td>
<td id="Tab6" class="<?php echo $class=='unfinished' ? 'tab_on' : 'tab';?>"><a href="<?php echo site_url("module/inquiry/unfinished_list")?>">未联系的询单</a></td><td class="tab_nav">&nbsp;</td>
<td id="Tab7" class="<?php echo $class=='rejected' ? 'tab_on' : 'tab';?>"><a href="<?php echo site_url("module/inquiry/rejected_list")?>">联系被拒的询单</a></td><td class="tab_nav">&nbsp;</td>
<td id="Tab8" class="<?php echo $class=='finished1' ? 'tab_on' : 'tab';?>"><a href="<?php echo site_url("module/inquiry/finished_list1")?>">已联系(有意向)的询单</a></td><td class="tab_nav">&nbsp;</td>
<td id="Tab9" class="<?php echo $class=='finished2' ? 'tab_on' : 'tab';?>"><a href="<?php echo site_url("module/inquiry/finished_list2")?>">已联系(无意向)的询单</a></td><td class="tab_nav">&nbsp;</td>
<td id="Tab10" class="<?php echo $class=='finished3' ? 'tab_on' : 'tab';?>"><a href="<?php echo site_url("module/inquiry/finished_list3")?>">已联系(意向不明)的询单</a></td><td class="tab_nav">&nbsp;</td>
<td id="Tab11" class="tab"><a href="<?php echo site_url("module/inquiry/auto_assign")?>">自动分配询单</a></td><td class="tab_nav">&nbsp;</td>
<td id="Tab12" class="<?php echo $class=='clear' ? 'tab_on' : 'tab';?>"><a href="<?php echo site_url("module/inquiry/inquiry_clear2")?>">询单清理</a></td><td class="tab_nav">&nbsp;</td></tr>
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
<form method="post">
<input type="hidden" name="itemid[]" value="<?php echo $inq_detail['id']?>"/>
<table class="tb" cellpadding="2" cellspacing="1">
<tbody><tr>
<td class="tl">标题</td>
<td class="f_b"><?php echo $inq_detail['title']?></td>
</tr>
<tr>
<td class="tl">询盘产品ID</td>
<td><a href=""><?php echo $inq_detail['sid']?></a></td>
</tr>
<tr>
<td class="tl">询盘人</td>
<td><a href="<?php echo site_url("member/member/get_detail/{$inq_detail['fromuser']}");?>"><?php echo $inq_detail['fromuser']?></a></td>
</tr>
<tr>
<td class="tl">供应商</td>
<td><a href="<?php echo site_url("member/member/get_detail/{$inq_detail['touser']}");?>"><?php echo $inq_detail['touser']?></a></td>
</tr>
<tr>
<td class="tl">询盘人所在地区</td>
<td><a href=""><?php echo $inq_detail['country']?></a></td>
</tr>
<tr>
<td class="tl">询盘人所在公司</td>
<td><a href=""><?php echo $inq_detail['company']?></a></td>
</tr>
<tr>
<td class="tl">询盘人电话</td>
<td><?php echo $inq_detail['telephone']?></td>
</tr>
<tr>
<td class="tl">询盘人手机号码</td>
<td><?php echo $inq_detail['mobile']?></td>
</tr>
<tr>
<td class="tl">询盘人邮箱</td>
<td><?php echo $inq_detail['email']?></td>
</tr>
<tr>
<td class="tl">询盘时间</td>
<td><?php echo date('Y-m-d H:i:s',$inq_detail['postdate'])?></td>
</tr>
<tr>
<td class="tl">询盘IP</td>
<td><?php echo $inq_detail['ip']?></td>
</tr>
<tr>
<td class="tl">内容</td>
<td><?php echo $inq_detail['inquiry_data']['message']?></td>
</tr>

<tr>
<td class="tl">分配状态</td>
<td><?php echo $inq_detail['assign']?></td>
</tr>
<tr>
<td class="tl">业务员</td>
<td><?php echo $inq_detail['salesman']?></td>
</tr>
<tr>
<td class="tl">联系状态</td>
<td><select name="status">
<?php foreach ($status as $k=>$v){?>
	<option value="<?php echo $k?>" <?php if ($k==$inq_detail['sstatus']){echo 'selected';}?>><?php echo $v?></option>
<?php }?></select>
</td>
</tr>
<tr>
<td class="tl">备注</td>
<td><textarea rows="10" cols="50" name="note"><?php echo $inq_detail['note']?></textarea></td>
</tr>

</tbody>
</table>
<div class="sbt">
<input type="submit" value=" 保存 " class="btn" onclick="this.form.action='<?php echo site_url("module/inquiry/save_notice/")?>';this.form.submit();">&nbsp;
<?php if ($class!='approved'){?><input type="submit" value=" 通过审核 " class="btn" onclick="Go('<?php echo site_url("module/inquiry/approve_inquiry/check/".$inq_detail['id'])?>');">&nbsp;<?php }?>
<?php if ($class!='unapproved'){?><input type="submit" value=" 拒 绝 " class="btn" onclick="Go('<?php echo site_url("module/inquiry/approve_inquiry/reject/".$inq_detail['id'])?>');">&nbsp;<?php }?>
<input value=" 删 除 " class="btn" onclick="if(confirm('确定要删除吗？此操作将不可撤销')) {Go('<?php echo site_url("module/inquiry/del_inquiry/".$inq_detail['id'])?>');}" type="button">&nbsp;&nbsp;
<select name="salesman" onchange="this.form.action='<?php echo site_url("module/inquiry/assign/")?>';this.form.submit();">
<option value="0">分配给</option>
<?php if (is_array($salesman)){foreach ($salesman as $v){?>
<option value="<?php echo $v['username']?>"><?php echo $v['username']?></option>
<?php }}?></select>&nbsp;
<input value=" 返 回 " class="btn" onclick="history.back(-1);" type="button"></div>
</form>
<script type="text/javascript">Menuon(1);</script>

</body></html>