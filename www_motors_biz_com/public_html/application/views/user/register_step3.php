<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title;?></title>
<link href="<?php echo base_url("skin_user/css/user.css")?>" rel="stylesheet" type="text/css" />

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
	<?php if ($act!='quick_reg'){?>
	<div class="user_liu"><b>1</b><span>Register</span><b>2</b><span>Verify your identity</span><b id="user_liu1">3</b><span id="user_liu2">Complete</span><div class="clear"></div></div>
	<?php }?>
	<form>
	  <div class="user_main_left2">
	    <h1>Proven successful! Thank you for your confirmation!</h1>
        <div class="re3">
        	<p>You have completed <b>15%</b> personal profile. You can continue to fill detailed information about your company to be more trustworthy member and obtain more attention.</p>
            <p><a href="<?php echo site_url("user/my_biz/show_info")?>">Fill out your information</a></p>
        </div>
		<div class="clear"></div>
	</div>
	</form>
	<div class="clear"></div>
	</div>
    <div class="user_main_right"><A href="#"><img src="<?php echo base_url("skin_user/images/registration_03.jpg")?>" alt="" /></A></A></div>
	<div class="clear"></div>
</div>
<?php 
if ($msg){
	echo "<script type='text/javascript'>";
	echo "alert('",$msg,"');";
	if ($msg=='Your confirm email has expired,please login and Resend verification email!'){
		echo "window.location='",site_url('reg_login/login_in'),"';";
	}
	echo "</script>";
}
?>
</body>
</html>
