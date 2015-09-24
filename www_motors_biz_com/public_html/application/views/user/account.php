<script src="<?php echo base_url('skin_user/js/jquery-1.4.js')?>" type=text/javascript></script>
<script type="text/javascript">

$(function(){
	$("#oldpwd").change(function(){
		$('#oldpwd_span').html("");
	});
	$("#newpwd").change(function(){
		$('#newpwd_span').html("");
	});

});
function check_true(){
	var oldpwd = $("#oldpwd").val();
	if(oldpwd != ''){
		//var datastring = 'oldpwd='+ oldpwd;
		//alert(oldpwd);
		 $.ajax({
			  type:"POST",   
			  url:"<?php echo site_url('user/my_biz/check_oldpwd');?>",    
			  data:{oldpwd:oldpwd,id:new Date()},
			  success:function(data){ //成功返回的数据
				  if(data==0){
					  		$("#oldpwd_span").html("<span class='worry_msg'>Please enter the correct password!</span>");
					  		document.form.oldpwd.focus();
					  		return false;
				  		}
				   }
			 });
	}
}

function check_pwd(){
	$("#oldpwd_span").html("");
	$("#newpwd_span").html("");
	$("#repwd_span").html("");
	if(document.form.oldpwd.value ==""){
		$("#oldpwd_span").html("<span class='worry_msg'>The Password field is required!</span>");
		document.form.oldpwd.focus();
		return false;
	}else if(document.form.newpwd.value ==""){
		$("#newpwd_span").html("<span class='worry_msg'>The Password field is required</span>");
		document.form.newpwd.focus();
		return false;
	}else if(document.form.newpwd.value.length<6){
		$("#newpwd_span").html("<span class='worry_msg'>The New Password field must be at least 6 characters in length</span>");
		document.form.newpwd.focus();
		return false;
	}else if(document.form.repwd.value ==""){
		$("#repwd_span").html("<span class='worry_msg'>The Password field is required</span>");
		document.form.repwd.focus();
		return false;
	}else if(document.form.newpwd.value != document.form.repwd.value){
		$("#repwd_span").html("<span class='worry_msg'>Please enter the correct password!</span>");
		document.form.repwd.focus();
		return false;
	}else{
		document.getElementById('form').submit();
	}
}

function CheckIntensity(pwd){
	  var Mcolor,Wcolor,Scolor,Color_Html;
	  var m=0;
	  var Modes=0;
	  for(i=0; i<pwd.length; i++){
	    var charType=0;
	    var t=pwd.charCodeAt(i);
	    //alert(t);break;
	    if(t>=48 && t <=57){charType=1;}
	    else if(t>=65 && t <=90){charType=2;}
	    else if(t>=97 && t <=122){charType=4;}
	    else{charType=4;}
	    Modes |= charType;
	  }
	  for(i=0;i<4;i++){
	  if(Modes & 1){m++;}
	      Modes>>>=1;
	  }
	  if(pwd.length<=5){m=1;}
	  if(pwd.length<=0){m=0;}
	  switch(m){
	    case 1 :
	      Wcolor="pwd pwd_Weak_c";
		  Mcolor="pwd pwd_c";
		  Scolor="pwd pwd_c pwd_c_r";
		  Color_Html="Low";
	    break;
	    case 2 :
	      Wcolor="pwd pwd_Medium_c";
		  Mcolor="pwd pwd_Medium_c";
		  Scolor="pwd pwd_c pwd_c_r";
		  Color_Html="Medium";
	    break;
	    case 3 :
	      Wcolor="pwd pwd_Strong_c";
		  Mcolor="pwd pwd_Strong_c";
		  Scolor="pwd pwd_Strong_c pwd_Strong_c_r";
		  Color_Html="High";
	    break;
	    default :
	      Wcolor="pwd pwd_c";
		  Mcolor="pwd pwd_c pwd_f";
		  Scolor="pwd pwd_c pwd_c_r";
		  Color_Html="None";
	    break;
	  }
	  document.getElementById('pwd_Weak').className=Wcolor;
	  document.getElementById('pwd_Medium').className=Mcolor;
	  document.getElementById('pwd_Strong').className=Scolor;
	  document.getElementById('pwd_Medium').innerHTML=Color_Html;
	}
</script>

<script type="text/javascript">
                  
			window.onload=function sayHello(){
                	var date = new Date();
                    var curr;
                    this.msg = "";
                    curr = date.getHours();
                     if(curr <12){
                        this.msg = "Good morning!";
                     }else if(curr > 17){
                        this.msg = "Good evening!";
                     } else{
                        this.msg = "Good afternoon!";
                     }
                     document.getElementById("hello_name").value = this.msg;
                  }
                  
       </script>

<div class="user_main">
	<div class="inbox_nav"><span><img src="<?php echo base_url("skin_user/images/inm_15.jpg")?>"  /></span>
	<a href="<?php echo site_url('user/user_main/index')?>" id="inbox_nav_a">My Biz</a>
	<a href="<?php echo site_url('user/buy/manage_buy')?>">Buy</a>
	<a href="<?php echo site_url('user/sell/manage_sell')?>">Sell</a>
	<a href="<?php echo site_url('user/message/inbox')?>">Messages & Contacts</a>
	<a href="<?php echo site_url('user/news/manage_news')?>">News</a></div>
    <div class="inbox2">
    	<div class="inbox2_left">
        	<div class="inbox2_left1"><span><img src="<?php echo base_url("skin_user/images/uJ_info.png")?>" width="24" height="24" /></span><a href="<?php echo site_url('user/my_biz/show_info')?>">Information</a></div>
        	<div class="inbox2_left1 inbox2_left1_1"><span id="inbox2_left11"><img src="<?php echo base_url("skin_user/images/uJ_account.png")?>" width="24" height="24" /></span><a href="<?php echo site_url('user/my_biz/account')?>">Account</a></div>
        	<div class="inbox2_left1"><span id="inbox2_left12"><img src="<?php echo base_url("skin_user/images/uJ_wallet.png")?>" width="24" height="24" /></span><a href="#">Wallet</a></div>
			<div class="inbox2_left1"><span><img src="<?php echo base_url("skin_user/images/icon_22.gif")?>" width="24" height="24" /></span><a href="<?php echo site_url('user/my_biz/vcompany')?>">Company Validate</a></div>
   	  </div>
    	<div class="inbox2_right">
			<div>
				<div class="hello_name"><input id="hello_name"  style="background-color:transparent;border:0px;color:#0066FF;width:110px " readonly/> <?php echo $firstname?></div>
				<div class="clear"></div>
			</div>
			<div class="clear" style="border-bottom:1px solid #CCCCCC"></div>
			
			  <div class="Big_t_">
				<p>Change Password</p>
				<div class="clear"></div>
			  </div>
			<form name="form" id="form" action="<?php echo site_url('user/my_biz/account')?>" method="post">
			<?php echo validation_errors(); ?>
				<div class="acc_left">
					<ul>
					<li>
						  <p>Old Password:</p>
						  <span><input type="password" class="input_s5" name="oldpwd" id="oldpwd" maxlength="20" onpaste="return false" oncontextmenu="return false" oncopy="return false" oncut="return false" onblur="check_true()"/>
						  <span id="oldpwd_span"></span></span><div class="clear"></div>
				    </li>
					<li>
						  <p>New Password:</p>
						  <span><input type="password" class="input_s5" name="newpwd" id="newpwd" maxlength="20"  onkeyup="CheckIntensity(this.value)" onpaste="return false" oncontextmenu="return false" oncopy="return false" oncut="return false" />
						  <span id="newpwd_span"></span></span><div class="clear"></div>
				    </li>
					<li>
						  <p>Current Password:</p>
						  <span><input type="password" class="input_s5" name="repwd" id="repwd" maxlength="20"  onpaste="return false" oncontextmenu="return false" oncopy="return false" oncut="return false" />
						  <span id="repwd_span"></span></span><div class="clear"></div>
				    </li>
						<div class="acc_jb">
							<ul>
								<li id="pwd_Weak" class="pwd pwd_c">&nbsp;</li>
								<li id="pwd_Medium" class="pwd pwd_c pwd_f">None</li>
								<li id="pwd_Strong" class="pwd pwd_c pwd_c_r">&nbsp;</li>
								<div class="clear"></div>
								
							</ul>
							<div class="acc_submit"><a href="#" onclick="check_pwd()">Submit</a></div>
						</div>
					  
					</ul>
				</div>
			</form>
      </div>
      <div class="clear"></div>
    </div>
</div>
<?php 
if (@$msg){
	echo "<script type='text/javascript'>";
	echo "alert('".$msg."');";
	if ($msg=='Save successfully!'){
		echo "window.location='".site_url('user/user_main/index')."';";
	}
	echo "</script>";
}
?>
