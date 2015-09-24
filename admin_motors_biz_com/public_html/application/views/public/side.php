<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>side</title>
<meta name="robots" content="noindex,nofollow">
<link rel="stylesheet" href="<?php echo base_url("skin/css/style.css")?>" type="text/css">
<script type="text/javascript">window.onerror= function(){return true;}</script>
<script type="text/javascript" src="<?php echo base_url("skin/js/lang.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/config.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/jquery.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/common.js")?>"></script>
</head>
<body>
<table cellpadding="0" cellspacing="0" width="100%" height="100%">
<tbody><tr>
<td class="side" title="点击关闭/打开侧栏" onclick="s();">
<div id="side" class="side_on">&nbsp;</div>
</td>
</tr>
</tbody></table>
<script type="text/javascript">
function s() {
	if(Dd('side').className == 'side_on') {
		Dd('side').className = 'side_off';
		top.document.getElementsByName("fra")[0].cols = '0,7,*';
	} else {
		Dd('side').className = 'side_on';
		top.document.getElementsByName("fra")[0].cols = '188,7,*';
	}
}
</script>

</body></html>