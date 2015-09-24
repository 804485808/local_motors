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
        plugin_preview_height : "400"
});
</script>
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
function load_category(catid){
	$(function(){
		$.post('<?php echo site_url("/user/sell/check_sell_category/")?>',{"catid" : catid},function(data){
				  $show = Number(data);
				  if($show==1){
					$("#next").attr("style","display:block");
					$("#category_info").attr("style","display:none");
					$("#catid").val(catid);
					$.post('<?php echo site_url("/user/sell/category_option/")?>',{"catid" : catid},function(data){
						$("#option").html(data);
					});
				  }else{
					$("#next").attr("style","display:none");
				  }
		});
	});
}

function delete_image(id){
  $("#uploaded_preview_panel"+id).html('');
  $("#uploaded_path"+id).val('');
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
		if($("#next").attr("style")=='display:none'){
			$("#category_info").attr("style","display:block");
		}else{
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
			
			$("#post_sell").ajaxSubmit($postopt);
		}
		
	});
});
</script> 
<div class="user_main">
		<div class="inbox_nav"><span><img src="<?php echo base_url("skin_user/images/inm_15.jpg")?>"  /></span>
		<a href="<?php echo site_url('user/user_main/index')?>">My Biz</a>
		<a  href="<?php echo site_url('user/buy/manage_buy')?>">Buy</a>
		<a id="inbox_nav_a" href="<?php echo site_url('user/sell/manage_sell')?>">Sell</a>
		<a href="<?php echo site_url('user/message/inbox')?>" >Messages & Contacts</a>
		<a href="<?php echo site_url('user/news/manage_news')?>">News</a></div>

    <div class="inbox2">
    	<div class="inbox2_left">
        	<div class="inbox2_left1"><span><img src="<?php echo base_url("skin_user/images/uJ_account.png")?>" width="30" height="30" /></span><a href="<?php echo site_url('user/sell/manage_sell')?>">Manage Request </a></div>
        	<div class="inbox2_left1 inbox2_left1_1"><span><img src="<?php echo base_url("skin_user/images/uJ_buy.png")?>" width="25" height="25" /></span><a href="<?php echo site_url("user/sell/post_sell")?>">Post Product</a></div>
   	  </div>
    	<div class="inbox2_right">
      	<div class="inbox2_right1"></div>
		<div class="Manage_title">Edit Product </div>
		<div class="Manage_title_sec">
			<span>Tell The Buyer What You Have </span><div class="clear"></div>
		</div>
		<form id="post_sell" action="<?php echo site_url("/user/sell/save_sell")?>" method="post">
		<div class="P_all_template">
			<div class="P_all_template_t"><b>*</b>Product Name:</div>
			<input type="hidden" id="itemid" name="itemid" value="<?php echo $sell['itemid']?>" /> 
			<input class="input_P_1" name='title' id='title' value="<?php echo $sell['title']?>"/>
			<span id="name_info" class="worry_msg" style="display:none"> 
                No product name
            </span>
			<div class="P_clear"></div>
			<div class="P_all_template_t"><b>*</b>Product Category:</div>
			  <DIV class="selectListCate" id="selectListCate">
			  
			  <input type="hidden" id="catid" name="catid" value="<?php echo $sell['catid'];?>" /> 
  <DIV class="clearfix multiSelectList" id="multiSelectList">
  <SELECT name="oneSelect" tabindex="1" class="column" id="oneSelect" style="height: 214px;" size="10" onchange="load_category(this.value)"></SELECT> 
  <SELECT name="twoSelect" tabindex="2" class="column" id="twoSelect" style="height: 214px; display: none;" size="10" onchange="load_category(this.value)"></SELECT>         
  <SELECT name="threeSelect" tabindex="3" class="column" id="threeSelect" style="height: 214px; display: none;" size="10" onchange="load_category(this.value)"></SELECT>
  <SELECT name="fourSelect" tabindex="4" class="column last" id="fourSelect" style="height: 214px; display: none;" size="10" onchange="load_category(this.value)"></SELECT>
  
  </DIV>
  </DIV>
			<div id="category_info" class="worry_msg" style="display:none"> 
				Please choose the last Category
			</div>
 
			<div class="P_clear"></div>
			 
			<div id="next" style="display:block">
			<div class="P_all_template_t"><b>*</b>Product Detail:</div>
			<textarea name="content" id="content" cols="" rows="" class="input_P_2" style='width: 580px; height: 250px;'/><?php echo $sell['sell_data']['content']?></textarea>
			<div class="clear"></div>
			<div class="P_all_Text"><div id="detail_info" class="worry_msg" style="display:none"> 
				No detial
			</div></div>
			<div class="P_clear"></div>
			
			<div class="P_all_template_t"><b>*</b>Product Photo:</div>
			<span id="spanButtonPlaceholder"></span><input type="hidden" id="uploaded_path" name="path" value="<?php echo $sell['thumb']?>" /> 
			<span id="spanButtonPlaceholder"></span><input type="hidden" id="uploaded_path_1" name="path_1" value="<?php echo $sell['thumb1']?>" /> 
			<span id="spanButtonPlaceholder"></span><input type="hidden" id="uploaded_path_2" name="path_2" value="<?php echo $sell['thumb2']?>" /> 
			<span id="uploaded_message_panel" style="border:1px solid #decdc4;background:#FFEFE0;padding:3px;"> 
                Allow Upload (jpg,jpeg,gif,png) type image, max 2048 KB
            </span>
			<div class="clear"></div>
			<div class="P_all_upload_pic">
				<ul>
					<li><div id="uploaded_preview_panel"><img src="<?php echo $site['image_domain'].$sell['thumb']?>" width="100" height="100"><br/><span id=\"deleteimg\"><a style="cursor:pointer;" onclick="delete_image('')"><font style='color:red'>delete image</font></a></span></div></li>
					<li><div id="uploaded_preview_panel_1"><?php if($sell['thumb1']):?><img src="<?php echo $site['image_domain'].$sell['thumb1']?>" width="100" height="100"><br/><span id="deleteimg"><a style="cursor:pointer;" onclick="delete_image('_1')"><font style='color:red'>delete image</font></a></span><?php endif;?></div></li>
					<li><div id="uploaded_preview_panel_2"><?php if($sell['thumb2']):?><img src="<?php echo $site['image_domain'].$sell['thumb2']?>" width="100" height="100"><br/><span id="deleteimg"><a style="cursor:pointer;" onclick="delete_image('_2')"><font style='color:red'>delete image</font></a></span><?php endif;?></div></li>
				</ul>
			</div>
			
			<div class="P_clear"></div>
			<div id="photo_info" class="worry_msg" style="display:none"> 
				No Photo
			</div>
			
			<div id="option">
			<?php
				foreach($option as $k => $v){
					if(strtolower($v['name'])=='place of origin'){
						echo '<div class="P_all_template_t"><b>*</b>Place Of Origin:</div>'."\n";
						echo '<select name="option['.$k.']"><option value="0">---Please Select---</option>'."\n";
						foreach($areaname as $a){
							if(strtolower($a['areaname'])==strtolower($v['value'])){
								$selected = 'selected="selected"';
							}else{
								$selected = '';
							}
							echo '<option  value="'.$a['areaid'].'" '.$selected.'>'.$a['areaname'].'</option>'."\n";
						}
						echo "</select>";
						echo '<div class="P_clear"></div>'."\n";
						unset($option[$k]);
					}
				}
		
				foreach($option as $k => $v){
				echo '<div class="P_all_template_t">'.$v['name'].':</div>'."\n";
				echo '<input name=option['.$k.'] value="'.$v['value'].'" type="text" />';
				echo '<div class="P_clear"></div>'."\n";
				}
			?>
			</div>
			
			<div class="P_all_template_t"><b>*</b>Minimum Order Quantity:</div>
			<input class="input_P_3" name='minamount' value="<?php echo $sell['minamount']?>"/>
			<select style="width:130px;" name="unit" class="input_P_3a" id="unit">
				<option value="" style="color:#999">Select Unit Type</option>
				<option value="Acre" style="color:#000">Acre</option>
				<option value="Ampere" style="color:#000">Ampere</option>
				<option value="Bag" style="color:#000">Bag</option>
				<option value="Barrel" style="color:#000">Barrel</option>
				<option value="Box" style="color:#000">Box</option>
				<option value="Bushel" style="color:#000">Bushel</option>
				<option value="Carat" style="color:#000">Carat</option>
				<option value="Carton" style="color:#000">Carton</option>
				<option value="Case" style="color:#000">Case</option>
				<option value="Centimeter" style="color:#000">Centimeter</option>
				<option value="Chain" style="color:#000">Chain</option>
				<option value="Cubic Centimeter" style="color:#000">Cubic Centimeter</option>
				<option value="Cubic Foot" style="color:#000">Cubic Foot</option>
				<option value="Cubic Inch" style="color:#000">Cubic Inch</option>
				<option value="Cubic Meter" style="color:#000">Cubic Meter</option>
				<option value="Cubic Yard" style="color:#000">Cubic Yard</option>
				<option value="Degrees Celsius" style="color:#000">Degrees Celsius</option>
				<option value="Degrees Fahrenheit" style="color:#000">Degrees Fahrenheit</option>
				<option value="Dozen" style="color:#000">Dozen</option>
				<option value="Dram" style="color:#000">Dram</option>
				<option value="Fluid Ounce" style="color:#000">Fluid Ounce</option>
				<option value="Foot" style="color:#000">Foot</option>
				<option value="Forty-Foot Container" style="color:#000">Forty-Foot Container </option>
				<option value="Furlong" style="color:#000">Furlong</option>
				<option value="Gallon" style="color:#000">Gallon</option>
				<option value="Gill" style="color:#000">Gill</option>
				<option value="Grain" style="color:#000">Grain</option>
				<option value="Gram" style="color:#000">Gram</option>
				<option value="Gross" style="color:#000">Gross</option>
				<option value="Hectare" style="color:#000">Hectare</option>
				<option value="Hertz" style="color:#000">Hertz</option>
				<option value="Inch" style="color:#000">Inch</option>
				<option value="Kiloampere" style="color:#000">Kiloampere</option>
				<option value="Kilogram" style="color:#000">Kilogram</option>
				<option value="Kilohertz" style="color:#000">Kilohertz</option>
				<option value="Kilometer" style="color:#000">Kilometer</option>
				<option value="Kiloohm" style="color:#000">Kiloohm</option>
				<option value="Kilovolt" style="color:#000">Kilovolt</option>
				<option value="Kilowatt" style="color:#000">Kilowatt</option>
				<option value="Liter" style="color:#000">Liter</option>
				<option value="Long Ton" style="color:#000">Long Ton</option>
				<option value="Megahertz" style="color:#000">Megahertz</option>
				<option value="Meter" style="color:#000">Meter</option>
				<option value="Metric Ton" style="color:#000">Metric Ton</option>
				<option value="Mile" style="color:#000">Mile</option>
				<option value="Milliampere" style="color:#000">Milliampere</option>
				<option value="Milligram" style="color:#000">Milligram</option>
				<option value="Millihertz" style="color:#000">Millihertz</option>
				<option value="Milliliter" style="color:#000">Milliliter</option>
				<option value="Millimeter" style="color:#000">Millimeter</option>
				<option value="Milliohm" style="color:#000">Milliohm</option>
				<option value="Millivolt" style="color:#000">Millivolt</option>
				<option value="Milliwatt" style="color:#000">Milliwatt</option>
				<option value="Nautical Mile" style="color:#000">Nautical Mile</option>
				<option value="Ohm" style="color:#000">Ohm</option>
				<option value="Ounce" style="color:#000">Ounce</option>
				<option value="Pack" style="color:#000">Pack</option>
				<option value="Pair" style="color:#000">Pair</option>
				<option value="Pallet" style="color:#000">Pallet</option>
				<option value="Parcel" style="color:#000">Parcel</option>
				<option value="Perch" style="color:#000">Perch</option>
				<option value="Piece" style="color:#000">Piece</option>
				<option value="Pint" style="color:#000">Pint</option>
				<option value="Plant" style="color:#000">Plant</option>
				<option value="Pole" style="color:#000">Pole</option>
				<option value="Pound" style="color:#000">Pound</option>
				<option value="Quart" style="color:#000">Quart</option>
				<option value="Quarter" style="color:#000">Quarter</option>
				<option value="Rod" style="color:#000">Rod</option>
				<option value="Roll" style="color:#000">Roll</option>
				<option selected="selected" value="Set" style="color:#000">Set</option>
				<option value="Sheet" style="color:#000">Sheet</option>
				<option value="Short Ton" style="color:#000">Short Ton</option>
				<option value="Square Centimeter" style="color:#000">Square Centimeter</option>
				<option value="Square Foot" style="color:#000">Square Foot</option>
				<option value="Square Inch" style="color:#000">Square Inch</option>
				<option value="Square Meter" style="color:#000">Square Meter</option>
				<option value="Square Mile" style="color:#000">Square Mile</option>
				<option value="Square Yard" style="color:#000">Square Yard</option>
				<option value="Stone" style="color:#000">Stone</option>
				<option value="Strand" style="color:#000">Strand</option>
				<option value="Ton" style="color:#000">Ton</option>
				<option value="Tonne" style="color:#000">Tonne</option>
				<option value="Tray" style="color:#000">Tray</option>
				<option value="Twenty-Foot Container" style="color:#000">Twenty-Foot Container</option>
				<option value="Unit" style="color:#000">Unit</option>
				<option value="Volt" style="color:#000">Volt</option>
				<option value="Watt" style="color:#000">Watt</option>
				<option value="Wp" style="color:#000">Wp</option>
				<option value="Yard" style="color:#000">Yard</option>
		   </select>			
			<div class="P_clear"></div>
			
			<div class="P_all_template_t"><b>*</b>Price:</div>
			<input class="input_P_3" name='minprice' value="<?php echo $sell['minprice']?>"/>
			<select name="currency" class="input_P_3a" id="currency">
			<option value="" style="color:#999">Currency</option>
			<option selected="selected" value="USD" style="color:#000">USD</option>
			<option value="GBP" style="color:#000">GBP</option>
			<option value="RMB" style="color:#000">RMB</option>
			<option value="EUR" style="color:#000">EUR</option>
			<option value="AUD" style="color:#000">AUD</option>
			<option value="CAD" style="color:#000">CAD</option>
			<option value="CHF" style="color:#000">CHF</option>
			<option value="JPY" style="color:#000">JPY</option>
			<option value="HKD" style="color:#000">HKD</option>
			<option value="NZD" style="color:#000">NZD</option>
			<option value="SGD" style="color:#000">SGD</option>
			<option value="NTD" style="color:#000">NTD</option>
			<option value="Other" style="color:#000">Other</option>
			</select>
		   <div class="P_clear"></div>
			
		
			<div class="P_all_template_t">Product Group:</div>
			<select name="mycatid" class="input_P_3a" id="mycatid">
			<option selected="" value="0" style="color:#999">Ungrouped</option>
			<?php foreach($products_group as $v):?>
			<option <?php if($sell['mycatid']==$v['tid']):?>selected<?php endif;?> value="<?php echo $v['tid']?>" style="color:#999"><?php echo $v['tname']?></option>
			<?php endforeach;?>
			</select>
			</select>
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
<div class="foot">
	Product Listing Policy - Intellectual Property Policy and Infringement Claims - Privacy Policy - Terms of Use<br />
</div>
 <SCRIPT type="text/javascript">
  
      
  function queryString() {
      var Url = window.location.href;
      var u,
      g,
      StrBack = '';
      if (arguments[arguments.length - 1] == "#") {
          u = Url.split("#");
      } else {
          u = Url.split("?");
      }
      if (u.length == 1) {
          g = '';
      } else {
          g = u[1];
      }
      if (g != '') {
          gg = g.split("&");
          var MaxI = gg.length;
          str = arguments[0] + "=";
          for (i = 0; i < MaxI; i++) {
              if (gg[i].indexOf(str) == 0) {
                  StrBack = gg[i].replace(str, "");
                  break;
              }
          }
      }
      return StrBack;
      }
  function getUrlParameter(name, url){
      if( !url ){
          var url = location.href;
      }
      if(url.indexOf("?")==-1 || url.indexOf(name+'=')==-1){
          return false;
      }
      var queryString = url.substring(url.indexOf("?") + 1);
      var parameters = queryString.split("&");
      var pos, paraName, paraValue;
      for(var i = 0; i < parameters.length; i++){
          pos = parameters[i].indexOf('=');
          if(pos == -1) { continue; }
          paraName = parameters[i].substring(0, pos);
          paraValue = parameters[i].substring(pos + 1); 
          if(paraName == name){
              return unescape(paraValue.replace(/\+/g, " "));
          }
      }
      return false;
  };

  
  
  var Category = function( parentNode, id, title, hasPrivilege, warnMessage ){
      this.id=id;
      this.title = title;
      this.hasPrivilege = hasPrivilege;
      this.warnMessage = warnMessage;
      
      this.childCategorys = [];
      if( parentNode ){ this.applyParent( parentNode ); }
  };
  var warnMessageMap = {};
  var warnMessageMapIndex = 0;
  
  Category.prototype = {
      applyParent:function( parentNode ){		
        this.parentNode = parentNode;
          this.parentNode.addChild( this );
      },
      addChild:function( node ){
          this.childCategorys.push( node );
      },
      getChildOptions:function(){
          if( this.option == null ){
              this.option = new Option( this.title, this.id );
              this.option.setAttribute('hasPrivilege',this.hasPrivilege);
          
              if(this.warnMessage != 'b' && this.warnMessage != ''){
                  
                  warnMessageMap[warnMessageMapIndex] = this.warnMessage;
                  this.option.setAttribute('warnMessage',warnMessageMapIndex);
                  warnMessageMapIndex ++;
              }else{
                  this.option.setAttribute('warnMessage',this.warnMessage);
              }
      
              if(this.hasPrivilege == 'false'){
                  this.option.setAttribute('disabled',true);
              }
          };
  
          return this.option;
      }
  };
  
  var cat1;
  var cat2;
  var cat3;
  var cat4;
  
  var root=new Category(null, "0", ")", "true","");
			<?php foreach($cat1 as $k => $c1):?>
			cat1=new Category(root, "<?php echo $c1['catid']?>","<?php echo addslashes($c1['catname'])?>", "true", "")
				<?php foreach($cat2[$c1['catid']] as $c2):?>
				cat2=new Category(cat1, "<?php echo $c2['catid']?>","<?php echo addslashes($c2['catname'])?>", "true",  "" )
					<?php foreach($cat3[$c2['catid']] as $c3):?>
					cat3=new Category(cat2, "<?php echo $c3['catid']?>","<?php echo addslashes($c3['catname'])?>", "true", "" )
						<?php foreach($cat4[$c3['catid']] as $c4):?>
							 cat4=new Category(cat3, "<?php echo $c4['catid']?>","<?php echo addslashes($c4['catname'])?>", "true", "" )
						<?php endforeach;?>
					<?php endforeach;?>
				<?php endforeach;?>
			<?php endforeach;?>
              
                                                                                       
  function trim(str, leftTrim, rightTrim, mbspaceTrim) {
      if (leftTrim == null) {
          leftTrim = true;
      }
  
      if (rightTrim == null) {
          rightTrim = true;
      }
  
      if (mbspaceTrim == null) {
          mbspaceTrim = true;
      }
  
      var newstr = str;
      if (leftTrim) {
          newstr = newstr.replace(/^\s+/g, "");
          if (mbspaceTrim) {
              newstr = newstr.replace(/^(　|\s)+/g, "");
          }
      }
      if (rightTrim) {
          newstr  =newstr.replace(/\s+$/g, "");
          if (mbspaceTrim) {
              newstr = newstr.replace(/(　|\s)+$/g, "");
          }
      }
      return newstr;
  }
  </SCRIPT>
   
  <SCRIPT type="text/javascript">
  function showHiddenByIds(){
      var args = arguments;
      if( args.length == 0 ){ return ;}
      for( var i = 0; i<args.length; i+=2 ){
          if( i+1 >= args.length){ break;};
          YUD.setStyle( args[i],'display', args[i+1]);
      }
  }
  
  var mainform = document.MyCategoryForm;
  var one = get("oneSelect");
  var two = get("twoSelect");
  var three = get("threeSelect");
  var four = get("fourSelect");
  var result = get("resultSelect");
  var catObjArry = new Array(one,two,three,four);
  var addObj = get("submit_add");
  var dCategoryName = get('commonCategoryName');
  
  var beginIndex = 0;
  var selectedCatId=0;
  var maxCates=4;
  var isInited = false;
  function fillCategory(obj,category){
      if (obj==null) return ;
      var size = category.childCategorys.length;
      for(var i=0;i<size;i++){
          obj.options[i + beginIndex] = category.childCategorys[i].getChildOptions();
      }
  }
  
    function init(){
      if (root == null) return;
      fillCategory(one,root);
      //index = locateOption(one,selectedCatId);
      //if (index<0) index=0;
      //one.selectedIndex=index;
      
      //changeSelectListCate( one, true);
  
      YUE.on(one, 'change', function(){
          changeSelectListCate( one );
      });
      YUE.on(two, 'change', function(){
          changeSelectListCate( two );
      });
      YUE.on(three, 'change', function(){
          changeSelectListCate( three );
      });
      YUE.on(four, 'change', function(){
          changeSelectListCate( four );
      });
      YUE.on(one, 'dblclick', selectedLastClose);
      YUE.on(two, 'dblclick', selectedLastClose);
      YUE.on(three, 'dblclick', selectedLastClose);
      YUE.on(four, 'dblclick', selectedLastClose);
      YUE.on( get('hiddenProductListOption'), 'click', selfClose);
  
          if(two.options.length>0){
      two.style.display='';
          three.style.display='none';
          four.style.display='none';
      }
      if(three.options.length>0){
          two.style.display='';
          three.style.display='';
          four.style.display='none';
      }
      if(four.options.length>0){
          two.style.display='';
          three.style.display='';
          four.style.display='';
      }
      isInited = true;
  }
  
  function changeOne(){
      change(one,two);
      selectClear(three);
      selectClear(four);
      changeAddButton();
  }
  
  function changeTwo(){
      change(two,three);
      selectClear(four);
      changeAddButton();
  }
  
  function changeThree(){
      change(three,four);
      changeAddButton();
  }
  
  function changeFour(){
      changeAddButton();
  }
  
  function selectedLastClose(){
      if( isSelectLastCate() ){
          selfClose();
      }
  }
  
  function changeSelectListCate( el, isDoInit){
      switch( el.id ){
          case 'oneSelect':{
              changeOne();
              break;
          }
          
          case 'twoSelect':{
              changeTwo();
              break;
          }
          
          case 'threeSelect':{
              changeThree();
              break;
          }
          
          case 'fourSelect':{
              changeFour();
              break;
          }
      }
      submitData();
      if( isDoInit ){
          return;
      }
      
      selectedData();
      if( el ){
          setElementWidth( el );
      }	
      setContainerWidth(  );
      
      if (navigator.appVersion.indexOf("MSIE 5.5") >= 0 || navigator.appVersion.indexOf("MSIE 6.0") >= 0 || navigator.appVersion.indexOf("MSIE 7.0") >= 0)
      {	
          ReloadSelectElement();
      }
      
      
  }
  function setElementWidth( el ){
      var minWidth = 180;
      var sEl;
      
      if(el.id === 'oneSelect'){
          sEl = 'twoSelect';
      }
      if(el.id === 'twoSelect'){
          sEl = 'threeSelect';
      }
      if(el.id === 'threeSelect'){
          sEl = 'fourSelect';
      }
      if(el.id === 'fourSelect'){
          return;
      }
      el = get(sEl);
      YUD.setStyle(el,'width','auto');
      var w = getElementWidth( el );
      if(w < minWidth){
          YUD.setStyle(el, 'width', minWidth + 'px');
      }else{
          YUD.setStyle(el, 'width', w + 'px');
      }
      
  }
  function setContainerWidth( ){
      var wholeWidth = get('selectListCate').offsetWidth;
      var w1 = getElementWidth( one);
      var w2 = getElementWidth( two );
      var w3 = getElementWidth( three );
      var w4 = getElementWidth( four );
      
      var w = w1 + w2 + w3 + w4;
      if( w > wholeWidth){
          YUD.setStyle('multiSelectList', 'width', w + 'px');
          //var h = parseInt(YUD.getStyle('selectListCate', 'height'));
          //YUD.setStyle('selectListCate', 'height', h + 10 + 'px' );
          
          var left = 0;
          if (window.innerHeight) {
              left = window.pageXOffset;
            }
            else if (document.documentElement && document.documentElement.scrollTop) {
              left = document.documentElement.scrollLeft;
            }
            else if (document.body) {
              left = document.body.scrollLeft;
            }
          scrollToRight();
      }else{
          //var h = parseInt(YUD.getStyle('selectListCate', 'height'));
          //YUD.setStyle('selectListCate', 'height', h - 10 + 'px' );
          YUD.setStyle('multiSelectList', 'width', 'auto');
      }	
  }
  
  function scrollToRight(){
          var anim = new YAHOO.util.Scroll ( 'selectListCate', {
              scroll:{to: [1024, 0]}
          },2);
          anim.animate();
      
  }
  
  
  function getElementWidth( el ){
          if(YUD.getStyle(el,'display') === 'none'){
              return 0;
          }else{
              return el.offsetWidth + 10;
          }
  }
  
  
  function isSelectLastCate(){
   if(catObjArry == null) return false;
   for(var j=0;j<catObjArry.length;j++){
      catObj=catObjArry[j];
      if (catObj!=null){
         index=catObj.selectedIndex;
         if (catObj.options.length>0&&catObj.selectedIndex==-1)
         {
            return false;
         }
      }
   }
   return true;
  }
  
  function changeAddButton(){
      if (addObj==null) return ;
          if (result.options.length>=maxCates){
          addObj.disabled=true;
          return ;
      }
  
          if (!isSelectLastCate()){
      addObj.disabled=true;
      return ;
      }
      addObj.disabled=false;
  }
  
  function change(ddlb,changedDdlb){
      var index = ddlb.selectedIndex;
      selectClear(changedDdlb);
      if(ddlb.selectedIndex == -1) return;
  
      var selectedValue=ddlb.options[index].value;
      var currCate=getCurrentOption(root,selectedValue);
      if (currCate==null)return ;
          var childCategorys=currCate.childCategorys
      if (childCategorys==null) return ;
      var size=childCategorys.length;
      for(var i=0;i<size;i++){
          changedDdlb.options[i] = childCategorys[i].getChildOptions();
      }
          changedDdlb.selectedIndex = -1;
      if(size>0){
          changedDdlb.style.display="";
          changeLabelShow(changedDdlb,true);
      }
  }
  
  
  function getCurrentOption(category,catId){
      var childCategorys=category.childCategorys;
      if (childCategorys==null) {
          return null;
      }
      var len = childCategorys.length;
      for(var j=0;j<len;j++){
          if (childCategorys[j].id==catId){
              return childCategorys[j];
          }
          var re=getCurrentOption(childCategorys[j],catId);
          if (re!=null){
              return re;
          }
      }
      return null;
  }
  
  function getCatBuyCatId(category,catId){
      if (root==null) return null;
      var childCategorys=category.childCategorys;
      if (childCategorys==null) {
          return null;
      }
      for(var j=0;j<len;j++){
          if (childCategorys[j].id==catId){
              return childCategorys[j];
          }
      }
      return null;
  }
  
  function locateOption(oSel,itemValue){
      if(oSel==null) return -1;
      for(var j=0;j<oSel.options.length;j++){
          if (oSel.options[j].value==itemValue){
              return j;
          }
      }
      return -1;
  }
  
  function canAddItem(){
      if (result.options.length>=maxCates){
          alert("Sorry, you have chosen more than "+maxCates+" categories. Please check and choose again.");
          return false;
      }
      return true;
  }
  
  function selectedData(){
  
          if(two.options.length>0){
          two.style.display='';
          three.style.display='none';
          four.style.display='none';
      }
      if(three.options.length>0){
          two.style.display='';
          three.style.display='';
          four.style.display='none';
      }
      if(four.options.length>0){
          two.style.display='';
          three.style.display='';
          four.style.display='';
      }
  }
  
  function selectLastHint(){
      if(isSelectLastCate() == true) {
          showHiddenByIds('catgoryListTitle','none','selectedLastInfo','');
      } else {
          showHiddenByIds('catgoryListTitle','','selectedLastInfo','none');
      }
  }
  
  function submitData(){
      var oData = getSelectData();
      var isLast = isSelectLastCate();
      var categoryIds = '';
      
      /* 如果是false不载入下一级
      if(oData.hasPrivilege == 'false'){
          
          return;
      }
      */
      if( isLast == true ){
          categoryIds = oData.lastId;
      }
      if(typeof(parent.callbackSelectCategoryChange) == "function"){
          
          parent.callbackSelectCategoryChange({
              'categoryName': XMLDecode(oData.cateName),
              'categoryIds': oData.lastId, 
              'categoryIdsPathStr':oData.categoryIdsPathStr,
              'isLast':isLast,
              'hasPrivilege':oData.hasPrivilege,
              'warnMessage':oData.warnMessage,
              'catType':'all',
              'warnMessageMap': warnMessageMap
              },'browseCate');
      }else{
          
          try{
              findItem('commonCategoryIds',parent.document).value  = categoryIds;
              findItem('commonCategoryName',parent.document).value = XMLDecode(oData.cateName);
          }catch(E){}
      }
  }
  
  function getSelectData(){
      var oData = {cateName:'',lastId:'',categoryIdsPathStr:'',hasPrivilege:'',warnMessage:''};
      var categoryIdsPath = [];
      for(var j = 0; j < catObjArry.length; j++){
          catObj = catObjArry[j];
          if (catObj == null){
              break;
          }
          var index = catObj.selectedIndex;
          
          if (index == -1){
              break;
          }
          
          if(oData.cateName == ""){
              oData.cateName = catObj.options[index].innerHTML;
          }else{
              oData.cateName = oData.cateName+" >> "+catObj.options[index].innerHTML;
          }
          oData.lastId = catObj.options[index].value;
          oData.hasPrivilege = catObj.options[index].getAttribute('hasPrivilege');
          oData.warnMessage = catObj.options[index].getAttribute('warnMessage');
          
          categoryIdsPath.push(trim(catObj.options[index].value));
      }
      
      
      oData.categoryIdsPathStr = toCategoryIdsPathStrString( categoryIdsPath );
      return oData;
  }
  
  function toCategoryIdsPathStrString( a ){
          var s = '';
          if(!YL.isArray(a)){
              return s;
          }
          for(var i = 0, len = a.length; i < len; i++){
              if(a[i] != -1 || a[i] != '-1'){
                  s  = s + a[i] + ',';
              }
          }
          return s.substring(0,s.length-1);
          
  }
  
  function findItem(n, d) {
      var p,x,i;
      if(!d) d=document;
      if((p=n.indexOf("?"))>0&&parent.frames.length) {
          d=parent.frames[n.substring(p+1)].document;
          n=n.substring(0,p);
      }
      if(!(x=d[n])&&d.all)
          x=d.all[n];
      for (i=0;!x&&i<d.forms.length;i++)
          x=d.forms[i][n];
      for(i=0;!x&&d.layers&&i<d.layers.length;i++)
          x=findItem(n,d.layers[i].document);
      return x;
  }
  
  function XMLDecode(str){
      str = str.replace(/&amp;/ig,"&");
      str = str.replace(/&lt;/ig,"<");
      str = str.replace(/&gt;/ig,">");
      str = str.replace(/&apos;/ig,"'");
      str = str.replace(/&quot;/ig,"\"");
      return str;
  }
  
  function search(formObj){
      if(trim(formObj.keyword.value) == ''){
          alert('Please input a search term.');
          return false;
      }
      if (formObj.categoryIdsStr!=null) {
          formObj.categoryIdsStr.value = makeSelectCateStr();
      }
  
      return true;
  }
  
  function makeSelectCateStr(){
      var str="";
      for(var j=0;j<result.options.length;j++){
          if (j==0) {
              str=result.options[0].value;
          } else{
          str=str+","+result.options[j].value;
          }
      }
      return str;
  }
  
  function changeLabelShow(oSel,isShow){
      if (oSel==null||oSel.id==null) return;
      var labObj=document.getElementById(oSel.id+"_lab");
  
      if (labObj!=null){
          if (isShow){
              labObj.style.display="";
          } else{
              labObj.style.display="none";
          }
      }
  }
  
  function selectClear(oSel){
      if (oSel==null) return;
  
      oSel.length = 0;
          oSel.style.height=one.style.height;
          changeLabelShow(oSel,false);
  }
  
  function selfClose(){
      //submitData();
      if( typeof( parent.callbackCloseSelectCategory ) == 'function' ){
          parent.callbackCloseSelectCategory();
      }
      
      if( typeof( parent.callbackDoCategorySubmit ) == 'function' ){
          parent.callbackDoCategorySubmit();
      }
  }
  init();
  
  
  //根据参数初始化选择类目
  //参数'36,1512,361270,36127020'或者直接是数组;
  //Agriculture >> Agricultural & Gardening Tools >> Brush Cutters
  
  //initSelectedPathByName('Consumer Electronics&gt;&gt;DVD, VCD Player');
  
  function initSelectedPathByName( categoryName ){
      _initSelectedPath( categoryName, 'name');
  }
  
  function initSelectedPathByIds( categoryIdsPathStr ){
      _initSelectedPath( categoryIdsPathStr, 'id');
  }
  
  
  function _initSelectedPath( categoryPathStr, which ){
      var categoryPath;
      
      if(!which || which === ''){
          which = 'id';
      }
      
      if(YL.isArray(categoryPathStr)){
          if(categoryPathStr.length === 0){
              return;
          }
          categoryPath = categoryPathStr;
      }else{
          if(YL.isString( categoryPathStr )){
              if(categoryPathStr === ''){
                  return;
              }
              if(which === 'name'){
                  categoryPathStr = XMLDecode( categoryPathStr );
                  categoryPath = categoryPathStr.split('>>');
              }
              if(which === 'id'){
                  categoryPath = categoryPathStr.split(',');
              }
              
          }
      }
      var cat0 = categoryPath[0];
      if( cat0 ){
          selectOption(one, cat0, which);
          changeSelectListCate( one );
      }
      var cat1 = categoryPath[1];
      if( cat1 ){
          selectOption(two, cat1, which);
          changeSelectListCate( two );
      }
      
      var cat3 = categoryPath[2];
      if( cat3 ){
          selectOption(three, cat3, which);
          changeSelectListCate( three );
      }
      
      var cat4 = categoryPath[3];
      if( cat4 ){
          selectOption(four, cat4, which);
          changeSelectListCate( four );
      }
      
  }
  
  function selectOption(el , v, which){
      for(var i = 0, len = el.options.length; i < len; i++){
          if(which === 'id' && el.options[i].value == v){
              el.options[i].selected = true;
          }
          
          if(which === 'name' && el.options[i].text.trim() == v.trim()){
              el.options[i].selected = true;
          }
      }
  }
  
  if (navigator.appVersion.indexOf("MSIE 5.5") >= 0 || navigator.appVersion.indexOf("MSIE 6.0") >= 0 || navigator.appVersion.indexOf("MSIE 7.0") >= 0)
  {
      
      window.onload = ReloadSelectElement;
  }
  
  function ReloadSelectElement() {
      
  
      if (document.getElementsByTagName) {
          var s = document.getElementsByTagName("select");
  
          if (s.length > 0) {
              window.select_current = new Array();
  
              for (var i=0, select; select = s[i]; i++) {
                  select.onfocus = function(){ window.select_current[this.id] = this.selectedIndex; }
                  select.onchange = function(){ restore(this); }
                  emulate(select);
              }
          }
      }
  }
  
  function restore(e) {
      if (e.options[e.selectedIndex].disabled) {
          e.selectedIndex = window.select_current[e.id];
      }
  }
  
  function emulate(e) {
      for (var i=0, option; option = e.options[i]; i++) {
          
          if (option.disabled) {        
              option.style.color = "#6d6d6d";
          }
          else {
              option.style.color = "#000";
          }
      }
  }
  /*自定义事件 POST表单打点，由于IE下面iframe加载顺序的问题，没法准确在iframe加载完成之前注册上iframe的load事件，从而导致打点不成功*/
  
  YUE.on( one , 'change', function() {
      if ( typeof (parent.onOneChanged) !== 'undefined' && parent.onOneChanged !== null && typeof (parent.onOneChanged.fire) !== 'undefined' && parent.onOneChanged.fire !== null ) {
          parent.onOneChanged.fire();
      }
  });
  
  initSelectedPathByIds('<?php echo $arrparentid?>');
  //initSelectedPath('44,100000308,604');
  </SCRIPT>
</body>
</html>
