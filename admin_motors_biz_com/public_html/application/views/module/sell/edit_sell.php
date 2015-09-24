<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>修改供应</title>
<meta name="robots" content="noindex,nofollow">
<script type="text/javascript">window.onerror= function(){return true;}</script><link rel="stylesheet" href="<?php echo base_url("skin/css/style.css")?>" type="text/css">
<script type="text/javascript" src="<?php echo base_url("skin/js/lang.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/config.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/jquery.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/common.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/admin.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/ae.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/jquery-1.4.js")?>"></script>
<SCRIPT type="text/javascript">
function load_category(catid){
	$.post('<?php echo site_url("/module/sell/check_sell_category/")?>',{"catid" : catid},function(data){
				 $show = Number(data);
				 if($show==1){
					$("#catid").val(catid);
				 }
	});
}

function del_img(id){
	$.post("<?php echo site_url("/uploadimg/del_img/")?>",{"path" : Dd(id).value});
	Dd(id).value='';
}
</SCRIPT>
</head>
<body onload="initEditor()">
<div id="msgbox" onmouseover="closemsg();" style="display:none;"></div>
<div class="menu" onselectstart="return false" id="destoon_menu">
<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody><tr>
<td valign="bottom">
<table cellpadding="0" cellspacing="0">
<tbody><tr>
<td width="10">&nbsp;</td>
<td id="Tab0" class="tab"><a href="<?php echo site_url("module/sell/add_sell2")?>">添加供应</a></td>
<td class="tab_nav">&nbsp;</td><td id="Tab1" class="tab_on"><a href="<?php echo site_url("module/sell/sell_list2")?>">供应列表</a></td>
<td class="tab_nav">&nbsp;</td><td id="Tab2" class="tab"><a href="<?php echo site_url("module/sell/unapproved_sell2")?>">待审核供应</a></td>
<td class="tab_nav">&nbsp;</td><td id="Tab3" class="tab"><a href="<?php echo site_url("module/sell/expire_sell2")?>">过期供应</a></td>
<td class="tab_nav">&nbsp;</td><td id="Tab4" class="tab"><a href="<?php echo site_url("module/sell/rejected_sell2")?>">未通过供应</a></td>
<td class="tab_nav">&nbsp;</td><td id="Tab5" class="tab"><a href="<?php echo site_url("module/sell/trash2")?>">回收站</a></td>
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
<form method="post" action="<?php echo site_url("module/sell/save_sell")?>" id="dform" onsubmit="return check();">
<input type="hidden" name="post[itemid]" value="<?php echo $sell['itemid']?>"/>
<div class="tt">修改供应</div>
<table class="tb" cellpadding="2" cellspacing="1">
<tbody><tr>
<td class="tl"><span class="f_red">*</span> 信息类型</td>
<td>
<input name="post[typeid]" value="0" checked="checked" id="typeid_0" type="radio"> <label for="typeid_0" id="t_0">供应</label>&nbsp;
<input name="post[typeid]" value="1" id="typeid_1" type="radio"> <label for="typeid_1" id="t_1">提供服务</label>&nbsp;
<input name="post[typeid]" value="2" id="typeid_2" type="radio"> <label for="typeid_2" id="t_2">供应二手</label>&nbsp;
<input name="post[typeid]" value="3" id="typeid_3" type="radio"> <label for="typeid_3" id="t_3">提供加工</label>&nbsp;
<input name="post[typeid]" value="4" id="typeid_4" type="radio"> <label for="typeid_4" id="t_4">提供合作</label>&nbsp;
<input name="post[typeid]" value="5" id="typeid_5" type="radio"> <label for="typeid_5" id="t_5">库存</label>&nbsp;
</td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 信息标题</td>
<td>
<input name="post[title]" id="title" size="60" value="<?php echo $sell['title']?>" type="text">
<select name="post[level]"><option selected="selected" value="0">级别</option><option value="1">1 级 推荐信息</option><option value="2">2 级</option><option value="3">3 级</option><option value="4">4 级</option><option value="5">5 级</option><option value="6">6 级</option><option value="7">7 级</option><option value="8">8 级</option><option value="9">9 级</option></select> <script type="text/javascript" src="<?php echo base_url("skin/js/color.js")?>"></script><style type="text/css">.color_div_o {width:16px;height:16px;padding:4px 0 0 4px;background:#B6BDD2;cursor:crosshair;}.color_div_t {width:16px;height:16px;padding:4px 0 0 4px;background:#F1F2F3;}.color_div {border:#808080 1px solid;width:10px;height:10px;line-height:10px;font-size:1px;}</style><input name="post[style]" id="color_input_1" value="" type="hidden"><img src="<?php echo base_url("skin/images/color.gif")?>" id="color_img_1" style="cursor:pointer;background:" onclick="color_show(1, Dd('color_input_1').value, this);" height="18" align="absmiddle" width="21"> <br><span id="dtitle" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 行业分类</td>
<td>
<DIV class="selectListCate" id="selectListCate">
	<input type="hidden" id="catid" name="post[catid]" value="<?php echo $sell['catid']?>" /> 
	<DIV class="clearfix multiSelectList" id="multiSelectList">
		<SELECT name="oneSelect" tabindex="1" class="column" id="oneSelect" style="height: 214px;" size="10" onchange="load_category(this.value)"></SELECT> 
		<SELECT name="twoSelect" tabindex="2" class="column" id="twoSelect" style="height: 214px; display: none;" size="10" onchange="load_category(this.value)"></SELECT>         
		<SELECT name="threeSelect" tabindex="3" class="column" id="threeSelect" style="height: 214px; display: none;" size="10" onchange="load_category(this.value)"></SELECT>
		<SELECT name="fourSelect" tabindex="4" class="column last" id="fourSelect" style="height: 214px; display: none;" size="10" onchange="load_category(this.value)"></SELECT>
	 </DIV>
</DIV>
<br><input value="搜索分类" onclick="schcate(5);" class="btn" type="button"> <span id="dcatid" class="f_red"></span></td>
</tr>
<!-- <tr>
<td class="tl"><span class="f_hid">*</span> 产品品牌</td>
<td><input name="post[brand]" size="30" value="河北川源" type="text"></td>
</tr> -->
<tr>
<td class="tl"><span class="f_hid">*</span> 详细说明</td>
<td>
<textarea name="post[content]" id="post[content]" rows="20" cols="100"><?php echo $sell['sell_data']['content']?></textarea>
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 产品图片</td>
<td>
	<input name="post[thumb]" type="text" size="60" id="thumb" value="<?php if($sell['thumb']) echo $sell['thumb'];?>">&nbsp;&nbsp;
	<span onclick="Dthumb(2,180,180,Dd('thumb').value);" class="jt">[上传]</span>&nbsp;&nbsp;
	<span onclick="del_img('thumb');" class="jt">[删除]</span><br/>
	
	<input name="post[thumb1]" type="text" size="60" id="thumb1" value="<?php if($sell['thumb1']) echo $sell['thumb1'];?>">&nbsp;&nbsp;
	<span onclick="Dthumb(2,180,180,Dd('thumb1').value,'','thumb1');" class="jt">[上传]</span>&nbsp;&nbsp;
	<span onclick="del_img('thumb1');" class="jt">[删除]</span><br/>
	
	<input name="post[thumb2]" type="text" size="60" id="thumb2" value="<?php if($sell['thumb2']) echo $sell['thumb2'];?>">&nbsp;&nbsp;
	<span onclick="Dthumb(2,180,180,Dd('thumb2').value,'','thumb2');" class="jt">[上传]</span>&nbsp;&nbsp;
	<span onclick="Dd('thumb2').value='';" class="jt">[删除]</span><br/>

	<!-- <input name="post[thumb]" id="thumb" value="<?php echo $site['image_domain'].$sell['thumb'];?>" type="hidden">
	<input name="post[thumb1]" id="thumb1" value="" type="hidden">
	<input name="post[thumb2]" id="thumb2" value="" type="hidden">
	<table width="360">
	<tbody><tr class="c_p" height="120" align="center">
	<td width="120"><img src="<?php echo $sell['thumb']?$site['image_domain'].$sell['thumb']:base_url("skin/images/waitpic.gif");?>" id="showthumb" title="预览图片" alt="" onclick="if(this.src.indexOf('waitpic.gif') == -1){_preview(Dd('showthumb').src, 1);}else{Dalbum('',5,100,100, Dd('thumb').value, true);}" height="100" width="100"></td>
	<td width="120"><img src="<?php echo base_url("skin/images/waitpic.gif")?>" id="showthumb1" title="预览图片" alt="" onclick="if(this.src.indexOf('waitpic.gif') == -1){_preview(Dd('showthumb1').src, 1);}else{Dalbum(1,5,100,100, Dd('thumb1').value, true);}" height="100" width="100"></td>
	<td width="120"><img src="<?php echo base_url("skin/images/waitpic.gif")?>" id="showthumb2" title="预览图片" alt="" onclick="if(this.src.indexOf('waitpic.gif') == -1){_preview(Dd('showthumb2').src, 1);}else{Dalbum(2,5,100,100, Dd('thumb2').value, true);}" height="100" width="100"></td>
	</tr>
	<tr class="c_p" align="center">
	<td><span onclick="Dalbum('',5,100,100, Dd('thumb').value, true);" class="jt"><img src="<?php echo base_url("skin/images/img_upload.gif")?>" title="上传" height="12" width="12"></span>&nbsp;&nbsp;<img src="<?php echo base_url("skin/images/img_select.gif")?>" title="选择" onclick="selAlbum('');" height="12" width="12">&nbsp;&nbsp;<span onclick="delAlbum('', 'wait');" class="jt"><img src="<?php echo base_url("skin/images/img_delete.gif")?>" title="删除" height="12" width="12"></span></td>
	<td><span onclick="Dalbum(1,5,100,100, Dd('thumb1').value, true);" class="jt"><img src="<?php echo base_url("skin/images/img_upload.gif")?>" title="上传" height="12" width="12"></span>&nbsp;&nbsp;<img src="<?php echo base_url("skin/images/img_select.gif")?>" title="选择" onclick="selAlbum(1);" height="12" width="12">&nbsp;&nbsp;<span onclick="delAlbum(1, 'wait');" class="jt"><img src="<?php echo base_url("skin/images/img_delete.gif")?>" title="删除" height="12" width="12"></span></td>
	<td><span onclick="Dalbum(2,5,100,100, Dd('thumb2').value, true);" class="jt"><img src="<?php echo base_url("skin/images/img_upload.gif")?>" title="上传" height="12" width="12"></span>&nbsp;&nbsp;<img src="<?php echo base_url("skin/images/img_select.gif")?>" title="选择" onclick="selAlbum(2);" height="12" width="12">&nbsp;&nbsp;<span onclick="delAlbum(2, 'wait');" class="jt"><img src="<?php echo base_url("skin/images/img_delete.gif")?>" title="删除" height="12" width="12"></span></td>
	</tr>
	</tbody></table> -->
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 过期时间</td>
<td><script type="text/javascript" src="<?php echo base_url("skin/js/calendar.js")?>"></script>
<input name="post[totime]" id="posttotime" value="<?php echo date("Y-m-d",$sell['totime'])?>" size="10" onfocus="ca_show('posttotime', this, '-');" readonly="readonly" ondblclick="this.value='';" type="text"> <img src="<?php echo base_url("skin/images/calendar.gif")?>" onclick="ca_show('posttotime', this, '-');" style="cursor:pointer;" align="absmiddle">&nbsp;
<select onchange="Dd('posttotime').value=this.value;">
<option selected="selected" value="">快捷选择</option>
<option value="">长期有效</option>
<option value="<?php echo date("Y-m-d",strtotime("+3 days"));?>">3天</option>
<option value="<?php echo date("Y-m-d",strtotime("+1 week"));?>">一周</option>
<option value="<?php echo date("Y-m-d",strtotime("+15 days"));?>">半月</option>
<option value="<?php echo date("Y-m-d",strtotime("+1 month"));?>">一月</option>
<option value="<?php echo date("Y-m-d",strtotime("+6 months"));?>">半年</option>
<option value="<?php echo date("Y-m-d",strtotime("+1 year"));?>">一年</option>
</select>&nbsp;
<span id="dposttotime" class="f_red"></span> 不选表示长期有效</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 主要参数</td>
<td class="nv">
<table cellspacing="1">
<tbody><tr>
<th>参数名称</th>
<th>参数值</th>
</tr>
<tr>
<td><input name="post[model_name]" size="10" value="型号" id="n1" type="text" disabled></td>
<td><input name="post[model]" size="20" value="" id="v1" type="text"></td>
</tr>
<tr>
<td><input name="post[standard_name]" size="10" value="规格" id="n2" type="text" disabled></td>
<td><input name="post[standard]" size="20" value="" id="v2" type="text"></td>
</tr>
<tr>
<td><input name="post[brand_name]" size="10" value="品牌"  id="n3" type="text" disabled></td>
<td><input name="post[brand]" size="20" value=""  id="v3" type="text"></td>
</tr>
<tr>
<td class="f_gray">例如：规格</td>
<td class="f_gray">例如：10cm*20cm</td>
</tr>
</tbody></table>
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 交易条件</td>
<td>
	<table width="100%">
	<tbody><tr>
	<td width="70">计量单位</td>
	<td><input name="post[unit]" size="10" value="<?php echo $sell['unit']?>" onkeyup="if(this.value){Dd('u1').innerHTML=Dd('u2').innerHTML=Dd('u3').innerHTML=this.value;}" id="u0" type="text">
	<input id="uu" value="单位" type="hidden"></td>
	</tr>
	<tr>
	<td width="70">货币单位</td>
	<td><input name="post[currency]" size="10" value="<?php echo $sell['currency']?>" onkeyup="if(this.value){Dd('c1').innerHTML=this.value;}" id="u0" type="text">
	<input id="uu" value="货币" type="hidden"></td>
	</tr>
	<tr>
	<td>产品单价</td>
	<td><input name="post[minprice]" size="10" value="<?php echo $sell['minprice']?>" type="text">—— 
	<input name="post[maxprice]" size="10" value="<?php echo $sell['maxprice']?>" type="text">
	<span id="c1"><?php echo $sell['currency']?></span>/<span id="u1"><?php echo $sell['unit']?></span></td>
	</tr>
	<tr>
	<td>最小起订量</td>
	<td><input name="post[minamount]" size="10" value="<?php echo $sell['minamount']?>" type="text"> <span id="u2"><?php echo $sell['unit']?></span></td>
	</tr>
	<tr>
	<td>供货总量</td>
	<td><input name="post[amount]" size="10" value="<?php echo $sell['amount']?>" type="text"> <span id="u3"><?php echo $sell['unit']?></span></td>
	</tr>
	<tr>
	<td>发货期限</td>
	<td>自买家付款之日起 <input name="post[days]" size="2" value="1" type="text"> 天内发货</td>
	</tr>
	</tbody></table>
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 会员信息</td>
<td>
<input name="ismember" value="1" checked="checked" onclick="Dh('d_guest');Ds('d_member');Dd('username').value='hbcy1198';" id="ismember_1" type="radio"><label for="ismember_1"> 是</label>&nbsp;&nbsp;&nbsp;
<input name="ismember" value="0" onclick="Dh('d_member');Ds('d_guest');Dd('username').value='';" id="ismember_0" type="radio"><label for="ismember_0"> 否</label>
</td>
</tr>
</tbody><tbody id="d_member" style="display:">
<tr>
<td class="tl"><span class="f_red">*</span> 会员名</td>
<td><input name="post[username]" size="20" value="<?php echo $sell['username']?>" id="username" type="text"> 
<a href="<?php echo site_url("member/member/get_detail/{$sell['username']}");?>" class="t">[资料]</a> <span id="dusername" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 会员推荐产品</td>
<td>
<input name="post[elite]" value="1" checked="checked" type="radio"> 是&nbsp;&nbsp;&nbsp;
<input name="post[elite]" value="0" type="radio"> 否
</td>
</tr>
</tbody>
<tbody id="d_guest" style="display:none">
<tr>
<td class="tl"><span class="f_red">*</span> 公司名称</td>
<td class="tr"><input name="post[company]" id="company" size="50" value="<?php echo $sell['company']?>" type="text"> 个人请填姓名 例如：张三<br><span id="dcompany" class="f_red"></span> </td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 所在地区</td>
<td class="tr">
<input name="post[areaid]" id="areaid_1" value="5" type="hidden">
<span id="load_area_1"><select onchange="load_area(this.value, 1);">
<option value="0">请选择</option>
<?php foreach ($areaname as $v){?>
<option value="<?php echo $v['areaid']?>" <?php if ($areaid==$v['areaid']){echo "selected";}?>><?php echo $v['areaname']?></option>
<?php }?>
</select> </span>
<script type="text/javascript">
var area_title = new Array;area_title[1]='请选择';var area_extend = new Array;
area_extend[1]='';var area_areaid = new Array;area_areaid[1]='5';var area_deep = new Array;area_deep[1]='0';</script>
<script type="text/javascript" src="<?php echo base_url("skin/js/area.js")?>"></script>
<span id="dareaid" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 联系人</td>
<td class="tr"><input name="post[truename]" id="truename" size="20" value="<?php echo $sell['truename']?>" type="text"> <span id="dtruename" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 联系手机</td>
<td class="tr"><input name="post[mobile]" id="mobile" size="30" value="<?php echo $sell['mobile']?>" type="text"> <span id="dmobile" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 电子邮件</td>
<td class="tr"><input name="post[email]" id="email" size="30" value="<?php echo $sell['email']?>" type="text"> <span id="demail" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 联系电话</td>
<td class="tr"><input name="post[telephone]" id="telephone" size="30" value="<?php echo $sell['telephone']?>" type="text"> <span id="dtelephone" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 联系地址</td>
<td class="tr"><input name="post[address]" id="address" size="60" value="<?php echo $sell['address']?>" type="text"></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> QQ</td>
<td class="tr"><input name="post[qq]" id="qq" size="30" value="<?php echo $member['qq']?>" type="text"></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 阿里旺旺</td>
<td class="tr"><input name="post[ali]" id="ali" size="30" value="<?php echo $sell['ali']?>" type="text"></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> MSN</td>
<td class="tr"><input name="post[msn]" id="msn" size="30" type="text"></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> Skype</td>
<td class="tr"><input name="post[skype]" id="skype" size="30" value="<?php echo $member['skype']?>" type="text"></td>
</tr>
</tbody>
<tbody><tr>
<td class="tl"><span class="f_hid">*</span> 信息状态</td>
<td>
<?php foreach ($status as $k=>$v){?>
	<input name="post[status]" value="<?php echo $k?>" <?php if ($k==$sell['status']){echo "checked";}?> type="radio"> <?php echo $v?>
<?php }?>

<!-- <input name="post[status]" value="4" checked="checked" type="radio"> 通过
<input name="post[status]" value="1" type="radio"> 待审
<input name="post[status]" value="2" onclick="if(this.checked) Dd('note').style.display='';" type="radio"> 拒绝
<input name="post[status]" value="5" type="radio"> 过期
<input name="post[status]" value="0" type="radio"> 删除 -->
</td>
</tr>
<tr id="note" style="display:none">
<td class="tl"><span class="f_red">*</span> 拒绝理由</td>
<td><input name="post[note]" size="40" type="text"></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 添加时间</td>
<td><input size="22" name="post[adddate]" value="<?php echo $sell['adddate']?>" type="text"></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 浏览次数</td>
<td><input name="post[hits]" size="10" value="<?php echo $sell['hits']?>" type="text"></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 内容收费</td>
<td><input name="post[fee]" size="5" value="<?php echo $sell['fee']?>" type="text"> <img src="<?php echo base_url("skin/images/help.png")?>" title="不填或填0表示继承模块设置价格，-1表示不收费&lt;br/&gt;大于0的数字表示具体收费价格" alt="tips" class="c_p" onclick="Dconfirm(this.title, '', 450);" height="11" width="11"></td>
</tr>
<!-- <tr>
<td class="tl"><span class="f_hid">*</span> 内容模板</td>
<td><span id="destoon_template_1"><select name="post[template]" id="template"><option selected="selected" value="">默认模板</option></select></span>&nbsp;&nbsp;<a href="javascript:tpl_edit('show',%20'sell',%201);" class="t">[修改]</a> &nbsp;<a href="javascript:tpl_add('show',%20'sell');" class="t">[新建]</a> <img src="<?php echo base_url("skin/images/help.png")?>" title="如果没有特殊需要，一般不需要选择&lt;br/&gt;系统会自动继承分类或模块设置" alt="tips" class="c_p" onclick="Dconfirm(this.title, '', 450);" height="11" width="11"></td>
</tr> -->
</tbody></table>
<div class="sbt">
<input name="submit" value=" 确 定 " class="btn" type="submit">&nbsp;&nbsp;&nbsp;&nbsp;
<input name="reset" value=" 重 置 " class="btn" type="reset"></div>
</form>
<script type="text/javascript" src="<?php echo base_url("skin/js/clear.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/guest.js")?>"></script>
<script type="text/javascript">
function _p() {
	if(Dd('tag').value) {
		Ds('reccate');
	}
}
function check() {
	var l;
	var f;
	f = 'catid_1';
	if(Dd(f).value == 0) {
		Dmsg('请选择所属行业', 'catid', 1);
		return false;
	}
	f = 'title';
	l = Dd(f).value.length;
	if(l < 2) {
		Dmsg('标题最少2字，当前已输入'+l+'字', f);
		return false;
	}
	if(Dd('ismember_1').checked) {
		f = 'username';
		l = Dd(f).value.length;
		if(l < 2) {
			Dmsg('请填写会员名', f);
			return false;
		}
	} else {
		f = 'company';
		l = Dd(f).value.length;
		if(l < 2) {
			Dmsg('请填写公司名称', f);
			return false;
		}
		if(Dd('areaid_1').value == 0) {
			Dmsg('请选择所在地区', 'areaid');
			return false;
		}
		f = 'truename';
		l = Dd(f).value.length;
		if(l < 2) {
			Dmsg('请填写联系人', f);
			return false;
		}
		f = 'mobile';
		l = Dd(f).value.length;
		if(l < 7) {
			Dmsg('请填写手机', f);
			return false;
		}
	}
		if(Dd('property_require') != null) {
		var ptrs = Dd('property_require').getElementsByTagName('option');
		for(var i = 0; i < ptrs.length; i++) {		
			f = 'property-'+ptrs[i].value;
			if(Dd(f).value == 0 || Dd(f).value == '') {
				Dmsg('请填写或选择'+ptrs[i].innerHTML, f);
				return false;
			}
		}
	}
	return true;
}
</script>
<SCRIPT type="text/javascript">  
  function queryString() {
      var Url = window.location.href;
      var u,
      g,
      StrBack = '';
      if (arguments[arguments.length - 1] == "#") {
          u = Url.split("#");
      } else {
          u = Url.split("?");
      }
      if (u.length == 1) {
          g = '';
      } else {
          g = u[1];
      }
      if (g != '') {
          gg = g.split("&");
          var MaxI = gg.length;
          str = arguments[0] + "=";
          for (i = 0; i < MaxI; i++) {
              if (gg[i].indexOf(str) == 0) {
                  StrBack = gg[i].replace(str, "");
                  break;
              }
          }
      }
      return StrBack;
      }
  function getUrlParameter(name, url){
      if( !url ){
          var url = location.href;
      }
      if(url.indexOf("?")==-1 || url.indexOf(name+'=')==-1){
          return false;
      }
      var queryString = url.substring(url.indexOf("?") + 1);
      var parameters = queryString.split("&");
      var pos, paraName, paraValue;
      for(var i = 0; i < parameters.length; i++){
          pos = parameters[i].indexOf('=');
          if(pos == -1) { continue; }
          paraName = parameters[i].substring(0, pos);
          paraValue = parameters[i].substring(pos + 1); 
          if(paraName == name){
              return unescape(paraValue.replace(/\+/g, " "));
          }
      }
      return false;
  };
 
  
  
  var Category = function( parentNode, id, title, hasPrivilege, warnMessage ){
      this.id=id;
      this.title = title;
      this.hasPrivilege = hasPrivilege;
      this.warnMessage = warnMessage;
      
      this.childCategorys = [];
      if( parentNode ){ this.applyParent( parentNode ); }
  };
  var warnMessageMap = {};
  var warnMessageMapIndex = 0;
  
  Category.prototype = {
      applyParent:function( parentNode ){		
        this.parentNode = parentNode;
          this.parentNode.addChild( this );
      },
      addChild:function( node ){
          this.childCategorys.push( node );
      },
      getChildOptions:function(){
          if( this.option == null ){
              this.option = new Option( this.title, this.id );
              this.option.setAttribute('hasPrivilege',this.hasPrivilege);
          
              if(this.warnMessage != 'b' && this.warnMessage != ''){
                  
                  warnMessageMap[warnMessageMapIndex] = this.warnMessage;
                  this.option.setAttribute('warnMessage',warnMessageMapIndex);
                  warnMessageMapIndex ++;
              }else{
                  this.option.setAttribute('warnMessage',this.warnMessage);
              }
      
              if(this.hasPrivilege == 'false'){
                  this.option.setAttribute('disabled',true);
              }
          };
  
          return this.option;
      }
  };
  
  var cat1;
  var cat2;
  var cat3;
  var cat4;
  
  var root=new Category(null, "0", ")", "true","");
			<?php foreach($cat1 as $k => $c1):?>
			cat1=new Category(root, "<?php echo $c1['catid']?>","<?php echo addslashes($c1['catname'])?>", "true", "")
				<?php foreach($cat2[$c1['catid']] as $c2):?>
				cat2=new Category(cat1, "<?php echo $c2['catid']?>","<?php echo addslashes($c2['catname'])?>", "true",  "" )
					<?php foreach($cat3[$c2['catid']] as $c3):?>
					cat3=new Category(cat2, "<?php echo $c3['catid']?>","<?php echo addslashes($c3['catname'])?>", "true", "" )
						<?php foreach($cat4[$c3['catid']] as $c4):?>
							 cat4=new Category(cat3, "<?php echo $c4['catid']?>","<?php echo addslashes($c4['catname'])?>", "true", "" )
						<?php endforeach;?>
					<?php endforeach;?>
				<?php endforeach;?>
			<?php endforeach;?>
              
                                                                                       
  function trim(str, leftTrim, rightTrim, mbspaceTrim) {
      if (leftTrim == null) {
          leftTrim = true;
      }
  
      if (rightTrim == null) {
          rightTrim = true;
      }
  
      if (mbspaceTrim == null) {
          mbspaceTrim = true;
      }
  
      var newstr = str;
      if (leftTrim) {
          newstr = newstr.replace(/^\s+/g, "");
          if (mbspaceTrim) {
              newstr = newstr.replace(/^(　|\s)+/g, "");
          }
      }
      if (rightTrim) {
          newstr  =newstr.replace(/\s+$/g, "");
          if (mbspaceTrim) {
              newstr = newstr.replace(/(　|\s)+$/g, "");
          }
      }
      return newstr;
  }
  </SCRIPT>
   
  <SCRIPT type="text/javascript">
  function showHiddenByIds(){
      var args = arguments;
      if( args.length == 0 ){ return ;}
      for( var i = 0; i<args.length; i+=2 ){
          if( i+1 >= args.length){ break;};
          YUD.setStyle( args[i],'display', args[i+1]);
      }
  }
  
  var mainform = document.MyCategoryForm;
  var one = get("oneSelect");
  var two = get("twoSelect");
  var three = get("threeSelect");
  var four = get("fourSelect");
  var result = get("resultSelect");
  var catObjArry = new Array(one,two,three,four);
  var addObj = get("submit_add");
  var dCategoryName = get('commonCategoryName');
  
  var beginIndex = 0;
  var selectedCatId=0;
  var maxCates=4;
  var isInited = false;
  function fillCategory(obj,category){
      if (obj==null) return ;
      var size = category.childCategorys.length;
      for(var i=0;i<size;i++){
          obj.options[i + beginIndex] = category.childCategorys[i].getChildOptions();
      }
  }
  
    function init(){
      if (root == null) return;
      fillCategory(one,root);
      //index = locateOption(one,selectedCatId);
      //if (index<0) index=0;
      //one.selectedIndex=index;
      
      //changeSelectListCate( one, true);
  
      YUE.on(one, 'change', function(){
          changeSelectListCate( one );
      });
      YUE.on(two, 'change', function(){
          changeSelectListCate( two );
      });
      YUE.on(three, 'change', function(){
          changeSelectListCate( three );
      });
      YUE.on(four, 'change', function(){
          changeSelectListCate( four );
      });
      YUE.on(one, 'dblclick', selectedLastClose);
      YUE.on(two, 'dblclick', selectedLastClose);
      YUE.on(three, 'dblclick', selectedLastClose);
      YUE.on(four, 'dblclick', selectedLastClose);
      YUE.on( get('hiddenProductListOption'), 'click', selfClose);
  
          if(two.options.length>0){
      two.style.display='';
          three.style.display='none';
          four.style.display='none';
      }
      if(three.options.length>0){
          two.style.display='';
          three.style.display='';
          four.style.display='none';
      }
      if(four.options.length>0){
          two.style.display='';
          three.style.display='';
          four.style.display='';
      }
      isInited = true;
  }
  
  function changeOne(){
      change(one,two);
      selectClear(three);
      selectClear(four);
      changeAddButton();
  }
  
  function changeTwo(){
      change(two,three);
      selectClear(four);
      changeAddButton();
  }
  
  function changeThree(){
      change(three,four);
      changeAddButton();
  }
  
  function changeFour(){
      changeAddButton();
  }
  
  function selectedLastClose(){
      if( isSelectLastCate() ){
          selfClose();
      }
  }
  
  function changeSelectListCate( el, isDoInit){
      switch( el.id ){
          case 'oneSelect':{
              changeOne();
              break;
          }
          
          case 'twoSelect':{
              changeTwo();
              break;
          }
          
          case 'threeSelect':{
              changeThree();
              break;
          }
          
          case 'fourSelect':{
              changeFour();
              break;
          }
      }
      submitData();
      if( isDoInit ){
          return;
      }
      
      selectedData();
      if( el ){
          setElementWidth( el );
      }	
      setContainerWidth(  );
      
      if (navigator.appVersion.indexOf("MSIE 5.5") >= 0 || navigator.appVersion.indexOf("MSIE 6.0") >= 0 || navigator.appVersion.indexOf("MSIE 7.0") >= 0)
      {	
          ReloadSelectElement();
      }
      
      
  }
  function setElementWidth( el ){
      var minWidth = 180;
      var sEl;
      
      if(el.id === 'oneSelect'){
          sEl = 'twoSelect';
      }
      if(el.id === 'twoSelect'){
          sEl = 'threeSelect';
      }
      if(el.id === 'threeSelect'){
          sEl = 'fourSelect';
      }
      if(el.id === 'fourSelect'){
          return;
      }
      el = get(sEl);
      YUD.setStyle(el,'width','auto');
      var w = getElementWidth( el );
      if(w < minWidth){
          YUD.setStyle(el, 'width', minWidth + 'px');
      }else{
          YUD.setStyle(el, 'width', w + 'px');
      }
      
  }
  function setContainerWidth( ){
      var wholeWidth = get('selectListCate').offsetWidth;
      var w1 = getElementWidth( one);
      var w2 = getElementWidth( two );
      var w3 = getElementWidth( three );
      var w4 = getElementWidth( four );
      
      var w = w1 + w2 + w3 + w4;
      if( w > wholeWidth){
          YUD.setStyle('multiSelectList', 'width', w + 'px');
          //var h = parseInt(YUD.getStyle('selectListCate', 'height'));
          //YUD.setStyle('selectListCate', 'height', h + 10 + 'px' );
          
          var left = 0;
          if (window.innerHeight) {
              left = window.pageXOffset;
            }
            else if (document.documentElement && document.documentElement.scrollTop) {
              left = document.documentElement.scrollLeft;
            }
            else if (document.body) {
              left = document.body.scrollLeft;
            }
          scrollToRight();
      }else{
          //var h = parseInt(YUD.getStyle('selectListCate', 'height'));
          //YUD.setStyle('selectListCate', 'height', h - 10 + 'px' );
          YUD.setStyle('multiSelectList', 'width', 'auto');
      }	
  }
  
  function scrollToRight(){
          var anim = new YAHOO.util.Scroll ( 'selectListCate', {
              scroll:{to: [1024, 0]}
          },2);
          anim.animate();
      
  }
  
  
  function getElementWidth( el ){
          if(YUD.getStyle(el,'display') === 'none'){
              return 0;
          }else{
              return el.offsetWidth + 10;
          }
  }
  
  
  function isSelectLastCate(){
   if(catObjArry == null) return false;
   for(var j=0;j<catObjArry.length;j++){
      catObj=catObjArry[j];
      if (catObj!=null){
         index=catObj.selectedIndex;
         if (catObj.options.length>0&&catObj.selectedIndex==-1)
         {
            return false;
         }
      }
   }
   return true;
  }
  
  function changeAddButton(){
      if (addObj==null) return ;
          if (result.options.length>=maxCates){
          addObj.disabled=true;
          return ;
      }
  
          if (!isSelectLastCate()){
      addObj.disabled=true;
      return ;
      }
      addObj.disabled=false;
  }
  
  function change(ddlb,changedDdlb){
      var index = ddlb.selectedIndex;
      selectClear(changedDdlb);
      if(ddlb.selectedIndex == -1) return;
  
      var selectedValue=ddlb.options[index].value;
      var currCate=getCurrentOption(root,selectedValue);
      if (currCate==null)return ;
          var childCategorys=currCate.childCategorys
      if (childCategorys==null) return ;
      var size=childCategorys.length;
      for(var i=0;i<size;i++){
          changedDdlb.options[i] = childCategorys[i].getChildOptions();
      }
          changedDdlb.selectedIndex = -1;
      if(size>0){
          changedDdlb.style.display="";
          changeLabelShow(changedDdlb,true);
      }
  }
  
  
  function getCurrentOption(category,catId){
      var childCategorys=category.childCategorys;
      if (childCategorys==null) {
          return null;
      }
      var len = childCategorys.length;
      for(var j=0;j<len;j++){
          if (childCategorys[j].id==catId){
              return childCategorys[j];
          }
          var re=getCurrentOption(childCategorys[j],catId);
          if (re!=null){
              return re;
          }
      }
      return null;
  }
  
  function getCatBuyCatId(category,catId){
      if (root==null) return null;
      var childCategorys=category.childCategorys;
      if (childCategorys==null) {
          return null;
      }
      for(var j=0;j<len;j++){
          if (childCategorys[j].id==catId){
              return childCategorys[j];
          }
      }
      return null;
  }
  
  function locateOption(oSel,itemValue){
      if(oSel==null) return -1;
      for(var j=0;j<oSel.options.length;j++){
          if (oSel.options[j].value==itemValue){
              return j;
          }
      }
      return -1;
  }
  
  function canAddItem(){
      if (result.options.length>=maxCates){
          alert("Sorry, you have chosen more than "+maxCates+" categories. Please check and choose again.");
          return false;
      }
      return true;
  }
  
  function selectedData(){
  
          if(two.options.length>0){
          two.style.display='';
          three.style.display='none';
          four.style.display='none';
      }
      if(three.options.length>0){
          two.style.display='';
          three.style.display='';
          four.style.display='none';
      }
      if(four.options.length>0){
          two.style.display='';
          three.style.display='';
          four.style.display='';
      }
  }
  
  function selectLastHint(){
      if(isSelectLastCate() == true) {
          showHiddenByIds('catgoryListTitle','none','selectedLastInfo','');
      } else {
          showHiddenByIds('catgoryListTitle','','selectedLastInfo','none');
      }
  }
  
  function submitData(){
      var oData = getSelectData();
      var isLast = isSelectLastCate();
      var categoryIds = '';
      
      /* 如果是false不载入下一级
      if(oData.hasPrivilege == 'false'){
          
          return;
      }
      */
      if( isLast == true ){
          categoryIds = oData.lastId;
      }
      if(typeof(parent.callbackSelectCategoryChange) == "function"){
          
          parent.callbackSelectCategoryChange({
              'categoryName': XMLDecode(oData.cateName),
              'categoryIds': oData.lastId, 
              'categoryIdsPathStr':oData.categoryIdsPathStr,
              'isLast':isLast,
              'hasPrivilege':oData.hasPrivilege,
              'warnMessage':oData.warnMessage,
              'catType':'all',
              'warnMessageMap': warnMessageMap
              },'browseCate');
      }else{
          
          try{
              findItem('commonCategoryIds',parent.document).value  = categoryIds;
              findItem('commonCategoryName',parent.document).value = XMLDecode(oData.cateName);
          }catch(E){}
      }
  }
  
  function getSelectData(){
      var oData = {cateName:'',lastId:'',categoryIdsPathStr:'',hasPrivilege:'',warnMessage:''};
      var categoryIdsPath = [];
      for(var j = 0; j < catObjArry.length; j++){
          catObj = catObjArry[j];
          if (catObj == null){
              break;
          }
          var index = catObj.selectedIndex;
          
          if (index == -1){
              break;
          }
          
          if(oData.cateName == ""){
              oData.cateName = catObj.options[index].innerHTML;
          }else{
              oData.cateName = oData.cateName+" >> "+catObj.options[index].innerHTML;
          }
          oData.lastId = catObj.options[index].value;
          oData.hasPrivilege = catObj.options[index].getAttribute('hasPrivilege');
          oData.warnMessage = catObj.options[index].getAttribute('warnMessage');
          
          categoryIdsPath.push(trim(catObj.options[index].value));
      }
      
      
      oData.categoryIdsPathStr = toCategoryIdsPathStrString( categoryIdsPath );
      return oData;
  }
  
  function toCategoryIdsPathStrString( a ){
          var s = '';
          if(!YL.isArray(a)){
              return s;
          }
          for(var i = 0, len = a.length; i < len; i++){
              if(a[i] != -1 || a[i] != '-1'){
                  s  = s + a[i] + ',';
              }
          }
          return s.substring(0,s.length-1);
          
  }
  
  function findItem(n, d) {
      var p,x,i;
      if(!d) d=document;
      if((p=n.indexOf("?"))>0&&parent.frames.length) {
          d=parent.frames[n.substring(p+1)].document;
          n=n.substring(0,p);
      }
      if(!(x=d[n])&&d.all)
          x=d.all[n];
      for (i=0;!x&&i<d.forms.length;i++)
          x=d.forms[i][n];
      for(i=0;!x&&d.layers&&i<d.layers.length;i++)
          x=findItem(n,d.layers[i].document);
      return x;
  }
  
  function XMLDecode(str){
      str = str.replace(/&amp;/ig,"&");
      str = str.replace(/&lt;/ig,"<");
      str = str.replace(/&gt;/ig,">");
      str = str.replace(/&apos;/ig,"'");
      str = str.replace(/&quot;/ig,"\"");
      return str;
  }
  
  function search(formObj){
      if(trim(formObj.keyword.value) == ''){
          alert('Please input a search term.');
          return false;
      }
      if (formObj.categoryIdsStr!=null) {
          formObj.categoryIdsStr.value = makeSelectCateStr();
      }
  
      return true;
  }
  
  function makeSelectCateStr(){
      var str="";
      for(var j=0;j<result.options.length;j++){
          if (j==0) {
              str=result.options[0].value;
          } else{
          str=str+","+result.options[j].value;
          }
      }
      return str;
  }
  
  function changeLabelShow(oSel,isShow){
      if (oSel==null||oSel.id==null) return;
      var labObj=document.getElementById(oSel.id+"_lab");
  
      if (labObj!=null){
          if (isShow){
              labObj.style.display="";
          } else{
              labObj.style.display="none";
          }
      }
  }
  
  function selectClear(oSel){
      if (oSel==null) return;
  
      oSel.length = 0;
          oSel.style.height=one.style.height;
          changeLabelShow(oSel,false);
  }
  
  function selfClose(){
      //submitData();
      if( typeof( parent.callbackCloseSelectCategory ) == 'function' ){
          parent.callbackCloseSelectCategory();
      }
      
      if( typeof( parent.callbackDoCategorySubmit ) == 'function' ){
          parent.callbackDoCategorySubmit();
      }
  }
  init();
  
  
  //根据参数初始化选择类目
  //参数'36,1512,361270,36127020'或者直接是数组;
  //Agriculture >> Agricultural & Gardening Tools >> Brush Cutters
  
  //initSelectedPathByName('Consumer Electronics&gt;&gt;DVD, VCD Player');
  
  function initSelectedPathByName( categoryName ){
      _initSelectedPath( categoryName, 'name');
  }
  
  function initSelectedPathByIds( categoryIdsPathStr ){
      _initSelectedPath( categoryIdsPathStr, 'id');
  }
  
  
  function _initSelectedPath( categoryPathStr, which ){
      var categoryPath;
      
      if(!which || which === ''){
          which = 'id';
      }
      
      if(YL.isArray(categoryPathStr)){
          if(categoryPathStr.length === 0){
              return;
          }
          categoryPath = categoryPathStr;
      }else{
          if(YL.isString( categoryPathStr )){
              if(categoryPathStr === ''){
                  return;
              }
              if(which === 'name'){
                  categoryPathStr = XMLDecode( categoryPathStr );
                  categoryPath = categoryPathStr.split('>>');
              }
              if(which === 'id'){
                  categoryPath = categoryPathStr.split(',');
              }
              
          }
      }
      var cat0 = categoryPath[0];
      if( cat0 ){
          selectOption(one, cat0, which);
          changeSelectListCate( one );
      }
      var cat1 = categoryPath[1];
      if( cat1 ){
          selectOption(two, cat1, which);
          changeSelectListCate( two );
      }
      
      var cat3 = categoryPath[2];
      if( cat3 ){
          selectOption(three, cat3, which);
          changeSelectListCate( three );
      }
      
      var cat4 = categoryPath[3];
      if( cat4 ){
          selectOption(four, cat4, which);
          changeSelectListCate( four );
      }
      
  }
  
  function selectOption(el , v, which){
      for(var i = 0, len = el.options.length; i < len; i++){
          if(which === 'id' && el.options[i].value == v){
              el.options[i].selected = true;
          }
          
          if(which === 'name' && el.options[i].text.trim() == v.trim()){
              el.options[i].selected = true;
          }
      }
  }
  
  if (navigator.appVersion.indexOf("MSIE 5.5") >= 0 || navigator.appVersion.indexOf("MSIE 6.0") >= 0 || navigator.appVersion.indexOf("MSIE 7.0") >= 0)
  {
      
      window.onload = ReloadSelectElement;
  }
  
  function ReloadSelectElement() {
      
  
      if (document.getElementsByTagName) {
          var s = document.getElementsByTagName("select");
  
          if (s.length > 0) {
              window.select_current = new Array();
  
              for (var i=0, select; select = s[i]; i++) {
                  select.onfocus = function(){ window.select_current[this.id] = this.selectedIndex; }
                  select.onchange = function(){ restore(this); }
                  emulate(select);
              }
          }
      }
  }
  
  function restore(e) {
      if (e.options[e.selectedIndex].disabled) {
          e.selectedIndex = window.select_current[e.id];
      }
  }
  
  function emulate(e) {
      for (var i=0, option; option = e.options[i]; i++) {
          
          if (option.disabled) {        
              option.style.color = "#6d6d6d";
          }
          else {
              option.style.color = "#000";
          }
      }
  }
  /*自定义事件 POST表单打点，由于IE下面iframe加载顺序的问题，没法准确在iframe加载完成之前注册上iframe的load事件，从而导致打点不成功*/
  
  YUE.on( one , 'change', function() {
      if ( typeof (parent.onOneChanged) !== 'undefined' && parent.onOneChanged !== null && typeof (parent.onOneChanged.fire) !== 'undefined' && parent.onOneChanged.fire !== null ) {
          parent.onOneChanged.fire();
      }
  });
  initSelectedPathByIds('<?php echo $arrparentid?>');
  </SCRIPT>
<script type="text/javascript">Menuon(1);</script>

<iframe style="position: absolute; z-index: 10000;" src="javascript:void(0)" frameborder="0" height="0" scrolling="no" width="0"></iframe><iframe style="position: absolute; z-index: 10000;" src="javascript:void(0)" frameborder="0" height="0" scrolling="no" width="0"></iframe><iframe style="position: absolute; z-index: 10000;" src="javascript:void(0)" frameborder="0" height="0" scrolling="no" width="0"></iframe></body></html>