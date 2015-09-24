<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<title>邮件发送</title>
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
<td id="Tab0" class="tab"><a href="<?php echo site_url("my_menu/setting/base_set")?>">基本设置</a></td><td class="tab_nav">&nbsp;</td>
<td id="Tab5" class="tab_on"><a href="<?php echo site_url("my_menu/setting/mail")?>">邮件发送</a></td><td class="tab_nav">&nbsp;</td>
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
<form method="post" action="<?php echo site_url("my_menu/setting/save_setting")?>">
<input type="hidden" name="act" value="set_email">

<div id="Tabs5" style="">
<div class="tt">邮件发送</div>
<table cellpadding="2" cellspacing="1" class="tb">

<tr> 
<td class="tl">邮件发送协议</td>
<td><input name="email[protocol]" id="smtp_host" type="text" size="40" value="<?php echo $email['protocol']?>"></td>
</tr>

<tr> 
<td class="tl">SMTP服务器地址</td>
<td><input name="email[smtp_host]" id="smtp_host" type="text" size="40" value="<?php echo $email['smtp_host']?>">
 <img src="<?php echo base_url("skin/images/help.png")?>" width="11" height="11" title="SMTP服务器地址,例如ssl://smtp.xxx.com&lt;br/&gt;提示:目前大部分新申请的免费邮箱并不支持smtp发信" alt="tips" class="c_p" onclick="Dconfirm(this.title, '', 450);"></td>
</tr>
<tr> 
<td class="tl">SMTP端口</td>
<td><input name="email[smtp_port]" id="smtp_port" type="text" size="5" value="<?php echo $email['smtp_port']?>"></td>
</tr>

<tr> 
<td class="tl">邮件类型</td>
<td>
<input type="radio" name="email[mailtype]" value="html" id="smtp_auth" <?php echo $email['mailtype']=='html'?"checked":"";?>> html&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="email[mailtype]" value="text" <?php echo $email['mailtype']=='text'?"checked":"";?>> text
</td></tr>

<tr>
<td class="tl">换行符</td>
<td>
<select name="email[newline]" id="email[newline]">
<option value="\\r\\n" <?php echo $email['newline']=='\\r\\n'?"selected":"";?>>\r\n</option>
<option value="\\n" <?php echo $email['newline']=='\\n'?"selected":"";?>>\n</option>
<option value="\\r" <?php echo $email['newline']=='\\r'?"selected":"";?>>\r</option>
</select>
</td>
</tr>

<tr>
<td class="tl">字符集</td>
<td>
<select name="email[charset]" id="email[charset]">
<?php foreach ($charset as $v){?>
<option value="<?php echo $v?>" <?php if ($v==$email['charset']){echo "selected";}?>><?php echo $v?></option>
<?php }?>
</select>
</td>
</tr>

<tr> 
<td class="tl">SMTP超时设置</td>
<td><input name="email[smtp_timeout]" id="smtp_port" type="text" size="5" value="<?php echo $email['smtp_timeout']?>"></td>
</tr>

<tr id="dsmtp_user" style="display:">
<td class="tl">邮箱帐号</td>
<td><input name="email[smtp_user]" id="smtp_user" type="text" size="40" value="<?php echo $email['smtp_user']?>"> 
<img src="<?php echo base_url("skin/images/help.png")?>" width="11" height="11" title="SMTP服务器的用户帐号,一般为邮件地址" alt="tips" class="c_p" onclick="Dconfirm(this.title, '', 450);"></td>
</tr>

<tr id="dsmtp_pass" style="display:"> 
<td class="tl">邮箱密码</td>
<td><input name="email[smtp_pass]" type="text" id="smtp_pass" size="40" value="<?php echo $email['smtp_pass']?>" onfocus="if(this.value.indexOf('**')!=-1)this.value='';"></td>
</tr>

<tbody>

<tr> 
<td class="tl">开启自动换行</td>
<td>
<input type="radio" name="email[wordwrap]" <?php echo $email['wordwrap']?"checked":"";?> value="1"> 开启&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="email[wordwrap]" value="0" <?php echo $email['wordwrap']?"":"checked";?> value="0"> 关闭
</td>
</tr>

</tbody></table>
</div>

<div class="sbt">
<input type="submit" name="submit" value="确 定" class="btn">&nbsp;&nbsp;&nbsp;&nbsp;
<input type="button" value="重置" id="ShowAll" class="btn" onclick="this.form.reset();" title="重置所有选项">
</div>
</form>
</body></html>