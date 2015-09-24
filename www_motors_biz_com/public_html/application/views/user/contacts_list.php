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
			data:{id:new Date(),act:"search_friends",keywords:keywords,page:page},
			dataType:"html",
			success:function(data){
						$("#content").html(data);				
					}
		});
	}else{
		alert("Please enter your search request first!");
	}
	
}
</script>

<div class="user_main">
		<div class="inbox_nav"><span><img src="<?php echo base_url("skin_user/images/inm_15.jpg")?>"  /></span>
		<a href="<?php echo site_url('user/user_main/index')?>">My Biz</a>
		<a href="<?php echo site_url('user/buy/manage_buy')?>">Buy</a>
		<a href="<?php echo site_url('user/sell/manage_sell')?>">Sell</a>
		<a href="<?php echo site_url('user/message/inbox')?>" id="inbox_nav_a">Messages & Contacts</a>
		<a href="<?php echo site_url('user/news/manage_news')?>">News</a></div>

    <div class="inbox2">
    <form name="checkboxform">
    	<div class="inbox2_left">
        	<div class="inbox2_left1"><span><img src="<?php echo base_url("skin_user/images/icon2.gif")?>" width="22" height="20" /></span>
        	<a href="<?php echo site_url("user/message/inbox")?>">Inbox<?php if ($unread){echo "(",$unread,")";}?></a></div>
        	<div class="inbox2_left1"><span><img src="<?php echo base_url("skin_user/images/icon_03.gif")?>" width="22" height="20" /></span>
        	<a href="<?php echo site_url("user/message/sent_box")?>">Sent Box</a></div>
        	<div class="inbox2_left1"><span id="inbox2_left11"><img src="<?php echo base_url("skin_user/images/icon_10.gif")?>" width="17" height="16" /></span>
        	<a href="<?php echo site_url("user/message/mes_create")?>">New Message</a></div>
        	<div class="inbox2_left1"><span id="inbox2_left12"><img src="<?php echo base_url("skin_user/images/icon_14.gif")?>" width="15" height="16" /></span>
        	<a href="<?php echo site_url("user/message/trash")?>">Trash<?php if ($trash_count){echo "(",$trash_count,")";}?></a></div>
        	<div class="inbox2_left1 inbox2_left1_1"><span><img src="<?php echo base_url("skin_user/images/icon_18.gif")?>" width="26" height="26" /></span>
        	<a href="<?php echo site_url("user/message/contacts_list")?>">Contacts</a></div>
        	<div class="inbox2_left1"><span><img src="<?php echo base_url("skin_user/images/icon_22.gif")?>" width="25" height="26" /></span>
        	<a href="<?php echo site_url("user/message/drafts")?>">My Folders<?php if ($drafts_count){echo "(",$drafts_count,")";}?></a></div>
      </div>
      <div class="inbox2_right">
      	<div class="inbox2_right1"></div>
      	<div class="inbox2_right2">
        	<div class="inbox2_right2_left"><A href="#" rel="nofollow" onclick="del_friend()" id="inbox2_right2_left1">Delete</A>
        	<A href="<?php echo site_url("user/message/mes_create")?>" id="inbox2_right2_left3">New Message</A></div>
            <div class="inbox2_right2_right">
            	
                	<input name="" id="keywords" type="text" class="inbox2_right2_right1" /><input style="cursor:pointer;" name="" type="text" onclick="search(1)"  class="inbox2_right2_right2" />
               
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="inbox2_right3">
       	  <div class="inbox2_right3_1 inbox2_right3_11"><input name="" type="checkbox" onClick="switchAll()" value="" /></div>
          <div class="inbox2_right3_1 contact">Contact Name</div>
          <div class="inbox2_right3_1"></div>
          <div class="inbox2_right3_1"></div>
          <div class="inbox2_right3_1">Contacts Type</div>
          <div class="inbox2_right3_1">Remarks</div>
          <div class="clear"></div>
        </div>
       <div id="content">
        <div class="inbox2_right4">
        <?php if ($contacts_list){foreach ($contacts_list as $k=>$v){?>
        	<div class="contact1">
        		<div class="contact1_1"><input name="<?php echo "C".$k?>" type="checkbox" value="<?php echo $v['username']?>" /></div>
                <div class="contact1_2"><a href="#" rel="nofollow"><img src="<?php echo base_url("skin_user/images/lianxiren_06.jpg")?>" width="32" height="32" /></a></div>
              	<div class="contact1_3"><img src="<?php echo base_url("skin_user/images/lianxiren_03.jpg")?>" width="11" height="11" /></div>
                <div class="contact1_4"><A href="<?php echo site_url("user/message/contacts_detail/".$v['username']."/".$page)?>"><?php echo $v['username']?></A><span>(<?php echo $v['username']?>)</span></div>
                <div class="contact1_5"><img src="<?php echo base_url("skin_user/images/registration_06.jpg")?>" width="21" height="16" title="<?php echo $v['areaname']?>" /></div>
                <div class="contact1_6"><?php echo $v['tname']?></div>
           	  	<div class="contact1_7">good friends!</div>
                <div class="clear"></div>
        	</div>
          <?php }?>
          <script type="text/javascript">
			function switchAll() {
				var arr=document.getElementsByTagName("input");				
				var k=arr.length-4;
				//alert(k);
				for (var j = 0; j <= k; j++) {
					box = eval("document.checkboxform.C" + j);
					box.checked = !box.checked;
				}
			}			
			function del_friend(){
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
					//alert(str);
					if(confirm("Are you sure to delete the selected friends？")){
						$.ajax({
							type:"post",
							url:"<?php echo site_url("user/message/friends_dels/")?>",
							data:{id:new Date(),del_username:str},
							dataType:"json",
							success:function (json){
								alert(json.msg);
								if(json.total_count==0){
									window.location = "<?php echo site_url("user/message/contacts_list/")?>";
								}else if(<?php echo $page?> < json.total_count){
									location.reload(true);
								}else{
									window.location = "<?php echo site_url("user/message/contacts_list/".($page-$page_size))?>";
								}
							}
						});	
											 
				    }
				}
			}
			</script>
          <?php }else {
       				echo "<br/><br/><br/><center>There's no any friend!</center>";
       			?><script type="text/javascript">
					function switchAll() {
						alert("There's no any friend for selected!");
					}
					function del_friend(){
						alert("There's no any friend for deleted!");
					}
					</script>
		<?php }?>
        </div>
        <div style="padding-top:5px;padding-bottom:5px;">
        <div class="black-red"><span class="disabled"><?php echo $pages;?></span></div>
      </div>
      </div>
      <div class="inbox2_right2">
       	<div class="inbox2_right2_left"><A href="#" rel="nofollow" id="inbox2_right2_left1" onclick="del_friend()">Delete</A>
       	<A href="<?php echo site_url("user/message/mes_create")?>" id="inbox2_right2_left3">New Message</A></div>
        	<div class="clear"></div>
        </div>
        <div class="clear"></div>
      </div>
      <div class="clear"></div>
      <form name="checkboxform">
    </div>
</div>
