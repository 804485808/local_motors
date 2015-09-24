
<!--main start-->
<div class="mian">
<!--Product classification-->
<div class="motors-Classification">
<div class="motors-categories-list motors-feilei-color"><b class="motors-feilei-iocn"></b><span class="motors-categories">CATEGORIES</span></div>
   
<div class="motors-Product-list motors-Product-public">
 <?php foreach($top_cates_1 as $k=>$v){?>
<div class="motors-feilei"><a href="<?php echo site_url("catalog/index/".$v['catid']."/".$v['linkurl'])?>"><span><?php echo $v['catname']?></span><i>›</i></a>
    <div class="motors-Twonav">
        <ul>
            <?php foreach($sub_cate[$v['catid']] as $i){?>
            <li><a href="<?php echo site_url("sell_list/index/catid_".$i['catid']."/".$i['linkurl'])?>"><?php echo $i['catname']?></a></li>
            <?php }?>
        </ul>
    </div>
</div>

<?php }?>
    <div class="motors-feilei"><a href="#">
            <div class="motors-feilei-last"> <span>View More Category</span><i>››</i></div>
        </a>
        <div class="motors-Twonav">
            <ul>
                <?php foreach($top_cates_other as $k=>$v){?>
                    <li><a href="<?php echo site_url("catalog/index/".$v['catid']."/".$v['linkurl'])?>"><?php echo $v['catname']?></a></li>
                <?php }?>
            </ul>
            <div class="clear"></div>
        </div>
    </div>
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
                    <div class="pic"><a href="#"  ><img src="<?php echo base_url('/skin/images/banner2.jpg')?>" class="image-fluid" alt=""/></a></div>
                </li>
                <li>
                    <div class="pic"><a href="#"  ><img src="<?php echo base_url('/skin/images/banner1.jpg')?>" alt="" class="image-fluid"/></a></div>
                </li>
                <li>
                    <div class="pic"><a href="#"  ><img src="<?php echo base_url('/skin/images/banner3.jpg')?>" alt="" class="image-fluid"/></a></div>
                </li>
                <li>
                    <div class="pic"><a href="#"  ><img src="<?php echo base_url('/skin/images/banner4.jpg')?>" alt=""  class="image-fluid"/></a></div>
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
                <?php
                $total_comlist=count($comlist)-1;
                foreach($comlist as $t=>$y){?>

                    <li> <a title="<?php echo $y['business']?>" href="<?php echo company_url(site_url("company/index/"),$y['username'])?>"><?php echo mb_substr($y['company'],0,30,"utf-8")?></a> </li>

                <?php }?>
            </ul>
            <ul>
                <?php
                $total_comlist=count($comlist)-1;
                foreach($comlist as $t=>$y){?>

                    <li> <a title="<?php echo $y['business']?>" href="<?php echo company_url(site_url("company/index/"),$y['username'])?>"><?php echo mb_substr($y['company'],0,30,"utf-8")?></a> </li>

                <?php }?>
            </ul>
        </div>
    </div>
</div>
<div class="motors-Products">
    <div class="motors-tabProducts" id="MProductsbox">
        <div class="motorsHd">
            <ul>
                <li>Hot Products</li>
                <li>New Products</li>
            </ul>
   </div>
        <div class="motorsBd">
            <div class="motors-box">
                <div class="motors-btn"> <a class="motors-prev" href="javascript:void(0);"></a> <a class="motors-next" href="javascript:void(0);"></a> </div>
                <ul>
                    <?php foreach($hot_pros as $k=>$v){?>
                    <li>
                        <div class="motors-productsimg"><a href="<?php echo site_url('sell_detail/index/'.$v['itemid'].'/'.$v['linkurl'])?>"  ><img src="<?php echo $site['image_domain'].$v['thumb']?>" class="image-fluid" alt='<?php echo $v['title']?>'></a></div>
                        <dl>
                            <dt><a title="<?php echo $v['title']?>" href="<?php echo site_url('sell_detail/index/'.$v['itemid'].'/'.$v['linkurl'])?>"><?php echo substr($v['title'],0,50)?></a></dt>
                            <?php foreach($v['attr'] as $ak=>$av){?>
                            <dd><?php echo $av['name']?>：<b  class="motors-public-color" title="<?php echo $av['value']?>"><?php echo strlen($av['value'])>20?substr($av['value'],0,15)."...":$av['value']?></b></dd>
                            <?php }?>
                        </dl>
                    </li>
                    <?php }?>

                </ul>
            </div>

            <div class="motors-box">
                <div class="motors-btn"> <a class="motors-prev" href="javascript:void(0);"></a> <a class="motors-next" href="javascript:void(0);"></a> </div>
                <ul>

                    <?php foreach($selllist as $k=>$v){?>
                        <li>
                            <div class="motors-productsimg"><a href="<?php echo site_url('sell_detail/index/'.$v['itemid'].'/'.$v['linkurl'])?>"  ><img src="<?php echo $site['image_domain'].$v['thumb']?>" class="image-fluid" alt='<?php echo $v['title']?>'></a></div>
                            <dl>
                                <dt><a href="<?php echo site_url('sell_detail/index/'.$v['itemid'].'/'.$v['linkurl'])?>"><?php echo substr($v['title'],0,50)?></a></dt>
                                <dd>Price：<b  class="motors-public-color"><?php  echo $d['minprice']>0 ? $d['currency']." ".$d['minprice'] : "Negotiable"?></b> </dd>
                                <dd>MOQ：<b class="motors-public-color"><?php echo $v['minamount']."/".$v['unit']?></b></dd>
                                <dd>Region：<b class="motors-public-color"><?php echo $v['areaname']?></b></dd>
                            </dl>
                        </li>
                    <?php }?>

                </ul>
            </div>

        </div>
    </div>
</div>

<section class="motors-Purchase-information">
    <div class="motors-public"><span>Purchase Information</span></div>
    <ul>
        <?php
        foreach($NewInquiry as $k=>$v){
            ?>
            <li><a title="<?php echo $v['title']?>" href=""><?php echo mb_substr($v['title'],0,35,'utf-8')?></a></li>
        <?php }?>
    </ul>
</section>
<div class="motors-brand">
    <div class="motors-public"><span>Hot Brand</span></div>
    <div class="motors-imgscroll" id="scrollbox">
        <div class="motors-imgbtn"> <span class="prev"></span> <span class="next"></span> </div>
        <div class="bd">
            <div class="motors-tempWrap">
                <ul>
                    <li>
                        <div class="motors-imgbrand"><a href="#"><img src="<?php echo base_url('skin/images/Aosmith.png')?>" alt="brand motors" title="" class="image-fluid"></a></div>
                    </li>
                    <li>
                        <div class="motors-imgbrand"><a href="#"><img src="<?php echo base_url('skin/images/Baldor.png')?>" alt="brand motors" title="" class="image-fluid"></a></div>
                    </li>
                    <li>
                        <div class="motors-imgbrand"><a href="#"><img src="<?php echo base_url('skin/images/Maxon.png')?>" alt="brand motors" title="" class="image-fluid"></a></div>
                    </li>
                    <li>
                        <div class="motors-imgbrand"><a href="#"><img src="<?php echo base_url('skin/images/Minn_korn.png')?>" alt="brand motors" title="" class="image-fluid"></a></div>
                    </li>
                    <li>
                        <div class="motors-imgbrand"><a href="#"><img src="<?php echo base_url('skin/images/rockwell.png')?>" alt="brand motors" title="" class="image-fluid"></a></div>
                    </li>
                    <li>
                        <div class="motors-imgbrand"><a href="#"><img src="<?php echo base_url('skin/images/Siemens.png')?>" alt="brand motors" title="" class="image-fluid"></a></div>
                    </li>
                    <li>
                        <div class="motors-imgbrand"><a href="#"><img src="<?php echo base_url('skin/images/Suzuki.png')?>" alt="brand motors" title="" class="image-fluid"></a></div>
                    </li>
                     <li>
                        <div class="motors-imgbrand"><a href="#"><img src="<?php echo base_url('skin/images/Yamaha.png')?>" alt="brand motors" title="" class="image-fluid"></a></div>
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
           <div class="motors_tablelast_Name"><a title="<?php echo $v['title']?>" href="<?php echo company_url(site_url('sell_detail/index/'.$v['itemid'].'/'.$v['linkurl']),$v['username'])?>"><?php echo substr($v['title'],0,25)?></a></div>
           <div class="motors_tablelast_Voltage" title="<?php echo $v['attr']['Voltage']?>"><?php echo substr($v['attr']['Voltage'],0,10)?></div>
           <div class="motors_tablelast_Voltage" title="<?php echo $v['attr']['Power']?>"><?php echo substr($v['attr']['Power'],0,10)?></div>
           <div class="motors_tablelast_Voltage"><b class="motors-public-color"><?php echo $v['currency']." ".$v['minprice']?></b></div>
           </div>
           <?php }?>
           <div class="clear"></div>
       </div>
</div>
<div class="motors-technical">
    <div class="motors-tabtechnical" id="tecbox">
        <div class="hd">
            <ul>
                <?php foreach($technology as $k=>$v){?>
                <li><?php echo $k?></li>
               <?php }?>
            </ul>
           </div>
        <div class="bd">

            <?php for($i=0;$i<count($technology);$i++) {?>
                <?php $arr = $i==0?reset($technology):next($technology);
                $showNews = array();
                    foreach($arr as $v){
                        if($v['thumb']){
                            $showNews[]=$v;
                        }
                    }
                    shuffle($showNews);
                $showNews = array_slice($showNews,0,2);
                ?>
            <article>
                <div class="MTechnicalimg">

                    <?php if($showNews){
                        foreach($showNews as $k=>$v){
                        ?>
                            <div class="motors-<?php echo $k==1?'Ttupian':'tabtechnicalimg'?>">
                            <a href="<?php echo site_url('news/newsDetail/'.$v['itemid'])?>"  >
                                <img src="<?php echo
                                   $v['thumb']? $site['image_domain_1'].$v['thumb']:base_url("skin/images/nopic.jpg")?>" class="image-fluid" alt="<?php echo $v['tag']?>" title="<?php echo $v['title']?>"></a>
                                <div class="motors-<?php echo $k==1?'Tlvjing':'lvjing'?>"><a href="<?php echo site_url('news/newsDetail/'.$v['itemid'])?>"><?php echo $v['title']?></a></div>
                            </div>

                        <?php } }else{?>
                        <div class="motors-tabtechnicalimg"> <a href="#"  > <img src="<?php base_url('skin/images/motors_12.png')?>" class="image-fluid" alt="" title=""></a>
                            <div class="motors-lvjing"><a href="#">Four phase stepper motor working principle</a></div>
                        </div>

                        <div class="motors-Ttupian"> <a href="#"  > <img src="<?php base_url('skin/images/motors_12.png')?>" class="image-fluid" alt="" title=""></a>
                            <div class="motors-Tlvjing"><a href="#">Four phase stepper motor working principle</a></div>
                        </div>

                    <?php }?>

                    </div>

                <div class="motors-tabtechnicalxinxi">
                    <ul>

                        <?php foreach(array_slice($arr,0,13) as $k=>$v){?>
                        <li><a title="<?php echo $v['title']?>" href="<?php echo site_url('news/newsDetail/'.$v['itemid'])?>"><?php echo substr($v['title'],0,62)?></a> </li>
                        <?php }?>
                    </ul>
                </div>
            </article>
            <?php }?>

        </div>
    </div>

    <div class="clear"></div>
</div>
<div class="motors-exhibition">
    <div class="motors-public"><span>Exhibition</span></div>
    <div class="motors-tabexhibition" id="Exhibitionbox">

        <div class="motors-xhibition-imgebtn"> <span class="prev"></span> <span class="next"></span> </div>
        <div class="bd">
            <ul>
                <?php foreach($exhibition as $k=>$v){?>
                <li>
                    <div class="motors-imgxhibition"><a href="<?php echo site_url('news/newsDetail/'.$v['itemid'])?>"  ><img src="<?php echo $site['image_domain_1'].$v['thumb']?>" alt="<?php echo $v['tag']?>" title="<?php echo $v['title']?>" class="image-fluid"/></a>
                        <div class="motors-xhibitionlvjing"><a title="<?php echo $v['title']?>" href="<?php echo site_url('news/newsDetail/'.$v['itemid'])?>"><?php echo $v['title']?></a></div>
                    </div>
                </li>
                <?php }?>
            </ul>
        </div>
    </div>
    <div class="motors-zhanhui">
        <ul>
            <?php foreach($exhibition as $k=>$vv){?>
            <li><a title="<?php echo $vv['title']?>" href="<?php echo site_url('news/newsDetail/'.$v['itemid'])?>"><?php echo $vv['title']?></a></li>
            <?php }?>
        </ul>
    </div>
</div>
<div class="motors-anquan"> <img src="<?php echo base_url('skin/images/motors_58.jpg')?>" class=" image-fluid"> </div>

<div class="motors-information">
    <div class="motors-public"><span>Information</span></div>
    <ul>
        <?php foreach($newsTop as $k=>$v){?>
        <li><a title="<?php echo $v['title']?>" href="<?php echo site_url('news/newsDetail/'.$v['itemid'])?>"><?php echo $v['title']?></a></li>
       <?php }?>
    </ul>
</div>

<div class="motors-Business">
    <div class="motors-tabBusiness" id="MBbox">
        <div class="hd">
            <ul>
                <?php foreach($market as $k=>$v){?>
                    <li><?php echo $k?></li>
                <?php }?>
            </ul>
       </div>
        <div class="bd">

            <?php for($i=0;$i<count($market);$i++) {?>
            <?php $arr = $i==0?reset($market):next($market)?>

            <article>
                <div class="MBusinessimg">
                    <div class="motors-Businessimg"> <a href="<?php echo site_url('news/newsDetail/'.$arr[0]['itemid'])?>"  > <img src="<?php echo $site['image_domain_1'].$arr[0]['thumb']?>" class="image-fluid" alt="<?php echo $arr[0]['tag']?>" title="<?php echo $arr[0]['title']?>"></a>
                     <div class="motors-Blvjing"><a href="<?php echo site_url('news/newsDetail/'.$arr[0]['itemid'])?>"><?php echo substr($arr[0]['title'],0,62)?></a></div>
                    </div>

                    <div class="motors-Businesstupian"> <a href="<?php echo site_url('news/newsDetail/'.$arr[1]['itemid'])?>"  > <img src="<?php echo $site['image_domain_1'].$arr[1]['thumb']?>" class="image-fluid" alt="<?php echo $arr[0]['tag']?>" title="<?php echo $arr[0]['title']?>"></a>
                     <div class="motors-Businesslvjing"><a href="<?php echo site_url('news/newsDetail/'.$arr[1]['itemid'])?>"><?php echo substr($arr[1]['title'],0,62)?></a></div>
                    </div>


                </div>
                <div class="motors-Businessxinxi">
                    <ul>

                        <?php foreach($arr as $k=>$v){?>
                            <li><a title="<?php echo $v['title']?>" href="<?php echo site_url('news/newsDetail/'.$v['itemid'])?>"><?php echo $v['title']?></a> </li>
                        <?php }?>
                    </ul>
                </div>
            </article>
            <?php }?>

        </div>
    </div>
    <div class="clear"></div>
</div>

<div class="motors-news">
    <div class="motors-public"><span>Business Celebrities</span></div>
    <div class="motors-tabnews" id="tabnewsbox">
        <div class="motors-news-imgebtn"> <span class="prev"></span> <span class="next"></span> </div>
        <div class="bd">
            <ul>
                <li>
                    <div class="motors-imgnews"><a href="#"  ><img src="<?php echo base_url('skin/images/new_01.jpg')?>" class="image-fluid" alt="" title=""/></a>
                        <div class="motors-newslvjing"><a href="#">Four phase stepper motor working principle</a></div>
                    </div>
                </li>
                <li>
                    <div class="motors-imgnews"><a href="#"  ><img src="<?php echo base_url('skin/images/new_02.jpg')?>" class="image-fluid" alt="" title=""/></a>
                        <div class="motors-newslvjing"><a href="#">Four phase stepper motor working principle</a></div>
                    </div>
                </li>
                <li>
                    <div class="motors-imgnews"><a href="#"  ><img src="<?php echo base_url('skin/images/new_01.jpg')?>" class="image-fluid" alt="" title=""/></a>
                        <div class="motors-newslvjing"><a href="#">Four phase stepper motor working principle</a></div>
                    </div>
                </li>
                <li>
                    <div class="motors-imgnews"><a href="#"  ><img src="<?php echo base_url('skin/images/new_02.jpg')?>" class="image-fluid" alt="" title=""/></a>
                        <div class="motors-newslvjing"><a href="#">Four phase stepper motor working principle</a></div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div class="motors-journalism">
        <ul>
            <?php foreach($hotNews as $k=>$v){?>
                <li><a title="<?php echo $v['title']?>" href="<?php echo site_url('news/newsDetail/'.$v['itemid'])?>"><?php echo $v['title']?></a></li>
            <?php }?>
        </ul>
    </div>
</div>
<div class="motors-region">
    <div class="motors-Source"> <b>Source by Region :</b>
        <ul>
            <li><a href="#" >
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
<!--main end -->
