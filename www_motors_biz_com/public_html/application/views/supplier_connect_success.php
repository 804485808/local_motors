<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head><title>
</title>
    <link href="<?php echo base_url("skin_user/css/inquiry_common.css")?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url("skin_user/css/details.css")?>" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
     <script type="text/javascript">
        document.domain = "<?php echo $site['site_url']?>";
    </script>
</head>
<body>
<div id="iqMsgbox"></div>
<div id="iqShowImg"></div>  
<div id="titlebar"><span>Send a message directly to supplier(s)</span></div>


<div id="inquiryBox" class="inquiryBox">
    <div class="successMsg">
    <p>
        <strong>Thank you! Your message has been successfully sent to the supplier. </strong><br />

        Replies will be sent to <span style="font-weight:bold;"><?php echo $email?></span>
    </p>
    
    <p>The layer will be closed in <span id="sec" style="color:#f00;">10</span> seconds</p>
    </div>
</div>
                                                    
<script type="text/javascript">
    var sec = 10;
    var showSec = function() { if (sec > 0) { sec--;  $("#sec").html(sec); setTimeout(showSec, 1000); } else { parent.GetInquiry.CloseBox(); } }
    function InitBind() {
        setTimeout(showSec, 1000);
    }
    var stepHeight = "400px";
    parent.MultiSelect.ClearCookie();
</script>

<span onclick="parent.GetInquiry.CloseBox()" class="close">x</span>
  
<script type="text/javascript">
    var DoInquiry = {
        //显示响应提示信息
        ShowResponseMsg: function(result) {
            var msgbox = $("#iqMsgbox");
            var iWidth = $(document).width();
            var iHeight = $(window).height();
            var sTop = $(window).scrollTop();
            var targetLeft = (iWidth - 200) / 2 + "px";
            var targetTop = ((iHeight - 100) / 2 + sTop - 20) + "px";
            var color = result.re ? "#6FBA2C" : "#f00";
            msgbox.html(result.msg);
            msgbox.css({ "left": targetLeft, "top": targetTop, "display": "block", "opacity": "0.1", "color": color });
            msgbox.animate({ "opacity": "0.8" }, 200, function() {
                setTimeout(function() { DoInquiry.HideResponseMsg(result) }, 2000);
            });
        },

        //关闭响应提示信息
        HideResponseMsg: function(result) {
            var msgbox = $("#iqMsgbox");
            msgbox.animate({ "opacity": "0.1" }, 200, function() {
                msgbox.hide();
            });
        },

        //处理提交询价的响应
        PostIqHandle: function(html) {
            //判段返回的是否json格式
            if (html.length > 0 && html.substring(0, 1) == "{") {
                eval("var result=" + html + ";");
                //如果是密码错误则显示错误密码提示框
                if (result.msg == "Invalid member ID or password. Please try again.") {
                    $("#password-error").css("display", "block");
                    $("#password-error span").html(result.msg);
                    $('#password').parent().attr("class", "inqErrorBar");
                    $('#password').focus();
                }
                else if (result.msg == "Please enter a valid code.") {
                    $("#txtcode-error").css("display", "block");
                    $("#txtcode-error span").html(result.msg);
                    $('#txtcode').parent().attr("class", "inqErrorBar");
                    $('#txtcode').focus();
                }
                else {
                    DoInquiry.ShowResponseMsg(result);
                }
            }
            else {
                //显示html
                DoInquiry.MoveLeft($("#inquiryBox"), html);
            }
        },

        //处理注册提交响应
        PostRegHandle: function(html) {

            //判段返回的是否json格式
            if (html.length > 0 && html.substring(0, 1) == "{") {
                eval("var result=" + html + ";");
                //判断是否验证码错误
                if (result.msg == "Please enter a valid code.") {
                    $("#txtcode-error").css("display", "block");
                    $("#txtcode-error span").html(result.msg);
                    $('#txtcode').parent().attr("class", "inqErrorBar");
                    $('#txtcode').focus();
                }
                else {
                    DoInquiry.ShowResponseMsg(result);
                }
            }
            else {
                //显示html
                DoInquiry.MoveLeft($("#regBox"), html);
            }
        },

        //左移
        MoveLeft: function(obj, html) {
            obj.animate({ "left": "-1000px" }, 200, function() {
                obj.remove();
                $("body").html(html);
                InitBind();
                parent.document.getElementById("show").style.height = stepHeight || "550px";
            });
        }
    };
    //ESC
    $(document).keyup(function() {
        if ((window.event || arguments.callee.caller.arguments[0]).keyCode == 27) {
            parent.GetInquiry.CloseBox();
        }
    });
    //english only
    $(":input").keyup(function() {
        $(this).val($(this).val().replace(/[^\x00-\xFF]{1,}/g, ""));
    });
</script>
</body>
</html>