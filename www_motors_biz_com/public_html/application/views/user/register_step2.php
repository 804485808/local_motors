<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title;?></title>
<link href="<?php echo base_url("skin_user/css/user.css")?>" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url('skin_user/js/jquery.js')?>" type=text/javascript></script>
<script type=text/javascript>
function resend(){
	$("#re2_a1").attr({ "disabled": "disabled", "value": "waiting..." });
	$.post("<?php echo site_url("reg_login/send_confirm_email")?>", function(json){		
		alert(json.msg);
		$("#re2_a1").removeAttr("disabled");
		$("#re2_a1").val("Resend verification email");
		if(json.email_url){
			//window.location = "http://mail."+json.email_url;
		}	
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
		$("#change_email").attr({ "disabled": "disabled", "value": "waiting..." });
		$.post("<?php echo site_url("reg_login/send_confirm_email")?>", { email:$(":text").val()},
			function(json){
				alert(json.msg);
				$("#change_email").removeAttr("disabled");
				$("#change_email").val("submit");
				if(json.email_url){
					//location.reload(true);
					//window.location = "http://mail."+json.email_url;
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
			<div class="user_main_left1_1">Start Your Online Business with <?php echo $site['site_name'];?>!</div>
			<div class="user_main_left1_2">Complete the simple form below and become a free member today!</div>
			<div class="clear"></div>
		</div>
	<div class="user_liu"><b>1</b><span>Register</span><b id="user_liu1">2</b><span id="user_liu2">Verify your identity</span><b>3</b><span>Complete</span><div class="clear"></div></div>
	  <div class="user_main_left2">
      	<h1>Registered successfully! Please verify the email address!</h1>
        <p>Authentication information has been sent to your email: <b><?php echo $email?></b>, click on the links in the email, to confirm successful</p>
        <p>Email address will serve as your login account and accept the buyer enquiries, etc</p>
        <p>As a supplier, it is only through the email verification, release the relevant information to the display at <?php echo $site['site_name'];?></p>
        <p><a href="http://mail.<?php echo $email_url?>" target="_blank"><input type="button" id="re2_a" value="Immediately verify"></a></p>
        <p></p>
        <p class="re2_2"><b>Haven't received the mail?</b></p>
        <p class="re2_2">Your verification email might be in junk mail or spam, if not please try the following method:</p>
        <p class="re2_2">Method one: resend verification letter</p>
        <p class="re2_2">Your email is "<b><?php echo $email?></b>", click here<input type="button" onclick="resend()" id="re2_a1" value="Resend verification email" /></p>
        <p class="re2_2">Method two: modify the mailbox:</p>
        <p class="re2_2">Your mail mistakes, you can click here<a href="#11" onclick='document.getElementById("user_form").style.display="block"'>Modify the email address</a></p>
        <form id="user_form">
        <input class="user_input" maxlength="50" type="text" name="email" value="<?php echo $email?$email:'';?>"/>
        <input name="" id="change_email"  class="user_input1" type="button"  value="submit" onclick="change_email()" style="cursor:pointer"/>
        </form>
        <div class="re2_3">
        <p>As a supplier, you can:</p>
        <p>Fill in your company information, and then released products, showing your company shop</p>
        <!-- <p><A href="#">Fill in your company information</A></p> -->
        </div>
		<div class="clear"></div>
	</div>

	<div class="clear"></div>
	</div>
    <div class="user_main_right"><A href="#"><img src="<?php echo base_url("skin_user/images/registration_03.jpg")?>" alt="" /></A></A></div>
	<div class="clear"></div>
</div>
</body>
</html>
