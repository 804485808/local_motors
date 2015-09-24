<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0, width=device-width"/>
    <title><?php echo $title;?></title>
    <meta name="description" content="<?php echo $description?>">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0, width=device-width"/>
    <meta name="msvalidate.01" content="998DAE52FF81A6769E3922907E134B38" />
    <meta name="google-site-verification" content="IUQwe8017oqT6h8is17l3qwAvo6RR8uEWdM5YJN359I" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('/skin/css/bootstrap.css')?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('/skin/css/font-awesome.css')?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('/skin/css/buttons.css')?>"/>
    <link href="<?php echo base_url('/skin/css/motors.css')?>" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="<?php echo base_url('/skin/js/jquery-1.11.3.min.js')?>"></script>
    <script type="text/javascript" src="<?php echo base_url('/skin/js/jquery.SuperSlide.2.1.1.js')?>"></script>
    <script src="<?php echo base_url('/skin/js/jquery.page.js')?>"></script>
    <script src="<?php echo base_url('/skin/js/bootstrap.js')?>"></script>
    <!--[if lte IE 6]>
    <script src="<?php echo base_url('/skin/js/bootstrap-ie.js')?>"></script>
    <![endif]-->
    <!--[if lt IE 9]>
    <script src="<?php echo base_url('/skin/js/html5shiv.min.js')?>"></script>
    <script src="<?php echo base_url('/skin/js/respond.min.js')?>"></script>
    <![endif]-->
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="<?php echo base_url('/skin/js/ie10-viewport-bug-workaround.js')?>"></script>
    <?php if(isset($link)){echo $link;}?>
</head>

<body class="home-template">
<!--Header start-->
<header class="product-motors-header">
    <div class="product-motors-top">
        <div class="product-motors-top-nav">
            <div class="product-motors-welcome">Welcome to <?php echo $site['site_name'];?>, <?php echo $username ? $username : "Guest";?>!</div>
            <div class="product-motors-top-nav-right">
                <ul>
                    <?php if(!$username):?>
                        <li><a href="<?php echo main_url(site_url("/reg_login/login_in/"))?>">Sign In</a></li>
                        <li>|</li>
                        <li><a href="<?php echo main_url(site_url("/reg_login/register/"))?>">Join Free</a></li>
                    <?php endif;?>
                    <li>|</li>
                    <li><a href="<?php echo main_url(site_url("/user/user_main/"))?>">My Center</a></li>
                    <li>|</li>
                    <?php if($username):?>
                        <li><a href="<?php echo main_url(site_url("/reg_login/login_out/"))?>" rel="nofollow">Sign Out</a></li>
                    <?php endif;?>
                    <li><a href="#">Help</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="product-motors-logo-search">
        <div class="product-motors-logo"><a href="/"><img src="<?php echo base_url('/skin/images/motors-logo.png')?>" class="image-fluid"></a></div>
        <div class="product-motors-sousuo">
            <div class="product-motors-search ">
                <div class="product-motors-dropdown" id="Pdropdown">
                    <div class="product-btn-color" id="btn-meun">All <span class="product-carets">▼</span> </div>
                    <ul class="product-motors-last" id="Plast">
                     <li><a href="#">All</a></li>
                        <li><a href="#">Products</a></li>
                        <li><a href="#">Suppliers</a></li>
                        <li><a href="#">Buyers</a></li>
                    </ul>
                </div>

                <form action="<?php echo site_url("search/".$kw);?>" method="post" id="fast_search" name="fast_search">
                    <div class="product-motors-text">
                        <input type="text" placeholder="Please enter the content you want to search" name="input_text" id="input_text" class="product-motors-input" required oninvalid="setCustomValidity('Required field!');" oninput="setCustomValidity('');" type="text" autocomplete value="<?php echo $kw;?>"/>
                    </div>
                </form>

            </div>
            <div class="product-motors-btnsearch"><i class="fa fa-search fa-lg motors-hidden"></i><span onclick="search_sub()">Search</span></div>
            <div class="clear"></div>
            <div class="product-motors-hotSearch">
                <ul>

                    <?php
                    $totalkw=count($keywords)-1;
                    foreach($keywords as $w=>$q){ ?>

                        <li><a href="<?php echo site_url("slist/index/{$q['id']}/{$q['linkurl']}")?>" title="<?php echo $q['tag']?>"><?php echo mb_substr($q['tag'],0,22,"utf-8")?></a>
                        </li>
                    <?php }?>
                </ul>
            </div>
        </div>
        <div class="clear"></div>
    </div>
    <!--Navigation bar-->

    <div class="product-motors-nav">
      
        <div class="product-motors-navbar product-motors-collapse" role="navigation">
            <ul>
                <li id="index"><a href="/"><i class="fa fa-home fa-2x fa-color fl"></i>Home</a></li>
                <li id="news"><a href="<?php echo site_url("news/index");?>" >Information</a></li>
                <li id="company"><a href="<?php echo site_url('company/suppliers');?>" >Suppliers</a></li>
                <li id="newsList"><a href="<?php echo site_url('news/newsList/28');?>" >Exhibition</a></li>
            </ul>
        </div>
    </div>

    <!--nav-->
</header>
<script type="text/javascript">
    $(function() {
        jQuery(document).bind('keydown', function (event){
            if(event.keyCode == 13 && document.getElementById('input_text').value){
                search_sub();
            }
        });
    });
    function search_sub(){
        if(document.getElementById('input_text').value!="Tire Brands, Specifications, or Vehicles..." && document.getElementById('input_text').value!=""){
            document.getElementById('fast_search').submit();
        }else{
            return false;
        }
    }
</script>
<!--Header start-->