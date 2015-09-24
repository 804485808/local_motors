<script type="text/javascript"  src="<?php echo base_url('/skin/js/jquery.js')?>"></script>
<script type="text/javascript"  src="<?php echo base_url('/skin/js/list.js')?>"></script>
<div class="top4">
<div class="top41"><a href="<?php echo company_url(site_url("company/index/"),$username);?>">Home</a><a href="<?php echo company_url(site_url("company/sell_list/"),$username);?>">Products</a><a href="<?php echo company_url(site_url("company/info/"),$username);?>" id="top4_1" rel="nofollow">Company Info</a><a href="<?php echo company_url(site_url("company/contact/"),$username);?>" rel="nofollow">Contact Details</a></div></div>
<div class="main">
  <div class="Details">
<div class="Details1">
       	  <div class="Details1_left">
				<div class="Details1_left2_1">Company Information</div>
                <div class="info">
                	<p><img src="<?php echo $site['image_domain'].$company_data['thumb'];?>" width="563" height="508" onerror="javascript:this.src='<?php echo base_url("skin/images/nopic.jpg");?>';"/></p>
					<?php echo $company_data['content'];?>                	
            </div>
</div>
        	<div class="Details1_right">
            	<div class="Details1_right1">
                	<p><a href="<?php echo company_url(site_url("company/index/"),$username);?>">Verified Supplier - <?php echo $company_data['company'];?> </a><span>[<?php echo $company_data['areaname'];?>]</span></p>
                    <p><b>Business type:</b><?php echo $company_data['business'];?> </p>
                    <p><b>Address:</b><?php echo $company_data['address'];?> </p>
                    <p id="Details1_right1_p"><b>Telephone:</b><?php echo $company_data['telephone'];?> </p>
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