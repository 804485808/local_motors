<script src="<?php echo base_url('skin_user/js/jquery-1.4.js')?>" type="text/javascript"></script>
<SCRIPT src="<?php echo base_url("skin_user/js/jquery.popup.js")?>" type="text/javascript"></SCRIPT>
<script type="text/javascript">
function diag(tname,tid){
	$.popup('Group Name : <input type="text" id="inputGroup" name="inputGroup" value="'+tname+'">', {modal:true, button:{ok:true,cancel:true},ok_callback:function(){
		if($("#inputGroup").val()!==undefined){
			$.ajax({
				type:"post",
				url:"<?php echo site_url('user/sell/add_group')?>",	
				data:{ tid: tid, tname: $("#inputGroup").val() },
				dataType:"json",
				success:function(data){
					alert(data.message);
					if(data.code){
						location.reload(true);
					}
				}
			});
		}
	}});	
}

function diag_add(){
	$.popup('Group Name : <input type="text" id="inputGroup" name="inputGroup" value="">', {modal:true, button:{ok:true,cancel:true},ok_callback:function(){
		if($("#inputGroup").val()!==undefined){
			$.ajax({
				type:"post",
				url:"<?php echo site_url('user/sell/add_group')?>",	
				data:{ tname: $("#inputGroup").val() },
				dataType:"json",
				success:function(data){
					alert(data.message);
					if(data.code){
						location.reload(true);
					}
				}
			});
		}
	}});
}

</script>
<form name="checkboxform">
<div class="user_main">
		<div class="inbox_nav"><span><img src="<?php echo base_url("skin_user/images/inm_15.jpg")?>"  /></span>
		<a href="<?php echo site_url('user/user_main/index')?>">My Biz</a>
		<a href="<?php echo site_url('user/buy/manage_buy')?>">Buy</a>
		<a id="inbox_nav_a" href="<?php echo site_url('user/sell/manage_sell')?>">Sell</a>
		<a href="<?php echo site_url('user/message/inbox')?>" >Messages & Contacts</a>
		<a href="<?php echo site_url('user/news/manage_news')?>" >News</a></div>

    <div class="inbox2">
    	<div class="inbox2_left">
        	<div class="inbox2_left1"><span><img src="<?php echo base_url("skin_user/images/uJ_account.png")?>" width="30" height="30" /></span><a href="<?php echo site_url('user/sell/manage_sell')?>">Manage Supply</a></div>
        	<div class="inbox2_left1"><span><img src="<?php echo base_url("skin_user/images/uJ_buy.png")?>" width="25" height="25" /></span><a href="<?php echo site_url('user/sell/post_sell')?>">Post Product</a></div>
			<div class="inbox2_left1  inbox2_left1_1"><span><img src="<?php echo base_url("skin_user/images/icon_22.gif")?>" width="25" height="25" /></span><a href="<?php echo site_url('user/sell/manage_group')?>">Manage Group </a></div>
	  </div>
    	<div class="inbox2_right">
      	<div class="inbox2_right1"></div>
		<div class="Manage_title">groups Group</div>
		
		
      	<div class="inbox2_right2">
        	<div class="inbox2_right2_left"><A href="#" onclick="diag_add()" id="inbox2_right2_left3" data-toggle="modal" data-backdrop="static">add group</A>
        	<!-- <A href="#" id="inbox2_right2_left3a">Edit</A> -->
        	</div>
            <div class="">
               <!--  <select name="mycatid"  id="mycatid">
					<option selected="" value="0" >Ungrouped Ungrouped Ungrouped Ungrouped</option>
					<option selected="" value="0" >Ungrouped</option>
				</select>-->
              <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="inbox2_right3  top_border">
       	  <div class="inbox2_right3_1 inbox2_right3_11"><input name="" onClick="switchAll()" type="checkbox" value="" /></div>
          <div class="inbox2_right3_1 inbox2_right3_12"></div>
		  <div class="buy_l_t">Group Name</div>
		  <div class="buy_l_s">groups Count</div>
		  <!-- <div class="buy_l_s">Expired Time</div> -->
		  <div class="buy_l_ss">Operate</div>

          <div class="clear"></div>
        </div>
        <div id="contentSpan">
        <div class="inbox2_right4">     
        <?php if ($groups){foreach ($groups as $k=>$v){?>
        <div class="inbox2_right4_1a">
        	<div class="inbox2_right41">
       	  <div class="inbox2_right3_1 inbox2_right3_11"><input name="<?php echo "C".$k?>" type="checkbox" value="<?php echo $v['tid']?>" /></div>       	  
          <div class="inbox2_right3_1 inbox2_right3_12  border_none">
          <!-- <img width="25" height="25"  src="<?php //echo $site['image_domain'].$v['thumb'];?>" /> --></div>
		  <div class="buy_l_t border_none"><strong><?php echo $v['tname'];?></strong></div>
		  <div class="buy_l_s border_none"><strong><?php if($v['itemcount']){?><a href="<?php echo site_url("user/sell/manage_sell/mycatid-".$v['tid'])?>"><?php echo $v['itemcount'];?></a><?php }else{echo $v['itemcount'];}?></strong></div>
		  <!-- <div class="buy_l_s border_none"><strong><?php //echo $v['totime']?date('Y-m-d',$v['totime']):"2050-12-31";?></strong></div> -->
		  <div class="buy_l_ss  border_none">
		  <a  title="EDIT" href="#" onclick="diag('<?php echo $v['tname']?>','<?php echo $v['tid']?>')"><img src="<?php echo base_url('skin_user/images/edit_01.jpg')?>" /></a>
		  <a title="DELETE" href="#" onclick="del_group('<?php echo $v['tid'].'-';?>')"><img src="<?php echo base_url('skin_user/images/inm_28.jpg')?>" /></a></div>
                <div class="clear"></div>
          </div>
        </div>                
        <?php }?>
          <script type="text/javascript">
			function switchAll() {
				var arr=document.getElementsByTagName("input");				
				var k=arr.length-2;
				//alert(k);
				for (var j = 0; j <= k; j++) {
					box = eval("document.checkboxform.C" + j);
					box.checked = !box.checked;
				}
			}		
				
			function del_g(){
				var str="";
				var arr=document.getElementsByTagName("input");				
				var k=arr.length-2;
				for (var j = 0; j <= k; j++) {
					var check_1=eval("document.checkboxform.C"+j);																									
					if(check_1.checked==true){							
						str+=check_1.value+'-';
					}
				}
				if(str==""){
					alert("Please select groups first!");
				}else{
					del_group(str);
				}
			}
			
			function del_group(str){
				if(confirm("Are you sure to delete the selected groups？")){
					$.ajax({
						type:"post",
						url:"<?php echo site_url("user/sell/delete_group/")?>",
						data:{id:new Date(),tid:str},
						dataType:"json",
						success:function (json){
							alert(json.msg);
							if(json.total_count==0){
								window.location = "<?php echo site_url("user/sell/manage_group/")?>";
							}else if(<?php echo $page?> < json.total_count){
								location.reload(true);
							}else{
								window.location = "<?php echo site_url("user/sell/manage_group/".($page-$page_size))?>";
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
						alert("There's no any group for selected!");
					}
					function del_g(){
						alert("There's no any group for deleted!");
					}
					</script>
		<?php }?>
        </div>
        <div style="padding-top:5px;padding-bottom:5px;">
        <div class="black-red"><span class="disabled"> <?php echo $pages;?></span></div>
      </div>
      
      </div>
      <div class="inbox2_right2">
        	<div class="inbox2_right2_left">
        	<!-- <A href="#" id="inbox2_right2_left3a">Edit</A> -->
        	<A href="#" onclick="del_g()" id="inbox2_right2_left1">Delete</A>
        	</div>
        	<div class="clear"></div>
        </div>
        <div class="clear"></div>
      </div>
      <div class="clear"></div>
    </div>
</div>
</form>

<!-- <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
<h3 id="myModalLabel">Add Group</h3>
</div>
<div class="modal-body">
	
	<form class="form-horizontal">
	<div class="control-group">
	<label class="control-label" for="inputGroup">group Group:</label>
	<div class="controls">
	<input type="text" id="inputGroup" placeholder="Group Name">
	</div>
	</div>
	</form>
	</div>
<div class="modal-footer">
<button class="btn" data-dismiss="modal" aria-hidden="true">close</button>
<button class="btn btn-primary" id="save">add</button>
</div>
</div> -->