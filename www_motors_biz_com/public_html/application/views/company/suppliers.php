<!--suppliers start-->

<div class="product_detailsmian">
  <div class="motors-suppliersLast Suooliers_margin">
    <div class="Suooliers_left">
      <div class="Suooliers_Category">
        <div class="Suooliers_title"><span>Category</span></div>
        <div class="Suooliers_boby">
          <ul>
            <?php foreach($category_type as $v){ ?>
            <li><a href="<?php echo site_url("company/suppliers/Category_{$v['catid']}_{$tid}");?>" title="<?php echo $v['catname'];?>" rel="nofollow"><?php echo $v['catname'];?> <i>(<?php echo $v['num']; ?>)</i></a></li>
            <?php } ?>
          </ul>
        </div>
        <div class="Suooliers_more"> <span>More</span><i class="fa fa-caret-down"></i> </div>
        <div class="clear"></div>
      </div>
      <div class="Suooliers_Category">
        <div class="Suooliers_title"><span>Hot Markets</span></div>
        <div class="Suooliers_boby">
          <ul>
            <?php foreach($markets_type as $k => $v){ ?>
            <li><a href="<?php echo site_url("company/suppliers/Markets_{$k}_{$tid}");?>" title="<?php echo $k;?>" rel="nofollow"> <?php echo $k;?> <i>(<?php echo $v;?>)</i></a></li>
            <?php } ?>
          </ul>
        </div>
        <div class="Suooliers_more"> <span>More</span><i class="fa fa-caret-down"></i> </div>
        <div class="clear"></div>
      </div>
      <div class="Suooliers_Category">
        <div class="Suooliers_title"><span>Business Type</span></div>
        <div class="Suooliers_boby">
          <ul>
            <?php foreach($business_type as $v){ ?>
            <li><a title="<?php echo $v['mode'];?>" href="<?php echo site_url("company/suppliers/Business_{$v['mode']}_{$tid}");?>" rel="nofollow"><?php echo mb_substr($v['mode'],0,20,'utf-8')?> <i>(<?php echo $v['@count'];?>)</i></a></li>
            <?php } ?>
          </ul>
        </div>
        <div class="Suooliers_more"> <span>More</span><i class="fa fa-caret-down"></i> </div>
        <div class="clear"></div>
      </div>
      <div class="Suooliers_Category">
        <div class="Suooliers_title"><span>Annual Revenue</span></div>
        <div class="Suooliers_boby">
          <ul>
            <?php foreach($volume_type as $v){ ?>
            <li><a title="<?php echo $v['volume'];?>" href="<?php echo site_url("company/suppliers/Volume_{$v['volume']}_{$tid}");?>" rel="nofollow"><?php echo mb_substr($v['volume'],0,20,'utf-8')?> <i>(<?php echo $v['@count'];?>)</i></a></li>
            <?php } ?>
          </ul>
        </div>
        <div class="Suooliers_more"> <span>More</span><i class="fa fa-caret-down"></i> </div>
        <div class="clear"></div>
      </div>
      <div class="Suooliers_Category">
        <div class="Suooliers_title"><span>Country</span></div>
        <div class="Suooliers_boby">
          <ul>
            <?php foreach($country_type as $v){ ?>
            <li><a title="<?php echo $v['name'];?>" href="<?php echo site_url("company/suppliers/Country_{$v['areaid']}_{$tid}");?>" rel="nofollow"><?php echo mb_substr($v['name'],0,20,'utf-8')?> <i>(<?php echo $v['@count'];?>)</i></a></li>
            <?php } ?>
          </ul>
        </div>
        <div class="Suooliers_more"> <span>More</span><i class="fa fa-caret-down"></i> </div>
        <div class="clear"></div>
      </div>
      <div class="Suooliers_Category">
        <div class="Suooliers_title"><span>New Product</span></div>
          <?php foreach($new_sell as $v => $o) {?>
            <div class="sup_proprice">
                <div class="sup_proimg"><a href="<?php echo site_url('sell_detail/index/'.$o['itemid'].'/'.$o['linkurl'])?>">
                        <img src="<?php echo $site['image_domain'].$o['thumb']?>" class="image-fluid" alt=" "></a></div>
                <span><a href="<?php echo site_url('sell_detail/index/'.$o['itemid'].'/'.$o['linkurl'])?>" title="<?php echo $o['title'];?>"><?php echo mb_substr($o['title'],0,40,'utf-8')?></a></span>
                <span><b><?php  echo $o['minprice']>0 ? $o['currency']." ".$o['minprice'] : "Negotiable"?></b></span>
            </div>
          <?php } ?>
        <div class="clear"></div>
      </div>
    </div>
    <div class="Suooliers_right">
      <div class="Suooliers_Screening">
        <div class="Suooliers_wenzi"><span>Supplers List</span></div>
        <div class="searchbox">
          <div class="input-group">
            <input type="text" class="form-control Suooliers_search" >
            <span class="input-group-addon" id="basic-addon2"><i class=" fa fa-search fa_Supplers_color"></i></span> </div>
        </div>
        <div class="All_suppliers"><span>Supplier(s)</span></div>
        <div class="Audited_Supplier">
          <input type="checkbox" class="checkbox_left">
          <i></i><span>Audited Supplier</span></div>
        <div class="Audited_Supplier">
          <input type="checkbox" class="checkbox_left">
          <b></b><span>Online</span></div>
        <div class="Suooliers_show"><span>show:</span>
          <select class="Suooliers_select">
            <option <?php echo $tid==30?"selected='selected'":''?> value="30">30 items</option>
            <option <?php echo $tid==20?"selected='selected'":''?> value="20">20 items</option>
            <option <?php echo $tid==10?"selected='selected'":''?> value="10">10 items</option>
          </select>
        </div>
        <div class="clear"></div>
      </div>
      <div class="sup_Hotsearch">
        <h1>Hot Search:</h1>
        <div class="sup_Hotsearch_content">
          <ul>
            <?php foreach($category_hot_type as $v){ ?>
            <li><a href="<?php echo site_url("company/suppliers/Category_{$v['catid']}_{$tid}");?>" title="<?php echo $v['catname'];?>"><?php echo $v['catname'];?> <i></i></a></li>
            <?php } ?>
          </ul>
        </div>
        <div class="sup_Hotsearch_more"> <span>More</span><i class="fa fa-caret-down"></i> </div>
      </div>
      <div class="Supplers_Totallist">
        <?php foreach($list as $k => $v){?>
        <div class="Supplers_List">
          <div class="Supplers_Listleft">
            <h2><a href="<?php echo company_url(site_url(''),$o['username']);?>"><?php echo $v['company'] ?></a></h2>
            <span><i></i>Audited Supplier</span>
            <ul>
              <li><b>Business Type :</b><i><?php echo $v['mode'] ?></i></li>
              <li><b>Main Products :</b><i><?php echo $v['business'] ?></i></li>
              <li><b>Location:</b><i><?php echo $v['markets'] ?></i></li>
              <li><b>Total Annual Sales Volume:</b><i><?php echo $v['volume'] ?></i></li>
              <li><b>Top3 market :</b><i><?php echo $v['export'] ?></i></li>
            </ul>
          </div>
          <div class="Supplers_Listright">
            <div class="Supplers_Listimg">
                <?php foreach($v['sell'] as $k=>$v){?>
                    <div class="Supplers_Product_display">
                        <div class="Supplers_Product"><a href="<?php echo site_url('sell_detail/index/'.$v['itemid'].'/'.$v['linkurl'])?>">
                                <img src="<?php echo $site['image_domain'].$v['thumb']?>" class="image-fluid" alt=""></a></div>
                        <span><a href="<?php echo site_url('sell_detail/index/'.$v['itemid'].'/'.$v['linkurl'])?>" title="<?php echo $v['title']?>">
                               <?php echo mb_substr($v['title'],0,40,'utf-8')?></a></span> </div>
               <?php }?>
            </div>
            <div class="Supplers_Message">
              <div class="Supplers_Contact_Now Supplers_width" data-toggle="modal" data-target="#myModal"><i class="fa fa-envelope Supplers-size"></i>Contact Now </div>
              <div class="Supplers_Leave"><b></b><span>Leave a Message</span></div>
            </div>
          </div>
          <div class="clear"></div>
        </div>
        <?php }?>
        <div class="Info-page product_page">
          <div class="pro_center"> <?php echo $pages;?></div>
        </div>
      </div>
      <div class="suppliers_price">
        <div class="suppliers_Hotproductbox">
          <div class="product_Hierarchy"><span>Hot Products</span></div>
          <div class="suppro_prev"><span class="fa fa-angle-left fa-4x"></span></div>
          <div class="suppro_next" ><span class="fa fa-angle-right fa-4x"></span></div>
          <div class="bd">
            <ul>
              <li>
                  <?php foreach($hot_pros as $v => $o) {?>
                    <div class="suppliers_Hotproductlast">
                        <div class="suppliers_Hotproductimg"><a href="<?php echo site_url('sell_detail/index/'.$o['itemid'].'/'.$o['linkurl'])?>">
                                <img src="<?php echo $site['image_domain'].$o['thumb']?>" class="image-fluid" alt=" "></a></div>
                        <span title="<?php echo $o['title'];?>"><a href="<?php echo site_url('sell_detail/index/'.$o['itemid'].'/'.$o['linkurl']);?>" >
                                <?php echo mb_substr($o['title'],0,25,'utf-8')?></a></span>
                    </div>
                <?php } ?>
              </li>
            </ul>
            <div class="clear"></div>
          </div>
        </div>
      </div>
      <div class="clear"></div>
    </div>
    <div class="clear"></div>
  </div>
</div>
<!--Sending disk-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title" id="myModalLabel">Send Inquiry</h4>
    </div>
    <form>
      <div class="modal_emall">
        <label><i>*</i>Form</label>
        <input type="text" name="" placeholder="Enter your email address"  class="modal_form" >
      </div>
      <div class="modal_emall">
        <label><i>*</i>To</label>
        <div class="chanpinimg"></div>
      </div>
      <div class="modal_emall">
        <label><i>*</i>Subject</label>
        <input type="text" name="" placeholder="nquiry about Universal Motor / Flour Mill Motor / Blender Motor / Food Processor Motor" class="modal_Subject" >
      </div>
      <div class="modal_emall">
        <label><i>*</i>Purchase Quantity</label>
        <input type="text" name="" class="modal_Purchase" >
        <select name="" class="modal_Quantity">
          <option>Box</option>
          <option>Pieces</option>
        </select>
      </div>
      <div class="modal_emall">
        <label><i>*</i>Content</label>
        <textarea class="modal_Pdetails_Content" placeholder="We suggest you detail your product requirements and company information here" ></textarea>
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
<!--Sending disk--> 
<!--suppliers end--> 
<script>
    $(function(){
        $("#basic-addon2").click(function(){
            var val = $(".Suooliers_search").val();
            if(val == "")
            {
                window.location.href="/company/suppliers.html";
            }
            else {
                window.location.href = "/company/search/Category_" + val + ".html";
            }
        });
        $(".Suooliers_select").change(function(){
            window.location.href="<?php echo $base_url?>"+"_"+$(this).val()+ ".html";
        })
    })
</script>