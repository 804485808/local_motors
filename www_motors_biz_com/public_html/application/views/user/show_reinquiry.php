<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title?></title>
<link href="<?php echo base_url("skin/css/user.css")?>" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo base_url("skin/js/jquery-1.4.js")?>"></script>
<script type="text/javascript">
function check_reply(){
	if($("#content").val()==""){
		alert("Please fill in your reply content first!");
		$("#content").focus();
		return false;
	}else{
		$("form").submit();
	}
}
</script>
</head>
<body>
<div class="head">
  <div class="head_top2">
	<div class="logo"><a href="<?php echo main_url(site_url())?>"><img src="<?php echo main_url(base_url("skin/images/logo.jpg"));?>" alt="<?php echo $site['site_name']?>" /></a></div>
	<div class="head_top2_right">Already a Member?<a href="<?php echo site_url("reg_login/login_in")?>">Sign in here.</a></div>
	<div class="clear"></div>
</div>
</div>
<div class="user_main">
	<div class="user_main_left">
		<div class="user_main_left1">
		
			<div class="clear"></div>
		</div>
	<form method="post" action="<?php echo site_url("supplier_connect/nomem_inquiry/".$mid."/".$auth)?>">
	  <div class="reply">
	  	<p><a href="<?php echo main_url(site_url('content/index/'.$inquiry['sid'].'/'.$inquiry['linkurl']));?>" class="reply1" target="_blank"><?php echo $inquiry['product_name']?></a></p>
	  	<p><a href="<?php echo company_url(site_url(),$inquiry['fromuser']);?>" class="reply2" target="_blank"><?php echo $inquiry['company']?></a></p>
	  	<p><?php echo $inquiry['inquiry_data']['message']?></p>
	  	<p><textarea name="content" id="content" cols="30" rows="10"></textarea></p>
	  	<p><input type="button" value="reply" class="reply_button" onclick="check_reply()"/>
	  	<input type="button" value="cancel" class="reply_button1" onclick="this.form.reset();"/></p>
	  </div>
	</form>
	<div class="clear"></div>
	</div>
    <div class="user_main_right"><A href="#"><img src="<?php echo base_url("skin/images/registration_03.jpg")?>" alt="" /></A></A></div>
	<div class="clear"></div>
</div>
<?php 
if (isset($msg)){
	echo "<script type='text/javascript'>";	
	echo "alert('",$msg,"');";
	if ($msg=='Reply successfully!'){
		echo "window.location='",main_url(site_url()),"';";
	}
	echo "</script>";
}
?>
</body>
</html>
