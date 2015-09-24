<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>发送信件</title>
<meta name="robots" content="noindex,nofollow">
<script type="text/javascript">window.onerror= function(){return true;}</script>
<link rel="stylesheet" href="<?php echo base_url("skin/css/style.css")?>" type="text/css">
<script type="text/javascript" src="<?php echo base_url("skin/js/lang.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/config.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/jquery.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/common.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/admin.js")?>"></script>
<script type="text/javascript">
	function save_draft(){
		var title = $('#title').val();
		var content = $('#content').val();
		if(confirm('确定要保存草稿吗?系统只保存最后一条草稿的标题和内容')){
			if(title==""){
				$("#dtitle").html("标题不能为空");
				document.form.title.focus();
				return false;
			}else if(content==""){
				$("#dcontent").html("内容不能为空");
				document.form.content.focus();
				return false;
			}else{
				$.ajax({
					type:"post",
					url:"<?php echo site_url('member/message/save_draft')?>",			
					data:{id:new Date(),title:title,content:content},
					dataType:"html",
					success:function(data){
						$("#data_msg").html(data);
						//$("#data_msg").fadeOut("slow");				
					}
				});
			}
		}
	}

	function get_data(){
		if(confirm('确定数据恢复,覆盖当前数据?')){
			$.ajax({
				type:"post",
				url:"<?php echo site_url('member/message/get_data')?>",			
				dataType:"json",
				success:function(data){
					$("#title").val(data.title);	
					$("#content").val(data.content);			
				}
			});
		}
	}
	
	function check_auto(){
		var title = $('#title').val();
		var content = $('#content').val();
		if(title !='' && content !=''){
			var int_id = setInterval("save_auto()",60000);
		}
	}
	
	function save_auto(){
		var title = $('#title').val();
		var content = $('#content').val();
		$.ajax({
			type:"post",
			url:"<?php echo site_url('member/message/save_draft/auto')?>",			
			data:{id:new Date(),title:title,content:content},
			dataType:"html",
			success:function(data){
				$("#data_msg").html(data);
			}
		});	
	}
</script>
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
<td id="Tab0" class="tab_on"><a href="<?php echo site_url("member/message/msg_send2")?>">发送信件</a></td><td class="tab_nav">&nbsp;</td>
<td id="Tab1" class="tab"><a href="<?php echo site_url("member/message/msg_list2")?>">会员信件</a></td><td class="tab_nav">&nbsp;</td>
<td id="Tab2" class="tab"><a href="<?php echo site_url("member/message/msg_system2")?>">系统信件</a></td><td class="tab_nav">&nbsp;</td>
<td id="Tab4" class="tab"><a href="<?php echo site_url("member/message/msg_clear2")?>">信件清理</a></td><td class="tab_nav">&nbsp;</td></tr>
</tbody></table>
</td>
<td width="110"><div>
<img src="<?php echo base_url("skin/images/spacer.gif")?>" width="40" height="24" title="刷新" onclick="window.location.reload();" style="cursor:pointer;" alt="">
<img src="<?php echo base_url("skin/images/spacer.gif")?>" width="20" height="24" title="后退" onclick="history.back(-1);" style="cursor:pointer;" alt="">
<img src="<?php echo base_url("skin/images/spacer.gif")?>" width="20" height="24" title="前进" onclick="history.go(1);" style="cursor:pointer;" alt="">
<img src="<?php echo base_url("skin/images/spacer.gif")?>" width="20" height="24" title="帮助" onclick="" style="cursor:help;" alt=""></div></td>
</tr>
</tbody></table>
</div><div class="tt">发送信件</div>
<form method="post" action="<?php echo site_url("member/message/save_msg")?>" id="dform" onsubmit="return Dcheck();">
<table cellpadding="2" cellspacing="1" class="tb">
<tbody><tr>
<td class="tl"><span class="f_red">*</span> 发送类型</td>
<td>
<input type="radio" name="message[type]" value="1" onclick="Dd('group').style.display='';Dd('member').style.display='none';" checked="" id="type_1"><label for="type_1"> 系统群发</label>
<input type="radio" name="message[type]" value="0" onclick="Dd('group').style.display='none';Dd('member').style.display='';" id="type_0"><label for="type_0"> 指定收件人</label>
</td>
</tr>
<tr id="group" style="display:;">
<td class="tl"><span class="f_red">*</span> 会员组</td>
<td>
<span id="group_messagegroupids">
	<input type="checkbox" name="message[groupids][]" value="1" id="messagegroupids1"><label for="messagegroupids1"> 管理员&nbsp; </label>
	<input type="checkbox" name="message[groupids][]" value="5" id="messagegroupids5"><label for="messagegroupids5"> 个人会员&nbsp; </label>
	<input type="checkbox" name="message[groupids][]" value="6" id="messagegroupids6"><label for="messagegroupids6"> 企业会员&nbsp; </label>
	<input type="checkbox" name="message[groupids][]" value="7" id="messagegroupids7"><label for="messagegroupids7"> VIP会员&nbsp; </label>
</span>&nbsp;<a href="javascript:check_box('group_messagegroupids', true);">全选</a> / <a href="javascript:check_box('group_messagegroupids', false);">全不选</a></td>
</tr>
<tr id="member" style="display:none;">
<td class="tl"><span class="f_red">*</span> 收件人</td>
<td><input type="text" size="50" name="message[touser]" id="touser" maxlength="160" value="<?php echo $touser;?>">&nbsp;多个收件人请用分号";"分隔</td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 标题</td>
<td><input type="text" size="50" name="message[title]" id="title" maxlength="100"> <span id="dtitle" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 内容</td>
<td>
<textarea name="message[content]" id="content" rows="20" cols="100" maxlength="3000" onblur="check_auto()"></textarea>
<div style="width:98%;color:#666666;">
<a href="#" onclick="get_data();" class="t" title="确定数据恢复,将会覆盖当前数据">数据恢复</a>&nbsp;|&nbsp;
<a href="#" class="t" onclick="save_draft();" title="手动保存草稿, 系统只保存最后一条草稿的标题和内容">暂存草稿</a><!-- &nbsp;|&nbsp;
<span id="fck_switch"><a href="#" class="t" onclick="save_stop()" title="将会关闭系统的自动保存草稿的功能">关闭保存</a></span>-->&nbsp;&nbsp; 
<span id="data_msg"></span> 
</div><span id="dcontent" class="f_red"></span>
</td>
</tr>
</tbody>
</table>
<div class="sbt"><input type="submit" name="submit" value=" 确 定 " class="btn">&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value=" 重 置 " class="btn"></div>
</form>
<script type="text/javascript" src="<?php echo base_url("skin/js/clear.js")?>"></script>
<script type="text/javascript">
<?php if($touser) { ?>
Dd('type_0').checked = true;
Dd('group').style.display='none';
Dd('member').style.display='';
<?php } ?>
function Dcheck() {
	var l;
	var f;
	f = 'title';
	l = Dd(f).value.length;
	if(l < 2) {
		Dmsg('标题最少2字，当前已输入'+l+'字', f);
		return false;
	}
	f = 'content';
	l = Dd(f).value.length;
	if(l < 5) {
		Dmsg('内容最少5字，当前已输入'+l+'字', f);
		return false;
	}
	return true;
}
</script>
<script type="text/javascript">Menuon(0);</script>

<iframe src="javascript:void(0)" frameborder="0" scrolling="no" height="0" width="0" style="position: absolute; z-index: 10000;"></iframe><iframe src="javascript:void(0)" frameborder="0" scrolling="no" height="0" width="0" style="position: absolute; z-index: 10000;"></iframe><iframe src="javascript:void(0)" frameborder="0" scrolling="no" height="0" width="0" style="position: absolute; z-index: 10000;"></iframe></body><script>window.FCKeditorAPI = {Version : "2.6",VersionBuild : "18638",Instances : new Object(),GetInstance : function( name ){return this.Instances[ name ];},_FormSubmit : function(){for ( var name in FCKeditorAPI.Instances ){var oEditor = FCKeditorAPI.Instances[ name ] ;if ( oEditor.GetParentForm && oEditor.GetParentForm() == this )oEditor.UpdateLinkedField() ;}this._FCKOriginalSubmit() ;},_FunctionQueue	: {Functions : new Array(),IsRunning : false,Add : function( f ){this.Functions.push( f );if ( !this.IsRunning )this.StartNext();},StartNext : function(){var aQueue = this.Functions ;if ( aQueue.length > 0 ){this.IsRunning = true;aQueue[0].call();}else this.IsRunning = false;},Remove : function( f ){var aQueue = this.Functions;var i = 0, fFunc;while( (fFunc = aQueue[ i ]) ){if ( fFunc == f )aQueue.splice( i,1 );i++ ;}this.StartNext();}}}</script></html>