<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>VIP列表</title>
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
<td id="Tab0" class="tab"><a href="<?php echo site_url("member/vip/vip_add2")?>">添加VIP</a></td><td class="tab_nav">&nbsp;</td>
<td id="Tab1" class="tab_on"><a href="<?php echo site_url("member/vip/vip_list2")?>">VIP列表</a></td><td class="tab_nav">&nbsp;</td>
<td id="Tab2" class="tab"><a href="<?php echo site_url("member/vip/vip_expire2")?>">过期VIP</a></td>
<td class="tab_nav">&nbsp;</td><td id="Tab3" class="tab"><a href="<?php echo site_url("member/company/company_list2")?>">公司列表</a></td>
<td class="tab_nav">&nbsp;</td><td id="Tab4" class="tab"><a href="<?php echo site_url("member/member/member_list2")?>">会员列表</a></td>
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
</div><div class="tt">修改VIP</div>
<form method="post" action="<?php echo site_url('member/vip/save_vip/edit');?>" id="dform" onsubmit="return check();">
<table cellpadding="2" cellspacing="1" class="tb">
<tbody>
<tr>
<td class="tl"><span class="f_red">*</span> 会员名</td>
<td><input type="text" size="20" name="username" id="username" value="<?php echo $vip_detail['username']?>" readonly> <span id="dusername" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 会员组</td>
<td>
<input type="radio" name="groupid" value="7" checked> VIP会员&nbsp;</td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 服务有效期</td>
<td><script type="text/javascript" src="<?php echo base_url("skin/js/calendar.js");?>"></script>
<input type="text" name="fromtime" id="vipfromtime" value="<?php echo date('Y-m-d',$vip_detail['fromtime']?$vip_detail['fromtime']:time());?>" size="10" onfocus="ca_show('vipfromtime', this, '-');" readonly ondblclick="this.value='';"> 
<img src="<?php echo base_url("skin/images/calendar.gif");?>" align="absmiddle" onclick="ca_show('vipfromtime', this, '-');" style="cursor:pointer;"> 至 
<input type="text" name="totime" id="viptotime" value="<?php echo date('Y-m-d',$vip_detail['totime']?$vip_detail['totime']:time());?>" size="10" onfocus="ca_show('viptotime', this, '-');" readonly ondblclick="this.value='';"> 
<img src="<?php echo base_url("skin/images/calendar.gif");?>" align="absmiddle" onclick="ca_show('viptotime', this, '-');" style="cursor:pointer;"> <span id="dtime" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 企业资料是否通过认证</td>
<td>
<input type="radio" name="vcompany" value="1" <?php echo $vip_detail['vcompany']?"checked":"";?>> 是&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="vcompany" value="0" <?php echo $vip_detail['vcompany']?"":"checked";?>> 否
</td>
</tr>
<!-- <tr> -->
<!-- <td class="tl"><span class="f_hid">*</span> 认证名称或机构</td> 
<td><input type="text" name="authority" size="50" value="< ?php echo $vip_detail['authority'];?>"></td>
<!-- </tr> -->
<!-- <tr> -->
<!-- <td class="tl"><span class="f_hid">*</span> 认证日期</td> 
<td><input type="text" name="vip[validtime]" id="vipvalidtime" value="2013-08-02" size="10" onfocus="ca_show(&#39;vipvalidtime&#39;, this, &#39;-&#39;);" readonly="" ondblclick="this.value=&#39;&#39;;"> <img src="calendar.gif" align="absmiddle" onclick="ca_show(&#39;vipvalidtime&#39;, this, &#39;-&#39;);" style="cursor:pointer;"></td>
<!-- </tr> -->
<tr>
<td class="tl"><span class="f_hid">*</span> VIP指数修正值</td>
<td><input type="text" name="vipr" size="2" value="<?php echo $vip_detail['vipr'];?>"></td>
</tr>
</tbody></table>
<div class="sbt"><input type="submit" name="submit" value=" 确 定 " class="btn">&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value=" 重 置 " class="btn"></div>
</form>
<script type="text/javascript">
function check() {
	var l;
	var f;
	f = 'username';
	if(Dd(f).value == '') {
		Dmsg('请填写会员名', f);
		return false;
	}
	if(Dd('vipfromtime').value.length != 10 || Dd('viptotime').value.length != 10) {
		Dmsg('请选择服务有效期', 'time', 1);
		return false;
	}
	return true;
}
</script>
<script type="text/javascript">Menuon(1);</script>

</body></html>