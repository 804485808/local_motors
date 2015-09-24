<script type="text/javascript"  src="<?php echo base_url('/skin/js/jquery.js')?>"></script>
<script type="text/javascript"  src="<?php echo base_url('/skin/js/list.js')?>"></script>
<div class="top3"><div class="Browse"><b>Browse by Location :</b>
<?php 
	foreach($country as $ct){
		$c=strtolower($ct);
		echo "<a href='#' rel='nofollow'><i><img src='",base_url("/skin/images/country/{$c}.png"),"' width='20' height='13' /></i></a><a href='#' rel='nofollow'>",$ct,"</a>";
	}
?>
<div class="clear"></div></div></div>
<div class="main">
	<div class="crumb"><a href="<?php echo main_url(site_url());?>" rel="nofollow">Home</a>><a href="<?php echo site_url("sell_list/index/catid_".$thiscat['catid']."/".$thiscat['linkurl']);?>"><?php echo $thiscat['catname'];?></a>><b><h1><?php echo $thistag['tag'];?></h1></b><?php if($sell_count){?><span>found <?php echo number_format($sell_count);?> Products for sale</span><?php }?></div>
    <div class="list">
    	<div class="list2_left">
        	<div class="list2_left1">
			<div id="gsFlShowHide" class="titleBox gsFlHide">Category</div>
            	<ul>
					<?php foreach($cats as $v):?>
					<?php if($catid != $v['catid']):?>
					<li><a href="<?php echo site_url("slist/index/".$thistag['id']."/cid_".$v['catid']."_".$thistag['linkurl']."_oid_0")?>" rel="nofollow">- <?php echo $v['catname']?></a> (<?php echo $count_cat[$v['catid']]['num']?>)</li>
					<?php else:?>
					<li>- <?php echo $v['catname']?> (<?php echo $count_cat[$v['catid']]['num']?>)</li>
					<?php endif;?>
					<?php endforeach;?>
				</ul>
            </div>
        </div>
    	<div class="list2_right">
        	<div class="list2_right1">
            	<div class="list2_right1_1">				
	<div class="listChar">
		<ul>
			<?php foreach($option_value as $option => $value):?>
			<li>
				<div class="listCharLeft"><p><?php echo $option?></p></div>
				<div class="listCharRight">
					<?php foreach($value as $op):?>
					<?php if($odid != $op['id']):?>
					<a href="<?php echo site_url("slist/index/".$thistag['id']."/cid_0_".$thistag['linkurl']."_oid_".$op['id'])?>" rel="nofollow"><?php echo $op['value']?><span>(<?php echo $op['cnum']?>)</span></a>
					<?php else:?>
					<a href="<?php echo site_url("slist/index/".$thistag['id']."/".$thistag['linkurl'])?>" rel="nofollow" class="cont"><?php echo $op['value']?><span>(<?php echo $op['cnum']?>)</span></a>
					<?php endif;?>
					<?php endforeach;?>
					<div class="clear"></div>
				</div>	<div class="clear"></div>
			</li>
			<?php endforeach;?>
		</ul>
		
	</div>
                </div>
            </div>
        	<div class="list2_right2">
            	<div class="px">
		<div class="left"><a href="#" rel="nofollow"><span id="m1" class="cMain">most popular</span></a>|<a href="#" rel="nofollow"><span id="n2">new arrivals</span></a>|<a href="#" rel="nofollow"><span id="p3">price</span></a></div>
		<div class="right">
			<div id="list" class="l">List</div>
			<div id="gallery" class="gNone">Gallery</div>
		</div>
		<div class="clear"></div>
	</div>
            </div>
        	<div class="list2_right3">
            	<div id="ListGallery" class="listL">		
		<?php 
			foreach($sells as $fg){
				echo "<ul>
			<li class='pic'><a href='",company_url(site_url('sell_detail/index/'.$fg['itemid'].'/'.$fg['linkurl']),$fg['username']),"'><img src='",$site['image_domain'].$fg['thumb'],"' width='150px' height='150px' alt='",$fg['title'],"' onerror=\"javascript:this.src='",base_url("skin/images/nopic.jpg"),"';\"/></a></li>
			<li class='nrBox'>
				<p class='h2'><a href='",company_url(site_url('sell_detail/index/'.$fg['itemid'].'/'.$fg['linkurl']),$fg['username']),"'>",$fg['title'],"</a></p>
				<p class='listNone'><span class='bold'>Business Type:</span>",$fg['mode'],"</p>
				<p class='listNone'><span class='bold'>Introduce:</span> ",strip_tags($fg['introduce']),"</p>
				<p class='listNone'><span class='bold'>Supplier:</span><a href='",company_url(site_url("company/index/"),$fg['username']),"'>",$fg['company'],"</a></p>
				
			</li>
			<li class='priceBox'>
				<p> ";
				echo $fg['minprice']>0 ? $fg['currency']." <span>".$fg['minprice'] : " <span>Negotiable"; 
				echo "</span></p><div class='clear'></div>
				<div class='listGConte'><a style='cursor: pointer;' onclick='GetInquiry.GetInquiryBox(".$fg['itemid'].");' rel='nofollow'><img src='",base_url('/skin/images/list_06.jpg'),"' alt='contact Supplier' /></a></div>
			</li><div class='clear'></div>
		</ul>";
			}
		?>				
		<div class="clear"></div>
	</div>
    <div class="clear"></div>
          </div>
        	<div class="list2_right4">
            	<div class="grayr"><?php echo $pages;?><span>Go to Page</span><form><p><input name="" type="text" class="grayr_text" /></p><input name="" type="button" class="grayr_button" /></form></div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="ad1"><a href="#" rel="nofollow"><img src="<?php echo base_url('/skin/images/main_01_48.png')?>" width="918" height="88" /></a></div>
	<div class="clear"></div>
</div>

<style type="text/css">
#show {
	width: 740px;
	height: 550px;
	display: none;
	position: absolute;
	border: 3px solid #008eca;
	background: #f8fbff;
	z-index: 11;
	zoom: 1;
	overflow: hidden;
}
#iqBgbox, .style1 {
	position: absolute;
	left: 0;
	top: 0;
	background: #000;
	filter: alpha(opacity=30);
	opacity: 0.3;
	z-index: 10;
	border: 0px;
}
.undis {
	display: none;
}
.dis {
	display: block;
}


</style>
<iframe id="iqIframe" rel="nofollow" frameborder="0" scrolling="no" class="undis"></iframe>
<div id="iqBgbox"></div>
<div id="show"></div>
<SCRIPT src="<?php echo main_url(base_url("skin_user/js/jquery.js"));?>" type="text/javascript"></SCRIPT>
<script type="text/javascript">
document.domain = "<?php echo $site['site_url']?>";
$(document).ready(function(){MultiSelect.Init();});$(document).keyup(function(){if(getEvent().keyCode==27){GetInquiry.CloseBox();$("#show").stop();}});$(window).scroll(function(){var showBox=$("#show");if(showBox.css("display")=="block"){showBox.css("top",(($(window).height()-parseInt(showBox.css("height")))/2+$(window).scrollTop())+"px");}});function getEvent(){return window.event||arguments.callee.caller.arguments[0];}
var MultiSelect={SpidCount:0,TigDiv:"#batInquiry",TigP:"#tig",Init:function(){if($.cookie(MultiSelect.CookieName())!=null){var ids=($.cookie(MultiSelect.CookieName())||"");$("input[name='SPId']").each(function(){if(ids.indexOf(this.value+",")>=0){this.checked=true;}});}
MultiSelect.CkClick();$(".itemBox ul,.promotion ul,.mainleft .itemBox,.mainleft .itemBox1,#divlistpro table,#frm .productA").bind("dblclick",function(){var caller=getEvent().target||getEvent().srcElement;if($(caller).attr("name")!="SPId"){var ck=$(this).find("input");if(ck.attr("checked")==true){ck.removeAttr("checked");MultiSelect.DelSelected(ck);}
else{ck.attr("checked","true");MultiSelect.AddSelected(ck);}}});},CkClick:function(){$("input[name='SPId']").bind("click",function(){if(this.checked){MultiSelect.AddSelected(this);}
else{MultiSelect.DelSelected(this);}});},DocClick:function(caller){if($(caller).attr("id")=="iqBgbox"){GetInquiry.CloseBox();}},AddSelected:function(inputObj){if(MultiSelect.SpidCount>=20){MultiSelect.ShowTig(inputObj,"Select <strong>"+MultiSelect.SpidCount+"</strong> product(s) at most ,<a href='javascript:void(0);' onclick='MultiSelect.ClearCookie();'>Reselect?</a>");$(inputObj).attr("checked","false");return;}
var ids=$.cookie(MultiSelect.CookieName())==null?"":$.cookie(MultiSelect.CookieName());var id=$(inputObj).val();if(ids!=null){if(ids.indexOf(id+",")<0){ids+=id+",";$.cookie(MultiSelect.CookieName(),ids,{expires:7});}
MultiSelect.SpidCount=ids.substring(0,ids.length-1).split(",").length;}
if(MultiSelect.SpidCount>0){MultiSelect.ShowTig(inputObj,"You have selected<strong>"+MultiSelect.SpidCount+"</strong>product(s), <a href='javascript:void(0);' onclick='MultiSelect.ClearCookie();'>Reselect?</a>");}},DelSelected:function(inputObj){var ids=$.cookie(MultiSelect.CookieName())||"";var id=$(inputObj).val();if(ids!=null){if(ids.indexOf(id+",")>=0){ids=ids.replace(id+",","");$.cookie(MultiSelect.CookieName(),ids,{expires:7});}
MultiSelect.SpidCount=ids.substring(0,ids.length-1).split(",").length;ids=ids.substring(0,ids.length-1);var lastid=ids.substring(ids.lastIndexOf(",")+1);if(lastid!=null&&lastid!=""&&MultiSelect.SpidCount>1){var lastCk=$("input[value='"+lastid+"']");if(lastCk.size()>0){MultiSelect.ShowTig(lastCk,"You have selected<strong>"+MultiSelect.SpidCount+"</strong>product(s), <a href='javascript:void(0);' onclick='MultiSelect.ClearCookie();'>Reselect?</a>");}
else{MultiSelect.CloseTig();}}
else{MultiSelect.CloseTig();}}},AddByID:function(id){var ck=$("input[value='"+id+"']");if(ck.size()==0)ck=$("input[value='"+id+"-p']");if(ck.size()==0)ck=$("input[value='"+id+"-c']");if(ck.size()>0){ck.attr("checked",true);MultiSelect.AddSelected(ck);return true;}
else{return false;}},ShowTig:function(inputObj,tigmsg){$(MultiSelect.TigP).html(tigmsg);var top=$(inputObj).offset().top;var left=$(inputObj).offset().left;$(MultiSelect.TigDiv).css({"display":"block","left":left-7,"top":top-67,"z-index":9999});},CloseTig:function(){$(MultiSelect.TigDiv).css("display","none");},ClearCookie:function(){$.cookie(MultiSelect.CookieName(),"");$("input[name='SPId']").each(function(){if(this.checked==true){this.checked=false;}});MultiSelect.SpidCount=0;MultiSelect.CloseTig();return false;},AllSelect:function(value){$("input[name='SPId']").each(function(){this.checked=value;if(value){MultiSelect.AddSelected(this);}
else{MultiSelect.DelSelected(this);}});},CookieName:function(){var parten="/(ic|chemicals)/";var reg=new RegExp(parten);if(reg.test(window.location.href)){var p=window.location.href.substring(window.location.href.lastIndexOf("/")+1);p=p.substring(0,p.lastIndexOf(".")).replace(/-/g,"_");return"ids_"+p;}
else{return"ids";}}};var GetInquiry={Domain:"<?php echo $site['main_domain']?>",Url:"index.php/supplier_connect/index/",IframeId:"iframeIqBox",GetInquiryBox:function(id,type,content,industryType,origin){var data="",isMulti=false;var t=typeof(type)=='undefined'?'spid':type;if(typeof(id)!='undefined'&&type!='cid'){if(MultiSelect.AddByID(id))isMulti=true;}
var ids=$.cookie(MultiSelect.CookieName())||"";if(ids==""&&typeof(id)=='undefined'){alert("please select more than a product!");return;}
if(!isMulti&&typeof(id)!='undefined'){data=id+"/";}
else if(ids!=""){data=ids+"/";}
else{data=id+"/";}
if(typeof(content)!='undefined'){
if(content=="Add your inquiry details for example:\n 1.Yourself Introduction\n 2.Required Size Range & Specification\n 3.Enquiry for Price / MOQ"){
	$("#content_input_span").html("<span class='worry_msg'> * required</span>");
	$("#content_input").focus();
	return false;
}
content = content.replace(/\r\n|\n/ig,"<br/>");
document.cookie = "sendmessage="+content+"; path=/";
if(content.length>2200){
	$("#content_input_span").html("<span class='worry_msg'>Enter between 20 to 2,000 characters.</span>");
	return false;
}
}
if(typeof(industryType)!='undefined'){data+=industryType+"/";}
if(typeof(origin)!='undefined'){data+=origin+"/";}

$("#show").html("");var iqIframe=$("<iframe>");iqIframe.attr("src",GetInquiry.Domain+GetInquiry.Url+data+new Date().getTime());iqIframe.attr({"id":GetInquiry.IframeId,"scrolling":"no","frameborder":"0","width":"100%","height":"100%"});$("#show").html("<img rel='loading' src='"+GetInquiry.Domain+"skin_user/images/loader.gif'/>");GetInquiry.ShowBox({"targetWidth":"28px","targetHeight":"28px","type":"loading"},function(){$("#show").append(iqIframe);});},NewGetInquiryBox:function(op){GetInquiry.GetInquiryBox(op.id,op.type,op.content,op.industryType,op.origin);},ShowBox:function(options,callback){var showBox=$("#show");var iWidth=$.browser.msie?$(document).width()-21:$(document).width();var iHeight=$(window).height();var docHeight=$(document).height();var sTop=$(window).scrollTop();$("#iqBgbox").css({"width":"100%","height":docHeight+"px","display":"block"});var bgIframe=$("#iqIframe");bgIframe.css({"width":"100%","height":docHeight+"px"});bgIframe.attr("class","style1 dis");var startWidth=options.startWidth||"0px";var startHeight=options.startHeight||"0px";var startLeft=showBox.css("display")=="block"?showBox.css("left"):-parseInt(startWidth)+"px";var startTop=showBox.css("display")=="block"?showBox.css("top"):sTop+iHeight+parseInt(startHeight)+"px";var targetWidth=options.targetWidth||showBox.css("width");var targetHeight=options.targetHeight||showBox.css("height");var targetLeft=(iWidth-parseInt(targetWidth))/2+"px";var targetTop=((iHeight-parseInt(targetHeight))/2+sTop)+"px";showBox.css({"display":"block","left":startLeft,"top":startTop,"width":startWidth,"height":startHeight,"z-index":9999});showBox.animate({"left":targetLeft,"top":targetTop,"width":targetWidth,"height":targetHeight},200,callback);},CloseBox:function(){$("#iqIframe").attr("class","undis");$("#show").hide();$("#iqBgbox").hide();$("#iqMsgbox").hide();}};jQuery.cookie=function(key,value,options){if(arguments.length>1&&String(value)!=="[object Object]"){options=jQuery.extend({},options);if(value===null||value===undefined){options.expires=-1;}
if(typeof options.expires==='number'){var days=options.expires,t=options.expires=new Date();t.setDate(t.getDate()+days);}
value=String(value);return(document.cookie=[encodeURIComponent(key),'=',options.raw?value:encodeURIComponent(value),options.expires?'; expires='+options.expires.toUTCString():'',options.path?'; path='+options.path:'',options.domain?'; domain='+options.domain:'',options.secure?'; secure':''].join(''));}
options=value||{};var result,decode=options.raw?function(s){return s;}:decodeURIComponent;return(result=new RegExp('(?:^|; )'+encodeURIComponent(key)+'=([^;]*)').exec(document.cookie))?decode(result[1]):null;};
</script>