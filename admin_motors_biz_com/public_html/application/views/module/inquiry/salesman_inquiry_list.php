<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>会员询单列表::<?php echo $username?></title>
<meta name="robots" content="noindex,nofollow">
<script type="text/javascript">
window.onerror= function(){return true;}
</script>
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
<img src="<?php echo base_url("skin/images/spacer.gif")?>" width="40" height="24" title="刷新" onclick="window.location.reload();" style="cursor:pointer;" alt="">
<img src="<?php echo base_url("skin/images/spacer.gif")?>" width="20" height="24" title="后退" onclick="history.back(-1);" style="cursor:pointer;" alt="">
<img src="<?php echo base_url("skin/images/spacer.gif")?>" width="20" height="24" title="前进" onclick="history.go(1);" style="cursor:pointer;" alt="">
<img src="<?php echo base_url("skin/images/spacer.gif")?>" width="20" height="24" title="帮助" onclick="" style="cursor:help;" alt=""></div></td>
</tr>
</tbody></table>
</div>
<form method="post">
<div class="tt">会员询单管理&nbsp;&nbsp;&nbsp;&nbsp;Welcome&nbsp;<?php echo $username?>!</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tbody><tr>
<th width="100">状态</th>
<th>询单标题</th>
<th>产品ID</th>
<th>供应商</th>
<th>询单时间</th>
<th>询单地址</th>
<th>操作人</th>
<th>操作时间</th>
<th>备注</th>
</tr>
<?php foreach ($inquiry_notice as $v){?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td><?php echo $v['status']?></td>
<td align="left"><a href="<?php echo site_url("module/salesman_inquiry/inquiry_show/".$type."/".$v['id'])?>" title="<?php echo $v['title']?>">&nbsp;<?php echo $v['title']?></a></td>
<td><a href="<?php echo company_url(site_url("content/index/".$v['itemid']."/".$v['item_url']),$v['username']);?>" target="_blank"><?php echo $v['itemid']?></a></td>
<td><a href="<?php echo site_url("member/member/get_detail/{$v['seller']}");?>"><?php echo $v['seller']?></a></td>
<td class="px11"><?php echo date('Y-m-d H:i:s',$v['postdate']);?></td>
<td class="px11"><?php echo $v['ip']?></td>
<td><?php echo $v['username']?></td>
<td class="px11"><?php echo date('Y-m-d H:i:s',$v['addtime']);?></td>
<td><?php echo $v['note']?></td>
</tr>
<?php }?>
</tbody></table>
</form>
<div class="pages"><?php echo $pages?>
<cite>共<?php echo $notice_count?>条/<?php echo $total_page?>页</cite>&nbsp;
<input type="text" class="pages_inp" id="destoon_pageno" value="1" onkeydown="if(event.keyCode==13 && this.value && this.value>=1 && this.value<=<?php echo $total_page?>) {var page_size=<?php echo $page_size?>;var page=(this.value-1)*page_size;window.location.href='<?php echo substr($base_url,0,-5)?>/'+page;return false;}"> 
<input type="button" class="pages_btn" value="GO" onclick="if(Dd('destoon_pageno').value>=1 && Dd('destoon_pageno').value<=<?php echo $total_page?>){var page_size=<?php echo $page_size?>;var page=(Dd('destoon_pageno').value-1)*page_size;window.location.href='<?php echo substr($base_url,0,-5)?>/'+page;}else{Dmsg('页码不正确，请重填', 'go');}"><span id="dgo" class="f_red"></span></div>
<script type="text/javascript">Menuon(1);</script>
<br>

</body></html>