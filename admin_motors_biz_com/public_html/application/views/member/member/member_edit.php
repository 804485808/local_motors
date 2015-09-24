<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>会员修改</title>
<meta name="robots" content="noindex,nofollow">
<script type="text/javascript">window.onerror= function(){return true;}</script>
<link rel="stylesheet" href="<?php echo base_url("skin/css/style.css");?>" type="text/css">
<script type="text/javascript" src="<?php echo base_url("skin/js/lang.js");?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/config.js");?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/jquery.js");?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/common.js");?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/admin.js");?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/area.js");?>"></script>
 <script type="text/javascript">
      function del_img(id){
   		$.post("<?php echo site_url("/uploadimg/del_img/")?>",{"path" : Dd(id).value});
   		Dd(id).value='';
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
<td id="Tab0" class="tab"><a href="<?php echo site_url('member/member/member_add2');?>">添加会员</a></td>
<td class="tab_nav">&nbsp;</td>
<td id="Tab1" class="tab_on"><a href="<?php echo site_url('member/member/member_list2');?>">会员列表</a></td>
<td class="tab_nav">&nbsp;</td><td id="Tab2" class="tab"><a href="<?php echo site_url('member/member/member_check2');?>">审核会员</a></td>
<td class="tab_nav">&nbsp;</td><td id="Tab4" class="tab"><a href="<?php echo site_url('member/member/member_contact2');?>">联系会员</a></td>
<td class="tab_nav">&nbsp;</td><td id="Tab5" class="tab"><a href="<?php echo site_url('member/company/company_list2');?>">公司列表</a></td>
<td class="tab_nav">&nbsp;</td><td id="Tab6" class="tab"><a href="<?php echo site_url('member/member/vip_list2');?>">VIP列表</a></td>
<td class="tab_nav">&nbsp;</td></tr>
</tbody></table>
</td>
<td width="110"><div>
<img src="<?php echo base_url("skin/images/spacer.gif");?>" width="40" height="24" title="刷新" onclick="window.location.reload();" style="cursor:pointer;" alt="">
<img src="<?php echo base_url("skin/images/spacer.gif");?>" width="20" height="24" title="后退" onclick="history.back(-1);" style="cursor:pointer;" alt="">
<img src="<?php echo base_url("skin/images/spacer.gif");?>" width="20" height="24" title="前进" onclick="history.go(1);" style="cursor:pointer;" alt="">
<img src="<?php echo base_url("skin/images/spacer.gif");?>" width="20" height="24" title="帮助" onclick="" style="cursor:help;" alt=""></div></td>
</tr>
</tbody></table>
</div><script type="text/javascript" src="<?php echo base_url('skin/js/profile.js');?>"></script><div class="tt">会员资料修改</div>
<form method="post" action="<?php echo site_url('member/member/save_m/edit')?>" onsubmit="return Dcheck()" id="dform">
<input type="hidden" name="username" value="<?php echo $user['username']?>"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tbody>
<tr>
<td class="tl"><span class="f_hid">*</span> 会员登录名</td>
<td><strong><?php echo $user['username']?></strong></td>
</tr>

<tr>
<td class="tl"><span class="f_hid">*</span> 通行证用户名</td>
<td><input type="text" size="20" name="passport" id="passport" onblur="validator('passport');" value="<?php echo $user['passport']?>"/>&nbsp;<span id="dpassport" class="f_red"></span></td>
</tr>

<tr>
<td class="tl"><span class="f_red">*</span> 会员组</td>
<td>
<select name="groupid" id="groupid">
	<option value="0" <?php if ($groupid==0){echo "selected";}?>>会员组</option>
	<option value="1" <?php if ($groupid==1){echo "selected";}?>>管理员</option>
	<option value="2" <?php if ($groupid==2){echo "selected";}?>>禁止访问</option>
	<option value="3" <?php if ($groupid==3){echo "selected";}?>>游客</option>
	<option value="4" <?php if ($groupid==4){echo "selected";}?>>待审核会员</option>
	<option value="5" <?php if ($groupid==5){echo "selected";}?>>个人会员</option>
	<option value="6" <?php if ($groupid==6){echo "selected";}?>>企业会员</option>
	<option value="7" <?php if ($groupid==7){echo "selected";}?>>VIP会员</option>
</select>&nbsp;<span id="dgroupid" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 登录密码</td>
<td><input type="password" size="20" name="password" id="password" onblur="validator('password');" autocomplete="off" >&nbsp;<span id="dpassword" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 重复输入密码</td>
<td><input type="password" size="20" name="cpassword" id="cpassword" autocomplete="off" >&nbsp;<span id="dcpassword" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> Email</td>
<td><input type="text" size="30" name="email" id="email" onblur="validator('email');" value="<?php echo $user['email'];?>">&nbsp;<span id="demail" class="f_red"></span> <span class="f_gray">[不公开]</span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 真实姓名</td>
<td><input type="text" size="20" name="truename" id="truename" value="<?php echo $user['truename'];?>">&nbsp;<span id="dtruename" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 性别</td>
<td>
<input type="radio" name="gender" value="0" <?php echo $user['gender']?"":"checked='checked'";?>> 先生
<input type="radio" name="gender" value="1" <?php echo $user['gender']?"checked='checked'":"";?>> 女士
</td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 所在地区</td>
<td>
<select name="areaid" id="areaid">
<option value="0">请选择</option>
<?php foreach ($area as $k => $v){?>
<option value="<?php echo $v['areaid'];?>" <?php if ($areaid==$v['areaid']){echo "selected";}?>><?php echo $v['areaname'];?></option>
<?php }?>
</select>
&nbsp;
<span id="dareaid" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 部门</td>
<td><input type="text" size="20" name="department" id="department" value="<?php echo $user['department'];?>"></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 职位</td>
<td><input type="text" size="20" name="career" id="career" value="<?php echo $user['career'];?>"></td>
</tr><tr>
<td class="tl"><span class="f_hid">*</span> 手机号码</td>
<td>
	<input class="input_sm" size="5" name="phone_1" id="phone_1" maxlength="4" value="<?php echo $phone_1;?>"/>-
	<input class="input_ss" size="15" name="phone_2" id="phone_2" maxlength="11" value="<?php echo $phone_2;?>"/><span id="dtelephone" class="f_red"></span>
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> QQ</td>
<td><input type="text" size="20" name="qq" id="qq" value="<?php echo $user['qq'];?>"></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 阿里旺旺</td>
<td><input type="text" size="20" name="ali" id="ali" value="<?php echo $user['ali'];?>"></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> Skype</td>
<td><input type="text" size="20" name="skype" id="skype" value="<?php echo $user['skype'];?>"></td>
</tr>
</tbody></table>
<div class="tt"><span class="f_hid">*</span> 公司资料</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tbody>
<tr>
<td class="tl"><span class="f_red">*</span> 公司名称</td>
<td><input type="text" size="60" name="company" id="company" onblur="validator('company');" value="<?php echo $company['company'];?>">&nbsp;<span id="dcompany" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 公司类型</td>
<td>
<select name="type" id="type">
	<option value="">请选择</option>
	<option value="Business Entity" <?php if ($ctype=="Business Entity"){echo "selected";}?>>企业单位</option>
	<option value="Institutions" <?php if ($ctype=="Institutions"){echo "selected";}?>>事业单位或社会团体</option>
	<option value="Individual operation" <?php if ($ctype=="Individual operation"){echo "selected";}?>>个体经营</option>
</select>
&nbsp;<span id="dtype" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 形象图片</td>
<td>
<input name="thumb" type="text" size="60" id="thumb" value="<?php echo $thumb;?>">&nbsp;&nbsp;
<span onclick="Dthumb(2,180,180,Dd('thumb').value);" class="jt">[上传]</span>&nbsp;&nbsp;
<span onclick="del_img('thumb');" class="jt">[删除]</span>
<br />
<span class="f_gray">建议使用LOGO、办公环境等标志性图片，最佳大小为180px*180px. Allow Upload (jpg,jpeg,gif,png) type image, max 2048 KB</span>
</td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 主要经营范围</td>
<td><input type="text" size="80" name="business" id="business" value="<?php echo $company['business'];?>">&nbsp;<span id="dbusiness" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 经营模式</td>
<td>
<span id="com_mode">
<input type="checkbox" name="mode[]" value="Manufacturer" <?php if (strstr($mode,"Manufacturer")){echo "checked";}?>> 制造商&nbsp;
<input type="checkbox" name="mode[]" value="Trading Company" <?php if (strstr($mode,"Trading Company")){echo "checked";}?>> 贸易商&nbsp;
<input type="checkbox" name="mode[]" value="Servicer" <?php if (strstr($mode,"Servicer")){echo "checked";}?>> 服务商&nbsp;
<input type="checkbox" name="mode[]" value="Other Institutions" <?php if (strstr($mode,"Other Institutions")){echo "checked";}?>> 其他机构&nbsp;
</span> <span class="f_gray">(最多可选2种, 若多于2种则自动提取前2种)</span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 公司规模</td>
<td>
<select name="size">
<option value="">请选择规模</option>
<option value="1-50 People" <?php if ($size=="1-50 People"){echo "selected";}?>>1-50人</option>
<option value="51-100 People" <?php if ($size=="51-100 People"){echo "selected";}?>>51-100人</option>
<option value="101-500 People" <?php if ($size=="101-500 People"){echo "selected";}?>>101-500人</option>
<option value="501-1000 People" <?php if ($size=="501-1000 People"){echo "selected";}?>>501-1000人</option>
<option value="1001-3000 People" <?php if ($size=="1001-3000 People"){echo "selected";}?>>1001-3000人</option>
<option value="3001-5000 People" <?php if ($size=="3001-5000 People"){echo "selected";}?>>3001-5000人</option>
<option value="5001-10000 People" <?php if ($size=="5001-10000 People"){echo "selected";}?>>5001-10000人</option>
<option value="Above 10000 People" <?php if ($size=="Above 10000 People"){echo "selected";}?>>10000人以上</option>
</select>
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 注册资本</td>
<td>
<input type="text" size="12" name="capital" id="capital" value="<?php echo sprintf('%1.0f',$company['capital']);?>">
	<select name="regunit">
		<option value="RMB" <?php if ($regunit=="RMB"){echo "selected";}?>>人民币</option>
		<option value="HKD" <?php if ($regunit=="HKD"){echo "selected";}?>>港元</option>
		<option value="NTD" <?php if ($regunit=="NTD"){echo "selected";}?>>台币</option>
		<option value="USD" <?php if ($regunit=="USD"){echo "selected";}?>>美元</option>
		<option value="EUR" <?php if ($regunit=="EUR"){echo "selected";}?>>欧元</option>
		<option value="GBP" <?php if ($regunit=="GBP"){echo "selected";}?>>英镑</option>
	</select>
</td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 公司成立年份</td>
<td><input type="text" size="15" name="regyear" id="regyear" value="<?php echo $company['regyear'];?>">&nbsp;<span id="dregyear" class="f_red"></span><span class="f_gray">(年份，如：2008)</span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 公司地址</td>
<td><input type="text" size="60" name="address" id="address" value="<?php echo $company['address'];?>">&nbsp;<span id="daddress" class="f_red"></span></td>
</tr>

<tr>
<td class="tl"><span class="f_hid">*</span> 邮政编码</td>
<td><input type="text" size="8" name="zipcode" id="zipcode" value="<?php echo $company['zipcode'];?>"></td>
</tr>

<tr>
<td class="tl"><span class="f_red">*</span> 公司电话</td>
<td>
	<input size="5"  name="telephone_1" id="telephone_1" maxlength="4" value="<?php echo $telephone_1;?>"/>- 
	<input size="7"  name="telephone_2" id="telephone_2" maxlength="4" value="<?php echo $telephone_2;?>"/>- 
	<input size="15"  name="telephone_3" id="telephone_3" maxlength="8" value="<?php echo $telephone_3;?>"/>
	<span id="dtelephone_3" class="f_red"></span>
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 公司传真</td>
<td><input type="text" size="20" name="fax" id="fax" value="<?php echo $company['fax'];?>"></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 公司Email</td>
<td><input type="text" size="30" name="mail" id="mail" onblur="validator('email');" value="<?php echo $company['mail'];?>">&nbsp;<span id="dmail" class="f_red"></span> <span class="f_gray">[公开]</span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 公司网址</td>
<td><input type="text" size="30" name="homepage" id="homepage" value="<?php echo $company['homepage'];?>"></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 公司介绍</td>
<td>
<textarea cols=70 rows=8 name="content" style="overflow:auto;font-size:12px;" id="content"><?php echo $content;?></textarea>&nbsp;<span id="dcontent" class="f_red"></span>
</td>
</tr>
</tbody></table>
<div class="tt">资料认证</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tbody><tr>
<td class="tl"><span class="f_hid">*</span> 公司认证</td>
<td>
<input type="radio" name="vcompany" value="1" <?php echo $user['vcompany']?"checked='checked'":"";?>> 是&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="vcompany" value="0" <?php  echo $user['vcompany']?"":"checked='checked'";?>> 否
 <img src="<?php echo base_url('skin/images/help.png');?>" width="11" height="11" title="一般由第三方认证机构或网站对会员总体资料的认证" alt="tips" class="c_p" onclick="Dconfirm(this.title, '', 450);"><a name="vv"></a>
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 发证机关</td>
<td><input type="text" name="authority" size="50" value="<?php echo $company['authority']?>"></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 邮件认证</td>
<td>
<input type="radio" name="vmail" value="1" <?php echo $user['vmail']?"checked='checked'":"";?>> 是&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="vmail" value="0" <?php echo $user['vmail']?"":"checked='checked'";?>> 否
 <img src="<?php echo base_url('skin/images/help.png');?>" width="11" height="11" title="开启邮件发送后，此项由会员自行认证" alt="tips" class="c_p" onclick="Dconfirm(this.title, '', 450);"></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 实名认证</td>
<td>
<input type="radio" name="vtruename" value="1" <?php echo $user['vtruename']?"checked='checked'":"";?>> 是&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="vtruename" value="0" <?php echo $user['vtruename']?"":"checked='checked'";?>> 否
 <img src="<?php echo base_url('skin/images/help.png');?>" width="11" height="11" title="一般由会员在线提交身份证或其他证件电子文档或传真件，由网站进行认证" alt="tips" class="c_p" onclick="Dconfirm(this.title, '', 450);"></td>
</tr>
</tbody></table>
<div class="tt">高级设置</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tbody>
<tr>
<td class="tl"><span class="f_hid">*</span> 站内信黑名单</td>
<td><input type="text" size="60" name="black" id="black" value="<?php echo $user['black'];?>"></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 推荐注册人 </td>
<td>
	<input type="text" size="20" name="inviter" id="inviter" value="<?php echo $user['inviter'];?>"> 
	<a href="<?php echo site_url("member/member/get_detail/{$user['inviter']}");?>" class="t">[资料]</a>  
	<img src="<?php echo base_url('skin/images/help.png');?>" width="11" height="11" title="推荐此会员注册的会员名，系统自动记录，一般无须填写" alt="tips" class="c_p" onclick="Dconfirm(this.title, '', 450);">
</td>
</tr>
</tbody></table>
<div class="sbt">
<input type="submit" name="submit" value=" 确 定 " class="btn">&nbsp;&nbsp;
<input type="button" value=" 前 台 " class="btn" onclick="<?php echo site_url("member/member/login/{$user['userid']}/{$user['username']}")?>">&nbsp;&nbsp;
<input type="button" value=" 返 回 " class="btn" onclick="history.back(-1);"></div>
</form>
<script type="text/javascript" src="<?php echo base_url('skin/js/clear.js');?>"></script>
<script type="text/javascript">
function Dcheck() {

 	$("#dusername").html("");
  	$("#dpassword").html("");
  	$("#dcpassword").html("");
  	$("#demail").html("");
  	$("#dphone").html("");
  	$("#dtruename").html("");
  	$("#dqq").html("");
  	$("#dcompany").html("");
  	$("#dtruename").html("");
  	$("#dtype").html("");
  	$("#dcatid").html("");
  	$("#dbusiness").html("");
  	$("#daddress").html("");
  	$("#dtelephone").html("");
  	$("#dmail").html("");
  	
	 var username=$("#username").val();
	 var truename=$("#truename").val(); 
	 var password=$("#password").val();
	 var business=$("#business").val();
	 var cpassword=$("#cpassword").val();
	 var email=$("#email").val(); 
	 var areaid=$("#areaid").val();
	 var catid=$("#catid").val();
	 var phone_1=$("#phone_1").val(); 
	 var phone_2=$("#phone_2").val(); 
	 var qq=$("#qq").val(); 
	 var career=$("#career").val(); 
	 var company=$("#company").val(); 
	 var type=$("#type").val();
	 var mail=$("#mail").val(); 
	 var telephone_1=$("#telephone_1").val(); 
	 var telephone_2=$("#telephone_2").val(); 
	 var telephone_3=$("#telephone_3").val(); 
	 var pattern=/^\d+$/;
	 var pattern1 = /^(13[0-9]|15[0-9]|18[8|9])\d{8}$/;
	 var pattern2 = /^([A-Za-z0-9\+_\-]+)(\.[A-Za-z0-9\+_\-]+)*@([A-Za-z0-9\-]+\.)+[A-Za-z]{2,6}$/;
	 var pattern3 = /^[1-9]{1}[0-9]{4,9}$/;
	 var pattern4 = /^([A-Za-z0-9\+_\-]+){1,30}$/;
	 if(username==""){
			$("#dusername").html("请填写会员登录名!");
			document.form.username.focus();
			return false;
		}else if(!pattern4.test(username)){
			$("#dusername").html("会员名应为小写字母(a-z)、数字(0-9)、下划线(_)、中划线(-)组合!");
			document.form.username.focus();
			return false;
		}else if(password==""){
			$("#dpassword").html("请填写登录密码!");
			document.form.password.focus();
			return false;
		}else if(cpassword==""){
			$("#dcpassword").html("请重复输入密码!");
			document.form.cpassword.focus();
			return false;
		}else if(password!=cpassword){
			$("#dcpassword").html("两次输入的密码不一致!");
			document.form.cpassword.focus();
			return false;
		}else if(email==""){
			$("#demail").html("请填写电子邮箱!");
			document.form.email.focus();
			return false;
		}else if(!pattern2.test(email)){
			$("#demail").html("请填写正确的电子邮箱!");
			document.form.email.focus();
			return false;
		}else if(truename==""){
			$("#dtruename").html("请填写真实名字!");
			document.form.truename.focus();
			return false;
		}else if(!pattern.test(phone_1) || !pattern.test(phone_2)){
			$("#dphone").html("请填写正确的手机号码!");
			document.form.phone_1.focus();
			return false;
		}else if(!pattern3.test(qq)){
			$("#dqq").html("请填写正确的QQ号码!");
			document.form.qq.focus();
			return false;
		}else if(company==""){
			$("#dcompany").html("请填写公司名称!");
			document.form.company.focus();
			return false;
		}else if(type==""){
			$("#dtype").html("请填写公司类型!");
			document.form.type.focus();
			return false;
		}else if(catid.length < 2){
			$("#dcatid").html("请填写主营行业!");
			return false;
		}else if(business.length < 2){
			$("#dbusiness").html("请填写主要经营范围!");
			document.form.business.focus();
			return false;
		}else if(address.length < 2){
			$("#daddress").html("公司地址长度不能小于2个字符!");
			document.form.address.focus();
			return false;
		}else if(regyear.length < 4){
			$("#dregyear").html("请填写公司成立年份!");
			document.form.regyear.focus();
			return false;
		}else if(telephone_1=="" || telephone_2=="" || telephone_3==""){
			$("#dtelephone").html("请填写公司类型!");
			return false;
		}else if(!pattern.test(telephone_1) || !pattern.test(telephone_2) || !pattern.test(telephone_3)){
			$("#dtelephone").html("请填写正确的公司电话号码!");
			return false;
		}else if(!pattern2.test(mail)){
			$("#dmail").html("请填写正确的电子邮箱!");
			document.form.mail.focus();
			return false;
		}
	}
</script>
</body>
</html>