<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>管理中心 - 中国水泵网 - Powered By DESTOON B2B V5.0 R20130606</title>
<meta name="robots" content="noindex,nofollow">
<script type="text/javascript">window.onerror= function(){return true;}</script>
<link rel="stylesheet" href="<?php echo base_url("skin/css/style.css")?>" type="text/css">
<script type="text/javascript" src="<?php echo base_url("skin/js/lang.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/config.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/jquery.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/common.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/admin.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/color.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/ae.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/jquery-1.4.js")?>"></script>
<SCRIPT type="text/javascript">
</SCRIPT>
<style type="text/css">.color_div_o {width:16px;height:16px;padding:4px 0 0 4px;background:#B6BDD2;cursor:crosshair;}.color_div_t {width:16px;height:16px;padding:4px 0 0 4px;background:#F1F2F3;}.color_div {border:#808080 1px solid;width:10px;height:10px;line-height:10px;font-size:1px;}</style>
</head>
<body>
<div id="msgbox" onmouseover="closemsg();" style="display:none;"></div>
<div class="menu" onselectstart="return false" id="destoon_menu">
<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody><tr>
<td valign="bottom">
<table cellpadding="0" cellspacing="0">
<tbody><tr>
<td width="10">&nbsp;</td>
<td id="Tab0" class="tab"><a href="<?php echo site_url("module/sell/add_cat2")?>">添加分类</a></td>
<td class="tab_nav">&nbsp;</td><td id="Tab1" class="tab_on"><a href="<?php echo site_url("module/sell/cat_list2")?>">管理分类</a></td>
<td class="tab_nav">&nbsp;</td></tr>
</tbody></table>
</td>
<td width="110"><div>
<img src="<?php echo base_url("skin/images/spacer.gif")?>" width="40" height="24" title="刷新" onclick="window.location.reload();" style="cursor:pointer;" alt="">
<img src="<?php echo base_url("skin/images/spacer.gif")?>" width="20" height="24" title="后退" onclick="history.back(-1);" style="cursor:pointer;" alt="">
<img src="<?php echo base_url("skin/images/spacer.gif")?>" width="20" height="24" title="前进" onclick="history.go(1);" style="cursor:pointer;" alt="">
<img src="<?php echo base_url("skin/images/spacer.gif")?>" width="20" height="24" title="帮助" onclick="" style="cursor:help;" alt=""></div></td>
</tr>
</tbody></table>
</div><div class="tt">注意事项</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tbody><tr>
<td>&nbsp;&nbsp;&nbsp;1、如果进行了<span class="f_red">修改</span>或<span class="f_red">删除</span>分类操作，为了保证操作速度，系统不自动修复结构。请在<span class="f_red">管理完成</span>或<span class="f_red">操作失败</span>时，点更新缓存以修复分类结构至最新。</td>
</tr>
<tr>
<td>&nbsp;&nbsp;&nbsp;2、<span class="f_red">删除分类</span>会将分类下的信息移至回收站，分类本身可以修改名称和上级分类，没有特殊情况不建议直接删除分类。</td>
</tr>
<tr>
<td>&nbsp;&nbsp;&nbsp;3、修改上级ID可以快速修改分类的上级分类，改变分类结构。</td>
</tr>
</tbody></table>
<!-- 
<form method="post" action="">
<input type="hidden" name="mid" value="5">
<input type="hidden" name="file" value="category">
<div class="tt">分类搜索</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tbody><tr>
<td>&nbsp;
<input type="text" size="30" name="kw" value="" title="关键词">&nbsp;
<input type="submit" name="submit" value="搜 索" class="btn">&nbsp;
<input type="button" value="重 搜" class="btn" onclick="Go('?mid=5&file=category');">&nbsp;
</td>
</tr>
</tbody></table>
</form> -->
<div class="tt">分类管理</div>
<form method="post">
<input type="hidden" name="forward" value="?file=category&mid=5&parentid=0&kw=">
<table cellpadding="2" cellspacing="1" class="tb">
<tbody><tr>
<th width="25"><input type="checkbox" onclick="checkall(this.form);"></th>
<th>排序</th>
<th>ID</th>
<th>上级ID</th>
<th>分类名</th>
<th>分类目录</th>
<th>索引</th>
<th>级别</th>
<th colspan="2">信息数量</th>
<th>子类</th>
<th>属性</th>
<th width="80">操作</th>
</tr>


<?php foreach ($top_cat as $v){?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center" class="">
	<td><input type="checkbox" name="catids[]" value="<?php echo $v['catid']?>"></td>
	<td><input name="category[<?php echo $v['catid']?>][listorder]" type="text" size="3" value="<?php echo $v['listorder']?>"></td>
	<td>&nbsp;<a href="<?php echo site_main(site_url("clist/index/".$v['all_linkurl']));?>" target="_blank"><?php echo $v['catid']?></a>&nbsp;</td>
	<td><input name="category[<?php echo $v['catid']?>][parentid]" type="text" size="5" value="<?php echo $v['parentid']?>" readonly/></td>
	<td>
	<input name="category[<?php echo $v['catid']?>][catname]" type="text" value="<?php echo $v['catname']?>" style="width:100px;color:">
	<input type="hidden" name="category[<?php echo $v['catid']?>][style]" id="color_input_<?php echo $v['catid']?>" value="<?php echo $v['style']?>">
	<img src="<?php echo base_url("skin/images/color.gif")?>" width="21" height="18" align="absmiddle" id="color_img_<?php echo $v['catid']?>" style="cursor:pointer;background:<?php echo $v['style']?>;" onclick="color_show(<?php echo $v['catid']?>, Dd('color_input_<?php echo $v['catid']?>').value, this);"></td>
	<td><input name="category[<?php echo $v['catid']?>][catdir]" type="text" value="<?php echo $v['catdir']?>" size="10"></td>
	<td>
	<input name="category[<?php echo $v['catid']?>][letter]" type="text" value="<?php echo $v['letter']?>" size="1">
	</td>
	<td>
	<input name="category[<?php echo $v['catid']?>][level]" type="text" value="<?php echo $v['level']?>" size="1">
	</td>
	<td><script type="text/javascript">perc(<?php echo $v['sell_count']?>,60198,'80px');</script><div class="perc" style="width:80px" title="7%"><div style="width:7%;">&nbsp;</div></div></td>
	<td><?php echo $v['item']?></td>
	<td title="管理子分类"><a href="<?php echo site_url("module/sell/cat_list2/sub-".$v['catid'])?>"><?php echo $v['subcat_count']?></a></td>
	<td title="管理属性"><a href="javascript:Dwidget('<?php echo site_url("module/category/attr_list2/".$v["catid"])?>', '[<?php echo $v["catname"]?>]扩展属性');"><?php echo $v['attr_count']?></a></td>
	<td>
	<a href="<?php echo site_url("module/sell/add_cat2/".$v['catid'])?>"><img src="<?php echo base_url("skin/images/add.png")?>" width="16" height="16" title="添加子分类" alt=""></a>&nbsp;
	<!-- <a href="<?php echo site_url("module/sell/edit_cat/".$v['catid'])?>"><img src="<?php echo base_url("skin/images/edit.png")?>" width="16" height="16" title="修改" alt=""></a>&nbsp; -->
	<a href="<?php echo site_url("module/category/del_cat/".$v['catid'])?>" onclick="return _delete();"><img src="<?php echo base_url("skin/images/delete.png")?>" width="16" height="16" title="删除" alt=""></a></td>
</tr>
<?php }?>
</tbody></table>
<div class="btns">
<span class="f_r">
分类总数:<strong class="f_red"><?php echo $cat_count?></strong>&nbsp;&nbsp;
当前目录:<strong class="f_blue"><?php echo $top_cat_count?></strong>&nbsp;&nbsp;
</span>
<input type="submit" name="submit" value="更新分类" class="btn" onclick="this.form.action='<?php echo site_url("module/category/update_cat")?>'">&nbsp;
<input type="submit" value="删除选中" class="btn" onclick="if(confirm('确定要删除选中分类吗？此操作将不可撤销')){this.form.action='<?php echo site_url("module/category/del_cat")?>'}else{return false;}">
</div>
</form>
<div class="pages">
<?php echo $pages?>
&nbsp;<cite>共<?php echo $cat_count?>条/<?php echo $total_page?>页</cite>&nbsp;
<input type="text" class="pages_inp" id="destoon_pageno" value="1" onkeydown="if(event.keyCode==13 && this.value && this.value>=1 && this.value<=<?php echo $total_page?>) {var page_size=<?php echo $page_size?>;var page=(this.value-1)*page_size;window.location.href='<?php echo substr($base_url,0,-5)?>/'+page;return false;}"> 
<input type="button" class="pages_btn" value="GO" onclick="if(Dd('destoon_pageno').value>=1 && Dd('destoon_pageno').value<=<?php echo $total_page?>){var page_size=<?php echo $page_size?>;var page=(Dd('destoon_pageno').value-1)*page_size;window.location.href='<?php echo substr($base_url,0,-5)?>/'+page;}else{Dmsg('页码不正确，请重填', 'go');}"><span id="dgo" class="f_red"></span></div>
<br/>
<form method="post">
<div class="tt">快捷操作</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tbody><tr align="center">
<td>
<div style="float:left;padding:10px;">
<DIV class="selectListCate" id="selectListCate">
	<input type="hidden" id="catid" name="post[catid]" value="" />

	<DIV class="clearfix multiSelectList" id="multiSelectList">
		<SELECT name="oneSelect" tabindex="1" class="column" id="oneSelect" style="margin-right:3px;height: 214px;float: left;" size="10">
            <?php foreach ($cat1 as $v){?>
            <option value="<?php echo $v['catid'];?>" hasprivilege="true" warnmessage=""><?php echo $v['catname'];?></option>
            <?php } ?>
		</SELECT>
		<SELECT name="twoSelect" tabindex="2" class="column" id="twoSelect" style="height: 214px; display: none;float: left;" size="10" ></SELECT>
		<SELECT name="threeSelect" tabindex="3" class="column" id="threeSelect" style="height: 214px; display: none;" size="10"></SELECT>
		<SELECT name="fourSelect" tabindex="4" class="column last" id="fourSelect" style="height: 214px; display: none;" size="10"></SELECT>
	 </DIV>
</DIV></div>
<div style="float:left;padding:10px;">
	<table>
	<tbody><tr>
	<td><input type="submit" value="管理分类" class="btn" onclick="this.form.action='<?php echo substr(site_url("module/sell/cat_list2/"),0,-5)?>/sub-'+Dd('catid').value;"></td>
	</tr>
	<tr>
	<td><input type="submit" value="添加分类" class="btn" onclick="this.form.action='<?php echo substr(site_url("module/sell/add_cat2/"),0,-5)?>/'+Dd('catid').value;"></td>
	</tr>
	<tr>
	<td><input type="submit" value="修改分类" class="btn" onclick="this.form.action='<?php echo substr(site_url("module/sell/edit_cat/"),0,-5)?>/'+Dd('catid').value;"></td>
	</tr>
	<tr>
	<td><input type="submit" value="删除分类" class="btn" onclick="if(confirm('确定要删除选中分类吗？此操作将不可撤销')){this.form.action='<?php echo substr(site_url("module/category/del_cat/"),0,-5)?>/'+Dd('catid').value;}else{return false;}"></td>
	</tr>
	</tbody></table>
</div>
</td>
</tr>
</tbody></table>

</form>
<script type="text/javascript">
function Prop(t, n) {
	mkDialog('', '<iframe src="<?php echo base_url("skin/images/?file=property&catid='+n+'")?>" width="700" height=300" border="0" vspace="0" hspace="0" marginwidth="0" marginheight="0" framespacing="0" frameborder="0" scrolling="yes"></iframe>', '['+t+']扩展属性', 720, 0, 0);
}
</script>
<script type="text/javascript">
    $(function(){
        $("#multiSelectList select").change(function(){
            var sthis = $(this);
            var catid = sthis.val();
            $("#catid").val(catid);
            $.ajax({
                url:'<?php echo site_url('module/sell/ajax_cats')?>',
                type:'post',
                data:{catid:catid},
                success:function(data) {
                    var cat = eval(data);
                    var width = sthis.width();
                    sthis.next().css("width", width);
                    sthis.next().empty();
                    if(cat.length>0) {
                        var str = "";
                        $.each(cat, function (n, value) {
                            str += "<option value='" + value['catid'] + "' hasprivilege='true' warnmessage=' '>" + value['catname'] + "</option>";
                        });
                        sthis.next().next().css("display", "none");
                        sthis.next().css("display", "block");
                        sthis.next().append(str);
                    }
                    else
                    {
                        tabindex = sthis.attr("tabindex")-1;
                        sthis.parent().find("select:gt("+tabindex+")").each(function(){
                           $(this).css("display", "none");
                        });
                    }
                }
            })
        });
    })
</script>
<script type="text/javascript">Menuon(1);</script>

</body></html>