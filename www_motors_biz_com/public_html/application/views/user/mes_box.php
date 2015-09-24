<script src="<?php echo base_url('skin_user/js/jquery-1.4.js')?>" type="text/javascript"></script>
<script type="text/javascript">
$(function() {
	jQuery(document).bind('keydown', function (event){
		if(event.keyCode == 13 &&  $("#keywords").val()){
			 search(1); 
		}
	  });	 
});
function search(page){	
	var keywords=$("#keywords").val();
	if(keywords){
		$.ajax({
			type:"post",
			url:"<?php echo site_url('user/message/search')?>",		
				
			data:{id:new Date(),act:"search_msg",keywords:keywords,page:page,type:"<?php echo $type?>",typeid:"<?php echo $typeid?>"},
			dataType:"html",
			success:function(data){
						$("#content").html(data);				
					}
		});
	}else{
		alert("Please enter your search request first!");
	}
	
}

function show_friend(username){	
	if(username){
		$.ajax({
			type:"post",
			url:"<?php echo site_url('user/message/show_one_friend')?>",			
			data:{id:new Date(),act:"msg_showfri",friend_name:username,page:"<?php echo $page?>"},
			dataType:"html",
			success:function(data){
				if(data!='0'){
					window.location = data;	
				}else{					
					alert("The friend can't be found!");
				}
			}
		});
	}
}


</script>
<div class="user_main">
<form name="checkboxform">
		<div class="inbox_nav"><span><img src="<?php echo base_url("skin_user/images/inm_15.jpg")?>"  /></span>
		<a href="<?php echo site_url('user/user_main/index')?>">My Biz</a>
		<a href="<?php echo site_url('user/buy/manage_buy')?>">Buy</a>
		<a href="<?php echo site_url('user/sell/manage_sell')?>">Sell</a>
		<a href="<?php echo site_url('user/message/inbox')?>" id="inbox_nav_a">Messages & Contacts</a>
		<a href="<?php echo site_url('user/news/manage_news')?>">News</a></div>

    <div class="inbox2">
    	<div class="inbox2_left">
        	<div class="inbox2_left1 <?php if ($type=="inbox"){echo "inbox2_left1_1";}?>"><span><img src="<?php echo base_url("skin_user/images/icon2.gif")?>" width="22" height="20" /></span>
        	<a href="<?php echo site_url("user/message/inbox")?>">Inbox<?php if ($unread){echo "(",$unread,")";}?></a></div>
        	<div class="inbox2_left1 <?php if ($type=="sent_box"){echo "inbox2_left1_1";}?>"><span><img src="<?php echo base_url("skin_user/images/icon_03.gif")?>" width="22" height="20" /></span>
        	<a href="<?php echo site_url("user/message/sent_box")?>">Sent Box</a></div>
        	<div class="inbox2_left1"><span id="inbox2_left11"><img src="<?php echo base_url("skin_user/images/icon_10.gif")?>" width="17" height="16" /></span>
        	<a href="<?php echo site_url("user/message/mes_create")?>">New Message</a></div>
        	<div class="inbox2_left1 <?php if ($type=="trash"){echo "inbox2_left1_1";}?>"><span id="inbox2_left12"><img src="<?php echo base_url("skin_user/images/icon_14.gif")?>" width="15" height="16" /></span>
        	<a href="<?php echo site_url("user/message/trash")?>">Trash<?php if ($trash_count){echo "(",$trash_count,")";}?></a></div>
        	<div class="inbox2_left1"><span><img src="<?php echo base_url("skin_user/images/icon_18.gif")?>" width="26" height="26" /></span>
        	<a href="<?php echo site_url("user/message/contacts_list")?>">Contacts</a></div>
        	<div class="inbox2_left1 <?php if ($type=="drafts"){echo "inbox2_left1_1";}?>"><span><img src="<?php echo base_url("skin_user/images/icon_22.gif")?>" width="25" height="26" /></span>
        	<a href="<?php echo site_url("user/message/drafts")?>">My Folders<?php if ($drafts_count){echo "(",$drafts_count,")";}?></a></div>
      </div>
      <div class="inbox2_right">
      	<div class="inbox2_right1"></div>
      	<div class="inbox2_right2">
        	<div class="inbox2_right2_left"><A href="#" rel="nofollow" id="inbox2_right2_left1" onclick="del_mes('delete')">Delete</A>
        	<?php if ($type=="inbox"){?>
        	<A href="#" rel="nofollow" id="inbox2_right2_left2" onclick="del_mes('report spam')">Report Spam</A>
        	<?php }?>
        	<A href="<?php echo site_url("user/message/mes_create/")?>" id="inbox2_right2_left3">New Message</A></div>
            <div class="inbox2_right2_right">
            		
                	<input name="" id="keywords" type="text" class="inbox2_right2_right1" /><input style="cursor:pointer;" name="" type="text" onclick="search(1)"  class="inbox2_right2_right2" />
                	
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="inbox2_right3">
       	  <div class="inbox2_right3_1 inbox2_right3_11"><input name="" type="checkbox" value=""  onClick="switchAll()" /></div>
          <div class="inbox2_right3_1 inbox2_right3_12"><div></div></div>
          <?php if ($type=="inbox" || $type=="trash"){?>
          	<div class="inbox2_right3_1 inbox2_right3_13">Sender</div>
          <?php }else {?>
          	<div class="inbox2_right3_1 inbox2_right3_13">Receiver</div>
          <?php }?>
          <div class="inbox2_right3_1"></div>
          <div class="inbox2_right3_1 inbox2_right3_14">Subject</div>
          <div class="inbox2_right3_1">Date</div>
          <div class="inbox2_right3_1">Country</div>
          <div class="clear"></div>
        </div>
        <div class="inbox2_right4"> 
        <div id="content">       
        <?php if ($my_box){
        	foreach ($my_box as $k=>$v){?>
        
        
        <div class="inbox2_right4_1">
        	<div class="inbox2_right41">
           	  	<span class="inbox2_right41_1"><input name="<?php echo "C".$k?>" type="checkbox" value="<?php echo $v['mid']?>"/></span>
           	  	
           	  	<?php if ($type=="inbox" && !$v['isread']){?>
	                <span class="inbox2_right41_2"><img src="<?php echo base_url("skin_user/images/mm_45.jpg")?>" /></span>
	                <span class="inbox2_right41_3" style="cursor:pointer;" onClick="show_friend('<?php echo $v['fromuser']?>')"><strong><?php echo $v['fromuser']?></strong></span>
	                <span class="inbox2_right41_4">
	                <a href="<?php echo site_url("user/message/mes_detail/".$v['mid']."/".$type."/".$page)?>">
	                <strong style="color:black"><?php echo mb_substr(preg_replace("/(?<=href=)([^>]*)(?=>)/i","#", "{$v['title']}"), 0,50,"utf-8");?>...</strong></a>
	                </span>
                <?php }elseif ($type=="inbox" && $v['isread']){?>
                	<span class="inbox2_right41_2"><img src="<?php echo base_url("skin_user/images/inm_46.jpg")?>" /></span>
                	<span class="inbox2_right41_3" style="cursor:pointer;" onClick="show_friend('<?php echo $v['fromuser']?>')"><?php echo $v['fromuser']?></span>
                	<span class="inbox2_right41_4">
                	<a href="<?php echo site_url("user/message/mes_detail/".$v['mid']."/".$type."/".$page)?>" style="color:black">
                	<?php echo mb_substr(preg_replace("/(?<=href=)([^>]*)(?=>)/i","#", "{$v['title']}"), 0,50,"utf-8");?>...</a>
                	</span>
                <?php }elseif ($type=="sent_box"){?>
                	<span class="inbox2_right41_2"><img src="<?php echo base_url("skin_user/images/inm_46.jpg")?>" /></span>
                	<span class="inbox2_right41_3" style="cursor:pointer;" onClick="show_friend('<?php echo $v['touser']?>')"><?php echo $v['touser']?></span>
                	<span class="inbox2_right41_4">
                	<a href="<?php echo site_url("user/message/mes_detail/".$v['mid']."/".$type."/".$page)?>" style="color:black">
                	<strong><?php echo mb_substr(preg_replace("/(?<=href=)([^>]*)(?=>)/i","#", "{$v['title']}"), 0,50,"utf-8");?>...</strong></a>
                	</span>
                <?php }elseif ($type=="trash"){?>
                	<span class="inbox2_right41_2"><img src="<?php echo base_url("skin_user/images/inm_46.jpg")?>" /></span>
                	<span class="inbox2_right41_3" style="cursor:pointer;" onClick="show_friend('<?php echo $v['fromuser']?>')"><?php echo $v['fromuser']?></span>
                	<span class="inbox2_right41_4">
                	<a href="<?php echo site_url("user/message/mes_detail/".$v['mid']."/".$type."/".$page)?>" style="color:black">
                	<strong><?php echo mb_substr(preg_replace("/(?<=href=)([^>]*)(?=>)/i","#", "{$v['title']}"), 0,50,"utf-8");?>...</strong></a>
                	</span>
                <?php }elseif ($type=="drafts"){?>
                	<span class="inbox2_right41_2"><img src="<?php echo base_url("skin_user/images/inm_46.jpg")?>" /></span>
                	<span class="inbox2_right41_3" style="cursor:pointer;" onClick="show_friend('<?php echo $v['touser']?>')"><?php echo $v['touser']?></span>
                	<span class="inbox2_right41_4">
                	<a href="<?php echo site_url("user/message/send_draft/{$v['mid']}/{$type}")?>" style="color:black">
                	<strong><?php echo mb_substr(preg_replace("/(?<=href=)([^>]*)(?=>)/i","#", "{$v['title']}"), 0,50,"utf-8");?>...</strong></a>
                	</span>
                <?php }?>
                <span><?php 
			                if (date("Y-m-d",$v['addtime'])==date("Y-m-d")){
								echo date("H:i",$v['addtime']);
							}elseif (date("Y-m-d",$v['addtime'])==date("Y-m-d",strtotime("-1 day"))){
								echo "Yesterday";
							}elseif (date("Y",$v['addtime'])==date("Y")){
								echo date("m-d",$v['addtime']);
							}else{
			 					echo date("Y",$v['addtime']);
							}
				?></span>
                <span class="inbox2_right41_5"><img src="<?php echo base_url("skin_user/images/inm_42.jpg")?>" title="<?php echo $v['areaname']?>"/></span>                 
                <div class="clear"></div>
             </div>
            <div class="inbox2_right42"><?php echo mb_substr(preg_replace("/(?<=href=)([^>]*)(?=>)/i","#", "{$v['content']}"), 0,120,"utf-8");?></div>
        </div>
      
       <?php }?>
	        <script type="text/javascript">
			function switchAll() {
				var arr=document.getElementsByTagName("input");				
				var k=arr.length-4;
				for (var j = 0; j <= k; j++) {
					box = eval("document.checkboxform.C" + j);
					box.checked = !box.checked;
				}
			}			
			function del_mes(value){
				var str="";
				var arr=document.getElementsByTagName("input");				
				var k=arr.length-4;
				for (var j = 0; j <= k; j++) {
					var check_1=eval("document.checkboxform.C"+j);																									
					if(check_1.checked==true){							
						str+=check_1.value+'-';
					}
				}
				if(str==""){
					alert("Please select message first!");
				}else{
					if(confirm("Are you sure to "+value+" the selected messages？")){
						$.ajax({
							type:"post",
							url:"<?php echo site_url("user/message/mes_operate/")?>",
							data:{id:new Date(),act:value,del_mid:str,type:"<?php echo $type?>",curr_page:"<?php echo $page?>"},
							dataType:"json",
							success:function (json){
								alert(json.msg);
								if(json.total_count==0){
									window.location = "<?php echo site_url("user/message/".$type)?>";
								}else if(<?php echo $page?> < json.total_count){
									location.reload(true);
								}else{
									window.location = "<?php echo site_url("user/message/".$type."/".($page-$page_size))?>";
								}
							}
						});												 
				    }
				}
			}
			</script>
        
       <?php }else {
       			echo "<br/><br/><br/><center>There's no any message!</center>";
       			?>
       				<script type="text/javascript">
					function switchAll() {
						alert("There's no any message for selected!");
					}
					function del_mes(value){
						alert("There's no any message for you to "+value+"!");
					}
					</script>
      <?php }?>                        
           
        <div style="padding-top:5px;padding-bottom:5px;">
        <div class="black-red"><span class="disabled"><?php echo $pages;?></span></div></div>
        </div>
         </div> 
      <div class="inbox2_right2">
       	<div class="inbox2_right2_left"><A href="#" rel="nofollow" id="inbox2_right2_left1" onclick="del_mes('delete')">Delete</A>
       	<?php if ($type=="inbox"){?>
       	<A href="#" rel="nofollow" id="inbox2_right2_left2" onclick="del_mes('report spam')">Report Spam</A>
       	<?php }?>
       	<A href="<?php echo site_url("user/message/mes_create/")?>" id="inbox2_right2_left3">New Message</A></div>
        	<div class="clear"></div>
        </div>
        <div class="clear"></div>
      </div>
      <div class="clear"></div>
    </div>
   </form>
</div>
