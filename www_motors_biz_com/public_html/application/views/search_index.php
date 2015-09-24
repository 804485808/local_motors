<!--product last start-->

<div class="product_detailsmian">
  <div class="motors-ProductDetailspage">
    <div class="product_Hierarchy product_Hierarchy_margin"> <span> <a href="<?php echo main_url(site_url());?>">Home</a> » <a href="<?php echo site_url("catalog/index/".$parent['catid']."/".$parent['linkurl'])?>" id="M_menu"><?php echo $parent['catname']?>»</a> <?php echo $nowcat['catname']?> </span>
      <div class="Level_menu">
        <ul>
          <?php foreach($oneCategory as $k=>$v){?>
          <li><a href="<?php echo site_url("catalog/index/".$v['catid']."/".$v['linkurl'])?>"><?php echo $v['catname']?></a></li>
          <?php }?>
        </ul>
        <div class="clear"></div>
      </div>
    </div>
    <div class="product_last_advertising">
      <div class="pro_tupian"><img src="<?php echo base_url('skin/images/motors_01.jpg')?>" alt=""  class="image-fluid"></div>
      <div class="pro_tupian"><img src="<?php echo base_url('skin/images/motors_02.jpg')?>" alt=""  class="image-fluid"></div>
      <div class="pro_tupian"><img src="<?php echo base_url('skin/images/motors_04.jpg')?>" alt=""  class="image-fluid"></div>
      <div class="clear"></div>
    </div>
    <div class="product_Hierarchy"><span><?php echo $parent_cat ? $parent_cat['catname'] : "Categories";?></span></div>
    <div class="product_menu">
      <?php
    if($cateChild) {
        foreach (array_slice($cateChild,0,20) as $k=>$v) {


            ?>
      <div class="product_menutextimg">
        <div class="product_menutext"><a
                        href="<?php echo site_url("search/".$kw."_did_0_cid_".$v['catid']."")?>"><?php echo $v['catname'] ?> (<?php echo $v['cnum'] ?>)</a></div>
      </div>
      <?php
        }
    }
    ?>
      <div class="clear"></div>
    </div>
    <div class="product_shuxing">
      <div class="Commodity_Attributes"><span>Product Attributes</span></div>
      <div class="product_BrandCountry">
        <?php foreach($attr as $k=>$v){?>
        <div class="product_AllBrand">
          <h2><?php echo $k?>:</h2>
          <div class="product_Attributes_last">
            <ul>
              <?php foreach(array_slice($v,0,5) as $kk=>$vv){?>
              <li><a href="
                            <?php echo site_url("search/".$kw."_did_".$vv['id']."_cid_0")?>
                           "><?php echo $vv['value']?>(<?php echo $vv['cnum']?>)</a></li>
              <?php }?>
            </ul>
            <!--                <div class="down_icon"><i class="fa fa-angle-double-down fa-sm"></i></div>--> 
          </div>
        </div>
        <?php }?>
        <div class="product_Attributes_Fold btn_down">
          <div class="product_Attributes_Foldicon product_Attributes_Folddown" id="btndown">More Options<i class="fa fa-angle-double-down fa-rag"></i></div>
        </div>
      </div>
    </div>
    <div class="productLast_content">
      <div class="product_List_classification">
        <div class="product_Complex product_Complex_color">Hot</div>
        <a href="">
        <div class="product_Complex">Newest</div>
        </a>
        <div class="Suooliers_show pro_margin"><span>Show:</span>
          <select id="pageSize" class="Suooliers_select">
            <option <?php echo $page_size==10?"selected='selected'":''?> value="10">10 items</option>
            <option <?php echo $page_size==20?"selected='selected'":''?> value="20">20 items</option>
            <option <?php echo $page_size==30?"selected='selected'":''?> value="30">30 items</option>
          </select>
        </div>
        <div class="clear"></div>
      </div>
      <div class="Commodity_List">
        <?php foreach($sellList as $k=>$v){?>
        <div class="Commodity_totalList">
          <div class="Commodity_left"> <a title="<?php echo $v['subtitle']?>" href="<?php echo company_url(site_url('sell_detail/index/'.$v['itemid'].'/'.$v['linkurl']),$v['username'])?>"> <img src="<?php echo $site['image_domain'].$v['thumb']?>" class="image-fluid" alt="<?php echo $v['subtitle']?>"></a> </div>
          <div class="Commodity_center">
            <h2 title="<?php echo $v['title']?>"><a href="<?php echo site_url('sell_detail/index/'.$v['itemid'].'/'.$v['linkurl'])?>"><?php echo substr($v['title'],0,100)?></a></h2>
            <ul>
              <li><b><?php echo $v['minprice']>0 ? $v['currency']." ".$v['minprice'] : "Negotiable";?></b></li>
              <li title="<?php echo $v['payment']?>"><i>Payment:</i><?php echo $v['payment']?></li>
              <li><b><?php echo $v['minamount'],"/",plural($v['unit']);?></b>/(Min. Order)</li>
              <li title=""><i>delivery port:</i><?php echo $v['port']?></li>
              <?php
                        foreach(array_slice($v['attr'],0,18) as $kk=> $vv){
                            echo "<li title=".$vv."><i>".$kk.":</i>".$vv."</li>";
                        }
                        ?>
            </ul>
            <div class="Key_word"></div>
          </div>
          <div class="Commodity_right">
            <h3><a title="<?php echo $v['company']?>" href="<?php echo company_url(site_url(''),$v['username'])?>"><?php echo $v['company']?></a></h3>
            <ul>
              <li><i>Business Type:</i> <?php echo $v['business']?></li>
              <li><i>Main Products:</i><?php echo substr($v['companySell'],0,50)?></li>
              <li><i>Hot Markets:</i><?php echo $v['markets']?> </li>
            </ul>
            <div class="productlast_EMail" data-toggle="modal" data-target="#myModal">
              <div class="productlast_button"><i class="fa fa-envelope glyphicon-size"></i>Contact Now</div>
            </div>
            <div class="product_AgentsRangeLast"> </div>
          </div>
          <div class="clear"></div>
        </div>
        <?php }?>
        <div class="Info-page product_page">
          <div class="pro_center"> <?php echo $pages;?></div>
        </div>
        <div class="clear"></div>
      </div>
      <div class="Guess_you_like">
        <div class="Commodity_Attributes"><span>Related product search</span></div>
        <div class="Guess_product">
          <?php foreach($mayLike as $k=>$v){?>
          <div class="Guess_product_last">
            <div class="Guess_productimg"><a title="<?php echo $v['title']?>" href="<?php echo site_url('sell_detail/index/'.$v['itemid'].'/'.$v['linkurl'])?>"><img src="<?php echo $site['image_domain'].$v['thumb']?>" class="image-fluid" alt=""></a></div>
            <dl>
              <dt><a title="<?php ?>" href="<?php echo site_url('sell_detail/index/'.$v['itemid'].'/'.$v['linkurl'])?>"><?php echo substr($v['title'],0,40)?></a></dt>
              <dd>Price：<b class="motors-public-color">
                <?php  echo $d['minprice']>0 ? $d['currency']." ".$d['minprice'] : "Negotiable"?>
                </b> </dd>
              <dd>MOQ：<b class="motors-public-color"><?php echo $v['minamount']."/".$v['unit']?></b></dd>
              <dd>Region：<b class="motors-public-color"><?php echo $v['areaname']?></b></dd>
            </dl>
          </div>
          <?php }?>
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
    
    <div class="clear"></div>
  </div>
</div>

<!--product last end--> 
<script type="text/javascript">
    $("#pageSize").change(function(){
        location.href="<?php echo $thisUrl1?>_ps_"+$(this).val();
    })
</script>