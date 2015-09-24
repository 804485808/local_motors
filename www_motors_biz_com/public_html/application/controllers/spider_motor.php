<?php
class Spider_motor extends CI_Controller{
	function index(){
		ini_set('max_execution_time', 300);
		$useragent = "Mozilla/5.0 (Windows NT 6.1; rv:7.0.1) Gecko/20100101 Firefox/7.0.1";
		$timestamp=time();
		$this->load->model("comm_model","comm");
		$this->load->model("category_model","category");
		$this->load->helper("getstr");
		
		$upload_path="/webimage/img/www_motorsbiz_com/public_html";
		
		$title=getstr($this->input->post("title"),255,1,1,1);
		if(empty($title)){
			echo "failed";
			log_message('error',"Post title empty");
			exit;
		}

		$sexword=array("Vibrator","Pink Leopard","Stimulator","G-Spot","california exotics","sex","sexual","sexy","Circumcision","Stimulation","Penis","vibe","Clitoral"
,"Penis Enlarger","Vaginal","Adult Toys","Personal Massager","Pink Lady","cook ring","vagina","Cigarette","condom","vibrator","cock","personal Lubricant"
,"Toy-G","urethral","Vibrating Ring","masturbation","masturbators","Virgin","vibrators","G spot","Vibrating Wand","cigar","anal","vibrating ball","Fat Ring","bullet","wet towel","Love Lounger"
,"Nandrolone phenylpropionate","Climax","dildo","Women massaging","Artificial Pussy","Silicone Finger Ring","Fresh pussy","Gynecological Hydrogel","delay spray","Delay wet tissue","Male Enhancement"
,"Exercise Balls","Classic Double Balls","Geisha","Pussy","Premature Ejaculation","Double Dong","OTO tablets","Princess doll","Fleshlight","Massaging Wand","Roman emperor","NITERIDER","love doll"
,"contraceptive","spermicide","sperm","Black Ant","beads Pulse","Rabbits Rings","Rabbits Ring","Love Making","Make Love","love ball","Power Love","Pornography","marijuana","drug","breast","masturbator","Original","inflatable doll","Kinekt","nipple cover","nipple tape");
		foreach($sexword as $sex){
			if(stripos(strtolower($title),$sex)!==false){
				echo "标题Sexy过滤";
				//spClass('spLog')->info("Post title has sex:".$title);
				exit;
			}
		}
		
		//内容
		$content=getstr($this->input->post("sell_content"),0,1,1,1);
		$introduce=substr($content,0,255);
		
		//分类名->type
		$type=$this->input->post("type");
		
		$keyword=$this->input->post("sell_keyword");
		
		$sell_keyword=explode("</a>",$keyword);
		array_pop($sell_keyword);
		foreach($sell_keyword as $zd){
			$sell_kws[]=trim($zd);
		}
		$keyword=join($sell_kws,",");
		if(strlen($keyword)>255){
			$keyword=substr($keyword,0,255);
		}
		
		if(empty($keyword)){
			$keyword = $type ? $type : '';
		}
		
		//公司
		$company=getstr($this->input->post("company"),150,1,1,1);
		if(empty($company)){
			echo "failed";
			die();
		}
		//最小起订量
		$minamount=getstr($this->input->post("minamount"),100,1,1);
		$minamount=substr($minamount,0,strpos($minamount," "));
		$minamount=floatval($minamount);
		if(empty($minamount)){
			$minamount=1;
		}		
		
		//供应能力
		$amount=getstr($this->input->post("standard"),100,1,1);
		$amount=substr($amount,0,strpos($amount," "));
		$amount=floatval($amount);
		if(empty($amount)){
			$amount=0;
		}
		
		//发货时间
		$days=getstr($this->input->post("days"),100,1,1);
		$days=substr($days,0,strpos($days," "));
		$days=floatval($days);
		if(empty($days)){
			$days=0;
		}
		
		//品牌
		$brand=getstr($this->input->post("brand"),100,1,1);
		
		//型号
		$model=getstr($this->input->post("model"),100,1,1);
		
		//图片
		$thumb=$this->input->post("sell_thumb");
		if(empty($thumb)){
			$thumb='/skin/default/image/nopic200.gif';
		}else{		
			$thumb=str_replace($upload_path,"",$this->img_download($thumb,$upload_path."/file/upload/sell/",1));
		}
		
		//产品属性
		$tmp_sku='';
		$sku=getstr($this->input->post("all_options"),0,1,1); 
		$sku=htmlspecialchars_decode($sku);
		$newsku=explode("</td>",$sku);
		$newsku=array_chunk($newsku,2);
		if(count($newsku[count($newsku)-1]) < 2){
			array_pop($newsku);
		}
		
		$option=array();
		$option_value=array();
		foreach($newsku as $s){
			if($s){
				$temp=strip_tags(ucwords(strtolower(trim($s[0]))));
				$option[]=substr(trim(strtr($temp,':',' ')),0,50);
				$option_value[]=substr(strip_tags(ucwords(strtolower(trim($s[1])))),0,255);
			}
		}

		
		
		//公司类型
		$mode=getstr($this->input->post("mode"),100,1,1);
		//价格
		$price=getstr($this->input->post("price"),50,1,1);
		if(strpos($price,"US")===false){
			$minprice=0;
			$maxprice=0;
			$unit='';
			$currency='';
		}else{
			$tmp_unit=explode("/",$price);
			$unit=trim($tmp_unit[1]);
			$tmp_price=$tmp_unit[0];
			$tmp_price=str_replace(array("$","US"),"",$tmp_price);

			if(strpos($tmp_price,"-")===false){
				$minprice=floatval($tmp_price);
				$maxprice=floatval($tmp_price);
			}else{
				$tmp_p=explode("-",$tmp_price);
				$minprice=floatval($tmp_p[0]);
				$maxprice=floatval($tmp_p[1]);
			}
			$currency="US";
		}
		
		//单位
		$unit=strtolower(getstr($this->input->post("unit"),30,1,1,1));
		
		//区域
		$areaname=getstr($this->input->post("area"),30,1,1);
		if(empty($areaname)){
			$areaname="China";
		}
		//$areaname=explode(",",$areaname);
		//$areaname=trim(array_pop($areaname));
		
		$areaname=ucfirst(strtolower(trim($areaname)));
		$areas=$this->comm->findAll("area");
		foreach($areas as $f){
			if(stripos($areaname,$f['areaname'])!==false){
				$areaid=$f['areaid'];
				break;
			}
		}
		if(!isset($areaid)){
			$this->db->insert("area",array("areaname"=>$areaname,"arrchildid"=>''));
			$areaid = $this->db->insert_id();
		}
		
		
		//公司国家
		$com_country=getstr($this->input->post("com_country"),30,1,1);
		if(empty($com_country)){
			$com_country="China";
		}
		$com_country=strtolower(trim($com_country));
		if($com_country=="china (mainland)"){
			$com_country = "China";
		}
		$com_country = ucfirst($com_country);
		foreach($areas as $df){
			if(stripos($com_country,$df['areaname'])!==false){
				$com_areaid=$df['areaid'];
				break;
			}
		}
		if(!isset($com_areaid)){
			$this->db->insert("area",array("areaname"=>$com_country,"arrchildid"=>''));
			$com_areaid = $this->db->insert_id();
		}
		
		/*$findcomarea=$this->comm->find("area",array("areaname"=>$com_country));
		if($findcomarea){
			$com_areaid=$findcomarea['areaid'];
		}else{
			$this->db->insert("area",array("areaname"=>$com_country,"arrchildid"=>''));
			$com_areaid = $this->db->insert_id();
		}*/
		
		//公司地址
		$address=getstr($this->input->post("address"),255,1,1);
		
		//省份
		$regcity=getstr($this->input->post("com_areaname"),30,1,1);
	
		//联系人
		$truename=getstr($this->input->post("truename"),30,1,1);
		$gender=explode(" ",$truename);
		$gender=trim($gender[0]);
		if($gender=='Ms.' || $gender=='ms.'){
			$gender=1;
		}else{
			$gender=0;
		}
		
		
		//联系电话
		$telephone=getstr($this->input->post("telephone"),50,1,1);
		
		//公司邮编
		$zipcode=getstr($this->input->post("telephone"),20,1,1);
		
		//手机
		$mobile=getstr($this->input->post("mobile"),50,1,1);
		
		//传真
		$fax=getstr($this->input->post("fax"),50,1,1);
		
		//主营产品
		$business=getstr($this->input->post("business"),255,1,1);
		if(empty($business)){
			$business=$type;
		}
		
		//员工人数
		$size=getstr($this->input->post("size"),100,1,1);
		
		//成立年份
		$regyear=getstr($this->input->post("regyear"),4,1,1);
		
		//主要市场
		$markets=getstr($this->input->post("markets"),255,1,1);
		
		//年销售额
		$volume=getstr($this->input->post("volume"),100,1,1);
		
		//出口百分比
		$export=getstr($this->input->post("export"),100,1,1);
		
		//管理体系认证
		//$icp=getstr($this->input->post("icp"),100,1,1);
		
		//注册号
		$regno=getstr($this->input->post("regno"),100,1,1);
		
		//发证机关
		$authority=getstr($this->input->post("authority"),100,1,1);
		
		//注册资本
		//$capital=getstr($this->input->post("capital"),30,1,1);
		//$capital=trim(str_ireplace(array("RMB","US",","),"",$capital));
		//$capital=floatval($capital);

		//公司图片
		$company_thumb = $this->input->post("com_thumb");
		if(empty($company_thumb)){
			$company_thumb='/skin/default/image/nopic200.gif';
		}else{
			$company_thumb=str_replace($upload_path,"",$this->img_download($company_thumb,$upload_path."/file/upload/company/",0));				
		}
		
		//公司主页
		$homepage = getstr($this->input->post("homepage"),255,1,1);				
		
		//提取分类
		$allcat=htmlspecialchars_decode($this->input->post("catname"));
		$arraycat=explode(">",$allcat);
		$catname=array_pop($arraycat);
		
		$check_title=$title.$company;
		$cmd5=md5($check_title);
		$findsell=$this->comm->find("check_sell",array("cmd5"=>$cmd5));
		
		//url
		$localurl=$this->input->post("com_url");
		
		if($findsell){
			echo "产品已经存在";
			die();						
		}
		
		
		//其他参数赋值
		$tmpname='';
		$status=3;
		$linkurl=preg_replace("/[^a-zA-Z0-9]+/","-",$title);
		$username=preg_replace("/[^a-zA-Z0-9]+/"," ",$company);
		foreach(explode(" ",$username) as $v){
			$tmpname.=strtolower(substr($v,0,1));
		}
		$username=$tmpname;
		if(strlen($username)>27){
			$username=substr($username,0,27);
		}
		
		$username=$username.mt_rand(0,99);
		$password="b2bcaiji@test.com";
		$md5password=md5($password);
		$email=$username."@test.com";
		//部门
		$department=getstr($this->input->post("department"),30,1,1);
		//职位
		$career=getstr($this->input->post("career"),30,1,1);
		
		$regtime=$timestamp;
		$regip=$_SERVER["REMOTE_ADDR"];
		
		$findcompany=$this->comm->find("company",array("company"=>$company));
		if(!$findcompany){			
			$company_content=$this->input->post("com_content");
			$company_introduce=$this->input->post("com_introduce");
			if(!$company_introduce){
				$company_introduce=getstr($company_content,0,1,1,-1);
				$company_introduce=substr($company_introduce,0,200);
			}
			$company_content=getstr($company_content,0,1,1,1);
			
			if(empty($company_introduce) || empty($company_content)){
				$company_introduce=$company;
				$company_content=$company;
			}
			
			if(empty($regyear)){
				$regyear=1990;
			}
			
			$member_record=array(
				"username"=>$username,
				"company"=>$company,
				"passport"=>$username,
				"password"=>$md5password,
				"payword"=>$md5password,
				"email"=>$email,
				"gender"=>$gender,
				"truename"=>$truename,
				"mobile"=>$mobile,
				"department"=>$department,
				"career"=>$career,
				"groupid"=>6,
				"regid"=>6,
				"areaid"=>$com_areaid,
				"edittime"=>$timestamp,
				"regip"=>$regip,
				"regtime"=>$regtime,
				"vmail"=>1
			);
			$this->db->insert("member",$member_record);
			$userid=$this->db->insert_id();
			
			if($userid){
				$company_record=array(
					"userid"=>$userid,
					"username"=>$username,
					"groupid"=>6,
					"company"=>$company,
					"areaid"=>$com_areaid,
					"mode"=>$mode,
					"regyear"=>$regyear,
					"regcity"=>$regcity,
					"business"=>$business,
					"telephone"=>$telephone,
					"fax"=>$fax,
					"mail"=>$email,
					"address"=>$address,
					"zipcode"=>$zipcode,
					"homepage"=>$homepage,
					"introduce"=>$company_introduce,
					"size"=>$size,
					"markets"=>$markets,
					"volume"=>$volume,
					"export"=>$export,
					"regno"=>$regno,
					"authority"=>$authority,
					"thumb"=>$company_thumb
				);
				$this->db->insert("company",$company_record);
				$this->db->insert("company_data",array("userid"=>$userid,"content"=>$company_content));
				
			}
			
		}else{
			$username=$findcompany['username'];
			$userid=$findcompany['userid'];
		}
		
		/*$find_comurl=$this->comm->find("comurl",array("userid"=>$userid));
		if(!$find_comurl){
			$this->db->insert("comurl",array("userid"=>$userid,"company"=>$company,"url"=>$localurl));
		}*/
		
		if(!$findsell){
			$pageurl=$this->input->post("pageurl");
			$url_3=explode("/",$pageurl);
			$aliid=isset($url_3[4]) ? $url_3[4] : 0;
			$pageurl=strtr($pageurl,array("product-gs"=>"catalog"));
			$ch= curl_init();
			$useragent="Mozilla/5.0 (Windows NT 6.1; WOW64; rv:26.0) Gecko/20100101 Firefox/26.0";
			$cookie="ali_apache_id=218.108.97.74.72741161808669.4; xman_us_f=x_l=0; xman_f=Psa5vSJraAE9N8K1pWjBWQDvRUo7Vuf6WQyxXtt54AsMGeGTomalyt2Vm+ZRNMRFTDClT7tnYiiIGIEjV+31VH+2KpyKwH41AXPToydBvjTYPyhSPy3Zxw==; __utma=226363722.1690977979.1382661802.1392615295.1392624687.25; __utmz=226363722.1392615295.24.11.utmcsr=alibaba.com|utmccn=(referral)|utmcmd=referral|utmcct=/products/F0/motors/CID146909.html; ali_beacon_id=218.108.97.74.1382661800804.466139.2; cna=5rLwCsTLdmICAdpsYUpz2IPV; ali_ab=218.108.97.74.1382661806926.0; sync_cookie=true; _ga=GA1.2.1690977979.1382661802; history=keywords%5E%0Akeywords%09pump%09motor%09motors%0A%0Aproduct_selloffer%5E%0A51320945%24%0A929986054; JSESSIONID=A75709B5EA3D093227BBAF2FF6F964E6; acs_usuc_t=acs_rt=e1b0391b50444386b4736b5877d1b662; xman_t=pkd/v1Vny4z+WpR62b6sJ/oweP4SrgOMp6/VXUMsTFptKODlEiXuB/se4RUHy6MQ; acs_t=oA0PH2DSl3lxXqwiNtpdZtqQqmnPFpECXqwg80D/sf1Rl5Q5TnADwEelUqXie2LQ; __utmc=226363722; _mle_tmp0=eNrz4A12DQ729PeL9%2FV3cfUx8KvOTLFScjQ3NTewdDJ1dTR2MbA0NjIyd3JydDNyczNzszQzcTVT0kkusTI0tjQyM7CwNLQ0tzTTSUxGE8itsDKojQIAoxcYDg%3D%3D; atm-x=__V%3D1; ali_apache_track=; ali_apache_tracktmp=; __utmb=226363722.4.10.1392624687";
			$header = array(
					"Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8",
					"Connection: keep-alive",
					"Accept-Language: zh-cn,zh;q=0.8,en-us;q=0.5,en;q=0.3",
					"Host: www.alibaba.com"
				);
			$options = array(
					CURLOPT_URL => $pageurl,
					CURLOPT_TIMEOUT => 30,
					CURLOPT_HTTPHEADER => $header,
					CURLOPT_RETURNTRANSFER => 1,
					CURLOPT_USERAGENT => $useragent,
					CURLOPT_FOLLOWLOCATION => 1,
					CURLOPT_HEADER => 1,
					CURLOPT_COOKIEFILE => $cookie,
					CURLOPT_COOKIEJAR => $cookie,
					CURLOPT_ENCODING => 'gzip,deflate',
					CURLOPT_AUTOREFERER => true
			);
			curl_setopt_array($ch, $options);
		
			$catalog_page = curl_exec($ch);
			preg_match_all("/<\s*div\s* class=\"crumb\"\s*>.*<\/\s*div\s*>/Uis",$catalog_page,$arr);
			$str=strip_tags($arr[0][0]);
			$arr=explode(">",$str);
			
			$companycatname=trim($arr[count($arr)-2]);
			if(!empty($companycatname)){
				$findtype=$this->comm->find("type",array("tname"=>$companycatname,"userid"=>$userid));
				if(!$findtype){
					$this->db->insert("type",array("tname"=>$companycatname,"userid"=>$userid));
					$mycatid=$this->db->insert_id();
				}else{
					$mycatid=$findtype['tid'];
				}
			}else{
				$mycatid=0;
			}
			$cat_catname = getstr($this->input->post("cat_catname"),50,1,1);
			//$cat_catname = strtr($cat_catname,array("_"=>" "));
			$catid=$this->comm->find("category",array("catname"=>$cat_catname),"","catid");
			if(!$catid){
				$this->load->library('Sphinxclient','','sphinx');
				$this->sphinx->SetServer ('127.0.0.1', 9312);
				$this->sphinx->SetConnectTimeout(1);
				$this->sphinx->SetArrayResult(true);
				$this->sphinx->SetMatchMode(SPH_MATCH_EXTENDED2);
				$this->sphinx->SetSortMode(SPH_SORT_RELEVANCE);
				$this->sphinx->SetLimits(0,1);
				$this->sphinx->SetMatchMode(SPH_MATCH_ALL);
				$re = $this->sphinx->Query("\"{$cat_catname}\"/2", "category");
				//dump($re);
				if(!empty($re['matches'])){
					$catid = $re['matches'][0]['id'];									
				}
			}else{
				$catid = $catid['catid'];
			}
			
			if(!$catid){
				echo "the catid was not failed";
				die();
			}
			
			$newrecord=array(
				"catid"=>$catid,
				"mycatid"=>$mycatid,
				"areaid"=>$areaid,
				"level"=>1,
				"elite"=>1,
				"title"=>$title,
				"introduce"=>$introduce,
				"model"=>$model,
				"brand"=>$brand,
				"unit"=>$unit,
				"minprice"=>$minprice,
				"maxprice"=>$maxprice,
				"currency"=>$currency,
				"minamount"=>$minamount,
				"amount"=>$amount,
				"days"=>$days,
				"keyword"=>$keyword,
				"thumb"=>$thumb,
				"username"=>$username,
				"groupid"=>6,
				"pptword"=>'',
				"company"=>$company,
				"truename"=>$truename,
				"telephone"=>$telephone,
				"mobile"=>$mobile,
				"address"=>$address,
				"email"=>$email,
				"addtime"=>$timestamp,
				"edittime"=>$timestamp,
				"adddate"=>date("Y-m-d",$timestamp),
				"editdate"=>date("Y-m-d",$timestamp),
				"status"=>$status,
				"linkurl"=>$linkurl,
				"aliid"=>$aliid
			);
			$this->db->insert("sell",$newrecord);
			$itemid=$this->db->insert_id();
			
			if($itemid){
				$this->db->insert("sell_data",array("itemid"=>$itemid,"content"=>$content));
				$parentids = $this->comm->find("category",array("catid"=>$catid));
				$parentids = $parentids['arrparentid'].",".$catid;
				$parentids = explode(",",$parentids);
				
				foreach($parentids as $df){
					$this->db->set("item","item+1",FALSE);
					$this->db->where("catid",$df);
					$this->db->update("category");
				}
				
				foreach($option as $k => $o){
					$findoption=$this->comm->find("category_option",array("name"=>$o,"catid"=>$catid));
					if(!$findoption){
						$this->db->insert("category_option",array("name"=>$o,"catid"=>$catid));
						$oid = $this->db->insert_id();
					}else{
						$oid = $findoption['oid'];
					}
					$this->db->insert("category_value",array("itemid"=>$itemid,"oid"=>$oid,"value"=>$option_value[$k],"catid"=>$catid));
					$value_id = $this->db->insert_id();
					
					$did=0;
					$length=strlen($option_value[$k]);					
					if($length>=3 && $length<=30){
						$rs_0=$this->comm->find("category_default_option",array("value"=>$option_value[$k]));
						
						$rs=$this->comm->find("category_default_option",array("value"=>$option_value[$k],"catid"=>$catid,"oid"=>$oid));
						
						if($rs_0 && $rs){
							//$default_attr=array("id"=>$rs['id'],"catid"=>$catid);	
							$this->db->set("num","num+1",FALSE);
							$this->db->where(array("id"=>$rs['id'],"oid"=>$oid));
							$this->db->update("category_default_option");
							$did=$rs['id'];
						}elseif($rs_0){
							$my_id=$rs_0['id'];
							$default_attr=array("id"=>$my_id,"catid"=>$catid);
							$did=$my_id;							
							$default_attr['value']=$option_value[$k];
							$default_attr['oid']=$oid;
							$default_attr['num']=1;
							$this->comm->create("category_default_option",$default_attr);
						}else{
							$maxid=$this->comm->find("category_default_option","","","max(id)");
							$maxid=$maxid ? $maxid['max(id)'] : 0;
							$maxid++;
							$default_attr=array("id"=>$maxid,"catid"=>$catid);
							$did=$maxid;
							
							$default_attr['value']=$option_value[$k];
							$default_attr['catid']=$catid;
							$default_attr['oid']=$oid;
							$default_attr['num']=1;
							$this->comm->create("category_default_option",$default_attr);
						}
						
						/*$de_temp=$this->comm->findCount("category_default_option",$default_attr);
						$default_attr['value']=$option_value[$k];
						$default_attr['oid']=$oid;
						$default_attr['num']=1;
						if(!$de_temp){
							$this->comm->create("category_default_option",$default_attr);
						}*/
					}
					
					$this->db->update("category_value",array("did"=>$did),array("id"=>$value_id));
					
					$this->db->set("item","item+1",FALSE);
					$this->db->where("oid",$oid);
					$this->db->update("category_option");
					
				}
				
				$option_values=$this->comm->findAll("category_value",array("itemid"=>$itemid),"oid asc");
				$tmp_op=array();
				foreach($option_values as $v){
					$tmp_op[]=$v['oid'];
				}
				$option_values=implode(",",$tmp_op);
				
				$this->db->update("sell",array("pptword"=>$option_values),array("itemid"=>$itemid));
				$this->db->insert("check_sell",array("cmd5"=>$cmd5,"sid"=>$itemid));
				
				echo "success";
			}else{
				echo "failed";
			}
			
						
		}
		
	}
	
	function img_download($url,$path="./file/upload/",$imgwater=0){
		$curl = curl_init($url);
		curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
		$imageData = curl_exec($curl);
		curl_close($curl);
		$name=explode("/",$url);
		$datetmp=date("Ymd");
		$filename=$path.$datetmp."/".preg_replace("/[^a-zA-Z0-9_\-\.\!]/","",array_pop($name));
		if(!file_exists($path.$datetmp."/")){
			mkdir($path.$datetmp."/",0777,true);
		}
		$tp = @fopen($filename,'a');
		fwrite($tp, $imageData);
		fclose($tp);
		$path=array(
				'img_path'=>$filename,	//原图片所在目录
				'logo_path'=>FCPATH."skin/images/pic_f.png"	//原始logo路径
			);
		return $imgwater ? $this->img_watermark($path) : $filename;
	}
	
	function preg_substr($pattern,$pattern1,$subject){
		preg_match($pattern,$subject,$arr,PREG_OFFSET_CAPTURE);
		$subject1=substr($subject,$arr[0][1]+strlen($arr[0][0]));
		if(empty($arr[0][1])){
			return '';
		}
		preg_match($pattern1,$subject1,$arr1,PREG_OFFSET_CAPTURE);
		$content=substr($subject1,0,$arr1[0][1]);
		$content=preg_replace($pattern,"",$content);
		return $content;
	}
	
	function add_spider_url(){
		ini_set('max_execution_time', '0');
		$this->load->model("comm_model","comm");
		$rs=$this->comm->findAll("category",array("child"=>0,"collect"=>0),"catid asc","catid,catname","0,10");
		//1676
		//dump(count($rs));
		$str="";
		$c=$j=0;
		$total=100;
		foreach ($rs as $v){
			$temp='';
			$temp=strtolower($v['catname']);
			if (strstr($temp,"motor")){
				$j++;
				$temp=explode(" ",$temp);
				$temp=join("_",$temp);
				for ($i=1;$i<=$total;$i++){
					//http://www.alibaba.com/products/F0/dc_motors/5.html
					$str.="http://www.alibaba.com/products/F0/".$temp."/".$i.".html\r\n";
					$c++;
				}
				$this->comm->update("category",array("catid"=>$v['catid']),array("collect"=>-1));
			}
		}

		file_put_contents("D:\LocoySpider_V8.0_Build20130917_Free\Data\motor_spider.txt", $str);
		if($c==$j*$total){
			echo "success";
		}
	}
	
	function img_watermark($path){
		$this->load->library('image_lib');
		$config['source_image'] = $path['img_path'];
		$config['wm_type'] = 'overlay';
		$config['wm_overlay_path'] = $path['logo_path'];
		$config['quality'] = 90;
		$config['wm_opacity'] = 100;
		$config['wm_vrt_alignment'] = 'middle';
		$config['wm_hor_alignment'] = 'left';
		$config['wm_vrt_offset'] = '-10';
		$this->image_lib->initialize($config); 
		$this->image_lib->watermark();
		return $path['img_path'];
	}
}