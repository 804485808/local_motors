<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title;?></title>
<link href="<?php echo base_url("skin_user/css/user.css")?>" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url('skin_user/js/jquery.js')?>" type=text/javascript></script>
<script type="text/javascript">
$(function() {
	jQuery(document).bind('keydown', function (event){
		if(event.keyCode == 13 && ($("#pwd_id").val() || $("#rpwd_id").val() || $("#textfield10").val())){
			 set_pwd(); 
		}
	  });	 
});
function set_pwd(){
	$("#pwd_span").html("");
	$("#rpwd_span").html("");
	$("#cck_span").html("");
	if($("#pwd_id").val()==""){		
		$("#pwd_span").html("<span class='worry_msg'>Please enter your password!</span>");
		$("#pwd_id").focus();
	}else if($("#pwd_id").val().length<6){		
		$("#pwd_span").html("<span class='worry_msg'>At least 6 characters!</span>");
		$("#pwd_id").focus();
	}else if($("#rpwd_id").val()==""){		
		$("#rpwd_span").html("<span class='worry_msg'>Please enter your re-password!</span>");
		$("#rpwd_id").focus();
	}else if($("#pwd_id").val()!=$("#rpwd_id").val()){
		$("#rpwd_span").html("<span class='worry_msg'>Your passwords do not match. Please try again!</span>");
		$("#rpwd_id").focus();
	}else if($("#textfield10").val()==""){		
		$("#cck_span").html("<span class='worry_msg'>Please enter your security code!</span>");
		$("#textfield10").focus();
	}else{
		$.post("<?php echo site_url("reg_login/set_password")?>", { email:"<?php echo $email?>",pwd:$("#pwd_id").val(),rpwd:$("#rpwd_id").val(),cck:$("#textfield10").val(),act:"set_password"},
				function(data){
					alert(data);
					if(data=='The act was not valid!' || data=='New password was set successfully,login in <?php echo $site['site_name'];?> now!'){
						window.location = "<?php echo site_url("reg_login/login_in")?>";
					}else if(data=='The email was wrong,please try again!'){
						window.location = "<?php echo site_url("reg_login/forget_password")?>";
					}				
				}, "html");
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
	  <div class="user_main_left2 acc1">
	    <p class="forget"><span class="forget_span">New Password :</span><input maxlength="20" id="pwd_id" name="" type="password" /><span id="pwd_span"></span><div class="clear"></div></p>
	    <p class="forget"><span class="forget_span">Re-Password :</span><input maxlength="20" id="rpwd_id" name="" type="password" /><span id="rpwd_span"></span><div class="clear"></div></p>
        <p class="forget"><span class="forget_span">verification code:</span><input  maxlength="5" name="" type="text" id="textfield10" /><i>
        <img id="cck" src="<?php echo site_url('imgcode/index')?>" style="cursor:pointer" width="71" height="33" onclick="this.src='<?php echo site_url('imgcode/index/')?>?random='+Math.random();"  alt="Can't see?Change it!" title="Can't see?Change it!"/>        
        </i><span id="cck_span"></span><div class="clear"></div></p>
        <p><input type="button" id="re2_a2" value="Submit" href="#" onclick="set_pwd()"></p>
        <p></p>
        
		<div class="clear"></div>
	</div>

	<div class="clear"></div>
	</div>
	<div class="clear"></div>
</div>
<?php 
if ($msg){
	echo "<script type='text/javascript'>";	
	echo "alert('",$msg,"');";
	if ($msg=='Your confirm message is wrong,please resend the confirm email again!' || $msg=='Your confirm email has expired,please resend the confirm email again!'){
		echo "window.location='",site_url('reg_login/forget_password'),"';";
	}
	echo "</script>";
}
?>
</body>
</html>
