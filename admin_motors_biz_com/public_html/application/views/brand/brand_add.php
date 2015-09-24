<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>添加品牌</title>
    <meta name="robots" content="noindex,nofollow">
    <script type="text/javascript">window.onerror= function(){return true;}</script>
    <link rel="stylesheet" href="<?php echo base_url("skin/css/style.css")?>" type="text/css">
    <script type="text/javascript" src="<?php echo base_url("skin/js/lang.js")?>"></script>
    <script type="text/javascript" src="<?php echo base_url("skin/js/config.js")?>"></script>
    <script type="text/javascript" src="<?php echo base_url("skin/js/jquery.js")?>"></script>
    <script type="text/javascript" src="<?php echo base_url("skin/js/common.js")?>"></script>
    <script type="text/javascript" src="<?php echo base_url("skin/js/admin.js")?>"></script>
    <script type="text/javascript" src="<?php echo base_url("skin/js/ae.js")?>"></script>
    <script type="text/javascript" src="<?php echo base_url("skin/js/jquery-1.4.js")?>"></script>
    <script type="text/javascript" src="<?php echo base_url("skin/kindeditor/themes/default/default.css")?>"></script>
    <script type="text/javascript" src="<?php echo base_url("skin/kindeditor/plugins/code/prettify.css")?>"></script>
    <script type="text/javascript" src="<?php echo base_url("skin/kindeditor/kindeditor.js")?>"></script>
    <script type="text/javascript" src="<?php echo base_url("skin/kindeditor/lang/zh_CN.js")?>"></script>
    <script type="text/javascript" src="<?php echo base_url("skin/kindeditor/plugins/code/prettify.js")?>"></script>
    <script language="javascript" type="text/javascript" src="<?php echo base_url("skin/tiny_mce/tiny_mce.js")?>"></script>
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
                        <td id="Tab0" class="tab_on"><a href="<?php echo site_url("brand/brand_add")?>">添加品牌</a></td>
                        <td class="tab_nav">&nbsp;</td><td id="Tab1" class="tab"><a href="<?php echo site_url("brand/brand_list")?>">品牌列表</a></td>
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
</div>
    <?php if(empty($list)) {?>
    <form method="post" action="?" id="dform" onsubmit="return check();">
    <?php }else{ ?>
    <form method="post" action="/brand/brand_update">
        <input type="hidden" name="brandId" value="<?php echo $list[0]['brandId'] ?>"/>
    <?php }?>
    <input type="hidden" name="moduleid" value="13"/>
    <input type="hidden" name="file" value="index"/>
    <input type="hidden" name="action" value="add"/>
    <input type="hidden" name="forward" value=""/>
    <div class="tt">添加品牌</div>
    <table cellpadding="2" cellspacing="1" class="tb">
        <tr>
            <td class="tl"><span class="f_red">*</span>品牌名称</td>
            <td><input name="post[title]" type="text" id="title" size="60" value="<?php echo $list[0]['name'] ?>"/>
                <select name="post[level]" >
                    <option value="0">级别</option>
                    <option value="1">1 级 推荐品牌</option>
                    <option value="2">2 级</option>
                    <option value="3">3 级</option>
                    <option value="4">4 级</option>
                    <option value="5">5 级</option>
                    <option value="6">6 级</option>
                    <option value="7">7 级</option><option value="8">8 级</option>
                    <option value="9">9 级</option></select>
                <script type="text/javascript" src="http://localhost/file/script/color.js"></script>
                <input type="hidden" name="post[style]" id="color_input_1" value=""/>
                <img src="http://localhost/file/image/color.gif" width="21" height="18"
                     align="absmiddle" id="color_img_1" style="cursor:pointer;background:"
                     onclick="color_show(1, Dd('color_input_1').value, this);"/>
                <br/><span id="dtitle" class="f_red"></span></td>
        </tr>
        <tr>
            <td class="tl"><span class="f_red">*</span>品牌LOGO</td>
            <td><input name="post[thumb]" id="thumb" type="text" size="60" value="<?php echo $list[0]['thumb'] ?>"/>&nbsp;&nbsp;
                <span onclick="Dthumb(13,180,60, Dd('thumb').value);" class="jt">[上传]</span>&nbsp;&nbsp;
                <span onclick="_preview(Dd('thumb').value);" class="jt">[预览]</span>&nbsp;&nbsp;
                <span onclick="Dd('thumb').value='';" class="jt">[删除]</span><span id="dthumb" class="f_red"></span></td>
        </tr>
        </tr>
    </table>
    <div class="sbt"><input type="submit" name="submit" value=" 确 定 " class="btn"/>&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="reset" name="reset" value=" 重 置 " class="btn"/></div>
</form>
<script type="text/javascript">
    function check() {
        return true;
    }
</script>
<script type="text/javascript">Menuon(0);</script>
</body>
</html>