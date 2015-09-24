<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title;?></title>
<link href="<?php echo base_url("skin_user/css/user.css")?>" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url('skin_user/js/jquery-1.4.js')?>" type=text/javascript></script>
<script type="text/javascript">
$(function() {
	jQuery(document).bind('keydown', function (event){
		if(event.keyCode == 13 && ($("#pwd_id").val() || $("#rpwd_id").val())){
			 quick_reg(); 
		}
	  });	 
});
function quick_reg(){
	$("#pwd_span").html("");
	$("#rpwd_span").html("");
	if($("#pwd_id").val()==""){		
		$("#pwd_span").html("<span class='worry_msg'>Please enter your security code!</span>");
		$("#pwd_id").focus();
	}else if($("#pwd_id").val().length<6){		
		$("#pwd_span").html("<span class='worry_msg'>At least 6 characters!</span>");
		$("#pwd_id").focus();
	}else if($("#rpwd_id").val()==""){		
		$("#rpwd_span").html("<span class='worry_msg'>Please enter your re_password!</span>");
		$("#rpwd_id").focus();
	}else if($("#pwd_id").val()!=$("#rpwd_id").val()){
		$("#rpwd_span").html("<span class='worry_msg'>Your passwords do not match. Please try again!</span>");
		$("#rpwd_id").focus();
	}else {
		$.post("<?php echo site_url("reg_login/quick_reg")?>", { email:"<?php echo $email?>",pwd:$("#pwd_id").val(),rpwd:$("#rpwd_id").val(),mid:"<?php echo $mid?>",auth:"<?php echo $auth?>"},
				function(json){
					alert(json.msg);
					if(json.email_url){						
						window.location = "http://mail."+json.email_url;
					}else{
						location.reload(true);
					}								
				}, "json");
	}

}

function resend(){
	$.post("<?php echo site_url("reg_login/send_confirm_email")?>", function(json){				
		if(json.msg=="There are no matches!"){
			alert(json.msg+"\nMaybe you need register first!");
		}else{
			alert(json.msg);
		}
		if(json.email_url){
			window.location = "http://mail."+json.email_url;
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
		$.post("<?php echo site_url("reg_login/send_confirm_email")?>", { email:$(":text").val()},
			function(json){
				alert(json.msg);
				if(json.email_url){
					window.location = "http://mail."+json.email_url;
				}else{
					location.reload(true);
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
	  <div class="user_main_left2">
	  	<p><b class="user_main_left2_b">Email :</b><?php echo $email?></p>
	    <p><b class="user_main_left2_b">New Password :</b><input name="" id="pwd_id" type="password" onpaste="return false" oncontextmenu="return false" oncopy="return false" oncut="return false" /><span id="pwd_span"></span></p>
	    <p><b class="user_main_left2_b">Re-enter Password :</b><input name="" id="rpwd_id" type="password" onpaste="return false" oncontextmenu="return false" oncopy="return false" oncut="return false"/><span id="rpwd_span"></span></p>
        <p>Authentication information has been sent to your email: <b>w5554775@163.com</b>, click on the links in the email, to confirm successful</p>
        <p>Email address will serve as your login account and accept the buyer enquiries, etc</p>
        <p>As a supplier, it is only through the email verification, release the relevant information to the display at <?php echo $site['site_name'];?></p>
        <p><input type="button" id="re2_a" style="cursor: pointer;" onclick="quick_reg()" value="Immediately verify" href="#"></p>
        <p></p>
        <p class="re2_2"><b>Haven't received the mail?</b></p>
        <p class="re2_2">Your verification email might be in junk mail or spam, if not please try the following method:</p>
        <!-- <p class="re2_2">Method one: resend verification letter</p> -->
        <p class="re2_2">Your email is "<b>w5554775@163.com</b>", click here<input type="button" id="re2_a1" onclick="resend()" value="Resend verification letter" /></p>
        <!-- <p class="re2_2">Method two: modify the mailbox:</p>
        <p class="re2_2">Your mail mistakes, you can click here<a href="#11" onclick='document.getElementById("user_form").style.display="block"'>Modify the email address</a></p>
        <form id="user_form"><input class="user_input" name="email" value="< ?php //echo $email?$email:'';?>"/>
        <input type="button" onclick="change_email()" style="cursor:pointer"  class="user_input1" type="button"  value="submit"/></form> -->
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
