<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>添加列表</title>
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
<form action="/brand/brand_search" method="post">
    <div class="tt">品牌搜索</div>
    <input type="hidden" name="moduleid" value="13"/>
    <table cellpadding="2" cellspacing="1" class="tb">
        <tr>
            <td>
                &nbsp;<select name="fields" >
                    <option value="0" selected=selected>模糊</option>
                    <option value="1">标题</option>
                    <option value="2">公司名</option>
                    <option value="3">联系人</option>
                    <option value="4">联系电话</option>
                    <option value="5">联系地址</option>
                    <option value="6">电子邮件</option>
                    <option value="7">联系MSN</option>
                    <option value="8">联系QQ</option>
                    <option value="9">会员名</option>
                    <option value="10">IP</option>
                </select>&nbsp;
                <input type="text" size="30" name="kw" value="" title="关键词"/>&nbsp;
                <select name="level" >
                    <option value="0">级别</option>
                    <option value="1">1 级 推荐品牌</option>
                    <option value="2">2 级</option>
                    <option value="3">3 级</option>
                    <option value="4">4 级</option>
                    <option value="5">5 级</option>
                    <option value="6">6 级</option>
                    <option value="7">7 级</option>
                    <option value="8">8 级</option>
                    <option value="9">9 级</option>
                </select>&nbsp;
                <select name="order" >
                    <option value="0" selected=selected>结果排序方式</option>
                    <option value="1">更新时间降序</option>
                    <option value="2">更新时间升序</option>
                    <option value="3">添加时间降序</option>
                    <option value="4">添加时间升序</option>
                    <option value="5">浏览次数降序</option>
                    <option value="6">浏览次数升序</option>
                    <option value="7">品牌ID降序</option>
                    <option value="8">品牌ID升序</option>
                </select>&nbsp;
                <input type="text" name="psize" value="20" size="2" class="t_c" title="条/页"/>
                <input type="submit" value="搜 索" class="btn"/>&nbsp;
                <input type="button" value="重 置" class="btn" onclick="this.form.reset();"/>
            </td>
        </tr>
        <tr>
            <td>
                &nbsp;<select name="datetype">
                    <option value="edittime" selected>更新日期</option>
                    <option value="addtime" >发布日期</option>
                </select>&nbsp;
                <script type="text/javascript" src="http://localhost/file/script/calendar.js"></script>
                <input type="text" name="fromdate" id="fromdate" value="" size="10" onfocus="ca_show('fromdate', this, '');" readonly ondblclick="this.value='';"/> <img src="http://localhost/file/image/calendar.gif" align="absmiddle" onclick="ca_show('fromdate', this, '');" style="cursor:pointer;"/> 至 <input type="text" name="todate" id="todate" value="" size="10" onfocus="ca_show('todate', this, '');" readonly ondblclick="this.value='';"/> <img src="http://localhost/file/image/calendar.gif" align="absmiddle" onclick="ca_show('todate', this, '');" style="cursor:pointer;"/>&nbsp;
            </td>
        </tr>
    </table>
</form>
<form method="post">
    <div class="tt">品牌列表</div>
    <?php if($list!=null){ ?>

        <table cellpadding="2" cellspacing="1" class="tb">
            <tbody><tr>
                <th width="25"><input type="checkbox" onclick="checkall(this.form);"></th>

                <th width="260">标 题</th>
                <th >图片</th>
                <th width="145">发布时间</th>
                <th>浏览</th>
                <th width="50">操作</th>
            </tr>
            <?php foreach ($list as $v){?>
                <tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
                    <td><input type="checkbox" name="brandId[]" value="<?php echo $v['brandId']?>"></td>
                    <td><?php echo mb_substr($v['name'], 0, 30, 'utf-8');?></td>
                    <td>
                        <?php if($v['thumb']!=''){ ?>
                            <?php $rooturl=str_replace('index.php','',$_SERVER[SCRIPT_NAME]); ?>  <!-- [SCRIPT_NAME] => /air_admin/index.php 取出ari-->
                            <img src="<?php echo $site['image_domain'].$v['thumb'];?>" width="60" style="padding:5px;"/>
                        <?php }else{echo ' 无图'; } ?>

                    </td>
                    <td class="px11" title="添加时间<?php echo  date("Y-m-d h:s",$v['addtime']); ?>"><?php echo  date("Y-m-d h:s",$v['addtime']); ?></td>
                    <td class="px11"><?php echo $v['hits']?></td>
                    <td>
                        <a href="<?php echo site_url("brand/brand_edit/".$v['brandId'])?>">
                            <img src="<?php echo base_url("skin/images/edit.png")?>" width="16" height="16" title="修改" alt=""></a>&nbsp;
                        <a href="<?php echo site_url("brand/brand_del_one/".$v['brandId'])?>" onclick="return _delete();">
                            <img src="<?php echo base_url("skin/images/delete.png")?>" width="16" height="16" title="删除" alt=""></a>
                    </td>
                </tr>
            <?php }?>
            </tbody></table>

    <?php }else{echo '品牌为空！！';} ?>
    <div class="btns">
        <input type="submit" value=" 彻底删除 " class="btn" onclick="if(confirm('确定要删除选中品牌吗？此操作将不可撤销')){this.form.action='<?php echo site_url("brand/brand_del")?>'}else{return false;}"/>&nbsp;
    </div>
</form>
<p align='center'><?php echo($page); ?><p>
<br/>
<script type="text/javascript">Menuon(1);</script>
</body>
</html>