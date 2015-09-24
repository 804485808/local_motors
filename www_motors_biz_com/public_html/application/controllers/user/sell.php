<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Sell extends CI_Controller{
	private $username;
	private $password;
	function __construct(){
		parent::__construct();
		$this->load->library('encrypt');		
		$this->load->library('form_validation');
		$this->load->model('comm_model','comm');		
		$this->username = $this->input->cookie('username', TRUE);
		$this->password = $this->input->cookie('password', TRUE);
		$hash_1 = $this->input->cookie('hash_1', TRUE);
		$hash_2 = $this->input->cookie('hash_2', TRUE);
		$this->username=$this->encrypt->decode($this->username,$hash_1);
		$this->password=$this->encrypt->decode($this->password,$hash_2);
 		if (!$this->username || !$this->password){
 			redirect(site_url("reg_login/login_in"));
		} elseif (!$rs=$this->comm->find('member',array("username"=>$this->username,"password"=>$this->password),'','userid,vmail,email,company')){
			redirect(site_url("reg_login/login_in"));
		} elseif (!$rs['vmail']){
			$data['email'] = $rs['email'];
			$str = $this->load->view('user/vmail_notice',$data,TRUE);
			echo $str;
			die();
		}
		$this->userid = $rs['userid'];
		
	}
	//wl_sell.status:1->待审核	 3->已发布
	function post_sell($itemid = 0){
		$data['site'] = $site = $this->config->item('site');
		$finduser = $this->comm->find('member',array("username"=>$this->username));
		if(!$finduser['company']){
			redirect(site_url("user/my_biz/show_info/need"));
			die();
		}
		$this->load->driver('cache',array('adapter' => 'file'));
		$this->cache->clean();
		if(!$cat1=$this->cache->get('cat1')){
			$cat1 = $this->comm->findAll("category",array("parentid"=>0),"letter asc");
			$this->cache->save('cat1', $cat1, 60*60*24*30);
		}
		if(!$cat2=$this->cache->get('cat2')){
			foreach($cat1 as $k => $v){
				$cat2[$v['catid']] = $this->comm->findAll("category",array("parentid"=>$v['catid']));
			}
			$this->cache->save('cat2', $cat2, 60*60*24*30);
		}
		if(!$cat3=$this->cache->get('cat3')){
			foreach($cat2 as $k => $v){
				foreach($v as $x => $s){
					$cat3[$s['catid']] = $this->comm->findAll("category",array("parentid"=>$s['catid']));
				}
				$this->cache->save('cat3', $cat3, 60*60*24*30);

			}
		}

		if(!$cat4=$this->cache->get('cat4')){
			foreach($cat3 as $k => $v){
				foreach($v as $x => $s){
					$cat4[$s['catid']] = $this->comm->findAll("category",array("parentid"=>$s['catid']));

				}
			}
			$this->cache->save('cat4', $cat4, 60*60*24*30);
		}
		
		$data['cat1'] = $cat1;
		$data['cat2'] = $cat2;
		$data['cat3'] = $cat3;
		$data['cat4'] = $cat4;
		$data['title'] = 'Post selling leads ';
		
		$products_group = $this->comm->findAll("type",array("userid"=>$this->userid));
		$data['products_group'] = $products_group;
		
		if($itemid){
			$areaname = $this->comm->findAll("area");
			$data['areaname'] = $areaname;
			$username = $this->username;
			$sell = $this->comm->linker()->find("sell",array("itemid"=>$itemid,"username"=>$username));
			if(!$sell){
				show_error("Edit Error");
				die();
			}
			$thiscat = $this->comm->find("category",array("catid"=>$sell['catid']));
			$sell['sell_data']['content'] = str_replace(array("<br>","<br/>"),"\n",$sell['sell_data']['content']);
			$data['sell'] = $sell;
			$thiscat['arrparentid'] = substr($thiscat['arrparentid'],2);
			$data['arrparentid'] = $thiscat['arrparentid'].",".$sell['catid'];
			if(!$sell['pptword']){
				$sell['pptword'] = 0;
			}
			$op = $this->comm->findAll("category_option","oid in ({$sell['pptword']})","FIND_IN_SET(oid,'{$sell['pptword']}')");
			$op_value = $this->comm->findAll("category_value",array("itemid"=>$itemid),"FIND_IN_SET(oid,'{$sell['pptword']}')");
			foreach($op as $k => $v){
				$tmp[$v['oid']]['name'] = $v['name'];
				$tmp[$v['oid']]['value'] = $op_value[$k]['value'];
			}
			
			$option = $tmp;
			$data['option'] = $option;
			$data['username'] = $this->username;

			$this->load->view('user/header',$data);
			$this->load->view('user/edit_sell');
			$this->load->view('user/footer');
		}else{
			$data['username'] = $this->username;
			$this->load->view('user/header',$data);
			$this->load->view('user/post_sell');
			$this->load->view('user/footer');
		}
		
		
	}
	
	function edit_sell(){
		$itemid = $this->uri->rsegment(3,0);
		$itemid = intval($itemid);
		if($itemid){
			$this->post_sell($itemid);
		}else{
			show_error("Not found selling leads ");
		}
	}
	
	function delete_sell(){
		$username = $this->username;
		$itemid = $this->uri->rsegment(3,0);
		$itemid = intval($itemid);
		
		$del_itemid = $this->input->post('itemid',TRUE);
		$del_itemid=explode("-", $del_itemid);
		array_pop($del_itemid);
		if (is_array($del_itemid)){
			$c=0;
			 foreach ($del_itemid as $v){
			 	$v = intval($v);
				$findsell = $this->comm->find("sell",array("itemid"=>$v,"username"=>$username));
				if ($findsell){
					$delsell = $this->comm->delete("sell",array("itemid"=>$v));
					if($delsell){
						$this->comm->delete("category_value",array("itemid"=>$v));	
						$this->comm->delete("sell_data",array("itemid"=>$v));
						$c++;
					} 
				}else{
					$rs="There's no this products!";
				}
			}
			if ($c==count($del_itemid)){
				$rs="Delete Success";
			}else{
				$rs="Delete Failed";
			} 
		}
		$total_count=$this->comm->findCount("sell",array("username"=>$username));
		$list=array("msg"=>$rs,"total_count"=>$total_count);
		$this->output->set_content_type('application/json')->set_output(json_encode($list));					
	}
	
	
	function save_sell(){
		
		$this->config->load('uploader_settings', TRUE);
		$this->load->helper("getstr");
		$this->load->helper("checkhtml");
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation'); 
		$this->form_validation->set_rules('title', 'Product Name', 'required|max_length[255]');
		$this->form_validation->set_rules('content', 'product Detail', 'required');
		$this->form_validation->set_rules('catid', 'Category', 'required|numeric');
		$this->form_validation->set_rules('path', 'Photo', 'required');
		$this->form_validation->set_rules('minamount', 'Minimum Order', 'required|numeric');
		$this->form_validation->set_rules('unit', 'Unit Type', 'required');
		$this->form_validation->set_rules('minprice', 'Price', 'required|numeric');
		$this->form_validation->set_rules('currency', 'Currency', 'required');
		
		if ($this->form_validation->run() == FALSE){
			$message = validation_errors();
			$json = array("code"=>0,"message"=>$message);
			echo json_encode($json); 
			die();
		}else{
			$title = $this->input->post("title",TRUE);
			$title = getstr($title,255,0,0,-1);
			$content = $this->input->post("content");
			//Sexy过滤
			$sexword=array("Vibrator","Pink Leopard","Stimulator","G-Spot","california exotics","sexual","sexy","Circumcision","Stimulation","Penis","Clitoral"
					,"Penis Enlarger","Vaginal","Adult Toys","Personal Massager","Pink Lady","cook ring","vagina","Cigarette","condom","vibrator","personal Lubricant"
					,"Toy-G","urethral","Vibrating Ring","masturbation","masturbators","Virgin","vibrators","G spot","Vibrating Wand","cigar","anal","vibrating ball","Fat Ring","bullet","wet towel","Love Lounger"
					,"Nandrolone phenylpropionate","Climax","dildo","Women massaging","Artificial Pussy","Silicone Finger Ring","Fresh pussy","Gynecological Hydrogel","delay spray","Delay wet tissue","Male Enhancement"
					,"Exercise Balls","Classic Double Balls","Geisha","Pussy","Premature Ejaculation","Double Dong","OTO tablets","Princess doll","Fleshlight","Massaging Wand","Roman emperor","NITERIDER","love doll"
					,"contraceptive","spermicide","sperm","Black Ant","beads Pulse","Rabbits Rings","Rabbits Ring","Love Making","Make Love","love ball","Power Love","Pornography","marijuana","drug","breast","masturbator","Original","inflatable doll","Kinekt","nipple cover","nipple tape");
				
			foreach($sexword as $sex){
				if(preg_match("/\b{$sex}\b/i",$title)){
					$json = array("code"=>0,"message"=>"Title Contains Sensitive Words!");
					echo json_encode($json);
					die();
				}elseif (preg_match("/\b{$sex}\b/i",$content)){
					$json = array("code"=>0,"message"=>"Content Contains Sensitive Words!");
					echo json_encode($json);
					die();
				}
			}
			
			$timestamp = time();
			$img_rootpath = $this->config->item('img_rootpath','uploader_settings');
			$img_path = $this->config->item('img_path','uploader_settings');
			$username = $this->username;
			$itemid = $this->input->post("itemid");
			$itemid = intval($itemid);
			$linkurl=preg_replace("/[^a-zA-z0-9]+/","-",$title);
			$introduce = getstr($content,255,0,0,-1);
			$content = checkhtml($content);
			$catid = $this->input->post("catid");
			$catid = intval($catid);
			$thumb = $this->input->post("path",TRUE);
			$thumb = getstr($thumb,255,0,0,-1);
			$thumb1 = $this->input->post("path_1",TRUE);
			$thumb1 = getstr($thumb1,255,0,0,-1);
			$thumb2 = $this->input->post("path_2",TRUE);
			$thumb2 = getstr($thumb2,255,0,0,-1);
			$option = $this->input->post("option",TRUE);
			foreach($option as $k => $v){
				$tmp[$k] = getstr($v,255,0,0,-1);
			}
			$option = $tmp;
			
			$minamount = $this->input->post("minamount");
			$minamount = floatval($minamount);
			$unit = $this->input->post("unit",TRUE);
			$unit = getstr($unit,30,0,0,-1);
			$minprice = $this->input->post("minprice");
			$minprice = floatval($minprice);
			$currency = $this->input->post("currency",TRUE);
			$currency = getstr($currency,15,0,0,-1);
			$mycatid = $this->input->post("mycatid");
			$mycatid =  intval($mycatid);
			$ip = $this->input->ip_address();
			
			$i = 0;
			foreach($option as $k => $v){
				if($i==0){
					if(!is_numeric($v)){
						$areaid = 1;
						break;
					}
					$areaid = $v;
					$area = $this->comm->find("area",array("areaid"=>$areaid));
					$araeid = $area['areaid'];
					$option[$k] = $area['areaname'];
					break;
				}
			}
			
			$areaid = intval($areaid);
			
			if($itemid){
				$findsell = $this->comm->find("sell",array("itemid"=>$itemid,"username"=>$username));
				if(!$findsell){
					$json = array("code"=>0,"message"=>'Update error : You don\'t have operation permissions or the product is not exsit');
					echo json_encode($json); 
					die();
				}
				
				$findcate = $this->comm->find("category",array("catid"=>$catid));
				if($findcate && $findcate['child']==1){
					$json = array("code"=>0,"message"=>'Please choose the last Category');
					echo json_encode($json); 
					die();
				}
				$updaterecord = array(
					'title'=>$title,
					'catid'=>$catid,
					'mycatid'=>$mycatid,
					'areaid'=>$areaid,
					'unit'=>$unit,
					'minprice'=>$minprice,
					'maxprice'=>$minprice,
					'currency'=>$currency,
					'minamount'=>$minamount,
					'groupid'=>6,
					"edittime"=>$timestamp,
					"editdate"=>date("Y-m-d",$timestamp),
					'introduce'=>$introduce,
					"linkurl"=>$linkurl,
					'sell_data'=>array(
						'content'=>$content,
					),
				);
				$this->comm->linker()->update("sell",array("itemid"=>$itemid),$updaterecord);
				foreach($option as $k => $o){
					$oid = $k;
					$value = $o;
					$this->db->update("category_value",array("value"=>$value),array("itemid"=>$itemid,"oid"=>$oid));
				}

				$newthumb = $this->move_image($thumb,$linkurl);
				if($newthumb!==false){
					$this->db->update("sell",array("thumb"=>$newthumb),array("itemid"=>$itemid));
				}
				if($thumb1){
					$newthumb1 = $this->move_image($thumb1,$linkurl);
					if($newthumb!==false){
						$this->db->update("sell",array("thumb1"=>$newthumb1),array("itemid"=>$itemid));
					}
				}
				if($thumb2){
					$newthumb2 = $this->move_image($thumb2,$linkurl);
					if($newthumb!==false){
						$this->db->update("sell",array("thumb2"=>$newthumb2),array("itemid"=>$itemid));
					}
				}

				$json = array("code"=>1,'message'=>"update success",'href'=>site_url("user/sell/manage_sell"));
				echo json_encode($json);
				die();
			}else{
				$companyinfo = $this->comm->linker()->find("member",array("username"=>$username));
				$newrecord = array(
					'title'=>$title,
					'catid'=>$catid,
					'mycatid'=>$mycatid,
					'areaid'=>$areaid,
					'unit'=>$unit,
					'minprice'=>$minprice,
					'maxprice'=>$minprice,
					'currency'=>$currency,
					'minamount'=>$minamount,
					'thumb'=>$thumb,
					'thumb1'=>$thumb1,
					'thumb2'=>$thumb2,
					'groupid'=>6,
					'pptword'=>'',
					'company'=>$companyinfo['company'],
					'truename'=>$companyinfo['truename'],
					'username'=>$username,
					"telephone"=>$companyinfo['mcompany']['telephone'],
					"mobile"=>$companyinfo['mobile'],
					"address"=>$companyinfo['mcompany']['address'],
					"email"=>$companyinfo['mcompany']['mail'],
					"addtime"=>$timestamp,
					"edittime"=>$timestamp,
					"adddate"=>date("Y-m-d",$timestamp),
					"editdate"=>date("Y-m-d",$timestamp),
					"status"=>1,
					'ip'=>$ip,
					'introduce'=>$introduce,
					"linkurl"=>$linkurl,
					'sell_data'=>array(
						'content'=>$content,
					),
				);
				
				$cmd5 = md5($title.$companyinfo['company']);
				$findsell = $this->comm->find("check_sell",array("cmd5"=>$cmd5));
				if(!$findsell){
					$itemid = $this->comm->linker()->create("sell",$newrecord);
					if($itemid){
						$parentids = $this->comm->find("category",array("catid"=>$catid));
						$parentids = $parentids['arrparentid'].",".$catid;
						$parentids = explode(",",$parentids);
						
						foreach($parentids as $catid){
							$this->db->set("item","item+1",FALSE);
							$this->db->where("catid",$catid);
							$this->db->update("category");
						}
						
						foreach($option as $k => $o){
							$oid = $k;
							$value = $o;
							
							if(!empty($value)){
								$this->db->insert("category_value",array("itemid"=>$itemid,"oid"=>$oid,"value"=>$value));
								
								$this->db->set("item","item+1",FALSE);
								$this->db->where("oid",$oid);
								$this->db->update("category_option");
							}
						}
						
						$option_values=$this->comm->findAll("category_value",array("itemid"=>$itemid),"oid asc");
						$tmp_op=array();
						foreach($option_values as $v){
							$tmp_op[]=$v['oid'];
						}
						$option_values=implode(",",$tmp_op);
						
						
						$newthumb = $this->move_image($thumb,$linkurl);
						if($newthumb){
							$this->db->update("sell",array("pptword"=>$option_values,"thumb"=>$newthumb),array("itemid"=>$itemid));
						}else{
							$this->db->update("sell",array("pptword"=>$option_values),array("itemid"=>$itemid));

						}
						if($thumb1){
							$newthumb1 = $this->move_image($thumb1,$linkurl);
							if($newthumb1){
								$this->db->update("sell",array("thumb1"=>$newthumb1),array("itemid"=>$itemid));
							}
						}
						if($thumb2){
							$newthumb2 = $this->move_image($thumb2,$linkurl);
							if($newthumb2){
								$this->db->update("sell",array("thumb2"=>$newthumb2),array("itemid"=>$itemid));
							}
						}
						
						
						$this->db->insert("check_sell",array("cmd5"=>$cmd5,"sid"=>$itemid));
						$json = array("code"=>1,'message'=>"post successfully",'href'=>site_url("user/sell/manage_sell"));
						echo json_encode($json);
					}else{
						$json = array("code"=>0,'message'=>'post error,please retry');
						echo json_encode($json);
					}
				}else{
					$json = array("code"=>0,'message'=>'The product has exsit');
					echo json_encode($json);
				}
			}
			
			
		}
		
	}
	
	
	function check_sell_category(){
		$catid = $this->input->post("catid");
		$catid = intval($catid);
		
		$cat = $this->comm->find("category",array("catid"=>$catid));
		if(!$cat['child']){
			//表示最后一级分类
			echo 1;
		}else{
			echo 0;
		}
	}
	
	function category_option(){
		$catid = $this->input->post("catid");
		$catid = intval($catid);
		
		$option = $this->comm->findAll("category_option",array("catid"=>$catid),'','','0,8');
		$areaname = $this->comm->findAll("area");
		
		
		foreach($option as $k => $v){
			if(strtolower($v['name'])=='place of origin'){
				echo '<div class="P_all_template_t"><b>*</b>Place Of Origin:</div>'."\n";
				echo '<select name="option['.$v["oid"].']"><option value="0">---Please Select---</option>'."\n";
				foreach($areaname as $a){
					echo '<option  value="'.$a['areaid'].'" title="">'.$a['areaname'].'</option>'."\n";
				}
				echo "</select>";
				echo '<div class="P_clear"></div>'."\n";
				unset($option[$k]);
			}
		}
		foreach($option as $k => $v){
				echo '<div class="P_all_template_t">'.$v['name'].':</div>'."\n";
				echo '<input name=option['.$v["oid"].'] value="" type="text" />';
				echo '<div class="P_clear"></div>'."\n";
		}
	}
	
	
	
	//供应管理--产品列表
	public function manage_sell(){
		$data['username']=$username = $this->username;
		$data['site'] = $site = $this->config->item('site');
		$data['title'] = "Supply Management Of ".$username." On ".$site['site_name'];
		$data['groups']=$this->comm->findAll("type",array("userid"=>$this->userid),"listorder asc");
		$page = $this->uri->rsegment(3,0);
		$data['page'] = $page = intval($page);
		$data['groupid']=0;
		$uri_segment = 4;
		$base_url = site_url("/user/sell/manage_sell/");
		$type = $this->uri->rsegment(3,'');
		$condition="username = '{$username}' AND status <>0";
		if(preg_match("/^[a-zA-Z-_]{1,}$/isU",$type)){
			$page = $this->uri->rsegment(4,0);
			$data['page'] = $page = intval($page);
			$uri_segment = 5;
			$base_url = site_url("/user/sell/manage_sell/".$type."/");
			$data['type']=$type;
		}elseif (preg_match("/^[a-zA-Z]{1,}-[0-9]{1,}$/isU",$type)) {
			$tid = explode("-",$type);
			$data['groupid']=$tid = intval($tid[1]);
			$page = $this->uri->rsegment(4,0);
			$uri_segment = 5;
			$condition="mycatid = '{$tid}' AND username = '{$username}' AND status <>0";
			$base_url = site_url("user/sell/manage_sell/".$type."/");
			$data['type']='';
		}else{
			$data['type']='';
		}


		$data['supply_list'] = $supply_list=$this->comm->findAll("sell",$condition,"itemid desc","itemid,title,introduce,unit,amount,hits,thumb,totime,linkurl,status,username","{$page},4");
		$data['check_pic'] = $check_pic = array(1=>'check pending',2=>'Unapproved',3=>'Published');
		$data['total'] = $this->comm->findCount("sell",array("username"=>$username));
		$data['total_count'] = $total_count = $this->comm->findCount("sell",$condition);
		$data['pending_review'] = $this->comm->findCount("sell", array("username"=>$username,"status"=>1));
		$data['unapproved'] = $this->comm->findCount("sell", array("username"=>$username,"status"=>2));
		$data['published'] = $this->comm->findCount("sell", array("username"=>$username,"status"=>3));
		$data['approved'] = $this->comm->findCount("sell", array("username"=>$username,"status"=>4));
		$this->load->library('pagination');



		$config['base_url'] = $base_url;
		$config['total_rows'] = $total_count;
		$config['per_page'] = $data['page_size']=4;
		$config['uri_segment'] = $uri_segment;
		$config['num_links'] = 3;
		$config['suffix'] = $this->config->item('url_suffix');
		$config['cur_tag_open'] = '<span class="current">';
		$config['cur_tag_close'] = '</span>';
			
		$this->pagination->initialize($config);
		$pages = $this->pagination->create_links();
		$data['pages'] = $pages;
		$this->load->view('user/header',$data);
		$this->load->view('user/manage_sell');
		$this->load->view('user/footer');
	}
	
	
	
	public function search_sell(){
		$username = $this->username;
		$act=trim($this->input->post('act',TRUE));
		$page = $this->input->post('page',TRUE)?$this->input->post('page',TRUE):1;
		$page_size=4;
		$offset=($page-1)*$page_size;
		if ($act=='my_search'){
			$keywords=trim($this->input->post('keywords',TRUE));
			$sql="SELECT itemid,title,introduce,unit,amount,hits,thumb,totime,linkurl FROM wl_sell WHERE username = '{$username}' AND title like '%{$keywords}%' ORDER BY totime desc Limit {$offset},{$page_size}";
			$sql_1="SELECT COUNT(*) AS COUNTER FROM wl_sell WHERE username = '{$username}' AND title like '%{$keywords}%'";
			$query = $this->db->query($sql);
			$query_1 = $this->db->query($sql_1);
			$sell_list = $query->result_array();
			$count=$query_1->result_array();
			$count=$count[0]['COUNTER'];
		}elseif ($act=='type_search'){
			$type=trim($this->input->post('type',TRUE));
			if($type=='Pending Review')	{
				$status=1;
			}elseif($type=='Unapproved'){				
				$status=2;
			}elseif ($type=='Published'){
				$status=3;
			}elseif ($type=='Approved')	{
				$status=4;
			}	
			$sell_list=$this->comm->findAll("sell",array("username"=>$username,"status"=>$status),"totime desc","itemid,title,introduce,unit,amount,hits,thumb,totime,linkurl,username","{$offset},{$page_size}");
			$count=$this->comm->findCount("sell", array("username"=>$username,"status"=>$status));
		}		
		$total_page=ceil($count/$page_size);
		$str="";
		$str.="<div class='inbox2_right4'>";
		 if ($sell_list){
		 	$site = $this->config->item('site');
		 	foreach ($sell_list as $k=>$v){
			    $str.="<div class='inbox2_right4_1a'>";
			    $str.="<div class='inbox2_right41'>";
			   	$str.="<div class='inbox2_right3_1 inbox2_right3_11'><input name='C".$k."' type='checkbox' value='".$v['itemid']."' /></div>";
			    $str.="<div class='inbox2_right3_1 inbox2_right3_12  border_none'><img width='25' height='25'  src='".$site['image_domain'].$v['thumb']."' /></div>";
				$str.="<div class='buy_l_t border_none'><strong><a href='".main_url(site_url('content/index/'.$v['itemid'].'/'.$v['linkurl']))."'>".$v['title']."(hits:".$v['hits'].")</a></strong></div>";
				$amount=$v['amount']>0?$v['amount']."&nbsp;".$v['unit']:'N/A';
				$totime=$v['totime']?date('Y-m-d',$v['totime']):"2050-12-31";
				$str.="<div class='buy_l_s border_none'><strong>".$amount."</strong></div>";
				$str.="<div class='buy_l_s border_none'><strong>".$totime."</strong></div>";
				$str.="<div class='buy_l_ss  border_none'>";
				$str.="<a  title='EDIT' href='".site_url('user/sell/edit_sell/'.$v['itemid'])."'><img src='".base_url('skin_user/images/edit_01.jpg')."' /></a>";				
		  		$str.="<a title='DELETE' href='#' onclick=del_sell('".$v['itemid']."-') ><img src='".base_url('skin_user/images/inm_28.jpg')."' /></a>";		
				$str.="</div><div class='clear'></div></div>";
			    $str.="<div class='inbox2_right42a'>".mb_substr(strip_tags($v['introduce']),0,235,'utf-8')."......</div></div>";		                        
		  	}
		 }else {
		     $str.="<br/><br/><center>No Matching Results</center>";		       			
		}
		$str.="</div>";
		$str.="<div style='padding-top:5px;padding-bottom:5px;'>";
		$str.="<div class='black-red'><span class='disabled'>";
		if ($total_page>1){
			foreach(range(1,$total_page) as $v){
				if ($v==$page){
					$str.='&nbsp;&nbsp;<span class="current">'.$v.'</span>&nbsp;&nbsp;';
				}else{
					if ($act=='my_search'){
						$function="search(this.innerHTML)";
					}elseif ($act=='type_search'){
						$function="search_sells('{$type}',this.innerHTML)";
					}
					$str.='&nbsp;&nbsp;<span onclick='.$function." style='cursor:pointer'>".$v.'</span>&nbsp;&nbsp;';
				}
			}
		}
		$str.="</span></div>";
		$str.="</div>";
		$this->output->set_output($str);
	}
	
	function delimg(){
		$this->config->load('uploader_settings', TRUE);
		$img_rootpath = $this->config->item('img_rootpath','uploader_settings');
		$imageurl = $this->input->post("img");
		if($imageurl){
			if(stripos($imageurl,'upload/product_img/')!==false){
				if(file_exists($img_rootpath.$imageurl)){
					if(unlink($img_rootpath.$imageurl)){
						echo 1;
					}else{
						echo 0;
					}
				}else{
					echo 0;
					die();
				}
			}
		}else{
			echo 0;
			die();
		}
	}
	
	function move_image($thumb,$linkurl){
		$img_rootpath = $this->config->item('img_rootpath','uploader_settings');
		$img_path = $this->config->item('img_path','uploader_settings');
		$thumbpath = $img_rootpath.$img_path.$this->userid;
		$thumbext = substr($thumb,strrpos($thumb,"."));
		$newthumb = $img_path.$this->userid."/".$linkurl.$thumbext;

		if(!file_exists($thumbpath)){
			mkdir($thumbpath);
		}
		if(file_exists($img_rootpath.$thumb)){
			if(!file_exists($img_rootpath.$newthumb)){
				$rname = rename($img_rootpath.$thumb,$img_rootpath.$newthumb);
			}else{
				$newthumb = $img_path.$this->userid."/".$linkurl."_".md5($thumb).$thumbext;
				$rname = rename($img_rootpath.$thumb,$img_rootpath.$newthumb);
			}
		}
		if($rname){
			return $newthumb;
		}else{
			return FALSE;
		}
		
	}
	
	function manage_group(){
		$page = $this->uri->rsegment(3,0);
		$data['page'] = $page = intval($page);
		$data['page_size']=$page_size=5;
		$data['username']=$username = $this->username;
		$data['site'] = $site = $this->config->item('site');
		$data['title'] = "Products Group of ".$username." On ".$site['site_name'];
		$groups=$this->comm->findAll("type",array("userid"=>$this->userid),"listorder asc","","{$page},{$page_size}");
		if($groups){
			foreach ($groups as $k=>$v){
				$groups[$k]['itemcount']=$this->comm->findCount("sell",array("mycatid"=>$v['tid'],"username"=>$username));
			}
		}
		$data['groups']=$groups;	
		$data['groups_count']=$groups_count=$this->comm->findCount("type",array("userid"=>$this->userid));
		$data['total_page']=ceil($groups_count/$page_size);
		$this->load->library('pagination');
		$data['base_url']=$config['base_url'] = site_url("user/sell/".__FUNCTION__);
		$config['total_rows'] = $groups_count;
		$config['per_page'] = $page_size;
		$config['uri_segment'] = 4;
		$config['num_links'] = 5;
		$config['suffix'] = $this->config->item('url_suffix');
		$config['cur_tag_open'] = '<span class="current">';
		$config['cur_tag_close'] = '</span>';			
		$this->pagination->initialize($config);
		$data['pages'] = $pages = $this->pagination->create_links();
		$this->load->view('user/header',$data);
		$this->load->view('user/manage_group');
		$this->load->view('user/footer');
	}
	
	function add_group(){
		$tname = $this->input->post("tname",TRUE);
		$tid = $this->input->post("tid",TRUE);	
		$type = $this->input->post("type",TRUE);
		if(strlen($tname)>100){
			$tname = substr($tname,0,100);
		}
		if(empty($tname)){
			echo json_encode(array('code'=>0,"message"=>'Group name is null.'));
			die();
		}
		$findtype = $this->comm->find("type",array("tname"=>$tname,"userid"=>$this->userid));
		if($findtype){
			echo json_encode(array('code'=>0,"message"=>'this group has exsit.'));
		}else{
			if ($tid){
				$rs = $this->comm->update('type',array('tid'=>$tid,'userid'=>$this->userid),array('tname'=>$tname));
				$act='edit';
			}else{
				$rs = $this->comm->create("type",array("tname"=>$tname,"userid"=>$this->userid));
				$act='add';
			}
			if($rs){
				if($type == 'addsell'){
					echo json_encode(array('code'=>1,"tid"=>$rs,"tname"=>$tname));
				}else{
					echo json_encode(array('code'=>1,"message"=>$act.' successfully.'));				
				}
			}else{
				echo json_encode(array('code'=>0,"message"=>$act.' faild.'));
			}
		}
	}
	
 	function delete_group(){
		$username = $this->username;		
		$del_tid = $this->input->post('tid',TRUE);
		$del_tid=explode("-", $del_tid);
		array_pop($del_tid);		
		if (is_array($del_tid)){
			$c=0;
			 foreach ($del_tid as $v){
			 	if($this->comm->findCount("sell",array("mycatid"=>intval($v),"username"=>$this->username))){
			 		$rs="There are some products under this group,please delete the products first!";
			 		$total_count=$this->comm->findCount("type",array("userid"=>$this->userid));
			 		$list=array("msg"=>$rs,"total_count"=>$total_count);
			 		echo json_encode($list);
			 		exit;
			 	}
				$findgroup = $this->comm->find("type",array("tid"=>intval($v),"userid"=>$this->userid));				
				if ($findgroup){
					$delgroup = $this->comm->delete("type",array("tid"=>intval($v)));
					$c = $delgroup ? $c+1 : $c;
				}else{
					$rs="There's no this group(s)!";
					$total_count=$this->comm->findCount("type",array("userid"=>$this->userid));
					$list=array("msg"=>$rs,"total_count"=>$total_count);
					echo json_encode($list);
					exit;
				}
			}
			if ($c==count($del_tid)){
				$rs="Delete Successfully";
			}else{
				$rs="Delete Failed";
			} 
		}
		$total_count=$this->comm->findCount("type",array("userid"=>$this->userid));
		$list=array("msg"=>$rs,"total_count"=>$total_count);
		echo json_encode($list);				
	}
}
