<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>修改分类</title>
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
<SCRIPT type="text/javascript">
function load_category(catid){	
		$("#catid").val(catid);
}
</SCRIPT>
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
<td id="Tab0" class="tab"><a href="<?php echo site_url("module/sell/add_cat2")?>">添加分类</a></td><td class="tab_nav">&nbsp;</td>
<td id="Tab1" class="tab_on"><a href="<?php echo site_url("module/sell/cat_list2")?>">管理分类</a></td><td class="tab_nav">&nbsp;</td></tr>
</tbody></table>
</td>
<td width="110"><div>
<img src="<?php echo base_url("skin/images/spacer.gif")?>" title="刷新" onclick="window.location.reload();" style="cursor:pointer;" alt="" height="24" width="40">
<img src="<?php echo base_url("skin/images/spacer.gif")?>" title="后退" onclick="history.back(-1);" style="cursor:pointer;" alt="" height="24" width="20">
<img src="<?php echo base_url("skin/images/spacer.gif")?>" title="前进" onclick="history.go(1);" style="cursor:pointer;" alt="" height="24" width="20">
<img src="<?php echo base_url("skin/images/spacer.gif")?>" title="帮助" onclick="" style="cursor:help;" alt="" height="24" width="20"></div></td>
</tr>
</tbody></table>
</div>
<form method="post" action="<?php echo site_url("module/category/save_cat")?>" onsubmit="return check();">
<input name="file" value="category" type="hidden">
<input name="action" value="edit" type="hidden">
<input name="catid" value="<?php echo $cat['catid']?>" type="hidden">
<div class="tt">分类修改</div>
<table class="tb" cellpadding="2" cellspacing="1">
<tbody><tr>
<td class="tl"><span class="f_hid">*</span> 上级分类</td>
<td>
<DIV class="selectListCate" id="selectListCate">
	<input type="hidden" id="catid" name="category[parentid]" value="<?php echo $parentid?>" /> 
	<DIV class="clearfix multiSelectList" id="multiSelectList">
		<SELECT name="oneSelect" tabindex="1" class="column" id="oneSelect" style="height: 214px;" size="10" onchange="load_category(this.value)"></SELECT> 
		<SELECT name="twoSelect" tabindex="2" class="column" id="twoSelect" style="height: 214px; display: none;" size="10" onchange="load_category(this.value)"></SELECT>         
		<SELECT name="threeSelect" tabindex="3" class="column" id="threeSelect" style="height: 214px; display: none;" size="10" onchange="load_category(this.value)"></SELECT>
		<SELECT name="fourSelect" tabindex="4" class="column last" id="fourSelect" style="height: 214px; display: none;" size="10" onchange="load_category(this.value)"></SELECT>
	 </DIV>
</DIV>
 <img src="<?php echo base_url("skin/images/help.png")?>" title="如果不选择，则为顶级分类" alt="tips" class="c_p" onclick="Dconfirm(this.title, '', 450);" height="11" width="11"></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 分类名称</td>
<td><input name="category[catname]" id="catname" size="20" value="<?php echo $cat['catname']?>" type="text"> 
<script type="text/javascript" src="<?php echo base_url("skin/js/color.js")?>")?>"></script>
<style type="text/css">.color_div_o {width:16px;height:16px;padding:4px 0 0 4px;background:#B6BDD2;cursor:crosshair;}
.color_div_t {width:16px;height:16px;padding:4px 0 0 4px;background:#F1F2F3;}
.color_div {border:#808080 1px solid;width:10px;height:10px;line-height:10px;font-size:1px;}</style>
<input name="category[style]" id="color_input_1" value="<?php echo $cat['style']?>" type="hidden">
<img src="<?php echo base_url("skin/images/color.gif")?>" id="color_img_1" style="cursor:pointer;background:<?php echo $cat['style']?>;" onclick="color_show(1, Dd('color_input_1').value, this);" height="18" align="absmiddle" width="21"> <span id="dcatname" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 分类目录[英文名]</td>
<td><input name="category[catdir]" id="catdir" size="20" value="<?php echo $cat['catdir']?>" type="text"> <img src="<?php echo base_url("skin/images/help.png")?>" title="限英文、数字、中划线、下划线，该分类相关的html文件将保存在此目录" alt="tips" class="c_p" onclick="Dconfirm(this.title, '', 450);" height="11" width="11"> <span id="dcatdir" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 字母索引</td>
<td><input name="category[letter]" id="letter" size="2" value="<?php echo $cat['letter']?>" type="text"></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 级别</td>
<td><input name="category[level]" size="2" value="<?php echo $cat['level']?>" type="text"> <img src="<?php echo base_url("skin/images/help.png")?>" title="0 - 不在首页显示 1 - 正常显示 2 - 首页和上级分类并列显示" alt="tips" class="c_p" onclick="Dconfirm(this.title, '', 450);" height="11" width="11"></td>
</tr>
<!-- <tr>
<td class="tl"><span class="f_hid">*</span> 分类模板</td>
<td><span id="destoon_template_1"><select name="category[template]"><option selected="selected" value="">默认模板</option></select></span>&nbsp;&nbsp;<a href="javascript:tpl_edit('list',%20'sell',%201);" class="t">[修改]</a> &nbsp;<a href="javascript:tpl_add('list',%20'sell');" class="t">[新建]</a></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 内容模板</td>
<td><span id="destoon_template_2"><select name="category[show_template]"><option selected="selected" value="">默认模板</option></select></span>&nbsp;&nbsp;<a href="javascript:tpl_edit('show',%20'sell',%202);" class="t">[修改]</a> &nbsp;<a href="javascript:tpl_add('show',%20'sell');" class="t">[新建]</a></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> Title(SEO标题)</td>
<td><input name="category[seo_title]" id="seo_title" value="潜水泵" size="61" type="text"></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> Meta Keywords<br>&nbsp; (网页关键词)</td>
<td><textarea name="category[seo_keywords]" cols="60" rows="3" id="seo_keywords">潜水泵,潜水泵供应,潜水泵批发,潜水泵行情</textarea></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> Meta Description<br>&nbsp; (网页描述)</td>
<td><textarea name="category[seo_description]" cols="60" rows="3" id="seo_description">找潜水泵吗？这里有您所需要的各类潜水泵，丰富详实的潜水泵资讯，尽在中国水泵网！</textarea></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 权限设置</td>
<td class="f_blue">如果没有特殊需要，以下选项不需要设置，全选或全不选均代表拥有对应权限</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 允许浏览分类</td>
<td><span id="group_categorygroup_list"><input name="category[group_list][]" value="3" id="categorygroup_list3" type="checkbox"><label for="categorygroup_list3"> 游客&nbsp; </label><input name="category[group_list][]" value="5" id="categorygroup_list5" type="checkbox"><label for="categorygroup_list5"> 个人会员&nbsp; </label><input name="category[group_list][]" value="6" id="categorygroup_list6" type="checkbox"><label for="categorygroup_list6"> 企业会员&nbsp; </label><input name="category[group_list][]" value="7" id="categorygroup_list7" type="checkbox"><label for="categorygroup_list7"> VIP会员&nbsp; </label></span>&nbsp;<a href="javascript:check_box('group_categorygroup_list',%20true);">全选</a> / <a href="javascript:check_box('group_categorygroup_list',%20false);">全不选</a></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 允许浏览分类信息内容</td>
<td><span id="group_categorygroup_show"><input name="category[group_show][]" value="3" id="categorygroup_show3" type="checkbox"><label for="categorygroup_show3"> 游客&nbsp; </label><input name="category[group_show][]" value="5" id="categorygroup_show5" type="checkbox"><label for="categorygroup_show5"> 个人会员&nbsp; </label><input name="category[group_show][]" value="6" id="categorygroup_show6" type="checkbox"><label for="categorygroup_show6"> 企业会员&nbsp; </label><input name="category[group_show][]" value="7" id="categorygroup_show7" type="checkbox"><label for="categorygroup_show7"> VIP会员&nbsp; </label></span>&nbsp;<a href="javascript:check_box('group_categorygroup_show',%20true);">全选</a> / <a href="javascript:check_box('group_categorygroup_show',%20false);">全不选</a></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 允许发布信息</td>
<td><span id="group_categorygroup_add"><input name="category[group_add][]" value="3" id="categorygroup_add3" type="checkbox"><label for="categorygroup_add3"> 游客&nbsp; </label><input name="category[group_add][]" value="5" id="categorygroup_add5" type="checkbox"><label for="categorygroup_add5"> 个人会员&nbsp; </label><input name="category[group_add][]" value="6" id="categorygroup_add6" type="checkbox"><label for="categorygroup_add6"> 企业会员&nbsp; </label><input name="category[group_add][]" value="7" id="categorygroup_add7" type="checkbox"><label for="categorygroup_add7"> VIP会员&nbsp; </label></span>&nbsp;<a href="javascript:check_box('group_categorygroup_add',%20true);">全选</a> / <a href="javascript:check_box('group_categorygroup_add',%20false);">全不选</a></td>
</tr>
-->
</tbody></table>


<div class="sbt"><input name="submit" value="确 定" class="btn" type="submit">&nbsp;&nbsp;&nbsp;&nbsp;<input name="reset" value="重 置" class="btn" type="reset"></div>
</form>
<script type="text/javascript">
function ckDir() {
	if(Dd('catdir').value == '') {
		Dtip('请填写分类目录');
		Dd('catdir').focus();
		return false;
	}
	var url = '?file=category&action=ckdir&mid=5&catdir='+Dd('catdir').value;
	Diframe(url, 0, 0, 1);
}
function check() {
	if(Dd('catname').value == '') {
		Dmsg('请填写分类名称', 'catname');
		return false;
	}
	if(Dd('catdir').value == '') {
		Dmsg('请填写分类目录', 'catdir');
		return false;
	}
	return true;
}
</script>
<SCRIPT type="text/javascript">
  
  function queryString() {
      var Url = window.location.href;
      var u,
      g,
      StrBack = '';
      if (arguments[arguments.length - 1] == "#") {
          u = Url.split("#");
      } else {
          u = Url.split("?");
      }
      if (u.length == 1) {
          g = '';
      } else {
          g = u[1];
      }
      if (g != '') {
          gg = g.split("&");
          var MaxI = gg.length;
          str = arguments[0] + "=";
          for (i = 0; i < MaxI; i++) {
              if (gg[i].indexOf(str) == 0) {
                  StrBack = gg[i].replace(str, "");
                  break;
              }
          }
      }
      return StrBack;
      }
  function getUrlParameter(name, url){
      if( !url ){
          var url = location.href;
      }
      if(url.indexOf("?")==-1 || url.indexOf(name+'=')==-1){
          return false;
      }
      var queryString = url.substring(url.indexOf("?") + 1);
      var parameters = queryString.split("&");
      var pos, paraName, paraValue;
      for(var i = 0; i < parameters.length; i++){
          pos = parameters[i].indexOf('=');
          if(pos == -1) { continue; }
          paraName = parameters[i].substring(0, pos);
          paraValue = parameters[i].substring(pos + 1); 
          if(paraName == name){
              return unescape(paraValue.replace(/\+/g, " "));
          }
      }
      return false;
  };
 
  
  
  var Category = function( parentNode, id, title, hasPrivilege, warnMessage ){
      this.id=id;
      this.title = title;
      this.hasPrivilege = hasPrivilege;
      this.warnMessage = warnMessage;
      
      this.childCategorys = [];
      if( parentNode ){ this.applyParent( parentNode ); }
  };
  var warnMessageMap = {};
  var warnMessageMapIndex = 0;
  
  Category.prototype = {
      applyParent:function( parentNode ){		
        this.parentNode = parentNode;
          this.parentNode.addChild( this );
      },
      addChild:function( node ){
          this.childCategorys.push( node );
      },
      getChildOptions:function(){
          if( this.option == null ){
              this.option = new Option( this.title, this.id );
              this.option.setAttribute('hasPrivilege',this.hasPrivilege);
          
              if(this.warnMessage != 'b' && this.warnMessage != ''){
                  
                  warnMessageMap[warnMessageMapIndex] = this.warnMessage;
                  this.option.setAttribute('warnMessage',warnMessageMapIndex);
                  warnMessageMapIndex ++;
              }else{
                  this.option.setAttribute('warnMessage',this.warnMessage);
              }
      
              if(this.hasPrivilege == 'false'){
                  this.option.setAttribute('disabled',true);
              }
          };
  
          return this.option;
      }
  };
  
  var cat1;
  var cat2;
  var cat3;
  var cat4;
  
  var root=new Category(null, "0", ")", "true","");
			<?php foreach($cat1 as $k => $c1):?>
			cat1=new Category(root, "<?php echo $c1['catid']?>","<?php echo addslashes($c1['catname'])?>", "true", "")
				<?php foreach($cat2[$c1['catid']] as $c2):?>
				cat2=new Category(cat1, "<?php echo $c2['catid']?>","<?php echo addslashes($c2['catname'])?>", "true",  "" )
					<?php foreach($cat3[$c2['catid']] as $c3):?>
					cat3=new Category(cat2, "<?php echo $c3['catid']?>","<?php echo addslashes($c3['catname'])?>", "true", "" )
						<?php foreach($cat4[$c3['catid']] as $c4):?>
							 cat4=new Category(cat3, "<?php echo $c4['catid']?>","<?php echo addslashes($c4['catname'])?>", "true", "" )
						<?php endforeach;?>
					<?php endforeach;?>
				<?php endforeach;?>
			<?php endforeach;?>
              
                                                                                       
  function trim(str, leftTrim, rightTrim, mbspaceTrim) {
      if (leftTrim == null) {
          leftTrim = true;
      }
  
      if (rightTrim == null) {
          rightTrim = true;
      }
  
      if (mbspaceTrim == null) {
          mbspaceTrim = true;
      }
  
      var newstr = str;
      if (leftTrim) {
          newstr = newstr.replace(/^\s+/g, "");
          if (mbspaceTrim) {
              newstr = newstr.replace(/^(　|\s)+/g, "");
          }
      }
      if (rightTrim) {
          newstr  =newstr.replace(/\s+$/g, "");
          if (mbspaceTrim) {
              newstr = newstr.replace(/(　|\s)+$/g, "");
          }
      }
      return newstr;
  }
  </SCRIPT>
   
  <SCRIPT type="text/javascript">
  function showHiddenByIds(){
      var args = arguments;
      if( args.length == 0 ){ return ;}
      for( var i = 0; i<args.length; i+=2 ){
          if( i+1 >= args.length){ break;};
          YUD.setStyle( args[i],'display', args[i+1]);
      }
  }
  
  var mainform = document.MyCategoryForm;
  var one = get("oneSelect");
  var two = get("twoSelect");
  var three = get("threeSelect");
  var four = get("fourSelect");
  var result = get("resultSelect");
  var catObjArry = new Array(one,two,three,four);
  var addObj = get("submit_add");
  var dCategoryName = get('commonCategoryName');
  
  var beginIndex = 0;
  var selectedCatId=0;
  var maxCates=4;
  var isInited = false;
  function fillCategory(obj,category){
      if (obj==null) return ;
      var size = category.childCategorys.length;
      for(var i=0;i<size;i++){
          obj.options[i + beginIndex] = category.childCategorys[i].getChildOptions();
      }
  }
  
    function init(){
      if (root == null) return;
      fillCategory(one,root);
      //index = locateOption(one,selectedCatId);
      //if (index<0) index=0;
      //one.selectedIndex=index;
      
      //changeSelectListCate( one, true);
  
      YUE.on(one, 'change', function(){
          changeSelectListCate( one );
      });
      YUE.on(two, 'change', function(){
          changeSelectListCate( two );
      });
      YUE.on(three, 'change', function(){
          changeSelectListCate( three );
      });
      YUE.on(four, 'change', function(){
          changeSelectListCate( four );
      });
      YUE.on(one, 'dblclick', selectedLastClose);
      YUE.on(two, 'dblclick', selectedLastClose);
      YUE.on(three, 'dblclick', selectedLastClose);
      YUE.on(four, 'dblclick', selectedLastClose);
      YUE.on( get('hiddenProductListOption'), 'click', selfClose);
  
          if(two.options.length>0){
      two.style.display='';
          three.style.display='none';
          four.style.display='none';
      }
      if(three.options.length>0){
          two.style.display='';
          three.style.display='';
          four.style.display='none';
      }
      if(four.options.length>0){
          two.style.display='';
          three.style.display='';
          four.style.display='';
      }
      isInited = true;
  }
  
  function changeOne(){
      change(one,two);
      selectClear(three);
      selectClear(four);
      changeAddButton();
  }
  
  function changeTwo(){
      change(two,three);
      selectClear(four);
      changeAddButton();
  }
  
  function changeThree(){
      change(three,four);
      changeAddButton();
  }
  
  function changeFour(){
      changeAddButton();
  }
  
  function selectedLastClose(){
      if( isSelectLastCate() ){
          selfClose();
      }
  }
  
  function changeSelectListCate( el, isDoInit){
      switch( el.id ){
          case 'oneSelect':{
              changeOne();
              break;
          }
          
          case 'twoSelect':{
              changeTwo();
              break;
          }
          
          case 'threeSelect':{
              changeThree();
              break;
          }
          
          case 'fourSelect':{
              changeFour();
              break;
          }
      }
      submitData();
      if( isDoInit ){
          return;
      }
      
      selectedData();
      if( el ){
          setElementWidth( el );
      }	
      setContainerWidth(  );
      
      if (navigator.appVersion.indexOf("MSIE 5.5") >= 0 || navigator.appVersion.indexOf("MSIE 6.0") >= 0 || navigator.appVersion.indexOf("MSIE 7.0") >= 0)
      {	
          ReloadSelectElement();
      }
      
      
  }
  function setElementWidth( el ){
      var minWidth = 180;
      var sEl;
      
      if(el.id === 'oneSelect'){
          sEl = 'twoSelect';
      }
      if(el.id === 'twoSelect'){
          sEl = 'threeSelect';
      }
      if(el.id === 'threeSelect'){
          sEl = 'fourSelect';
      }
      if(el.id === 'fourSelect'){
          return;
      }
      el = get(sEl);
      YUD.setStyle(el,'width','auto');
      var w = getElementWidth( el );
      if(w < minWidth){
          YUD.setStyle(el, 'width', minWidth + 'px');
      }else{
          YUD.setStyle(el, 'width', w + 'px');
      }
      
  }
  function setContainerWidth( ){
      var wholeWidth = get('selectListCate').offsetWidth;
      var w1 = getElementWidth( one);
      var w2 = getElementWidth( two );
      var w3 = getElementWidth( three );
      var w4 = getElementWidth( four );
      
      var w = w1 + w2 + w3 + w4;
      if( w > wholeWidth){
          YUD.setStyle('multiSelectList', 'width', w + 'px');
          //var h = parseInt(YUD.getStyle('selectListCate', 'height'));
          //YUD.setStyle('selectListCate', 'height', h + 10 + 'px' );
          
          var left = 0;
          if (window.innerHeight) {
              left = window.pageXOffset;
            }
            else if (document.documentElement && document.documentElement.scrollTop) {
              left = document.documentElement.scrollLeft;
            }
            else if (document.body) {
              left = document.body.scrollLeft;
            }
          scrollToRight();
      }else{
          //var h = parseInt(YUD.getStyle('selectListCate', 'height'));
          //YUD.setStyle('selectListCate', 'height', h - 10 + 'px' );
          YUD.setStyle('multiSelectList', 'width', 'auto');
      }	
  }
  
  function scrollToRight(){
          var anim = new YAHOO.util.Scroll ( 'selectListCate', {
              scroll:{to: [1024, 0]}
          },2);
          anim.animate();
      
  }
  
  
  function getElementWidth( el ){
          if(YUD.getStyle(el,'display') === 'none'){
              return 0;
          }else{
              return el.offsetWidth + 10;
          }
  }
  
  
  function isSelectLastCate(){
   if(catObjArry == null) return false;
   for(var j=0;j<catObjArry.length;j++){
      catObj=catObjArry[j];
      if (catObj!=null){
         index=catObj.selectedIndex;
         if (catObj.options.length>0&&catObj.selectedIndex==-1)
         {
            return false;
         }
      }
   }
   return true;
  }
  
  function changeAddButton(){
      if (addObj==null) return ;
          if (result.options.length>=maxCates){
          addObj.disabled=true;
          return ;
      }
  
          if (!isSelectLastCate()){
      addObj.disabled=true;
      return ;
      }
      addObj.disabled=false;
  }
  
  function change(ddlb,changedDdlb){
      var index = ddlb.selectedIndex;
      selectClear(changedDdlb);
      if(ddlb.selectedIndex == -1) return;
  
      var selectedValue=ddlb.options[index].value;
      var currCate=getCurrentOption(root,selectedValue);
      if (currCate==null)return ;
          var childCategorys=currCate.childCategorys
      if (childCategorys==null) return ;
      var size=childCategorys.length;
      for(var i=0;i<size;i++){
          changedDdlb.options[i] = childCategorys[i].getChildOptions();
      }
          changedDdlb.selectedIndex = -1;
      if(size>0){
          changedDdlb.style.display="";
          changeLabelShow(changedDdlb,true);
      }
  }
  
  
  function getCurrentOption(category,catId){
      var childCategorys=category.childCategorys;
      if (childCategorys==null) {
          return null;
      }
      var len = childCategorys.length;
      for(var j=0;j<len;j++){
          if (childCategorys[j].id==catId){
              return childCategorys[j];
          }
          var re=getCurrentOption(childCategorys[j],catId);
          if (re!=null){
              return re;
          }
      }
      return null;
  }
  
  function getCatBuyCatId(category,catId){
      if (root==null) return null;
      var childCategorys=category.childCategorys;
      if (childCategorys==null) {
          return null;
      }
      for(var j=0;j<len;j++){
          if (childCategorys[j].id==catId){
              return childCategorys[j];
          }
      }
      return null;
  }
  
  function locateOption(oSel,itemValue){
      if(oSel==null) return -1;
      for(var j=0;j<oSel.options.length;j++){
          if (oSel.options[j].value==itemValue){
              return j;
          }
      }
      return -1;
  }
  
  function canAddItem(){
      if (result.options.length>=maxCates){
          alert("Sorry, you have chosen more than "+maxCates+" categories. Please check and choose again.");
          return false;
      }
      return true;
  }
  
  function selectedData(){
  
          if(two.options.length>0){
          two.style.display='';
          three.style.display='none';
          four.style.display='none';
      }
      if(three.options.length>0){
          two.style.display='';
          three.style.display='';
          four.style.display='none';
      }
      if(four.options.length>0){
          two.style.display='';
          three.style.display='';
          four.style.display='';
      }
  }
  
  function selectLastHint(){
      if(isSelectLastCate() == true) {
          showHiddenByIds('catgoryListTitle','none','selectedLastInfo','');
      } else {
          showHiddenByIds('catgoryListTitle','','selectedLastInfo','none');
      }
  }
  
  function submitData(){
      var oData = getSelectData();
      var isLast = isSelectLastCate();
      var categoryIds = '';
      
      /* 如果是false不载入下一级
      if(oData.hasPrivilege == 'false'){
          
          return;
      }
      */
      if( isLast == true ){
          categoryIds = oData.lastId;
      }
      if(typeof(parent.callbackSelectCategoryChange) == "function"){
          
          parent.callbackSelectCategoryChange({
              'categoryName': XMLDecode(oData.cateName),
              'categoryIds': oData.lastId, 
              'categoryIdsPathStr':oData.categoryIdsPathStr,
              'isLast':isLast,
              'hasPrivilege':oData.hasPrivilege,
              'warnMessage':oData.warnMessage,
              'catType':'all',
              'warnMessageMap': warnMessageMap
              },'browseCate');
      }else{
          
          try{
              findItem('commonCategoryIds',parent.document).value  = categoryIds;
              findItem('commonCategoryName',parent.document).value = XMLDecode(oData.cateName);
          }catch(E){}
      }
  }
  
  function getSelectData(){
      var oData = {cateName:'',lastId:'',categoryIdsPathStr:'',hasPrivilege:'',warnMessage:''};
      var categoryIdsPath = [];
      for(var j = 0; j < catObjArry.length; j++){
          catObj = catObjArry[j];
          if (catObj == null){
              break;
          }
          var index = catObj.selectedIndex;
          
          if (index == -1){
              break;
          }
          
          if(oData.cateName == ""){
              oData.cateName = catObj.options[index].innerHTML;
          }else{
              oData.cateName = oData.cateName+" >> "+catObj.options[index].innerHTML;
          }
          oData.lastId = catObj.options[index].value;
          oData.hasPrivilege = catObj.options[index].getAttribute('hasPrivilege');
          oData.warnMessage = catObj.options[index].getAttribute('warnMessage');
          
          categoryIdsPath.push(trim(catObj.options[index].value));
      }
      
      
      oData.categoryIdsPathStr = toCategoryIdsPathStrString( categoryIdsPath );
      return oData;
  }
  
  function toCategoryIdsPathStrString( a ){
          var s = '';
          if(!YL.isArray(a)){
              return s;
          }
          for(var i = 0, len = a.length; i < len; i++){
              if(a[i] != -1 || a[i] != '-1'){
                  s  = s + a[i] + ',';
              }
          }
          return s.substring(0,s.length-1);
          
  }
  
  function findItem(n, d) {
      var p,x,i;
      if(!d) d=document;
      if((p=n.indexOf("?"))>0&&parent.frames.length) {
          d=parent.frames[n.substring(p+1)].document;
          n=n.substring(0,p);
      }
      if(!(x=d[n])&&d.all)
          x=d.all[n];
      for (i=0;!x&&i<d.forms.length;i++)
          x=d.forms[i][n];
      for(i=0;!x&&d.layers&&i<d.layers.length;i++)
          x=findItem(n,d.layers[i].document);
      return x;
  }
  
  function XMLDecode(str){
      str = str.replace(/&amp;/ig,"&");
      str = str.replace(/&lt;/ig,"<");
      str = str.replace(/&gt;/ig,">");
      str = str.replace(/&apos;/ig,"'");
      str = str.replace(/&quot;/ig,"\"");
      return str;
  }
  
  function search(formObj){
      if(trim(formObj.keyword.value) == ''){
          alert('Please input a search term.');
          return false;
      }
      if (formObj.categoryIdsStr!=null) {
          formObj.categoryIdsStr.value = makeSelectCateStr();
      }
  
      return true;
  }
  
  function makeSelectCateStr(){
      var str="";
      for(var j=0;j<result.options.length;j++){
          if (j==0) {
              str=result.options[0].value;
          } else{
          str=str+","+result.options[j].value;
          }
      }
      return str;
  }
  
  function changeLabelShow(oSel,isShow){
      if (oSel==null||oSel.id==null) return;
      var labObj=document.getElementById(oSel.id+"_lab");
  
      if (labObj!=null){
          if (isShow){
              labObj.style.display="";
          } else{
              labObj.style.display="none";
          }
      }
  }
  
  function selectClear(oSel){
      if (oSel==null) return;
  
      oSel.length = 0;
          oSel.style.height=one.style.height;
          changeLabelShow(oSel,false);
  }
  
  function selfClose(){
      //submitData();
      if( typeof( parent.callbackCloseSelectCategory ) == 'function' ){
          parent.callbackCloseSelectCategory();
      }
      
      if( typeof( parent.callbackDoCategorySubmit ) == 'function' ){
          parent.callbackDoCategorySubmit();
      }
  }
  init();
  
  
  //根据参数初始化选择类目
  //参数'36,1512,361270,36127020'或者直接是数组;
  //Agriculture >> Agricultural & Gardening Tools >> Brush Cutters
  
  //initSelectedPathByName('Consumer Electronics&gt;&gt;DVD, VCD Player');
  
  function initSelectedPathByName( categoryName ){
      _initSelectedPath( categoryName, 'name');
  }
  
  function initSelectedPathByIds( categoryIdsPathStr ){
      _initSelectedPath( categoryIdsPathStr, 'id');
  }
  
  
  function _initSelectedPath( categoryPathStr, which ){
      var categoryPath;
      
      if(!which || which === ''){
          which = 'id';
      }
      
      if(YL.isArray(categoryPathStr)){
          if(categoryPathStr.length === 0){
              return;
          }
          categoryPath = categoryPathStr;
      }else{
          if(YL.isString( categoryPathStr )){
              if(categoryPathStr === ''){
                  return;
              }
              if(which === 'name'){
                  categoryPathStr = XMLDecode( categoryPathStr );
                  categoryPath = categoryPathStr.split('>>');
              }
              if(which === 'id'){
                  categoryPath = categoryPathStr.split(',');
              }
              
          }
      }
      var cat0 = categoryPath[0];
      if( cat0 ){
          selectOption(one, cat0, which);
          changeSelectListCate( one );
      }
      var cat1 = categoryPath[1];
      if( cat1 ){
          selectOption(two, cat1, which);
          changeSelectListCate( two );
      }
      
      var cat3 = categoryPath[2];
      if( cat3 ){
          selectOption(three, cat3, which);
          changeSelectListCate( three );
      }
      
      var cat4 = categoryPath[3];
      if( cat4 ){
          selectOption(four, cat4, which);
          changeSelectListCate( four );
      }
      
  }
  
  function selectOption(el , v, which){
      for(var i = 0, len = el.options.length; i < len; i++){
          if(which === 'id' && el.options[i].value == v){
              el.options[i].selected = true;
          }
          
          if(which === 'name' && el.options[i].text.trim() == v.trim()){
              el.options[i].selected = true;
          }
      }
  }
  
  if (navigator.appVersion.indexOf("MSIE 5.5") >= 0 || navigator.appVersion.indexOf("MSIE 6.0") >= 0 || navigator.appVersion.indexOf("MSIE 7.0") >= 0)
  {
      
      window.onload = ReloadSelectElement;
  }
  
  function ReloadSelectElement() {
      
  
      if (document.getElementsByTagName) {
          var s = document.getElementsByTagName("select");
  
          if (s.length > 0) {
              window.select_current = new Array();
  
              for (var i=0, select; select = s[i]; i++) {
                  select.onfocus = function(){ window.select_current[this.id] = this.selectedIndex; }
                  select.onchange = function(){ restore(this); }
                  emulate(select);
              }
          }
      }
  }
  
  function restore(e) {
      if (e.options[e.selectedIndex].disabled) {
          e.selectedIndex = window.select_current[e.id];
      }
  }
  
  function emulate(e) {
      for (var i=0, option; option = e.options[i]; i++) {
          
          if (option.disabled) {        
              option.style.color = "#6d6d6d";
          }
          else {
              option.style.color = "#000";
          }
      }
  }
  /*自定义事件 POST表单打点，由于IE下面iframe加载顺序的问题，没法准确在iframe加载完成之前注册上iframe的load事件，从而导致打点不成功*/
  
  YUE.on( one , 'change', function() {
      if ( typeof (parent.onOneChanged) !== 'undefined' && parent.onOneChanged !== null && typeof (parent.onOneChanged.fire) !== 'undefined' && parent.onOneChanged.fire !== null ) {
          parent.onOneChanged.fire();
      }
  });
  initSelectedPathByIds('<?php echo $arrparentid?>');
  //initSelectedPathByIds('16,301,412');
  //initSelectedPath('44,100000308,604');
  </SCRIPT>
<script type="text/javascript">Menuon(1);</script>

</body></html>