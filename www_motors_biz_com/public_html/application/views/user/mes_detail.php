<script src="<?php echo base_url('skin_user/js/jquery-1.4.js')?>" type=text/javascript></script>
<script type="text/javascript">
function del_one_mes(){
	if(confirm("Are you sure to delete this message?")){
        window.location = "<?php echo site_url("user/message/mes_del/".$mid."/".$type."/".$page)?>";
    }
}


function send(){
	if(confirm("Are you sure to add this friend?")){
		var mid = <?php echo $mid;?>;
		var type = '<?php echo $type;?>';
		$.post("<?php echo site_url("add_friend/add/{$mid}/{$type}");?>",{mid:mid,type:type},
				function(data){
					data=Number(data);
					 if(data==2){
					   	alert('Save successfully!');
					 }else if(data==1){
						 alert('You have already added this friend!');return false;
					}else if(data==3){
						alert('You have sent successfully, you can not repeatedly sent!');return false;
					}else{
						alert('Save failure,please try again!');return false;
					}
				}, "html");
		  }
}

function quick_reply(){
	var content=$("#reply_content").val();
	if(content==''){
		alert('Please fill on the reply content first!');
	}else{
		$.post("<?php echo site_url("user/message/quick_reply")?>", 
				{ mid:<?php echo $mes_detail['mid']?>,subject: "reply:<?php echo $mes_detail['title'];?>", typeid:"<?php echo $mes_detail['typeid']?>", to: "<?php echo $mes_detail['fromuser']?>", from: "<?php echo $mes_detail['touser']?>", content: content,inquiry_id:"<?php echo $mes_detail['iid']?>"},
				   function(data){
					 if(data=='1'){
						alert('Reply successfully!');
						//$("#reply_content").val('');
						location.reload(true);
				     }else if(data=='-1'){
				    	 alert('Reply failed,please try again!');
					 }else{
				    	 alert('The reply elements are not valid,please try again!');
				     }   
				   }, "html");
	}		
}

function quick_reset(){
	$("#reply_content").val('');
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
      	<?php $type=$type?$type:"inbox";?>
        	<div class="mes_detail"><A href="<?php echo site_url("user/message/".$type."/".$page)?>" id="mes_detail_1">Back</A>
        	<A href="#" id="mes_detail_2" onclick="del_one_mes()">Delete</A>
        	 <?php if ($type==="sent_box" || $type==="trash"){?><?php }else{
        	 if($mes_detail['fromuser']!=''){?>
       	  		<A href="<?php echo site_url("user/message/mes_create/{$mes_detail['fromuser']}")?>" id="mes_detail_3">Reply</A>
       	  	 <?php }}?>
        	</div>
            <div class="inbox2_right2_right">
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="mes_detail2">
        	<div class="mes_detail2_left">
            	<div class="mes_detail2_left1">
                	<span class="mes_detail2_left1_left"><?php echo $mes_detail['title'];?></span>
                    <span class="mes_detail2_left1_right">Print</span>
                    <div class="clear"></div>
                </div>
                <div class="mes_detail2_left2">
                	<span><b>Date:</b><font><?php echo date('D d F Y H:i',$mes_detail['addtime']);?></font><div class="clear"></div></span>
                    <span><b>From:</b><font><?php echo $mes_detail['fromuser']?></font><div class="clear"></div></span>
                    <span><b>Send to:</b><font><?php echo $mes_detail['touser']?></font><div class="clear"></div></span>
                </div>
                
                <div class="mes_detail2_left3">
                	<?php if ($type!="sent_box" and $type!="trash"){?>
                		He or she is not your friend now. Would you like to add he (or she) 
                		<a href="#" onclick="send()" title="Add as friend ?">Add as friend ?</a>
                	<?php }?>
                </div>
                
                <div class="mes_detail2_left4"><?php 
                if ($type=="sent_box" && $mes_detail['typeid']==1){
					echo preg_replace("/(?<=href=)([^>]*)(?=>)/i","#", "{$mes_detail['content']}");
				}else{
					echo $mes_detail['content'];
				}?></div>
				<?php if($type=="inbox" && $mes_detail['typeid']!=1 && $mes_detail['feedback']==0){?>
				<div class="mes_detail2_left5">
				<form><p><textarea name="" cols="" rows="" id="reply_content"></textarea></p>
				<p><input name="" type="button" style="cursor: pointer;" value="quick reply" onclick="quick_reply()"/>
				<input name="" type="button" style="cursor: pointer;" value="cancel"  onclick="quick_reset()"/>
				</p></form></div>
				<?php }?>
                <div class="clear"></div>
            </div>
            <div class="mes_detail2_right">
            	<div class="mes_detail2_right1"><img src="<?php echo base_url("skin_user/images/mes_detail_06.jpg")?>" width="120" height="120" /></div>
              	<div class="mes_detail2_right2"><?php echo $his_detail['truename']?></div>
              	<div class="mes_detail2_right3"><?php echo $his_detail['company']?></div>
              	<div class="mes_detail2_right4">
              	<?php if($his_detail['areaid']){?>
              	<img src="<?php echo base_url("skin_user/images/registration_06.jpg")?>" width="21" height="16" /><?php }echo $his_detail['areaid']?></div>
              	<div style="border-bottom:1px solid #CCC;"></div>
                <!-- <div class="mes_detail2_right5">Group: ungroup</div>-->
                <div class="mes_detail2_right6">
                	<div class="mes_detail2_right6_1"><span>Message History</span><div class="clear"></div></div>
                   <?php if ($msg_history){foreach ($msg_history as $v){?>
						<div class="mes_detail2_right6_2"><a href="<?php echo site_url('user/message/mes_detail/'.$v['mid'].'/sent_box/0')?>"><?php echo mb_substr($v['title'],0,10,'utf-8'),'......';?></a></div>
					<?php }}elseif ($msg_history1){foreach ($msg_history1 as $v){?>
						<div class="mes_detail2_right6_2"><a href="<?php echo site_url('user/message/mes_detail/'.$v['mid'].'/inbox/0')?>"><?php echo mb_substr($v['title'],0,10,'utf-8'),'......';?></a></div>						
					<?php }}else {
								echo "<br/><center>No Message History!</center>";
					}?>
					<br/>
              </div>
                <div class="clear"></div>
          </div>
            <div class="clear"></div>
        </div>
      	<div class="inbox2_right2">
       	  <div class="mes_detail"><A href="<?php echo site_url("user/message/".$type."/".$page)?>" id="mes_detail_1">Back</A>
       	  <A href="#" rel="nofollow" id="mes_detail_2">Delete</A>
       	   <?php if ($type==="sent_box" || $type==="trash"){?><?php }else{
       	   	if($mes_detail['fromuser']!=''){?>
       	  		<A href="<?php echo site_url("user/message/mes_create/{$mes_detail['fromuser']}")?>" id="mes_detail_3">Reply</A>
       	  	 <?php }}?>
       	  </div>
        	<div class="clear"></div>
        </div>
        <div class="clear"></div>
      </div>
      <div class="clear"></div>
    </div>
</div>