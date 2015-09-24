<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head><title>
</title>
    <link href="<?php echo main_url(base_url("skin_user/css/inquiry_common.css"));?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo main_url(base_url("skin_user/css/details.css"));?>" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
    <script type="text/javascript">
        document.domain = "<?php echo $site['site_url']?>";
    </script>
</head>
<body>
<div id="iqMsgbox"></div>
<div id="iqShowImg"></div>  
<div id="titlebar"><span>Send a message directly to supplier(s)</span></div>


  <div id="inquiryBox" class="inquiryBox" style="display: none;">
  <form id="iqform" onsubmit="return PostIq();">
    <table border="0" cellpadding="0" cellspacing="0">
      <tbody>
      	<tr>
        <th><label>From:</label></th>
        <td>
            
            <div class="inqCorrectBar" id="memberjoinDIV" style="" >
				<?php if($user_email):?>
				<input type="hidden" id="txtemail" name="txtemail" class="inputTxt inpTxt220" value="<?php echo $user_email?>" />
				<?php echo $user_email?>
				<?php else:?>
                <input type="text" id="txtemail" name="txtemail" class="inputTxt inpTxt220" value="" />
                <em>Enter email or Member ID.</em>
                <p id="txtemail-error" class="cf" style="display:none"><b class="errorIcon fl"></b>
                <span class="fl errorTxt">Please enter a valid email address</span></p>
				<?php endif;?>
				<?php if(!$username):?>
				<input type="hidden" id="act" name="act" value="inquiry_nonmem" />
				<?php else:?>
				<input type="hidden" id="act" name="act" value="inquiry_mem" />
				<?php endif;?>

            </div>
        </td>
      	</tr>
      	<tr id="psw"  style="display: none;">
        <th><label>Password:</label></th>
        <td>
            <div class="inqCorrectBar" >
                <input type="password" id="password" name="password" class="inputTxt inpTxt220" value="" regular="psw" />
                <p id="password-error" class="cf" style="display: none;"><b class="errorIcon fl"></b>
                <span class="fl errorTxt">Invalid member ID or password. Please try again.</span></p>
            </div>
        </td>
      	</tr>
        <tr>
          <th><label>To:</label></th>
          <td><ul id="todetail" ><li><input name="sid" type="hidden" value="<?php echo $sell['itemid']?>"/><?php echo $truename?><a href="<?php echo main_url(site_url("content/index/".$sell['itemid']."/".$sell['linkurl']));?>" class="product" target="_blank" ><?php echo $sell['title']?></a></li></ul></td>
        </tr>
      <tr style="display:none;">                                                                                                                                                                                                                                                                                            
        <th><label>Subject:</label></th>
        <td>
            <div class="inqCorrectBar">
                <input type="text" name="subject" id="subject" class="inputTxt inpTxt460" regular="str200" tips="" value="inquery about title" maxlength="255" validation="true" />
                <p id="subject-error" class="cf" style="display:none"><b class="errorIcon fl"></b>
                <span class="fl errorTxt">Please enter subject.</span></p>
            </div>
        </td>
      </tr>
      <tr>
        <th><label>Message:</label></th>
        <td>
            <div class="inqCorrectBar">
              <textarea id="txtmessage" tips="Enter your message here" cols="20" rows="8" name="message" class="textareaTxt"><?php echo $user_content?></textarea>
              <div class=""><em class="fl">- Enter between 20 to 2,000 characters.</em><em class="fr">Characters Remaining: <strong><span id="summarytip"><font color="red" id="num">0</font></span> / 2000</strong></em></div>
              <div style="clear:both;"></div>
              <p id="txtmessage-error" class="cf" style="display:none"><b class="errorIcon fl"></b>
                <span class="fl errorTxt">Please enter your message.</span></p>
            </div>
          </td>
      </tr>
	 <tr>
        <th><label>Code:</label></th>
        <td>
            <div class="inqCorrectBar">
                <input type="text" regular="code" tips="" id="txtcode" name="txtcode" class="inputTxt inpTxt105" maxlength="5"  validation="true"/>
                <img id="codeimg" onclick="this.src=&quot;<?php echo main_url(site_url("imgcode/index"));?>?&quot;+new Date().getTime()" title="click to load a new image" style=" cursor:pointer;" />
				<a style="cursor:pointer" onclick="$('#codeimg').attr('src', '<?php echo main_url(site_url("imgcode/index"));?>?' + new Date().getTime());">load new code</a>
                <p id="txtcode-error" class="cf" style="display:none;"><b class="errorIcon fl"></b>
                <span class="fl errorTxt">Please enter a valid code</span></p>
            </div>
        </td>
      </tr>
      <tr>
        <th class="formAction"></th>
        <td class="formAction"><input id="submit" type="submit" value="send"  class="but" /></td>
      </tr>
    </table>
    <p class="msg"><span>Please make sure your contact information is correct.</span> Your message will be sent directly to the recipient(s) and will not be publicly displayed. We will never distribute or sell your personal information to third parties without your express permission. </p>

  </form>
  </div>
<script type="text/javascript">
    $(document).ready(function() {
            $(window.parent.document).find("img[rel='loading']").hide();
            parent.GetInquiry.ShowBox({ "targetWidth": "740px", "targetHeight": "470px", "startWidth": "28px", "startHeight": "28px", "type": "iqbox" }
            ,function(){
                $("#inquiryBox").show();
                $("#txtemail").focus();
            });
            InitBind();
            
        });
    function InitBind(){
		 $("#num").html($('#txtmessage').val().length);
         $("#codeimg").attr("src", '<?php echo main_url(site_url("imgcode/index"));?>?' + new Date().getTime());
          //event bind
          $(":input").focus(function() { if ($(this).val() == $(this).attr('tips')) { $(this).val(''); } });
          $(":input[validation='true']").blur(function() {
              var code = /^\w{5}/;
              var str200 = /^.{1,200}$/;
              var str2000 = /^.{20,2000}$/;
              err = true;
              switch ($(this).attr('regular')) {
                  case 'code': if (!code.test($(this).val())) { err = false; } break;
                  case 'str200': if (!str200.test($(this).val())) { err = false; } break;
                  case 'str2000':if (!str2000.test($(this).val())) { err = false; } break;
                  default: err = false; break;
              }
              if (err) { $('#' + $(this).attr('id') + '-error').hide(); $(this).parent().attr("class", "inqCorrectBar"); } else { $('#' + $(this).attr('id') + '-error').show(); $(this).parent().attr("class", "inqErrorBar"); }
          });
          
          
          $('#txtemail').blur(function() { checkemail() });
          $('#password').blur(function() { checkpsw() });

          $("#txtmessage").keyup(function() {
              checkMessage();
          });
          $("#txtmessage").keydown(function() {
              checkMessage();
          });
          $("#txtmessage").blur(function() {
              checkMessage();
          });
          
          $("#todetail a[rel]").hover(function(e) {
          var xx = e.clientX|| 0;
          var yy = e.clientY|| 0;
          yy+=$(window).scrollTop();
              $("#iqShowImg").css({"left":xx+"px","top":yy+"px","display":"block"});
          },
          function(e) {
              $("#iqShowImg").css({"display":"none"});
          });
      }
      
      var err = true;
      var isNotLogin = '1';
      function checkemail() {
          var patn = /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;
          if (!patn.test($.trim($("#txtemail").val()))) {
              $("#txtemail-error").show();
              $("#txtemail").parent().attr("class", "inqErrorBar");
              err = false;
          }
          else {
              $("#txtemail-error").hide();
              $("#txtemail").parent().attr("class", "inqCorrectBar");
       
                  var postdate = {email:$.trim($("#txtemail").val()),check:"email"};
                  $.ajax({
                  type: "POST",
                  url: "/index.php/supplier_connect/check_user/",
                  data: postdate,
                  success: function(result) {
                      if (result == "0") {
					      $("#submit").removeAttr("disabled");
						  $("#submit").val("send");
                          $("#psw").hide();
                      }
                      else {
                          //$("#psw").show();
                      }
                  }
                });
              
         }
      }

      function checkpsw() {
          var patn = /^.{6,20}$/;
          if (!patn.test($('#password').val())) {
              $('#password-error').show();
              $('#password-error span').html("Invalid Password.")
              $('#password').parent().attr("class", "inqErrorBar");
              err = false;
          }
          else {
              $('#password-error').hide();
              $('#password').parent().attr("class", "inqCorrectBar");
			  var postdate = {email:$.trim($("#txtemail").val()),password:$.trim($("#password").val()),check:"pass"};
                  $.ajax({
                  type: "POST",
                  url: "/index.php/supplier_connect/check_user/",
                  data: postdate,
                  success: function(result) {
                      if (result == "0") {
						 $('#password-error').show();
						 $('#password-error span').html("Password is not correct.")
						 $('#password').parent().attr("class", "inqErrorBar");
						 $("#submit").attr({ "disabled": "disabled", "value": "Password Error..." });
						 $("#act").val("inquiry_nonmem");
                      }else{
						 $("#submit").removeAttr("disabled");
						 $("#submit").val("send");
						 $("#act").val("inquiry_mem");
					  }
                  }
                });
          }
      }

      function checkMessage() {
          $("#num").html($('#txtmessage').val().length);

          var pattern = /[\s\S]{20,2000}/;
          if (!pattern.test($('#txtmessage').val())) {
              $('#txtmessage-error').show();
              $('#txtmessage').parent().attr("class", "inqErrorBar");
              err=false;
          }
          else {
              $('#txtmessage-error').hide();
              $('#txtmessage').parent().attr("class", "inqCorrectBar");
          }
      }

      function PostIq(){
          err = true;
          if (isNotLogin == 1) {
              checkemail();
              if (!err) { return err; }
              //if ($('#psw').is(":visible")) { $('#password').blur(); }
              if (!err) { return err; }
          }
          $('#txtmessage').blur();
          if (!err) { return err; }
          $('#subject').blur(); 
          if (!err) { return err; }
		  $('#txtcode').blur();
		  if (!err) { return err; }
          $.ajax({
              type: "POST",
              url: "/index.php/supplier_connect/inquiry",
              data: $("#iqform").serialize(),
              beforeSend:function(){
                $("#submit").attr({ "disabled": "disabled", "value": "waiting..." });
              },
              success: function(html) {
                  $("#submit").removeAttr("disabled");
                  $("#submit").val("send");
                  DoInquiry.PostIqHandle(html);
              }
          });
          return false;
      }
      
      var stepHeight="550px";
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
