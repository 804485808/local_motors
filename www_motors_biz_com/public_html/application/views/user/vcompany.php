<SCRIPT src="<?php echo base_url("skin_user/js/ae.js")?>" type="text/javascript"></SCRIPT>
<SCRIPT src="<?php echo base_url("skin_user/js/jquery.js")?>" type="text/javascript"></SCRIPT>
<SCRIPT src="<?php echo base_url("skin_user/js/swfupload.js")?>" type="text/javascript"></SCRIPT>
<SCRIPT src="<?php echo base_url("skin_user/js/swfu.js")?>" type="text/javascript"></SCRIPT>
<SCRIPT src="<?php echo base_url("skin_user/js/form.js")?>" type="text/javascript"></SCRIPT>
<SCRIPT src="<?php echo base_url("skin_user/js/jquery.popup.js")?>" type="text/javascript"></SCRIPT>
<script src="<?php echo base_url("skin_user/tiny_mce/tiny_mce.js")?>" type="text/javascript"></script>
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
<SCRIPT type="text/javascript">
function delete_image(id){
	var postdate = {img:$.trim($("#uploaded_path"+id).val())};
	$.ajax({
		type: "POST",
		url: "/index.php/user/sell/delimg",
		data: postdate,
		success: function(result) {
		  if (result == 1) {
			  $("#uploaded_preview_panel"+id).html('');
			  $("#uploaded_path"+id).val('');
		  }else{
			  alert("delete image error");
		  }
		}
	});
}

$(function(){
	var validate='<?php echo $validate['status']?>';
	if(validate=="being reviewed" || validate=="approved"){
		$("#post_sell").attr("style","display:none");		
		$("#status_span").attr("style","display:block");
	}else{
		$("#post_sell").attr("style","display:block");
		$("#status_span").attr("style","display:none");
	}	
	$("#title").change(function(){
		if($("#title").val()!=''){
			$("#name_info").attr("style","display:none");
		}else{
			$("#name_info").attr("style","display:block");
		}
	});
	
	$("#submit").click(function(){
		if($("#title").val()==''){
			$("#name_info").attr("style","display:block");
			return false;
		}
		if($("#uploaded_path").val()==''){
			$("#photo_info").attr("style","display:block");
			return false;
		}
		var $postopt = {
			type:      'POST',
			dataType:  'json',
			success:function(json){
				alert(json.message);
				if(json.code){
					location.reload(true);
				}				
			}
		};			
		$("#post_sell").ajaxSubmit($postopt);		
	});
});
</SCRIPT>

<div class="user_main">
		<div class="inbox_nav">
			<span><img src="<?php echo base_url("skin_user/images/inm_15.jpg")?>" /></span>
			<a href="<?php echo site_url('user/user_main/index')?>" id="inbox_nav_a">My Biz</a> <a href="<?php echo site_url('user/buy/manage_buy')?>">Buy</a>
			<a href="<?php echo site_url('user/sell/manage_sell')?>">Sell</a> <a href="<?php echo site_url('user/message/inbox')?>">Messages & Contacts</a>
			<a href="<?php echo site_url('user/news/manage_news')?>">News</a> 
		</div>

    <div class="inbox2">
    	<div class="inbox2_left">
			<div class="inbox2_left1">
				<span><img src="<?php echo base_url("skin_user/images/uJ_info.png")?>" width="24" height="24" /></span>
				<a href="<?php echo site_url('user/my_biz/show_info')?>">Information</a>
			</div>
			<div class="inbox2_left1">
				<span id="inbox2_left11"><img src="<?php echo base_url("skin_user/images/uJ_account.png");?>" width="24" height="24" /></span>
				<a href="<?php echo site_url('user/my_biz/account')?>">Account</a>
			</div>
			<div class="inbox2_left1">
				<span id="inbox2_left12"><img src="<?php echo base_url("skin_user/images/uJ_wallet.png")?>" width="24" height="24" /></span><a href="#">Wallet</a>
			</div>
			<div class="inbox2_left1 inbox2_left1_1">
				<span><img src="<?php echo base_url("skin_user/images/icon_22.gif")?>" width="24" height="24" /></span>
				<a href="<?php echo site_url('user/my_biz/vcompany')?>" title="<?php echo $validate['status']?>">Company Validate</a>
			</div>			
		</div>
    	<div class="inbox2_right">
      	<div class="inbox2_right1"></div>
		<div class="Manage_title">Submit Certificates </div>
		<div class="Manage_title_sec">
			<span></span><div class="clear"></div>
		</div>
		<form id="post_sell" action="<?php echo site_url("/user/my_biz/save_vcompany")?>" method="post" style="display:none">
		<div class="P_all_template">
			<div class="P_all_template_t"><b>*</b>Company:</div>
			<input class="input_P_1" name='title' id='title' value="<?php echo $company?>"/>
			<span id="name_info" class="worry_msg" style="display:none"> 
                No Certificate Title
            </span>
 
			<div class="P_clear"></div>			 
			<div id="next" >			
			<div class="P_all_template_t"><b>*</b>Photo:</div>
			<span id="spanButtonPlaceholder"></span><input type="hidden" id="uploaded_path" name="path" value="" /> 
			<span id="spanButtonPlaceholder"></span><input type="hidden" id="uploaded_path_1" name="path_1" value="" />
			<span id="spanButtonPlaceholder"></span><input type="hidden" id="uploaded_path_2" name="path_2" value="" />
			<span id="uploaded_message_panel" style="border:1px solid #decdc4;background:#FFEFE0;padding:3px;"> 
                Allow Upload (jpg,jpeg,gif,png) type image, max 2048 KB
            </span>
			<div class="clear"></div>
			<div class="P_all_upload_pic">
				<ul>
					<li><div id="uploaded_preview_panel" style="text-align:center;">Waiting Upload</div></li>
					<li><div id="uploaded_preview_panel_1" style="text-align:center;">Waiting Upload</div></li>
					<li><div id="uploaded_preview_panel_2" style="text-align:center;">Waiting Upload</div></li>
				</ul>
			</div>
			
			<div class="P_clear"></div>
			<div id="photo_info" class="worry_msg" style="display:none"> 
				No Photo
			</div>	
			<div class="P_all_template_t">Certificate Instruction:</div>
			<div style=" float:left; width:580px; padding-bottom:10px;line-height:18px; color:#666">1.Please upload your company’s valid documents (business license or organization code certificate,etc) to verify relevant certificates. <br/>
				2.The company name of the certificate must be in accordance with writing company’s name.<br/>
				3.Please upload at least one piece about certificate instructions, and three pieces at most.</div><div class="clear"></div>								
		</div>  
		</div>
		
        <div class="cutline_p"></div>
		<div class="acc_submita" id="submit"><a href="#">Submit</a></div>
      	</form>
      	<span id="status_span" style="display:none"><center>
      	<table>
      		<tr><th>Company:</th><td><?php echo $validate['title']?></td></tr>
      		<tr><th>Status:</th><td><?php echo $validate['status']?></td></tr>
      	</table>
      	</center></span>
		<div class="clear"></div>
      </div>
      <div class="clear"></div>
    </div>
</div>
