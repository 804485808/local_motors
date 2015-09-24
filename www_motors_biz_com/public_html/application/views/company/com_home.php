<script type="text/javascript"  src="<?php echo base_url('/skin/js/jquery.js')?>"></script>
<script type="text/javascript"  src="<?php echo base_url('/skin/js/list.js')?>"></script>
<div class="top4">
<div class="top41"><a href="<?php echo company_url(site_url("company/index/"),$username);?>" id="top4_1">Home</a><a href="<?php echo company_url(site_url("company/sell_list/"),$username);?>">Products</a><a href="<?php echo company_url(site_url("company/info/"),$username);?>" rel="nofollow">Company Info</a><a href="<?php echo company_url(site_url("company/contact/"),$username);?>" rel="nofollow">Contact Details</a></div></div>
<div class="main">
  <div class="compant_tit"><?php echo $company_data['company']," (",$company_data['areaname'],") ";?></div>
  <div class="Details">
    <div class="company_home">
   	<div class="company_home1_left">
        	  <div class="company_home1_left2">
           	    <div class="company_home1_left2_1">Product Details</div>
                <div class="company_home1_left2_2">
               	  <p><span><img src="<?php echo base_url('/skin/images/nopic.jpg')?>" data-src="<?php echo base_url('/skin/images/main_31.jpg')?>" class="image-fluid" width="150" height="120" /></span><?php echo $company_data['introduce'];?> ... <A href="<?php echo site_url("company/info/".$username);?>" rel="nofollow">More</A></p>
                    </div>
              </div>
      <div class="company_home2">
        	<div class="company_home2_1">Mian Products</div>
            <div class="company_home2_2">							
				<?php
					foreach($main_sell as $c){
						foreach($c as $t=>$b){
							echo "<div class='company_home2_21";
							if(!$t){
								echo " company_home2_211";
							}
							echo "'><a href='",company_url(site_url('sell_detail/index/'.$b['itemid'].'/'.$b['linkurl']),$b['username']),"'><img src='",$site['image_domain'].$b['thumb'],"' width='180' height='180' onerror=\"javascript:this.src='",base_url("skin/images/nopic.jpg"),"';\"/></a><p><a href='",company_url(site_url('sell_detail/index/'.$b['itemid'].'/'.$b['linkurl']),$b['username']),"'>",$b['title'],"</a></p><p>Min.Order: ",$b['minamount']," ",plural($b['unit']),"</p></div>";
						}
					}
				?>				
                <div class="clear"></div>
            </div>
        </div>
          </div>
        	<div class="Details1_right">
        	  <div class="Details1_right2">
               	  <div class="main_left3" style="margin-top:0px;">
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
	<?php if(isset($rand_type)){?>
	<div class="searched">
    <div class="searched1">Buyers who searched <span><?php echo $rand_type;?></span> bought:</div>
        <div class="searched2">
			<?php
				foreach($rand_sell as $n){
					echo "<div class='searched2_1'><a href='",company_url(site_url('sell_detail/index/'.$n['itemid'].'/'.$n['linkurl']),$n['username']),"'><img src='",$site['image_domain'].$n['thumb'],"' width='180' height='180' onerror=\"javascript:this.src='",base_url("skin/images/nopic.jpg"),"';\"/></a><A href='",company_url(site_url('sell_detail/index/'.$n['itemid'].'/'.$n['linkurl']),$n['username']),"' id='searched2_1_a'>",$n['title'],"</A><p>";
					echo $n['minprice']>0 ? $n['currency']." ".$n['minprice'] : "Negotiable";
					echo "</b>/",$n['unit'],"</p><p>MOQ:",$n['minamount'],"</p><p>Recently Hits:",$n['hits'],"</p></div>";
				}
			?>
        </div>
        <div class=" clear"></div>
    </div>
	<?php }?>
    <div class="ad1"><a href="#" rel="nofollow"><img src="<?php echo base_url('/skin/images/nopic.jpg')?>" data-src="<?php echo base_url('/skin/images/main_01_48.png')?>" class="image-fluid"width="918" height="88" /></a></div>
	<div class="clear"></div>
</div>