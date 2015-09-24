<!--Header end-->
<!--product details start-->

<div class="product_detailsmian">
<div class="motors-ProductDetailspage">
  <div class="product_Hierarchy product_Hierarchy_margin"> <span> <a href="<?php echo company_url(site_url("company/index/"),$product['username']);?>"><?php echo $product['company']," (",$product['com_areaname'],")";?></a> » <a href="<?php echo main_url(site_url());?>" rel="nofollow">Home</a> »
    <?php foreach($pcat as $v){?>
    <a href="<?php echo main_url(site_url("sell_list/index/catid_".$v['catid']."/".$v['linkurl']));?>"> <?php echo $v['catname'];?>> </a>
    <?php }?>
    <?php echo $cat['catname']?> </span> </div>
  <div class="product_Preview">
    <div class="Preview_product_img" id="PreviewBox">
      <div class="bd">
        <ul>
          <li><img src="<?php echo $site['image_domain'].$product['thumb'];?>" class="image-fluid"/></li>
          <li><img src="<?php echo $site['image_domain'].$product['thumb'];?>" class="image-fluid"/></li>
          <li><img src="<?php echo $site['image_domain'].$product['thumb'];?>" class="image-fluid"/></li>
        </ul>
      </div>
      <div class="hd">
        <ul>
          <li><img src="<?php echo $site['image_domain'].$product['thumb'];?>" class="image-fluid" alt="" title=""/></li>
          <li><img src="<?php echo $site['image_domain'].$product['thumb'];?>" class="image-fluid" alt="" title=""/></li>
          <li><img src="<?php echo $site['image_domain'].$product['thumb'];?>" class="image-fluid" alt="" title=""/></li>
        </ul>
      </div>
    </div>
    <div class="product_Brief_introduction">
      <h1><?php echo $product['title'];?></h1>
      <div class="product_span">
          <span><i>Price: </i> <strong><?php echo $product['minprice']>0 ? $product['currency']." ".$product['minprice'] : "Negotiable";?></strong></span>
          <span><i>Min. order: </i> <b><?php echo $product['minamount'],"/",plural($product['unit']);?></b></span>
          <span><i>Trade Terms: </i><b>FOB, CFR, CIF, EXW</b></span>
          <span><i>Certification: </i><b>CCC,CE,ROHS,UL</b></span>
          <span><i>Construction: </i><b>Permanent Magnet</b></span>
          <span><i>Commutation: </i><b>Brushless</b></span>
          <span><i>Payment Terms: </i><b>L/C,T/T</b></span>
          <span><i>Port: </i><b>Port of Guangzhou</b></span>
      </div>
      <div class="product_share">
          <span>Share:</span>
          <span class='st_facebook_large' displayText='Facebook'></span>
          <span class='st_twitter_large' displayText='Tweet'></span>
          <span class='st_pinterest_large' displayText='Pinterest'></span>
          <span class='st_googleplus_large' displayText='Google +'></span>
          <div class="product_EMail"> <a href="#" class="product_button"><i class="fa fa-envelope glyphicon-size"></i>Contact Now</a></div>
      </div>
    </div>
    <div class="product_Supplier">
      <h2><a href="#"><a href="<?php echo company_url(site_url("company/index/"),$product['username']);?>"><?php echo $product['company']," (",$product['com_areaname'],")";?></a></a></h2>
      <div class="product_Supplier_span">
          <span><i>Business Type: </i><b> <?php echo $com_data['mode'];?></b></span>
          <span><i>Main Products: </i><b><?php echo $types?></b></span>
          <span><i>Hot Markets: </i><b>North America 50%, Eastern Europe 40%, South America</b></span>
          <span><i>Website: </i><b><a href="<?php echo company_url(site_url("company/index/"),$product['username']);?>"><?php echo company_url(site_url("company/index/"),$product['username']);?></a></b> </span>
          <span><i>Telephone: </i><b></b></span>
      </div>
      <div class="clear"></div>
    </div>
    <div class="product_presentation">
      <div class="product_Hierarchy"><span>Product Details</span></div>
      <div class="product_Data">
        <h3>Basic Info.</h3>
        <ul>
          <?php foreach($option_values as $v){?>
          <li><i><?php echo $v['name']?>:</i><b><?php echo $v['value']?></b></li>
          <?php }?>
        </ul>
        <div class="clear"></div>
      </div>
      <!--<div class="product_Data">
                <h3>Additional Info.</h3>
                <ul>
                    <li><i>Trademark:</i><b>ML</b></li>
                    <li><i>Origin: </i><b>China</b></li>
                    <li><i>Packing: </i><b> Carton / Pallet</b></li>
                    <li><i>HS Code: </i><b> 85014000</b></li>
                    <li><i>Standard:  </i><b>ROHS\CE\CCC</b></li>
                    <li><i>Production Capacity: </i><b>100000sets/month</b></li>
                </ul>
                <div class="clear"></div>
            </div>-->
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
            <?php foreach($sort_op_value as $k => $v):?>
            <div class="Pro_bodydata"><?php echo substr($k,1)?></div>
            <?php endforeach;?>
          </div>
          <?php foreach($like_sell as $s):?>
          <div class="product_contrast_tupian">
            <div class="product_contrast_textimg"> <a href="<?php echo company_url(site_url('sell_detail/index/'.$s['itemid'].'/'.$s['linkurl']),$s['username'])?>"> <img src="<?php echo $site['image_domain'].$s['thumb']?>" alt="<?php echo $s['title']?>" class="image-fluid" alt="" title=""/> </a> <b title="<?php echo $s['title']?>"> <a href="<?php echo company_url(site_url('sell_detail/index/'.$s['itemid'].'/'.$s['linkurl']),$s['username'])?>"><?php echo substr($s['title'],0,30)?></a> </b> </div>
            <?php foreach($sort_op_value as $attr):?>
            <div class="Pro_data" title="<?php echo isset($attr[$s['itemid']]) ? $attr[$s['itemid']] : " ";?>"><?php echo isset($attr[$s['itemid']]) ? substr($attr[$s['itemid']],0,35) : " ";?></div>
            <?php endforeach;?>
          </div>
          <?php endforeach;?>
        </div>
      </div>
      <div class="product_Send">
        <div class="product_Hierarchy"><span>Send your message to this supplier</span></div>
        <div class="Send_message">
          <form>
            <div class="product_emall_form">
              <label><i>*</i>Form</label>
              <input type="text" name="" placeholder="Enter your email address" class="form" >
            </div>
            <div class="product_emall_form">
              <label><i>*</i>Subject</label>
              <input type="text" name="" placeholder="Inquiry about Universal Motor / Flour Mill Motor / Blender Motor / Food Processor Motor" class="Subject" >
            </div>
            <div class="product_emall_form">
              <label><i>*</i>Purchase Quantity</label>
              <input type="text" name="" placeholder="1" class="Purchase" >
              <select name="" class="Quantity">
                <option>Box</option>
                <option>Pieces</option>
              </select>
            </div>
            <div class="product_emall_form">
              <label><i>*</i>Content</label>
              <textarea class="Pdetails_Content"></textarea>
            </div>
            <div  class="product_Notes">Your inquiry content must be between 20 to 4000 characters.</div>
            <div  class="product_Notes">
              <button>Send Inquiry</button>
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
        <div class="product_tuijian">
          <?php foreach($like_sell2 as $v){?>
          <div class="product_Likeimg"> <a href="<?php echo company_url(site_url('sell_detail/index/'.$v['itemid'].'/'.$v['linkurl']),$v['username'])?>"> <img src="<?php echo $site['image_domain'].$v['thumb']?>" class="image-fluid" alt="" title=""> </a> <span title="<?php echo $v['title']?>"><a href="<?php echo company_url(site_url('sell_detail/index/'.$v['itemid'].'/'.$v['linkurl']),$v['username'])?>"> <?php echo substr($v['title'],0,30)?></a></span> </div>
          <?php }?>
          <div class="clear"></div>
        </div>
      </div>
      <div class="sup_Related_Searches pro_jianju">
        <div class="sup_Searches">
          <h2>Related Searches:</h2>
          <ul>
            <li>gear motor</li>
            <li>dc gear motor</li>
            <li> worm gear motor</li>
            <li>fixed gear bike</li>
            <li>12v dc worm gear motor</li>
            <li> worm gear motor</li>
            <li>fixed gear bike</li>
          </ul>
        </div>
        <div class="sup_Searches">
          <h2>Other popular suppliers:</h2>
          <ul>
            <li>gas grill Manufacturers</li>
            <li>gas grill Manufacturers</li>
            <li>gas grill Manufacturers</li>
            <li>gas grill Manufacturers</li>
            <li>gas grill Manufacturers</li>
            <li>gas grill Manufacturers</li>
            <li>gas grill Manufacturers</li>
          </ul>
        </div>
        <div class="sup_Searches">
          <h2>Products related to the price:</h2>
          <ul>
            <li>gas grill Manufacturers</li>
            <li>gas grill Manufacturers</li>
            <li>gas grill Manufacturers</li>
            <li>gas grill Manufacturers</li>
            <li>gas grill Manufacturers</li>
            <li>gas grill Manufacturers</li>
            <li>gas grill Manufacturers</li>
          </ul>
        </div>
        <div class="sup_Searches">
          <h2>hot search:</h2>
          <ul>
            <li>carbon brush motor </li>
            <li>carbon brush motor </li>
            <li>carbon brush motor </li>
            <li>fixed gear bike</li>
            <li>12v dc worm gear motor</li>
            <li>carbon brush motor </li>
            <li>fixed gear bike</li>
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
        <div class="product_Suppliers_Recommended"> <a href="<?php echo company_url(site_url('sell_detail/index/'.$v['itemid'].'/'.$v['linkurl']),$v['username'])?>">
          <div class="SuppliersImg"><img src="<?php echo $site['image_domain'].$v['thumb']?>" class="image-fluid" alt=""></div>
          </a> <span title="<?php echo $v['title']?>"><a href=""><?php echo substr($v['title'],0,60)?></a></span> <b><?php echo $product['minprice']>0 ? $product['currency']." ".$product['minprice'] : "Negotiable";?></b> </div>
        <?php }?>
        <div class="clear"></div>
      </div>
    </div>
    <div class="clear"></div>
  </div>
</div>
<!--product details end--> 
