<!--Information main start-->
<div class="Information">
  <div class="news-Details">
    <div class="Info-Content">
        <div class="Position">Motors_biz >> News</div>
      <h1><?php echo $newsDetail['title'];?></h1>
      <div class="Info-data">By <?php echo $newsDetail['author'];?> | Published on <?php echo $newsDetail['data']['M']." ".$newsDetail['data']['D'].",".$newsDetail['data']['Y'];?></div>
      <div class="Info_share-like">
        <div class="motors-share Info-share" > <span class='st_facebook_large' displayText='Facebook'></span>
            <span class='st_twitter_large' displayText='Tweet'></span>
            <span class='st_pinterest_large' displayText='Pinterest'></span>
            <span class='st_googleplus_large' displayText='Google +'></span> </div>
        <div class="Info-like"><i></i><span><?php echo $newsDetail['hits'];?></span></div>
        <div class="clear"></div>
      </div>
      <div class="Info-Line"></div>

      <div class="Info-DetailsContent">

          <?php echo $newsDetail['content'];?>
      </div>
      <div class="Info-Related"> <span>Related articles:</span>
        <div class="btn-Refresh" id="btn" onclick="javascript:next();" >Refresh<i class="fa fa-rotate-right"></i></div>
        <div class="clear"></div>
      </div>
      <div class="Info-Refresh" id="Refresh">
        <ul id="movie1">
            <?php foreach($newsRelated as $k => $v){ ?>
                <?php if($k>5) { break;}?>
                <li><i class="i-dian">●</i><a href="<?php echo site_url("news/newsDetail/".$v['itemid'])?>"><?php echo $v['title'];?></a></li>
            <?php }?>
        </ul>
        <ul  id="movie2" style="display:none" >
            <?php foreach($newsRelated as $k => $v){ ?>
                <?php if($k>10) { break;}elseif($k>5){?>
                <li><i class="i-dian">●</i><a href="<?php echo site_url("news/newsDetail/".$v['itemid'])?>"><?php echo $v['title'];?></a></li>
            <?php }}?>
        </ul>
        <ul  id="movie3" style="display:none">
            <?php foreach($newsRelated as $k => $v){ ?>
                <?php if($k>15) { break;}elseif($k>10){?>
                <li><i class="i-dian">●</i><a href="<?php echo site_url("news/newsDetail/".$v['itemid'])?>"><?php echo $v['title'];?></a></li>
            <?php }}?>
        </ul>
      </div>
      <div class="Info-Comments"><span>Comments</span>
          <span class='st_facebook' displayText=''></span>
          <span class='st_twitter' displayText=''></span>
          <span class='st_linkedin' displayText=''></span>
          <span class='st_googleplus' displayText=''></span>
        <div class="Info-Cnumber">Comments(<?php echo $newsDetail['count']; ?>)</div>
      </div>
      <div class="Info_textarea">
        <textarea class="textarea"></textarea>
        <button class="button button-primary button-rounded button-small">Publish</button>
        <div class="clear"></div>
      </div>
        <?php foreach($newsDetail['newsReview'] as $k => $v){ ?>
                <div class="Info-Commentsxinxi"> <span><?php echo $v['username'];?></span>
                    <time><?php echo $v['time'];?></time>
                    <p><?php echo $v['content'];?></p>
                    <div class="Info-LikeReply"><span>333<b>Like</b><b>Reply</b></span></div>
<!--                    <div class="Info-Reply"> <span>Tom</span>-->
<!--                        <time>11.50</time>-->
<!--                        <p>She pointed out that China’s rubber industry has entered a significant period of transformation and-->
<!--                            upgrading. In the future, the rubber industry would adjust product structure, </p>-->
<!--                    </div>-->
                    <div class="clear"></div>
                </div>
            <?php }?>
        <div class="Info-page product_page">
            <div class="pro_center"> <?php echo $pages;?></div>
        </div>
      <div class="Info-Related"> <span>Related articles:</span>
        <div class="btn-Refresh" id="btn" onclick="javascript:Change();" >Refresh<i class="fa fa-rotate-right"></i></div>
        <div class="clear"></div>
      </div>
      <div class="Info-Refreshimg" id="Refresh">
        <ul id="more1">
            <?php foreach($hot_pros as $k=>$v){ ?><?php if($k>3) { break;}?>
              <li>
                <div class="Info-Rproducts"><a href="<?php echo company_url(site_url('sell_detail/index/'.$v['itemid'].'/'.$v['linkurl']),$v['username'])?>">
                        <img src="<?php echo $site['image_domain'].$v['thumb'];?>" class="image-fluid" alt=""/></a></div>
                <div class="Info-productsname"><a href="<?php echo company_url(site_url('sell_detail/index/'.$v['itemid'].'/'.$v['linkurl']),$v['username'])?>"><?php echo mb_substr($v['title'],0,35,'utf-8')?></a></div>
              </li>
            <?php }?>
        </ul>
        <ul  id="more2" style="display:none" >
            <?php foreach($hot_pros as $k=>$v){ ?><?php if($k>7) { break;}elseif($k>3){?>
                <li>
                    <div class="Info-Rproducts"><a href="<?php echo company_url(site_url('sell_detail/index/'.$v['itemid'].'/'.$v['linkurl']),$v['username'])?>">
                            <img src="<?php echo $site['image_domain'].$v['thumb'];?>" class="image-fluid" alt=""/></a></div>
                    <div class="Info-productsname"><a href="<?php echo company_url(site_url('sell_detail/index/'.$v['itemid'].'/'.$v['linkurl']),$v['username'])?>">
                            <?php echo mb_substr($v['title'],0,35,'utf-8')?></a></div>
                </li>
            <?php }}?>
        </ul>
        <ul  id="more3" style="display:none">
            <?php foreach($hot_pros as $k=>$v){ ?><?php if($k>11) { break;}elseif($k>7){?>
                <li>
                    <div class="Info-Rproducts"><a href="<?php echo company_url(site_url('sell_detail/index/'.$v['itemid'].'/'.$v['linkurl']),$v['username'])?>">
                            <img src="<?php echo $site['image_domain'].$v['thumb'];?>" class="image-fluid" alt=""/></a></div>
                    <div class="Info-productsname"><a href="<?php echo company_url(site_url('sell_detail/index/'.$v['itemid'].'/'.$v['linkurl']),$v['username'])?>">
                            <?php echo mb_substr($v['title'],0,35,'utf-8')?></a></div>
                </li>
            <?php }}?>
        </ul>
      </div>
      <div class="clear"></div>
    </div>
    <div class="Info-Recommend">
        <span>Popular search</span>
        <div class="Info-Hotsearch">
            <ul>
                <?php foreach($newsHot as $k=>$v){ ?><?php if($k>7) { break;}?>
                    <li><i class="Info-Popular <?php echo $k>2?'Info-Psearch':'Info-Popular'?>"><?php echo $k+1; ?></i><a title="<?php echo $v['title'];?>" href="<?php echo site_url("news/newsDetail/".$v['itemid'])?>"><?php echo mb_substr($v['title'],0,35,'utf-8')?></a></li>
                <?php }?>
            </ul>
        </div>
        <span>Categories</span>
        <?php foreach($newsRecommend as $k=>$v){ ?><?php if($k>3) { break;}?>
          <div class="Info-Categoriesimg">
              <a href="<?php echo site_url("news/newsDetail/".$v['itemid'])?>"><img src="<?php echo $site['image_domain'].$v['thumb'];?>" class=" image-fluid" alt=""/></a>
          </div>
          <h3>
              <a href="<?php echo site_url("news/newsDetail/".$v['itemid'])?>"><?php echo mb_substr($v['title'],0,35,'utf-8')?></a>
          </h3>
        <?php }?>
      <span>New Suppliers</span>
      <div class="Info-Hotsearch">
        <ul>
            <?php foreach($senior_new as $k=>$a){ ?><?php if($k>7) { break;}?>
                <li> <i class="Info-Popular <?php echo $k>2?'Info-Psearch':'Info-Popular'?>"><?php echo $k+1; ?></i><a href="<?php echo company_url(site_url("company/index/"),$a['username']);?>" title="<?php echo $a['company']; ?>">
                        <?php echo mb_substr($a['company'],0,30,"utf-8")?></a> </li>
            <?php }?>
        </ul>
      </div>
     
    </div>
     <div class="clear"></div>
  </div>
</div>
<script>
    $(function(){
        $(".Info-DetailsContent p").each(function(){
            if($(this).find("span").html() == "&nbsp;")
            {
                $(this).find("span").remove();
                if($(this).html() == "")
                {
                    $(this).remove();
                }
            }
            $(this).addClass("Info-DetailsContent-p");
            $(this).find("span").not("strong span").addClass("Info-DetailsContent-p-span");
            $(this).find("strong").addClass("Info-DetailsContent-strong");
            $(this).find("strong span").addClass("Info-DetailsContent-p-strong");
        });

        for(var i=1;i<7;i++)
        {
            var cl = ".Info-DetailsContent h"+i;
            $(cl).each(function(){
                $(this).addClass("Info-DetailsContent-h3");
                $(this).find("span").addClass("Info-DetailsContent-h3");
            });
        }

        $("button").click(function(){
            var content = $(".textarea").val();
            $.ajax({
                url: '<?php echo site_url("news/newsReview/".$newsDetail['itemid'])?>',
                type: 'post',
                data: {content: content},
                success: function (data) {
                    window.location.reload();
                }
            });
        });
    });
</script>
<!--Information main end--> 