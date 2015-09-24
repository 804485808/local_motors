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

    <div class="tt">作者搜索</div>
    <table  cellpadding="2" cellspacing="1" class="tb">
        <tbody><tr>
            <td>
                <input type="text" size="60" style="height: 20" id="username" value=""/>
                &nbsp;&nbsp;
                <input type="submit" class="btn" id="sou" value="搜索"/>
            </td>

               </tr>
        </tbody></table>
<form method="post">
    <input name="catid" value="<?php echo $catid?>" type="hidden">
    <div class="tt">作者列表</div>
    <table class="tb" cellpadding="2" cellspacing="1" id="td" >
        <tbody id="tdd"><tr>
            <th width="40">排序</th>
            <th>ID</th>
            <th>会员</th>
            <th>公司</th>
            <th>email</th>
        </tr>

        <?php foreach($user as $k=>$v){?>
        <tr >
            <td><?php echo $k?></td>
            <td ><?php echo $v['userid']?></td>
            <td><?php echo $v['username']?></td>
            <td><?php echo $v['company']?></td>
            <td><?php echo $v['email']?></td>
        </tr>
        <?php }?>

        </tbody></table>
    <div class="btns">
        <input value=" 更新排序 " class="btn" onclick="this.form.action='<?php echo site_url("module/category/update_attrlist")?>';" type="submit">&nbsp;&nbsp;&nbsp;&nbsp;
        <input value=" 关 闭 " class="btn" onclick="window.parent.location.reload();" type="button">
    </div>
</form>
<div class="pages"></div>
<script type="text/javascript">

    function changColor(){
        $("#td tr").bind("mouseover",function(){
            $("#td tr").attr('style','')
            $(this).attr('style','background: #65799E');
        })
    }

    function selectUser() {
        $("#td tr").bind("dblclick", function () {
            var userid = $(this).children().eq(1).html();
            var username = $(this).children().eq(2).html();
            $("#author", parent.document).val(username)
            $("#userid", parent.document).val(userid)

            parent.cDialog();
        })
    }

    $("#sou").click(function(){
        var username = $("#username").val()
        $.ajax({
            url:'<?php echo site_url("member/member/selectMember")?>',
            type:'post',
            dataType:'html',
            async:false,
            data:{username:username},
            success:function(data){
                $("#td tr:gt(0)").remove();
                $("#tdd").append(data);
                selectUser();
            }
        })
    })

    $(document).ready(function(){
        changColor();
        selectUser();
    })
</script>

</body></html>