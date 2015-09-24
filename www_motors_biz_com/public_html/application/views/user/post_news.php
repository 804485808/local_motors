<SCRIPT src="<?php echo base_url("skin_user/js/ae.js")?>" type="text/javascript"></SCRIPT>
<SCRIPT src="<?php echo base_url("skin_user/js/jquery.js")?>" type="text/javascript"></SCRIPT>
<SCRIPT src="<?php echo base_url("skin_user/js/swfupload.js")?>" type="text/javascript"></SCRIPT>
<SCRIPT src="<?php echo base_url("skin_user/js/swfu.js")?>" type="text/javascript"></SCRIPT>
<SCRIPT src="<?php echo base_url("skin_user/js/form.js")?>" type="text/javascript"></SCRIPT>
<SCRIPT src="<?php echo base_url("skin_user/js/jquery.popup.js")?>" type="text/javascript"></SCRIPT>
<script type="text/javascript" src="<?php echo base_url("skin_user/tiny_mce/tiny_mce.js")?>"></script>
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
tinyMCE.init({
        theme : "advanced",
		relative_urls : false,
		plugins : "preview,jbimages",
        mode : "textareas",
		theme_advanced_buttons1 : "code,preview,fontselect,fontsizeselect,bold,italic,underline,undo,redo,forecolor,backcolor,removeformat,numlist,bullist,jbimages",
        plugin_preview_width : "500",
        plugin_preview_height : "400",
        editor_selector : "input_P_2"
});

tinyMCE.init({
    theme : "simple",
	relative_urls : false,
    mode : "textareas",
    plugin_preview_width : "500",
    plugin_preview_height : "30",
    editor_selector : "no"
});
</script>

<script type="text/javascript">
function delete_image(id){
	var postdate = {img:$.trim($("#uploaded_path"+id).val())};
	$.ajax({
		type: "POST",
		url: "/index.php/user/news/delimg",
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
	$("#title").change(function(){
		if($("#title").val()!=''){
			$("#name_info").attr("style","display:none");
		}else{
			$("#name_info").attr("style","display:block");
		}
	});
	$("#content").change(function(){
		if($("#content").val()!=''){
			$("#detail_info").attr("style","display:none");
		}else{
			$("#detail_info").attr("style","display:block");
		}
	});
	
	$("#submit").click(function(){
		
		if($("#title").val()==''){
			$("#name_info").attr("style","display:block");
			return false;
		}
		tinyMCE.get("content").save();
		var $postopt = {
			type:      'POST',
			dataType:  'json',
			beforeSubmit: function(){
				$.popup('Processing,Please waitting...', {modal:true, button:{ok:false, cancel:false}});
			},
			success:function(json){
				if(json.code){
					$.popup(json.message, {modal:false, button:{ok:true},ok_callback:function(){
						location.href = json.href;
					}});
				}else{
					if(json.imgcode){
						//$('img#imgcode').attr('src', '/include/captcha.php?'+Math.random());
					}
					$.popup(json.message, {modal:false, button:{ok:true}});
				}
			}
		};
			
		$("#post_news").ajaxSubmit($postopt);
		
	});
});
</script>

<div class="user_main">
		<div class="inbox_nav"><span><img src="<?php echo base_url("skin_user/images/inm_15.jpg")?>"  /></span>
		<a href="<?php echo site_url('user/user_main/index')?>">My Biz</a>
		<a  href="<?php echo site_url('user/buy/manage_buy')?>">Buy</a>
		<a href="<?php echo site_url('user/sell/manage_sell')?>">Sell</a>
		<a href="<?php echo site_url('user/message/inbox')?>" >Messages & Contacts</a>
		<a id="inbox_nav_a" href="<?php echo site_url('user/news/manage_news')?>">News</a></div>

    <div class="inbox2">
    	<div class="inbox2_left">
        	<div class="inbox2_left1"><span><img src="<?php echo base_url("skin_user/images/uJ_account.png")?>" width="30" height="30" /></span><a href="<?php echo site_url('user/news/manage_news')?>">Manage News</a></div>
        	<div class="inbox2_left1 inbox2_left1_1"><span><img src="<?php echo base_url("skin_user/images/uJ_buy.png")?>" width="25" height="25" /></span><a href="<?php echo site_url('user/news/post_news')?>">Post News</a></div>
   	    </div>
    	<div class="inbox2_right">
      	<div class="inbox2_right1"></div>
		<div class="Manage_title">Post a News </div>
		<div class="Manage_title_sec">
			<span>Share your opinions </span><div class="clear"></div>
		</div>
		<form id="post_news" action="<?php echo site_url("/user/news/save_news")?>" method="post">
		<div class="P_all_template">
			<div class="P_all_template_t"><b>*</b>Title:</div>
			<input type="hidden" id="itemid" name="itemid" value="" /> 
			<input class="input_P_1" name='title' id='title' />
			<span id="name_info" class="worry_msg" style="display:none"> 
                No news title
            </span>
			<div class="P_clear"></div>
			<div class="P_all_template_t">Category:</div>
			
			<select name="catid" class="input_P_3a" id="catid">
			<option selected="selected" value="0" style="color:#999">Select Category</option>
			<?php foreach($news_group as $v):?>
			<option value="<?php echo $v['catid']?>" style="color:#999"><?php echo $v['catname']?></option>
			<?php endforeach;?>
			</select>
			<div class="P_clear"></div>
			 
			<div id="next">
			<div class="P_all_template_t"><b>*</b>Detail:</div>
			<textarea name="content" id="content" cols="" rows="" class="input_P_2" style='width: 580px; height: 250px;'/></textarea>
			<div class="clear"></div>
			<div class="P_all_Text"><div id="detail_info" class="worry_msg" style="display:none"> 
				No detial
			</div></div>
			<div class="P_clear"></div>
			
			<div class="P_all_template_t">Title Photo:</div>
			<span id="spanButtonPlaceholder"></span><input type="hidden" id="uploaded_path" name="path" value="" /> 
			<span id="uploaded_message_panel" style="border:1px solid #decdc4;background:#FFEFE0;padding:3px;"> 
                Allow Upload (jpg,jpeg,gif,png) type image, max 2048 KB
            </span>
			<div class="clear"></div>
			<div class="P_all_upload_pic">
				<ul>
					<li><div id="uploaded_preview_panel" style="text-align:center;">Waiting Upload</div></li>
				</ul>
			</div>
			
			<div class="P_clear"></div>
			<div class="P_all_template_t">Introduce:</div>
			<textarea name="introduce" id="introduce" style="overflow:auto;font-size:12px;resize:none;width: 580px; height: 50px;"></textarea>
			<div class="P_clear"></div>
			<div class="P_all_template_t">Author:</div>
			<input size=10 name='author' id='author' value="<?php echo $username;?>" />&nbsp;&nbsp;<span style="font-weight:bold;color: #666666;">Source:</span>&nbsp;
			<input size=18 name='source' id='source' value="<?php echo $site['site_name'];?>" />&nbsp;&nbsp;<span style="font-weight:bold;color: #666666;">Source Link:</span>&nbsp;
			<input size=28 name='fromurl' id='fromurl' value="<?php echo $site['main_domain'];?>" />
			<div class="P_clear"></div>
			<div class="P_all_template_t">Tag:</div>
			<input class="input_P_1" name='tag' id='tag' />
			<span style="background:#FFEFE0;">(Please use "," to separate from each tag and five tags at most.)</span>
		   <div class="P_clear"></div>

		</div>  
		</div>
		
        <div class="cutline_p"></div>
		<div class="acc_submita" id="submit"><a href="#">Submit</a></div>
      	</form>
        <div class="clear"></div>
      </div>
      <div class="clear"></div>
    </div>
</div>
