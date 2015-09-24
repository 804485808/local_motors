<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title;?></title>
<link href="<?php echo base_url("skin_user/css/user.css")?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url("skin_user/css/jquery.popup.css")?>" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="head">
	<div class="head_top1">
		<div class="head_top_left"><span><?php echo $username?></span> <span>Welcome to <?php echo $site['site_name'];?></span> <span><a href="<?php echo site_url('reg_login/login_out')?>">Sign out</a></span></div>
		<div class="head_top_right">
        	<ul>
            	<li><a href="<?php echo site_url("user/buy/manage_buy")?>">Buy</a><span><img src="<?php echo base_url("skin_user/images/b2b5_03.jpg")?>" width="10" height="5" /></span><font>|</font>
                	
                <div class="clear"></div>
                </li>
                <li><a href="<?php echo site_url("user/sell/manage_sell")?>">Sell</a><span><img src="<?php echo base_url("skin_user/images/b2b5_03.jpg")?>" width="10" height="5" /></span><font>|</font>
                	
                <div class="clear"></div>
                </li>
                <li><a href="<?php echo site_url("user/user_main/index")?>"><b>My Biz</b></a><span><img src="<?php echo base_url("skin_user/images/b2b5_03.jpg")?>" width="10" height="5" /></span><font>|</font>
                	
                <div class="clear"></div>
                </li><li><a href="#">Help</a><span><img src="<?php echo base_url("skin_user/images/b2b5_03.jpg")?>" width="10" height="5" /></span>
                	
                <div class="clear"></div>
                </li>
            <div class="clear"></div>
            </ul>
        </div>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
    </div>
<div class="head_top2" id="head_top2">
	<div class="logo"><a href="<?php echo main_url(site_url())?>"><img src="<?php echo main_url(base_url("skin/images/logo.jpg"));?>" alt="" border="0" /></a></div>
    <div class="tuichu"><a href="<?php echo site_url('reg_login/login_out')?>" id="tuichu"><img src="<?php echo base_url("skin_user/images/inm_06.jpg")?>" width="48" height="13" /></a>
    <a href="<?php echo site_url('reg_login/login_out')?>"><img src="<?php echo base_url("skin_user/images/inm_03.jpg")?>" width="31" height="33" /></a><div class="clear"></div></div>
	<div class="clear"></div>
</div>