<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title;?></title>
<link href="<?php echo main_url(base_url("skin_user/css/user.css"))?>" rel="stylesheet" type="text/css" />
<script src="<?php echo main_url(base_url('skin_user/js/jquery.js'))?>" type=text/javascript></script>
<script type="text/javascript">
function check_log(){
	if($("#uname").val()==""){	
		alert("Please enter your username or email first!");	
		$("#uname").focus();
		return false;
	}else if($("#pwd").val()==""){	
		alert("Please enter your password first!");		
		$("#pwd").focus();
		return false;
	}else{
		$("form").submit();
	}
}

$(function() {
	jQuery(document).bind('keydown', function (event){
		if(event.keyCode == 13 && ($("#uname").val() || $("#pwd").val())){
			 check_log(); 
		}
	  });	 
});

</script>
</head>
<body style="background:#4fbdfb;">
<div class="head" style="border:0px; background:#fff;">
  <div class="head_top2" style="border:0px;">
	<div class="logo"><a href="<?php echo site_url()?>"><img src="<?php echo main_url(base_url("skin/images/logo.jpg"));?>" alt="" /></a></div>
	<div class="clear"></div>
</div>
</div>
<div class="user_main">   
    <div class="sign">
    <div class="sign1">
    	<p id="sign1_p1">Not an <?php echo $site['site_name'];?> member yet?</p>
        <p id="sign1_p2">Now Let's Begin to Join....</p>
        <p>Start Your International <?php echo $site['site_name'];?> Trade</p>
        <p>Get Your Own Website for Free</p>
        <p>Display Your Company Profile Globally</p>
        <p>Showcase Your Company's Products & Services</p>
        <p>Send and Receive Inquiries or Messages</p>
        <p><a href="<?php echo site_url("reg_login/register")?>">Join Free</a></p>
    </div>
	<div class="sign_box">
		<form method="post" action="<?php echo main_url(site_url("reg_login/login_in"))?>">
		<div class="sign_boxtitle"><?php echo $site['site_name'];?> Member Login</div>
		<p>Email Address or Member ID :</p>
		<input class="sign_input" type="text" id="uname" name="uname" value="<?php echo $username?$username:'';?>"/>
		<p>Password :</p>
		<input class="sign_input" type="password" id="pwd" name="pwd" value="<?php echo $password?$password:'';?>" onpaste="return false" oncontextmenu="return false" oncopy="return false" oncut="return false"/>
		<div class="signin_bot" style="margin-top:10px;"><a href="#"  onclick="check_log()">Sign In</a></div>
		<div class="signin_join" style="margin-top:10px;"><a href="<?php echo main_url(site_url("reg_login/register"))?>">Join Free Now</a></div>
        <h1 style="padding-top:0px;"><a href="<?php echo main_url(site_url("reg_login/forget_password"))?>">Forgot password?</a></h1>
		</form>
	</div>
    <div class="clear"></div>
    </div>
    <div class="clear"></div>
</div>
<?php 
if($msg){
	echo "<script type='text/javascript'>";
	if ($msg['code']){
		echo "window.location.href='",main_url(site_url('user/user_main/index')),"';";
	}else{
		echo "alert('",$msg['msg'],"');";
	}
	echo "</script>";
}
?>
</body>
</html>