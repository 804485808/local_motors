<script src="<?php echo base_url('skin_user/js/jquery-1.4.js')?>" type=text/javascript></script>
<SCRIPT src="<?php echo base_url("skin_user/js/swfupload.js")?>" type="text/javascript"></SCRIPT>
<SCRIPT src="<?php echo base_url("skin_user/js/swfu.info.js")?>" type="text/javascript"></SCRIPT>
<script type="text/javascript"> 
//上传成功后
function uploadSuccess(file, serverData) {
	try {
	   try{
	       var json = eval('(' + serverData + ')');
				
	   }catch(e){
	       $data = '{"code":"0", "message":"Data Loading error, please contact administrator."}';
	       var json = eval("(" + $data + ")");
	   }
			//console.log(json);
	   if(json.code){
	       var $preview = $('#'+this.customSettings.uploaded_preview);
	       var $image  = $('<img>');
	       $image.attr('src', '<?php echo $site['image_domain']."/";?>'+json.src);
				$image.attr('height', 100);
				$image.attr('width', 100);
	       $preview.html('').append($image);
				$preview.append("<br/><span id=\"deleteimg\"><a style=\"cursor:pointer;\" onclick=\"delete_image()\"><font style='color:red'>delete image</font></a></span>");
	       $('#'+this.customSettings.uploaded_path).val(json.src);
	       $stats = this.getStats();
	       $.each($stats, function(item){
	           $stats[item] = 0;
	       });
	       this.setStats($stats);
	   }else{
	       qmsg(this, json.message);
	   }
	} catch (ex) {
		this.debug(ex);
	}
}
</script>
<script type="text/javascript"> 

		window.onload = function () {		
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
		};
		
</script>

<script type="text/javascript">

function save_info(){
		
$("#save_id").html("<img src='<?php echo base_url("skin_user/images/uJ_6.jpg")?>' />Please waitting");
$("#nameSpan").html("");
$("#passSpan").html("");
$("#emailSpan").html("");
$("#phoneSpan").html("");
$("#qqSpan").html("");
$("#addrSpan").html("");
$("#mailSpan").html("");
$("#teleSpan").html("");

 var pattern=/^\d+$/;
 var pattern1 = /^(13[0-9]|15[0-9]|18[8|9])\d{8}$/;
 var pattern2 = /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;
 var pattern3 = /^[1-9]{1}[0-9]{4,9}$/;
 var pattern4 = /^([\u4e00-\u9fa5]+)|([a-zA-Z]+){1,30}|(.)$/;
 var first=$("#first").val(); 
 var last=$("#last").val(); 
 var sex=document.getElementsByName("gender");
 var gender;
  for(var i = 0; i < sex.length; i++)
 {
      if(sex[i].checked)
      gender=i;
  }
 var location_1=$("#location_1").val(); 
 var email=$("#email").val(); 
 var phone_1=$("#phone_1").val(); 
 var phone_2=$("#phone_2").val(); 
 var department=$("#department").val(); 
 var qq=$("#qq").val(); 
 var ali=$("#ali").val(); 
 var career=$("#career").val(); 
 var company=$("#company").val(); 
 var location_2=$("#location_2").val(); 
 var mail=$("#mail").val(); 
 var telephone_1=$("#telephone_1").val(); 
 var telephone_2=$("#telephone_2").val(); 
 var telephone_3=$("#telephone_3").val(); 
 var content=$("#content").val(); 
 var address=$("#address").val();
 var path=$("#uploaded_path").val();

 if(first=="First Name"){		
		$("#nameSpan").html("<span class='worry_msg'>Please enter your first name!</span>");
		document.frm.first.focus();
		return false;
	}else if(last=="Last Name"){
		$("#nameSpan").html("<span class='worry_msg'>Please enter your last name!</span>");
		document.frm.last.focus();
		return false;
	}else if(!pattern4.test(first) || !pattern4.test(last)){
		$("#nameSpan").html("<span class='worry_msg'>Your name is not valid!</span>");
		document.frm.first.focus();
		return false;
	}else if(email==""){
		$("#emailSpan").html("<span class='worry_msg'>Please enter your email address!</span>");
		document.frm.email.focus();
		return false;
	}else if(!pattern2.test(email)){
		$("#emailSpan").html("<span class='worry_msg'>Your email address is not valid!</span>");
		document.frm.email.focus();
		return false;
	}else if(!pattern.test(phone_1) || !pattern.test(phone_2)){
		$("#phoneSpan").html("<span class='worry_msg'>Your phone number is not valid!</span>");
		document.frm.phone_1.focus();
		return false;
	}else if(content==''){
		$("#contentSpan").html("<span class='worry_msg'>Please enter your Introduction!</span>");
		document.frm.qq.focus();
		return false;
	}else if(address==""){
		$("#addrSpan").html("<span class='worry_msg'>Please enter your address!</span>");
		document.frm.address.focus();
		return false;
	}else if(address.length < 6){
		$("#addrSpan").html("<span class='worry_msg'>Address length cannot be less than 6!</span>");
		document.frm.address.focus();
		return false;
	}else if(!pattern2.test(mail)){
		$("#mailSpan").html("<span class='worry_msg'>Your email address is not valid!</span>");
		document.frm.mail.focus();
		return false;
	}else if(!pattern.test(telephone_1) || !pattern.test(telephone_2) || !pattern.test(telephone_3)){
		$("#teleSpan").html("<span class='worry_msg'>Your telephone number is not valid!</span>");
		return false;
	}else{
		$.post("<?php echo site_url('user/my_biz/saveinfo');?>",
			{
				first:first,last:last,gender:gender,location_1:location_1,email:email,
				phone_1:phone_1,phone_2:phone_2,department:department,qq:qq,ali:ali,career:career,
				company:company,location_2:location_2,mail:mail,telephone_1:telephone_1,telephone_2:telephone_2,
				telephone_3:telephone_3,content:content,address:address,path:path
			},
			function(data){
				 if(data.code){
				   	alert('Save successfully!');
				   	location.href="<?php echo site_url('user/my_biz/show_info');?>";
				 }else{
					 alert(data.message);
					 return false;
				 }
				 $("#save_id").html("<a href='#' onclick='save_info();'><img src='<?php echo base_url("skin_user/images/uJ_6.jpg")?>' />Save</a>");
			}, "json");
	  }
  
}


function delete_image(){
	var postdate = {img:$.trim($("#uploaded_path").val())};
	$.ajax({
		type: "POST",
		url: "/index.php/user/sell/delimg",
		data: postdate,
		success: function(result) {
		  if (result == 1) {
			  $("#uploaded_preview_panel").html('');
			  $("#uploaded_path").val('');
		  }else{
			  alert("delete image error");
		  }
		}
	});
}
</script>
	<div class="user_main">
		<div class="inbox_nav">
			<span><img src="<?php echo base_url("skin_user/images/inm_15.jpg")?>" /></span>
			<a href="<?php echo site_url('user/user_main/index')?>" id="inbox_nav_a">My Biz</a> <a href="<?php echo site_url('user/buy/manage_buy')?>">Buy</a>
			<a href="<?php echo site_url('user/sell/manage_sell')?>">Sell</a> <a href="<?php echo site_url('user/message/inbox')?>">Messages & Contacts</a>
			<a href="<?php echo site_url('user/news/manage_news')?>">News</a>
		</div>
		<div class="inbox2">
			<div class="inbox2_left">
				<div class="inbox2_left1 inbox2_left1_1">
					<span><img src="<?php echo base_url("skin_user/images/uJ_info.png")?>" width="24" height="24" /></span>
					<a href="<?php echo site_url('user/my_biz/show_info')?>">Information</a>
				</div>
				<div class="inbox2_left1">
					<span id="inbox2_left11"><img
						src="<?php echo base_url("skin_user/images/uJ_account.png");?>" width="24" height="24" /></span>
						<a href="<?php echo site_url('user/my_biz/account')?>">Account</a>
				</div>
				<div class="inbox2_left1">
					<span id="inbox2_left12"><img
						src="<?php echo base_url("skin_user/images/uJ_wallet.png")?>" width="24" height="24" /></span><a href="#">Wallet</a>
				</div>
				<div class="inbox2_left1"><span><img src="<?php echo base_url("skin_user/images/icon_22.gif")?>" width="24" height="24" /></span><a href="<?php echo site_url('user/my_biz/vcompany')?>">Company Validate</a></div>
			</div>
			<div class="inbox2_right">
			<form name="frm" id="form_info" action="<?php echo site_url('user/my_biz/saveinfo')?>" method="post">
				<div>
					<div class="hello_name">
						<input id="hello_name" style="background-color: transparent; border: 0px; color: #0066FF; width: 110px" /> <?php echo $firstname?></div>
					<div class="balance_money"></div>
					
					<div class="clear"></div>
				</div>
				<div class="my_info">
						<div class="nanme_List"><font color=red>* </font>
							<input class="input_s1" name="first" id="first" value='<?php echo $first;?>' onfocus="if (value =='First Name'){value =''}" onblur="if (value ==''){value='First Name'}" maxlength="20"/> 
							<input class="input_s1" name="last" id="last" value='<?php echo $last;?>' onfocus="if (value =='Last Name'){value =''}" onblur="if (value ==''){value='Last Name'}"  maxlength="20"/>
							<!--	 I am a 
								<select name="my_type">
									<option>Seller</option>
									<option>Buyer</option>
								</select>
							-->
							<br /><span id="nameSpan"></span>
							<div class="clear"></div>
						</div>
						<div class="my_info_left">
							<ul>
								<li>
									<p><font color=red>* </font>Gender:</p> <span> <input type="radio" name="gender" id="radio" value="1" <?php if (!$gender){echo "checked";}?> <?php if ($gender == "Mr."){?> checked
										<?php }?> />Mr. <input type="radio" name="gender" id="radio" value="0" <?php if ($gender == "Ms."){?> checked <?php }?> />Ms.
								</span>
									<div class="clear"></div>
								</li>
								<li>
									<p><font color=red>* </font>Country:</p> <span> <select style="width: 185px;"
										name="location_1" id="location_1">
						  		<?php
								if ($location_all) {
									foreach ( $location_all as $v ) {
										?>
						  		<?php if ($areaid == $v['areaid']){?>
							  <option value="<?php echo $v['areaid'];?>" selected><?php echo $v['areaname'];?></option>
							  <?php }else {?><option value="<?php echo $v['areaid'];?>"><?php echo $v['areaname'];?></option><?php }?>
							  <?php }}?>
						  </select>
								</span>
								<div class="clear"></div>
								</li>
								
								<li>
									<p><font color=red>* </font>E-mail:</p> <span><input class="input_s2" name="email" id="email" value="<?php echo $email;?>"  maxlength="40" readonly /></span>
									<br /><span id="emailSpan"></span>
								<div class="clear"></div>
								</li>

								<li>
									<p><font color=red>* </font>Phone:</p> <span> 
										<input class="input_ss" name="phone_1" id="phone_1" value="<?php echo $mobile_1;?>"  />-
										<input class="input_sm" style="width: 100px;" name="phone_2" id="phone_2" value="<?php echo $mobile_2;?>"  />
									<br /><span id="phoneSpan">eg:086-xxxxxxxxxx</span>
								</span>
								<div class="clear"></div>
								</li>
								<li>
									<p>QQ:</p> <span><input class="input_s2" name="qq" id="qq" value="<?php echo $qq;?>" maxlength="20" /></span>
								<div class="clear"></div>
								<span id="qqSpan"></span>
								</li>
								<li>
									<p>Ali:</p> <span><input class="input_s2" name="ali" id="ali" value="<?php echo $ali;?>"  maxlength="25"/></span>
								<div class="clear"></div>
								</li>
								<li>
									<p>Department:</p> <span><input class="input_s2" name="department" id="department" value="<?php echo $department;?>" maxlength="25"/></span>
								<div class="clear"></div>
								</li>
								<li>
									<p>Career:</p> <span><input class="input_s2" name="career" id="career" value="<?php echo $career;?>" maxlength="25"/></span>
								<div class="clear"></div>
								</li>

							</ul>
						</div>
						<div class="clear"></div>
						
					
				</div>

				<div class="company_info">
					<div class="my_info_pic">
						<div class="my_info_picB" id="uploaded_preview_panel">
						<?php if ($thumb){?><img src="<?php echo $site['image_domain'].$thumb;?>" width="120px" height="120px" /><?php }else{?>
						<img src="<?php echo base_url("skin_user/images/uJ_5.jpg")?>" width="120px" height="120px" /><?php }?>
						
					</div>

						<span id="spanButtonPlaceholder"></span><input type="hidden" id="uploaded_path" name="path" value="<?php echo $thumb;?>" /><br />
						<span id="uploaded_message_panel" style="border: 1px solid #decdc4; background: #FFEFE0; padding: 0px;">
							Allow Upload (jpg,jpeg,gif,png) type image, max 2048 KB </span>

					</div>

					<div class="my_info_left">
						<ul>
							<li>
								<p><font color=red>* </font>Company:</p> <span><input class="input_s2" name="company" id="company" value="<?php echo $company;?>" <?php if ($company){?>readonly<?php }?> /> </span>
							<div class="clear"></div>
							</li>
							<li>
								<p><font color=red>* </font>Country:</p> <span> <select style="width: 185px;" name="location_2" id="location_2">
							 	 <?php	
									if ($location_all_1) {
									foreach ( $location_all_1 as $v ) {?>
						  		 <?php if ($areaid_1 == $v['areaid']){?>
							  <option value="<?php echo $v['areaid'];?>" selected><?php echo $v['areaname'];?></option>
							  <?php }else {?><option value="<?php echo $v['areaid'];?>"><?php echo $v['areaname'];?></option><?php }?>
							  <?php }}?>
						  </select>
							</span>
							<div class="clear"></div>
							</li>
							<li>
								<p><font color=red>* </font>Address :</p> <span><input class="input_s2" name="address" id="address" value="<?php echo $address;?>" maxlength="235" /> </span>
									<br /><span id="addrSpan"></span>
							<div class="clear"></div>
							</li>
							<li>
								<p><font color=red>* </font>E-mail:</p> <span><input class="input_s2" name="mail" id="mail" value="<?php echo $mail;?>" maxlength="40" <?php if ($mail):?>readonly<?php endif;?> /> </span>
									<br /><span id="mailSpan"></span>
							<div class="clear"></div>
							</li>

							<li>
								<p><font color=red>* </font>Telephone:</p> <span> 
									<input class="input_ss" name="telephone_1" id="telephone_1" value="<?php echo $telephone_1;?>"  />- 
									<input class="input_sm" name="telephone_2" id="telephone_2" value="<?php echo $telephone_2;?>"  />- 
									<input class="input_sl" name="telephone_3" id="telephone_3" value="<?php echo $telephone_3;?>"  />
							</span>
							<br /><span id="teleSpan">eg:086-0571-xxxxxxxxxx</span>
							<div class="clear"></div>
							</li>
							<li>
								<p><font color=red>* </font>Introduction:</p> <span>
								<textarea cols=70 rows=10 name="content" id="content" style="overflow: auto; font-size: 12px; resize: none;"><?php echo $content;?></textarea></span>
								<span id="contentSpan"></span>
							<div class="clear"></div>
							</li>
						</ul>
					</div>
					<div class="clear"></div>
					<div class="Save_info" id="save_id">
						<a href="#save_id" onclick="save_info()"><img src="<?php echo base_url("skin_user/images/uJ_6.jpg")?>" />Save</a>
					</div>

				</div>
			</form>
				<div class="clear"></div>
			</div>
			<div class="clear"></div>
		</div>
	</div>
<?php 
if ($msg):
?>
<script type="text/javascript">
	alert('<?php echo $msg;?>');
</script>
<?php endif;?>