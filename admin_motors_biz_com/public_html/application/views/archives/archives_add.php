<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>添加供应</title>
    <meta name="robots" content="noindex,nofollow">
    <script type="text/javascript">window.onerror= function(){return true;}</script>
    <link rel="stylesheet" href="<?php echo base_url("skin/css/style.css")?>" type="text/css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url("skin/css/jquery.autocomplete.css")?>" media="all" />
    <script type="text/javascript" src="<?php echo base_url("skin/js/lang.js")?>"></script>
    <script type="text/javascript" src="<?php echo base_url("skin/js/config.js")?>"></script>
    <script type="text/javascript" src="<?php echo base_url("skin/js/jquery.js")?>"></script>
    <script type="text/javascript" src="<?php echo base_url("skin/js/common.js")?>"></script>
    <script type="text/javascript" src="<?php echo base_url("skin/js/admin.js")?>"></script>
    <script type="text/javascript" src="<?php echo base_url("skin/js/ae.js")?>"></script>
    <script type="text/javascript" src="<?php echo base_url("skin/js/jquery-1.7.2.js")?>"></script>
    <script type="text/javascript" src="<?php echo base_url("skin/js/jquery-1.7.2.min.js")?>"></script>
    <script type="text/javascript" src="<?php echo base_url("skin/kindeditor/themes/default/default.css")?>"></script>
    <script type="text/javascript" src="<?php echo base_url("skin/kindeditor/plugins/code/prettify.css")?>"></script>
    <script type="text/javascript" src="<?php echo base_url("skin/kindeditor/kindeditor.js")?>"></script>
    <script type="text/javascript" src="<?php echo base_url("skin/kindeditor/lang/zh_CN.js")?>"></script>
    <script type="text/javascript" src="<?php echo base_url("skin/kindeditor/plugins/code/prettify.js")?>"></script>
    <script type="text/javascript" src="<?php echo base_url("skin/js/jquery.autocomplete.js")?>"></script>


    <script type="text/javascript" src="<?php echo base_url("skin/ueditor/ueditor.config.js")?>"></script>
    <script type="text/javascript" src="<?php echo base_url("skin/ueditor/ueditor.all.min.js")?>"></script>

    <script language="javascript" type="text/javascript" src="<?php echo base_url("skin/tiny_mce/tiny_mce.js")?>"></script>
    <script language="javascript" type="text/javascript">

        tinyMCE.init({
            theme : "advanced",
            relative_urls : false,
            plugins : "preview,jbimages",
            mode : "textareas",
            theme_advanced_buttons1 : "code,preview,fontselect,fontsizeselect,bold,italic,underline,undo,redo,forecolor,backcolor,removeformat,numlist,bullist,jbimages",
            plugin_preview_width : "500",
            plugin_preview_height : "400",
            editor_selector : "input_P_2"
        });

        tinyMCE.init({
            theme : "simple",
            relative_urls : false,
            mode : "textareas",
            plugin_preview_width : "500",
            plugin_preview_height : "30",
            editor_selector : "no"
        });
    </script>



    <SCRIPT type="text/javascript">
        function del_img(id){
            $.post("<?php echo site_url("/uploadimg/del_img/")?>",{"path" : Dd(id).value});
            Dd(id).value='';
        }
    </SCRIPT>

    <script type="text/javascript">

        function checkform(title,content,typeid){
            title = document.getElementById(title).value;
            if(title==''){
                alert('标题不能为空');
                return false;
            }
            content = document.getElementById(content).value;
            if(content==''){
                var flfl='内容不能为空';
            }

        }

    </script>



</head>
<body onload="html()">
<div id="msgbox" onmouseover="closemsg();" style="display:none;"></div>
<div class="menu" onselectstart="return false" id="destoon_menu">
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tbody><tr>
            <td valign="bottom">
                <table cellpadding="0" cellspacing="0">
                    <tbody><tr>
                        <td width="10">&nbsp;</td>
                        <td id="Tab0" class="tab_on"><a href="<?php echo site_url("archives/archives_add")?>">添加资讯</a></td><td class="tab_nav">&nbsp;</td>
                        <td id="Tab1" class="<?php echo $type=$status==3?'tab_on':'tab'?>"><a href="<?php echo site_url("archives/archives_list")?>">资讯列表</a></td><td class="tab_nav">&nbsp;</td>
                        <td id="Tab2" class="<?php echo $type=$status==1?'tab_on':'tab'?>"><a href="<?php echo site_url("archives/archives_list/1")?>">待审核咨询</a></td><td class="tab_nav">&nbsp;</td></a></td><td class="tab_nav">&nbsp;</td>
                        <td id="Tab4" class="<?php echo $type=$status==2?'tab_on':'tab'?>"><a href="<?php echo site_url("archives/archives_list/2")?>">未通过咨询</a></td><td class="tab_nav">&nbsp;</td>

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
</div><!--<form method="post" action="<?php //echo site_url("")?>" id="dform"  enctype="multipart/form-data">-->
<?php echo form_open_multipart('archives/archives_add',$onsubmit);?>
<!--<form method="post" action="<?php echo site_url("archives/archives_add")?>" id="dform" >-->
<!--onsubmit="return check();"-->
<input type="hidden" name="moduleid" value="5">
<input type="hidden" name="file" value="index">
<input type="hidden" name="action" value="add">
<input type="hidden" name="post[itemid]" value="<?php echo $itemid?$itemid:''?>">
<div class="tt">添加供应</div>
<table cellpadding="2" cellspacing="1" class="tb">
    <tbody>

    <tr>
        <td class="tl"><span class="f_red">*</span> 信息标题</td>
        <td><input name="post[title]" type="text" id="post[title]" size="60" value="<?php echo $title = $title?$title:'';?>">
            <select name="post[level]" id="level">
                <option value="0" <?php echo $level==0?"selected='selected'":'' ?>>级别</option>
                <option value="1" <?php echo $level==1?"selected='selected'":'' ?>>1 级 推荐信息</option>
                <option value="2" <?php echo $level==2?"selected='selected'":'' ?> >2 级</option>
                <option value="3" <?php echo $level==3?"selected='selected'":'' ?>>3 级</option>
                <option value="4" <?php echo $level==4?"selected='selected'":'' ?>>4 级</option>
                <option value="5" <?php echo $level==5?"selected='selected'":'' ?>>5 级</option>
                <option value="6" <?php echo $level==6?"selected='selected'":'' ?>>6 级</option>
                <option value="7" <?php echo $level==7?"selected='selected'":'' ?>>7 级</option>
                <option value="8" <?php echo $level==8?"selected='selected'":'' ?>>8 级</option>
            <option value="9">9 级</option>
            </select>
            <script type="text/javascript" src="<?php echo base_url("skin/js/color.js")?>"></script>
            <style type="text/css">
                .color_div_o {width:16px;height:16px;padding:4px 0 0 4px;background:#B6BDD2;cursor:crosshair;}
                .color_div_t {width:16px;height:16px;padding:4px 0 0 4px;background:#F1F2F3;}
                .color_div {border:#808080 1px solid;width:10px;height:10px;line-height:10px;font-size:1px;}
            </style><input type="hidden" name="post[style]" id="color_input_1" value="<?php echo $style?>">
            <img src="<?php echo base_url("skin/images/color.gif")?>" width="21" height="18"  align="absmiddle" id="color_img_1" style="cursor:pointer;background:<?php echo $style?>" onclick="color_show(1, Dd('color_input_1').value, this);">
            <br>
            <span id="dtitle" class="f_red"></span></td>

       </tr>

    <tr>
        <td class="tl"><span class="f_hid">*</span>标题图片</td>
        <td>

            <input name="post[thumb]" type="text" size="60" id="thumb" value="<?php echo $thumb?$thumb:''?>">&nbsp;&nbsp;
            <span onclick="Dthumb(2,180,180,Dd('thumb').value);" class="jt">[上传]</span>&nbsp;&nbsp;
            <span onclick="del_img('thumb');" class="jt">[删除]</span><br/>

        </td>
    </tr>


    <tr>
        <td class="tl"> 行业分类</td>
        <td><div id="catesch"></div>

            <!-- <SCRIPT type="text/javascript">
            function load_category(catid){
                $(function(){
                    $.ajaxSetup({cache:false});
                    var $catid = catid;
                    $('span#load_category_1').load('/biz_admin/index.php/module/category/subcategory/'+$catid);
                    $("#catid").val($catid);

                });
            }
            </SCRIPT> -->

            <table cellspacing="1" cellpadding="2" class="tb">
                <tbody><tr>

                    <td>
                        <div style='float:left;' id='class_ajax1'>
                            <!--<select name='post[classid]' id='post[classid]'>-->
                            &nbsp;&nbsp;<span style="color: #1B3DE8;font-size: 15px;font-family: 'Times New Roman';font-weight:bold" id="catname"><?php echo $catname?$catname:''?></span>
                            <input name="post[catid]" type="hidden" id="catid" value="<?php echo $catid?$catid:0?>"/>
                            <select  id='select1' style="float:left;">
                                <option>请选择</option>
                                <?php foreach($class as $c){ ?>
                                    <option value="<?php echo $c['catid']; ?>"><?php echo $c['catname']; ?></option>
                                <?php } ?>
                            </select>
                            <select  id='select2' style="display: none;float:left;">
                                <option>请选择</option>
                            </select>

                            <select  id='select3' style="display: none;float:left;">
                                <option>请选择</option>
                            </select>

                            <select  id='select4' style="display: none;float:left;">
                                <option>请选择</option>
                            </select>
                        </div>
                    </td>


                </tr>
                </tbody></table>
            <br>
            <span id="dcatid" class="f_red"></span></td>
    </tr>

    <tr>
        <td class="tl"><span class="f_hid">*</span> 详细说明</td>
        <td>
                <script id="editor" name="post[content]" type="text/plain" style="width:1024px;height:500px;"><?php echo $content?></script>
            <br />
        </td>
    </tr>

    <tr>
        <td class="tl"><span class="f_hid">*</span>关键词</td>
        <td>
            <input name="post[tag]" size="60" value="<?php echo $tag?>" type="text"/>(多个关键词用空格隔开)
        </td>
    </tr>

    <tr>
        <td class="tl"><span class="f_hid">*</span>作者</td>
        <td>
            <input type="hidden" name="post[userid]" id="userid" value="<?php echo $userid?>"/>
            <input type="text" name="post[author]" id="author" value="<?php echo $author?>"/>
            <a href="javascript:Dwidget('<?php echo site_url("member/member/selectMember/")?>', '扩展属性',675,325);">选择</a>
            &nbsp;&nbsp;
            &nbsp;&nbsp;
            &nbsp;&nbsp;
            咨询来源
            <input type="text" name="post[copyfrom]" value="<?php echo $copyfrom?>"/>
            来源链接
            <input type="text" name="post[fromurl]" value="<?php echo $fromurl?>"/>
        </td>

    </tr>



    </tbody>
</table>
<div class="sbt"><input type="submit" name="submit" value=" 确 定 " class="btn">&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" name="reset" value=" 重 置 " class="btn"></div>
</form><!--reset-->
<script type="text/javascript" src="<?php echo base_url("skin/js/clear.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("skin/js/guest.js")?>"></script>

<script type="text/javascript">Menuon(0);</script>
<iframe src="<?php echo base_url("skin/images/javascript:void(0)")?>" frameborder="0" scrolling="no" height="0" width="0" style="position: absolute; z-index: 10000;"></iframe>
<iframe src="<?php echo base_url("skin/images/javascript:void(0)")?>" frameborder="0" scrolling="no" height="0" width="0" style="position: absolute; z-index: 10000;"></iframe>
<iframe src="<?php echo base_url("skin/images/javascript:void(0)")?>" frameborder="0" scrolling="no" height="0" width="0" style="position: absolute; z-index: 10000;"></iframe>
</body>
<script>
    window.FCKeditorAPI = {Version : "2.6",VersionBuild : "18638",Instances : new Object(),GetInstance : function( name ){return this.Instances[ name ];},
        _FormSubmit : function(){for ( var name in FCKeditorAPI.Instances ){var oEditor = FCKeditorAPI.Instances[ name ] ;
            if ( oEditor.GetParentForm && oEditor.GetParentForm() == this )oEditor.UpdateLinkedField() ;}this._FCKOriginalSubmit() ;},_FunctionQueue	: {Functions : new Array(),IsRunning : false,Add : function( f ){this.Functions.push( f );if ( !this.IsRunning )this.StartNext();},StartNext : function(){var aQueue = this.Functions ;if ( aQueue.length > 0 ){this.IsRunning = true;aQueue[0].call();}else this.IsRunning = false;},Remove : function( f ){var aQueue = this.Functions;var i = 0, fFunc;while( (fFunc = aQueue[ i ]) ){if ( fFunc == f )aQueue.splice( i,1 );i++ ;}this.StartNext();}}}</script></html>
<script type="text/javascript">
    $("#select1").change(function(){
        var catid = $(this).val()
        var catname = $(this).find("option:selected").text();
        $("#catid").val(catid)
        $("#catname").html(catname)
        var obj = $("#select2");
        getCategory(catid,obj)
    })

    $("#select2").change(function(){
        var catid = $(this).val()
        var catname = $(this).find("option:selected").text();
        $("#catid").val(catid)
        $("#catname").html(catname)
        var obj = $("#select3");
        getCategory(catid,obj)
    })

    $("#select3").change(function(){
        var catid = $(this).val()
        var catname = $(this).find("option:selected").text();
        $("#catid").val(catid)
        $("#catname").html(catname)
        var obj = $("#select4");
        getCategory(catid,obj)
    })

    function getCategory(catid,obj){
        $.ajax({
            url:'<?php echo site_url('archives/selectCategory')?>',
            type:'post',
            dataType:'html',
            data:{catid:catid},
            success:function(data){
                if(data == 2 ){
                    $("#catid").val(catid);
                    obj.next().next().css('display','none')
                    obj.next().css('display','none')
                    obj.css('display','none');
                }else{
                    obj.css('display','block');
                    obj.empty();
                    obj.append("<option>请选择</option>");
                    obj.append(data)

                }
            }
        })
    }

    //会员选择
    $('#author').focus().autocomplete(<?php echo $allMember?>, {
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
//        getUserCategory(row.userid)
        $("#userid").val(row.userid);
    });




</script>

<script type="text/javascript">

    //实例化编辑器
    //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
    var ue = UE.getEditor('editor');


</script>