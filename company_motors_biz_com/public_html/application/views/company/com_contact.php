<!--supppliers contact start-->

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
                <li class="sli"><span><a href="">Contacts</a></span></li>
            </ul>

        </div>
        <div class="sup_contacts"><span><a href="">Home</a></span> > <span><a href="">contacts</a></span></div>
        <div class="contact_infomation">
            <div class="Company_Introduction"><span>Company Introduction</span></div>
            <div class="contact_user">
                <div class="user_Head_portrait"><a href=""><img src="<?php echo $site['image_domain'].$companyInfo['thumb']?>" class="image-fluid" alt="" title=""></a></div>
                <div class="sup_user_name sup_user_padding"><a href=""><?php echo $userInfo['truename']?></a></div>
                <div class="sup_user_name">Job Title: Manager</div>
                <div class="sup_product_EMail" data-toggle="modal" data-target="#myModal"> <a href="#" class="product_button"><i class="fa fa-envelope glyphicon-size"></i>Contact Now</a></div>
            </div>
            <div class="contact_userjieshao">
                <ul>
                    <li><b> Telephone: </b><i> <?php echo $companyInfo['telephone']?></i></li>
                    <li><b> Fax: </b><i>  </i></li>
                    <li><b> Address: </b><i>  <?php echo $companyInfo['address']?></i></li>
                    <li><b> Zip: </b><i><?php echo $companyInfo['zipcode']?></i></li>
                    <li><b> Country/Region: </b><i> <?php echo $companyInfo['regcity']?></i></li>
                </ul>
            </div>

            <div class="sup_user">
                <h1>Company Contact Information</h1>
                <ul>
                    <li><b> Company Name:: </b><i> <?php echo $companyInfo['company']?></i></li>
                    <li><b> Operational Address: </b><i><?php echo $companyInfo['address']?></i></li>
                    <li><b> Website: </b><i><?php echo $companyInfo['homepage']?></i></li>
                    <li><b> Website on motors-biz.com: </b><i>http://<?php echo $companyInfo['username']?>.motors-biz.com</i></li>
                </ul>
            </div>
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
<!--supppliers contact end-->