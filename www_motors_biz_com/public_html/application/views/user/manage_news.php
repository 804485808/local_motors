<script src="<?php echo base_url('skin_user/js/jquery-1.4.js')?>" type="text/javascript"></script>
<script type="text/javascript">
$(function() {
	jQuery(document).bind('keydown', function (event){
		if(event.keyCode == 13 &&  $("#keywords").val()){
			 search(1); 
		}
	  });
	  var type="<?php echo $type?>";
	  if(type=='unapproved'){	
		search_news('Unapproved',1); 
	  }
});
function search(page){		
	var keywords=$("#keywords").val();
	if(keywords){
		$.ajax({
			type:"post",
			url:"<?php echo site_url('user/news/search_news')?>",			
			data:{id:new Date(),act:"my_search",keywords:keywords,page:page},
			dataType:"html",
			success:function(data){
						$("#contentSpan").html(data);				
					}
		});
	}else{
		alert("Please enter your search request");
	}
	
}

function search_news(value,page){
	 if(value){
			$.ajax({
				type:"post",
				url:"<?php echo site_url('user/news/search_news')?>",			
				data:{id:new Date(),act:"type_search",type:value,page:page},
				dataType:"html",
				success:function(data){
							$("#contentSpan").html(data);				
						}
			});
		}else{
			alert("Please enter your search request");
		}
}

function show_gnews(groupid){
	if(groupid){
		window.location = "<?php echo substr(site_url("user/news/manage_news"),0,-5)?>/catid-"+groupid+"<?php echo $url_suffix?>";
	}	
}
</script>

<form name="checkboxform">
<div class="user_main">
		<div class="inbox_nav"><span><img src="<?php echo base_url("skin_user/images/inm_15.jpg")?>"  /></span>
		<a href="<?php echo site_url('user/user_main/index')?>">My Biz</a>
		<a href="<?php echo site_url('user/buy/manage_buy')?>">Buy</a>
		<a href="<?php echo site_url('user/sell/manage_sell')?>">Sell</a>
		<a href="<?php echo site_url('user/message/inbox')?>" >Messages & Contacts</a>
		<a id="inbox_nav_a" href="<?php echo site_url('user/news/manage_news')?>" >News</a></div>

    <div class="inbox2">
    	<div class="inbox2_left">
        	<div class="inbox2_left1 inbox2_left1_1"><span><img src="<?php echo base_url("skin_user/images/uJ_account.png")?>" width="30" height="30" /></span><a href="<?php echo site_url('user/news/manage_news')?>">Manage News</a></div>
        	<div class="inbox2_left1"><span><img src="<?php echo base_url("skin_user/images/uJ_buy.png")?>" width="25" height="25" /></span><a href="<?php echo site_url('user/news/post_news')?>">Post News</a></div>
   	    </div>
    	<div class="inbox2_right">
      	<div class="inbox2_right1"></div>
		<div class="Manage_title">Manage News</div>
		<div class="Manage_list">
			All RFQs <a href="<?php echo site_url('user/news/manage_news')?>">(<?php echo $total;?>)</a>
			<span style="padding-left:10px;">Check pending<a href="#" onclick="search_news('Pending Review',1)">(<?php echo $pending_review;?>)</a></span>
			<span style="padding-left:10px;">Unapproved<a href="#" onclick="search_news('Unapproved',1)">(<?php echo $unapproved;?>)</a></span>
			<span style="padding-left:10px;">Published <a href="#" onclick="search_news('Published',1)">(<?php echo $published;?>)</a></span>
			<span style="padding-left:10px;">Recycle bin<a href="#" onclick="search_news('Recycle bin',1)">(<?php echo $trash;?>)</a></span>
			<span style="padding-left:10px;">Expired<a href="#" onclick="search_news('Expired',1)">(<?php echo $expired;?>)</a></span>
			<span style="padding-left:10px;">Group:<select name="groups" id="groups" onchange="show_gnews(this.value)"><option value="0">Please select</option>
			<?php foreach ($groups as $v){?><option value="<?php echo $v['catid']?>" <?php if ($groupid==$v['catid']){echo "selected";}?>><?php echo $v['catname']?></option><?php }?></select></span>
		</div>
		
      	<div class="inbox2_right2">
        	<div class="inbox2_right2_left"><A href="<?php echo site_url('user/news/post_news')?>" id="inbox2_right2_left3">Post</A>
        	<!-- <A href="#" id="inbox2_right2_left3a">Edit</A> -->
        	<A href="#" onclick="del_news()" id="inbox2_right2_left1">Delete</A></div>
            <div class="inbox2_right2_right">
                	<input name="" id="keywords" type="text" class="inbox2_right2_right1" /><input style="cursor:pointer;" name="" type="text" onclick="search(1)" class="inbox2_right2_right2" />
              <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="inbox2_right3  top_border">
       	  <div class="inbox2_right3_1 inbox2_right3_11"><input name="" onClick="switchAll()" type="checkbox" value="" /></div>
          <div class="inbox2_right3_1 inbox2_right3_12"></div>
		  <div class="buy_l_t">Subject</div>
		  <div class="buy_l_s">Max Available Amount</div>
		  <div class="buy_l_s">Expired Time</div>
		  <div class="buy_l_ss">Operate</div>

          <div class="clear"></div>
        </div>
        <div id="contentSpan">
        <div class="inbox2_right4">     
        <?php if ($news_list){foreach ($news_list as $k=>$v){?>
        <div class="inbox2_right4_1a">
        	<div class="inbox2_right41">
       	  <div class="inbox2_right3_1 inbox2_right3_11"><input name="<?php echo "C".$k?>" type="checkbox" value="<?php echo $v['itemid']?>" /></div>       	  
          <div class="inbox2_right3_1 inbox2_right3_12  border_none">
          <img width="25" height="25"  src="<?php echo $site['image_domain'].$v['thumb'];?>" /></div>
		  <div class="buy_l_t border_none">
		  	<?php if ($v['status']){?><img src="<?php echo base_url("skin_user/images/check/".$v['status'].".gif");?>" width="10" height="10" title="<?php echo $check_pic[$v['status']]?>"/><?php }?>&nbsp;
		  	<strong><a target="_blank" title="<?php echo $v['title'];?>" href="<?php echo main_url(site_url('news/index/'.$v['itemid'].'/'.$v['linkurl']))?>"><?php echo $v['title'];?></a></strong><?php echo ' (hits:',$v['hits'],')';?>
		  	
		  </div>
		  <div class="buy_l_s border_none"><strong><?php echo $v['amount']>0?$v['amount']."&nbsp;".$v['unit']:'N/A';?></strong></div>
		  <div class="buy_l_s border_none"><strong><?php 
		  if ($v['totime'] && $v['totime']<time()){
			echo "<img src='",base_url("skin_user/images/check/5.gif"),"' width='10' height='10' title='expired'/>";
			}
		  echo $v['totime']?date('Y-m-d',$v['totime']):"2050-12-31";?></strong></div>
		  <div class="buy_l_ss  border_none">
		  <a  title="EDIT" href="<?php echo site_url('user/news/edit_news/'.$v['itemid'])?>"><img src="<?php echo base_url('skin_user/images/edit_01.jpg')?>" /></a>
		  <a title="DELETE" href="#" onclick="del_news('<?php echo $v['itemid'].'-';?>')"><img src="<?php echo base_url('skin_user/images/inm_28.jpg')?>" /></a></div>

                <div class="clear"></div>
          </div>
            <div class="inbox2_right42a"><?php echo mb_substr(strip_tags($v['introduce']),0,235,'utf-8'),'......';?></div>
        </div>                
        <?php }?>
          <script type="text/javascript">
			function switchAll() {
				var arr=document.getElementsByTagName("input");				
				var k=arr.length-4;
				//alert(k);
				for (var j = 0; j <= k; j++) {
					box = eval("document.checkboxform.C" + j);
					box.checked = !box.checked;
				}
			}		
				
			function del_news(){
				var str="";
				var arr=document.getElementsByTagName("input");				
				var k=arr.length-4;
				for (var j = 0; j <= k; j++) {
					var check_1=eval("document.checkboxform.C"+j);																									
					if(check_1.checked==true){							
						str+=check_1.value+'-';
					}
				}
				if(str==""){
					alert("Please select news first!");
				}else{
					del_news(str);
				}
			}
			function del_news(str){
				if(confirm("Are you sure to delete the selected news？")){
					$.ajax({
						type:"post",
						url:"<?php echo site_url("user/news/delete_news/")?>",
						data:{id:new Date(),itemid:str},
						dataType:"json",
						success:function (json){
							alert(json.msg);
							if(json.total_count==0){
								window.location = "<?php echo site_url("user/news/manage_news/")?>";
							}else if(<?php echo $page?> < json.total_count){
								location.reload(true);
							}else{
								window.location = "<?php echo site_url("user/news/manage_news/".($page-$page_size))?>";
							}
						}
					});											 
			    }
			}	
			</script>
          <?php }else {
       				echo "<br/><br/><center>No Matching Results</center>";
       			?><script type="text/javascript">
					function switchAll() {
						alert("There's no any news for selected!");
					}
					function del_news(){
						alert("There's no any news for deleted!");
					}
					</script>
		<?php }?>
        </div>
        <div style="padding-top:5px;padding-bottom:5px;">
        <div class="black-red"><span class="disabled"> <?php echo $pages;?></span></div>
      </div>
      
      </div>
      <div class="inbox2_right2">
        	<div class="inbox2_right2_left"><A href="<?php echo site_url('user/news/post_news')?>" id="inbox2_right2_left3">Post</A>
        	<!-- <A href="#" id="inbox2_right2_left3a">Edit</A> -->
        	<A href="#" onclick="del_news()" id="inbox2_right2_left1">Delete</A></div>
        	<div class="clear"></div>
        </div>
        <div class="clear"></div>
      </div>
      <div class="clear"></div>
    </div>
</div>
</form>