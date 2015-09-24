<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>修改分类</title>
<meta name="robots" content="noindex,nofollow"><link rel="stylesheet" href="http://admin.brands-list.com/skin/css/style.css" type="text/css"><link href="http://admin.brands-list.com/skin/css/jquery.popup.css" rel="stylesheet" type="text/css" /><link rel="stylesheet" href="http://admin.brands-list.com/skin/css/jquery.alerts.css" /><script type="text/javascript" src="http://admin.brands-list.com/skin/js/jquery-1.7.2.min.js"></script><SCRIPT src="http://admin.brands-list.com/skin/js/jquery.popup.js" type="text/javascript"></SCRIPT><script type="text/javascript" src="http://admin.brands-list.com/skin/js/jquery.alerts.js"></script>
<SCRIPT type="text/javascript">
var times = 0;

function load_category(n,catid){
	$("#catid_"+n).val(catid);
	$.ajaxSetup({cache:false});
	$('span#load_category_'+n).load('http://admin.motors-biz.com/index.php/module/modifycats/subcategory/'+catid+'/'+n);
}

function op(valu){
	var tname=$("#load_category_1").find("option[value="+valu+"]").text();
	$.popup('Group Name : <input type="text" id="inputGroup" name="inputGroup" value="'+tname+'">', {modal:true, button:{ok:true,cancel:true},ok_callback:function(){
		var tnewname = $("#inputGroup").val();
		if(tnewname!==undefined){
			$.ajax({
				type:"post",
				url:"<?php echo site_url('module/modifycats/renamecat')?>",
				data:{ tid: valu, tname: tnewname },
				dataType:"json",
				success:function(data){
					jAlert(data.msg, "提示信息");
					if(data.code){
						//location.reload(true);
						$("option[value="+valu+"]").text(tnewname);
					}
				}
			});
		}
	}});
}

function show_div(id){
	var idarr = new Array("add","com","move");
	if($.inArray(id, idarr) == -1){
		return;
	}
	for(x in idarr){
		if(id == idarr[x]){
			var traget=document.getElementById(id+"_div");
			if(traget.style.display == "none"){
				traget.style.display = "";	
			}else{
				traget.style.display = "none";   
			}
			change(id);
		}else{
			document.getElementById(idarr[x]+"_div").style.display = "none";
		}
	}
}

$(function (){
	document.getElementById("add").style.background = "white";
	document.getElementById("del").style.background = "white";
	document.getElementById("com").style.background = "white";
	document.getElementById("move").style.background = "white";
	$("#add").bind("click",function(){
		document.getElementById("catname").value = "";
		show_div(this.id);
	});
	$("#com").bind("click",function(){
		show_div(this.id);
	});

	$("#move").bind("click",function(){
		show_div(this.id);
	});
	
	$("#del").bind("click",function(){
		//document.getElementById("add_div").style.display = "none"; 
		var catid = $("#catid_1").val();
		if(catid == 0){
			jAlert("请先选择类别", "错误信息");
			return;
		}
		$.post("<?php echo site_url('module/modifycats/islastcat')?>", { catid: catid },
	   function(data){
		 if(data.code == 1){
			if(data.msg == "last cat"){
				if(confirm("确定删除类别吗？")){
					del(catid);
				}
			}else{
				if(confirm("本类别下有子类别，确定全部删除吗？")){
					del(catid);
				}
			}
		 }else{
			jAlert(data.msg, "错误信息");
		 }
	   }, "json");
	});

})

function del(catid){
	if(!catid){
		jAlert("请先选择类别", "错误信息");
		return;
	}
	$.post("<?php echo site_url('module/modifycats/delcat')?>", { catid: catid },
   function(data){
		if(data.code == 1){
			jAlert(data.msg, "提示信息");
			load_category(1,data.pcatid);
		}else{
			jAlert(data.msg, "错误信息");
		}
   }, "json");
}

function addcat(){
	var pcatid = $("#catid_1").val();
	var catnames = $("#catname").val();
	if(!catnames){
		jAlert("请先填写待添加的子分类信息", "错误信息");
		return;
	}
	$.post("<?php echo site_url("module/modifycats/addcat")?>", { pcatid: pcatid, catnames: catnames },
   function(data){
		if(data.code == 1){
			jAlert(data.msg, "提示信息");
			if(pcatid == 0){
				window.location.reload();
			}else{
				load_category(1,pcatid);
				show_div("add");
			}
		}else{
			jAlert(data.msg, "错误信息");
		}
   }, "json");
}

function comcat(){
	var oricatid = $("#catid_1").val();
	if(oricatid <= 0){
		jAlert(" 请先选择被合并的类别！ ", "错误信息");
		return;
	}
	var nowcatid = $("#catid_2").val();
	if(nowcatid <= 0){
		jAlert(" 请选择合并后的类别！ ", "错误信息");
		return;
	}
	$.post("<?php echo site_url("module/modifycats/comcat")?>", { oricatid: oricatid, nowcatid: nowcatid },
   function(data){
		if(data.code == 1){
			jAlert(data.msg, "提示信息");
			load_category(1,data.pcatid);
			load_category(2,nowcatid);
		}else{
			jAlert(data.msg, "错误信息");
		}
   }, "json");
}

function movecat(){
	var oricatid = $("#catid_1").val();
	if(oricatid <= 0){
		jAlert(" 请先选择被移动的类别！ ", "错误信息");
		return;
	}
	var movecatid = $("#catid_3").val();
	if(movecatid < 0){
		jAlert(" 请选择移动到的类别名，或者默认移动为顶级类别！ ", "错误信息");
		return;
	}
	if(movecatid == oricatid){
		jAlert("被移动的类别和移动后的类别不能为同一类别！", "错误信息");
		return;
	}
	$.post("<?php echo site_url("module/modifycats/movecat")?>", { oricatid: oricatid, movecatid: movecatid },
   function(data){
	//jAlert(data, "提示信息");
		if(data.code == 1){
			jAlert(data.msg, "提示信息");
			load_category(1,data.pcatid);
			load_category(3,oricatid);
		}else{
			jAlert(data.msg, "错误信息");
		}
   }, "json");
}

 function change(id) {
	var idarr = new Array("add","com","move");
	var key = $.inArray(id, idarr);
	if(key == -1){
		return;
	}
	for(x in idarr){
		if(key != x && document.getElementById(idarr[x]).style.background == 'red'){
			times = 0;
			document.getElementById(idarr[x]).style.background = 'white';
		}
	}
	document.getElementById(id).style.background = times % 2 == 0 ? 'red' : 'white';
	times++;
}
</SCRIPT>
</head>
<body <?php if($catid){echo "onload=\"load_category(1,{$catid})\"";}?>>
<div id="msgbox" onmouseover="closemsg();" style="display:none;"></div>
<div class="menu" onselectstart="return false" id="destoon_menu">
<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody><tr>
<td valign="bottom">
<table cellpadding="0" cellspacing="0">
<tbody><tr>
<td width="10">&nbsp;</td>
<td id="Tab0" class="tab_on"><a href="<?php echo site_url("module/modifycats/showcats")?>">修改分类</a></td><td class="tab_nav">&nbsp;</td>
<td id="Tab1" class="tab"><a href="<?php echo site_url("module/category/cats_list")?>">分类列表</a></td><td class="tab_nav">&nbsp;</td>
<td id="Tab2" class="tab"><a href="<?php echo site_url("module/othercats/showcats")?>">类别匹配</a></td><td class="tab_nav">&nbsp;</td>
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
<div class="tt">注意事项</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tbody><tr>
<td>&nbsp;&nbsp;&nbsp;1、如果需要进行<span class="f_red">修改类别名</span>操作，请<span class="f_red">双击</span>您要修改的类别，然后在弹出框内进行修改并保存。</td>
</tr>
<tr>
<td>&nbsp;&nbsp;&nbsp;2、如果需要进行<span class="f_red">添加子类别</span>操作，请先选择父类别，然后进行添加；未选择父类别的视为添加到一级类目里；<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;添加子分类时，允许批量添加，一行一个，点回车换行。</td>
</tr>
<tr>
<td>&nbsp;&nbsp;&nbsp;3、如果需要进行<span class="f_red">删除类别</span>操作，请选中需要删除的类别，然后点击删除按钮，根据提示信息操作即可；<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;不是最后一级的类别也可以删除。</td>
</tr>
<tr>
<td>&nbsp;&nbsp;&nbsp;4、如果需要进行<span class="f_red">合并类别</span>操作，请先选中需要合并的类别，然后点击合并按钮，再选择合并后的类别，单击确定按钮即可；<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;不是最后一级的类别也可以合并。</td>
</tr>
<tr>
<td>&nbsp;&nbsp;&nbsp;5、如果需要进行<span class="f_red">移动类别</span>操作，请选中需要移动的类别，然后点击移动按钮，再选择移动到哪一个类别下，单击确定按钮即可；<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;不是最后一级的类别也可以进行移动。</td>
</tr>
<tr>
<td>&nbsp;&nbsp;&nbsp;6、在进行<span class="f_red">多子类的类别</span>处理时，由于要处理的数据较多，可能会花费一定的时间，请耐心等待。</td>
</tr>
</tbody></table>

<div class="tt">分类修改</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tbody><tr>
<td class="tl"><span class="f_hid">*</span> 上级分类</td>
<td>
<span id="load_category_1">
<select onchange="load_category(1,this.value)" multiple="multiple" size="20" ondblclick="op(this.value);">
<?php foreach($main_cate as $v):?>
<option value="<?php echo $v['catid']?>"><?php echo $v['catname']?></option>
<?php endforeach;?>
</select> </span>
<br><span id="dcatselect" class="f_red"></span>
<input type="button" value="添加子分类" id="add" title="如果不选择上级分类，就默认添加到一级类目里"/>&nbsp;&nbsp;
<input type="button" value="删除" id="del" title="类目被删除后，该类目以及子类目与产品、品牌、优惠信息、文章等的对应关系全部清除掉，且不可撤销。请慎重操作！"/>&nbsp;&nbsp;
<input type="button" value="合并" id="com" title="类目被合并后，原有类目以及子类目与产品、品牌、优惠信息、文章等的对应关系全部清除掉，并转移到合并后的类目下，且不可撤销。请慎重操作！"/>&nbsp;&nbsp;
<input type="button" value="移动" id="move" title="类目被移动后，该类目以及子类目全部转移到新类目下，该类目与子类目的对应关系不变！"/>&nbsp;&nbsp;
  
</td>
</tr>
</tbody></table>

<div id="add_div" style="display:none">
<form id="addform">
<input type="hidden" value="0" id="catid_1" name="parentid">
<span style="padding-right:95px"><span class="f_red">*</span> 分类名称 ： </span>
<textarea name="catname" id="catname" style="width:200px;height:100px;overflow:visible;" title="允许批量添加，一行一个，点回车换行"></textarea>
<div class="sbt"><input type="button" onclick="addcat();" value="确 定" class="btn">&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value="重 置" class="btn"></div>
</form>
</div>

<div id="com_div" style="display:none">
<form id="comform">
<span style="padding-right:95px"><span class="f_red">*</span> 分类名称 ： </span>
<span id="load_category_2">
<select onchange="load_category(2,this.value)" multiple="multiple" size="20">
<?php foreach($main_cate as $v):?>
<option value="<?php echo $v['catid']?>"><?php echo $v['catname']?></option>
<?php endforeach;?>
</select> </span>
<input type="hidden" value="0" id="catid_2">
<div class="sbt"><input type="button" onclick="comcat();" value="确 定" class="btn">&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" value="重 置" class="btn" onclick="load_category(2,0)"></div>
</form>
</div>

<div id="move_div" style="display:none">
<form id="moveform">
<!--<div><center><input type="button" value="下移" id="low"/>&nbsp;&nbsp;
<input type="button" value="上移" id="upp"/>&nbsp;&nbsp;</center></div>-->
<span style="padding-right:95px"><span class="f_red">*</span> 分类名称 ： </span>
<span id="load_category_3">
<select onchange="load_category(3,this.value)" multiple="multiple" size="20">
<?php foreach($main_cate as $v):?>
<option value="<?php echo $v['catid']?>"><?php echo $v['catname']?></option>
<?php endforeach;?>
</select> </span>
<input type="hidden" value="0" id="catid_3">
<div class="sbt"><input type="button" onclick="movecat();" value="确 定" class="btn">&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" value="重 置" class="btn" onclick="load_category(3,0)"></div>
</form>
</div>

</body></html>