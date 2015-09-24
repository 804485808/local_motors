<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title?></title>
<link href="<?php echo base_url("skin_user/css/user.css")?>" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url('skin_user/js/jquery.js')?>" type=text/javascript></script>
<script type="text/javascript">
$(function() {
	jQuery(document).bind('keydown', function (event){
		if(event.keyCode == 13 && ($("#email_id").val() || $("#textfield10").val())){
			 check_forget(); 
		}
	  });	 
});
function check_forget(){
	$("#email_span").html("");
	$("#cck_span").html("");
	var pattern=/^[A-Za-z0-9+]+[A-Za-z0-9\.\_\-+]*@([A-Za-z0-9\-]+\.)+[A-Za-z0-9]+$/;	
	if($("#email_id").val()==""){		
		$("#email_span").html("<span class='worry_msg'>Please enter your email!</span>");
		$("#email_id").focus();
	}else if(!pattern.test($("#email_id").val())){
		$("#email_span").html("<span class='worry_msg'>Your email is not valid!</span>");
		$("#email_id").focus();
	}else if($("#textfield10").val()==""){		
		$("#cck_span").html("<span class='worry_msg'>Please enter your security code!</span>");
		$("#textfield10").focus();
	}else{
		$.post("<?php echo site_url("reg_login/forget_password")?>", { email:$("#email_id").val(),cck:$("#textfield10").val(),act:"send_password"},
				function(json){
					alert(json.msg);
					if(json.email_url){
						window.location = "http://mail."+json.email_url;
					}			
				}, "json");
	}
}
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
		  <div class="clear"></div>
		</div>
	  <div class="user_main_left2">
      	<div class="status_right1">
       	          <p>To request a new password, please enter your registered email in <?php echo $site['site_name'];?> and security code below:</p>
</div>
        <p id="MailServerUser">Mail User :<input name="" type="text" id="email_id"/><span id="email_span"></span></p>
        <p class="forget"><span>verification code:</span><input name="" type="text" id="textfield10" /><i>
        <img id="cck" src="<?php echo site_url('imgcode/index')?>" style="cursor:pointer" width="71" height="33" onclick="this.src='<?php echo site_url('imgcode/index/')?>?random='+Math.random();"  alt="Can't see?Change it!" title="Can't see?Change it!"/>        
        </i><span id="cck_span"></span><div class="clear"></div></p>
        <p><input id="re2_a" type="button" value="Immediately verify" href="#" onclick="check_forget()"></p>
        <p></p>
        <form id="user_form">
        <input class="user_input"/><input name=""  class="user_input1" type="button"  value="submit"/></form>
        
		<div class="clear"></div>
	</div>

	<div class="clear"></div>
	</div>
    <div class="user_main_right"><A href="#"><img src="<?php echo base_url("skin_user/images/registration_03.jpg")?>" alt="" /></A></A></div>
	<div class="clear"></div>
</div>
</body>
</html>
