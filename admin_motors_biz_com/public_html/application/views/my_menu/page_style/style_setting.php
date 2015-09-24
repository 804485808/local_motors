<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>风格管理</title>
<meta name="robots" content="noindex,nofollow">
<script type="text/javascript">window.onerror= function(){return true;}</script><link rel="stylesheet" href="<?php echo base_url("skin/css/style.css")?>" type="text/css">
<script type="text/javascript" src="<?php echo base_url("skin/js/lang.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/config.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/jquery.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/common.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/admin.js")?>"></script>
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
<td id="Tab1" class="tab_on"><a href="<?php echo site_url("my_menu/page_style/style_setting")?>">风格管理</a></td><td class="tab_nav">&nbsp;</td>
<td id="Tab0" class="tab"><a href="<?php echo site_url("my_menu/page_style/page_setting")?>">模块配置</a></td><td class="tab_nav">&nbsp;</td>
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

<form method="post">
<div class="tt">管理模板</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tbody><tr>
<th width="25"><input type="checkbox" onclick="checkall(this.form);"></th>
<th width="40">排序</th>
<th>风格名称</th>
<th>预览图</th>
<th>风格目录</th>
<th width="6%">操作</th>
</tr>
<?php foreach ($findstyles as $k=>$v):?>
<tr onmouseover="this.className=&#39;on&#39;;" onmouseout="this.className=&#39;&#39;;" align="center" class="">
<td><input type="checkbox" name="id[]" value="<?php echo $v['id']?>"></td>
<td><?php echo $k+1;?></td>
<td><?php if ($v['is_select']):?><strong style="color:#F60;"><?php echo $v['title'];?></strong><?php else:?><strong><a href="<?php echo site_url("my_menu/page_style/style_select/".$v['id']);?>" onclick="return _style_add();"><?php echo $v['title'];?></a></strong><?php endif;?>
<?php if ($v['is_select']):?>
&nbsp;&nbsp;<a href="<?php echo site_url("my_menu/page_style/style_edit/".$v['id']);?>"><img src="<?php echo base_url("skin/images/yes.gif")?>" width="16" height="16" title="当前使用风格" alt=""></a>
<?php endif;?>
</td>
<td style="padding:5px 0 5px 0;"><img src="<?php echo base_url("skin/styles/".$v['skin'].".jpg")?>" style="margin:0 0 5px 0;" title="<?php echo $v['title'];?>" width="200" height="135"><br>
</td>
<td><?php echo $v['skin']?></td>
<td>
<a href="<?php echo site_url("my_menu/page_style/style_select/".$v['id']);?>" onclick="return _style_add();"><img src="<?php echo base_url("skin/images/add_bg.gif")?>" width="14" height="14" title="使用此风格" alt=""></a>&nbsp;&nbsp;
<a href="<?php echo site_url("my_menu/page_style/style_edit/".$v['id']);?>"><img src="<?php echo base_url("skin/images/edit.png")?>" width="16" height="16" title="修改" alt=""></a>&nbsp;&nbsp;
<a href="<?php echo site_url("my_menu/page_style/style_del/".$v['id']);?>" onclick="return _delete();"><img src="<?php echo base_url("skin/images/delete.png")?>" width="16" height="16" title="删除" alt=""></a>
</td>
</tr>
<?php endforeach;?>
</tbody></table>
<div class="btns">
<input type="submit" value=" 删 除 " class="btn" onclick="if(confirm(&#39;确定要删除选中模板吗？此操作将不可撤销&#39;)){this.form.action='<?php echo site_url("my_menu/page_style/style_del/")?>'}else{return false;}">
</div>
</form>
<div class="pages">
<?php echo $pages;?>
</div>
<br>
<script type="text/javascript">Menuon(1);</script>

</body></html>