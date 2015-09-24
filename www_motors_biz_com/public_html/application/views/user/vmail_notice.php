<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Verify Email Notice</title>
<link href="<?php echo base_url("skin_user/css/user.css")?>" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url('skin_user/js/jquery.js')?>" type=text/javascript></script>
<script type=text/javascript>
function resend(){
	$("#re2_a1").attr({ "disabled": "disabled", "value": "waiting..." });
	$.post("<?php echo site_url("user/user_main/confirm_email")?>", function(json){		
		alert(json.msg);
		$("#re2_a1").removeAttr("disabled");
        $("#re2_a1").val("Resend verification email");
	},"json");
}
function change_email(){
	var pattern=/^[A-Za-z0-9+]+[A-Za-z0-9\.\_\-+]*@([A-Za-z0-9\-]+\.)+[A-Za-z0-9]+$/;	
	if($(":text").val()==""){	
		alert("Please enter your email first!");	
		$(":text").focus();
	}else if(!pattern.test($(":text").val())){
		alert("Your email is not valid!");
		$(":text").focus();
	}else{
		$.post("<?php echo site_url("reg_login/send_confirm_email")?>", { email:$(":text").val()},
			function(json){
				alert(json.msg);
			}, "json");
	}
}
</script>
</head>
<body>
<div class="head">
	
<div class="head_top2">
	<div class="logo"><a href="<?php echo site_url()?>"><img src="<?php echo main_url(base_url("skin/images/logo.jpg"));?>" alt="" /></a></div>
	<div class="head_top2_c">Verify Email</div>
	<div class="clear"></div>
</div>
</div>
<div class="user_main">
	<div class="user_main_left">
		<div class="user_main_left1">
		
			<div class="clear"></div>
		</div>
	  <div class="user_main_left2">
      	<h1> verify email has been sent to <b><?php echo $email?></b>,Please check your email to activate the account and login</h1>
		 <br/><br/>
        <p style="font-size:14px;color:green"><b>If you have not received any information in your mailbox, please see the trash bin. Maybe the authentication information has been filtrated </b><input type="button" onclick="resend()" id="re2_a1" value="Resend verification email" /></p>
		<div class="re3">
		<p>Notice : Activate success then you can continue to fill detailed information about your company</p>
		</div>
		<div class="clear"></div>
	</div>

	<div class="clear"></div>
	</div>
</div>
</body>
</html>
