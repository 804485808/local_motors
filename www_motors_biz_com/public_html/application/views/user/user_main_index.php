
<SCRIPT src="<?php echo base_url("skin_user/js/common.js")?>" type="text/javascript"></SCRIPT>
<script src="<?php echo base_url('skin_user/js/jquery.js')?>" type="text/javascript"></script>
<script type="text/javascript">

$(function(){
	var percent=<?php echo $finished_perc;?>;
	var width=Math.ceil($("#progress_id").width()*percent);
	$("#progress1_id").width(width);
	<?php if($user['company']=='' and $user['vmail']):?>
	$("#status_left1_p71").addClass("status_left1_p71");
	$("#editimg").attr("src","<?php echo base_url("/skin_user/images/hhk.png");?>");
	<?php else:?>
	$("#editimg").hide();
	<?php endif;?>
	
});

function send_confirm(){
  $("#re2_a1").attr({ "disabled": "disabled", "value": "waiting..." });
  $.post("<?php echo site_url("user/user_main/confirm_email")?>", function(json){   
    alert(json.msg);
    $("#re2_a1").removeAttr("disabled");
        $("#re2_a1").val("GET VERIFIED NOW");
  },"json");
}

function hidden_vmail(){
	var date = new Date();
	date.setTime(date.getTime() + 30*24*60*60*1000);
	$("#status_right1_bg1").hide();
	$("#status_right1_input").hide();
	$("#status_left1_p71").addClass("status_left1_p71");
	$("#editimg").attr("src","<?php echo base_url("/skin_user/images/hhk.png");?>");
	$("#editimg").show();
}


</script>
<div class="user_main">
	<div class="inbox_nav"><span><img src="<?php echo base_url("skin_user/images/inm_15.jpg")?>"  /></span>
	<a id="inbox_nav_a" href="<?php echo site_url('user/user_main/index')?>">My Biz</a>
	<a href="<?php echo site_url('user/buy/manage_buy')?>">Buy</a>
	<a href="<?php echo site_url('user/sell/manage_sell')?>">Sell</a>
	<a href="<?php echo site_url('user/message/inbox')?>" >Messages & Contacts</a>
	<a href="<?php echo site_url('user/news/manage_news')?>">News</a></div>
    <div class="inbox2" style="border:0px; width:980px;">
    	<div class="status_left">
        	<div class="status_left1">
           	  <p class="status_left1_p1"><?php echo $show,'&nbsp;',$call;?></p>
           	  <p class="status_left1_p2"><?php echo date('jS F Y',time());?></p>
           	  <p class="status_left1_p3"><?php echo date('H:i',time());?></p>
            	<p class="status_left1_p4">Grade:<i><img src="<?php echo base_url("skin_user/images/Star.gif")?>" width="14" height="14" /></i><i><img src="<?php echo base_url("skin_user/images/Star.gif")?>" width="14" height="14" /></i><i><img src="<?php echo base_url("skin_user/images/Star.gif")?>" width="14" height="14" /></i></p>
            	<p class="status_left1_p5">Balance:0$</p>
            	<p class="status_left1_p6"><span class="Progress" id="progress_id"><b class="Progress1" id="progress1_id"></b></span><?php echo ceil($finished_perc*100),'%';?></p>
				<div id="status_left1_p71">
				<i><img id="editimg" /></i>
           	  <p class="status_left1_p7"><a href="<?php echo site_url("user/my_biz/show_info")?>">Now go to edit >></a></p>
			  </div>
            	<p class="status_left1_p8"><img src="<?php echo base_url("skin_user/images/status_07.png")?>" width="149" height="2" /></p>
            	<?php if ($user['lastip']){?>
            	<p class="status_left1_p9">Last Signed In:</p>
            	<p class="status_left1_p10">IP:<?php echo $user['lastip']?></p>
            	<p class="status_left1_p11"><?php echo date('jS F Y',$user['lasttime']);?></p>
            	<?php }?>
            	<p class="status_left1_p12"><a href="<?php echo site_url('reg_login/login_out')?>">Quit</a></p>
            </div>
            <div class="status_left2">
            	<b>Shortcuts</b>
                <ul>
                	<li><a href="<?php echo site_url('user/message/inbox')?>">Check New Message</a></li>
                	<li><a href="<?php echo site_url('user/sell/post_sell')?>">Post New Products</a></li>
                	<li><a href="<?php echo site_url('user/sell/manage_sell')?>">Manage Products</a></li>
                	<li><a href="<?php echo site_url("user/message/contacts_list")?>">My Friends</a></li>
                	<li><a href="<?php echo site_url("user/my_biz/account")?>">Account</a></li>
                </ul>
            </div>
        </div>
    	<div class="status_right">
    	<?php if (!$user['vmail']):?>
			<div id="status_right1_bg1" class="status_right1_bg"></div>
        	<div class="status_right1"><i><img src="<?php echo base_url("skin_user/images/status_03.png")?>" width="16" height="16" /></i>
       	  <p>Your E-mail address have not verified. You need to be verified and then you can post products information. 
		  <input id="status_right1_input" type="button" value="I see !" onclick='hidden_vmail()' />
		  </p>
       	  <input type="button" onclick="send_confirm()" id="re2_a1" value="GET VERIFIED NOW" />
		  </div>
		  <?php endif;?>     	  
            <div class="status_right2<?php if($user['vmail']):?>_hid<?php endif;?>">
           	  <div class="status_right21">
              		<div class="status_right211">
            		<div class="status_right2_1"><b>Selling Request Status</b><a href="<?php echo site_url('user/sell/manage_sell')?>" title="view"><img src="<?php echo base_url("skin_user/images/application_view_columns.png")?>" width="16" height="16" /></a><A href="<?php echo site_url('user/sell/post_sell')?>" title="add"><img src="<?php echo base_url("skin_user/images/application_add.png")?>" width="16" height="16" /></A><div class="clear"></div></div>
	                    
                    <?php if($supply_list):?>     
                    <?php foreach ($supply_list as $k=>$v):?>   
                    <?php if ($k==0):?>
                     <div class="status_right211">
                    <?php elseif($k==1):?>
                    <?php else:?>
                    <div class="status_right211 status_right211_noline">
                    <?php endif;?>
                      <div class="status_right2_2">
                      	<A href="<?php echo company_url(site_url('content/index/'.$v['itemid'].'/'.$v['linkurl']),$v['username'])?>" target="_blank"><?php echo $v['title'];?></A>                     
                      	<p class="status_right2_2_p"><?php echo mb_substr(strip_tags($v['introduce']),0,65,"utf-8")?>...</p>
						<p class="status_right2_line"><span class="status_right2_2_left">replies(<b><?php echo $v['replies']?></b>)</span><span class="status_right2_2_left">browse(<b><?php echo $v['hits']?></b>)</span><span class="status_right2_2_right"><?php echo $v['addtime'];?></span></p>
                    </div>
                    <div class="clear"></div>
                	</div>
                	<?php endforeach;?>
					<?php else:?>
					<br/><center>	Do you want to show products of your own company?<br/><a href="<?php echo site_url('user/sell/post_sell')?>">Display your Products FREE now!</a></center>
					<?php endif;?>
                    <div class="clear"></div>
   	          	</div>
   	          </div>
              <div class="status_right21 status_right21_line">
              	<div class="status_right211">
            		<div class="status_right2_1"><b>Buying Request Status</b><a href="<?php echo site_url('user/buy/manage_buy')?>" title="view"><img src="<?php echo base_url("skin_user/images/application_view_columns.png")?>" width="16" height="16" /></a><A href="<?php echo site_url('user/buy/post_buy')?>" title="add"><img src="<?php echo base_url("skin_user/images/application_add.png")?>" width="16" height="16" /></A><div class="clear"></div></div>
	               <?php if($buy_list):?>     
                    <?php foreach ($buy_list as $k=>$v):?>   
                    <?php if ($k==0):?>
                     <div class="status_right211">
                    <?php elseif($k==1):?>
                    <?php else:?>
                    <div class="status_right211 status_right211_noline">
                    <?php endif;?>
                      <div class="status_right2_2">
                      	<A href="<?php echo main_url(site_url('content/index/'.$v['itemid'].'/'.$v['linkurl']))?>" target="_blank"><?php echo $v['title'];?></A>                     
                      	<p class="status_right2_2_p"><?php echo mb_substr(strip_tags($v['introduce']),0,65,"utf-8")?>...</p>
						<p class="status_right2_line"><span class="status_right2_2_left">replies(<b><?php echo $v['replies']?></b>)</span><span class="status_right2_2_left">browse(<b><?php echo $v['hits']?></b>)</span><span class="status_right2_2_right"><?php echo $v['addtime'];?></span></p>
                    </div>
                    <div class="clear"></div>
                	</div>
                	<?php endforeach;?>
					<?php else:?>
					<br/><center>	Tell The Suppliers What You Want.<br/><a href="<?php echo site_url('user/buy/post_buy');?>">Post Buying Request!</a></center>
					<?php endif;?>
                    <div class="clear"></div>
   	          </div>
              <div class="clear"></div>
            </div>
            <div class="status_right3">
            	<div class="status_right31">
                	<div class="status_right31_tit">My Biz Overview</div>
                    <div class="status_right31_con">
					  <div class="status_right31_con1">
                      <h6>Message</h6>
                      <A href="<?php echo site_url("user/message/inbox/tid-2")?>" class="status_right31_con_img"><img src="<?php echo base_url("skin_user/images/uJ_3.jpg")?>" width="68" height="51" /><?php if($unread_nonfri){?><b class="red_dot"><?php echo $unread_nonfri?></b><?php }?></A>
                        	<A href="<?php echo site_url("user/message/inbox/tid-2")?>">Unread messages</A>
                            <span>Total <b><?php echo $total_msg_nonfri?></b> messages</span>
                            <A href="<?php echo site_url("user/message/mes_create")?>">Send new</A>
                        </div>
                        <div class="status_right31_con_line"><img src="<?php echo base_url("skin_user/images/b2b_J_20.jpg")?>" width="7" height="108" /></div>
					  <div class="status_right31_con1">
                      <h6>Product</h6>
                      <A href="<?php echo site_url('user/sell/manage_sell/unapproved')?>" class="status_right31_con_img"><img src="<?php echo base_url("skin_user/images/uJ_2.jpg")?>" width="68" height="51" /><?php if($unapproved){?><b class="red_dot"><?php echo $unapproved?></b><?php }?></A>
                        	<A href="<?php echo site_url('user/sell/manage_sell/unapproved')?>">Products need to edit</A>
                            <span>Total <b><?php echo $total_sell?></b> products</span>
                            <A href="<?php echo site_url('user/sell/post_sell')?>">Post new</A>
                        </div>
                      <div class="status_right31_con_line"><img src="<?php echo base_url("skin_user/images/b2b_J_20.jpg")?>" width="7" height="108" /></div>
					  <div class="status_right31_con1">
                      <h6>Contacts</h6>
                      		<A href="<?php echo site_url("user/message/inbox/tid-0")?>" class="status_right31_con_img"><img src="<?php echo base_url("skin_user/images/uJ_4.jpg")?>" width="68" height="51" /><?php if($unread_fri){?><b class="red_dot"><?php echo $unread_fri?></b><?php }?></A>
                        	<A href="<?php echo site_url("user/message/inbox/tid-0")?>">Unread Contacts</A>
                            <span>Total <b><?php echo $total_msg_fri?></b> Contacts</span>
                            <A href="<?php echo site_url("user/message/contacts_list")?>">Show Contacts</A>
                        </div>
                    <div class="clear"></div>
                    </div>
                </div>
                <div class="status_right32">
                	<b>Customer Services</b>
                    <ul>
                    <li class="status_right32_i"><i><img src="<?php echo base_url("skin_user/images/sta_icon_15.png")?>" width="16" height="19" /></i><span><?php echo $site['tel']?></span></li>
                    <li><i id="status_right32_i1"><img src="<?php echo base_url("skin_user/images/sta_icon_18.png")?>" width="16" height="11" /></i><a href="mailto:<?php echo $site['email']?>"><?php echo $site['email']?></a></li>
                    <li><i><img src="<?php echo base_url("skin_user/images/sta_icon_23.png")?>" width="16" height="18" /></i><span class="status_right32_blue"><?php echo $site['qq']?></span></li>
					</ul>
                </div>
                <div class="clear"></div>
            </div>
        </div>
      <div class="clear"></div>
    </div>
</div>