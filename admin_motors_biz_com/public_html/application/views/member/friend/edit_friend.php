<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>修改商友</title>
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
<td id="Tab0" class="tab_on"><a href="<?php echo site_url("member/friend/friend_list2")?>">商友列表</a></td><td class="tab_nav">&nbsp;</td>
<td id="Tab1" class="tab"><a href="<?php echo site_url("member/friend/type_list2")?>">商友类别列表</a></td><td class="tab_nav">&nbsp;</td></tr>
</tbody></table>
</td>
<td width="110"><div>
<img src="<?php echo base_url("skin/images/spacer.gif")?>" title="刷新" onclick="window.location.reload();" style="cursor:pointer;" alt="" height="24" width="40">
<img src="<?php echo base_url("skin/images/spacer.gif")?>" title="后退" onclick="history.back(-1);" style="cursor:pointer;" alt="" height="24" width="20">
<img src="<?php echo base_url("skin/images/spacer.gif")?>" title="前进" onclick="history.go(1);" style="cursor:pointer;" alt="" height="24" width="20">
<img src="<?php echo base_url("skin/images/spacer.gif")?>" title="帮助" onclick="" style="cursor:help;" alt="" height="24" width="20"></div></td>
</tr>
</tbody></table>
</div><form method="post" action="<?php echo site_url("member/friend/save_fri")?>" id="dform" onsubmit="return check();">
<input name="moduleid" value="2" type="hidden">
<input name="file" value="friend" type="hidden">
<input name="action" value="edit" type="hidden">
<input name="fid" value="<?php echo $friend['fid']?>" type="hidden">
<div class="tt">修改商友 </div>
<table class="tb" cellpadding="2" cellspacing="1">
<tbody><tr>
<td class="tl"><span class="f_red">*</span> 姓名</td>
<td class="tr"><input size="20" name="post[truename]" id="truename" maxlength="100" value="<?php echo $friend['truename']?>" type="text"> 
<script type="text/javascript" src="<?php echo base_url("skin/js/color.js")?>"></script>
<style type="text/css">.color_div_o {width:16px;height:16px;padding:4px 0 0 4px;background:#B6BDD2;cursor:crosshair;}.color_div_t {width:16px;height:16px;padding:4px 0 0 4px;background:#F1F2F3;}.color_div {border:#808080 1px solid;width:10px;height:10px;line-height:10px;font-size:1px;}</style>
<input name="post[style]" id="color_input_1" value="" type="hidden"><img src="<?php echo base_url("skin/js/color.gif")?>" id="color_img_1" style="cursor:pointer;background:" onclick="color_show(1, Dd('color_input_1').value, this);" height="18" align="absmiddle" width="21">
<span id="dtruename" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 会员名</td>
<td class="tr"><input size="20" name="post[username]" id="username" value="<?php echo $friend['username']?>" type="text"></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 公司名称</td>
<td class="tr"><input size="40" name="post[company]" id="company" value="<?php echo $friend['company']?>" type="text"></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 职位</td>
<td class="tr"><input size="20" name="post[career]" id="career" value="<?php echo $friend['career']?>" type="text"></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 电话</td>
<td class="tr"><input size="20" name="post[telephone]" id="telephone" value="<?php echo $friend['telephone']?>" type="text"></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 手机</td>
<td class="tr"><input size="20" name="post[mobile]" id="mobile" value="<?php echo $friend['mobile']?>" type="text"></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 主页</td>
<td class="tr"><input size="40" name="post[homepage]" id="homepage" value="<?php echo $friend['homepage']?>" type="text"></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> Email</td>
<td class="tr"><input size="30" name="post[email]" id="email" value="<?php echo $friend['email']?>" type="text"></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> QQ</td>
<td class="tr"><input size="20" name="post[qq]" id="qq" value="<?php echo $friend['qq']?>" type="text"></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 阿里旺旺</td>
<td class="tr"><input size="20" name="post[ali]" id="ali" value="<?php echo $friend['ali']?>" type="text"></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> MSN</td>
<td class="tr"><input size="30" name="post[msn]" id="msn" value="" type="text"></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> Skype</td>
<td class="tr"><input size="20" name="post[skype]" id="skype" value="<?php echo $friend['skype']?>" type="text"></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 备注</td>
<td class="tr"><input size="40" name="post[note]" id="note" type="text"></td>
</tr>
</tbody></table>
<div class="sbt"><input name="submit" value=" 确 定 " class="btn" type="submit">&nbsp;&nbsp;&nbsp;&nbsp;
<input name="reset" value=" 重 置 " class="btn" type="reset"></div>
</form>
<script type="text/javascript">
function check() {
	if(Dd('truename').value == '') {
		Dmsg('请填写姓名', 'truename');
		return false;
	}
	if(Dd('truename').value.length > 100) {
		Dmsg('真实姓名的长度不能大于100个字节', 'truename');
		return false;
	}
	return true;
}
</script>
<script type="text/javascript">Menuon(0);</script>

</body></html>