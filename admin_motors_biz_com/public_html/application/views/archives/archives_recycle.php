<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>供应列表</title>
<meta name="robots" content="noindex,nofollow">
<script type="text/javascript">window.onerror= function(){return true;}</script><link rel="stylesheet" href="<?php echo base_url("skin/css/style.css")?>" type="text/css">
<script type="text/javascript" src="<?php echo base_url("skin/js/lang.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/config.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/jquery.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/common.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/admin.js")?>"></script>
<script type="text/javascript">
// function check_s(){
	// var pattern=/^\d+$/; 
	// if(Dd("id_input").value && !pattern.test(Dd("id_input").value)){
		// alert('会员ID只能为数字');
		// Dd("id_input").value='';
		// return false;
	// }
	// if(!pattern.test(Dd("psize").value)){
		// alert('每页记录数只能为数字');
		// Dd("psize").value=20;
		// return false;
	// }
	// return true;
// }
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
<td id="Tab0" class="tab"><a href="<?php echo site_url("archives/archives_add")?>">添加资讯</a></td><td class="tab_nav">&nbsp;</td>
<td id="Tab1" class="tab_on"><a href="<?php echo site_url("archives/archives_list")?>">资讯列表</a></td><td class="tab_nav">&nbsp;</td>
<td id="Tab2" class="tab"><a href="<?php echo site_url("module/sell/unapproved_sell2")?>">待审核供应</a></td><td class="tab_nav">&nbsp;</td>
<td id="Tab3" class="tab"><a href="<?php echo site_url("module/sell/expire_sell2")?>">过期供应</a></td><td class="tab_nav">&nbsp;</td>
<td id="Tab4" class="tab"><a href="<?php echo site_url("module/sell/rejected_sell2")?>">未通过供应</a></td><td class="tab_nav">&nbsp;</td>
<td id="Tab5" class="tab"><a href="<?php echo site_url("module/sell/trash2")?>">回收站</a></td><td class="tab_nav">&nbsp;</td>
<td id="Tab6" class="tab"><a href="<?php echo site_url("module/sell/move_cat2")?>">移动分类</a></td><td class="tab_nav">&nbsp;</td></tr>
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
<form action="<?php echo site_url("archives/archives_search")?>" method="post" onsubmit="return check_s();">
<input type="hidden" name="action" value="sell_list">
<div class="tt">供应搜索</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tbody><tr>
<td>
&nbsp;<select name="fields">
<option value="0" selected="selected">模糊</option>
<option value="1">标题</option>
<option value="2">产品品牌</option>
<option value="3">计量单位</option>
<option value="4">简介</option>
<option value="5">公司名</option>
<option value="6">联系人</option>
<option value="7">联系电话</option>
<option value="8">联系地址</option>
<option value="9">电子邮件</option>
<option value="10">会员名</option>
<option value="11">IP</option>
</select>&nbsp;
<input type="text" size="25" name="kw" value="" title="关键词">&nbsp;

<select name="order">
<option value="0" selected="selected">结果排序方式</option>
<option value="1">更新时间降序</option>
<option value="2">更新时间升序</option>
<option value="3">添加时间降序</option>
<option value="4">添加时间升序</option>
<option value="5">VIP级别降序</option>
<option value="6">VIP级别升序</option>
<option value="7">产品单价降序</option>
<option value="8">产品单价升序</option>
<option value="9">供货总量降序</option>
<option value="10">供货总量升序</option>
<option value="11">最小起订降序</option>
<option value="12">最小起订升序</option>
<option value="13">浏览次数降序</option>
<option value="14">浏览次数升序</option>
<option value="15">信息ID降序</option>
<option value="16">信息ID升序</option>
</select>&nbsp;
<!--<input type="text" name="psize" value="20" size="2" class="t_c" id="psize" title="条/页">-->
</td>
</tr>
<tr>
<td>
&nbsp;<select name="datetype">
<option value="edittime" selected=selected>更新日期</option>
<option value="addtime">发布日期</option>
<option value="totime">到期日期</option>
</select>&nbsp;
<script type="text/javascript" src="<?php echo base_url("skin/js/calendar.js")?>"></script>
<input type="text" name="fromdate" id="fromdate" value="" size="10" onfocus="ca_show('fromdate', this, '');" readonly="" ondblclick="this.value='';"> 
<img src="<?php echo base_url("skin/images/calendar.gif")?>" align="absmiddle" onclick="ca_show('fromdate', this, '');" style="cursor:pointer;"> 至 
<input type="text" name="todate" id="todate" value="" size="10" onfocus="ca_show('todate', this, '');" readonly="" ondblclick="this.value='';"> 
<img src="<?php echo base_url("skin/images/calendar.gif")?>" align="absmiddle" onclick="ca_show('todate', this, '');" style="cursor:pointer;">&nbsp;
用户名：<input type="text" size="4" name="username" value="" id="id_input">&nbsp;
<input type="checkbox" name="thumb" value="1">图片&nbsp;
<!--<input type="checkbox" name="vip" value="1">VIP&nbsp;-->
<input type="submit" value="搜 索" class="btn">&nbsp;
<input type="button" value="重 置" class="btn" onclick="this.form.reset();">
</td>
</tr>



</tbody></table>
</form>
<form method="post">
<div class="tt">供应列表</div>
<?php if($list!=null){ ?>

<table cellpadding="2" cellspacing="1" class="tb">
<tbody><tr>
<th width="25"><input type="checkbox" onclick="checkall(this.form);"></th>

<th width="160">标 题</th>
<th>类型</th>
<th>图片</th>
<th>内容</th>
<th width="70">会员</th>
<th width="145">发布时间</th>
<th>浏览</th>
<th width="50">操作</th>
</tr>
<?php foreach ($list as $v){?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td><input type="checkbox" name="itemid[]" value="<?php echo $v['itemid']?>"></td>
<td><?php echo mb_substr($v['title'], 0, 30, 'utf-8');?></td>
<td><?php 
if($v['typeid']==0){echo '未分类';}else{
foreach($class as $c){
if($c['id']==$v['typeid']){echo $c['classname'];break;}
}}
?></td>

<!--<td><img src="<?php echo $site['image_domain'].$v['thumb'];?>" alt="<?php echo $v['title'];?>" width="60" style="padding:5px;"></a></td>-->
<td>
<?php if($v['imgurl1']!=''){ ?>
<?php $rooturl=str_replace('index.php','',$_SERVER[SCRIPT_NAME]); ?>  <!-- [SCRIPT_NAME] => /air_admin/index.php 取出ari-->
<img src="<?php echo 'http://'.$_SERVER[SERVER_NAME].$rooturl.$v['imgurl1'];?>" width="60" style="padding:5px;"/>
<?php }else{echo ' 无图'; } ?>

</td>
<td align="center"><?php echo mb_substr($v['content'], 0, 80, 'utf-8').'...';?></td>

<td><a href="<?php echo site_url("member/member/get_detail/{$v['username']}");?>"><?php echo $v['author']?></a></td>


<td class="px11" title="添加时间<?php echo  date("Y-m-d h:s",$v['adddate']); ?>"><?php echo  date("Y-m-d h:s",$v['adddate']); ?></td>
<td class="px11"><?php echo $v['hits']?></td>
<td>
<a href="<?php echo site_url("archives/archives_edit/".$v['id'].'/'.$v['typeid'])?>"><img src="<?php echo base_url("skin/images/edit.png")?>" width="16" height="16" title="修改" alt=""></a>&nbsp;
<a href="<?php echo site_url("archives/archives_del_one/".$v['id'])?>" onclick="return _delete();"><img src="<?php echo base_url("skin/images/delete.png")?>" width="16" height="16" title="删除" alt=""></a>
</td>
</tr>
<?php }?>
</tbody></table>

<?php }else{echo '信息为空！！';} ?>

<div class="btns">


<input type="submit" value="恢复数据" class="btn" onclick="this.form.action='<?php echo site_url("archives/archives_del/datafrom")?>';">&nbsp;


<input type="submit" value=" 彻底删除 " class="btn" onclick="if(confirm('确定要删除选中供应吗？此操作将不可撤销')){this.form.action='<?php echo site_url("archives/archives_del/delete")?>'}else{return false;}">&nbsp;
<!--<input type="submit" value=" 移动分类 " class="btn" onclick="this.form.action='<?php echo site_url("module/sell/move_cat2")?>';">&nbsp;
<select name="level" onchange="this.form.action='<?php echo site_url("module/sell/modify_sell/set_level")?>';this.form.submit();">
<option value="0">设置级别为</option>
<option value="0">取消</option><option value="1">1 级 推荐信息</option><option value="2">2 级</option>
<option value="3">3 级</option><option value="4">4 级</option><option value="5">5 级</option>
<option value="6">6 级</option><option value="7">7 级</option><option value="8">8 级</option>
<option value="9">9 级</option></select>&nbsp;
<select name="tid" onchange="this.form.action='<?php echo site_url("module/sell/modify_sell/set_status")?>';this.form.submit();">
<option value="">设置状态为</option>
<option value="0">删除</option>
<option value="1">待审核</option>
<option value="2">审核未通过</option>
<option value="3">审核通过</option>
</select>-->
</div>
</form>
<!--<div class="pages">
<?php echo $page;?>


<p align='center'><?php echo($page); ?><p>

<br>
<script type="text/javascript">Menuon(1);</script>

</body></html>