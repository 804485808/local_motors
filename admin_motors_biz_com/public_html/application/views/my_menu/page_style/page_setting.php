<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>模块配置</title>
<meta name="robots" content="noindex,nofollow">
<script type="text/javascript">window.onerror= function(){return true;}</script>
<link rel="stylesheet" href="<?php echo base_url("skin/css/style.css")?>" type="text/css">
<script type="text/javascript" src="<?php echo base_url("skin/js/lang.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/config.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/jquery.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/common.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/admin.js")?>"></script>
 <style>
  .ui-state-highlight { height: 1.5em; line-height: 1.2em; }
 </style>
 <script type="text/javascript" src="<?php echo base_url("skin/js/jquery-ui.js")?>"></script>
 <script>
 function tmove(name,mode,in_page){
		$(function() {
	    $("."+name).sortable({
	    placeholder: "ui-state-highlight" , //拖动时，用css
	    cursor: "move",
	    items :"span",                        //只是li可以拖动
	    opacity: 0.6,                       //拖动时，透明度为0.6
	    revert: true,                       //释放时，增加动画
		
	    update : function(event, ui){       //更新排序之后
	        var text= "";
	        $("."+name+" input:checked").each(function(){
	            text = text + $(this).attr("id") + "," ;
	        })
	        if(text){
		        
	        	$.post('<?php echo site_url("my_menu/page_style/sell_list");?>',{"fields" : text,"mode":mode,"in_page":in_page},function(data){
					 $show = Number(data);
					 if($show==1){
						 location.reload();
					 }
				});
		    }
	    }
	   });
	 });
	}	
	  
</script>

</head>
<body>
<div class="menu">
<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody><tr>
<td valign="bottom">
<table cellpadding="0" cellspacing="0">
<tbody>
<tr>
<td width="10">&nbsp;</td>
<td id="Tab2" class="tab"><a href="<?php echo site_url("my_menu/page_style/style_add")?>">添加风格</a></td><td class="tab_nav">&nbsp;</td>
<td id="Tab1" class="tab"><a href="<?php echo site_url("my_menu/page_style/style_setting")?>">风格管理</a></td><td class="tab_nav">&nbsp;</td>
<td id="Tab0" class="tab_on"><a href="<?php echo site_url("my_menu/page_style/page_setting")?>">模块配置</a></td><td class="tab_nav">&nbsp;</td>
</tr>
</tbody></table>
</td>
<td width="110"><div>
<img src="<?php echo base_url("skin/images/spacer.gif")?>" width="40" height="24" title="刷新" onclick="window.location.reload();" style="cursor:pointer;" alt="">
<img src="<?php echo base_url("skin/images/spacer.gif")?>" width="20" height="24" title="后退" onclick="history.back(-1);" style="cursor:pointer;" alt="">
<img src="<?php echo base_url("skin/images/spacer.gif")?>" width="20" height="24" title="前进" onclick="history.go(1);" style="cursor:pointer;" alt="">
<img src="<?php echo base_url("skin/images/spacer.gif")?>" width="20" height="24" title="帮助" onclick="" style="cursor:help;" alt=""></div></td>
</tr>
</tbody></table>
</div>
<div id="Tabs0" style="display:">
<div class="tt">首页配置</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tbody>
<tr>
<th width="6%">模块</th>
<th width="5%">显示数目</th>
<th width="15%">显示条件</th>
<th width="40%">显示内容</th>
<th width="10%">排序(单选)</th>
<th width="7%">sphinx匹配度</th>
<th width="7%">操作</th>
</tr>
<form method="post" action="<?php echo site_url("my_menu/page_style/hot_search");?>">
<input type="hidden" name="mode" value="main_hot_search"/>
<input type="hidden" name="in_page" value="main"/>
<tr onmouseover="this.className=&#39;on&#39;;" onmouseout="this.className=&#39;&#39;;" align="center" class="">
<td>头部长尾词</td>
<td>
	<select name="limit" maxlength="20">
		<?php for($i=1;$i<=20;$i++){?>
			<option value="0,<?php echo $i;?>" <?php echo $mhs_num ? $i==$mhs_num : $i==10 ? "selected" : "";?>><?php echo $i;?></option>
		<?php }?>
	</select>
</td>
<td></td>
<td style="text-align:left;padding-left:15px;"><input type="checkbox" name="is_item" <?php if($main_hot_search['fields']):?>checked="checked" <?php endif;?>/>显示对应产品数<br/></td>
<td>
	<select name="orderby[]" maxlength="20" multiple="multiple">
		<option value="" <?php if ($main_hot_search['sort']=="id asc" || !$main_hot_search['sort']):?>selected<?php endif;?>>无限制</option>
		<option value="totalcc desc" <?php if ($main_hot_search['sort'] == "totalcc desc"):?>selected<?php endif;?>>按总访问量降序</option>
		<option value="monthcc desc" <?php if ($main_hot_search['sort'] == "monthcc desc"):?>selected<?php endif;?>>按月访问量降序</option>
		<option value="weekcc desc" <?php if ($main_hot_search['sort'] == "weekcc desc"):?>selected<?php endif;?>>按周访问量降序</option>
		<option value="item desc" <?php if ($main_hot_search['sort'] == "item desc"):?>selected<?php endif;?>>按产品数量降序</option>
		<option value="addtime desc" <?php if ($main_hot_search['sort'] == "addtime desc"):?>selected<?php endif;?>>按添加时间降序</option>
		<option value="byname desc" <?php if ($main_hot_search['sort'] == "byname desc"):?>selected<?php endif;?>>按首字母降序</option>
		<option value="byname asc" <?php if ($main_hot_search['sort'] == "byname asc"):?>selected<?php endif;?>>按首字母升序</option>
	</select>
</td>
<td>
</td>
<td>
<input type="submit" value="确 定">
<input type="reset" value="重置"/>
</td>
</tr>
</form>
<form method="post" action="<?php echo site_url("my_menu/page_style/catelist_set");?>">
<input type="hidden" name="mode" value="main_cate_list"/>
<input type="hidden" name="in_page" value="main"/>
<tr onmouseover="this.className=&#39;on&#39;;" onmouseout="this.className=&#39;&#39;;" align="center" class="">
<td>类别列表</td>
<td>
	一级:
	<select name="limit1" maxlength="20">
		<?php for($i=1;$i<=50;$i++){?>
			<option value="0,<?php echo $i;?>" <?php echo $mcl_num1 ? $i==$mcl_num1 : $i==10 ? "selected" : "";?>><?php echo $i;?></option>
		<?php }?>
	</select>
	二级:
	<select name="limit2" maxlength="20">
		<?php for($i=1;$i<=20;$i++){?>
			<option value="0,<?php echo $i;?>" <?php echo $mcl_num2 ? $i==$mcl_num2 : $i==10 ? "selected" : "";?>><?php echo $i;?></option>
		<?php }?>
	</select>
</td>
<td></td>
<td style="text-align:left;padding-left:15px;"><input type="checkbox" name="is_item" <?php if($main_cate_list['fields']):?>checked="checked" <?php endif;?>/>显示对应产品数<br/></td>
<td>
	一级:
	<select name="orderby[]" maxlength="20" multiple="multiple">
		<option value="" <?php if ($mcl_sort1=="catid asc" || !$mcl_sort1):?>selected<?php endif;?>>无限制</option>
		<option value="hits desc" <?php if ($mcl_sort1 == "hits desc"):?>selected<?php endif;?>>按浏览量降序 </option>
		<option value="hits asc" <?php if ($mcl_sort1 == "hits asc"):?>selected<?php endif;?>>按浏览量升序 </option>
		<option value="item desc" <?php if ($mcl_sort1 == "item desc"):?>selected<?php endif;?>>按产品数量降序 </option>
		<option value="item asc" <?php if ($mcl_sort1 == "item asc"):?>selected<?php endif;?>>按产品数量升序 </option>
		<option value="letter desc" <?php if ($mcl_sort1 == "letter desc"):?>selected<?php endif;?>>按首字母降序 </option>
		<option value="letter asc" <?php if ($mcl_sort1 == "letter asc"):?>selected<?php endif;?>>按首字母升序 </option>
	</select>
	<br/>
	二级:
	<select name="orderby2[]" maxlength="20" multiple="multiple">
		<option value="" <?php if ($mcl_sort2=="catid asc" || !$mcl_sort2):?>selected<?php endif;?>>无限制</option>
		<option value="hits desc" <?php if ($mcl_sort2 == "hits desc"):?>selected<?php endif;?>>按浏览量降序 </option>
		<option value="hits asc" <?php if ($mcl_sort2 == "hits asc"):?>selected<?php endif;?>>按浏览量升序 </option>
		<option value="item desc" <?php if ($mcl_sort2 == "item desc"):?>selected<?php endif;?>>按产品数量降序 </option>
		<option value="item asc" <?php if ($mcl_sort2 == "item asc"):?>selected<?php endif;?>>按产品数量升序 </option>
		<option value="letter desc" <?php if ($mcl_sort2 == "letter desc"):?>selected<?php endif;?>>按首字母降序 </option>
		<option value="letter asc" <?php if ($mcl_sort2 == "letter asc"):?>selected<?php endif;?>>按首字母升序 </option>
	</select>
</td>
<td></td>
<td>
<input type="submit" value="确 定">
<input type="reset" value="重置"/>
</td>
</tr>
</form>

<form method="post" action="<?php echo site_url("my_menu/page_style/sell_list");?>">
<input type="hidden" name="mode" value="main_new_sells"/>
<input type="hidden" name="in_page" value="main"/>
<input type="hidden" name="orderby[]" value="addtime desc"/>
<tr onmouseover="this.className=&#39;on&#39;;" onmouseout="this.className=&#39;&#39;;" align="center" class="">
<td>最新产品列表</td>
<td>
	<select name="limit" maxlength="20">
		<?php for($i=1;$i<=20;$i++){?>
			<option value="0,<?php echo $i;?>" <?php echo $mns_num ? $i==$mns_num : $i==5 ? "selected" : "";?>><?php echo $i;?></option>
		<?php }?>
	</select>
</td>
<td></td>
<td style="text-align:left;padding-left:15px;">
<div class="sortable_main_new_sells">
	<?php $i=0;?>
	<?php if ($mns_fields_tmp):?>
		<?php foreach ($mns_fields_tmp as $k=>$v):?>
		<?php $i++;?>
		<span onmouseover="tmove('sortable_main_new_sells','main_new_sells','main')"><input class="ui-state-default"  type="checkbox" name="fields[]" id="<?php echo $k;?>" value="<?php echo $k;?>" checked="checked" /><?php echo substr($v,1);?><?php if ($i%10==0):?><br/><?php endif;?></span> 
		<?php endforeach;?>
		<?php if ($mns_fields_tmp1):?>
		<?php foreach ($mns_fields_tmp1 as $k=>$v):?>
		<?php $i++;?>
		<span onmouseover="tmove('sortable_main_hot_sells','main_new_sells','main')"><input class="ui-state-default"  type="checkbox" name="fields[]" id="<?php echo $k;?>" value="<?php echo $k;?>" /><?php echo substr($v,1);?><?php if ($i%10==0):?><br/><?php endif;?></span> 
		<?php endforeach;?>
		<?php endif;?>
	<?php else:?>
		<?php foreach ($sell_fields as $k=>$v):?>
		<?php $i++;?>
		<span onmouseover="tmove('sortable_main_new_sells','main_new_sells','main')"><input class="ui-state-default"  type="checkbox" name="fields[]" id="<?php echo $k;?>" value="<?php echo $k;?>" <?php if (in_array($k,$mns_fields)):?>checked="checked"<?php endif;?><?php if (substr($v,0,1) && !$mns_fields):?>checked="checked"<?php endif;?>/><?php echo substr($v,1);?><?php if ($i%10==0):?><br/><?php endif;?></span> 
		<?php endforeach;?>
	<?php endif;?>
	<br/>
</div>
</td>
<td>
</td>
<td>
</td>
<td>
<input type="submit" value="确 定">
<input type="reset" value="重置"/>
</td>
</tr>
</form>
<form method="post" action="<?php echo site_url("my_menu/page_style/sell_list");?>">
<input type="hidden" name="mode" value="main_hot_sells"/>
<input type="hidden" name="in_page" value="main"/>
<input type="hidden" name="orderby[]" value="hits desc"/>
<tr onmouseover="this.className=&#39;on&#39;;" onmouseout="this.className=&#39;&#39;;" align="center" class="">
<td>最热门产品列表</td>
<td>
	<select name="limit" maxlength="20">
		<?php for($i=1;$i<=20;$i++){?>
			<option value="0,<?php echo $i;?>" <?php echo $mhots_num ? $i==$mhots_num : $i==5 ? "selected" : "";?>><?php echo $i;?></option>
		<?php }?>
	</select>
</td>
<td></td>
<td style="text-align:left;padding-left:15px;">
<div class="sortable_main_hot_sells">
	<?php $i=0;?>
	<?php if ($mhots_fields_tmp):?>
		<?php foreach ($mhots_fields_tmp as $k=>$v):?>
		<?php $i++;?>
		<span onmouseover="tmove('sortable_main_hot_sells','main_hot_sells','main')"><input class="ui-state-default"  type="checkbox" name="fields[]" id="<?php echo $k;?>" value="<?php echo $k;?>" checked="checked" /><?php echo substr($v,1);?><?php if ($i%10==0):?><br/><?php endif;?></span> 
		<?php endforeach;?>
		<?php if ($mhots_fields_tmp1):?>
		<?php foreach ($mhots_fields_tmp1 as $k=>$v):?>
		<?php $i++;?>
		<span onmouseover="tmove('sortable_main_hot_sells','main_hot_sells','main')"><input class="ui-state-default"  type="checkbox" name="fields[]" id="<?php echo $k;?>" value="<?php echo $k;?>" /><?php echo substr($v,1);?><?php if ($i%10==0):?><br/><?php endif;?></span> 
		<?php endforeach;?>
		<?php endif;?>
	<?php else:?>
		<?php foreach ($sell_fields as $k=>$v):?>
		<?php $i++;?>
		<span onmouseover="tmove('sortable_main_hot_sells','main_hot_sells','main')"><input class="ui-state-default"  type="checkbox" name="fields[]" id="<?php echo $k;?>" value="<?php echo $k;?>" <?php if (in_array($k,$mhots_fields)):?>checked="checked"<?php endif;?><?php if (substr($v,0,1) && !$mhots_fields):?>checked="checked"<?php endif;?>/><?php echo substr($v,1);?><?php if ($i%10==0):?><br/><?php endif;?></span> 
		<?php endforeach;?>
	<?php endif;?>
	<br/>
</div>
</td>
<td>
</td>
<td>
</td>
<td>
<input type="submit" value="确 定">
<input type="reset" value="重置"/>
</td>
</tr>
</form>
<form method="post" action="<?php echo site_url("my_menu/page_style/corps_list");?>">
<input type="hidden" name="mode" value="main_new_corps"/>
<input type="hidden" name="in_page" value="main"/>
<input type="hidden" name="orderby[]" value="userid desc"/>
<tr onmouseover="this.className=&#39;on&#39;;" onmouseout="this.className=&#39;&#39;;" align="center" class="">
<td>最新公司列表</td>
<td>
	<select name="limit" maxlength="20">
		<?php for($i=1;$i<=20;$i++){?>
			<option value="0,<?php echo $i;?>" <?php echo $mnc_num ? $i==$mnc_num : $i==5 ? "selected" : "";?>><?php echo $i;?></option>
		<?php }?>
	</select>
</td>
<td></td>
<td style="text-align:left;padding-left:15px;">
<div class="sortable_main_new_corps">
	<?php $i=0;?>
	<?php if ($mnc_fields_tmp):?>
		<?php foreach ($mnc_fields_tmp as $k=>$v):?>
		<?php $i++;?>
		<span onmouseover="tmove('sortable_main_new_corps','main_new_corps','main')"><input class="ui-state-default"  type="checkbox" name="fields[]" id="<?php echo $k;?>" value="<?php echo $k;?>" checked="checked" /><?php echo substr($v,1);?><?php if ($i%10==0):?><br/><?php endif;?></span> 
		<?php endforeach;?>
		<?php if ($mnc_fields_tmp1):?>
		<?php foreach ($mnc_fields_tmp1 as $k=>$v):?>
		<?php $i++;?>
		<span onmouseover="tmove('sortable_main_new_corps','main_new_corps','main')"><input class="ui-state-default"  type="checkbox" name="fields[]" id="<?php echo $k;?>" value="<?php echo $k;?>" /><?php echo substr($v,1);?><?php if ($i%10==0):?><br/><?php endif;?></span> 
		<?php endforeach;?>
		<?php endif;?>
	<?php else:?>
		<?php foreach ($corps_fields as $k=>$v):?>
		<?php $i++;?>
		<span onmouseover="tmove('sortable_main_new_corps','main_new_corps','main')"><input class="ui-state-default"  type="checkbox" name="fields[]" id="<?php echo $k;?>" value="<?php echo $k;?>" <?php if (in_array($k,$mnc_fields)):?>checked="checked"<?php endif;?><?php if (substr($v,0,1) && !$mnc_fields):?>checked="checked"<?php endif;?>/><?php echo substr($v,1);?><?php if ($i%10==0):?><br/><?php endif;?></span> 
		<?php endforeach;?>
	<?php endif;?>
	<br/>
</div>
</td>
<td>
</td>
<td>
</td>
<td>
<input type="submit" value="确 定">
<input type="reset" value="重置"/>
</td>
</tr>
</form>
</tbody></table>
</div>

<div id="Tabs1" style="display:">
<div class="tt">类别主页配置</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tbody>
<tr>
<th width="6%">模块</th>
<th width="4%">显示数目</th>
<th width="15%">显示条件</th>
<th width="40%">显示内容</th>
<th width="10%">排序(单选)</th>
<th width="7%">sphinx匹配度</th>
<th width="7%">操作</th>
</tr>
<form method="post" action="<?php echo site_url("my_menu/page_style/hot_search");?>">
<input type="hidden" name="mode" value="cate_main_hot_search"/>
<input type="hidden" name="in_page" value="cate_main"/>
<tr onmouseover="this.className=&#39;on&#39;;" onmouseout="this.className=&#39;&#39;;" align="center" class="">
<td>头部长尾词</td>
<td>
	<select name="limit" maxlength="20">
		<?php for($i=1;$i<=20;$i++){?>
			<option value="0,<?php echo $i;?>" <?php echo $catemhs_num ? $i==$catemhs_num : $i==10 ? "selected" : "";?>><?php echo $i;?></option>
		<?php }?>
	</select>
</td>
<td><input type="checkbox" name="cons" <?php if($cate_main_hot_search['conditions']):?>checked="checked"<?php endif;?> />必须类别相关</td>
<td style="text-align:left;padding-left:15px;"><input type="checkbox" name="is_item" <?php if($cate_main_hot_search['fields']):?>checked="checked" <?php endif;?>/>显示对应产品数<br/></td>
<td>
	<select name="orderby[]" maxlength="20" multiple="multiple">
		<option value="" <?php if ($cate_main_hot_search['sort']=="id asc" || !$cate_main_hot_search['sort']):?>selected<?php endif;?>>无限制</option>
		<option value="totalcc desc" <?php if ($cate_main_hot_search['sort'] == "totalcc desc"):?>selected<?php endif;?>>按总访问量降序</option>
		<option value="monthcc desc" <?php if ($cate_main_hot_search['sort'] == "monthcc desc"):?>selected<?php endif;?>>按月访问量降序</option>
		<option value="weekcc desc" <?php if ($cate_main_hot_search['sort'] == "weekcc desc"):?>selected<?php endif;?>>按周访问量降序</option>
		<option value="item desc" <?php if ($cate_main_hot_search['sort'] == "item desc"):?>selected<?php endif;?>>按产品数量降序</option>
		<option value="addtime desc" <?php if ($cate_main_hot_search['sort'] == "addtime desc"):?>selected<?php endif;?>>按添加时间降序</option>
		<option value="byname desc" <?php if ($cate_main_hot_search['sort'] == "byname desc"):?>selected<?php endif;?>>按首字母降序</option>
		<option value="byname asc" <?php if ($cate_main_hot_search['sort'] == "byname asc"):?>selected<?php endif;?>>按首字母升序</option>
	</select>
</td>
<td>
	<select name="mlength" maxlength="20">
		<?php for($i=1;$i<=10;$i++){?>
			<option value="<?php echo $i;?>" <?php echo $cate_main_hot_search['mlength'] ? $i==$cate_main_hot_search['mlength'] : $i==5 ? "selected" : "";?>><?php echo $i;?></option>
		<?php }?>
	</select>
</td>
<td>
<input type="submit" value="确 定">
<input type="reset" value="重置"/>
</td>
</tr>
</form>
<form method="post" action="<?php echo site_url("my_menu/page_style/catelist_set");?>">
<input type="hidden" name="mode" value="cate_main_cate_list"/>
<input type="hidden" name="in_page" value="cate_main"/>
<tr onmouseover="this.className=&#39;on&#39;;" onmouseout="this.className=&#39;&#39;;" align="center" class="">
<td>类别列表</td>
<td>
上级:
	<select name="limit1" maxlength="20">
		<?php for($i=1;$i<=50;$i++){?>
			<option value="0,<?php echo $i;?>" <?php echo $cmcl_num1 ? $i==$cmcl_num1 : $i==10 ? "selected" : "";?>><?php echo $i;?></option>
		<?php }?>
	</select>
	<br />
下级:
	<select name="limit2" maxlength="20">
		<?php for($i=1;$i<=20;$i++){?>
			<option value="0,<?php echo $i;?>" <?php echo $cmcl_num2 ? $i==$cmcl_num2 : $i==10 ? "selected" : "";?>><?php echo $i;?></option>
		<?php }?>
	</select>
</td>
<td></td>
<td style="text-align:left;padding-left:15px;"><input type="checkbox" name="is_item" <?php if($main_cate_list['fields']):?>checked="checked" <?php endif;?>/>显示对应产品数<br/></td>
<td>
上级:
	<select name="orderby[]" maxlength="20" multiple="multiple">
		<option value="" <?php if ($cmcl_sort1=="catid asc" || !$cmcl_sort1):?>selected<?php endif;?>>无限制</option>
		<option value="hits desc" <?php if ($cmcl_sort1 == "hits desc"):?>selected<?php endif;?>>按浏览量降序 </option>
		<option value="hits asc" <?php if ($cmcl_sort1 == "hits asc"):?>selected<?php endif;?>>按浏览量升序 </option>
		<option value="item desc" <?php if ($cmcl_sort1 == "item desc"):?>selected<?php endif;?>>按产品数量降序 </option>
		<option value="item asc" <?php if ($cmcl_sort1 == "item asc"):?>selected<?php endif;?>>按产品数量升序 </option>
		<option value="letter desc" <?php if ($cmcl_sort1 == "letter desc"):?>selected<?php endif;?>>按首字母降序 </option>
		<option value="letter asc" <?php if ($cmcl_sort1 == "letter asc"):?>selected<?php endif;?>>按首字母升序 </option>
	</select>
	<br/>
下级:
	<select name="orderby2[]" maxlength="20" multiple="multiple">
		<option value="" <?php if ($cmcl_sort2=="catid asc" || !$cmcl_sort2):?>selected<?php endif;?>>无限制</option>
		<option value="hits desc" <?php if ($cmcl_sort2 == "hits desc"):?>selected<?php endif;?>>按浏览量降序 </option>
		<option value="hits asc" <?php if ($cmcl_sort2 == "hits asc"):?>selected<?php endif;?>>按浏览量升序 </option>
		<option value="item desc" <?php if ($cmcl_sort2 == "item desc"):?>selected<?php endif;?>>按产品数量降序 </option>
		<option value="item asc" <?php if ($cmcl_sort2 == "item asc"):?>selected<?php endif;?>>按产品数量升序 </option>
		<option value="letter desc" <?php if ($cmcl_sort2 == "letter desc"):?>selected<?php endif;?>>按首字母降序 </option>
		<option value="letter asc" <?php if ($cmcl_sort2 == "letter asc"):?>selected<?php endif;?>>按首字母升序 </option>
	</select>
</td>
<td></td>
<td>
<input type="submit" value="确 定">
<input type="reset" value="重置"/>
</td>
</tr>
</form>
<form method="post" action="<?php echo site_url("my_menu/page_style/sell_list");?>">
<input type="hidden" name="mode" value="cate_main_new_sells"/>
<input type="hidden" name="in_page" value="cate_main"/>
<input type="hidden" name="orderby[]" value="addtime desc"/>
<tr onmouseover="this.className=&#39;on&#39;;" onmouseout="this.className=&#39;&#39;;" align="center" class="">
<td>最新产品列表</td>
<td>
	<select name="limit" maxlength="20">
		<?php for($i=1;$i<=20;$i++){?>
			<option value="0,<?php echo $i;?>" <?php echo $catemns_num ? $i==$catemns_num : $i==5 ? "selected" : "";?>><?php echo $i;?></option>
		<?php }?>
	</select>
</td>
<td></td>
<td style="text-align:left;padding-left:15px;">
<div class="sortable_cate_main_new_sells">
	<?php $i=0;?>
	<?php if ($catemns_fields_tmp):?>
		<?php foreach ($catemns_fields_tmp as $k=>$v):?>
		<?php $i++;?>
		<span onmouseover="tmove('sortable_cate_main_new_sells','cate_main_new_sells','cate_main')"><input class="ui-state-default"  type="checkbox" name="fields[]" id="<?php echo $k;?>" value="<?php echo $k;?>" checked="checked" /><?php echo substr($v,1);?><?php if ($i%10==0):?><br/><?php endif;?></span> 
		<?php endforeach;?>
		<?php if ($catemns_fields_tmp1):?>
		<?php foreach ($catemns_fields_tmp1 as $k=>$v):?>
		<?php $i++;?>
		<span onmouseover="tmove('sortable_cate_main_new_sells','cate_main_new_sells','cate_main')"><input class="ui-state-default"  type="checkbox" name="fields[]" id="<?php echo $k;?>" value="<?php echo $k;?>" /><?php echo substr($v,1);?><?php if ($i%10==0):?><br/><?php endif;?></span> 
		<?php endforeach;?>
		<?php endif;?>
	<?php else:?>
		<?php foreach ($sell_fields as $k=>$v):?>
		<?php $i++;?>
		<span onmouseover="tmove('sortable_cate_main_new_sells','cate_main_new_sells','cate_main')"><input class="ui-state-default"  type="checkbox" name="fields[]" id="<?php echo $k;?>" value="<?php echo $k;?>" <?php if (in_array($k,$catemns_fields)):?>checked="checked"<?php endif;?><?php if (substr($v,0,1) && !$catemns_fields):?>checked="checked"<?php endif;?>/><?php echo substr($v,1);?><?php if ($i%10==0):?><br/><?php endif;?></span> 
		<?php endforeach;?>
	<?php endif;?>
	<br/>
</div>
</td>
<td>
</td>
<td>
</td>
<td>
<input type="submit" value="确 定">
<input type="reset" value="重置"/>
</td>
</tr>
</form>
<form method="post" action="<?php echo site_url("my_menu/page_style/corps_list");?>">
<input type="hidden" name="mode" value="cate_main_new_corps"/>
<input type="hidden" name="in_page" value="cate_main"/>
<input type="hidden" name="orderby[]" value=""/>
<tr onmouseover="this.className=&#39;on&#39;;" onmouseout="this.className=&#39;&#39;;" align="center" class="">
<td>最新公司列表</td>
<td>
	<select name="limit" maxlength="20">
		<?php for($i=1;$i<=20;$i++){?>
			<option value="0,<?php echo $i;?>" <?php echo $catemnc_num ? $i==$catemnc_num : $i==5 ? "selected" : "";?>><?php echo $i;?></option>
		<?php }?>
	</select>
</td>
<td></td>
<td style="text-align:left;padding-left:15px;">
<div class="sortable_cate_main_new_corps">
	<?php $i=0;?>
	<?php if ($catemnc_fields_tmp):?>
		<?php foreach ($catemnc_fields_tmp as $k=>$v):?>
		<?php $i++;?>
		<span onmouseover="tmove('sortable_cate_main_new_corps','cate_main_new_corps','cate_main')"><input class="ui-state-default"  type="checkbox" name="fields[]" id="<?php echo $k;?>" value="<?php echo $k;?>" checked="checked" /><?php echo substr($v,1);?><?php if ($i%10==0):?><br/><?php endif;?></span> 
		<?php endforeach;?>
		<?php if ($catemnc_fields_tmp1):?>
		<?php foreach ($catemnc_fields_tmp1 as $k=>$v):?>
		<?php $i++;?>
		<span onmouseover="tmove('sortable_cate_main_new_corps','cate_main_new_corps','cate_main')"><input class="ui-state-default"  type="checkbox" name="fields[]" id="<?php echo $k;?>" value="<?php echo $k;?>" /><?php echo substr($v,1);?><?php if ($i%10==0):?><br/><?php endif;?></span> 
		<?php endforeach;?>
		<?php endif;?>
	<?php else:?>
		<?php foreach ($corps_fields as $k=>$v):?>
		<?php $i++;?>
		<span onmouseover="tmove('sortable_cate_main_new_corps','cate_main_new_corps','cate_main')"><input class="ui-state-default"  type="checkbox" name="fields[]" id="<?php echo $k;?>" value="<?php echo $k;?>" <?php if (in_array($k,$catemnc_fields)):?>checked="checked"<?php endif;?><?php if (substr($v,0,1) && !$catemnc_fields):?>checked="checked"<?php endif;?>/><?php echo substr($v,1);?><?php if ($i%10==0):?><br/><?php endif;?></span> 
		<?php endforeach;?>
	<?php endif;?>
	<br/>
</div>
</td>
<td>
</td>
<td>
</td>
<td>
<input type="submit" value="确 定">
<input type="reset" value="重置"/>
</td>
</tr>
</form>
<form method="post" action="<?php echo site_url("my_menu/page_style/hot_search");?>">
<input type="hidden" name="mode" value="cate_main_other_search"/>
<input type="hidden" name="in_page" value="cate_main"/>
<tr onmouseover="this.className=&#39;on&#39;;" onmouseout="this.className=&#39;&#39;;" align="center" class="">
<td>尾部长尾词</td>
<td>
	<select name="limit" maxlength="20">
		<?php for($i=1;$i<=20;$i++){?>
			<option value="<?php echo $catemhs_num ? $catemhs_num : 0;?>,<?php echo $i;?>" <?php echo $catemos_num ? $i==$cateos_num : $i==10 ? "selected" : "";?>><?php echo $i;?></option>
		<?php }?>
	</select>
</td>
<td><input type="checkbox" name="cons" <?php if($cate_main_other_search['conditions']):?>checked="checked"<?php endif;?> />必须类别相关</td>
<td style="text-align:left;padding-left:15px;"><input type="checkbox" name="is_item" <?php if($cate_main_other_search['fields']):?>checked="checked" <?php endif;?>/>显示对应产品数<br/></td>
<td>
	<select name="orderby[]" maxlength="20" multiple="multiple">
		<option value="" <?php if ($cate_main_other_search['sort']=="id asc" || !$cate_main_other_search['sort']):?>selected<?php endif;?>>无限制</option>
		<option value="totalcc desc" <?php if ($cate_main_other_search['sort'] == "totalcc desc"):?>selected<?php endif;?>>按总访问量降序</option>
		<option value="monthcc desc" <?php if ($cate_main_other_search['sort'] == "monthcc desc"):?>selected<?php endif;?>>按月访问量降序</option>
		<option value="weekcc desc" <?php if ($cate_main_other_search['sort'] == "weekcc desc"):?>selected<?php endif;?>>按周访问量降序</option>
		<option value="item desc" <?php if ($cate_main_other_search['sort'] == "item desc"):?>selected<?php endif;?>>按产品数量降序</option>
		<option value="addtime desc" <?php if ($cate_main_other_search['sort'] == "addtime desc"):?>selected<?php endif;?>>按添加时间降序</option>
		<option value="byname desc" <?php if ($cate_main_other_search['sort'] == "byname desc"):?>selected<?php endif;?>>按首字母降序</option>
		<option value="byname asc" <?php if ($cate_main_other_search['sort'] == "byname asc"):?>selected<?php endif;?>>按首字母升序</option>
	</select>
</td>
<td>
	<select name="mlength" maxlength="20">
		<?php for($i=1;$i<=10;$i++){?>
			<option value="<?php echo $i;?>" <?php echo $cate_main_other_search['mlength'] ? $i==$cate_main_other_search['mlength'] : $i==5 ? "selected" : "";?>><?php echo $i;?></option>
		<?php }?>
	</select>
</td>
<td>
<input type="submit" value="确 定">
<input type="reset" value="重置"/>
</td>
</tr>
</form>
</tbody></table>
</div>
<div id="Tabs2" style="display:">
<div class="tt">类别列表页配置</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tbody>
<tr>
<th width="6%">模块</th>
<th width="4%">显示数目</th>
<th width="15%">显示条件</th>
<th width="40%">显示内容</th>
<th width="10%">排序(单选)</th>
<th width="7%">sphinx匹配度</th>
<th width="7%">操作</th>
</tr>
<form method="post" action="<?php echo site_url("my_menu/page_style/hot_search");?>">
<input type="hidden" name="mode" value="cate_hot_search"/>
<input type="hidden" name="in_page" value="cate_list"/>
<tr onmouseover="this.className=&#39;on&#39;;" onmouseout="this.className=&#39;&#39;;" align="center" class="">
<td>头部长尾词</td>
<td>
	<select name="limit" maxlength="20">
		<?php for($i=1;$i<=20;$i++){?>
			<option value="0,<?php echo $i;?>" <?php echo $chs_num ? $i==$chs_num : $i==10 ? "selected" : "";?>><?php echo $i;?></option>
		<?php }?>
	</select>
</td>
<td><input type="checkbox" name="cons" <?php if($cate_hot_search['conditions']):?>checked="checked"<?php endif;?> />必须类别相关</td>
<td style="text-align:left;padding-left:15px;"><input type="checkbox" name="is_item" <?php if($cate_hot_search['fields']):?>checked="checked" <?php endif;?>/>显示对应产品数<br/></td>
<td>
	<select name="orderby[]" maxlength="20" multiple="multiple">
		<option value="" <?php if ($cate_hot_search['sort']=="id asc" || !$cate_hot_search['sort']):?>selected<?php endif;?>>无限制</option>
		<option value="totalcc desc" <?php if ($cate_hot_search['sort'] == "totalcc desc"):?>selected<?php endif;?>>按总访问量降序</option>
		<option value="monthcc desc" <?php if ($cate_hot_search['sort'] == "monthcc desc"):?>selected<?php endif;?>>按月访问量降序</option>
		<option value="weekcc desc" <?php if ($cate_hot_search['sort'] == "weekcc desc"):?>selected<?php endif;?>>按周访问量降序</option>
		<option value="item desc" <?php if ($cate_hot_search['sort'] == "item desc"):?>selected<?php endif;?>>按产品数量降序</option>
		<option value="addtime desc" <?php if ($cate_hot_search['sort'] == "addtime desc"):?>selected<?php endif;?>>按添加时间降序</option>
		<option value="byname desc" <?php if ($cate_hot_search['sort'] == "byname desc"):?>selected<?php endif;?>>按首字母降序</option>
		<option value="byname asc" <?php if ($cate_hot_search['sort'] == "byname asc"):?>selected<?php endif;?>>按首字母升序</option>
	</select>
</td>
<td>
	<select name="mlength" maxlength="20">
		<?php for($i=1;$i<=10;$i++){?>
			<option value="<?php echo $i;?>" <?php echo $cate_hot_search['mlength'] ? $i==$cate_hot_search['mlength'] : $i==5 ? "selected" : "";?>><?php echo $i;?></option>
		<?php }?>
	</select>
</td>
<td>
<input type="submit" value="确 定">
<input type="reset" value="重置"/>
</td>
</tr>
</form>
<form method="post" action="<?php echo site_url("my_menu/page_style/catelist_set");?>">
<input type="hidden" name="mode" value="cates_list"/>
<input type="hidden" name="in_page" value="cate_list"/>
<tr onmouseover="this.className=&#39;on&#39;;" onmouseout="this.className=&#39;&#39;;" align="center" class="">
<td>产品类别列表</td>
<td>
<select name="limit" maxlength="20">
	<?php for($i=1;$i<=30;$i++){?>
		<option value="0,<?php echo $i;?>" <?php echo $cl_num ? $i==$cl_num : $i==20 ? "selected" : "";?>><?php echo $i;?></option>
	<?php }?>
</select>
</td>
<td></td>
<td style="text-align:left;padding-left:15px;"><input type="checkbox" name="is_item" <?php if($cates_list['fields']):?>checked="checked" <?php endif;?>/>显示对应产品数<br/></td>
<td></td>
<td></td>
<td>
<input type="submit" value="确 定">
<input type="reset" value="重置"/>
</td>
</tr>
</form>
<form method="post" action="<?php echo site_url("my_menu/page_style/attr_list");?>">
<input type="hidden" name="mode" value="cate_attr_list"/>
<input type="hidden" name="in_page" value="cate_list"/>
<tr onmouseover="this.className=&#39;on&#39;;" onmouseout="this.className=&#39;&#39;;" align="center" class="">
<td>产品属性列表</td>
<td>
	<select name="limit" maxlength="20">
		<?php for($i=1;$i<=50;$i++){?>
			<option value="0,<?php echo $i;?>" <?php echo $cal_num ? $i==$cal_num : $i==40 ? "selected" : "";?>><?php echo $i;?></option>
		<?php }?>
	</select>
</td>
<td></td>
<td></td>
<td></td>
<td>
</td>
<td>
<input type="submit" value="确 定">
<input type="reset" value="重置"/>
</td>
</tr>
</form>
<form method="post" action="<?php echo site_url("my_menu/page_style/sell_list");?>">
<input type="hidden" name="mode" value="cate_sell_list"/>
<input type="hidden" name="in_page" value="cate_list"/>
<tr onmouseover="this.className=&#39;on&#39;;" onmouseout="this.className=&#39;&#39;;" align="center" class="">
<td>产品分页列表</td>
<td>
	<select name="limit" maxlength="20">
		<?php for($i=1;$i<=30;$i++){?>
			<option value="0,<?php echo $i;?>" <?php echo $csl_num ? $i==$csl_num : $i==15 ? "selected" : "";?>><?php echo $i;?></option>
		<?php }?>
	</select>
</td>
<td>
</td>
<td style="text-align:left;padding-left:15px;">
<div class="sortable_cate_sell_list">
	<?php $i=0;?>
	<?php if ($csl_fields_tmp):?>
		<?php foreach ($csl_fields_tmp as $k=>$v):?>
		<?php $i++;?>
		<span onmouseover="tmove('sortable_cate_sell_list','cate_sell_list','cate_list')"><input class="ui-state-default"  type="checkbox" name="fields[]" id="<?php echo $k;?>" value="<?php echo $k;?>" checked="checked" /><?php echo substr($v,1);?><?php if ($i%10==0):?><br/><?php endif;?></span> 
		<?php endforeach;?>
		<?php if ($csl_fields_tmp1):?>
		<?php foreach ($csl_fields_tmp1 as $k=>$v):?>
		<?php $i++;?>
		<span onmouseover="tmove('sortable_cate_sell_list','cate_sell_list','cate_list')"><input class="ui-state-default"  type="checkbox" name="fields[]" id="<?php echo $k;?>" value="<?php echo $k;?>" /><?php echo substr($v,1);?><?php if ($i%10==0):?><br/><?php endif;?></span> 
		<?php endforeach;?>
		<?php endif;?>
	<?php else:?>
		<?php foreach ($sell_fields as $k=>$v):?>
		<?php $i++;?>
		<span onmouseover="tmove('sortable_cate_list_relate_sells','cate_sell_list','cate_list')"><input class="ui-state-default"  type="checkbox" name="fields[]" id="<?php echo $k;?>" value="<?php echo $k;?>" <?php if (in_array($k,$csl_fields)):?>checked="checked"<?php endif;?><?php if (substr($v,0,1) && !$csl_fields):?>checked="checked"<?php endif;?>/><?php echo substr($v,1);?><?php if ($i%10==0):?><br/><?php endif;?></span> 
		<?php endforeach;?>
	<?php endif;?>
	<br/>
</div>
</td>
<td>
	<select name="orderby[]" maxlength="20" multiple="multiple">
		<option value="" <?php if (!$cate_sell_list['sort']):?>selected<?php endif;?>>无限制</option>
		<option value="addtime desc" <?php if ($cate_sell_list['sort'] == "addtime desc"):?>selected<?php endif;?>>按发布时间降序</option>
		<option value="addtime asc" <?php if ($cate_sell_list['sort'] == "addtime asc"):?>selected<?php endif;?>>按发布时间升序</option>
		<option value="hits desc" <?php if ($cate_sell_list['sort'] == "hits desc"):?>selected<?php endif;?>>按产品访问量降序</option>
		<option value="level desc" <?php if ($cate_sell_list['sort'] == "level desc"):?>selected<?php endif;?>>按推荐等级降序</option>
		<option value="vip desc" <?php if ($cate_sell_list['sort'] == "vip desc"):?>selected<?php endif;?>>按VIP指数降序</option>
	</select>
</td>
<td>
</td>
<td>
<input type="submit" value="确 定">
<input type="reset" value="重置"/>
</td>
</tr>
</form>
<form method="post" action="<?php echo site_url("my_menu/page_style/sell_list");?>">
<input type="hidden" name="mode" value="cate_list_relate_sells"/>
<input type="hidden" name="in_page" value="cate_list"/>
<input type="hidden" name="orderby[]" value="addtime desc"/>
<tr onmouseover="this.className=&#39;on&#39;;" onmouseout="this.className=&#39;&#39;;" align="center" class="">
<td>相关产品列表</td>
<td>
	<select name="limit" maxlength="20">
		<?php for($i=1;$i<=20;$i++){?>
			<option value="0,<?php echo $i;?>" <?php echo $catelrs_num ? $i==$catelrs_num : $i==5 ? "selected" : "";?>><?php echo $i;?></option>
		<?php }?>
	</select>
</td>
<td></td>
<td style="text-align:left;padding-left:15px;">
	<div class="sortable_cate_list_relate_sells">
	<?php $i=0;?>
	<?php if ($catelrs_fields_tmp):?>
		<?php foreach ($catelrs_fields_tmp as $k=>$v):?>
		<?php $i++;?>
		<span onmouseover="tmove('sortable_cate_list_relate_sells','cate_list_relate_sells','cate_list')"><input class="ui-state-default"  type="checkbox" name="fields[]" id="<?php echo $k;?>" value="<?php echo $k;?>" checked="checked" /><?php echo substr($v,1);?><?php if ($i%10==0):?><br/><?php endif;?></span> 
		<?php endforeach;?>
		<?php if ($catelrs_fields_tmp1):?>
		<?php foreach ($catelrs_fields_tmp1 as $k=>$v):?>
		<?php $i++;?>
		<span onmouseover="tmove('sortable_cate_list_relate_sells','cate_list_relate_sells','cate_list')"><input class="ui-state-default"  type="checkbox" name="fields[]" id="<?php echo $k;?>" value="<?php echo $k;?>" /><?php echo substr($v,1);?><?php if ($i%10==0):?><br/><?php endif;?></span> 
		<?php endforeach;?>
		<?php endif;?>
	<?php else:?>
		<?php foreach ($sell_fields as $k=>$v):?>
		<?php $i++;?>
		<span onmouseover="tmove('sortable_cate_list_relate_sells','cate_list_relate_sells','cate_list')"><input class="ui-state-default"  type="checkbox" name="fields[]" id="<?php echo $k;?>" value="<?php echo $k;?>" <?php if (in_array($k,$catelrs_fields)):?>checked="checked"<?php endif;?><?php if (substr($v,0,1) && !$catelrs_fields):?>checked="checked"<?php endif;?>/><?php echo substr($v,1);?><?php if ($i%10==0):?><br/><?php endif;?></span> 
		<?php endforeach;?>
	<?php endif;?>
	<br/>
</div>
</td>
<td>
</td>
<td>
	<select name="mlength" maxlength="20">
		<?php for($i=1;$i<=10;$i++){?>
			<option value="<?php echo $i;?>" <?php echo $cate_list_relate_sells['mlength'] ? $i==$cate_list_relate_sells['mlength'] : $i==5 ? "selected" : "";?>><?php echo $i;?></option>
		<?php }?>
	</select>
</td>
<td>
<input type="submit" value="确 定">
<input type="reset" value="重置"/>
</td>
</tr>
</form>
<form method="post" action="<?php echo site_url("my_menu/page_style/hot_search");?>">
<input type="hidden" name="mode" value="cate_other_search"/>
<input type="hidden" name="in_page" value="cate_list"/>
<tr onmouseover="this.className=&#39;on&#39;;" onmouseout="this.className=&#39;&#39;;" align="center" class="">
<td>尾部长尾词</td>
<td>
	<select name="limit" maxlength="20">
		<?php for($i=1;$i<=20;$i++){?>
			<option value="<?php echo $chs_num ? $chs_num : 0;?>,<?php echo $i;?>" <?php echo $cateos_num ? $i==$cateos_num : $i==10 ? "selected" : "";?>><?php echo $i;?></option>
		<?php }?>
	</select>
</td>
<td><input type="checkbox" name="cons" <?php if($cate_other_search['conditions']):?>checked="checked"<?php endif;?> />必须类别相关</td>
<td style="text-align:left;padding-left:15px;"><input type="checkbox" name="is_item" <?php if($cate_other_search['fields']):?>checked="checked" <?php endif;?>/>显示对应产品数<br/></td>
<td>
	<select name="orderby[]" maxlength="20" multiple="multiple">
		<option value="" <?php if ($cate_other_search['sort']=="id asc" || !$cate_other_search['sort']):?>selected<?php endif;?>>无限制</option>
		<option value="totalcc desc" <?php if ($cate_other_search['sort'] == "totalcc desc"):?>selected<?php endif;?>>按总访问量降序</option>
		<option value="monthcc desc" <?php if ($cate_other_search['sort'] == "monthcc desc"):?>selected<?php endif;?>>按月访问量降序</option>
		<option value="weekcc desc" <?php if ($cate_other_search['sort'] == "weekcc desc"):?>selected<?php endif;?>>按周访问量降序</option>
		<option value="item desc" <?php if ($cate_other_search['sort'] == "item desc"):?>selected<?php endif;?>>按产品数量降序</option>
		<option value="addtime desc" <?php if ($cate_other_search['sort'] == "addtime desc"):?>selected<?php endif;?>>按添加时间降序</option>
		<option value="byname desc" <?php if ($cate_other_search['sort'] == "byname desc"):?>selected<?php endif;?>>按首字母降序</option>
		<option value="byname asc" <?php if ($cate_other_search['sort'] == "byname asc"):?>selected<?php endif;?>>按首字母升序</option>
	</select>
</td>
<td>
	<select name="mlength" maxlength="20">
		<?php for($i=1;$i<=10;$i++){?>
			<option value="<?php echo $i;?>" <?php echo $cate_other_search['mlength'] ? $i==$cate_other_search['mlength'] : $i==5 ? "selected" : "";?>><?php echo $i;?></option>
		<?php }?>
	</select>
</td>
<td>
<input type="submit" value="确 定">
<input type="reset" value="重置"/>
</td>
</tr>
</form>
</tbody></table>
</div>
<div id="Tabs3" style="display:">
<div class="tt">SEO页配置</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tbody>
<tr>
<th width="6%">模块</th>
<th width="4%">显示数目</th>
<th width="15%">显示条件</th>
<th width="40%">显示内容</th>
<th width="10%">排序(单选)</th>
<th width="7%">sphinx匹配度</th>
<th width="7%">操作</th>
</tr>
<form method="post" action="<?php echo site_url("my_menu/page_style/hot_search");?>">
<input type="hidden" name="mode" value="seo_hot_search"/>
<input type="hidden" name="in_page" value="seo_sell"/>
<tr onmouseover="this.className=&#39;on&#39;;" onmouseout="this.className=&#39;&#39;;" align="center" class="">
<td>头部长尾词</td>
<td>
	<select name="limit" maxlength="20">
		<?php for($i=1;$i<=20;$i++){?>
			<option value="0,<?php echo $i;?>" <?php echo $shs_num ? $i==$shs_num : $i==10 ? "selected" : "";?>><?php echo $i;?></option>
		<?php }?>
	</select>
</td>
<td><input type="checkbox" name="cons" <?php if($seo_hot_search['conditions']):?>checked="checked"<?php endif;?> />必须类别相关</td>
<td style="text-align:left;padding-left:15px;"><input type="checkbox" name="is_item" <?php if($seo_hot_search['fields']):?>checked="checked" <?php endif;?>/>显示对应产品数<br/></td>
<td>
	<select name="orderby[]" maxlength="20" multiple="multiple">
		<option value="" <?php if ($seo_hot_search['sort']=="id asc" || !$seo_hot_search['sort']):?>selected<?php endif;?>>无限制</option>
		<option value="totalcc desc" <?php if ($seo_hot_search['sort'] == "totalcc desc"):?>selected<?php endif;?>>按总访问量降序</option>
		<option value="monthcc desc" <?php if ($seo_hot_search['sort'] == "monthcc desc"):?>selected<?php endif;?>>按月访问量降序</option>
		<option value="weekcc desc" <?php if ($seo_hot_search['sort'] == "weekcc desc"):?>selected<?php endif;?>>按周访问量降序</option>
		<option value="item desc" <?php if ($seo_hot_search['sort'] == "item desc"):?>selected<?php endif;?>>按产品数量降序</option>
		<option value="addtime desc" <?php if ($seo_hot_search['sort'] == "addtime desc"):?>selected<?php endif;?>>按添加时间降序</option>
		<option value="byname desc" <?php if ($seo_hot_search['sort'] == "byname desc"):?>selected<?php endif;?>>按首字母降序</option>
		<option value="byname asc" <?php if ($seo_hot_search['sort'] == "byname asc"):?>selected<?php endif;?>>按首字母升序</option>
	</select>
</td>
<td>
	<select name="mlength" maxlength="20">
		<?php for($i=1;$i<=10;$i++){?>
			<option value="<?php echo $i;?>" <?php echo $seo_hot_search['mlength'] ? $i==$seo_hot_search['mlength'] : $i==5 ? "selected" : "";?>><?php echo $i;?></option>
		<?php }?>
	</select>
</td>
<td>
<input type="submit" value="确 定">
<input type="reset" value="重置"/>
</td>
</tr>
</form>
<form method="post" action="<?php echo site_url("my_menu/page_style/catelist_set");?>">
<input type="hidden" name="mode" value="seo_cate_list"/>
<input type="hidden" name="in_page" value="seo_sell"/>
<tr onmouseover="this.className=&#39;on&#39;;" onmouseout="this.className=&#39;&#39;;" align="center" class="">
<td>产品类别列表</td>
<td>
<select name="limit" maxlength="20">
	<?php for($i=1;$i<=30;$i++){?>
		<option value="0,<?php echo $i;?>" <?php echo $scl_num ? $i==$scl_num : $i==20 ? "selected" : "";?>><?php echo $i;?></option>
	<?php }?>
</select>
</td>
<td></td>
<td style="text-align:left;padding-left:15px;"><input type="checkbox" name="is_item" <?php if($seo_cate_list['fields']):?>checked="checked" <?php endif;?>/>显示对应产品数<br/></td>
<td></td>
<td></td>
<td>
<input type="submit" value="确 定">
<input type="reset" value="重置"/>
</td>
</tr>
</form>
<form method="post" action="<?php echo site_url("my_menu/page_style/attr_list");?>">
<input type="hidden" name="mode" value="seo_attr_list"/>
<input type="hidden" name="in_page" value="seo_sell"/>
<tr onmouseover="this.className=&#39;on&#39;;" onmouseout="this.className=&#39;&#39;;" align="center" class="">
<td>产品属性列表</td>
<td>
	<select name="limit" maxlength="20">
		<?php for($i=1;$i<=50;$i++){?>
			<option value="0,<?php echo $i;?>" <?php echo $sal_num ? $i==$sal_num : $i==40 ? "selected" : "";?>><?php echo $i;?></option>
		<?php }?>
	</select>
</td>
<td>
</td>
<td>
</td>
<td>
</td>
<td>
<select name="mlength" maxlength="20">
	<?php for($i=1;$i<=10;$i++){?>
		<option value="<?php echo $i;?>" <?php echo $seo_attr_list['mlength'] ? $i==$seo_attr_list['mlength'] : $i==5 ? "selected" : "";?>><?php echo $i;?></option>
	<?php }?>
</select>
</td>
<td>
<input type="submit" value="确 定">
<input type="reset" value="重置"/>
</td>
</tr>
</form>
<form method="post" action="<?php echo site_url("my_menu/page_style/sell_list");?>">
<input type="hidden" name="mode" value="seo_sell_list"/>
<input type="hidden" name="in_page" value="seo_sell"/>
<tr onmouseover="this.className=&#39;on&#39;;" onmouseout="this.className=&#39;&#39;;" align="center" class="">
<td>产品分页列表</td>
<td>
	<select name="limit" maxlength="20">
		<?php for($i=1;$i<=30;$i++){?>
			<option value="0,<?php echo $i;?>" <?php echo $ssl_num ? $i==$ssl_num : $i==15 ? "selected" : "";?>><?php echo $i;?></option>
		<?php }?>
	</select>
</td>
<td>
</td>
<td style="text-align:left;padding-left:15px;">
<div class="sortable_seo_sell_list">
	<?php $i=0;?>
	<?php if ($ssl_fields_tmp):?>
		<?php foreach ($ssl_fields_tmp as $k=>$v):?>
		<?php $i++;?>
		<span onmouseover="tmove('sortable_seo_sell_list','seo_sell_list','seo_sell')"><input class="ui-state-default"  type="checkbox" name="fields[]" id="<?php echo $k;?>" value="<?php echo $k;?>" checked="checked" /><?php echo substr($v,1);?><?php if ($i%10==0):?><br/><?php endif;?></span> 
		<?php endforeach;?>
		<?php if ($ssl_fields_tmp1):?>
		<?php foreach ($ssl_fields_tmp1 as $k=>$v):?>
		<?php $i++;?>
		<span onmouseover="tmove('sortable_seo_sell_list','seo_sell_list','seo_sell')"><input class="ui-state-default"  type="checkbox" name="fields[]" id="<?php echo $k;?>" value="<?php echo $k;?>" /><?php echo substr($v,1);?><?php if ($i%10==0):?><br/><?php endif;?></span> 
		<?php endforeach;?>
		<?php endif;?>
	<?php else:?>
		<?php foreach ($sell_fields as $k=>$v):?>
		<?php $i++;?>
		<span onmouseover="tmove('sortable_seo_sell_list','seo_sell_list','seo_sell')"><input class="ui-state-default"  type="checkbox" name="fields[]" id="<?php echo $k;?>" value="<?php echo $k;?>" <?php if (in_array($k,$ssl_fields)):?>checked="checked"<?php endif;?><?php if (substr($v,0,1) && !$ssl_fields):?>checked="checked"<?php endif;?>/><?php echo substr($v,1);?><?php if ($i%10==0):?><br/><?php endif;?></span> 
		<?php endforeach;?>
	<?php endif;?>
	<br/>
</div>
</td>
<td>
	<select name="orderby[]" maxlength="20" multiple="multiple">
		<option value="" <?php if (!$seo_sell_list['sort']):?>selected<?php endif;?>>无限制</option>
		<option value="addtime desc" <?php if ($seo_sell_list['sort'] == "addtime desc"):?>selected<?php endif;?>>按发布时间降序</option>
		<option value="addtime asc" <?php if ($seo_sell_list['sort'] == "addtime asc"):?>selected<?php endif;?>>按发布时间升序</option>
		<option value="hits desc" <?php if ($seo_sell_list['sort'] == "hits desc"):?>selected<?php endif;?>>按产品访问量降序</option>
		<option value="level desc" <?php if ($seo_sell_list['sort'] == "level desc"):?>selected<?php endif;?>>按推荐等级降序</option>
		<option value="vip desc" <?php if ($seo_sell_list['sort'] == "vip desc"):?>selected<?php endif;?>>按VIP指数降序</option>
	</select>
</td>
<td>
<select name="mlength" maxlength="20">
	<?php for($i=1;$i<=10;$i++){?>
		<option value="<?php echo $i;?>" <?php echo $seo_sell_list['mlength'] ? $i==$seo_sell_list['mlength'] : $i==5 ? "selected" : "";?>><?php echo $i;?></option>
	<?php }?>
</select>
</td>
<td>
<input type="submit" value="确 定">
<input type="reset" value="重置"/>
</td>
</tr>
</form>
<form method="post" action="<?php echo site_url("my_menu/page_style/hot_search");?>">
<input type="hidden" name="mode" value="seo_other_search"/>
<input type="hidden" name="in_page" value="seo_sell"/>
<tr onmouseover="this.className=&#39;on&#39;;" onmouseout="this.className=&#39;&#39;;" align="center" class="">
<td>尾部长尾词</td>
<td>
	<select name="limit" maxlength="20">
		<?php for($i=1;$i<=20;$i++){?>
			<option value="0,<?php echo $i;?>" <?php echo $sos_num ? $i==$sos_num : $i==10 ? "selected" : "";?>><?php echo $i;?></option>
		<?php }?>
	</select>
</td>
<td><input type="checkbox" name="cons" <?php if($seo_other_search['conditions']):?>checked="checked"<?php endif;?> />必须类别相关</td>
<td style="text-align:left;padding-left:15px;"><input type="checkbox" name="is_item" <?php if($seo_other_search['fields']):?>checked="checked" <?php endif;?>/>显示对应产品数<br/></td>
<td>
	<select name="orderby[]" maxlength="20" multiple="multiple">
		<option value="" <?php if ($seo_other_search['sort']=="id asc" || !$seo_other_search['sort']):?>selected<?php endif;?>>无限制</option>
		<option value="totalcc desc" <?php if ($seo_other_search['sort'] == "totalcc desc"):?>selected<?php endif;?>>按总访问量降序</option>
		<option value="monthcc desc" <?php if ($seo_other_search['sort'] == "monthcc desc"):?>selected<?php endif;?>>按月访问量降序</option>
		<option value="weekcc desc" <?php if ($seo_other_search['sort'] == "weekcc desc"):?>selected<?php endif;?>>按周访问量降序</option>
		<option value="item desc" <?php if ($seo_other_search['sort'] == "item desc"):?>selected<?php endif;?>>按产品数量降序</option>
		<option value="addtime desc" <?php if ($seo_other_search['sort'] == "addtime desc"):?>selected<?php endif;?>>按添加时间降序</option>
		<option value="byname desc" <?php if ($seo_other_search['sort'] == "byname desc"):?>selected<?php endif;?>>按首字母降序</option>
		<option value="byname asc" <?php if ($seo_other_search['sort'] == "byname asc"):?>selected<?php endif;?>>按首字母升序</option>
	</select>
</td>
<td>
	<select name="mlength" maxlength="20">
		<?php for($i=1;$i<=10;$i++){?>
			<option value="<?php echo $i;?>" <?php echo $seo_other_search['mlength'] ? $i==$seo_other_search['mlength'] : $i==5 ? "selected" : "";?>><?php echo $i;?></option>
		<?php }?>
	</select>
</td>
<td>
<input type="submit" value="确 定">
<input type="reset" value="重置"/>
</td>
</tr>
</form>
</tbody></table>
</div>

<div id="Tabs4" style="display:">
<div class="tt">产品详细页配置</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tbody>
<tr>
<th width="6%">模块</th>
<th width="4%">显示数目</th>
<th width="15%">显示条件</th>
<th width="40%">显示内容</th>
<th width="10%">排序(单选)</th>
<th width="7%">sphinx匹配度</th>
<th width="7%">操作</th>
</tr>
<form method="post" action="<?php echo site_url("my_menu/page_style/hot_search");?>">
<input type="hidden" name="mode" value="hot_search"/>
<input type="hidden" name="in_page" value="sell_detail"/>
<tr onmouseover="this.className=&#39;on&#39;;" onmouseout="this.className=&#39;&#39;;" align="center" class="">
<td>头部长尾词</td>
<td>
	<select name="limit" maxlength="20">
		<?php for($i=1;$i<=20;$i++){?>
			<option value="0,<?php echo $i;?>" <?php echo $hs_num ? $i==$hs_num : $i==10 ? "selected" : "";?>><?php echo $i;?></option>
		<?php }?>
	</select>
</td>
<td><input type="checkbox" name="cons" <?php if($hot_search['conditions']):?>value="1" checked="checked"<?php else:?>value="0"<?php endif;?> />必须类别相关</td>
<td style="text-align:left;padding-left:15px;"><input type="checkbox" name="is_item" <?php if($hot_search['fields']):?>value="1" checked="checked"<?php else:?>value="0"<?php endif;?>/>显示对应产品数<br/></td>
<td>
	<select name="orderby[]" maxlength="20" multiple="multiple">
		<option value="" <?php if ($hot_search['sort']=="id asc" || !$hot_search['sort']):?>selected<?php endif;?>>无限制</option>
		<option value="totalcc desc" <?php if ($hot_search['sort'] == "totalcc desc"):?>selected<?php endif;?>>按总访问量降序</option>
		<option value="monthcc desc" <?php if ($hot_search['sort'] == "monthcc desc"):?>selected<?php endif;?>>按月访问量降序</option>
		<option value="weekcc desc" <?php if ($hot_search['sort'] == "weekcc desc"):?>selected<?php endif;?>>按周访问量降序</option>
		<option value="item desc" <?php if ($hot_search['sort'] == "item desc"):?>selected<?php endif;?>>按产品数量降序</option>
		<option value="addtime desc" <?php if ($hot_search['sort'] == "addtime desc"):?>selected<?php endif;?>>按添加时间降序</option>
		<option value="byname desc" <?php if ($hot_search['sort'] == "byname desc"):?>selected<?php endif;?>>按首字母降序</option>
		<option value="byname asc" <?php if ($hot_search['sort'] == "byname asc"):?>selected<?php endif;?>>按首字母升序</option>
	</select>
</td>
<td>
	<select name="mlength" maxlength="20">
		<?php for($i=1;$i<=10;$i++){?>
			<option value="<?php echo $i;?>" <?php echo $hot_search['mlength'] ? $i==$hot_search['mlength'] : $i==5 ? "selected" : "";?>><?php echo $i;?></option>
		<?php }?>
	</select>
</td>
<td>
<input type="submit" value="确 定">
<input type="reset" value="重置"/>
</td>
</tr>
</form>
<form method="post" action="<?php echo site_url("my_menu/page_style/sell_list");?>">
<input type="hidden" name="mode" value="com_other_sells"/>
<input type="hidden" name="in_page" value="sell_detail"/>
<tr onmouseover="this.className=&#39;on&#39;;" onmouseout="this.className=&#39;&#39;;" align="center" class="">
<td>公司其他产品列表</td>
<td>
	<select name="limit" maxlength="20">
		<?php for($i=1;$i<=10;$i++){?>
			<option value="0,<?php echo $i;?>" <?php echo $cos_num ? $i==$cos_num : $i==5 ? "selected" : "";?>><?php echo $i;?></option>
		<?php }?>
	</select>
</td>
<td>
	<input type="checkbox" name="cons[]" value="thumb" <?php if (in_array("thumb", $cos_conditions)):?>checked="checked"<?php endif;?>/>必须有产品图片 
	<input type="checkbox" name="cons[]" value="vip" <?php if (in_array("vip", $cos_conditions)):?>checked="checked"<?php endif;?>/>必须有VIP指数<br/>
	<input type="checkbox" name="cons[]" value="minprice" <?php if (in_array("minprice", $cos_conditions)):?>checked="checked"<?php endif;?>/>必须有产品价格 
	<input type="checkbox" name="cons[]" value="elite" <?php if (in_array("elite", $cos_conditions)):?>checked="checked"<?php endif;?>/>必须是用户推荐<br/>
</td>
<td style="text-align:left;padding-left:15px;">
	<div class="sortable_com_other_sells">
	<?php $i=0;?>
	<?php if ($cos_fields_tmp):?>
		<?php foreach ($cos_fields_tmp as $k=>$v):?>
		<?php $i++;?>
		<span onmouseover="tmove('sortable_com_other_sells','com_other_sells','sell_detail')"><input class="ui-state-default"  type="checkbox" name="fields[]" id="<?php echo $k;?>" value="<?php echo $k;?>" checked="checked" /><?php echo substr($v,1);?><?php if ($i%10==0):?><br/><?php endif;?></span> 
		<?php endforeach;?>
		<?php if ($cos_fields_tmp1):?>
		<?php foreach ($cos_fields_tmp1 as $k=>$v):?>
		<?php $i++;?>
		<span onmouseover="tmove('sortable_com_other_sells','com_other_sells','sell_detail')"><input class="ui-state-default"  type="checkbox" name="fields[]" id="<?php echo $k;?>" value="<?php echo $k;?>" /><?php echo substr($v,1);?><?php if ($i%10==0):?><br/><?php endif;?></span> 
		<?php endforeach;?>
		<?php endif;?>
	<?php else:?>
		<?php foreach ($sell_fields as $k=>$v):?>
		<?php $i++;?>
		<span onmouseover="tmove('sortable_com_other_sells','com_other_sells','sell_detail')"><input class="ui-state-default"  type="checkbox" name="fields[]" id="<?php echo $k;?>" value="<?php echo $k;?>" <?php if (in_array($k,$cos_fields)):?>checked="checked"<?php endif;?><?php if (substr($v,0,1) && !$cos_fields):?>checked="checked"<?php endif;?>/><?php echo substr($v,1);?><?php if ($i%10==0):?><br/><?php endif;?></span> 
		<?php endforeach;?>
	<?php endif;?>
	<br/>
</div>
</td>
<td>
	<select name="orderby[]" maxlength="20" multiple="multiple">
		<option value="" <?php if (!$com_other_sells['sort']):?>selected<?php endif;?>>无限制</option>
		<option value="addtime desc" <?php if ($com_other_sells['sort'] == "addtime desc"):?>selected<?php endif;?>>按发布时间降序</option>
		<option value="addtime asc" <?php if ($com_other_sells['sort'] == "addtime asc"):?>selected<?php endif;?>>按发布时间升序</option>
		<option value="hits desc" <?php if ($com_other_sells['sort'] == "hits desc"):?>selected<?php endif;?>>按产品访问量降序</option>
		<option value="level desc" <?php if ($com_other_sells['sort'] == "level desc"):?>selected<?php endif;?>>按推荐等级降序</option>
		<option value="vip desc" <?php if ($com_other_sells['sort'] == "vip desc"):?>selected<?php endif;?>>按VIP指数降序</option>
	</select>
</td>
<td>
	<select name="mlength" maxlength="20">
		<?php for($i=1;$i<=10;$i++){?>
			<option value="<?php echo $i;?>" <?php echo $com_other_sells['mlength'] ? $i==$com_other_sells['mlength'] : $i==5 ? "selected" : "";?>><?php echo $i;?></option>
		<?php }?>
	</select>
</td>
<td>
<input type="submit" value="确 定">
<input type="reset" value="重置"/>
</td>
</tr>
</form>
<form method="post" action="<?php echo site_url("my_menu/page_style/pros_vs");?>">
<input type="hidden" name="mode" value="pros_vs"/>
<input type="hidden" name="in_page" value="sell_detail"/>
<tr onmouseover="this.className=&#39;on&#39;;" onmouseout="this.className=&#39;&#39;;" align="center" class="">
<td>产品对比 VS</td>
<td>
产品个数:
	<select name="limit1" maxlength="20">
		<?php for($i=1;$i<=10;$i++){?>
			<option value="0,<?php echo $i;?>" <?php echo $pv_num1 ? $i==$pv_num1 : $i==5 ? "selected" : "";?>><?php echo $i;?></option>
		<?php }?>
	</select>
	<br />
属性个数:
	<select name="limit2" maxlength="20">
		<?php for($i=1;$i<=10;$i++){?>
			<option value="0,<?php echo $i;?>" <?php echo $pv_num2 ? $i==$pv_num2 : $i==10 ? "selected" : "";?>><?php echo $i;?></option>
		<?php }?>
	</select>
</td>
<td>
</td>
<td style="text-align:left;padding-left:15px;">
	
</td>
<td>
	<select name="orderby[]" maxlength="20" multiple="multiple">
		<option value="" <?php if (!$pros_vs['sort']):?>selected<?php endif;?>>无限制</option>
		<option value="addtime desc" <?php if ($pros_vs['sort'] == "addtime desc"):?>selected<?php endif;?>>按发布时间降序</option>
		<option value="addtime asc" <?php if ($pros_vs['sort'] == "addtime asc"):?>selected<?php endif;?>>按发布时间升序</option>
		<option value="hits desc" <?php if ($pros_vs['sort'] == "hits desc"):?>selected<?php endif;?>>按产品访问量降序</option>
		<option value="level desc" <?php if ($pros_vs['sort'] == "level desc"):?>selected<?php endif;?>>按推荐等级降序</option>
		<option value="vip desc" <?php if ($pros_vs['sort'] == "vip desc"):?>selected<?php endif;?>>按VIP指数降序</option>
	</select>
</td>
<td>
	<select name="mlength" maxlength="20">
		<?php for($i=1;$i<=10;$i++){?>
			<option value="<?php echo $i;?>" <?php echo $pros_vs['mlength'] ? $i==$pros_vs['mlength'] : $i==5 ? "selected" : "";?>><?php echo $i;?></option>
		<?php }?>
	</select>
</td>
<td>
<input type="submit" value="确 定">
<input type="reset" value="重置"/>
</td>
</tr>
</form>
<form method="post" action="<?php echo site_url("my_menu/page_style/com_intro");?>">
<input type="hidden" name="mode" value="com_intro"/>
<input type="hidden" name="in_page" value="sell_detail"/>
<tr onmouseover="this.className=&#39;on&#39;;" onmouseout="this.className=&#39;&#39;;" align="center" class="">
<td>产品简介配置</td>
<td></td>
<td></td>
<td style="text-align:left; padding-left:15px;">
<div class="sortable_com_intro">
	<?php $i=0;?>
	<?php if ($cominfo_fields_tmp):?>
		<?php foreach ($cominfo_fields_tmp as $k=>$v):?>
		<?php $i++;?>
		<span onmouseover="tmove('sortable_com_intro','com_intro','sell_detail')"><input class="ui-state-default"  type="checkbox" name="intro_fields[]" id="<?php echo $k;?>" value="<?php echo $k;?>" checked="checked" /><?php echo substr($v,1);?><?php if ($i%10==0):?><br/><?php endif;?></span> 
		<?php endforeach;?>
		<?php if ($cominfo_fields_tmp1):?>
		<?php foreach ($cominfo_fields_tmp1 as $k=>$v):?>
		<?php $i++;?>
		<span onmouseover="tmove('sortable_com_intro','com_intro','sell_detail')"><input class="ui-state-default"  type="checkbox" name="intro_fields[]" id="<?php echo $k;?>" value="<?php echo $k;?>" /><?php echo substr($v,1);?><?php if ($i%10==0):?><br/><?php endif;?></span> 
		<?php endforeach;?>
		<?php endif;?>
	<?php else:?>
		<?php foreach ($corp_info_fields as $k=>$v):?>
		<?php $i++;?>
		<span onmouseover="tmove('sortable_com_intro','com_intro','sell_detail')"><input class="ui-state-default"  type="checkbox" name="intro_fields[]" id="<?php echo $k;?>" value="<?php echo $k;?>" <?php if (in_array($k,$cominfo_fields)):?>checked="checked"<?php endif;?><?php if (substr($v,0,1) && !$cominfo_fields):?>checked="checked"<?php endif;?>/><?php echo substr($v,1);?><?php if ($i%10==0):?><br/><?php endif;?></span> 
		<?php endforeach;?>
	<?php endif;?>
	<br/>
</div>
</td>
<td></td>
<td></td>
<td>
<input type="submit" value="确 定">
<input type="reset" value="重置"/>
</td>
</tr>
</form>
<form method="post" action="<?php echo site_url("my_menu/page_style/com_intro");?>">
<input type="hidden" name="mode" value="com_intro_right"/>
<input type="hidden" name="in_page" value="sell_detail"/>
<tr onmouseover="this.className=&#39;on&#39;;" onmouseout="this.className=&#39;&#39;;" align="center" class="">
<td>公司简介配置</td>
<td></td>
<td></td>
<td style="text-align:left; padding-left:15px;">
<div class="sortable_com_intro_right">
	<?php $i=0;?>
	<?php if ($cominfo_r_fields_tmp):?>
		<?php foreach ($cominfo_r_fields_tmp as $k=>$v):?>
		<?php $i++;?>
		<span onmouseover="tmove('sortable_com_intro_right','com_intro_right','sell_detail')"><input class="ui-state-default"  type="checkbox" name="intro_fields[]" id="<?php echo $k;?>" value="<?php echo $k;?>" checked="checked" /><?php echo substr($v,1);?><?php if ($i%10==0):?><br/><?php endif;?></span> 
		<?php endforeach;?>
		<?php if ($cominfo_r_fields_tmp1):?>
		<?php foreach ($cominfo_r_fields_tmp1 as $k=>$v):?>
		<?php $i++;?>
		<span onmouseover="tmove('sortable_com_intro_right','com_intro_right','sell_detail')"><input class="ui-state-default"  type="checkbox" name="intro_fields[]" id="<?php echo $k;?>" value="<?php echo $k;?>" /><?php echo substr($v,1);?><?php if ($i%10==0):?><br/><?php endif;?></span> 
		<?php endforeach;?>
		<?php endif;?>
	<?php else:?>
		<?php foreach ($corp_main_fields as $k=>$v):?>
		<?php $i++;?>
		<span onmouseover="tmove('sortable_com_intro_right','com_intro_right','sell_detail')"><input class="ui-state-default"  type="checkbox" name="intro_fields[]" id="<?php echo $k;?>" value="<?php echo $k;?>" <?php if (in_array($k,$cominfo_r_fields)):?>checked="checked"<?php endif;?><?php if (substr($v,0,1) && !$cominfo_r_fields):?>checked="checked"<?php endif;?>/><?php echo substr($v,1);?><?php if ($i%10==0):?><br/><?php endif;?></span> 
		<?php endforeach;?>
	<?php endif;?>
	<br/>
</div>
</td>
<td></td>
<td></td>
<td>
<input type="submit" value="确 定">
<input type="reset" value="重置"/>
</td>
</tr>
</form>
<form method="post" action="<?php echo site_url("my_menu/page_style/hot_search");?>">
<input type="hidden" name="mode" value="sell_detail_other_search"/>
<input type="hidden" name="in_page" value="sell_detail"/>
<tr onmouseover="this.className=&#39;on&#39;;" onmouseout="this.className=&#39;&#39;;" align="center" class="">
<td>尾部长尾词</td>
<td>
	<select name="limit" maxlength="20">
		<?php for($i=1;$i<=20;$i++){?>
			<option value="<?php echo $hs_num ? $hs_num : 0;?>,<?php echo $i;?>" <?php echo $sdos_num ? $i==$sdos_num : $i==10 ? "selected" : "";?>><?php echo $i;?></option>
		<?php }?>
	</select>
</td>
<td><input type="checkbox" name="cons" <?php if($sell_detail_other_search['conditions']):?>checked="checked"<?php endif;?> />必须类别相关</td>
<td style="text-align:left;padding-left:15px;"><input type="checkbox" name="is_item" <?php if($sell_detail_other_search['fields']):?>checked="checked" <?php endif;?>/>显示对应产品数<br/></td>
<td>
	<select name="orderby[]" maxlength="20" multiple="multiple">
		<option value="" <?php if ($sell_detail_other_search['sort']=="id asc" || !$sell_detail_other_search['sort']):?>selected<?php endif;?>>无限制</option>
		<option value="totalcc desc" <?php if ($sell_detail_other_search['sort'] == "totalcc desc"):?>selected<?php endif;?>>按总访问量降序</option>
		<option value="monthcc desc" <?php if ($sell_detail_other_search['sort'] == "monthcc desc"):?>selected<?php endif;?>>按月访问量降序</option>
		<option value="weekcc desc" <?php if ($sell_detail_other_search['sort'] == "weekcc desc"):?>selected<?php endif;?>>按周访问量降序</option>
		<option value="item desc" <?php if ($sell_detail_other_search['sort'] == "item desc"):?>selected<?php endif;?>>按产品数量降序</option>
		<option value="addtime desc" <?php if ($sell_detail_other_search['sort'] == "addtime desc"):?>selected<?php endif;?>>按添加时间降序</option>
		<option value="byname desc" <?php if ($sell_detail_other_search['sort'] == "byname desc"):?>selected<?php endif;?>>按首字母降序</option>
		<option value="byname asc" <?php if ($sell_detail_other_search['sort'] == "byname asc"):?>selected<?php endif;?>>按首字母升序</option>
	</select>
</td>
<td>
	<select name="mlength" maxlength="20">
		<?php for($i=1;$i<=10;$i++){?>
			<option value="<?php echo $i;?>" <?php echo $sell_detail_other_search['mlength'] ? $i==$sell_detail_other_search['mlength'] : $i==5 ? "selected" : "";?>><?php echo $i;?></option>
		<?php }?>
	</select>
</td>
<td>
<input type="submit" value="确 定">
<input type="reset" value="重置"/>
</td>
</tr>
</form>
</tbody></table>
</div>


<div id="Tabs5" style="display:">
<div class="tt">公司页配置</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tbody>
<tr>
<th width="6%">模块</th>
<th width="4%">显示数目</th>
<th width="15%">显示条件</th>
<th width="40%">显示内容</th>
<th width="10%">排序(单选)</th>
<th width="7%">sphinx匹配度</th>
<th width="7%">操作</th>
</tr>
<form method="post" action="<?php echo site_url("my_menu/page_style/hot_search");?>">
<input type="hidden" name="mode" value="com_main_hot_search"/>
<input type="hidden" name="in_page" value="com_main"/>
<tr onmouseover="this.className=&#39;on&#39;;" onmouseout="this.className=&#39;&#39;;" align="center" class="">
<td>头部长尾词</td>
<td>
	<select name="limit" maxlength="20">
		<?php for($i=1;$i<=20;$i++){?>
			<option value="0,<?php echo $i;?>" <?php echo $commhs_num ? $i==$commhs_num : $i==10 ? "selected" : "";?>><?php echo $i;?></option>
		<?php }?>
	</select>
</td>
<td><input type="checkbox" name="cons" <?php if($com_main_hot_search['conditions']):?>checked="checked"<?php endif;?> />必须类别相关</td>
<td style="text-align:left;padding-left:15px;"><input type="checkbox" name="is_item" <?php if($com_main_hot_search['fields']):?>checked="checked" <?php endif;?>/>显示对应产品数<br/></td>
<td>
	<select name="orderby[]" maxlength="20" multiple="multiple">
		<option value="" <?php if ($com_main_hot_search['sort']=="id asc" || !$com_main_hot_search['sort']):?>selected<?php endif;?>>无限制</option>
		<option value="totalcc desc" <?php if ($com_main_hot_search['sort'] == "totalcc desc"):?>selected<?php endif;?>>按总访问量降序</option>
		<option value="monthcc desc" <?php if ($com_main_hot_search['sort'] == "monthcc desc"):?>selected<?php endif;?>>按月访问量降序</option>
		<option value="weekcc desc" <?php if ($com_main_hot_search['sort'] == "weekcc desc"):?>selected<?php endif;?>>按周访问量降序</option>
		<option value="item desc" <?php if ($com_main_hot_search['sort'] == "item desc"):?>selected<?php endif;?>>按产品数量降序</option>
		<option value="addtime desc" <?php if ($com_main_hot_search['sort'] == "addtime desc"):?>selected<?php endif;?>>按添加时间降序</option>
		<option value="byname desc" <?php if ($com_main_hot_search['sort'] == "byname desc"):?>selected<?php endif;?>>按首字母降序</option>
		<option value="byname asc" <?php if ($com_main_hot_search['sort'] == "byname asc"):?>selected<?php endif;?>>按首字母升序</option>
	</select>
</td>
<td>
	<select name="mlength" maxlength="20">
		<?php for($i=1;$i<=10;$i++){?>
			<option value="<?php echo $i;?>" <?php echo $com_main_hot_search['mlength'] ? $i==$com_main_hot_search['mlength'] : $i==5 ? "selected" : "";?>><?php echo $i;?></option>
		<?php }?>
	</select>
</td>
<td>
<input type="submit" value="确 定">
<input type="reset" value="重置"/>
</td>
</tr>
</form>
<form method="post" action="<?php echo site_url("my_menu/page_style/sell_list");?>">
<input type="hidden" name="mode" value="com_main_sell_list"/>
<input type="hidden" name="in_page" value="com_main"/>
<tr onmouseover="this.className=&#39;on&#39;;" onmouseout="this.className=&#39;&#39;;" align="center" class="">
<td>公司产品分页列表</td>
<td>
	<select name="limit" maxlength="20">
		<?php for($i=1;$i<=30;$i++){?>
			<option value="0,<?php echo $i;?>" <?php echo $cms_num ? $i==$cms_num : $i==15 ? "selected" : "";?>><?php echo $i;?></option>
		<?php }?>
	</select>
</td>
<td>
	<input type="checkbox" name="cons[]" value="thumb" <?php if (in_array("thumb", $cms_conditions)):?>checked="checked"<?php endif;?>/>必须有产品图片 
	<input type="checkbox" name="cons[]" value="vip" <?php if (in_array("vip", $cms_conditions)):?>checked="checked"<?php endif;?>/>必须有VIP指数<br/>
	<input type="checkbox" name="cons[]" value="minprice" <?php if (in_array("minprice", $cms_conditions)):?>checked="checked"<?php endif;?>/>必须有产品价格 
	<input type="checkbox" name="cons[]" value="elite" <?php if (in_array("elite", $cms_conditions)):?>checked="checked"<?php endif;?>/>必须是用户推荐<br/>
</td>
<td style="text-align:left;padding-left:15px;">
<div class="sortable_com_main_sell_list">
	<?php $i=0;?>
	<?php if ($cms_fields_tmp):?>
		<?php foreach ($cms_fields_tmp as $k=>$v):?>
		<?php $i++;?>
		<span onmouseover="tmove('sortable_com_main_sell_list','com_main_sell_list','com_main')"><input class="ui-state-default"  type="checkbox" name="fields[]" id="<?php echo $k;?>" value="<?php echo $k;?>" checked="checked" /><?php echo substr($v,1);?><?php if ($i%10==0):?><br/><?php endif;?></span> 
		<?php endforeach;?>
		<?php if ($cms_fields_tmp1):?>
		<?php foreach ($cms_fields_tmp1 as $k=>$v):?>
		<?php $i++;?>
		<span onmouseover="tmove('sortable_com_main_sell_list','com_main_sell_list','com_main')"><input class="ui-state-default"  type="checkbox" name="fields[]" id="<?php echo $k;?>" value="<?php echo $k;?>" /><?php echo substr($v,1);?><?php if ($i%10==0):?><br/><?php endif;?></span> 
		<?php endforeach;?>
		<?php endif;?>
	<?php else:?>
		<?php foreach ($sell_fields as $k=>$v):?>
		<?php $i++;?>
		<span onmouseover="tmove('sortable_com_main_sell_list','com_main_sell_list','com_main')"><input class="ui-state-default"  type="checkbox" name="fields[]" id="<?php echo $k;?>" value="<?php echo $k;?>" <?php if (in_array($k,$cms_fields)):?>checked="checked"<?php endif;?><?php if (substr($v,0,1) && !$cms_fields):?>checked="checked"<?php endif;?>/><?php echo substr($v,1);?><?php if ($i%10==0):?><br/><?php endif;?></span> 
		<?php endforeach;?>
	<?php endif;?>
	<br/>
</div>
</td>
<td>
	<select name="orderby[]" maxlength="20" multiple="multiple">
		<option value="" <?php if (!$com_main_sell_list['sort']):?>selected<?php endif;?>>无限制</option>
		<option value="addtime desc" <?php if ($com_main_sell_list['sort'] == "addtime desc"):?>selected<?php endif;?>>按发布时间降序</option>
		<option value="addtime asc" <?php if ($com_main_sell_list['sort'] == "addtime asc"):?>selected<?php endif;?>>按发布时间升序</option>
		<option value="hits desc" <?php if ($com_main_sell_list['sort'] == "hits desc"):?>selected<?php endif;?>>按产品访问量降序</option>
		<option value="level desc" <?php if ($com_main_sell_list['sort'] == "level desc"):?>selected<?php endif;?>>按推荐等级降序</option>
		<option value="vip desc" <?php if ($com_main_sell_list['sort'] == "vip desc"):?>selected<?php endif;?>>按VIP指数降序</option>
	</select>
</td>
<td>
</td>
<td>
<input type="submit" value="确 定">
<input type="reset" value="重置"/>
</td>
</tr>
</form>
<form method="post" action="<?php echo site_url("my_menu/page_style/sell_list");?>">
<input type="hidden" name="mode" value="com_main_new_sells"/>
<input type="hidden" name="in_page" value="com_main"/>
<input type="hidden" name="orderby[]" value="addtime desc"/>
<tr onmouseover="this.className=&#39;on&#39;;" onmouseout="this.className=&#39;&#39;;" align="center" class="">
<td>公司最新产品列表</td>
<td>
	<select name="limit" maxlength="20">
		<?php for($i=1;$i<=40;$i++){?>
			<option value="0,<?php echo $i;?>" <?php echo $cmns_num ? $i==$cmns_num : $i==5 ? "selected" : "";?>><?php echo $i;?></option>
		<?php }?>
	</select>
</td>
<td>
	<input type="checkbox" name="cons[]" value="thumb" <?php if (in_array("thumb", $cmns_conditions)):?>checked="checked"<?php endif;?>/>必须有产品图片 
	<input type="checkbox" name="cons[]" value="vip" <?php if (in_array("vip", $cmns_conditions)):?>checked="checked"<?php endif;?>/>必须有VIP指数<br/>
	<input type="checkbox" name="cons[]" value="minprice" <?php if (in_array("minprice", $cmns_conditions)):?>checked="checked"<?php endif;?>/>必须有产品价格 
	<input type="checkbox" name="cons[]" value="elite" <?php if (in_array("elite", $cmns_conditions)):?>checked="checked"<?php endif;?>/>必须是用户推荐<br/>
</td>
<td style="text-align:left;padding-left:15px;">
<div class="sortable_com_main_new_sells">
	<?php $i=0;?>
	<?php if ($cmns_fields_tmp):?>
		<?php foreach ($cmns_fields_tmp as $k=>$v):?>
		<?php $i++;?>
		<span onmouseover="tmove('sortable_com_main_new_sells','com_main_new_sells','com_main')"><input class="ui-state-default"  type="checkbox" name="fields[]" id="<?php echo $k;?>" value="<?php echo $k;?>" checked="checked" /><?php echo substr($v,1);?><?php if ($i%10==0):?><br/><?php endif;?></span> 
		<?php endforeach;?>
		<?php if ($cmns_fields_tmp1):?>
		<?php foreach ($cmns_fields_tmp1 as $k=>$v):?>
		<?php $i++;?>
		<span onmouseover="tmove('sortable_com_main_new_sells','com_main_new_sells','com_main')"><input class="ui-state-default"  type="checkbox" name="fields[]" id="<?php echo $k;?>" value="<?php echo $k;?>" /><?php echo substr($v,1);?><?php if ($i%10==0):?><br/><?php endif;?></span> 
		<?php endforeach;?>
		<?php endif;?>
	<?php else:?>
		<?php foreach ($sell_fields as $k=>$v):?>
		<?php $i++;?>
		<span onmouseover="tmove('sortable_com_main_new_sells','com_main_new_sells','com_main')"><input class="ui-state-default"  type="checkbox" name="fields[]" id="<?php echo $k;?>" value="<?php echo $k;?>" <?php if (in_array($k,$cmns_fields)):?>checked="checked"<?php endif;?><?php if (substr($v,0,1) && !$cmns_fields):?>checked="checked"<?php endif;?>/><?php echo substr($v,1);?><?php if ($i%10==0):?><br/><?php endif;?></span> 
		<?php endforeach;?>
	<?php endif;?>
	<br/>
</div>
</td>
<td>
</td>
<td>
</td>
<td>
<input type="submit" value="确 定">
<input type="reset" value="重置"/>
</td>
</tr>
</form>
<form method="post" action="<?php echo site_url("my_menu/page_style/com_main_intro");?>">
<input type="hidden" name="mode" value="com_main_intro"/>
<input type="hidden" name="in_page" value="com_main"/>
<tr onmouseover="this.className=&#39;on&#39;;" onmouseout="this.className=&#39;&#39;;" align="center" class="">
<td>公司简介配置</td>
<td></td>
<td></td>
<td style="text-align:left; padding-left:15px;">
<div class="sortable_com_main_intro">
	<?php $i=0;?>
	<?php if ($cmintro_fields_tmp):?>
		<?php foreach ($cmintro_fields_tmp as $k=>$v):?>
		<?php $i++;?>
		<span onmouseover="tmove('sortable_com_main_intro','com_main_intro','com_main')"><input class="ui-state-default"  type="checkbox" name="intro_fields[]" id="<?php echo $k;?>" value="<?php echo $k;?>" checked="checked" /><?php echo substr($v,1);?><?php if ($i%10==0):?><br/><?php endif;?></span> 
		<?php endforeach;?>
		<?php if ($cmintro_fields_tmp1):?>
		<?php foreach ($cmintro_fields_tmp1 as $k=>$v):?>
		<?php $i++;?>
		<span onmouseover="tmove('sortable_com_main_intro','com_main_intro','com_main')"><input class="ui-state-default"  type="checkbox" name="intro_fields[]" id="<?php echo $k;?>" value="<?php echo $k;?>" /><?php echo substr($v,1);?><?php if ($i%10==0):?><br/><?php endif;?></span> 
		<?php endforeach;?>
		<?php endif;?>
	<?php else:?>
		<?php foreach ($corp_main_fields as $k=>$v):?>
		<?php $i++;?>
		<span onmouseover="tmove('sortable_com_main_intro','com_main_intro','com_main')"><input class="ui-state-default"  type="checkbox" name="intro_fields[]" id="<?php echo $k;?>" value="<?php echo $k;?>" <?php if (in_array($k,$cmintro_fields)):?>checked="checked"<?php endif;?><?php if (substr($v,0,1) && !$cmintro_fields):?>checked="checked"<?php endif;?>/><?php echo substr($v,1);?><?php if ($i%10==0):?><br/><?php endif;?></span> 
		<?php endforeach;?>
	<?php endif;?>
	<br/>
</div>
</td>

<td></td>
<td></td>
<td>
<input type="submit" value="确 定">
<input type="reset" value="重置"/>
</td>
</tr>
</form>
<form method="post" action="<?php echo site_url("my_menu/page_style/com_main_cate");?>">
<input type="hidden" name="mode" value="com_main_cate"/>
<input type="hidden" name="in_page" value="com_main"/>
<tr onmouseover="this.className=&#39;on&#39;;" onmouseout="this.className=&#39;&#39;;" align="center" class="">
<td>公司类别配置</td>
<td>
<select name="limit" maxlength="20">
	<?php for($i=1;$i<=30;$i++){?>
		<option value="0,<?php echo $i;?>" <?php echo $cmi_num ? $i==$cmi_num : $i==20 ? "selected" : "";?>><?php echo $i;?></option>
	<?php }?>
</select>
</td>
<td></td>
<td style="text-align:left;padding-left:15px;"><input type="checkbox" name="is_item" <?php if($com_main_cate['fields']):?>checked="checked" <?php endif;?>/>显示对应产品数<br/></td>
<td></td>
<td></td>
<td>
<input type="submit" value="确 定">
<input type="reset" value="重置"/>
</td>
</tr>
</form>
</tbody></table>
</div>
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />

</body></html>