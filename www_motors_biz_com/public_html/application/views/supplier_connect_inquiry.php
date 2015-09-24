<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" >
<head><title>

</title>
	<link href="<?php echo base_url("skin_user/css/inquiry_common.css")?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url("skin_user/css/details.css")?>" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
</head>
<body>
<div id="iqMsgbox"></div>
<div id="iqShowImg"></div>  
<div id="titlebar"><span>Send a message directly to supplier(s)</span></div>


    <div id="regBox" class="inquiryBox">
    <form id="regform" onsubmit="return PostIq();">
	<input type="hidden" name="act" value="inquiry_nonmem" />
	<input type="hidden" name="txtemail" value="<?php echo $email?>" />
	<input type="hidden" name="message" value="<?php echo $content?>" />
    <input type="hidden" name="sid" value="<?php echo $itemid?>" />
  	<div class="step"><ul><li>1.Send Inquiry Information</li><li class="current">2.Complete Contact Information</li><li>3.Sent Inquiry Successfully</li></ul>
    <p class="msgs">With a<span class="orange">*</span>are required！ Tips:<span class="orange">If you are not a member of <?php echo $site['site_name'];?> then you need to complete the contact information in order to sent inquiry.</span></p>
    </div>
    <table border="0" cellpadding="0" cellspacing="0">
      <tr>
        <th><label>Gender:</label></th>
        <td>
            <div class="inqCorrectBar">
                <label><input name="gender" type="radio" value="0" checked="checked" />Male</label>
                <label><input name="gender" type="radio" value="1" />Female</label>
            </div>
        </td>
      </tr>
      <tr>
        <th><label>Company Name:</label></th>
        <td>
            <div class="inqCorrectBar">
                <input type="text" regular="str200" tips="" id="companyname" name="companyname" class="inputTxt inpTxt220" validation="true"/>
                <p id="companyname-error" class="cf" style="display:none;"><b class="errorIcon fl"></b>
                <span class="fl errorTxt">Please enter a valid company name</span></p>
            </div>
        </td>
      </tr>
      <tr>
        <th><label>Name:</label></th>
        <td>
            <div class="inqCorrectBar">
                <input name="firstname" type="text" class="inputTxt inpTxt105" id="firstname" value="First Name" regular="name" tips="First Name" validation="true"/>
                <input name="lastname" type="text" class="inputTxt inpTxt105" id="lastname" value="Last Name" regular="name" tips="Last Name" validation="true"/>
                <p id="name-error" class="cf" style="display:none;"><b class="errorIcon fl"></b>
                <span class="fl errorTxt">Please enter a valid first name</span></p>
            </div>
        </td>
      </tr>
      <tr>
        <th><label>Country/Region:</label></th>
        <td>
            <div class="inqCorrectBar">
                <select id="ddlcountry" name="ddlcountry" onchange="javascript:countryChange(this)"

                    style="padding: 0px; padding: 0px!important; width: 236px;">
                   
                    <optgroup label="All Countries &amp; Territories (A to Z)">
                        <?php foreach($areaname as $k => $v):?>
						<option value="<?php echo $v?>"><?php echo $v?></option>
						<?php endforeach;?>
                    </optgroup>
                </select>
                <input type="hidden" name="selectcountry" id="selectcountry" value="China (Mainland)" />
                <img src="" id="countryFlagImg" style="display: none;" />
                <p id="ddlcountry-error" class="cf" style="display:none;"><b class="errorIcon fl"></b>
                <span class="fl errorTxt">Please select your country</span></p>
            </div>
        </td>
      </tr>
      <tr>
        <th><label>Tel:</label></th>
        <td>
            <div class="inqCorrectBar">
                <input type="text" id="txtphoneCountry" value="" tips="Country" class="hint" name="txtphoneCountry" maxlength="8" style="width: 44px;" validation="true" regular="tel"/>
                <input type="text" id="txtphoneArea" value="Area" tips="Area" class="hint" name="txtphoneArea" maxlength="8" style="width: 44px;" validation="true" regular="tel"/>
                <input type="text" id="txtphoneNumber" value="Local Number - Ext." tips="Local Number - Ext." name="txtphoneNumber" maxlength="34" class="hint followedObj succTip" validation="true" regular="tel"/> 
                <p id="phone-error" class="cf" style="display:none;"><b class="errorIcon fl"></b>
                <span class="fl errorTxt">Please enter a valid telephoe number</span></p>
            </div>
        </td>
      </tr>
      <tr>
        <th><label>From:</label></th>
        <td>
            <div class="inqCorrectBar">
                <?php echo $email?>
            </div>
        </td>
      </tr>
      <tr>
        <th><label>Create Password:</label></th>
        <td>
            <div class="inqCorrectBar">
                <input type="password" regular="psw" tips="" id="password" name="password" class="inputTxt inpTxt220"  validation="true"/>
                <em>6-20 characters </em>
                <p id="password-error" class="cf" style="display:none;"><b class="errorIcon fl"></b>
                <span class="fl errorTxt">Please enter a valid password</span></p>
            </div>
        </td>
      </tr>
      <tr>
        <th><label>Code:</label></th>
        <td>
            <div class="inqCorrectBar">
                <input type="text" regular="code" tips="" id="txtcode" name="txtcode" class="inputTxt inpTxt105" maxlength="5"  validation="true"/>
                <img id="codeimg" onclick="this.src=&quot;/index.php/imgcode/index/?&quot;+new Date().getTime()" title="click to load a new image" style=" cursor:pointer;" />
                <p id="txtcode-error" class="cf" style="display:none;"><b class="errorIcon fl"></b>

                <span class="fl errorTxt">Please enter a valid code</span></p>
            </div>
        </td>
      </tr>
      <tr>
        <th class="formAction"></th>
        <td class="formAction"><input id="submit" type="submit" value="Send" class="but" /></td>
      </tr>
      <tr>
      	<th></th>
        <td><p class="msg">Upon creating my account and will Send validation email to you</p>
        </td>
      </tr>
    </table>
    </form>
    </div>
    <script type="text/javascript">
        function InitBind() {
            $("#codeimg").attr("src", '/index.php/imgcode/index/?' + new Date().getTime());
            //event bind
            $(":input").focus(function() { if ($(this).val() == $(this).attr('tips')) { $(this).val(''); } });
            $(":input[name!=ddlcountry][validation='true']").blur(function() {
                var psw = /^.{6,20}$/;
                var code = /^\w{5}/;
                var str200 = /^.{1,200}$/;
                err = true;
                switch ($(this).attr('regular')) {
                    case 'psw': if (!psw.test($(this).val())) { err = false; } break;
                    case 'code': if (!code.test($(this).val())) { err = false; } break;
                    case 'str200': if (!str200.test($(this).val())) { err = false; } break;
                    default: err = false; break;
                }
                if (err) { $('#' + $(this).attr('id') + '-error').hide(); $(this).parent().attr("class", "inqCorrectBar"); } else { $('#' + $(this).attr('id') + '-error').show(); $(this).parent().attr("class", "inqErrorBar"); }
            });

            $('[regular="name"]').blur(function() {
                var name = /^\w{1,50}$/;
                if (name.test($("#firstname").val()) && name.test($("#lastname").val())) {
                    $("#name-error").hide();
                    $(this).parent().attr("class", "inqCorrectBar");
                }
                else {
                    $("#name-error").show();
                    $(this).parent().attr("class", "inqErrorBar");
                }
            });

            $('[name^="txtphone"]').blur(function() {
                var phone = /^\d{1,12}$/;
                var country = /^(\d*)([-]?)(\d+)$/;
                err = true;
                if (country.test($('#txtphoneCountry').val()) && phone.test($('#txtphoneArea').val()) && phone.test($('#txtphoneNumber').val())) {
                    $('#phone-error').hide();
                    $(this).parent().attr("class", "inqCorrectBar");
                }
                else {
                    err = false; $('#phone-error').show();
                    $(this).parent().attr("class", "inqErrorBar");
                }
            });
        }

        var err = true;
        
        function checkfrm() { err = true; $('[name$="name"]').blur(); $('[name^="txtphone"]').blur(); $('[name="txtPwd"]').blur(); return err; }

        function countryChange(obj) {
            //$('#countryFlagImg').show();
            $('#selectcountry').val($("#ddlcountry option:selected").text());
            //$('#countryFlagImg').attr("src", "/images/country/" + $("#ddlcountry option:selected").val() + ".gif");
            //var num = $("#ddlcountry option:selected").attr("countrynum");
            //$("[id$='txtphoneCountry']").attr("value", num);
        }

        function PostIq() {
            $('#companyname').blur();
            $('#firstname').blur();
            $('#lastname').blur();
            $('#txtphoneCountry').blur();
            $('#txtphoneArea').blur();
            $('#txtphoneNumber').blur();
            $('#password').blur();
            $('#txtcode').blur();
            
            if (!err) { return err; }

            $.ajax({
                type: "POST",
                url: "/index.php/supplier_connect/inquiry",
                data: $("#regform").serialize(),
                beforeSend:function(){
                    $("#submit").attr({ "disabled": "disabled", "value": "waiting..." });
                },
                success: function(html) {
                    $("#submit").removeAttr("disabled");
                    $("#submit").val("send");
                    DoInquiry.PostRegHandle(html);
                }
            });
            return false;
        }

        var stepHeight = "550px";
</script>
    

<span onclick="parent.GetInquiry.CloseBox()" class="close">×</span>
  
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