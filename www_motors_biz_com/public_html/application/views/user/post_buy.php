<SCRIPT src="<?php echo base_url("skin_user/js/common.js")?>" type=text/javascript></SCRIPT>
<SCRIPT src="<?php echo base_url("skin_user/js/ae.js")?>" type="text/javascript"></SCRIPT>

<div class="user_main">
<form name="frm" id="tform" method="post" action="<?php echo site_url("my_biz/post_require")?>">
		<div class="inbox_nav"><span><img src="<?php echo base_url("skin_user/images/inm_15.jpg")?>"  /></span>
		<a href="<?php echo site_url('user/user_main/index')?>">My Biz</a>
		<a id="inbox_nav_a"  href="<?php echo site_url('user/buy/manage_buy')?>">Buy</a>
		<a href="<?php echo site_url('user/sell/manage_sell')?>">Sell</a>
		<a href="<?php echo site_url('user/message/inbox')?>" >Messages & Contacts</a>
		<a href="<?php echo site_url('user/news/manage_news')?>">News</a></div>

    <div class="inbox2">
    	<div class="inbox2_left">
        	<div class="inbox2_left1"><span><img src="<?php echo base_url("skin_user/images/uJ_account.png")?>" width="30" height="30" /></span><a href="<?php echo site_url('user/buy/manage_buy')?>">Manage Request </a></div>
        	<div class="inbox2_left1 inbox2_left1_1"><span><img src="<?php echo base_url("skin_user/images/uJ_buy.png")?>" width="25" height="25" /></span><a href="<?php echo site_url('user/buy/post_buy')?>">Post Request</a></div>
   	  </div>
    	<div class="inbox2_right">
      	<div class="inbox2_right1"></div>
		<div class="Manage_title">Post a Buying Request  </div>
		<div class="Manage_title_sec">
			<span>Tell The Supplier What You Want  </span>
			<div class="clear"></div>
		</div>
		<div class="P_all_template">
			<div class="P_all_template_t"><b>*</b>Product Name:</div>
			<input class="input_P_1" name="title" value=""/>
			<div class="P_clear"></div>
			<div class="P_all_template_t"><b>*</b>Product Category:</div>
			<DIV class="selectListCate" id="selectListCate">
  <DIV class="clearfix multiSelectList" id="multiSelectList">
  <SELECT name="oneSelect" tabindex="1" class="column" id="oneSelect" style="height: 214px;" size="10"></SELECT> 
  <SELECT name="twoSelect" tabindex="2" class="column" id="twoSelect" style="height: 214px; display: none;" size="10"></SELECT>         
  <SELECT name="threeSelect" tabindex="3" class="column" id="threeSelect" style="height: 214px; display: none;" size="10"></SELECT>
  <SELECT name="fourSelect" tabindex="4" class="column last" id="fourSelect" style="height: 214px; display: none;" size="10"></SELECT>
  </DIV>
  </DIV>
			<div class="P_clear"></div>
			
			<div class="P_all_template_t"><b>*</b>Product Detailed Specification:</div>
			<textarea name="introduce" cols="" rows="" class="input_P_2" /></textarea>
			<div class="clear"></div>
			<div class="P_all_Text"><span>8000</span>Characters Remaining</div>
			<div class="P_clear"></div>
			
			<div class="P_all_template_t">Relevant Files to the Request:</div>
			<input name="thumb" type="button" value="Upload" />12312312.png
			<div class="clear"></div>
			<div class="P_all_Text">File format:<span>Jpg,Png,Gif,Tif,Bmp,Doc,Xls,Txt</span> Maximun of<span>3</span> attachments/each<Span>2Mb</Span></div>
			<div class="P_clear"></div>
			
			<div class="P_all_template_t"><b>*</b>Estimated Order Quantity:</div>
			<input class="input_P_3"  name="amount" value=""/>
			<select name="unit" class="input_P_3a"> 
				<option value="Pieces">Pieces</option>									<option value="20' Container">20' Container</option>
				<option value="40' Container">40' Container</option>					<option value="40' HQ Container">40' HQ Container</option>
				<option value="Acre/Acres">Acre/Acres</option>							<option value="Ampere/Amperes">Ampere/Amperes</option>
				<option value="Bags">Bags</option>										<option value="Barrel/Barrels">Barrel/Barrels</option>
				<option value="Boxes">Boxes</option>									<option value="Bushel/Bushels">Bushel/Bushels</option>
				<option value="Carat/Carats">Carat/Carats</option>						<option value="Carton/Cartons">Carton/Cartons</option>
				<option value="Case/Cases">Case/Cases</option>							<option value="Centimeter/Centimeters">Centimeter/Centimeters</option>
				<option value="Chain/Chains">Chain/Chains</option>						<option value="Cubic Centimeter/Cubic Centimeters">Cubic Centimeter/Cubic Centimeters</option>
				<option value="Cubic Foot/Cubic Feet">Cubic Foot/Cubic Feet</option>	<option value="Cubic Inch/Cubic Inches">Cubic Inch/Cubic Inches</option>
				<option value="Cubic Meter/Cubic Meters">Cubic Meter/Cubic Meters</option><option value="Cubic Yard/Cubic Yards">Cubic Yard/Cubic Yards</option><option value="Degrees Celsius">Degrees Celsius</option>
				<option value="Degrees Fahrenheit">Degrees Fahrenheit</option>			<option value="Dozen/Dozens">Dozen/Dozens</option>
				<option value="Dram/Drams">Dram/Drams</option>							<option value="Fluid Ounce/Fluid Ounces">Fluid Ounce/Fluid Ounces</option>
				<option value="Foot">Foot</option>										<option value="Furlong/Furlongs">Furlong/Furlongs</option>
				<option value="Gallon/Gallons">Gallon/Gallons</option>					<option value="Gill/Gills">Gill/Gills</option>
				<option value="Grain/Grains">Grain/Grains</option>						<option value="Gram/Grams">Gram/Grams</option>
				<option value="Gross">Gross</option>									<option value="Hectare/Hectares">Hectare/Hectares</option>
				<option value="Hertz">Hertz</option>									<option value="Inch/Inches">Inch/Inches</option>
				<option value="Kiloampere/Kiloamperes">Kiloampere/Kiloamperes</option>	<option value="Kilogram/Kilograms">Kilogram/Kilograms</option>
				<option value="Kilohertz">Kilohertz</option>							<option value="Kilometer/Kilometers">Kilometer/Kilometers</option>
				<option value="Kiloohm/Kiloohms">Kiloohm/Kiloohms</option>				<option value="Kilovolt/Kilovolts">Kilovolt/Kilovolts</option>
				<option value="Kilowatt/Kilowatts">Kilowatt/Kilowatts</option>			<option value="Liter/Liters">Liter/Liters</option>
				<option value="Long Ton/Long Tons">Long Ton/Long Tons</option>			<option value="Megahertz">Megahertz</option>
				<option value="Meter">Meter</option>									<option value="Metric Ton/Metric Tons">Metric Ton/Metric Tons</option>
				<option value="Mile/Miles">Mile/Miles</option>							<option value="Milliampere/Milliamperes">Milliampere/Milliamperes</option>
				<option value="Milligram/Milligrams">Milligram/Milligrams</option>		<option value="Millihertz">Millihertz</option>
				<option value="Milliliter/Milliliters">Milliliter/Milliliters</option>	<option value="Millimeter/Millimeters">Millimeter/Millimeters</option>
				<option value="Milliohm/Milliohms">Milliohm/Milliohms</option>			<option value="Millivolt/Millivolts">Millivolt/Millivolts</option>
				<option value="Milliwatt/Milliwatts">Milliwatt/Milliwatts</option>		<option value="Nautical Mile/Nautical Miles">Nautical Mile/Nautical Miles</option>
				<option value="Ohm/Ohms">Ohm/Ohms</option>								<option value="Ounce/Ounces">Ounce/Ounces</option>
				<option value="Pack/Packs">Pack/Packs</option>							<option value="Pairs">Pairs</option>
				<option value="Pallet/Pallets">Pallet/Pallets</option>					<option value="Parcel/Parcels">Parcel/Parcels</option>
				<option value="Perch/Perches">Perch/Perches</option>					<option value="Pint/Pints">Pint/Pints</option>
				<option value="Plant/Plants">Plant/Plants</option>						<option value="Pole/Poles">Pole/Poles</option>
				<option value="Pound/Pounds">Pound/Pounds</option>						<option value="Quart/Quarts">Quart/Quarts</option>
				<option value="Quarter/Quarters">Quarter/Quarters</option>				<option value="Reams">Reams</option>
				<option value="Rod/Rods">Rod/Rods</option>								<option value="Rolls">Rolls</option>
				<option value="Sets">Sets</option>										<option value="Sheet/Sheets">Sheet/Sheets</option>
				<option value="Short Ton/Short Tons">Short Ton/Short Tons</option>		<option value="Square Centimeter/Square Centimeters">Square Centimeter/Square Centimeters</option>
				<option value="Square Feet">Square Feet</option>						<option value="Square Meters">Square Meters</option>
				<option value="Square Inch/Square Inches">Square Inch/Square Inches</option><option value="Square Mile/Square Miles">Square Mile/Square Miles</option>
				<option value="Square Yard/Square Yards">Square Yard/Square Yards</option><option value="Stone/Stones">Stone/Stones</option>
				<option value="Strand/Strands">Strand/Strands</option>					<option value="Tonne/Tonnes">Tonne/Tonnes</option>
				<option value="Tons">Tons</option>										<option value="Tray/Trays">Tray/Trays</option>
				<option value="Unit/Units">Unit/Units</option>							<option value="Volt/Volts">Volt/Volts</option>
				<option value="Watt/Watts">Watt/Watts</option>							<option value="Wp">Wp</option>
				<option value="Yard/Yards">Yard/Yards</option>		
			</select>
			<div class="P_clear"></div>
			
			<div class="P_all_template_t">Annual Purchase Volume :</div>
			<input class="input_P_3" name="volume" value="" />
			<select name="currency" class="input_P_3a"> 
				<option value="USD" >USD</option>		<option value="GBP" >GBP</option>
				<option value="RMB" >RMB</option>		<option value="EUR" >EUR</option>
				<option value="AUD" >AUD</option>		<option value="CAD" >CAD</option>
				<option value="CHF" >CHF</option>		<option value="JPY" >JPY</option>
				<option value="HKD" >HKD</option>		<option value="NZD" >NZD</option>
				<option value="SGD" >SGD</option>		<option value="NTD" >NTD</option>
				<option value="Other" >Other</option>			
			</select>
			<div class="P_clear"></div>
			
			<div class="P_all_template_t"><b>*</b>Expired Time:</div>
			<input class="input_P_1" name="totime" value="" style="width:80px" onfocus="HS_setDate(this)"/>
			<div class="clear"></div>
			<div class="P_all_Text">A Buying Request Is valid for maximun one year from the posted date.</div>
			<div class="P_clear"></div>
			
		</div>  
        
        <div class="cutline_p"></div>
		<div class="acc_submita"><a href="#" onclick="document.getElementById('tform').submit();">Submit</a></div>
      
        <div class="clear"></div>
      </div>
      <div class="clear"></div>
    </div>
 </form>
</div>
  <SCRIPT type="text/javascript">
  if(queryString('setDomain') == 'true'){
      try{document.domain = "alibaba.com";}catch(e){}
  }
      
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
  if( getUrlParameter('set_domain') == 'true' ){
      try{document.domain = 'alibaba.com'}catch(e){};
  }
  
  
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
 
  
  YUE.on( one , 'change', function() {
      if ( typeof (parent.onOneChanged) !== 'undefined' && parent.onOneChanged !== null && typeof (parent.onOneChanged.fire) !== 'undefined' && parent.onOneChanged.fire !== null ) {
          parent.onOneChanged.fire();
      }
  });
  
  //initSelectedPath('44,100000308,604');
 </SCRIPT>
  
<script type="text/javascript">
function HS_DateAdd(interval,number,date){
	number = parseInt(number);
	if (typeof(date)=="string"){var date = new Date(date.split("-")[0],date.split("-")[1],date.split("-")[2])}
	if (typeof(date)=="object"){var date = date}
	switch(interval){
	case "y":return new Date(date.getFullYear()+number,date.getMonth(),date.getDate()); break;
	case "m":return new Date(date.getFullYear(),date.getMonth()+number,checkDate(date.getFullYear(),date.getMonth()+number,date.getDate())); break;
	case "d":return new Date(date.getFullYear(),date.getMonth(),date.getDate()+number); break;
	case "w":return new Date(date.getFullYear(),date.getMonth(),7*number+date.getDate()); break;
	}
}
function checkDate(year,month,date){
	var enddate = ["31","28","31","30","31","30","31","31","30","31","30","31"];
	var returnDate = "";
	if (year%4==0){enddate[1]="29"}
	if (date>enddate[month]){returnDate = enddate[month]}else{returnDate = date}
	return returnDate;
}
function WeekDay(date){
	var theDate;
	if (typeof(date)=="string"){theDate = new Date(date.split("-")[0],date.split("-")[1],date.split("-")[2]);}
	if (typeof(date)=="object"){theDate = date}
	return theDate.getDay();
}
function HS_calender(){
	var lis = "";
	var style = "";
	style +="<style type='text/css'>";
	style +=".calender { width:200px; height:auto; font-size:12px; margin-right:14px; background:url(calenderbg.gif) no-repeat right center #fff; border:1px solid #397EAE; padding:1px}";
	style +=".calender ul {list-style-type:none; margin:0; padding:0;}";
	style +=".calender .day { background-color:#EDF5FF; height:20px;}";
	style +=".calender .day li,.calender .date li{ float:left; width:14%; height:20px; line-height:20px; text-align:center}";
	style +=".calender li a { text-decoration:none; font-family:Tahoma; font-size:11px; color:#333}";
	style +=".calender li a:hover { color:#f30; text-decoration:underline}";
	style +=".calender li a.hasArticle {font-weight:bold; color:#f60 !important}";
	style +=".lastMonthDate, .nextMonthDate {color:#bbb;font-size:11px}";
	style +=".selectThisYear a, .selectThisMonth a{text-decoration:none; margin:0 2px; color:#000; font-weight:bold}";
	style +=".calender .LastMonth, .calender .NextMonth{ text-decoration:none; color:#000; font-size:18px; font-weight:bold; line-height:16px;}";
	style +=".calender .LastMonth { float:left;}";
	style +=".calender .NextMonth { float:right;}";
	style +=".calenderBody {clear:both}";
	style +=".calenderTitle {text-align:center;height:20px; line-height:20px; clear:both}";
	style +=".today { background-color:#ffffaa;border:1px solid #f60; padding:2px}";
	style +=".today a { color:#f30; }";
	style +=".calenderBottom {clear:both; border-top:1px solid #ddd; padding: 3px 0; text-align:left}";
	style +=".calenderBottom a {text-decoration:none; margin:2px !important; font-weight:bold; color:#000}";
	style +=".calenderBottom a.closeCalender{float:right}";
	style +=".closeCalenderBox {float:right; border:1px solid #000; background:#fff; font-size:9px; width:11px; height:11px; line-height:11px; text-align:center;overflow:hidden; font-weight:normal !important}";
	style +="</style>";
	var now;
	if (typeof(arguments[0])=="string"){
		selectDate = arguments[0].split("-");
		var year = selectDate[0];
		var month = parseInt(selectDate[1])-1+"";
		var date = selectDate[2];
		now = new Date(year,month,date);
	}else if (typeof(arguments[0])=="object"){
		now = arguments[0];
	}
	var lastMonthEndDate = HS_DateAdd("d","-1",now.getFullYear()+"-"+now.getMonth()+"-01").getDate();
	var lastMonthDate = WeekDay(now.getFullYear()+"-"+now.getMonth()+"-01");
	var thisMonthLastDate = HS_DateAdd("d","-1",now.getFullYear()+"-"+(parseInt(now.getMonth())+1).toString()+"-01");
	var thisMonthEndDate = thisMonthLastDate.getDate();
	var thisMonthEndDay = thisMonthLastDate.getDay();
	var todayObj = new Date();
	today = todayObj.getFullYear()+"-"+todayObj.getMonth()+"-"+todayObj.getDate();
	for (i=0; i<lastMonthDate; i++){  // Last Month's Date
		lis = "<li class='lastMonthDate'>"+lastMonthEndDate+"</li>" + lis;
		lastMonthEndDate--;
	}
	for (i=1; i<=thisMonthEndDate; i++){ // Current Month's Date
		if(today == now.getFullYear()+"-"+now.getMonth()+"-"+i){
			var todayString = now.getFullYear()+"-"+(parseInt(now.getMonth())+1).toString()+"-"+i;
			lis += "<li><a href=javascript:void(0) class='today' onclick='_selectThisDay(this)' title='"+now.getFullYear()+"-"+(parseInt(now.getMonth())+1)+"-"+i+"'>"+i+"</a></li>";
		}else{
			lis += "<li><a href=javascript:void(0) onclick='_selectThisDay(this)' title='"+now.getFullYear()+"-"+(parseInt(now.getMonth())+1)+"-"+i+"'>"+i+"</a></li>";
		}
	}
	var j=1;
	for (i=thisMonthEndDay; i<6; i++){  // Next Month's Date
		lis += "<li class='nextMonthDate'>"+j+"</li>";
		j++;
	}
	lis += style;
	var CalenderTitle = "<a href='javascript:void(0)' class='NextMonth' onclick=HS_calender(HS_DateAdd('m',1,'"+now.getFullYear()+"-"+now.getMonth()+"-"+now.getDate()+"'),this) title='Next Month'>&raquo;</a>";
	CalenderTitle += "<a href='javascript:void(0)' class='LastMonth' onclick=HS_calender(HS_DateAdd('m',-1,'"+now.getFullYear()+"-"+now.getMonth()+"-"+now.getDate()+"'),this) title='Previous Month'>&laquo;</a>";
	CalenderTitle += "<span class='selectThisYear'><a href='javascript:void(0)' onclick='CalenderselectYear(this)' title='Click here to select other year' >"+now.getFullYear()+"</a></span>.<span class='selectThisMonth'><a href='javascript:void(0)' onclick='CalenderselectMonth(this)' title='Click here to select other month'>"+(parseInt(now.getMonth())+1).toString()+"</a></span>"; 
	if (arguments.length>1){
		arguments[1].parentNode.parentNode.getElementsByTagName("ul")[1].innerHTML = lis;
		arguments[1].parentNode.innerHTML = CalenderTitle;
	}else{
		var CalenderBox = style+"<div class='calender'><div class='calenderTitle'>"+CalenderTitle+"</div><div class='calenderBody'><ul class='day'><li>Sun</li><li>Mon</li><li>Tue</li><li>Wed</li><li>Thu</li><li>Fri</li><li>Sat</li></ul><ul class='date' id='thisMonthDate'>"+lis+"</ul></div><div class='calenderBottom'><a href='javascript:void(0)' class='closeCalender' onclick='closeCalender(this)'>×</a><span><span><a href=javascript:void(0) onclick='_selectThisDay(this)' title='"+todayString+"'>Today</a></span></span></div></div>";
		return CalenderBox;
	}
}
function _selectThisDay(d){
	var boxObj = d.parentNode.parentNode.parentNode.parentNode.parentNode;
		boxObj.targetObj.value = d.title;
		boxObj.parentNode.removeChild(boxObj);
}
function closeCalender(d){
	var boxObj = d.parentNode.parentNode.parentNode;
		boxObj.parentNode.removeChild(boxObj);
}
function CalenderselectYear(obj){
		var opt = "";
		var thisYear = obj.innerHTML;
		for (i=1970; i<=2020; i++){
			if (i==thisYear){
				opt += "<option value="+i+" selected>"+i+"</option>";
			}else{
				opt += "<option value="+i+">"+i+"</option>";
			}
		}
		opt = "<select onblur='selectThisYear(this)' onchange='selectThisYear(this)' style='font-size:11px'>"+opt+"</select>";
		obj.parentNode.innerHTML = opt;
}
function selectThisYear(obj){
	HS_calender(obj.value+"-"+obj.parentNode.parentNode.getElementsByTagName("span")[1].getElementsByTagName("a")[0].innerHTML+"-1",obj.parentNode);
}
function CalenderselectMonth(obj){
		var opt = "";
		var thisMonth = obj.innerHTML;
		for (i=1; i<=12; i++){
			if (i==thisMonth){
				opt += "<option value="+i+" selected>"+i+"</option>";
			}else{
				opt += "<option value="+i+">"+i+"</option>";
			}
		}
		opt = "<select onblur='selectThisMonth(this)' onchange='selectThisMonth(this)' style='font-size:11px'>"+opt+"</select>";
		obj.parentNode.innerHTML = opt;
}
function selectThisMonth(obj){
	HS_calender(obj.parentNode.parentNode.getElementsByTagName("span")[0].getElementsByTagName("a")[0].innerHTML+"-"+obj.value+"-1",obj.parentNode);
}
function HS_setDate(inputObj){
	var calenderObj = document.createElement("span");
	calenderObj.innerHTML = HS_calender(new Date());
	calenderObj.style.position = "absolute";
	calenderObj.targetObj = inputObj;
	inputObj.parentNode.insertBefore(calenderObj,inputObj.nextSibling);
}
  </script>