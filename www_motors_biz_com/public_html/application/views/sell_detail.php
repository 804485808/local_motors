<!--Header end-->
<!--product details start-->

<div class="product_detailsmian">
  <div class="motors-ProductDetailspage">

    <div class="product_Hierarchy product_Hierarchy_margin"><span>
            <a href="<?php echo main_url(site_url());?>" rel="nofollow">Home</a> »


      <?php foreach($pcat as $v){?>
		<?php if($v['parentid']==0):?>
		<a href="<?php echo main_url(site_url("catalog/index/".$v['catid']."/".$v['linkurl']));?>"> <?php echo $v['catname'];?> » </a>
		<?php else:?>
		<a href="<?php echo main_url(site_url("sell_list/index/catid_".$v['catid']."/".$v['linkurl']));?>"> <?php echo $v['catname'];?> » </a>
		<?php endif;?>
      <?php }?>
	  <?php if($cat['parentid']==0):?>
      <a href="<?php echo main_url(site_url("catalog/index/".$cat['catid']."/".$cat['linkurl']));?>"><?php echo $cat['catname']?></a>
	  <?php else:?>
	  <a href="<?php echo main_url(site_url("sell_list/index/catid_".$cat['catid']."/".$cat['linkurl']));?>"><?php echo $cat['catname']?></a>
	  <?php endif;?>
	  </span> </div>
    <div class="product_Preview">
      <div class="Preview_product_img" id="PreviewBox">
        <div class="bd">
          <ul>
            <li><img alt="<?php echo $product['subtitle']?>" src="<?php echo $site['image_domain'].$product['thumb'];?>" class="image-fluid"/></li>
          </ul>
        </div>
        <div class="hd">
         
        </div>
      </div>
      <div class="product_Brief_introduction">
        <h1 title="<?php echo $product['subtitle']?>"><?php echo $product['title'];?></h1>
        <div class="product_span">
            <span>
                <i>Price: </i> <strong><?php echo $product['minprice']>0 ? $product['currency']." ".$product['minprice'] : "Negotiable";?></strong></span>
            <span>
                <i>Min. order: </i> <b><?php echo $product['minamount'],"/",plural($product['unit']);?></b>
            </span>
            <?php foreach(array_slice($product['attr'],0,6) as $k=>$v){?>
            <span>
                <i><?php echo $k?>: </i><b><?php echo $v?></b>
            </span>
            <?php }?>
            </span>
            <span><i>Port: </i><b><?php echo $product['port']?></b></span>
        </div>
        <div class="product_share">
            <span>Share:</span> <span class='st_facebook_large' displayText='Facebook'></span>
            <span class='st_twitter_large' displayText='Tweet'></span>
            <span class='st_pinterest_large' displayText='Pinterest'></span>
            <span class='st_googleplus_large' displayText='Google +'></span>
          <div class="product_EMail"> <a href="#" class="product_button"><i class="fa fa-envelope glyphicon-size"></i>Contact Now</a></div>
        </div>
      </div>
      <div class="product_Supplier">
        <h2><a href="#"><a href="<?php echo company_url(site_url("company/index/"),$product['username']);?>"><?php echo $product['company']," (",$product['com_areaname'],")";?></a></a></h2>
        <div class="product_Supplier_span"> <span><i>Business Type: </i><b> <?php echo $com_data['mode'];?></b></span>
            <span><i>Main Products: </i><b><?php echo $types?></b></span>
            <span><i>Markets: </i><b><?php echo $product['markets']?></b></span>
            <span><i>Website: </i><b><a href="<?php echo company_url(site_url("company/index/"),$product['username']);?>">
                        <?php echo company_url(site_url("company/index/"),$product['username']);?></a></b> </span>
            <span><i>Telephone: </i><b><?php echo $product['telephone']?></b></span> </div>
      </div>
      <div class="clear"></div>
    </div>
    <div class="product_presentation">
      <div class="product_Hierarchy"><span><?php echo $product['subtitle']?> &nbsp;&nbsp;Product Details  </span></div>
      <div class="product_Data">
        <h3>Basic Info.</h3>
        <ul>
          <?php foreach($product['attr'] as $k=> $v){?>
          <li><i><?php echo $k?>:</i><b><?php echo $v?></b></li>
          <?php }?>
        </ul>
        <div class="clear"></div>
      </div>

      <div class="product_Description">
        <h3>Product Description.</h3>
        <ul>
          <li> <?php echo $product['content'];?></li>
        </ul>
        <div class="clear"></div>
      </div>
      <!--<div class="product_Gearbox">
        <h3>Gearbox Data.</h3>
        <div class="Dataimg"><img src="images/Productimg/product_03.jpg" class="image-fluid" alt="" title=""></div>
        <div  class="Dataimg"><img src="images/Productimg/product_06.jpg" class="image-fluid" alt="" title=""></div>
    </div>-->
      <div class="product_Comparison">
        <div class="product_Hierarchy"><span>People who shopped for this item also looked  at</span></div>
        <div class="product_table">
          <div class="product_contrast_table">
            <div class="product_contrast_text">product</div>
            <?php foreach(array_slice($option,0,8) as $k => $v):?>
            <div class="Pro_bodydata"><?php echo $k?></div>
            <?php endforeach;?>
          </div>
          <?php foreach(array_slice($likeSell,0,8) as $s){?>
          <div class="product_contrast_tupian">
            <div class="product_contrast_textimg"> <a href="<?php echo site_url('sell_detail/index/'.$s['itemid'].'/'.$s['linkurl'])?>">
                    <img src="<?php echo $site['image_domain'].$s['thumb']?>" alt="<?php echo $s['title']?>" class="image-fluid"  title="<?php echo $s['subtitle']?>"/> </a>
                <b title="<?php echo $s['title']?>"> <a href="<?php echo site_url('sell_detail/index/'.$s['itemid'].'/'.$s['linkurl'])?>"> <?php echo substr($s['title'],0,30)?></a> </b> </div>
            <?php foreach(array_slice($s['attr'],0,8) as $kk=>$vv){?>
            <div class="Pro_data" title="<?php echo $vv?>">
                <?php echo substr($vv,0,12)?>
            </div>
            <?php }?>
          </div>
          <?php }?>
        </div>
      </div>
      <div class="product_Send">
        <div class="product_Hierarchy"><span>Send your message to this supplier</span></div>
        <div class="Send_message">
          <form id="Inquiry">
            <div class="product_emall_form">
              <label><i>*</i>Form</label>
              <input type="text" name="" placeholder="Enter your email address" class="form" >
            </div>
            <div class="product_emall_form">
              <label><i>*</i>Subject</label>
              <input type="text" id="subject" value="<?php echo $product['title']?>" name="" placeholder="Inquiry about Universal Motor / Flour Mill Motor / Blender Motor / Food Processor Motor" class="Subject" >
                <input type="hidden" name="sid" value="<?php echo $product['sid']?>">
            </div>

            <div class="product_emall_form">
              <label><i>*</i>Content</label>
              <textarea name="content" class="Pdetails_Content"></textarea>
            </div>
            <div  class="product_Notes">Your inquiry content must be between 20 to 4000 characters.</div>
            <div  class="product_Notes">
              <button id="send">Send Inquiry</button>
            </div>
            <div  class="product_Notes"><i>*</i>
              <label>Please contact the merchant service information</label>
            </div>
            <div  class="product_Notes"><i>*</i>
              <label>Please make sure your contact information is correct.</label>
            </div>
            <div  class="product_Prompt">Your message will be sent directly to the recipient(s) and will not be publicly displayed. </div>
            <div  class="product_Prompt">We will never distribute or sell your personal information to third parties without your express permission.</div>
            <div class="clear"></div>
          </form>
        </div>
      </div>
      <div class="You_May_Like">
        <div class="product_Hierarchy"><span>You May Like</span><a class="View">View More</a></div>
      </div>
      <div class="sup_Related_Searches pro_jianju">
        <div class="sup_Searches">
          <h2>Related Searches:</h2>
          <ul>
		  <?php foreach($related_search as $rs):?>
            <li><a href="<?php echo site_url("slist/index/".$rs['id']."/".$rs['linkurl'])?>"><?php echo $rs['tag']?></a></li>
		  <?php endforeach;?>
           
          </ul>
        </div>
      </div>
    </div>
    <div class="Product_rmn_details">
      <div class="product_Hierarchy"><span>Category</span></div>
      <div class="Suppliers_Product_Category">
        <ul>
          <?php
            if(is_array($com_type)){
                foreach($com_type as $c){
                    echo "<li><i></i><a href='",company_url(site_url("company/sell_list/tid_{$c['tid']}"),$product['username']),"'>",$c['tname'],"</a></li>";
                }
            }
            ?>
        </ul>
        <div class="clear"></div>
      </div>
      <div class="product_Hierarchy"><span>Suppliers Recommended</span></div>
      <div class="product_Sup_Recommended">
        <?php foreach($com_products as $v){?>
        <div class="product_Suppliers_Recommended"> <a href="<?php echo site_url('sell_detail/index/'.$v['itemid'].'/'.$v['linkurl'])?>">
          <div class="SuppliersImg"><img src="<?php echo $site['image_domain'].$v['thumb']?>" class="image-fluid" alt=""></div>
          <span title="<?php echo $v['title']?>"><?php echo substr($v['title'],0,60)?></span> <b><?php echo $product['minprice']>0 ? $product['currency']." ".$product['minprice'] : "Negotiable";?></b></a> </div>
        <?php }?>
        <div class="clear"></div>
      </div>
    </div>
    <div class="clear"></div>
  </div>
</div>

<!--product details end--> 
<script type="application/javascript">
    $("#send").onclick(function(){
        alert('s')
    })
</script>