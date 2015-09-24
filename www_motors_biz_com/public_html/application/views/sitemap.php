<div class="top3"><div class="Browse"><b>Browse by Location :</b>
<?php 
	foreach($country as $ct){
		$c=strtolower($ct);
		echo "<a href='#' rel='nofollow'><i><img src='",base_url("/skin/images/country/{$c}.png"),"' width='20' height='13' /></i></a><a href='#' rel='nofollow'>",$ct,"</a>";
	}
?>
<div class="clear"></div></div></div>
<div class="main">
	<div class="crumb"><a href="<?php echo main_url(site_url());?>" rel="nofollow">Home</a>><a href="<?php echo main_url(site_url("sitemap/index"));?>">Site Map</a><?php if($stitle){?>><b><h1><?php echo $stitle;?></h1></b><?php }?></div>
    <div class="list_class">
    	<div class="site_map">
    	  <div class="list_main">
          	<div class="site_map1"><b>Products (<?php echo $byname=="0" ? "0-9" : $byname;?>)</b><h2><strong>Motor-biz</strong> is the <strong>World's Top B2B Marketplace for manufacturers and suppliers</strong> to meet <strong>global buyers</strong> to trade on a local and international basis.<br />

<strong>Manufacturers and Suppliers</strong> of all products are listed here in Motor-biz <strong>Products catalogs Directory.</strong><br />
Browse all manufacturers and suppliers of various electric motors such as <strong>AC motors</strong>,<strong>DC motors</strong>,<strong>brushless motors</strong>,<strong>air motors</strong>,<strong>stepper motors</strong>,<strong>and many more</strong>!</h2></div>
			<div class="site_map2"><span>Browse Alphabetically :</span>
			<?php 
				$letter_count=count($letter)-1;
				foreach($letter as $m=>$j){
					if($j=="0-9"){$j=0;}
					if(substr($j,0,1)==$byname){
						echo "<a href='",site_url("sitemap/index/".$j),"' id='site_map2_a'>",$j,"</a>";
					}else{
						echo "<a href='",site_url("sitemap/index/".$j),"'>",$j,"</a>";
					}
					if($m < $letter_count)	echo "|";
				}
			?>
			</div>
    	    <div class="list_main2">
					<?php 
						foreach($tagindex as $c){
							echo "<div class=\"list_main2_1 site_map_1\">
                    	<ul class=\"site_map3\">";
							if($c){
								foreach($c as $h){
									echo "<li><a href=\"",site_url("slist/index/{$h['id']}/{$h['linkurl']}"),"\">",$h['tag'],"</a></li>";
								}
							}
							echo "</ul>
                    </div>";
						}
					?>
               	<div class="clear"></div>
              </div>
            </div>
        </div>
        <div class="viciao"><?php echo $pages;?>   	<div class="clear"></div>
</div>
        <div class="viciao1"><?php if($pages){echo $otherpages;}?>    	<div class="clear"></div>
</div>
    	<div class="clear"></div>
    </div>
	<div class="clear"></div>
</div>