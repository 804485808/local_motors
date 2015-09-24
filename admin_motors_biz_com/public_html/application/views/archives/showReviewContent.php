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


<form id="formAddHandlingFee" method="post">

    <div class="tt">评论详情</div>
    <table class="tb" cellpadding="2" cellspacing="1" id="td" >
        <input type="hidden" name="post[id]" value="<?php echo $detail['id']?>">
        <tr>
            <td width="100">
                访客:<?php echo $detail['username']?>
            </td>
            <td>
                <textarea name="post[content]" rows="15" cols="60"><?php echo $detail['content']?></textarea>
            </td>
        </tr>



        </tbody></table>
    <div class="btns">
        <input value=" 更新 " class="btn" onclick="saveReview()" type="button">&nbsp;&nbsp;&nbsp;&nbsp;
        <input value=" 关 闭 " class="btn" onclick="window.parent.location.reload();" type="button">
    </div>
</form>
<div class="pages"></div>
<script type="text/javascript">

function saveReview(){
    $.ajax({
        url:'<?php echo site_url("archives/updateReview")?>',
        type:'post',
        dataType:'html',
        data: $('#formAddHandlingFee').serialize(),
        success:function(data){
            if(data == 1){
                window.parent.location.reload();
                parent.cDialog();
            }
        }
    })
}


</script>

</body></html>