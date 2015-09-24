<script type="text/javascript"  src="<?php echo base_url('/skin/js/jquery.js')?>"></script>
<script type="text/javascript"  src="<?php echo base_url('/skin/js/list.js')?>"></script>
<div class="top4">
<div class="top41"><a href="<?php echo company_url(site_url("company/index/"),$username);?>">Home</a><a href="<?php echo company_url(site_url("company/sell_list/"),$username);?>">Products</a><a href="<?php echo company_url(site_url("company/info/"),$username);?>" rel="nofollow">Company Info</a><a href="<?php echo company_url(site_url("company/contact/"),$username);?>" id="top4_1" rel="nofollow">Contact Details</a></div></div>
<div class="main">
  <div class="Details">
  <div class="Details1">
       	  <div class="Details1_left">
				<div class="Details1_left2_1">Contact Details</div>

		<div class="contactDetails_w">
			<h5>Linkman:</h5><h6><?php echo $contact['truename'];?></h6>
			<h5>Department:</h5><h6><?php echo $contact['department'];?></h6>
			<h5>Job Title:</h5><h6><?php echo $contact['career'];?></h6>
		</div>
		<div class="clear" style="height:10px"></div>

		<div style="font-size:14px; color:#000000; padding-bottom:10px;"><strong>Email to This Supplier</strong></div>
	<div class="Sendmsg_text_box">
		<div class="SM_Text_title">Email :</div><input class="INput" style="width:270px;" /><div class="clear"></div>
		<div class="SM_Text_title">Country  :</div><input class="INput" /><div class="clear"></div>
		<div class="SM_Text_title">Name  :</div><input class="INput"  /><div class="clear"></div>
		<div class="SM_Text_title">Content  :</div><textarea name="" cols="" rows="" class="INput"  style="height:110px; width:410px;"></textarea><div class="clear"></div>
		<div class="clear"></div>
		</div>

		<div style="padding-left:125px; clear:both; padding-bottom:15px;"><a href="#" rel="nofollow"><img src="<?php echo base_url('/skin/images/botCon.jpg')?>" /></a></div>

</div>
        	<div class="Details1_right">
            	<div class="Details1_right1">
                	<p><a href="<?php echo company_url(site_url("company/index/"),$username);?>">Verified Supplier - <?php echo $company_data['company'];?></a><span>[<?php echo $company_data['areaname'];?>]</span></p>
                    <p><b>Business type:</b><?php echo $company_data['business'];?></p>
                    <p><b>Address:</b><?php echo $company_data['address'];?></p>
                    <p id="Details1_right1_p"><b>Telephone:</b><?php echo $company_data['telephone'];?></p>
                </div>
                <div class="Details1_right2">
                	<div class="main_left3">
        	<div class="main_left3_1">Category</div>
        	<div class="main_left3_3">
            	<ul>
                	<?php
						if(is_array($com_type)){
							foreach($com_type as $c){
								echo "<li><a href='",company_url(site_url("company/sell_list/tid_{$c['tid']}"),$username),"'>",$c['tname'],"</a></li>";
							}
						}
					?>
                </ul>
            </div>
        </div>
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
<div class="ad1"><a href="#" rel="nofollow"><img src="<?php echo base_url('/skin/images/main_01_48.png')?>" width="918" height="88" /></a></div>
	<div class="clear"></div>
</div>