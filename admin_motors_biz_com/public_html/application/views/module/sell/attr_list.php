<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>属性列表</title>
<meta name="robots" content="noindex,nofollow">
<script type="text/javascript">window.onerror= function(){return true;}</script>
<link rel="stylesheet" href="<?php echo base_url("skin/css/style.css")?>" type="text/css">
<script type="text/javascript" src="<?php echo base_url("skin/js/lang.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/config.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/jquery.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/common.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/admin.js")?>"></script>
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
<td id="Tab0" class="tab"><a href="<?php echo site_url("module/category/add_attr2/".$catid)?>">添加属性</a></td><td class="tab_nav">&nbsp;</td>
<td id="Tab1" class="tab_on"><a href="<?php echo site_url("module/category/attr_list2/".$catid)?>">属性参数</a></td><td class="tab_nav">&nbsp;</td></tr>
</tbody></table>
</td>
<td width="110"><div>
<img src="<?php echo base_url("skin/images/spacer.gif")?>" title="刷新" onclick="window.location.reload();" style="cursor:pointer;" alt="" height="24" width="40">
<img src="<?php echo base_url("skin/images/spacer.gif")?>" title="后退" onclick="history.back(-1);" style="cursor:pointer;" alt="" height="24" width="20">
<img src="<?php echo base_url("skin/images/spacer.gif")?>" title="前进" onclick="history.go(1);" style="cursor:pointer;" alt="" height="24" width="20">
<img src="<?php echo base_url("skin/images/spacer.gif")?>" title="帮助" onclick="" style="cursor:help;" alt="" height="24" width="20"></div></td>
</tr>
</tbody></table>
</div><form method="post">
<input name="catid" value="<?php echo $catid?>" type="hidden">
<div class="tt">属性参数</div>
<table class="tb" cellpadding="2" cellspacing="1">
<tbody><tr>
<th width="40">排序</th>
<th>ID</th>
<th>属性名称</th>
<th>添加方式</th>
<th>默认(备选)值</th>
<th width="50">操作</th>
</tr>
<?php foreach ($attr as $v){?>
<tr class="" onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td><input size="2" name="listorder[<?php echo $v['oid']?>]" value="<?php echo $v['listorder']?>" type="text"></td>
<td><?php echo $v['oid']?></td>
<td><?php echo $v['name']?></td>
<td><?php switch ($v['type']){
	case 1:echo '多行文本(textarea)';break;
	case 2:echo '列表选择(select)';break;
	case 3:echo '复选框(checkbox)';break;
	default:echo '单行文本(text)';break;
}?></td>
<td><?php echo $v['value']?></td>
<td>
<a href="<?php echo site_url("module/category/edit_attr/".$v['oid'])?>"><img src="<?php echo base_url("skin/images/edit.png")?>" title="修改" alt="" height="16" width="16"></a>&nbsp;
<a href="<?php echo site_url("module/category/del_attr/".$v['oid'])?>" onclick="return _delete();"><img src="<?php echo base_url("skin/images/delete.png")?>" title="删除" alt="" height="16" width="16"></a>
</td>
</tr>
<?php }?>
</tbody></table>
<div class="btns">
<input value=" 更新排序 " class="btn" onclick="this.form.action='<?php echo site_url("module/category/update_attrlist")?>';" type="submit">&nbsp;&nbsp;&nbsp;&nbsp;
<input value=" 关 闭 " class="btn" onclick="window.parent.location.reload();" type="button">
</div>
</form>
<div class="pages"></div>
<script type="text/javascript">Menuon(1);</script>

</body></html>