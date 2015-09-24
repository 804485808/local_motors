<div class="product_detailsmian">
<div class="motors-suppliersLast sup_color">
<div class="suppliers_name">
    <div class="suppliers_logo"><img src="<?php echo base_url('/skin/images/Suppliersimg/s_logo.jpg')?>" class="image-fluid" alt=""></div>
    <h1><?php echo $company['company']?></h1>
</div>
<div class="suppliers_nav">
    <ul class="navul clearfix">
        <li class="sli"><span><a href="/">Home</a></span></li>
        <li class="sli">
            <span><a href="<?php echo site_url('company/sell_list')?>"">Product Categories<i class="fa fa-caret-down"></i></a></span>
            <ul class="sub">
                <?php foreach(array_slice($Type_sell,0,6) as $k=>$v){?>
                    <li><a href="<?php echo site_url("company/sell_list/tid_{$v[0]['tid']}")?>"><?php echo $k?></a></li>
                <?php }?>
            </ul>
        </li>
        <li class="sli">
            <span><a href="<?php echo site_url('company/companyProfile')?>"> Company Profile<i class="fa fa-caret-down"></i></a></span>
            <ul class="sub">
                <li><a href="">Company Overview</a></li>
                <li><a href="">Industrial certification</a></li>
                <li><a href="">Company Capability</a></li>
                <li><a href="">Business Performance</a></li>
            </ul>
        </li>
        <li class="sli"><span><a href="<?php echo site_url('company/contact')?>">Contacts</a></span></li>
    </ul>


</div>
<div class="sup_contacts"><span><a href="">Home</a></span> > <span><a href="">contacts</a></span></div>
<div class="sup_fenlei sup_padding">
<div class="sup_left">
    <div class="input-group input-group-up">
        <input type="text" class="form-control" >
        <span class="input-group-addon input-group-left" id="basic-addon2"><i class=" fa fa-search fa_Supplers_color"></i></span>
    </div>
    <div class="Company_Introduction"><span>Main Categories</span></div>
    <div class="com_last">
        <ul>
            <?php foreach($Type_sell as $k=>$v){?>
            <li><a href="<?php echo site_url("company/sell_list/tid_{$v[0]['tid']}")?>"><?php echo $k?></a></li>
            <?php }?>
        </ul>
    </div>
<!--    <div class="Company_Introduction"><span>product Attributes</span></div>
    <div class="sup_Suooliers_Category">
        <div class="Suooliers_title flot"><span>Category</span></div>
        <div class="Suooliers_boby flot">
            <ul>
                <li>China</li>
                <li>China</li>
                <li>USA</li>
                <li>China</li>
                <li>China</li>
                <li>China</li>
                <li>China</li>
                <li>China</li>
                <li>China</li>
                <li>China</li>
                <li>China</li>
                <li>China</li>
                <li>China</li>
                <li>China</li>
                <li>China</li>
                <li>China</li>
                <li>China</li>
                <li>China</li>
                <li>China</li>
                <li>China</li>
            </ul>
        </div>
        <div class="Suooliers_more"> <span>More</span><i class="fa fa-caret-down"></i> </div>
        <div class="clear"></div>
    </div>
    <div class="sup_Suooliers_Category">
        <div class="Suooliers_title flot"><span>Power</span></div>
        <div class="Suooliers_boby flot">
            <ul>
                <li>0-50w</li>
                <li>0-50w</li>
                <li>0-50w</li>
                <li>0-50w</li>
                <li>0-50w</li>
                <li>0-50w</li>
                <li>0-50w</li>
                <li>0-50w</li>
                <li>0-50w</li>
                <li>0-50w</li>
                <li>0-50w</li>
                <li>0-50w</li>
                <li>0-50w</li>
                <li>0-50w</li>
                <li>0-50w</li>
                <li>0-50w</li>
                <li>0-50w</li>
                <li>0-50w</li>
                <li>0-50w</li>
                <li>0-50w</li>
            </ul>
        </div>
        <div class="Suooliers_more"> <span>More</span><i class="fa fa-caret-down"></i> </div>
        <div class="clear"></div>
    </div>
    <div class="sup_Suooliers_Category">
        <div class="Suooliers_title flot"><span>Motor poles</span></div>
        <div class="Suooliers_boby flot">
            <ul>
                <li>2</li>
                <li>2</li>
                <li>2</li>
                <li>2</li>
                <li>2</li>
                <li>2</li>
                <li>2</li>
                <li>2</li>
                <li>2</li>
                <li>2</li>
                <li>2</li>
                <li>2</li>
                <li>2</li>
                <li>2</li>
                <li>2</li>
                <li>2</li>
                <li>2</li>
                <li>2</li>
                <li>2</li>
                <li>2</li>
            </ul>
        </div>
        <div class="Suooliers_more"> <span>More</span><i class="fa fa-caret-down"></i> </div>
        <div class="clear"></div>
    </div>
    <div class="sup_Suooliers_Category">
        <div class="Suooliers_title flot"><span>Voltage(v)</span></div>
        <div class="Suooliers_boby flot">
            <ul>
                <li>1-25v</li>
                <li>1-25v</li>
                <li>1-25v</li>
                <li>1-25v</li>
                <li>1-25v</li>
                <li>1-25v</li>
                <li>1-25v</li>
                <li>1-25v</li>
                <li>1-25v</li>
                <li>1-25v</li>
                <li>1-25v</li>
                <li>1-25v</li>
                <li>1-25v</li>
                <li>1-25v</li>
                <li>1-25v</li>
                <li>1-25v</li>
                <li>1-25v</li>
                <li>1-25v</li>
                <li>1-25v</li>
                <li>1-25v</li>
            </ul>
        </div>
        <div class="Suooliers_more"> <span>More</span><i class="fa fa-caret-down"></i> </div>

        <div class="clear"></div>
    </div>-->
    <div class="sup_Relatedproductlast">
        <div class="Company_Introduction"><span>Related Products</span></div>
        <div class="sup_Related">
            <?php foreach(array_slice($hotProducts,0,5) as $k=>$v){?>
            <div class="Related_Products">
                <div class="ReProductsimg"><a title="<?php echo $v['subtitle']?>" href="<?php echo main_url(site_url('sell_detail/index/'.$v['itemid'].'/'.$v['linkurl']))?>"><img src="<?php echo $site['image_domain'].$v['thumb']?>" class="image-fluid" alt=""></a></div>
                <span><a title="<?php echo $v['subtitle']?>" href="<?php echo main_url(site_url('sell_detail/index/'.$v['itemid'].'/'.$v['linkurl']))?>"><?php echo substr($v['title'],0,30)?></a></span>
                <span><b><?php  echo $d['minprice']>0 ? $d['currency']." ".$d['minprice'] : "Negotiable"?></b></span>
            </div>
            <?php }?>
            <div class="clear"></div>
        </div>
    </div>
</div>
<div class="sup_right">
<div class="Company_Introduction"><span>Main Categories</span></div>
<div class="sup_Screening">
    <div class="sup_Complex sup_Complex_color">Complex</div>
  <!--  <div class="sup_Complex">Sales</div>
    <div class="sup_price_Screening">Price：<input type="text" placeholder="low"  class="sup_text"> - <input type="text" placeholder="height"  class="sup_text"></div>
    <div class="sup_price_Screening">MOQ：<input type="text" placeholder="1 - 1000"  class="sup_Moq_text"></div>
    <div class="sup_price_Screening">
        <input type="checkbox" >
        Newest</div>
    <div class="Suooliers_show sup_magrintext"><span>show:</span>
        <select class="Suooliers_select">
            <option>15 items</option>
            <option>21 items</option>
            <option>30 items</option>
        </select>
    </div>-->
</div>
<div class="sup_Pmdcspur">
    <?php foreach($sellList as $k=>$v){?>
<div class="sup_product_show">
    <div class="sup_showimg"><a title="<?php echo $v['subtitle']?>" href="<?php echo main_url(site_url('sell_detail/index/'.$v['itemid'].'/'.$v['linkurl']))?>">
            <img src="<?php echo $site['image_domain'].$v['thumb']?>" class="image-fluid" alt="<?php echo $v['subtitle']?>" title="<?php echo $v['subtitle']?>"></a></div>
    <span><a title="<?php echo $v['subtitle']?>" href="<?php echo main_url(site_url('sell_detail/index/'.$v['itemid'].'/'.$v['linkurl']))?>"><?php echo substr($v['title'],0,20)?></a></span>
    <ul>
        <?php foreach(array_slice($v['attr'],0,6) as $kk=>$vv){?>
        <li><b><?php echo $kk?>:</b><i><?php echo $vv?></i></li>
        <?php }?>
    </ul>
    <div class="sup_product_EMail sup_margin" data-toggle="modal" data-target="#myModal"> <a href="#" class="product_button sup_button"><i class="fa fa-envelope glyphicon-size"></i>Contact Now</a></div>
</div>
<?php }?>


<div class="clear"></div>
</div>
    <div class="Info-page product_page">
        <div class="pro_center"> <?php echo $pages;?></div>
    </div>
<div class="suppliers_price">
    <div class="suppliers_Hotproductbox">
        <div class="product_Hierarchy"><span>New Products</span></div>
        <div class="suppro_prev"><span class="fa fa-angle-left fa-4x"></span></div><div class="suppro_next" ><span class="fa fa-angle-right fa-4x"></span></div>
        <div class="bd">
            <ul>
                <li>
                    <?php foreach(array_slice($hotProducts,0,5) as $k=>$v){?>
                    <div class="suppliers_Hotproductlast">
                        <div class="suppliers_Hotproductimg"><a title="<?php echo $v['subtitle']?>" href="<?php echo main_url(site_url('sell_detail/index/'.$v['itemid'].'/'.$v['linkurl']))?>"><img src="<?php echo $site['image_domain'].$v['thumb']?>" class="image-fluid" alt=""></a></div>
                        <span><a title="<?php echo $v['subtitle']?>" href="<?php echo main_url(site_url('sell_detail/index/'.$v['itemid'].'/'.$v['linkurl']))?>"><?php echo substr($v['title'],0,30)?></a></span>
                    </div>
                    <?php }?>

                </li>
                <li>
                    <div class="suppliers_Hotproductlast">
                        <div class="suppliers_Hotproductimg"><a href=""><img src="images/Suppliersimg/Supplers_05.jpg" class="image-fluid" alt=""></a></div>
                        <span><a href="">These motors belong to phase </a></span></div>
                    <div class="suppliers_Hotproductlast">
                        <div class="suppliers_Hotproductimg"><a href=""><img src="images/Suppliersimg/Supplers_05.jpg" class="image-fluid" alt=""></a></div>
                        <span><a href="">These motors belong to phase </a></span></div>
                    <div class="suppliers_Hotproductlast">
                        <div class="suppliers_Hotproductimg"><a href=""><img src="images/Suppliersimg/Supplers_01.jpg" class="image-fluid" alt=""></a></div>
                        <span><a href="">These motors belong to phase </a></span></div>
                    <div class="suppliers_Hotproductlast">
                        <div class="suppliers_Hotproductimg"><a href=""><img src="images/Suppliersimg/Supplers_05.jpg" class="image-fluid" alt=""></a></div>
                        <span><a href="">These motors belong to phase </a></span></div>
                    <div class="suppliers_Hotproductlast">
                        <div class="suppliers_Hotproductimg"><a href=""><img src="images/gdfgbv.png" class="image-fluid" alt=""></a></div>
                        <span><a href="">These motors belong to phase </a></span></div>

                </li>
                <li>
                    <div class="suppliers_Hotproductlast">
                        <div class="suppliers_Hotproductimg"><a href=""><img src="images/Suppliersimg/Supplers_05.jpg" class="image-fluid" alt=""></a></div>
                        <span><a href="">These motors belong to phase </a></span></div>
                    <div class="suppliers_Hotproductlast">
                        <div class="suppliers_Hotproductimg"><a href=""><img src="images/Suppliersimg/Supplers_05.jpg" class="image-fluid" alt=""></a></div>
                        <span><a href="">These motors belong to phase </a></span></div>
                    <div class="suppliers_Hotproductlast">
                        <div class="suppliers_Hotproductimg"><a href=""><img src="images/Suppliersimg/Supplers_01.jpg" class="image-fluid" alt=""></a></div>
                        <span><a href="">These motors belong to phase </a></span></div>
                    <div class="suppliers_Hotproductlast">
                        <div class="suppliers_Hotproductimg"><a href=""><img src="images/Suppliersimg/Supplers_05.jpg" class="image-fluid" alt=""></a></div>
                        <span><a href="">These motors belong to phase </a></span></div>
                    <div class="suppliers_Hotproductlast">
                        <div class="suppliers_Hotproductimg"><a href=""><img src="images/gdfgbv.png" class="image-fluid" alt=""></a></div>
                        <span><a href="">These motors belong to phase </a></span></div>

                </li>
            </ul>
            <div class="clear"></div>
        </div>
    </div>
</div>

</div>
</div>
<div class="clear"></div>
</div>
</div>