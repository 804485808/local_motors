<!--product last start-->

<div class="product_detailsmian">
  <div class="motors-ProductDetailspage">
    <div class="product_Hierarchy product_Hierarchy_margin"> <span> <a href="<?php echo main_url(site_url());?>">Home</a> » <a href="<?php echo site_url("catalog/index/".$thiscat['catid']."/".$thiscat['linkurl'])?>" id="M_menu"><?php echo $thiscat['catname']?>»</a> <?php echo $searchword?> <?php echo $thiscat['catname']?> </span>
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
    
    <div class="product_shuxing">
      <div class="Commodity_Attributes"><span>Product Attributes</span></div>
      <div class="product_BrandCountry">
        <?php foreach($option as $k =>$v){ ?>
        <div class="product_AllBrand">
          <h2><?php echo $v['name'];?>:</h2>
          <div class="product_Attributes_last">
            <ul>
              <?php 
							foreach($op_value[$v['oid']] as $value){
									$tmp_vid = $vid;
									$tmp_sublink = $sublink;
									$op = '';
									$str = '';
									if(array_key_exists($v['oid'],$tmp_vid)){
										unset($tmp_vid[$v['oid']]);
										unset($tmp_sublink[$v['oid']]);
									}
									
									foreach($tmp_vid as $oid => $iid){
										$op.= $oid."-".$iid."_";
									}
									foreach($tmp_sublink as $sv){
										$str.= str_ireplace(" ","-",$sv)."-";
									}
									if(array_search($value['id'],$vid) == $v['oid']){
										if($op==''){
											$attrlink = $v['oid']."-".$value['id'];
										}else{
											$attrlink = substr($op,0,strlen($op)-1);
										}
									
						  ?>
							<!--<li><a href="<?php echo site_url("attr_list/index/".$catid."/".$attrlink."/".$thiscat['linkurl'])?>" rel="nofollow"><b><?php echo $value['value'];?></b></a></li>-->
							<li><b><?php echo $value['value'];?></b></li>
							<?php }else{?>
							<li><a href="<?php echo site_url("attr_list/index/".$catid."/".$op.$v['oid']."-".$value['id']."/".$str.str_ireplace(" ","-",$value['value'])."-".$thiscat['linkurl'])?>"><?php echo $value['value'];?></a></li>
							<?php }?>              
						<?php }?>
            </ul>
          </div>
        </div>
        <?php }?>

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
            <option <?php echo $page_size==10?"selected='selected'":''?> value="10">15 items</option>
            <option <?php echo $page_size==20?"selected='selected'":''?> value="20">20 items</option>
            <option <?php echo $page_size==30?"selected='selected'":''?> value="30">30 items</option>
          </select>
        </div>
        <div class="clear"></div>
      </div>
      <div class="Commodity_List">
        <?php foreach($sellList as $k=>$v){?>
        <div class="Commodity_totalList">
          <div class="Commodity_left"> <a title="<?php echo $v['subtitle']?>" href="<?php echo site_url('sell_detail/index/'.$v['itemid'].'/'.$v['linkurl'])?>"><img src="<?php echo $site['image_domain'].$v['thumb']?>" class="image-fluid" alt="<?php echo $v['subtitle']?>"></a> </div>
          <div class="Commodity_center">
            <h2><a title="<?php echo $v['subtitle']?>" href="<?php echo site_url('sell_detail/index/'.$v['itemid'].'/'.$v['linkurl'])?>"><?php echo $v['title']?></a></h2>
            <ul>
              <li><b><?php echo $v['minprice']>0 ? $v['currency']." ".$v['minprice'] : "Negotiable";?></b></li>
              <li title="<?php echo $v['payment']?>"><i>Payment:</i><?php echo $v['payment']?></li>
              <li><b><?php echo $v['minamount'],"/",plural($v['unit']);?></b>/(Min. Order)</li>
              <li title=""><i>Delivery Port:</i><?php echo $v['port']?></li>
              <?php
                        foreach(array_slice($v['attr'],0,18) as $kk=> $vv){
                            echo "<li title=".$vv."><i >".$kk.":</i>".$vv."</li>";
                        }
                        ?>
            </ul>
            <div class="Key_word"></div>
          </div>
          <div class="Commodity_right">
            <h3><a title="<?php echo $v['company']?>" href="<?php echo company_url(site_url('company/index/'),$v['username'])?>"><?php echo $v['company']?></a></h3>
            <ul>
              <li><i>Business Type:</i> <?php if(!$v['mode']):?>Suppliers<?php else:?><?php echo $v['mode']?><?php endif?></li>
              <li><i>Hot Markets:</i><?php echo $v['markets']?> </li>
            </ul>
            <div class="more_products">
              <h2>Related products:</h2>
              <?php foreach($v['companySell'] as $vv){?>
              <span> <a title="<?php echo $vv['subtitle']?>" href="<?php echo site_url('sell_detail/index/'.$vv['itemid'].'/'.$vv['linkurl'])?>"> <img src="<?php echo $site['image_domain'].$vv['thumb']?>" class="image-fluid" alt="<?php echo $vv['subtitle']?>"> </a> </span>
              <?php }?>
              <div class="clear"></div>
            </div>
          </div>
          <div class="clear"></div>
        </div>
        <?php }?>
        <div class="Info-page product_page">
          <div class="pro_center"> <?php echo $pages;?></div>
        </div>
        <div class="clear"></div>
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