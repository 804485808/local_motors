<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title;?></title>
<link href="<?php echo base_url("skin_user/css/user.css")?>" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url('skin_user/js/jquery.js')?>" type=text/javascript></script>
<script type="text/javascript">
function check_reg(){
	$("#email_span").html("");
	$("#pwd_span").html("");
	$("#rpwd_span").html("");
	$("#cck_span").html("");
	var pattern=/^[A-Za-z0-9+]+[A-Za-z0-9\.\_\-+]*@([A-Za-z0-9\-]+\.)+[A-Za-z0-9]+$/;	
	if($("#textfield7").val()==""){		
		$("#email_span").html("<span class='worry_msg'>Please enter your email!</span>");
		$("#textfield7").focus();
		return false;
	}else if(!pattern.test($("#textfield7").val())){
		$("#email_span").html("<span class='worry_msg'>Your email is not valid!</span>");
		$("#textfield7").focus();
		return false;
	}else if($("#textfield8").val()==""){		
		$("#pwd_span").html("<span class='worry_msg'>Please enter your password!</span>");
		$("#textfield8").focus();
		return false;
	}else if($("#textfield8").val().length<6){		
		$("#pwd_span").html("<span class='worry_msg'>At least 6 characters!</span>");
		$("#textfield8").focus();
		return false;
	}else if($("#textfield9").val()==""){		
		$("#rpwd_span").html("<span class='worry_msg'>Please enter your re_password!</span>");
		$("#textfield9").focus();
		return false;
	}else if($("#textfield8").val()!=$("#textfield9").val()){
		$("#rpwd_span").html("<span class='worry_msg'>Your passwords do not match. Please try again!</span>");
		$("#textfield9").focus();
		return false;
	}else if($("#textfield10").val()==""){		
		$("#cck_span").html("<span class='worry_msg'>Please enter your security code!</span>");
		$("#textfield10").focus();
		return false;
	}else{
		$("form").submit();
		$("#reg").html("<a>Please Waiting...</a>");
	}
}
$(function() {
	jQuery(document).bind('keydown', function (event){
		if(event.keyCode == 13 && ($("#textfield7").val() || $("#textfield8").val() || $("#textfield10").val())){
			 check_reg(); 
		}
	  });	 
});
</script>
</head>
<body>
<div class="head">
  <div class="head_top2">
	<div class="logo"><a href="<?php echo site_url()?>"><img src="<?php echo main_url(base_url("skin/images/logo.jpg"));?>" alt="" /></a></div>
	<div class="head_top2_c">Free Membership Registration</div>
	<div class="head_top2_right">Already a Member?<a href="<?php echo site_url("reg_login/login_in")?>">Sign in here.</a></div>
	<div class="clear"></div>
</div>
</div>
<div class="user_main">
	<div class="user_main_left">
		<div class="user_main_left1">
			<div class="user_main_left1_1">Start Your Online Business with <?php echo $site['site_name'];?>!</div>
			<div class="user_main_left1_2">Complete the simple form below and become a free member today!</div>
			<div class="clear"></div>
		</div>
	<div class="user_liu"><b id="user_liu1">1</b><span id="user_liu2">Register</span><b>2</b><span>Verify your identity</span><b>3</b><span>Complete</span><div class="clear"></div></div>
	<form name="frm" method="post" action="<?php echo site_url("reg_login/register")?>">
	  <div class="user_main_left2">
	    <div class="user_main_left2_2">
			    <?php echo md5('123456')?>
				<table width="721" height="50" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td width="163" height="40" align="right" valign="middle"><font>*</font><strong>E-mail Address:</strong></td>
					  <td height="40" colspan="3" valign="middle"><input type="text" value="<?php echo $email?$email:'';?>" maxlength="50" name="email" id="textfield7" />
					    <span id="email_span"></span></td>
					</tr>
                    <tr>
						<td width="163" height="40" align="right" valign="middle"><font>*</font><strong>Create a Password:</strong></td>
					  <td height="40" colspan="3" valign="middle"><input type="password" value="<?php echo $pwd?$pwd:'';?>" maxlength="20" name="pwd" id="textfield8" onpaste="return false" oncontextmenu="return false" oncopy="return false" oncut="return false"/>
					  <span id="pwd_span"></span></td>
					</tr>
                    <tr>
						<td width="163" height="40" align="right" valign="middle"><font>*</font><strong>Re-enter Password:</strong></td>
					  <td height="40" colspan="3" valign="middle"><input type="password" value="<?php echo $rpwd?$rpwd:'';?>" maxlength="20" name="rpwd" id="textfield9" onpaste="return false" oncontextmenu="return false" oncopy="return false" oncut="return false"/>
					  <span id="rpwd_span"></span></td>
					</tr>
                    <tr>
						<td width="163" height="40" align="right" valign="middle"><font>*</font><strong>Verification code:</strong></td>
					  <td width="74" height="40" valign="middle"><input type="text" value="<?php echo $cck?$cck:'';?>" name="cck" id="textfield10" />					  </td>
					  <td width="81" valign="middle"><a href="#">
					  <img id="cck" src="<?php echo site_url('imgcode/index/')?>" onclick="this.src='<?php echo site_url('imgcode/index/')?>?random='+Math.random();"  alt="Can't see?Change it!" title="Can't see?Change it!"/></a></td>
					  <td width="403" valign="middle"><a href="#" id="user_yz" onclick="document.getElementById('cck').src='<?php echo site_url('imgcode/index/')?>?random='+Math.random();">Can't see?Change it!</a><span id="cck_span"></span></td>
					</tr>
					
		  </table>

		</div>
		<div class="clear"></div>
	</div>
    <div class="user_main_left2_3" id="reg"><a href="#" onclick="check_reg()">Create My Account</a></div>
	</form>
	<div class="clear"></div>
	</div>
    <div class="user_main_right"><A href="#"><img src="<?php echo base_url("skin_user/images/registration_03.jpg")?>" alt="" /></A></A></div>
	<div class="clear"></div>
</div>

<?php 
if ($msg){
	echo "<script type='text/javascript'>";	
	if ($msg=='Register successfully! Your should login your email to confirm you '.$site['site_name'].' account within 24 hours!' || $msg=='Register successfully! But the confirmed email has not been sent,please resend again!'){
		echo "window.location='",site_url('reg_login/register_step2'),"';";
	}else{
		echo "alert('",$msg,"');";
	}
	echo "</script>";
}
?>
</body>
</html>
