
<!--product start-->
<div class="product_main"> 
<div class="motors-Classification">
<div class="motors-categories-list motors-feilei-color"><b class="motors-feilei-iocn"></b><span class="motors-categories">CATEGORIES</span></div>
<div class="motors-Product-list motors-Ppublic">
<div class="motors-Synchronousfeilei"><span><?php echo $thiscat['catname'];?></span></div>
    <?php foreach($second_cat as $j=>$u){ ?>
        <?php foreach($u as $h=>$j){ if($h>4) {
            if($h == 5){ $jing = $h;?>
                <div class="motors-feilei"><a href="#">
                        <div class="motors-feilei-last"> <span>View More Category</span><i>››</i></div>
                    </a>
                    <div class="motors-Twonav">
                <ul>
                    <li><a href="<?php echo site_url("sell_list/index/catid_".$j['catid']."/".$j['linkurl']);?>"><?php echo $j['catname']."(".$j['item'].")";?></a></li>
                <?php }else{ ?>
                            <li><a href="<?php echo site_url("sell_list/index/catid_".$j['catid']."/".$j['linkurl']);?>"><?php echo $j['catname']."(".$j['item'].")";?></a></li>
                <?php }}else{ ?>
            <div class="motors-feilei"><a href="<?php echo site_url("sell_list/index/catid_".$j['catid']."/".$j['linkurl']);?>"><span><?php echo $j['catname'];?></span><i>›</i></a>
                <?php if(!empty($third_cat[$h])){?>
                <div class="motors-Twonav">
                    <ul>
                        <?php if(!empty($third_cat[$h])){
                            foreach($third_cat[$h] as $g){ ?>
                                <li><a title="<?php echo $g['catname']; ?>" href="<?php echo site_url("sell_list/index/catid_".$g['catid']."/".$g['linkurl']);?>">
                                        <?php echo mb_substr($g['catname'],0,30,"utf-8")."(".$g['item'].")";?></a></li>
                            <?php } } ?>
                    </ul>
                </div>
                        <?php } ?>
            </div>
        <?php }}} ?>
         <?php if(!empty($jing)){ ?>
            </ul>
               </div>
             </div>
        <?php }?>
</div>
</div>

<!--banner-->
<div class="motors-banner">
    <div class="motors-slideBox" id="motors-slideBox">
        <div class="hd">
            <ul>
            </ul>
        </div>
        <div class="bd">
            <ul>
                <li>
                    <div class="pic"><a href="#" target="_blank"><img src="<?php echo base_url('/skin/images/banner1.jpg')?>" class="image-fluid" alt=""/></a></div>
                </li>
                <li>
                    <div class="pic"><a href="#" target="_blank"><img src="<?php echo base_url('/skin/images/banner2.jpg')?>" alt="" class="image-fluid"/></a></div>
                </li>
                <li>
                    <div class="pic"><a href="#" target="_blank"><img src="<?php echo base_url('/skin/images/banner3.jpg')?>" alt="" class="image-fluid"/></a></div>
                </li>
                <li>
                    <div class="pic"><a href="#" target="_blank"><img src="<?php echo base_url('/skin/images/banner4.jpg')?>" alt=""  class="image-fluid"/></a></div>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="motors-Supplier">
    <div class="motors-tab" id="motors-tab">
        <div class="hd">
            <ul>
                <li>Senior Suppliers</li>
                <li>New Suppliers</li>
            </ul>
        </div>
        <div class="bd">
            <ul>
                <?php foreach($senior_com as $a){ ?>
                    <li title="<?php echo $a['company']; ?>"> <a href="<?php echo company_url(site_url("company/index/"),$a['username']);?>">
                            <?php echo mb_substr($a['company'],0,30,"utf-8")?></a> </li>
                <?php }?>
            </ul>
            <ul>
                <?php foreach($senior_new as $a){ ?>
                    <li title="<?php echo $a['company']; ?>"> <a href="<?php echo company_url(site_url("company/index/"),$a['username']);?>" >
                            <?php echo mb_substr($a['company'],0,30,"utf-8")?></a> </li>
                <?php }?>
            </ul>
        </div>
    </div>
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
                              ?>
                              <li><a href="<?php echo site_url("attr_list/index/".$thiscat['catid']."/".$v['oid']."-".$value['id']."/".$value['value']."-".$thiscat['linkurl'])?>"><?php echo $value['value'];?></a></li>
                          <?php }?>
                      </ul>
                  </div>
              </div>
          <?php }?>
       
      </div>
    </div>
<!--Hot product-->
<div class="MhotProducts">
    <div class="Hot_newProducts">
        <div class="ProductsHd">
            <ul>
                <li>Hot Products</li>
                <li>New Products</li>
            </ul>
            </div>
        <div class="ProductsBd">
            <div class="MProducts_box">
                <div class="Products_btn">
                    <a class="Products_prev" href="javascript:void(0);"></a>
                    <a class="Products_next" href="javascript:void(0);"></a> </div>
                <ul>
                    <li>
                    <?php foreach($hot_pros as $c){ ?>
                        <li>
                            <div class="Products_Mproductsimg"><a href="<?php echo site_url('sell_detail/index/'.
                                    $c['itemid'].'/'.$c['linkurl']);?>" target="_blank">
                                    <img src="<?php echo $site['image_domain'].$c['thumb']?>"
                                         class="image-fluid" alt="<?php echo $c['title'] ?>"></a></div>
                            <dl>
                                <dt><a title="<?php echo $c['title'];?>" href="<?php echo site_url('sell_detail/index/'.$c['itemid'].'/'.$c['linkurl']) ?>">
                                        <?php echo mb_substr($c['title'],0,50,'utf-8')?></a></dt>
                                <dd>Price：<b class="motors-public-color"><?php  echo $c['minprice']>0 ? $c['currency']." ".$c['minprice'] : "Negotiable"?></b> </dd>
                                <dd>MOQ：<b class="motors-public-color"><?php echo $c['minamount']."/".$c['unit']?></b></dd>
                                <dd>Region：<b class="motors-public-color"><?php echo $c['areaname']?></b></dd>
                            </dl>
                        </li>
                    <?php } ?>
                    </li>
                </ul>
            </div>
            <div class="MProducts_box">
                <div class="Products_btn"> <a class="Products_prev" href="javascript:void(0);"></a> <a class="Products_next" href="javascript:void(0);"></a> </div>
                <ul>
                    <?php foreach($new_sell as $o){ ?>
                    <li>
                        <div class="Products_Mproductsimg">
                            <a href="<?php echo site_url('sell_detail/index/'.$o['itemid'].'/'.$o['linkurl']);?>" target="_blank">
                                <img src="<?php echo $site['image_domain'].$o['thumb']?>"
                                     class="image-fluid" alt=""></a></div>
                        <dl>
                            <dt><a title="<?php echo $o['title'];?>" href="<?php echo site_url('sell_detail/index/'.$o['itemid'].'/'.$o['linkurl']);?>">
                                    <?php echo mb_substr($o['title'],0,50,'utf-8')?></a></dt>
                            <dd>Price：<b class="motors-public-color"><?php  echo $o['minprice']>0 ? $o['currency']." ".$o['minprice'] : "Negotiable"?></b> </dd>
                            <dd>MOQ：<b class="motors-public-color"><?php echo $o['minamount']."/".$o['unit']?></b></dd>
                            <dd>Region：<b class="motors-public-color"><?php echo $o['areaname']?></b></dd>
                        </dl>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="motors-brand">
    <div class="motors-public"><span>Hot Brand</span></div>
    <div class="motors-imgscroll" id="scrollbox">
        <div class="motors-imgbtn"> <span class="prev"></span> <span class="next"></span> </div>
        <div class="bd">
            <div class="motors-tempWrap">
                <ul>
                    <li>
                        <div class="motors-imgbrand"><a href="#" ><img src="<?php echo base_url('skin/images/Aosmith.png')?>" alt="brand motors" title="" class="image-fluid"></a></div>
                    </li>
                    <li>
                        <div class="motors-imgbrand"><a href="#" ><img src="<?php echo base_url('skin/images/Baldor.png')?>" alt="brand motors" title="" class="image-fluid"></a></div>
                    </li>
                    <li>
                        <div class="motors-imgbrand"><a href="#" ><img src="<?php echo base_url('skin/images/Maxon.png')?>" alt="brand motors" title="" class="image-fluid"></a></div>
                    </li>
                    <li>
                        <div class="motors-imgbrand"><a href="#" ><img src="<?php echo base_url('skin/images/Minn_korn.png')?>" alt="brand motors" title="" class="image-fluid"></a></div>
                    </li>
                    <li>
                        <div class="motors-imgbrand"><a href="#" ><img src="<?php echo base_url('skin/images/rockwell.png')?>" alt="brand motors" title="" class="image-fluid"></a></div>
                    </li>
                    <li>
                        <div class="motors-imgbrand"><a href="#" ><img src="<?php echo base_url('skin/images/Siemens.png')?>" alt="brand motors" title="" class="image-fluid"></a></div>
                    </li>
                    <li>
                        <div class="motors-imgbrand"><a href="#" ><img src="<?php echo base_url('skin/images/Suzuki.png')?>" alt="brand motors" title="" class="image-fluid"></a></div>
                    </li>
                    <li>
                        <div class="motors-imgbrand"><a href="#" ><img src="<?php echo base_url('skin/images/Yamaha.png')?>" alt="brand motors" title="" class="image-fluid"></a></div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="motors-price">
    <div class="motors-public"><span>Product Price</span></div>
   <div class="motors_product_tablelast">
       	  <div class="motors_product_tr">
           <div class="motors_tablelast_Name">Product Name</div>
           <div class="motors_tablelast_Voltage">Voltage (v)</div>
           <div class="motors_tablelast_Voltage">Power (w)</div>
           <div class="motors_tablelast_Voltage">Price (us)</div>
          </div>
       <?php foreach($productPrice as $k=>$v){?>
           <div class="motors_product_tr">
               <div class="motors_tablelast_Name"><a title="<?php echo $v['title']?>" href="<?php echo site_url('sell_detail/index/'.$v['itemid'].'/'.$v['linkurl'])?>"><?php echo substr($v['title'],0,25)?></a></div>
               <div class="motors_tablelast_Voltage" title="<?php echo $v['attr']['Voltage']?>"><?php echo substr($v['attr']['Voltage'],0,10)?></div>
               <div class="motors_tablelast_Voltage" title="<?php echo $v['attr']['Power']?>"><?php echo substr($v['attr']['Power'],0,10)?></div>
               <div class="motors_tablelast_Voltage"><b class="motors-public-color"><?php echo $v['currency']." ".$v['minprice']?></b></div>
           </div>
       <?php }?>
           <div class="clear"></div>
       </div>
</div>

<div class="product_Recommendedinfo">
    <div class="product_RecommendedBox" id="RecommendedBox">
        <div class="hd">
            <ul>
                <li>Recommended Popular</li>
                <li>Exhibition</li>
                <li>Purchase Information</li>
            </ul>
           </div>
        <div class="bd">
            <article>
                <div class="Recommendedimg">
                    <div class="product_Recommendedimg">
                        <a title="<?php echo $newsRecommend[0]['title']?>" target="_blank" href="<?php echo site_url("news/newsDetail/".$newsRecommend[0]['itemid'])?>" target="_blank">
                            <img src="<?php echo $site['image_domain'].$newsRecommend[0]['thumb'];?>"/></a>
                    </div>
                    <div class="product_Rlvjing">
                        <a  title="<?php echo $newsRecommend[0]['title']?>" href="<?php echo site_url("news/newsDetail/".$newsRecommend[0]['itemid'])?>">
                            <?php echo mb_substr($newsRecommend[0]['title'],0,60,'utf-8')?>
                        </a>
                    </div>
                    <div class="product_Recommendedtupian">
                        <a title="<?php echo $newsRecommend[1]['title']?>" href="<?php echo site_url("news/newsDetail/".$newsRecommend[1]['itemid'])?>" target="_blank">
                            <img src="<?php echo $site['image_domain'].$newsRecommend[1]['thumb'];?>"/>
                        </a>
                    </div>
                    <div class="product_RTlvling">
                        <a title="<?php echo $newsRecommend[1]['title']?>" href="<?php echo site_url("news/newsDetail/".$newsRecommend[1]['itemid'])?>">
                            <?php echo mb_substr($newsRecommend[1]['title'],0,60,'utf-8')?>
                        </a>
                    </div>
                </div>
                <div class="product_Recommendedxinxi">
                    <ul>
                        <?php foreach($newsRecommend as $k=>$v) { if($k>1){?>
                            <li title=" <?php echo $v['title']?>"><a title="<?php echo $v['title']?>" href="<?php echo site_url("news/newsDetail/".$v['itemid'])?>">
                                    <?php echo mb_substr($v['title'],0,200,'utf-8')?>
                            </a> </li>
                        <?php }} ?>
                    </ul>
                </div>
            </article>
            <article>
                <div class="Recommendedimg">
                    <div class="product_Recommendedimg">
                        <a title="<?php echo $exhibition[0]['title']?>" target="_blank" href="<?php echo site_url("news/newsDetail/".$exhibition[0]['itemid'])?>" target="_blank">
                            <img src="<?php echo $site['image_domain'].$exhibition[0]['thumb'];?>"/></a>
                    </div>
                    <div class="product_Rlvjing">
                        <a title="<?php echo $exhibition[0]['title']?>" href="<?php echo site_url("news/newsDetail/".$exhibition[0]['itemid'])?>">
                            <?php echo mb_substr($exhibition[0]['title'],0,60,'utf-8')?>
                        </a>
                    </div>
                    <div class="product_Recommendedtupian">
                        <a title="<?php echo $exhibition[1]['title']?>" href="<?php echo site_url("news/newsDetail/".$exhibition[1]['itemid'])?>" target="_blank">
                            <img src="<?php echo $site['image_domain'].$exhibition[1]['thumb'];?>"/>
                        </a>
                    </div>
                    <div class="product_RTlvling">
                        <a title="<?php echo $exhibition[1]['title']?>" href="<?php echo site_url("news/newsDetail/".$exhibition[1]['itemid'])?>">
                            <?php echo mb_substr($exhibition[1]['title'],0,60,'utf-8')?>
                        </a>
                    </div>
                </div>
                <div class="product_Recommendedxinxi">
                    <ul>
                        <?php foreach($exhibition as $k=>$v) { if($k>1){?>
                            <li title="<?php echo $v['title']?>"><a title="<?php echo $v['title']?>" href="<?php echo site_url("news/newsDetail/".$v['itemid'])?>">
                                    <?php echo mb_substr($v['title'],0,100,'utf-8')?>
                                </a> </li>
                        <?php }} ?>
                    </ul>
                </div>
            </article>
            <article>
                <div class="product_Recommendedxinxi">
                    <ul>
                        <?php foreach($newInquiry as $k=>$v){ ?>
                            <li><a href="" title="<?php echo $v['title']?>"><?php echo $v['title']?></a> </li>
                        <?php }?>
                    </ul>
                </div>
            </article>
        </div>
    </div>
    <div class="clear"></div>
</div>
<div class="motors-news Spacing">
    <div class="motors-public"><span>News</span></div>
    <div class="motors-tabnews" id="tabnewsbox">
        <div class="motors-news-imgebtn"> <span class="prev"></span> <span class="next"></span> </div>
        <div class="bd">
            <ul>
                <?php foreach($newsHot as $k=>$v){ if($k<4) {?>
                    <li>
                        <div class="motors-imgnews"><a href="<?php echo site_url("news/newsDetail/".$v['itemid'])?>" target="_blank">
                                <img src="<?php echo $site['image_domain'].$v['thumb'];?>"
                                     class="image-fluid" alt="" title=""/></a>
                            <div class="motors-newslvjing"><a href="<?php echo site_url("news/newsDetail/".$v['itemid'])?>">
                                    <?php echo mb_substr($v['title'],0,35,'utf-8')?></a></div>
                        </div>
                    </li>
                <?php }}?>
            </ul>
        </div>
    </div>
    <div class="motors-journalism">
        <ul>
            <?php foreach($newsHot as $k=>$v){ if($k>3){?>
                <li title="<?php echo $v['title'];?>"><a href="<?php echo site_url("news/newsDetail/".$v['itemid'])?>" ><?php echo mb_substr($v['title'],0,35,'utf-8')?></a></li>
            <?php }}?>
        </ul>
    </div>
</div>

<div class="product_Featured Spacing">
    <div class="product_FeaturedBox">
        <div class="FeaturedHd">
            <span>Featured Products</span>
        </div>
        <div class="FeaturedBd">
            <div class="Feature_btn"> <a class="Feature_prev" href="javascript:void(0);"></a> <a class="Feature_next" href="javascript:void(0);"></a> </div>
            <div class="Feature_box">
                <ul>
                    <?php foreach($featured_Products as $c){ ?>
                    <li>
                        <div class="Products_Featuredimg"><a href="<?php echo site_url('sell_detail/index/'.
                                $c['itemid'].'/'.$c['linkurl']);?>" target="_blank">
                                <img src="<?php echo $site['image_domain'].$c['thumb']?>"
                                     class="image-fluid" alt="<?php echo $c['title'] ?>"></a></div>
                        <dl>
                            <dt><a title="<?php echo $c['title'];?>" href="<?php echo site_url('sell_detail/index/'.$c['itemid'].'/'.$c['linkurl'])?>">
                                    <?php echo mb_substr($c['title'],0,50,'utf-8')?></a></dt>
                                <dd>Price：<b class="motors-public-color"><?php  echo $c['minprice']>0 ? $c['currency']." ".$c['minprice'] : "Negotiable"?></b> </dd>
                                <dd>MOQ：<b class="motors-public-color"><?php echo $c['minamount']."/".$c['unit']?></b></dd>
                                <dd>Region：<b class="motors-public-color"><?php echo $c['areaname']?></b></dd>
                        </dl>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="motors-region"> 
    <div class="motors-Source"> <b>Source by Region :</b>
        <ul>
            <li><a href="index.html" >
                    <div class="motors-Sourceimg-01"></div>
                    <span>USA</span></a></li>
            <li><a href="">
                    <div class="motors-Sourceimg-02"></div>
                    <span>China</span></a></li>
            <li><a href="">
                    <div class="motors-Sourceimg-03"></div>
                    <span>India</span></a></li>
            <li><a href="">
                    <div class="motors-Sourceimg-04"></div>
                    <span>Japan</span></a></li>
            <li><a href="">
                    <div class="motors-Sourceimg-05"></div>
                    <span>Malaysia</span></a></li>
            <li><a href="">
                    <div class="motors-Sourceimg-06"></div>
                    <span>Thailand</span></a></li>
            <li><a href="">
                    <div class="motors-Sourceimg-07"></div>
                    <span>Turkey</span></a></li>
            <li><a href="">
                    <div class="motors-Sourceimg-08"></div>
                    <span>Vietnam</span></a></li>
        </ul>
    </div>
</div> 

<div class="clear"></div>
</div>

<!--product end-->