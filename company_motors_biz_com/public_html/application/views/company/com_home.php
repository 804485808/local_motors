<div class="product_detailsmian">
  <div class="motors-suppliersLast">
    <div class="suppliers_name">
      <div class="suppliers_logo"><img src="<?php echo base_url('/skin/images/Suppliersimg/s_logo.jpg')?>" class="image-fluid" alt=""></div>
      <h1><?php echo $company['company']?></h1>
    </div>
    <div class="suppliers_nav">
      <ul class="navul clearfix">
        <li class="sli"><span><a href="/"">Home</a></span></li>
        <li class="sli">
            <span><a href="<?php echo site_url('company/sell_list')?>"">Product Categories<i class="fa fa-caret-down"></i></a></span>
            <ul class="sub">
                <?php foreach(array_slice($Type_sell,0,6) as $k=>$v){?>
                    <li><a href="<?php echo site_url("company/sell_list/tid_{$v[0]['tid']}")?>"><?php echo $k?></a></li>
                <?php }?>
            </ul>
        </li>
        <li class="sli"> <span><a href="<?php echo site_url('company/companyProfile')?>"> Company Profile<i class="fa fa-caret-down"></i></a></span>
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
    <div class="Supplier_introduction">
      <div class="Company_Introduction"><span>Company Introduction</span><a href="">More >></a></div>
      <div class="Supplier_introduction_img" id="introductionBox">
        <div class="bd">
            <ul>
                <li><img src="<?php echo base_url('/skin/images/nopic.jpg')?>" data-src="<?php echo $site['image_domain'].$company_detail['thumb']?>" class="image-fluid" alt="<?php echo $company_detail['company']?>" title="<?php echo $company_detail['company']?>"/></li>
                <li><img src="<?php echo base_url('/skin/images/nopic.jpg')?>" data-src="<?php echo $site['image_domain'].$company_detail['thumb']?>" class="image-fluid" alt="<?php echo $company_detail['company']?>" title="<?php echo $company_detail['company']?>"/></li>
                <li><img src="<?php echo base_url('/skin/images/nopic.jpg')?>" data-src="<?php echo $site['image_domain'].$company_detail['thumb']?>" class="image-fluid" alt="<?php echo $company_detail['company']?>" title="<?php echo $company_detail['company']?>"/></li>
            </ul>
        </div>
       
      </div>
      <div class="Supplier_Business_introduction">
        <h2><a href=""><?php echo $company_detail['company']?></a></h2>
        <ul>
            <li><i>Business Type:</i><b><?php echo $company_detail['business']?></b></li>
            <li><i>Main Products:</i><strong><?php echo $company_detail['mainProduct']?></strong></li>
            <li><i>Annual Turnover:</i><b>6.16 Million USD</b></li>
            <li><i>Location:</i><b>The United States</b></li>
            <li><i> market :</i><b><?php echo $company_detail['markets']?> </b></li>

        </ul>
        <div class="Supplier_Learn"><a href="">Learn more about us</a><i class=" fa fa-caret-right"></i></div>
      </div>
      <div class="Staff_information">
        <div class="Supplier_Jbxinxi">
          <div class="user_name"><i class="fa fa-user"></i><a href=""><?php echo $company_detail['username']?></a></div>
          <div class="user_Leave"><b></b><span>Leave a Message</span></div>
          <div class="Supplers_Contact_Now Contact_width" data-toggle="modal" data-target="#myModal"><i class="fa fa-envelope Supplers-size"></i>Contact Now </div>
        </div>
      </div>
    </div>
    <div  class="Main_Categories">
      <div class="Company_Introduction"><span>Main Categories ›</span></div>
      <div class="Company_Pmdcspur">
        <?php foreach(array_slice($Type_sell,0,3) as $k=>$v){?>
        <div class="Company_shangpinjieshao">
            <h1><?php echo $k;?></h1>
            <?php foreach(array_slice($v,0,5 ) as $kk=>$vv){?>
            <div class="Company_Product_img">
                <div class="Company_Picture"><a href="<?php echo main_url(site_url('sell_detail/index/'.$vv['itemid'].'/'.$vv['linkurl']))?>"><img src="<?php echo base_url('/skin/images/nopic.jpg')?>" data-src="<?php echo $site['image_domain'].$vv['thumb']?>" class="image-fluid" alt="" title=""></a></div>
                <span title="<?php echo $vv['subtitle']?>"><a href="<?php echo main_url(site_url('sell_detail/index/'.$vv['itemid'].'/'.$vv['linkurl']))?>"><?php echo substr($vv['title'],0,50)?></a></span>
            </div>
            <?php }?>
            <div class="clear"></div>

        </div>
        <?php }?>
        
        <!--<div class="Company_shangpinjieshao Company_up">
            <h1>PM DC WORM GEAR MOTOR</h1>
            <div class="Company_Product_img">
                <div class="Company_Picture"><a href=""><img src="images/Suppliersimg/sup_06.jpg" class="image-fluid" alt="" title=""></a></div>
                <span><a href="">10W 12V/24V/90V dc gear motor</a></span>
            </div>

            <div class="clear"></div>
        </div>--> 
        
      </div>
    </div>
    <div class="sup_fenlei sup_padding">
      <div class="sup_left">
        <div class="input-group input-group-up">
          <input type="text" class="form-control" >
          <span class="input-group-addon input-group-left" id="basic-addon2"><i class=" fa fa-search fa_Supplers_color"></i></span> </div>
        <div class="Company_Introduction"><span>Main Categories</span></div>
        <div class="com_last">
          <ul>
            <?php foreach(array_slice($Type_sell,0,10) as $k=>$v){?>
            <li><a href="<?php echo site_url("company/sell_list/tid_{$v[0]['tid']}")?>"><?php echo $k?></a></li>
            <?php }?>
          </ul>
        </div>
      </div>
      <div class="sup_right">
        <div class="Company_Introduction"><span>Main Categories</span></div>
        <div class="sup_Pmdcspur">
            <?php foreach(array_slice($hot_sell,0,18) as $v){?>
            <div class="sup_Productimg">
                <div class="sup_Picture"><a href="<?php echo main_url(site_url('sell_detail/index/'.$v['itemid'].'/'.$v['linkurl']))?>"><img src="<?php echo base_url('/skin/images/nopic.jpg')?>" data-src="<?php echo $site['image_domain'].$v['thumb']?>" class="image-fluid" alt="" title=""></a></div>
                <span title="<?php echo $v['subtitle']?>"><a href="<?php echo main_url(site_url('sell_detail/index/'.$v['itemid'].'/'.$v['linkurl']))?>"><?php echo substr($v['title'],0,30)."..."?></a></span>
            </div>
           <?php }?>
            <div class="clear"></div>

        </div>
        <div class="Supplier_Learn sup_padding"><a href="">Learn more about us</a><i class=" fa fa-caret-right"></i></div>
        <div class="product_Send Send_border">
          <div class="Send_message send_padding">
            <div class="send_text">Send your message to this supplier</div>
            <div class="product_emall_form">
              <label><i>*</i>Form</label>
              <input type="text" name="" placeholder="Enter your email address" class="form" >
            </div>
            <div class="product_emall_form">
              <label><i>*</i>to</label>
              <div>Ms.Danny LI</div>
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
          </div>
        </div>
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
