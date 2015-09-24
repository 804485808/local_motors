<div class="product_detailsmian">
    <div class="motors-suppliersLast sup_color">
        <div class="suppliers_name">
            <div class="suppliers_logo"><img src="<?php echo base_url('/skin/images/Suppliersimg/s_logo.jpg')?>" class="image-fluid" alt=""></div>
            <h1><?php echo $companyInfo['company']?></h1>
        </div>
        <div class="suppliers_nav">
            <ul class="navul clearfix">
                <li class="sli"><span><a href="/">Home</a></span></li>
                <li class="sli">
                    <span><a href="<?php echo site_url('company/sell_list')?>">Product Categories<i class="fa fa-caret-down"></i></a></span>
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
        <div class="sup_contacts"><span><a href="">Home</a></span> > <span><a href="">Company Profile</a></span></div>
        <div class="sup_fenlei sup_padding">
            <div class="sup_left sup_aboutpadding">
                <div class="sup_About"><span>About</span></div>
                <div class="sup_about_last">
                    <ul><li><a href="">Company Profile</a></li><li><a href="">Audit Profile</a></li><li><a href="">Trade Capacity</a></li><li><a href="">Production Capacity</a></li></ul>
                </div>
            </div>
            <div class="sup_right">
                <div class="Company_Introduction"><span>Main Categories</span></div>
                <div class="Company_profile">
                    <div class="Supplier_introduction_img" id="introductionBox">
                        <div class="bd">
                            <ul>
                                <li><img src="<?php echo $site['image_domain'].$companyInfo['thumb']?>" _src="<?php echo $site['image_domain'].$companyInfo['thumb']?>" class="image-fluid" alt="" title=""/></li>
                                <li><img src="<?php echo $site['image_domain'].$companyInfo['thumb']?>" _src="<?php echo $site['image_domain'].$companyInfo['thumb']?>" class="image-fluid" alt="" title=""/></li>
                                <li><img src="<?php echo $site['image_domain'].$companyInfo['thumb']?>" _src="<?php echo $site['image_domain'].$companyInfo['thumb']?>" class="image-fluid" alt="" title=""/></li>
                            </ul>
                        </div>
                        <div class="hd">
                            <ul>
                                <li><img src="<?php echo $site['image_domain'].$companyInfo['thumb']?> " class="image-fluid" alt="" title=""/></li>
                                <li><img src="<?php echo $site['image_domain'].$companyInfo['thumb']?>" class="image-fluid" alt="" title=""/></li>
                                <li><img src="<?php echo $site['image_domain'].$companyInfo['thumb']?>" class="image-fluid" alt="" title=""/></li>
                            </ul>
                        </div>
                    </div>
                    <div class="Supplier_Business_introduction company_jianjie">
                        <ul>
                            <li><i>Business Type:</i><b><?php echo $companyInfo['mode']?></b></li>
                            <li><i>Main Products:</i><strong><?php echo $companyInfo['business']?></strong></li>
                            <li><i>Total Annual Sales Volume:</i><b><?php echo $companyInfo['volume']?></b></li>
                            <li><i>Hot market :</i><b><?php echo $companyInfo['markets']?> </b></li>
                        </ul>
                    </div>
                </div>
                <div class="company_info">
                    <p><?php echo $companyInfo['introduce']?> </p>

                </div>
                <div class="clear"></div>
                <div class="product_Send Send_border">
                    <div class="Send_message send_padding">
                        <div class="send_text">Send your message to this supplier</div>
                        <div class="product_emall_form"><label><i>*</i>Form</label><input type="text" name="" placeholder="Enter your email address" class="form" ></div>
                        <div class="product_emall_form"><label><i>*</i>to</label><div>Ms.Danny LI</div></div>
                        <div class="product_emall_form"><label><i>*</i>Content</label><textarea class="Pdetails_Content"></textarea></div>
                        <div  class="product_Notes">Your inquiry content must be between 20 to 4000 characters.</div>
                        <div  class="product_Notes"><button>Send Inquiry</button></div>
                        <div  class="product_Notes"><i>*</i><label>Please contact the merchant service information</label></div>
                        <div  class="product_Notes"><i>*</i><label>Please make sure your contact information is correct.</label></div>
                        <div  class="product_Prompt">Your message will be sent directly to the recipient(s) and will not be publicly displayed. </div>
                        <div  class="product_Prompt">We will never distribute or sell your personal information to third parties without your express permission.</div>
                        <div class="clear"></div>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>