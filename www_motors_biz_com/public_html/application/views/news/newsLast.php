<!--newslast start-->

<div class="Information">
  <div class="news-Details">
    <div class="info_last_Application">
      <div class="Position">Motors_biz >> News >> <?php echo $catname?></div>
      <?php foreach($newsList as $k=>$v){?>
      <div class="Info_last_news">
        <h2><a href="<?php echo site_url('news/newsDetail/'.$v['itemid'])?>"><?php echo $v['title']?></a></h2>
        <div class="Info_lastnewsimg"><a href="<?php echo site_url('news/newsDetail/'.$v['itemid'])?>"><img src="<?php echo $site['image_domain_1'].$v['thumb']?>" alt="<?php echo $v['tag']?>" class="image-fluid"/></a></div>
        <div class="Info_lastnews_Content"> <a href="<?php echo site_url("news/newsDetail/".$v['itemid'])?>"> <?php echo substr(strip_tags($v['content']),0,150)."..."?> </a></div>
        <div class="Info-riqi">
          <time><?php echo date('Y-m-d',$v['addtime'])?></time>
          <span><a href="">Comment</a><i>|</i><a href="">Share</a></span></div>
        <div class="clear"></div>
      </div>
      <?php }?>
      <div class="Info-page product_page">
        <div class="pro_center"> <?php echo $pages;?></div>
      </div>
    </div>
    <div class="Info_right_last"> <span>Recommended Products</span>
      <?php foreach(array_slice($newsTop,0,5) as $k=>$v){?>
      <div class="Info-Categoriesimg"> <a href="<?php echo site_url('news/newsDetail/'.$v['itemid'])?>"><img src="<?php echo $site['image_domain_1'].$v['thumb']?>" class="image-fluid" alt="<?php echo $v['tag']?>"/></a> </div>
      <h3> <a title="<?php echo $v['title']?>" href="<?php echo site_url('news/newsDetail/'.$v['itemid'])?>"><?php echo $v['title']?></a></h3>
      <?php }?>
      <span>Hot news</span>
      <div class="Info-Hotsearch">
        <ul>
          <?php foreach($newsTop as $k=>$v){?>
          <li><i class="Info-Popular <?php echo $k>2?'Info-Psearch':'Info-Popular'?>"><?php echo $k+1?></i><a title="<?php echo $v['title']?>" href="<?php echo site_url('news/newsDetail/'.$v['itemid'])?>"><?php echo $v['title']?></a>
            </h3>
          </li>
          <?php }?>
        </ul>
      </div>
    </div>
    <div class="clear"></div>
  </div>
</div>
<!--newslast end--> 
