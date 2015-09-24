<SCRIPT src="<?php echo base_url("skin_user/js/common.js")?>" type="text/javascript"></SCRIPT>
<script src="<?php echo base_url('skin_user/js/jquery-1.4.js')?>" type="text/javascript"></script>
<SCRIPT src="<?php echo base_url("skin_user/js/jquery.popup.js")?>" type="text/javascript"></SCRIPT>
<script type="text/javascript">
function del_one_fri(){
	if(confirm("Are you sure to delete this friend？")){
        window.location = "<?php echo site_url("user/message/friend_del/".$friend_name."/".$page)?>";
    }
}

function showit(username,fid){	
	if(username){
		$.ajax({
			type:"post",
			url:"<?php echo site_url('user/message/show_one_friend')?>",			
			data:{id:new Date(),friend_name:username,fid:fid,page:"<?php echo $page?>"},
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
function diag(){
	$.popup('Group Name : <input type="text" id="inputGroup" name="inputGroup" value="">', {modal:true, button:{ok:true,cancel:true},ok_callback:function(){
		if($("#inputGroup").val()!==undefined){
			$.ajax({
				  type:"post",   
				  url:"<?php echo site_url('user/message/create_ftype');?>",    
				  data:{type_name:$("#inputGroup").val()},
				  success:function(data){ 
					  if(data>0){
						  alert('Save successfully!');
						  location.reload(true);
					  	}else if(data==-1) {				  			
					  		alert("The group is existed,please try again!");
						}else if(data==0) {				  			
					  		alert("Save failed!");
						}
					   }
				 });
		}
	}});
}

function diag_1(tname,tid){
	$.popup('Group Name : <input type="text" id="inputGroup" name="inputGroup" value="'+tname+'">', {modal:true, button:{ok:true,cancel:true},ok_callback:function(){
		if($("#inputGroup").val()!==undefined){
			$.post("<?php echo site_url('user/message/edit_ftype');?>", { tid: tid, tname: $("#inputGroup").val() },
		 			   function(data){
		    				if(data==0) {				  			
				  				alert("Modify failed,please try again!");
							}else if(data==-1) {				  			
				  				alert("The group name has been existed,please try again!");
							}else if(data>0){
					 			 alert('Modify successfully!');
						  			location.reload(true);
					  		}
		 	}, "html");
		}
	}});	
}


function modify(value){
	//alert(value);
	$('#truename_input').attr('disabled',false);
	$('#truename_input').focus();
}

function cancel(){	
	$('#truename_input').val("<?php echo $friend['truename']?$friend['truename']:$friend['username'];?>");
	$('#truename_input').attr('disabled',true);
	$("#classification").val('<?php echo $friend['typeid']?>');
}

function save(){
	if($('#truename_input').val()==''){
		alert('The new remark-name is required!');
	}else if(!$("#truename_input").attr("disabled") ||$("#classification").val()!="<?php echo $friend['typeid']?>"){
		$('#truename_input').attr('disabled',true);		
		$.post("<?php echo site_url("user/message/modify")?>", { act:'modify',fri_class:$('#classification').val(),truename: $('#truename_input').val(), fid: "<?php echo $friend['fid'];?>", username: "<?php echo $friend['username'];?>" },
				   function(data){
			   			alert(data);
			   			location.reload(true);
				   }, "html");
	}else if($("#truename_input").attr("disabled") ||$("#classification").val()==<?php echo $friend['typeid']?>){
		alert('Please make some change first!');
	}
}


function delete_class(value){
	if(confirm("Are you sure to delete this classification？")){
		var pattern=/^\d+$/;
		if(pattern.test(value)){
			$.post("<?php echo site_url("user/message/modify")?>", { act:'delete_class',fri_class:value},
					   function(data){
				   			alert(data);
				   			location.reload(true);
					   }, "html");
		}else{
			alert('The classification your deleted is wrong,please try again!');
		}
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
        	<div class="inbox2_right2_left"><A href="<?php echo site_url("user/message/contacts_list/".$page)?>" id="mes_detail_1">Back</A>
        	<A href="#" rel="nofollow" id="inbox2_right2_left1" onclick="del_one_fri()">Delete</A>
        	<A href="<?php echo site_url("user/message/mes_create/{$friend['username']}")?>" id="inbox2_right2_left3">Send Message</A></div>
            <div class="inbox2_right2_right">
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
      	<div class="inbox2_right4">
   	 	  <div class="lianxiren_view_left">
            	<div class="lianxiren_view_left1" id="friend_content">
                	<p><img src="<?php echo base_url("skin_user/images/mes_detail_06.jpg")?>" width="120" height="120" /></p>
           	  	  <p class="lianxiren_view_left1_1"><b><?php echo $friend['truename']?$friend['truename']:$friend['username'];?></b>
           	  	  <span><img src="<?php echo base_url("skin_user/images/registration_06.jpg")?>" width="21" height="16" /></span>
           	  	  <span><?php echo $friend['areaid']?$friend['areaid']:'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';?></span></p>
           	  	  <ul>
           	  	  	<li><span>Email:</span><span><?php echo $friend['mail']?$friend['mail']:'N/A';?></span></li>
                    <li><span>Tel:</span><span><?php echo $friend['telephone']?$friend['telephone']:'N/A';?></span></li>
                    <li><span>Fax:</span><span><?php echo $friend['fax']?$friend['fax']:'N/A';?></span></li>
                  </ul>
                    
<div class="clear"></div>
            </div>
<div class="lianxiren_view_left2">
<table width="443" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="25" align="right" valign="middle"><strong>My Business Location:</strong></td>
    <td height="25" align="right" valign="middle">&nbsp;</td>
    <td height="25" valign="middle"><img src="<?php echo base_url("skin_user/images/registration_06.jpg")?>" width="21" height="16" /><?php echo $my_detail['areaid']?></td>
  </tr>
  <tr>
    <td height="25" align="right" valign="middle">E-mail Address:</td>
    <td height="25" align="right" valign="middle">&nbsp;</td>
    <td height="25" valign="middle"><?php echo $my_detail['mail']?></td>
  </tr>
  <tr>
    <td height="25" align="right" valign="middle">Company:</td>
    <td height="25" align="right" valign="middle">&nbsp;</td>
    <td height="25" valign="middle"><?php echo $my_detail['company']?></td>
  </tr>
  <tr>
    <td height="25" align="right" valign="middle">Phone:</td>
    <td align="right" valign="middle">&nbsp;</td>
    <td height="25" valign="middle"><?php echo $my_detail['telephone']?></td>
  </tr>
</table>
</div>
                <div class="lianxiren_view_left4"></div>
          </div>
            <div class="lianxiren_view_center">
           	  <div class="mes_detail2_right lianxiren_view_center1">
              	<div class="mes_detail2_right2 lianxiren_view_center2">
					<p style="float:left; display:block;"><?php echo $gender?"Ms.":"Mr."?></p>									
					 <input id="truename_input" value="<?php echo $friend['truename']?strtr($friend['truename'],array('Mr. '=>'','Ms. '=>'')):$friend['username'];?>" disabled style=" float: right; width:115px; font-size:12px; border:1px solid #CCCCCC; height:16px; padding-left:3px;"/>				
				</div>
				<div style="height:5px; clear:both"></div>           	  
              	<div class="mes_detail2_right3 lianxiren_view_center3"><span>Classification</span><select name="classification" id="classification">
              	<?php if ($my_list){foreach ($my_list as $k=>$v){?>
              	  <option value="<?php echo $v['tid']?>" <?php if ($friend['typeid']==$v['tid']) echo 'selected';?>><?php echo $v['tname'];?></option>
              	 <?php }}?>
              	</select></div>
              	<div  class="edit_contact"><a title="Cancle" href="#" onClick="cancel()">Cancle</a><a title="Save" href="#" onClick="save()">Save</a><a  title="Edit" href="#" onClick="modify($('#truename_input').val())">Edit</a><div class="clear"></div></div>
				<div class="clear"></div>
              	<div class="mes_detail2_right4"><a href="<?php echo site_url("user/message/mes_create/".$friend['username'])?>"><img src="<?php echo base_url("skin_user/images/lianxiren_news1_11.jpg")?>" width="88" height="12" /></a></div>
                <div style="border-bottom:1px solid #CCC;"></div>
                <div class="mes_detail2_right6">
                	<div class="mes_detail2_right6_1"><span>Message History</span><div class="clear"></div></div>
					<?php if ($msg_history){foreach ($msg_history as $v){
							if ($my_name==$v['touser']){$type='inbox';}else{$type='sent_box';}
						?>
                	 <div class="mes_detail2_right6_2">
						<strong><a href="<?php echo site_url('user/message/mes_detail/'.$v['mid'].'/'.$type.'/0')?>"><?php echo mb_substr(preg_replace("/(?<=href=)([^>]*)(?=>)/i","#", "{$v['title']}......"), 0,20,"utf-8");?></a></strong>
						<b><?php echo mb_substr(preg_replace("/(?<=href=)([^>]*)(?=>)/i","#", "{$v['content']}"), 0,120,"utf-8");?></b>
					</div>
					<?php }}else {
								echo "<br/><br/><center>No Message History!</center>";
					}?>
              </div>
                <div class="clear"></div>
          </div>
            </div>          
            <div class="lianxiren_view_right" id="lianxiren_view_right">
            	<?php if ($my_list){foreach ($my_list as $k=>$v){?>
            	<div class="lianxiren_view_right1" id="lianxiren_view_right<?php echo $k+1?>">
			
			
			<div class="move_act">
					<div class="move_act_ab"><img src="<?php echo base_url('skin_user/images/b2b5_03.jpg')?>" />
						<div class="move_act_edit">
						<a title="Edit this group's name" href="#" onclick="diag_1('<?php echo $v['tname']?>','<?php echo $v['tid']?>')"><img src="<?php echo base_url('skin_user/images/edit_01.jpg')?>" /></a>
						<a href="#" title="Delete this group!" onClick="delete_class('<?php echo $v['tid']?>')"><img src="<?php echo base_url('skin_user/images/inm_28.jpg')?>" /></a></div>
				  </div>
				</div>
            	
            		<span style="display:none" id="hot_last">
                    <b href="#" rel="nofollow" class="hot_last_less"><img src="<?php echo base_url("skin_user/images/New_Message_box_07.jpg")?>" width="18" height="15" /><?php echo $v['tname']?>(<?php echo $my_list_count[$v['tid']]?>)</b>
    				<?php if ($friends_list[$v['tid']]){foreach ($friends_list[$v['tid']] as $key=>$val){?>
    					<a href="#" rel="nofollow" onclick="showit('<?php echo $val['username'];?>','<?php echo $val['fid']?>')"><img src="<?php echo base_url("skin_user/images/New_Message_box_11.jpg")?>" width="5" height="9" /><?php echo $val['truename']?$val['truename']:$val['username'];?></a>
    				<?php }}?>        				
    				</span> 
       				<b href="#" rel="nofollow" class="hot_last_more">
       				<img src="<?php echo base_url("skin_user/images/New_Message_box_07.jpg")?>" width="18" height="15" />
       				<?php echo $v['tname']?>(<?php echo $my_list_count[$v['tid']]?>)</b>
                </div>
                <script>initMenuEvent('lianxiren_view_right<?php echo $k+1?>')</script>
              <?php }}?>
              <div class="lianxiren_view_right1" id="lianxiren_view_right0">
            		<span style="display:none" id="hot_last">           		
                    <b href="#" class="hot_last_less"><img src="<?php echo base_url("skin_user/images/New_Message_box_07.jpg")?>" width="18" height="15" />Others(<?php echo $others_count?$others_count:"0";?>)</b>
    					<?php if ($other_friends){foreach ($other_friends as $value){?>
    					<a href="#" rel="nofollow" onclick="showit('<?php echo $value['username'];?>','<?php echo $value['fid']?>')"><img src="<?php echo base_url("skin_user/images/New_Message_box_11.jpg")?>" width="5" height="9" /><?php echo $value['truename']?$value['truename']:$value['username'];?></a>
    				<?php }}?>           				
    				</span> 
       				<b href="#" rel="nofollow" class="hot_last_more"><img src="<?php echo base_url("skin_user/images/New_Message_box_07.jpg")?>" width="18" height="15" />Others(<?php echo $others_count?$others_count:"0";?>)</b>
                </div>
                <script>initMenuEvent('lianxiren_view_right0')</script>
            </div>
            
            <div class="clear"></div>
        </div>
      	<div class="inbox2_right2">
       	<div class="inbox2_right2_left"><A href="<?php echo site_url("user/message/contacts_list/".$page)?>" id="mes_detail_1">Back</A>
       	<A href="#" rel="nofollow" id="inbox2_right2_left1" onclick="del_one_fri()">Delete</A>
       	<A href="<?php echo site_url("user/message/mes_create/{$friend['username']}")?>" id="inbox2_right2_left3">Send Message</A></div>
              	<div class="frpr">
			<div class="add_gourp"><a onclick="diag()" href="#">Add Group</a></div>
		</div>
        	<div class="clear"></div>
        </div>
        <div class="clear"></div>
      </div>
      <div class="clear"></div>
    </div>
</div>          	