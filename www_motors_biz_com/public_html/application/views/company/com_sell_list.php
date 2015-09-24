<script type="text/javascript"  src="<?php echo base_url('/skin/js/jquery.js')?>"></script>
<script type="text/javascript"  src="<?php echo base_url('/skin/js/list.js')?>"></script>
<div class="top4">
<div class="top41"><a href="<?php echo company_url(site_url("company/index/"),$username);?>">Home</a><a href="<?php echo company_url(site_url("company/sell_list/"),$username);?>" id="top4_1">Products</a><a href="<?php echo company_url(site_url("company/info/"),$username);?>" rel="nofollow">Company Info</a><a href="<?php echo company_url(site_url("company/contact/"),$username);?>" rel="nofollow">Contact Details</a></div></div>
<div class="main">
	<div class="crumb"><a href="<?php echo company_url(site_url("company/index/"),$username);?>">Home</a>><b><?php if(isset($mytype)){echo ucwords($mytype['tname']);}else{echo "Product Categories";}?></b>
	<?php if($sell_count){?><span>found <?php echo number_format($sell_count);?> Products for sale</span><?php }?>
	</div>
    <div class="list">
    	<div class="list2_left">
        	<div class="list2_left1">
            	<b>Categories</b>
                <ul>
					<?php 
						foreach($com_type as $j){
							echo "<li><a href='",company_url(site_url("company/sell_list/tid_{$j['tid']}"),$username),"'>",$j['tname'],"</a><span>(",$j['count'],")</span></li>";
						}
					?>
                </ul>
            </div>
        </div>
    	<div class="list2_right">
    	  <div class="list2_right3">
           	  <div id="ListGallery" class="listL">
		<?php foreach($sell_list as $h){?>
        <ul>
			<li class="pic"><a href="<?php echo company_url(site_url('sell_detail/index/'.$h['itemid'].'/'.$h['linkurl']),$h['username']);?>"><img src="<?php echo $site['image_domain'].$h['thumb'];?>" alt="<?php echo $h['title'];?>" onerror="javascript:this.src='<?php echo base_url("skin/images/nopic.jpg");?>';"/></a></li>
			<li class="nrBox">
				<p class="h2"><a href="<?php echo company_url(site_url('sell_detail/index/'.$h['itemid'].'/'.$h['linkurl']),$h['username']);?>"><?php echo $h['title'];?></a></p>
				<p class="listNone"><span class="bold">Keyword:</span><?php echo $h['keyword'];?></p>
				<p class="listNone"><span class="bold">Reviews:</span> <?php echo $h['hits'];?></p>
				<p class="listNone"><span class="bold">Min. Order:</span><?php echo $h['minamount'],"  ",plural($h['unit']);?></p>
			</li>
			<li class="priceBox">
				<p>  <?php echo $h['minprice']>0 ? $h['currency']." <span>".$h['minprice'] : " <span>Negotiable";?></span></p>
				<div class="listGConte"><a href="#" rel="nofollow"><img src="<?php echo base_url('/skin/images/list_06.jpg')?>" alt="contact Supplier" /></a></div>
			</li><div class="clear"></div>
		</ul>
		<?php }?>				
		<div class="clear"></div>
	</div>
          </div>
        	<div class="list2_right4">
            	<div class="grayr">
				<?php echo $pages;?>
				<span>Go to Page</span><form><p><input name="" type="text" class="grayr_text" /></p><input name="" type="button" class="grayr_button" /></form></div>
            </div>
      </div>
        <div class="clear"></div>
    </div>
    <div class="searched">
    	<div class="searched1">Product Showcase</div>
        <div class="searched2">			
			<?php 
				foreach($hot_sell as $l){
					echo "<div class='searched2_1'><a href='",company_url(site_url('sell_detail/index/'.$l['itemid'].'/'.$l['linkurl']),$l['username']),"'><img src='",$site['image_domain'].$l['thumb'],"' width='180' height='180' alt='",$l['title'],"' onerror=\"javascript:this.src='",base_url("skin/images/nopic.jpg"),"';\"/></a><A href='",company_url(site_url('sell_detail/index/'.$l['itemid'].'/'.$l['linkurl']),$l['username']),"' id='searched2_1_a'>",$l['title'],"</A><p>";
					echo $l['minprice']>0 ? $l['currency']." <b>".$l['minprice']."</b>/".$l['unit']: " <b>Negotiable</b>";
					echo "</p><p>MOQ:",$l['minamount'],"</p><p>Recently Hits:",$l['hits'],"</p></div>";
				}
			?>
        </div>
        <div class=" clear"></div>
    </div>
    <div class="ad1"><a href="#" rel="nofollow"><img src="<?php echo base_url('/skin/images/main_01_48.png')?>" width="918" height="88" /></a></div>
	<div class="clear"></div>
</div>