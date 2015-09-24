<script src="<?php echo base_url('skin_user/js/common.js')?>" type=text/javascript></script>
<script src="<?php echo base_url('skin_user/js/jquery-1.4.js')?>" type=text/javascript></script>

<script type="text/javascript">
$(function(){
	$("#New_Message2_1_input").change(function(){
		$("#name_span").html("");
	});
	$("#New_Message2_1_input1").change(function(){
		$("#title_span").html("");
	});
	$("#content").change(function(){
		$("#content_span").html("");
	});
});
	function send(){
		$("#name_span").html("");
		$("#title_span").html("");
		$("#content_span").html("");
		 var aj_touser = $("#New_Message2_1_input").val();
		 var aj_title=$("input#New_Message2_1_input1").val(); 
		 var aj_content=$("#content").val(); 
		
		 if(aj_touser.length<6){
			$("#name_span").html("<font class='worry_msg'>The Name length cannot be less than 5!</font>");
			document.frm.touser.focus();
			return false;
		}else if(aj_title.length<6){
			$("#title_span").html("<font class='worry_msg'>The Subject length cannot be less than 5!</font>");
			document.frm.title.focus();
			return false;
		}else if(aj_content==""){
			$("#content_span").html("<font class='worry_msg'>The Content field is required!</font>");
			document.frm.content.focus();
			return false;
		}else if(aj_touser != ''){
			 $.ajax({
				  type:"POST",   
				  url:"<?php echo site_url('user/message/check_name');?>",    
				  data:{touser:aj_touser,id:new Date()},
				  success:function(data){ //成功返回的数据
						 data=Number(data);
					 	 if(data==0){
						  		$("#name_span").html("<font class='worry_msg'>Please enter the correct name!</font>");
						  		document.frm.touser.focus();
						  		return false;
					  	}else{
					  			document.getElementById('frm').submit();
					  			return false;
						 }
					  }
				 });
			}

	}

	function save(){
		$("#name_span").html("");
		$("#title_span").html("");
		$("#content_span").html("");
 	var touser=$("input#New_Message2_1_input").val(); 
 	var title=$("input#New_Message2_1_input1").val(); 
 	var content=$("#content").val(); 
 	if(title==""){
 		$("#title_span").html("<font class='worry_msg'>The Subject field is required!</font>");
		document.frm.title.focus();
		return false;
	 }else if(title.length<6){
	 	$("#title_span").html("<font class='worry_msg'>The Subject length cannot be less than 5!</font>");
		document.frm.title.focus();
		return false;
	 }else if(content==""){
		$("#content_span").html("<font class='worry_msg'>The Content field is required!</font>");
		document.frm.content.focus();
		return false;
	 }else if(content.length<6){
		$("#content_span").html("<font class='worry_msg'>The Content length cannot be less than 5!</font>");
		document.frm.content.focus();
		return false;
	 }else{
		var datastring = 'touser='+ touser +'&title=' + title + '&content=' + content;
		$.ajax({
			type:"POST",   
			url:"<?php echo site_url('user/message/mes_save');?>",    
			data:datastring+"&id="+new Date(),
			success:function(data){       //成功返回的数据
			data=Number(data);
			//alert(data);
			if(data>0){
				alert('Save successfully!');
			}else{alert('Save failed!');}
		  }
		});
	 }
}

</script>
<script type="text/javascript" >

      function getselected()
      {
			var str=document.getElementsByName("username");
			var strcount=str.length;
			var chestr="";
			for (i=0;i<strcount;i++)
			{
			  if(str[i].checked == true)
			  {
			   chestr+=str[i].value+";";
			  }
			}
			if(chestr == "")
			{
			  //alert("Select the recipient! ");
				$("textarea#selected").html("");
				document.frm.selected.focus();
			}
			else
			{
				$("textarea#selected").html(chestr);
			}
			
      }
      function getok(ok){
          if(ok == true){
	    	 var friends = $("textarea#selected").val();
	    	 friends=friends+$("#New_Message2_1_input").val();
	    	 arr_friends = friends.split(";");
	    	 var str=[];
	    	 for(i=0;i<=arr_friends.length;i++){
	    		! RegExp(arr_friends[i],"g").test(str.join(";")) && (str.push(arr_friends[i])); 
	    			
	    	}
		    if(str.length>5){
			    alert("No more than five contacts!");
				return false;
			 }
		     var str = str.join(";")+';';
	    	 //console.log(str);
	      	 $("#New_Message2_1_input").val(str);
	      	 $("#hot_last").attr("style","display:none");
	      	 $("#hot_last_more").attr("style","display:block");
          }else{
        	 $("#hot_last").attr("style","display:none");
  	      	 $("#hot_last_more").attr("style","display:block");
          }
       	
      }

      function getkeywords(){
    	  var keywords = $("#keywords").val();
    	  var datastr = 'keywords='+ keywords;
    	  //alert(keywords);
	    	  $.ajax({
	    		  type:"POST",   
	    		  url:"<?php echo site_url('user/message/select_1');?>",
	    		  data:datastr+"&id="+new Date(),
	    		  cache:false,
	    		  dataType:'html',
	    		  success: function(data){
	  			    	$("#friend_ul").html(data);
	  				}
	  			});		  		 	  			   	  
    	  
      }
    </script>

<div class="user_main">
	<div class="inbox_nav"><span><img src="<?php echo base_url('skin_user/images/inm_15.jpg');?>"  /></span>
	<a href="<?php echo site_url('user/user_main/index')?>">My Biz</a>
	<a href="<?php echo site_url('user/buy/manage_buy')?>">Buy</a>
	<a href="<?php echo site_url('user/sell/manage_sell')?>">Sell</a>
	<a href="<?php echo site_url('user/message/inbox')?>" id="inbox_nav_a">Messages & Contacts</a>
	<a href="<?php echo site_url('user/news/manage_news')?>">News</a></div>
    <div class="inbox2">
    	<div class="inbox2_left">
        	<div class="inbox2_left1"><span><img src="<?php echo base_url('skin_user/images/icon2.gif');?>"width="22" height="20" /></span>
        	<a href="<?php echo site_url("user/message/inbox")?>">Inbox<?php if ($unread){echo "(",$unread,")";}?></a></div>
        	<div class="inbox2_left1"><span><img src="<?php echo base_url('skin_user/images/icon_03.gif');?>"width="22" height="20" /></span>
        	<a href="<?php echo site_url("user/message/sent_box")?>">Sent Box</a></div>
        	<div class="inbox2_left1 inbox2_left1_1"><span id="inbox2_left11"><img src="<?php echo base_url('skin_user/images/icon_10.gif');?>"width="17" height="16" /></span>
        	<a href="<?php echo site_url("user/message/mes_create")?>">New Message</a></div>
        	<div class="inbox2_left1"><span id="inbox2_left12"><img src="<?php echo base_url('skin_user/images/icon_14.gif');?>"width="15" height="16" /></span>
        	<a href="<?php echo site_url("user/message/trash")?>">Trash<?php if ($trash_count){echo "(",$trash_count,")";}?></a></div>
        	<div class="inbox2_left1"><span><img src="<?php echo base_url('skin_user/images/icon_18.gif');?>"width="26" height="26" /></span>
        	<a href="<?php echo site_url("user/message/contacts_list")?>">Contacts</a></div>
        	<div class="inbox2_left1"><span><img src="<?php echo base_url('skin_user/images/icon_22.gif');?>"width="25" height="26" /></span>
        	<a href="<?php echo site_url("user/message/drafts")?>">My Folders<?php if ($drafts_count){echo "(",$drafts_count,")";}?></a></div>
      </div>
      <div class="inbox2_right">
      	<div class="inbox2_right1"></div>
      	<div class="inbox2_right2">
        	<div class="New_Message">
		        <a href="#" id="New_Message_1" onclick="send()">Send</a>
       	  		<a href="javascript:document.frm.reset();" id="New_Message_2">Cancel</a>
       	  		<a href="#" id="New_Message_3" onclick="save()">Save As Template</a>
		    </div>
            
            <div class="clear"></div>
        </div>
        <?php if ($type=="drafts"){?>
        <form name="frm" action="<?php echo site_url("user/message/send_draft/{$mid}")?>" method="post" id="frm">
        <?php }else{?>
        <form name="frm" action="<?php echo site_url('user/message/mes_create')?>" method="post" id="frm">
        <?php }?>
        <?php echo validation_errors();?>
        <div class="New_Message2">
        	<div class="New_Message2_1">
            	<font>Send to:</font>
                <font id="New_Message2_hid">
                	<input name="touser" type="text" id="New_Message2_1_input" value="<?php echo $reply_name?$reply_name:"";?>" maxlength="155"/><font id="name_span" color="red"></font>
                        <span style=" display:none" class="New_Message2_1_3" id="hot_last">
							<div class="New_Message_box">
                            	<div class="New_Message_box1">Select Recipient(s)</div>
                                <div class="New_Message_box2">
                                	<div class="inbox2_right2_right">
            	
                	<input name="keywords" id="keywords" type="text" class="inbox2_right2_right1" onkeyup="getkeywords()"/>
                	<input name="" type="button"  class="inbox2_right2_right2" />
                
                <div class="clear"></div>
            </div>
                                </div>
                                <div class="New_Message_box3" id="New_Message_box3">
                                    <ul id="friend_ul">
                                	<?php 
                                	if ($touser){
                                	foreach ($touser as $k=>$v):?>
                                    	<li>
                                    	<input type="checkbox" onclick="getselected()"  id="username<?php echo $k;?>" name="username" value="<?php echo $v['username'];?>" />
                                    	<?php echo $v['username'];?><div class="clear"></div></li>
                                    <?php endforeach;?>
                                    <?php }else{echo "No contacts found!";}?>
                                    </ul>
                                </div>
                               
                                <div class="New_Message_box31"><img src="<?php echo base_url('skin_user/images/New_Message_box_bg_20.jpg');?>" width="287" height="6" /></div>
                              <div class="New_Message_box4">Recipient(s)Selected<br />
                              <textarea name="selected" cols="" rows="" class="New_Message_box41" style="font-size:12px" id="selected" readonly></textarea></div>
                              <div class="New_Message_box5"><input name="" type="button" class="New_Message_box51" id="ok" onclick="getok(true)"/>
                              <input name="" type="button" class="New_Message_box52" value="Cancel" onclick="getok(false)"/></div>
                            </div>
       						<b class="New_Message2_1_2" id="hot_last_less"><img src="<?php echo base_url('skin_user/images/New_Message_10.jpg');?>" width="24" height="17" /></b>
   						</span> 
                	<b class="New_Message2_1_1" id="hot_last_more"><img src="<?php echo base_url('skin_user/images/New_Message_10.jpg');?>" width="24" height="17" /></b>
                    
                </font>
                  <div style="font-size:12px; color:#999999; padding-left:85px;">(Please use ";" to separate from each name and five names at most.)</div>
                <div class="clear"></div>
            </div>
            <script>initMenuEvent('New_Message2_hid')</script>
            
            <div class="New_Message2_2">
          
            <font>Subject:</font>
            <font><input name="title" type="text" id="New_Message2_1_input1" value="<?php echo $resubject?$resubject:"";?>" maxlength="500"/></font><font id="title_span" color="red"></font><div class="clear"></div></div>
            <div class="New_Message2_3"><textarea cols=90 rows=9 name="content" style="overflow:auto;font-size:12px" id="content"  maxlength="3000"><?php echo $recontent?$recontent:"";?></textarea><br /><font id="content_span" color="red"></font></div>
            
            <div class="clear"></div>
        </div>
      	<div class="inbox2_right2">
       	  <div class="New_Message">
       	  	<a href="#" id="New_Message_1" onclick="send()">Send</a>
       	  	<a href="javascript:document.frm.reset();" id="New_Message_2">Cancel</a>
       	  	<a href="#" id="New_Message_3" onclick="save()">Save As Template</a></div>
        	<div class="clear"></div>
        </div>
        </form>
        <div class="clear"></div>
      </div>
      <div class="clear"></div>
    </div>
</div>
<?php 
if (@$msg){
	echo "<script type='text/javascript'>";
	echo "alert('".$msg."');";
	if ($msg == "Send successfully!"){
		echo "window.location = '".site_url('user/message/sent_box')."';";
	}
	echo "</script>";
}
?>