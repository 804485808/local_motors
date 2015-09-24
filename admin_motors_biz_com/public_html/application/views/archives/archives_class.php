<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>添加分类</title>
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
        $(function(){
            $("#catid").val(<?php echo isset($parentid)?$parentid:0?>);
        });
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
                        <td id="Tab0" class="tab_on"><a href="<?php echo site_url("archives/archives_class")?>">添加分类</a></td><td class="tab_nav">&nbsp;</td>
                        <td id="Tab1" class="tab"><a href="<?php echo site_url("archives/archives_class_list")?>">管理分类</a></td><td class="tab_nav">&nbsp;</td></tr>
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
<form method="post" action="<?php echo site_url("archives/archives_class")?>" onsubmit="return check();">
    <!-- <input type="hidden" name="file" value="category">
    <input type="hidden" name="action" value="add">
    <input type="hidden" name="mid" value="5"> -->
    <div class="tt">分类添加</div>
    <table cellpadding="2" cellspacing="1" class="tb">
        <tbody><tr>
            <td class="tl"><span class="f_hid">*</span> 上级分类</td>
            <td>
                <DIV class="selectListCate" id="selectListCate">
                    <input type="hidden" id="catid" name="category[parentid]" value="" />
<!--                    <input type="hidden" id="catid" />-->
                    <DIV class="clearfix multiSelectList" id="multiSelectList">
                        <SELECT name="oneSelect" tabindex="1" class="column" id="oneSelect" style="height: 214px;" size="10" onchange="load_category(this.value)"></SELECT>
                        <SELECT name="twoSelect" tabindex="2" class="column" id="twoSelect" style="height: 214px; display: none;" size="10" onchange="load_category(this.value)"></SELECT>
                        <SELECT name="threeSelect" tabindex="3" class="column" id="threeSelect" style="height: 214px; display: none;" size="10" onchange="load_category(this.value)"></SELECT>
                        <SELECT name="fourSelect" tabindex="4" class="column last" id="fourSelect" style="height: 214px; display: none;" size="10" onchange="load_category(this.value)"></SELECT>
                    </DIV>
                </DIV><br><span id="dcatselect" class="f_red"></span>
            </td>
        </tr>
        <tr>
            <td class="tl"><span class="f_red">*</span> 分类名称</td>
            <td><textarea name="category[catname]" id="catname" style="width:200px;height:100px;overflow:visible;" onblur="get_letter(this.value);" title="允许批量添加，一行一个，点回车换行"></textarea>
                <img src="<?php echo base_url("skin/images/help.png")?>" width="11" height="11" title="允许批量添加，一行一个，点回车换行" alt="tips" class="c_p" onclick="Dconfirm(this.title, '', 450);"><br><span id="dcatname" class="f_red"></span></td>
        </tr>
<!--        <tr>-->
<!--            <td class="tl"><span class="f_hid">*</span> 分类目录[英文名]</td>-->
<!--            <td><input name="category[catdir]" type="text" id="catdir" size="20"> <input type="button" class="btn" value="目录检测" onclick="ckDir();"> <img src="--><?php //echo base_url("skin/images/help.png")?><!--" width="11" height="11" title="限[a-z]、[A-z]、[0-9]、_、- 、/&lt;br/&gt;该分类相关的html文件将保存在此目录&lt;br/&gt;如果需要生成多级目录，请用 / 分隔目录&lt;br/&gt;如果不填写则自动将分类id作为目录" alt="tips" class="c_p" onclick="Dconfirm(this.title, '', 450);"> <span id="dcatdir" class="f_red"></span></td>-->
<!--        </tr>-->
        <tr>
            <td class="tl"><span class="f_hid">*</span> 排序</td>
            <td><input name="category[listorder]" type="text" size="2" value="1"></td>
        </tr>
        <tr>
            <td class="tl"><span class="f_hid">*</span> 级别</td>
            <td><input name="category[level]" type="text" size="2" value="1"> <img src="<?php echo base_url("skin/images/help.png")?>" width="11" height="11" title="0 - 不在首页显示 1 - 正常显示 2 - 首页和上级分类并列显示" alt="tips" class="c_p" onclick="Dconfirm(this.title, '', 450);"></td>
        </tr>

        </tbody></table>
    <div class="sbt"><input type="submit" name="submit" value="确 定" class="btn">&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value="重 置" class="btn"></div>
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
        if(Dd('catname').value.length > 50) {
            Dmsg('分类名称长度不得大于50个字节', 'catname');
            return false;
        }

        if(Dd('fourSelect').value) {
            Dmsg('分类级别不能大于4级', 'catselect');
            return false;
        }
        return true;
    }
    function get_letter(catname) {
        makeRequest('file=category&mid=5&action=letter&catname='+catname, '?', '_get_letter');
    }
    function _get_letter() {
        if(xmlHttp.readyState==4 && xmlHttp.status==200) {
            if(xmlHttp.responseText) {
                if(Dd('catdir').value == '') Dd('catdir').value = xmlHttp.responseText;
                if(Dd('letter').value == '') Dd('letter').value = xmlHttp.responseText.substr(0,1);
            }
        }
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
<?php if (isset($arrparentid)){?>
initSelectedPathByIds('<?php echo $arrparentid?>');
<?php }?>
//initSelectedPath('44,100000308,604');
</SCRIPT>
<script type="text/javascript">Menuon(0);</script>

</body></html>