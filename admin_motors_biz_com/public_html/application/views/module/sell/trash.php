<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title></title>
<meta name="robots" content="noindex,nofollow">
<script type="text/javascript">window.onerror= function(){return true;}</script><link rel="stylesheet" href="<?php echo base_url("skin/css/style.css")?>" type="text/css">
<script "text/javascript" src="<?php echo base_url("skin/js/lang.js")?>"></script>
<script "text/javascript" src="<?php echo base_url("skin/js/config.js")?>"></script>
<script "text/javascript" src="<?php echo base_url("skin/js/jquery.js")?>"></script>
<script "text/javascript" src="<?php echo base_url("skin/js/common.js")?>"></script>
<script "text/javascript" src="<?php echo base_url("skin/js/admin.js")?>"></script>
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
<td id="Tab0" class="tab"><a href="<?php echo site_url("module/sell/add_sell2")?>">添加供应</a></td>
<td class="tab_nav">&nbsp;</td><td id="Tab1" class="tab"><a href="<?php echo site_url("module/sell/sell_list2")?>">供应列表</a></td>
<td class="tab_nav">&nbsp;</td><td id="Tab2" class="tab"><a href="<?php echo site_url("module/sell/unapproved_sell2")?>">待审核供应</a></td>
<td class="tab_nav">&nbsp;</td><td id="Tab3" class="tab"><a href="<?php echo site_url("module/sell/expire_sell2")?>">过期供应</a></td>
<td class="tab_nav">&nbsp;</td><td id="Tab4" class="tab"><a href="<?php echo site_url("module/sell/rejected_sell2")?>">未通过供应</a></td>
<td class="tab_nav">&nbsp;</td><td id="Tab5" class="tab_on"><a href="<?php echo site_url("module/sell/trash2")?>">回收站</a></td>
<td class="tab_nav">&nbsp;</td><td id="Tab6" class="tab"><a href="<?php echo site_url("module/sell/move_cat2")?>">移动分类</a></td>
<td class="tab_nav">&nbsp;</td></tr>
</tbody></table>
</td>
<td width="110"><div>
<img src="<?php echo base_url("skin/images/spacer.gif")?>" title="刷新" onclick="window.location.reload();" style="cursor:pointer;" alt="" height="24" width="40">
<img src="<?php echo base_url("skin/images/spacer.gif")?>" title="后退" onclick="history.back(-1);" style="cursor:pointer;" alt="" height="24" width="20">
<img src="<?php echo base_url("skin/images/spacer.gif")?>" title="前进" onclick="history.go(1);" style="cursor:pointer;" alt="" height="24" width="20">
<img src="<?php echo base_url("skin/images/spacer.gif")?>" title="帮助" onclick="" style="cursor:help;" alt="" height="24" width="20"></div></td>
</tr>
</tbody></table>
</div>
<form method="post">
<div class="tt">回收站</div>
<table class="tb" cellpadding="2" cellspacing="1">
<tbody><tr>
<th width="25"><input onclick="checkall(this.form);" type="checkbox"></th>
<th width="160">行业</th>
<th>类型</th>
<th width="14"> </th>
<th>图片</th>
<th>标 题</th>
<th width="180">价格</th>
<th width="70">会员</th>
<th width="145">更新时间</th>
<th>浏览</th>
<th width="50">操作</th>
</tr>

<?php foreach ($sell as $v){?>
<tr class="" onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td><input name="itemid[]" value="<?php echo $v['itemid']?>" type="checkbox"></td>
<td><a href="<?php echo site_main(site_url("clist/index/".$v['all_linkurl']));?>" target="_blank"><?php echo $v['catname']?></a></td>
<td><?php echo $type;?></td>
<td><?php if ($v['level']){echo "<img alt='' title='",$v['level'],"级' src='",base_url("skin/images/level_".$v['level'].".gif"),"'>";}?></td>
<td><a href="javascript:_preview('<?php echo $site['image_domain'].$v['thumb'];?>');">
<img src="<?php echo $site['image_domain'].$v['thumb'];?>" alt="<?php echo $v['title'];?>" style="padding:5px;" width="60"></a></td>
<td align="left">&nbsp;<a href="<?php echo company_url(site_url("content/index/".$v['itemid']."/".$v['linkurl']),$v['username']);?>" target="_blank"><?php echo $v['title']?></a></td>
<td><?php echo $v['currency'],' ',$v['minprice'],'——',$v['maxprice'],'/',$v['unit']?></td>
<td>
<a href="<?php echo site_url("member/member/get_detail/{$v['username']}");?>"><?php echo $v['username']?></a>
</td>
<td class="px11" title="添加时间<?php echo $v['adddate']?>"><?php echo $v['adddate']?></td>
<td class="px11"><?php echo $v['hits']?></td>
<td>
<a href="<?php echo site_url("module/sell/edit_sell2/".$v['itemid'])?>"><img src="<?php echo base_url("skin/images/edit.png")?>" title="修改" alt="" height="16" width="16"></a>&nbsp;
<a href="<?php echo site_url("module/sell/del_sell/delete/".$v['itemid']."/trash2")?>" onclick="return _delete();"><img src="<?php echo base_url("skin/images/delete.png")?>" title="删除" alt="" height="16" width="16"></a>
</td>
</tr>
<?php }?>
</tbody></table>
<div class="btns">


<input value=" 彻底删除 " class="btn" onclick="if(confirm('确定要删除选中供应吗？此操作将不可撤销')){this.form.action='<?php echo site_url("module/sell/del_sell/pack/")?>'}else{return false;}" type="submit">&nbsp;
<input value=" 还 原 " class="btn" onclick="if(confirm('确定要还原选中供应吗？状态将被设置为已通过')){this.form.action='<?php echo site_url("module/sell/del_sell/restore/")?>'}else{return false;}" type="submit">&nbsp;
<input value=" 清 空 " class="btn" onclick="if(confirm('确定要清空回收站吗？此操作将不可撤销')){this.form.action='<?php echo site_url("module/sell/del_sell/clear/")?>'}else{return false;}" type="submit">

</div>
</form>
<div class="pages">
<?php echo $pages?>
&nbsp;<cite>共<?php echo $sell_count?>条/<?php echo $total_page?>页</cite>&nbsp;
<input type="text" class="pages_inp" id="destoon_pageno" value="1" onkeydown="if(event.keyCode==13 && this.value && this.value>=1  && this.value<=<?php echo $total_page?>) {var page_size=<?php echo $page_size?>;var page=(this.value-1)*page_size;window.location.href='<?php echo substr($base_url,0,-5)?>/'+page;return false;}"> 
<input type="button" class="pages_btn" value="GO" onclick="if(Dd('destoon_pageno').value>=1 && Dd('destoon_pageno').value<=<?php echo $total_page?>){var page_size=<?php echo $page_size?>;var page=(Dd('destoon_pageno').value-1)*page_size;window.location.href='<?php echo substr($base_url,0,-5)?>/'+page;}else{Dmsg('页码不正确，请重填', 'go');}"><span id="dgo" class="f_red"></span></div>
<br>
<script type="text/javascript">Menuon(5);</script>

</body></html>