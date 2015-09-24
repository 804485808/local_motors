<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>添加供应</title>
    <meta name="robots" content="noindex,nofollow">
    <script type="text/javascript">window.onerror= function(){return true;}</script>
    <link rel="stylesheet" href="<?php echo base_url("skin/css/style.css")?>" type="text/css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url("skin/css/jquery.autocomplete.css")?>" media="all" />
    <script type="text/javascript" src="<?php echo base_url("skin/js/lang.js")?>"></script>
    <script type="text/javascript" src="<?php echo base_url("skin/js/config.js")?>"></script>
    <!--<script type="text/javascript" src="--><?php //echo base_url("skin/js/jquery.js")?><!--"></script>-->
    <script type="text/javascript" src="<?php echo base_url("skin/js/common.js")?>"></script>
    <script type="text/javascript" src="<?php echo base_url("skin/js/admin.js")?>"></script>
    <script type="text/javascript" src="<?php echo base_url("skin/js/ae.js")?>"></script>
    <script type="text/javascript" src="<?php echo base_url("skin/js/jquery-1.7.2.js")?>"></script>
    <script type="text/javascript" src="<?php echo base_url("skin/js/jquery-1.7.2.min.js")?>"></script>
    <script type="text/javascript" src="<?php echo base_url("skin/ckeditor/ckeditor.js")?>"></script>
    <script type="text/javascript" src="<?php echo base_url("skin/js/jquery.autocomplete.js")?>"></script>
    <SCRIPT type="text/javascript">
        var editor;
        var face;
        function initEditor(){
            editor=CKEDITOR.replace("post[content]",{
                width:"650",
                height:"200",
                toolbar:"Basic",
                skin:"v2"
            });
            editor.setData("");
        }

        $(function (){
            $("#catid").val(0);
        });

        function del_img(id){
            $.post("<?php echo site_url("/uploadimg/del_img/")?>",{"path" : Dd(id).value});
            Dd(id).value='';
        }


    </SCRIPT>
</head>
<body onload="initEditor()">
<div id="msgbox" onmouseover="closemsg();" style="display:none;"></div>
<div class="menu" onselectstart="return false" id="destoon_menu">
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tbody><tr>
            <td valign="bottom">
                <table cellpadding="0" cellspacing="0">
                    <tbody><tr>
                        <td width="10">&nbsp;</td>
                        <td id="Tab0" class="tab_on"><a href="<?php echo site_url("module/sell/add_sell2")?>">添加供应</a></td>
                        <td class="tab_nav">&nbsp;</td><td id="Tab1" class="tab"><a href="<?php echo site_url("module/sell/sell_list2")?>">供应列表</a></td>
                        <td class="tab_nav">&nbsp;</td><td id="Tab2" class="tab"><a href="<?php echo site_url("module/sell/unapproved_sell2")?>">待审核供应</a></td>
                        <td class="tab_nav">&nbsp;</td><td id="Tab3" class="tab"><a href="<?php echo site_url("module/sell/expire_sell2")?>">过期供应</a></td>
                        <td class="tab_nav">&nbsp;</td><td id="Tab4" class="tab"><a href="<?php echo site_url("module/sell/rejected_sell2")?>">未通过供应</a></td>
                        <td class="tab_nav">&nbsp;</td><td id="Tab5" class="tab"><a href="<?php echo site_url("module/sell/trash2")?>">回收站</a></td>
                        <td class="tab_nav">&nbsp;</td><td id="Tab6" class="tab"><a href="<?php echo site_url("module/sell/move_cat2")?>">移动分类</a></td>
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
</div><form method="post" action="<?php echo site_url("module/sell/save_sell")?>" id="dform" onsubmit="return check();">
<input type="hidden" name="moduleid" value="5">
<input type="hidden" name="file" value="index">
<input type="hidden" name="action" value="add">
<input type="hidden" name="itemid" value="0">
<input type="hidden" name="post[mycatid]" value="">
<div class="tt">添加供应</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tbody>
<tr>
    <td class="tl"><span class="f_red">*</span> 信息标题</td>
    <td><input name="post[title]" type="text" id="title" size="60" value="">
        <select name="post[level]">
            <option value="0">级别</option><option value="1">1 级 推荐信息</option><option value="2">2 级</option>
            <option value="3">3 级</option><option value="4">4 级</option><option value="5">5 级</option>
            <option value="6">6 级</option><option value="7">7 级</option><option value="8">8 级</option>
            <option value="9">9 级</option></select>
        <script type="text/javascript" src="<?php echo base_url("skin/js/color.js")?>"></script>
        <style type="text/css">.color_div_o {width:16px;height:16px;padding:4px 0 0 4px;background:#B6BDD2;cursor:crosshair;}.color_div_t {width:16px;height:16px;padding:4px 0 0 4px;background:#F1F2F3;}.color_div {border:#808080 1px solid;width:10px;height:10px;line-height:10px;font-size:1px;}</style><input type="hidden" name="post[style]" id="color_input_1" value=""><img src="<?php echo base_url("skin/images/color.gif")?>" width="21" height="18" align="absmiddle" id="color_img_1" style="cursor:pointer;background:" onclick="color_show(1, Dd('color_input_1').value, this);"> <br><span id="dtitle" class="f_red"></span></td>
</tr>
<tr>
    <td class="tl"><span class="f_red">*</span> 行业分类</td>
    <td><div id="catesch"></div>

        <table cellspacing="1" cellpadding="2" class="tb">
            <tbody><tr>

                <td>
                    <DIV class="selectListCate" id="selectListCate">
                        <input type="hidden" id="catid" name="post[catid]" value="0" />
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
                    </DIV>
                </td>
            </tr>
            </tbody></table>
        <br>
        <span id="dcatid" class="f_red"></span></td>
</tr>
<tr>
    <td class="tl"><span class="f_hid">*</span> 产品品牌</td>
    <td><input id="brand" name="post[brand]" type="text" size="30" value=""></td>
    <input name="post[brandId]" type="hidden" id="brandId">
</tr>
<tr>
    <td class="tl"><span class="f_hid">*</span> 详细说明</td>
    <td>
        <textarea name="post[content]" id="post[content]" rows="20" cols="100"></textarea>
    </td>
</tr>

<tr>
    <td class="tl"><span class="f_hid">*</span> 产品图片</td>
    <td>
        <input name="post[thumb]" type="text" size="60" id="thumb">&nbsp;&nbsp;
        <span onclick="Dthumb(2,180,180,Dd('thumb').value);" class="jt">[上传]</span>&nbsp;&nbsp;
        <span onclick="del_img('thumb');" class="jt">[删除]</span><br/>

        <input name="post[thumb1]" type="text" size="60" id="thumb1">&nbsp;&nbsp;
        <span onclick="Dthumb(2,180,180,Dd('thumb1').value,'','thumb1');" class="jt">[上传]</span>&nbsp;&nbsp;
        <span onclick="del_img('thumb1');" class="jt">[删除]</span><br/>

        <input name="post[thumb2]" type="text" size="60" id="thumb2">&nbsp;&nbsp;
        <span onclick="Dthumb(2,180,180,Dd('thumb2').value,'','thumb2');" class="jt">[上传]</span>&nbsp;&nbsp;
        <span onclick="Dd('thumb2').value='';" class="jt">[删除]</span><br/>


        <!-- <input type="hidden" name="post[thumb]" id="thumb" value="">
	<input type="hidden" name="post[thumb1]" id="thumb1" value="">
	<input type="hidden" name="post[thumb2]" id="thumb2" value="">
	<table width="360">
	<tbody><tr align="center" height="120" class="c_p">
	<td width="120"><img src="<?php echo base_url("skin/images/waitpic.gif")?>" width="100" height="100" id="showthumb" title="预览图片" alt="" onclick="if(this.src.indexOf('waitpic.gif') == -1){_preview(Dd('showthumb').src, 1);}else{Dalbum('',5,100,100, Dd('thumb').value, true);}"></td>
	<td width="120"><img src="<?php echo base_url("skin/images/waitpic.gif")?>" width="100" height="100" id="showthumb1" title="预览图片" alt="" onclick="if(this.src.indexOf('waitpic.gif') == -1){_preview(Dd('showthumb1').src, 1);}else{Dalbum(1,5,100,100, Dd('thumb1').value, true);}"></td>
	<td width="120"><img src="<?php echo base_url("skin/images/waitpic.gif")?>" width="100" height="100" id="showthumb2" title="预览图片" alt="" onclick="if(this.src.indexOf('waitpic.gif') == -1){_preview(Dd('showthumb2').src, 1);}else{Dalbum(2,5,100,100, Dd('thumb2').value, true);}"></td>
	</tr>
	<tr align="center" class="c_p">
	<td><span onclick="Dalbum('',5,100,100, Dd('thumb').value, true);" class="jt"><img src="<?php echo base_url("skin/images/img_upload.gif")?>" width="12" height="12" title="上传"></span>&nbsp;&nbsp;<img src="<?php echo base_url("skin/images/img_select.gif")?>" width="12" height="12" title="选择" onclick="selAlbum('');">&nbsp;&nbsp;<span onclick="delAlbum('', 'wait');" class="jt"><img src="<?php echo base_url("skin/images/img_delete.gif")?>" width="12" height="12" title="删除"></span></td>
	<td><span onclick="Dalbum(1,5,100,100, Dd('thumb1').value, true);" class="jt"><img src="<?php echo base_url("skin/images/img_upload.gif")?>" width="12" height="12" title="上传"></span>&nbsp;&nbsp;<img src="<?php echo base_url("skin/images/img_select.gif")?>" width="12" height="12" title="选择" onclick="selAlbum(1);">&nbsp;&nbsp;<span onclick="delAlbum(1, 'wait');" class="jt"><img src="<?php echo base_url("skin/images/img_delete.gif")?>" width="12" height="12" title="删除"></span></td>
	<td><span onclick="Dalbum(2,5,100,100, Dd('thumb2').value, true);" class="jt"><img src="<?php echo base_url("skin/images/img_upload.gif")?>" width="12" height="12" title="上传"></span>&nbsp;&nbsp;<img src="<?php echo base_url("skin/images/img_select.gif")?>" width="12" height="12" title="选择" onclick="selAlbum(2);">&nbsp;&nbsp;<span onclick="delAlbum(2, 'wait');" class="jt"><img src="<?php echo base_url("skin/images/img_delete.gif")?>" width="12" height="12" title="删除"></span></td>
	</tr>
	</tbody></table> -->
    </td>
</tr>
<tr>
    <td class="tl"><span class="f_hid">*</span> 过期时间</td>
    <td><script type="text/javascript" src="<?php echo base_url("skin/js/calendar.js")?>"></script><input type="text" name="post[totime]" id="posttotime" value="" size="10" onfocus="ca_show('posttotime', this, '-');" readonly="" ondblclick="this.value='';"> <img src="<?php echo base_url("skin/images/calendar.gif")?>" align="absmiddle" onclick="ca_show('posttotime', this, '-');" style="cursor:pointer;">&nbsp;
        <select onchange="Dd('posttotime').value=this.value;">
            <option value="">快捷选择</option>
            <option value="">长期有效</option>
            <option value="2013-07-26">3天</option>
            <option value="2013-07-30">一周</option>
            <option value="2013-08-07">半月</option>
            <option value="2013-08-22">一月</option>
            <option value="2014-01-21">半年</option>
            <option value="2014-07-23">一年</option>
        </select>&nbsp;
        <span id="dposttotime" class="f_red"></span> 不选表示长期有效</td>
</tr>
<tr>
    <td class="tl"><span class="f_hid">*</span> 主要参数</td>
    <td class="nv">
        <table cellspacing="1" >
            <tbody id="shuxin">
            <tr>
                <th>参数名称</th>
                <th>参数值</th>
            </tr>
           <!-- <tr>
                <td><input name="post[model_name]" type="text" size="10"  id="n1" onkeyup="getOption('n1')" ></td>
                <td><input name="post[model]" type="text" size="20" value="" id="v1"></td>
                <input type="hidden" name="post[n1]" id="n1Option">
            </tr>
            <tr>
                <td><input name="post[standard_name]" type="text" size="10"  id="n2" onkeyup="getOption('n2')" ></td>
                <td><input name="post[standard]" type="text" size="20" value="" id="v2"></td>
                <input type="hidden" name="post[n2]" id="n2Option">
            </tr>
            <tr>
                <td><input name="post[n3]" type="text" size="10" value="" id="n3" onkeyup="getOption('n3')"></td>
                <td><input name="post[v3]" type="text" size="20" value="" id="v3"></td>
                <input type="hidden" name="post[n3]" id="n3Option">
            </tr>
            <tr>
                <td class="f_gray">例如：规格</td>
                <td class="f_gray">例如：10cm*20cm</td>
            </tr>-->
            </tbody></table>
    </td>
</tr>
<tr>
    <td class="tl"><span class="f_hid">*</span> 交易条件</td>
    <td>
        <table width="100%">
            <tbody><tr>
                <td width="70">计量单位</td>
                <td><input name="post[unit]" type="text" size="10" value="" onkeyup="if(this.value){Dd('u1').innerHTML=Dd('u2').innerHTML=Dd('u3').innerHTML=this.value;}" id="u0">
                    <input type="hidden" id="uu" value="单位"></td>
            </tr>
            <tr>
                <td width="70">货币单位</td>
                <td><input name="post[currency]" size="10" value="" onkeyup="if(this.value){Dd('c1').innerHTML=this.value;}" id="u0" type="text">
                    <input id="uu" value="货币" type="hidden"></td>
            </tr>
            <tr>
                <td>产品单价</td>
                <td>
                    <input name="post[minprice]" type="text" size="10" value="">——
                    <input name="post[maxprice]" size="10" value="" type="text">
                    <span id="c1"> 元</span>/<span id="u1">单位</span></td>
            </tr>
            <tr>
                <td>最小起订量</td>
                <td><input name="post[minamount]" type="text" size="10" value=""> <span id="u2">单位</span></td>
            </tr>
            <tr>
                <td>供货总量</td>
                <td><input name="post[amount]" type="text" size="10" value=""> <span id="u3">单位</span></td>
            </tr>
            <tr>
                <td>发货期限</td>
                <td>自买家付款之日起 <input name="post[days]" type="text" size="2" value=""> 天内发货</td>
            </tr>
            </tbody></table>
    </td>
</tr>
<tr>
    <td class="tl"><span class="f_hid">*</span> 会员信息</td>
    <td>
        <input type="radio" name="ismember" value="1" checked="" onclick="Dh('d_guest');Ds('d_member');Dd('username').value='admin';" id="ismember_1"><label for="ismember_1"> 是</label>&nbsp;&nbsp;&nbsp;
        <input type="radio" name="ismember" value="0" onclick="Dh('d_member');Ds('d_guest');Dd('username').value='';" id="ismember_0"><label for="ismember_0"> 否</label>
    </td>
</tr>
</tbody><tbody id="d_member" style="display:">
<tr>
    <td class="tl"><span class="f_red">*</span> 会员名</td>
    <td><input name="post[username]" type="text" size="20" value="" id="username"> <span id="dusername" class="f_red">查看会员信息</span></td>
        <input type="hidden" id="userid">
</tr>

<tr>
    <td class="tl"><span class="f_red">*</span> 分类</td>
    <td>
        <select name="post[mycatid]" id="mycatid">
        </select>
    </td>
    <input type="hidden" id="userid">
</tr>

<tr>
    <td class="tl"><span class="f_hid">*</span> 会员推荐产品</td>
    <td>
        <input type="radio" name="post[elite]" value="1"> 是&nbsp;&nbsp;&nbsp;
        <input type="radio" name="post[elite]" value="0" checked=""> 否
    </td>
</tr>
</tbody>
<tbody id="d_guest" style="display:none">
<tr>
    <td class="tl"><span class="f_red">*</span> 公司名称</td>
    <td class="tr"><input name="post[company]" type="text" id="company" size="50" value=""> 个人请填姓名 例如：张三<br><span id="dcompany" class="f_red"></span> </td>
</tr>

<tr>
    <td class="tl"><span class="f_red">*</span> 联系人</td>
    <td class="tr"><input name="post[truename]" disabled="disabled" type="text" id="truename" size="20" value=""> <span id="dtruename" class="f_red"></span></td>
</tr>
<tr>
    <td class="tl"><span class="f_red">*</span> 联系手机</td>
    <td class="tr"><input name="post[mobile]" id="mobile" disabled="disabled" type="text" size="30" value=""> <span id="dmobile" class="f_red"></span></td>
</tr>
<tr>
    <td class="tl"><span class="f_hid">*</span> 电子邮件</td>
    <td class="tr"><input name="post[email]" disabled="disabled" id="email" type="text" size="30" value=""> <span id="demail" class="f_red"></span></td>
</tr>

<tr>
    <td class="tl"><span class="f_hid">*</span> QQ</td>
    <td class="tr"><input name="post[qq]" disabled="disabled" id="qq" type="text" size="30" value=""></td>
</tr>
<tr>
    <td class="tl"><span class="f_hid">*</span> 阿里旺旺</td>
    <td class="tr"><input name="post[ali]" disabled="disabled" id="ali" type="text" size="30" value=""></td>
</tr>

<tr>
    <td class="tl"><span class="f_hid">*</span> Skype</td>
    <td class="tr"><input name="post[skype]" disabled="disabled" id="skype" type="text" size="30" value=""></td>
</tr>
</tbody>
<tbody><tr>
    <td class="tl"><span class="f_hid">*</span> 信息状态</td>
    <td>
        <input type="radio" name="post[status]" value="3" checked=""> 通过
        <input type="radio" name="post[status]" value="1"> 待审
        <input type="radio" name="post[status]" value="2" onclick="if(this.checked) Dd('note').style.display='';"> 拒绝
        <input type="radio" name="post[status]" value="5"> 过期
        <input type="radio" name="post[status]" value="0"> 删除
    </td>
</tr>
<tr id="note" style="display:none">
    <td class="tl"><span class="f_red">*</span> 拒绝理由</td>
    <td><input name="post[note]" type="text" size="40" value=""></td>
</tr>
<tr>
    <td class="tl"><span class="f_hid">*</span> 添加时间</td>
    <td><input type="text" size="22" name="post[adddate]" value="<?php echo date("Y-m-d H:i:s")?>"></td>
</tr>
<tr>
    <td class="tl"><span class="f_hid">*</span> 浏览次数</td>
    <td><input name="post[hits]" type="text" size="10" value=""></td>
</tr>
<tr>
    <td class="tl"><span class="f_hid">*</span> 内容收费</td>
    <td><input name="post[fee]" type="text" size="5" value=""> <img src="<?php echo base_url("skin/images/help.png")?>" width="11" height="11" title="不填或填0表示继承模块设置价格，-1表示不收费&lt;br/&gt;大于0的数字表示具体收费价格" alt="tips" class="c_p" onclick="Dconfirm(this.title, '', 450);"></td>
</tr>
<!-- <tr>
<td class="tl"><span class="f_hid">*</span> 内容模板</td>
<td><span id="destoon_template_1"><select name="post[template]" id="template"><option value="">默认模板</option></select></span>&nbsp;&nbsp;<a href="javascript:tpl_edit('show', 'sell', 1);" class="t">[修改]</a> &nbsp;<a href="javascript:tpl_add('show', 'sell');" class="t">[新建]</a> <img src="<?php echo base_url("skin/images/help.png")?>" width="11" height="11" title="如果没有特殊需要，一般不需要选择&lt;br/&gt;系统会自动继承分类或模块设置" alt="tips" class="c_p" onclick="Dconfirm(this.title, '', 450);"></td>
</tr> -->
</tbody></table>
<div class="sbt"><input type="submit" name="submit" value=" 确 定 " class="btn">&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value=" 重 置 " class="btn"></div>
</form>
<script type="text/javascript" src="<?php echo base_url("skin/js/clear.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/guest.js")?>"></script>
<script type="text/javascript">
    function _p() {
        if(Dd('tag').value) {
            Ds('reccate');
        }
    }
    function check() {
        var l;
        var f;
        f = 'catid';
        if(Dd(f).value == 0) {
            Dmsg('所属行业分类不是最后一级，请继续选择', 'catid', 1);
            return false;
        }
        f = 'title';
        l = Dd(f).value.length;
        if(l < 2) {
            Dmsg('标题最少2字，当前已输入'+l+'字', f);
            return false;
        }
        if(Dd('ismember_1').checked) {
            f = 'username';
            l = Dd(f).value.length;
            if(l < 2) {
                Dmsg('请填写会员名', f);
                return false;
            }
        } else {
            f = 'company';
            l = Dd(f).value.length;
            if(l < 2) {
                Dmsg('请填写公司名称', f);
                return false;
            }
            if(Dd('areaid_1').value == 0) {
                Dmsg('请选择所在地区', 'areaid');
                return false;
            }
            f = 'truename';
            l = Dd(f).value.length;
            if(l < 2) {
                Dmsg('请填写联系人', f);
                return false;
            }
            f = 'mobile';
            l = Dd(f).value.length;
            if(l < 7) {
                Dmsg('请填写手机', f);
                return false;
            }
        }
        if(Dd('property_require') != null) {
            var ptrs = Dd('property_require').getElementsByTagName('option');
            for(var i = 0; i < ptrs.length; i++) {
                f = 'property-'+ptrs[i].value;
                if(Dd(f).value == 0 || Dd(f).value == '') {
                    Dmsg('请填写或选择'+ptrs[i].innerHTML, f);
                    return false;
                }
            }
        }
        return true;
    }
</script>

<script type="text/javascript">
    //品牌选择
    $("#brand").keyup(function() {
        var brand = $(this).val();
        $.ajax({
            url: 'brand',
            type: 'post',
            dataType: 'json',
            async:'false',
            data: {brand_name: brand},
            success: function (data) {
                if (data) {
                    $('#brand').autocomplete(data, {
                        max: 12,    //列表里的条目数
                        minChars: 0,    //自动完成激活之前填入的最小字符
                        width: 400,     //提示的宽度，溢出隐藏
                        scrollHeight: 300,   //提示的高度，溢出显示滚动条
                        matchContains: true,    //包含匹配，就是data参数里的数据，是否只要包含文本框里的数据就显示
                        autoFill: false,    //自动填充
                        formatItem: function (row, i, max) {
                            return row.name;
                        },
                        formatMatch: function (row, i, max) {
                            return row.name;
                        },
                        formatResult: function (row) {
                            return row.name;
                        }
                    }).result(function (event, row, formatted) {
                        $("#brandId").val(row.id);
                    });
                }
            }
        })

    })

    //查看会员信息
    $("#dusername").click(function(){
        
        var userid = $("#userid").val();
        $.ajax({
            url:'getMemberDetail',
            type:'post',
            dataType:'json',
            data:{userid:userid},
            success:function(data){
                $("#company").val(data.company);
                $("#truename").val(data.truename);
                $("#mobile").val(data.mobile);
                $("#email").val(data.email);
                $("#qq").val(data.qq);
                $("#ali").val(data.ali);
                $("#skype").val(data.skype);
                $("#d_guest").show()
            }
        })
    })

    //会员选择
    $('#username').focus().autocomplete(<?php echo $allMember?>, {
        max: 12,    //列表里的条目数
        minChars: 0,    //自动完成激活之前填入的最小字符
        width: 400,     //提示的宽度，溢出隐藏
        scrollHeight: 300,   //提示的高度，溢出显示滚动条
        matchContains: true,    //包含匹配，就是data参数里的数据，是否只要包含文本框里的数据就显示
        autoFill: false,    //自动填充
        formatItem: function (row, i, max) {
            return row.username;
        },
        formatMatch: function (row, i, max) {
            return row.username;
        },
        formatResult: function (row) {
            return row.username;
        }
    }).result(function (event, row, formatted) {
        getUserCategory(row.userid)
        $("#userid").val(row.userid);
    });

    $("#username").blur(function(){
        getUserCategory($("#userid").val());
    })
    //获取会员自定义分类
    function getUserCategory(userid){
        $.ajax({
            url:'getMemberType',
            type:'post',
            dataType:'html',
            data:{userid:userid},
            success:function(data){
                $("#mycatid").empty();
                $("#mycatid").append(data);
            }
        })
    }



</script>

<script type="text/javascript">
    $(function(){
        //分类查询
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
                        //参数查询
                        $.ajax({
                            url: 'category',
                            type: 'post',
                            dataType: 'html',
                            data: {catid: catid},
                            success: function (data) {
                                if(data.length > 0 ) {
                                    $("#shuxin").empty();
                                    $("#shuxin").append(data);
                                }
                                else
                                {
                                    $("#shuxin").empty();
                                }
                            }
                        });
                    }
                }
            })
        });
    })
</script>
<script type="text/javascript">Menuon(0);</script>
<iframe src="<?php echo base_url("skin/images/javascript:void(0)")?>" frameborder="0" scrolling="no" height="0" width="0" style="position: absolute; z-index: 10000;"></iframe><iframe src="<?php echo base_url("skin/images/javascript:void(0)")?>" frameborder="0" scrolling="no" height="0" width="0" style="position: absolute; z-index: 10000;"></iframe><iframe src="<?php echo base_url("skin/images/javascript:void(0)")?>" frameborder="0" scrolling="no" height="0" width="0" style="position: absolute; z-index: 10000;"></iframe></body><script>window.FCKeditorAPI = {Version : "2.6",VersionBuild : "18638",Instances : new Object(),GetInstance : function( name ){return this.Instances[ name ];},_FormSubmit : function(){for ( var name in FCKeditorAPI.Instances ){var oEditor = FCKeditorAPI.Instances[ name ] ;if ( oEditor.GetParentForm && oEditor.GetParentForm() == this )oEditor.UpdateLinkedField() ;}this._FCKOriginalSubmit() ;},_FunctionQueue	: {Functions : new Array(),IsRunning : false,Add : function( f ){this.Functions.push( f );if ( !this.IsRunning )this.StartNext();},StartNext : function(){var aQueue = this.Functions ;if ( aQueue.length > 0 ){this.IsRunning = true;aQueue[0].call();}else this.IsRunning = false;},Remove : function( f ){var aQueue = this.Functions;var i = 0, fFunc;while( (fFunc = aQueue[ i ]) ){if ( fFunc == f )aQueue.splice( i,1 );i++ ;}this.StartNext();}}}</script></html>
