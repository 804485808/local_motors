<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title;?></title>
<link href="<?php echo base_url("skin/css/user.css")?>" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url('skin/js/jquery-1.4.js')?>" type=text/javascript></script>
<script type="text/javascript">

$(window).keydown(function(event){
	 if(event.keyCode == 13){
		 check_reg(); 
	  }
});

function check_reg(){
	var pattern=/^\d+$/;
	var pattern1=/^[A-Za-z0-9+]+[A-Za-z0-9\.\_\-+]*@([A-Za-z0-9\-]+\.)+[A-Za-z0-9]+$/;
	$("#nameSpan").html("");
	$("#companySpan").html("");
	$("#phoneSpan").html("");
	$("#usernameSpan").html("");	
	$("#emailSpan").html("");
	$("#pwdSpan").html("");
	$("#repwdSpan").html("");		
	if(document.frm.fname.value=="First Name"){		
		$("#nameSpan").html("<span class='worry_msg'>Please enter your first name!</span>");
		document.frm.fname.focus();
		return false;
	}else if(document.frm.lname.value=="Last Name"){
		$("#nameSpan").html("<span class='worry_msg'>Please enter your last name!</span>");
		document.frm.lname.focus();
		return false;
	}else if(document.frm.company.value=="Please enter your Company Name"){
		$("#companySpan").html("<span class='worry_msg'>Please enter your company!</span>");
		document.frm.company.focus();
		return false;
	}else if(document.frm.phone_2.value==""){
		$("#phoneSpan").html("<span class='worry_msg'>Please enter your phone!</span>");
		document.frm.phone_2.focus();
		return false;
	}else if(document.frm.phone_3.value==""){
		$("#phoneSpan").html("<span class='worry_msg'>Please enter your phone!</span>");
		document.frm.phone_3.focus();
		return false;
	}else if(document.frm.username.value==""){	
		$("#usernameSpan").html("<span class='worry_msg'>Please enter your username!</span>");	
		document.frm.username.focus();
		return false;
	}else if(document.frm.email.value==""){	
		$("#emailSpan").html("<span class='worry_msg'>Please enter your email!</span>");	
		document.frm.email.focus();
		return false;
	}else if(document.frm.password.value==""){	
		$("#pwdSpan").html("<span class='worry_msg'>Please enter your password!</span>");	
		document.frm.password.focus();
		return false;
	}else if(document.frm.password_2.value==""){	
		$("#repwdSpan").html("<span class='worry_msg'>Please enter your re_password!</span>");	
		document.frm.password_2.focus();
		return false;
	}else if(!pattern.test(document.frm.phone_1.value) || !pattern.test(document.frm.phone_2.value) || !pattern.test(document.frm.phone_3.value)){
			$("#phoneSpan").html("<span class='worry_msg'>Your phone is not valid!</span>");
			document.frm.phone_2.focus();
			return false;
	}else if(!pattern1.test(document.frm.email.value)){
		$("#emailSpan").html("<span class='worry_msg'>Your email is not valid!</span>");
		document.frm.email.focus();
		return false;
	}else if(document.frm.password.value!=document.frm.password_2.value){
		$("#repwdSpan").html("<span class='worry_msg'>Your re_password is wrong!</span>");
		document.frm.password_2.focus();
		return false;
	}else{
			document.getElementById('tform').submit();
		}
}
</script>



</head>
<body>
<div class="head">
	<div class="head_top1">
		<div class="head_top_left"><span>Welcome to <?php echo $site['site_name']?>!</span><a href="<?php echo site_url("reg_login/register")?>">REGISTER</a><font>|</font><a href="<?php echo site_url("reg_login/login_in")?>">SIGN IN</a></div>
		<div class="head_top_right">
        	<ul>
            	<li><a href="<?php echo site_url("user/buy/manage_buy")?>">Buy</a><span><img src="<?php echo base_url("skin/images/b2b5_03.jpg")?>" width="10" height="5" /></span><font>|</font>
                	
                <div class="clear"></div>
                </li>
                <li><a href="<?php echo site_url("user/sell/manage_sell")?>">Sell</a><span><img src="<?php echo base_url("skin/images/b2b5_03.jpg")?>" width="10" height="5" /></span><font>|</font>
                	
                <div class="clear"></div>
                </li>
                <li><a href="<?php echo site_url("user/my_biz/status")?>"><b>My Biz</b></a><span><img src="<?php echo base_url("skin/images/b2b5_03.jpg")?>" width="10" height="5" /></span><font>|</font>
                	
                <div class="clear"></div>
                </li><li><a href="#">Help</a><span><img src="<?php echo base_url("skin/images/b2b5_03.jpg")?>" width="10" height="5" /></span>
                	
                <div class="clear"></div>
                </li>
            <div class="clear"></div>
            </ul>
        </div>
        <div class="clear"></div>
    </div>
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
			<div class="user_main_left1_1">Start Your Online Business with <?php echo $site['site_name']?>!</div>
			<div class="user_main_left1_2">Complete the simple form below and become a free member today!</div>
			<div class="user_main_left1_3"><font>*</font>required.</div>
			<div class="clear"></div>
		</div>
	
	<form name="frm" id="tform" method="post" action="<?php echo site_url("reg_login/register")?>">
	
	<div class="user_main_left2">
		<div class="user_main_left2_1">Select Your Country & Account Type</div>
		<div class="user_main_left2_2">
			
				<table width="726" height="50" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td width="159" height="30" align="right" valign="middle"><font>*</font><strong>My business Location:</strong></td>
						<td width="567" height="30" valign="middle"><select name="areaid">
						<?php if ($area){
								foreach ($area as $v){									
									if ($v['areaid']==$areaid){
										echo "<option value='",$v['areaid'],"' selected>",$v['areaname'],"</option>";
									}else{
										echo "<option value='",$v['areaid'],"'>",$v['areaname'],"</option>";
									}
								}							
						}?>
						</select><span class="user_main_left2_2_img"><img src="<?php echo base_url("skin/images/registration_06.jpg")?>" alt="" /></span>
					  </td>
					</tr>
                    <tr>
						<td width="159" height="30" align="right" valign="middle"><font>*</font><strong>I am a:</strong></td>
					  <td height="30" valign="middle"><input type="checkbox" name="business_type[]" id="checkbox" checked/>Buyer
					  <input type="checkbox" name="business_type[]" id="checkbox" />Seller</td>
					</tr>
		  </table>

		</div>
		<div class="clear"></div>
	</div>
    <div class="user_main_left2">
		<div class="user_main_left2_1">Enter Your Contact Information</div>
		<div class="user_main_left2_2">
			
				<table width="723" height="50" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td width="152" height="30" align="right" valign="middle"><font>*</font><strong>Title:</strong></td>
						<td height="30" colspan="2" valign="middle">
						<?php if ($gender){?>
								<input type="radio" name="gender" id="radio" value="0" />Mr.
							    <input type="radio" name="gender" id="radio2" value="1" checked/>Ms.</td>
						<?php }else{?>
								<input type="radio" name="gender" id="radio" value="0" checked/>Mr.
							    <input type="radio" name="gender" id="radio2" value="1"/>Ms.</td>
					    <?php }?>
					</tr>
                    <tr>
						<td width="152" height="30" align="right" valign="middle"><font>*</font><strong>Full Name:</strong></td>
					  <td width="135" height="30" valign="middle"><input name="fname" type="text" id="textfield" value="<?php echo $fname?$fname:'First Name';?>"  onfocus="if (value =='First Name'){value =''}" onblur="if (value ==''){value='First Name'}"/></td>
						<td width="436" valign="middle"><input name="lname" type="text" id="textfield2" value="<?php echo $lname?$lname:'Last Name';?>" onfocus="if (value =='Last Name'){value =''}" onblur="if (value ==''){value='Last Name'}"/>
						<span id="nameSpan"></span>
						</td>
					</tr>
                    <tr>
						<td width="152" height="30" align="right" valign="middle"><font>*</font><strong>Company Name:</strong></td>
					  <td height="30" colspan="2" valign="middle"><input type="text" onfocus="if (value =='Please enter your Company Name'){value =''}" onblur="if (value ==''){value='Please enter your Company Name'}"   name="company" id="textfield3" value="<?php echo $company?$company:'Please enter your Company Name';?>" /><span id="companySpan"></span></td>
					</tr>
					 <tr>
						<td width="152" height="30" align="right" valign="middle"><font>*</font><strong>TelePhone:</strong></td>
						<td height="30" colspan="2" valign="middle"><input name="phone_1" type="text" id="textfield4" maxlength="4" value="<?php echo $phone_1?$phone_1:'86';?>" onfocus="if (value =='86'){value =''}" onblur="if (value ==''){value='86'}"/>
						  -
					      <input type="text" name="phone_2" id="textfield5" maxlength="3" value="<?php echo $phone_2?$phone_2:'';?>"/>
					      -
					      <input type="text" name="phone_3" id="textfield6" maxlength="8" value="<?php echo $phone_3?$phone_3:'';?>"/><span id="phoneSpan"></span></td>
					</tr>
                    <tr>
						<td width="152" height="30" valign="middle">&nbsp;</td>
						<td height="30" colspan="2" valign="middle">e.g. 86-571-12345678</td>
					</tr>
		  </table>

		</div>
		<div class="clear"></div>
	</div>
    <div class="user_main_left2">
		<div class="user_main_left2_1">Enter Your Username & Create Your Account</div>
		<div class="user_main_left2_2">
			
				<table width="721" height="50" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td width="158" height="30" align="right" valign="middle"><font>*</font><strong>Username:</strong></td>
					  <td width="563" height="30" valign="middle"><input type="text" name="username" id="textfield7" value="<?php echo $username?$username:'';?>" /><span id="usernameSpan"></span></td>
					</tr>
					<tr>
						<td width="158" height="30" align="right" valign="middle"><font>*</font><strong>E-mail Address:</strong></td>
					  <td width="563" height="30" valign="middle"><input type="text" name="email" id="textfield7" value="<?php echo $email?$email:'';?>" /><span id="emailSpan"></span></td>
					</tr>
                    <tr>
						<td width="158" height="30" align="right" valign="middle"><font>*</font><strong>Create a Password:</strong></td>
						<td height="30" valign="middle"><input type="password" maxlength="20" value="<?php echo $password?$password:'';?>" name="password" id="textfield8" onpaste="return false" oncontextmenu="return false" oncopy="return false" oncut="return false"/><span id="pwdSpan"></span></td>
					</tr>
					<tr>
						<td width="152" height="30" valign="middle">&nbsp;</td>
						<td height="30" colspan="2" valign="middle">maxlength:20bytes</td>
					</tr>
                    <tr>
						<td width="158" height="30" align="right" valign="middle"><font>*</font><strong>Re-enter Password:</strong></td>
						<td height="30" valign="middle"><input type="password" maxlength="20" value="<?php echo $password_2?$password_2:'';?>" name="password_2" id="textfield9" onpaste="return false" oncontextmenu="return false" oncopy="return false" oncut="return false" /><span id="repwdSpan"></span></td>
					</tr>
					
		  </table>

		</div>
		<div class="clear"></div>
	</div>
    <div class="user_main_left2_3"><a href="#" onclick="check_reg()">Create My Account</a></div>
	</form>
	<div class="clear"></div>
	</div>
    <div class="user_main_right"><A href="#"><img src="<?php echo base_url("skin/images/registration_03.jpg")?>" alt="" /></A></A></div>
	<div class="clear"></div>
</div>
<?php 
if ($msg){
	echo "<script type='text/javascript'>";
	echo "alert('",$msg,"');";
	if ($msg=="register success! Your should login your email to confirm you {$site['site_name']} account within 24 hours!" || $msg=='register success! But the confirmed email has not been sent,please resend again!'){
		echo "window.location='",site_url('reg_login/confirm/'.$username),"';";
	}else if($msg=='The member has registerd,but has not confirmed his/her email!'){
		echo "window.location='",site_url('reg_login/confirm/'.$username),"';";
	}
	echo "</script>";
}
?>
</body>


</html>
