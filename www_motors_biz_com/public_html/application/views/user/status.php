<script src="<?php echo base_url("skin_user/js/common.js")?>" type=text/javascript></script>
<script type="text/javascript">
                  
		window.onload = function sayHello(){
                	var date = new Date();
                    var curr;
                    this.msg = "";
                    curr = date.getHours();
                     if(curr <12){
                        this.msg = "Good morning!";
                     }else if(curr > 17){
                        this.msg = "Good evening!";
                     } else{
                        this.msg = "Good afternoon!";
                     }
                     document.getElementById("hello_name").value = this.msg;
                  }
                  
       </script>


<div class="user_main">
	<div class="inbox_nav"><span><img src="<?php echo base_url("skin_user/images/inm_15.jpg")?>"  /></span>
		<a href="<?php echo site_url('user/my_biz/status')?>" id="inbox_nav_a">My Biz</a>
		<a href="<?php echo site_url('user/buy/manage_buy')?>">Buy</a>
		<a href="<?php echo site_url('user/sell/manage_sell')?>">Sell</a>
		<a href="<?php echo site_url('user/message/inbox')?>">Messages & Contacts</a>
		<a href="<?php echo site_url('user/news/manage_news')?>">News</a></div>
    <div class="inbox2">
    	<div class="inbox2_left">
        	<div class="inbox2_left1 inbox2_left1_1"><span><img src="<?php echo base_url("skin_user/images/uJ_statusa.png")?>" width="24" height="24" /></span><a href="<?php echo site_url('user/my_biz/status')?>">Status</a></div>
        	<div class="inbox2_left1"><span><img src="<?php echo base_url("skin_user/images/uJ_info.png")?>" width="24" height="24" /></span><a href="<?php echo site_url('user/my_biz/show_info')?>">Information</a></div>
        	<div class="inbox2_left1"><span id="inbox2_left11"><img src="<?php echo base_url("skin_user/images/uJ_account.png")?>" width="24" height="24" /></span><a href="<?php echo site_url('user/my_biz/account')?>">Account</a></div>
        	<div class="inbox2_left1"><span id="inbox2_left12"><img src="<?php echo base_url("skin_user/images/uJ_wallet.png")?>" width="24" height="24" /></span><a href="#">Wallet</a></div>
   	  </div>
    	<div class="inbox2_right">
			<div><div class="hello_name" ><input id="hello_name"  style="background-color:transparent;border:0px;color:#0066FF;width:110px " readonly/> <?php echo $firstname?></div>
			<div class="balance_money">You have 50 dolls.</div>
			<div class="clear"></div></div>
			<div class="status_box">
				<ul>
				<li class="st_s1">
				<div>
				<span class="F_L">Buying Request Status</span>
				<span class="F_R"><a href="#">Post</a></span>
				<div class="clear"></div>
				</div>
				</li>				
				<li class="st_s2"><img src="<?php echo base_url("skin_user/images/uJ_1.jpg")?>"  /><span> Cart <a href="buy_m.html">(12)</a></span></li>				
				<li class="st_s3_list1"><a href="#"><strong> Stainless Steel Casserole ...</strong></a></li>				
				<li class="st_s3_list1"><a href="#">3PCS Stainless Steel Casserole</a></li>				
							
				</ul>
				<ul>
				<li class="st_s1">
				<div>
				<span class="F_L">Selling status</span>
				<span class="F_R"><a href="#">Post</a></span>
				<div class="clear"></div>
				</div>
				</li>				
				<li class="st_s2"><img src="<?php echo base_url("skin_user/images/uJ_2.jpg")?>"  /><span> Shop <a href="#">(<?php echo $sellnum;?>)</a></span></li>
				<?php if ($selllist){
							foreach ($selllist as $v){?>
							<li class="st_s3_list1"><a href="<?php echo site_url("show_item/{$v['itemid']}/{$v['linkurl']}")?>" target="_blank"><?php echo $v['title'];?></a></li>					
				<?php }}?>	
				</ul>
				<ul>
				<li class="st_s1">
				<div>
				<span class="F_L">Buying Request Status</span>
				<span class="F_R"><a href="#">Post</a></span>
				<div class="clear"></div>
				</div>
				</li>				
				<li class="st_s2"><img src="<?php echo base_url("skin_user/images/uJ_3.jpg")?>"  /><span> Inbox <a href="#">(<?php echo $mesnum;?>)</a></span></li>	
				<?php if ($meslist){ 
					foreach ($meslist as $v){?>	
				<li class="st_s3_list2">
                <span ><img src="<?php if ($v['isread']==1){echo base_url("skin_user/images/mm_45.jpg");}else{echo base_url("skin_user/images/mes_detail_15.jpg");}?>" /></span>
                <span ><a href="<?php echo site_url("user/message/mes_detail/{$v['touser']}/{$v['mid']}")?>"><strong><?php echo mb_substr($v['title'],0,22);?>... </strong></a></span><div class="clear"></div>
				<p>(<?php echo $v['fromuser']?>)</p>
				</li>			
					<?php }}?>
				</ul>
				<ul >
				<li class="st_s1">
				<div>
				<span class="F_L">Buying Request Status</span>
				<span class="F_R"><a href="#">Post</a></span>
				<div class="clear"></div>
				</div>
				</li>				
				<li class="st_s2"><img src="<?php echo base_url("skin_user/images/uJ_4.jpg")?>"  /><span> Friends <a href="#">(<?php echo $frinum;?>)</a></span></li>				
				<li class="st_s3_list1">
					<div class="lianxiren_view_right" id="lianxiren_view_right" style="width:170px; border:0px;">
            	<?php if ($my_list){foreach ($my_list as $k=>$v){?>
            	<div class="lianxiren_view_right1" id="lianxiren_view_right<?php echo $k+1?>">
            		<span style="display:none" id="hot_last">
                    <b href="#" rel="nofollow" class="hot_last_less"><img src="<?php echo base_url("skin_user/images/New_Message_box_07.jpg")?>" width="18" height="15" /><?php echo $v['tname']?>(<?php echo $my_list_count[$v['tid']]?>)</b>
    				<?php if ($friends_list[$v['tid']]){foreach ($friends_list[$v['tid']] as $key=>$val){?>
    					<a href="#" rel="nofollow" onclick="showit('<?php echo $val['username']?>')"><img src="<?php echo base_url("skin_user/images/New_Message_box_11.jpg")?>" width="5" height="9" /><?php echo $val['truename']?$val['truename']:$val['username'];?></a>
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
    					<a href="#" rel="nofollow" onclick="showit('<?php echo $value['username']?>')"><img src="<?php echo base_url("skin_user/images/New_Message_box_11.jpg")?>" width="5" height="9" /><?php echo $value['truename']?$value['truename']:$value['username'];?></a>
    				<?php }}?>           				
    				</span> 
       				<b href="#" rel="nofollow" class="hot_last_more"><img src="<?php echo base_url("skin_user/images/New_Message_box_07.jpg")?>" width="18" height="15" />Others(<?php echo $others_count?$others_count:"0";?>)</b>
                </div>
                <script>initMenuEvent('lianxiren_view_right0')</script>
            </div>
					
					
				</li>		<div class="clear"></div>		
				</ul><div class="clear"></div>
		  </div>
		
        <div class="clear"></div>
		
		
      </div>
      <div class="clear"></div>
    </div>
</div>
