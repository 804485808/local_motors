<div class="Information">
  <div class="MInformationmain">
    <div class="Info_NewsFigure">
      <div class="Info_NewsBusiness">
        <div class="Info-shipsIndustry">
          <?php foreach($technologyDetail as $k => $v){ ?>
          <?php if(!empty($v[$k])){?>
          <div class="Info-ships">
            <div class="Info-ships-Title"><span><a href="<?php echo site_url("news/newsList/{$v['catid']}")?>"><?php echo $v['catname'];?></a></span></div>
            <?php if(!empty($v[$k])){ foreach($v[$k] as $k => $v){ ?>
            <?php if($k==0){ ?>
            <div class="Info-HotTopic">
              <h2><a href="<?php echo site_url("news/newsDetail/".$v['itemid'])?>"><?php echo mb_substr($v['title'],0,35,'utf-8')?></a></h2>
              <div class="shipsimg"> <a href="<?php echo site_url("news/newsDetail/".$v['itemid'])?>">
                      <img src="<?php echo $site['image_domain'].$v['thumb'];?>" alt="" class="image-fluid"/></a></div>
              <div class="Info-shipsjianjie"> <a href="<?php echo site_url("news/newsDetail/".$v['itemid'])?>"><?php echo mb_substr($v['content'],0,100,'utf-8')?></a></div>
            </div>
            <div class="ships-last">
              <ul>
                <?php }else{ ?>
                <li><i class="i-dian">●</i><a title="<?php echo $v['title'];?>" href="<?php echo site_url("news/newsDetail/".$v['itemid'])?>"><?php echo mb_substr($v['title'],0,35,'utf-8')?></a></li>
                <?php }if($k>5) { break;}}?>
              </ul>
            </div>
            <?php } ?>
            <div class="clear"></div>
          </div>
          <?php }} ?>
          <div class=" clear"></div>
        </div>
      </div>
      <div class="Info_Figure">
        <div class="Info-Figurebox" id="Figurebox">
          <div class="hd">
            <ul>
              <li class="on">Most Read</li>
              <li>Updating</li>
            </ul>
          </div>
          <div class="bd">
            <ul>
              <?php foreach($newsHot as $k=>$v){?>
              <li>
                <div class="Figureimg"><a href=""> <img src="<?php echo $site['image_domain'].$v['thumb'];?>" alt="" class="image-fluid"></a></div>
                <div class="Figureimgjianjie"><a title="<?php echo $v['title']; ?>" href="<?php echo site_url("news/newsDetail/".$v['itemid'])?>"> <?php echo mb_substr($v['title'],0,60,'utf-8')?></a></div>
                <div class="clear"></div>
              </li>
              <li></li>
              <?php }?>
              <div class="clear"></div>
            </ul>
            <ul>
              <?php foreach($newsRecommend as $k=>$v){?>
              <li><a title="<?php echo $v['title']; ?>" href="<?php echo site_url("news/newsDetail/".$v['itemid'])?>"> <?php echo mb_substr($v['title'],0,35,'utf-8')?></a></li>
              <li></li>
              <?php }?>
            </ul>
          </div>
        </div>
        <div class="clear"></div>
      </div>
      <div class="clear"></div>
    </div>
    <?php foreach($newsDetail as $k => $v){ ?>
    <div class="Info_column ">
      <div class="Info-RepairBox">
        <div class="Info-ships-Title"><span><a href=""><?php echo $v['catname'];?></a></span></div>
        <div class="bd">
          <ul>
            <?php foreach($v[$k] as $k => $v){ ?>
            <?php if($k==0){ ?>
            <li>
              <div class="Repairimg"><a href="<?php echo site_url("news/newsDetail/".$v['itemid'])?>"><img src="<?php echo $site['image_domain'].$v['thumb'];?>" alt="" class="image-fluid" /></a></div>
              <div class="Info-Repairjianjie"><a title="<?php echo $v['title'];?>" href="<?php echo site_url("news/newsDetail/".$v['itemid'])?>"><span><?php echo $v['title'];?></span></a></div>
            </li>
            <li></li>
            <?php }else{
                                if($k>5 && ($k+1)%5==1){ ?>
            <li> <a title="<?php echo $v['title'];?>" href="<?php echo site_url("news/newsDetail/".$v['itemid'])?>"><i class="i-dian">●</i><?php echo mb_substr($v['title'],0,35,'utf-8')?></a> </li>
            <li></li>
            <?php }else{?>
            <li> <a title="<?php echo $v['title'];?>" href="<?php echo site_url("news/newsDetail/".$v['itemid'])?>"><i class="i-dian">●</i><?php echo mb_substr($v['title'],0,35,'utf-8')?></a> </li>
            <?php }} if($k>11) { break;}}?>
          </ul>
          <div class="clear"></div>
        </div>
      </div>
    </div>
    <?php }?>
    <div class="clear"></div>
  </div>
</div>
