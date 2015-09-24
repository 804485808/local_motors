<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class News extends CI_Controller {
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
		} elseif (!$rs=$this->comm->find('member',array("username"=>$this->username,"password"=>$this->password),'','userid,vmail,email')){
			redirect(site_url("reg_login/login_in"));
		} elseif (!$rs['vmail']){
			$data['email'] = $rs['email'];
			$str = $this->load->view('user/vmail_notice',$data,TRUE);
			echo $str;
			die();
		}
		$this->userid = $rs['userid'];
	}

		
	//新闻管理--新闻列表   0回收站 1未通过 2待审核 3已通过 4已过期
	public function manage_news(){
		$data['username']=$username = $this->username;
		$data['site'] = $site = $this->config->item('site');
		$data['title'] = "News Management Of ".$username." On ".$site['site_name'];
		$condition="username = '{$username}' AND status <>0";
		$findcatids= $this->comm->findAll('news',$condition,"","distinct(catid)");
		if ($findcatids){
			foreach ($findcatids as $v){
				$groups[] = $this->comm->find('category',array('catid'=>$v['catid']),"","catid,catname");
			}
		}else {
			$groups = array();
		}
		
		$data['groups'] = $groups;
		$page = $this->uri->rsegment(3,0);
		$data['page'] = $page = intval($page);
		$data['groupid']=0;
		$uri_segment = 4;
		$base_url = site_url("/user/news/manage_news/");
		$type = $this->uri->rsegment(3,'');
		
		if(preg_match("/^[a-zA-Z-_]{1,}$/isU",$type)){
			$page = $this->uri->rsegment(4,0);
			$data['page'] = $page = intval($page);
			$uri_segment = 5;
			$base_url = site_url("/user/news/manage_news/".$type."/");
			$data['type']=$type;
		}elseif (preg_match("/^[a-zA-Z]{1,}-[0-9]{1,}$/isU",$type)) {
			$catid = explode("-",$type);
			$data['groupid']=$catid = intval($catid[1]);
			$page = $this->uri->rsegment(4,0);
			$uri_segment = 5;
			if ($catid){
				$condition="catid = '{$catid}' AND username = '{$username}' AND status <>0";
			}else {
				$condition="username = '{$username}' AND status <>0";
			}
			
			$base_url = site_url("user/news/manage_news/".$type."/");
			$data['type']='';
		}else{
			$data['type']='';
		}		
		$data['news_list'] = $supply_list=$this->comm->findAll("news",$condition,"itemid desc","","{$page},5");		
		$data['check_pic'] = $check_pic = array(0=>'Recycle bin',1=>'check pending',2=>'Unapproved',3=>'Published',4=>'Expired');
		$data['total'] = $this->comm->findCount("news",array("username"=>$username));
		$data['total_count'] = $total_count = $this->comm->findCount("news",$condition);
		//0回收站 1未通过 2待审核 3已通过 4已过期
		$data['trash'] = $this->comm->findCount("news", array("username"=>$username,"status"=>0));
		$data['unapproved'] = $this->comm->findCount("news", array("username"=>$username,"status"=>1));//1未通过
		$data['pending_review'] = $this->comm->findCount("news", array("username"=>$username,"status"=>2));//2待审核
		$data['published'] = $this->comm->findCount("news", array("username"=>$username,"status"=>3));//3已通过
		$data['expired'] = $this->comm->findCount("news", array("username"=>$username,"status"=>4));//4已过期
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
		$this->load->view('user/manage_news');
		$this->load->view('user/footer');
	}
	
	public function search_news(){
		$username = $this->username;
		$act=trim($this->input->post('act',TRUE));
		$page = $this->input->post('page',TRUE)?$this->input->post('page',TRUE):1;
		$page_size=4;
		$offset=($page-1)*$page_size;
		if ($act=='my_search'){
			$keywords=trim($this->input->post('keywords',TRUE));
			$sql="SELECT * FROM wl_news WHERE username = '{$username}' AND title like '%{$keywords}%' ORDER BY totime desc Limit {$offset},{$page_size}";
			$sql_1="SELECT COUNT(*) AS COUNTER FROM wl_news WHERE username = '{$username}' AND title like '%{$keywords}%'";
			$query = $this->db->query($sql);
			$query_1 = $this->db->query($sql_1);
			$news_list = $query->result_array();
			$count=$query_1->result_array();
			$count=$count[0]['COUNTER'];
		}elseif ($act=='type_search'){
			$type=trim($this->input->post('type',TRUE));
			
			if($type=='Recycle bin')	{
				$status=5;
			}elseif($type=='Pending Review'){
				$status=1;
			}elseif($type=='Unapproved'){
				$status=2;
			}elseif ($type=='Published'){
				$status=3;
			}elseif ($type=='Expired')	{
				$status=4;
			}
			
			$news_list=$this->comm->findAll("news",array("username"=>$username,"status"=>$status),"totime desc","","{$offset},{$page_size}");
			$count=$this->comm->findCount("news", array("username"=>$username,"status"=>$status));
		}
		$total_page=ceil($count/$page_size);
		$str="";
		$str.="<div class='inbox2_right4'>";
		if ($news_list){
			$site = $this->config->item('site');
			foreach ($news_list as $k=>$v){
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
				$str.="<a  title='EDIT' href='".site_url('user/news/edit_news/'.$v['itemid'])."'><img src='".base_url('skin_user/images/edit_01.jpg')."' /></a>";
				$str.="<a title='DELETE' href='#' onclick=del_news('".$v['itemid']."-') ><img src='".base_url('skin_user/images/inm_28.jpg')."' /></a>";
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
						$function="search_news('{$type}',this.innerHTML)";
					}
					$str.='&nbsp;&nbsp;<span onclick='.$function." style='cursor:pointer'>".$v.'</span>&nbsp;&nbsp;';
				}
			}
		}
		$str.="</span></div>";
		$str.="</div>";
		$this->output->set_output($str);
	}
	
	//发布新闻    0回收站 1未通过 2待审核 3已通过 4已过期
	public function post_news($itemid = 0){
		$data['site'] = $site = $this->config->item('site');
		$finduser = $this->comm->find('member',array("username"=>$this->username));
		if(!$finduser['company']){
			redirect(site_url("user/my_biz/show_info/need"));
			die();
		}
		$data['username']=$username = $this->username;
		$data['title'] = "Post News Of ".$username." On ".$site['site_name'];	
			
		$news_group = $this->comm->findAll("category","parentid = 0 AND item  > 0","letter asc");
		$data['news_group'] = $news_group;
		
		if($itemid){
			$areaname = $this->comm->findAll("area");
			$data['areaname'] = $areaname;
			$username = $this->username;
			$news = $this->comm->linker()->find("news",array("itemid"=>$itemid,"username"=>$username));
			if(!$news){
				show_error("Edit Error");
				die();
			}
			$thiscat = $this->comm->find("category",array("catid"=>$news['catid']));
			$news['news_data']['content'] = str_replace(array("<br>","<br/>"),"\n",$news['news_data']['content']);
			$data['news'] = $news;
			$this->load->view('user/header',$data);
			$this->load->view('user/edit_news');
			$this->load->view('user/footer');
		}else{
			$this->load->view('user/header',$data);
			$this->load->view('user/post_news');
			$this->load->view('user/footer');
		}
	}

	function edit_news(){
		$itemid = $this->uri->rsegment(3,0);
		$itemid = intval($itemid);
		if($itemid){
			$this->post_news($itemid);
		}else{
			show_error("Not found News ");
		}
	}
	
	function delete_news(){
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
				$findnews = $this->comm->find("news",array("itemid"=>$v,"username"=>$username));
				if ($findnews){
					$delnews = $this->comm->delete("news",array("itemid"=>$v));
					if($delnews){
						$this->comm->delete("news_data",array("itemid"=>$v));
						$c++;
					}
				}else{
					$rs="There's no this news!";
				}
			}
			if ($c==count($del_itemid)){
				$rs="Delete Success";
			}else{
				$rs="Delete Failed";
			}
		}
		$total_count=$this->comm->findCount("news",array("username"=>$username));
		$list=array("msg"=>$rs,"total_count"=>$total_count);
		$this->output->set_content_type('application/json')->set_output(json_encode($list));
	}
	
	function save_news(){
		$site = $this->config->item('site');
		$this->config->load('uploader_settings', TRUE);
		$this->load->helper("getstr");
		$this->load->helper("checkhtml");
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('title', 'News Title', 'required|max_length[255]');
		$this->form_validation->set_rules('content', 'News Detail', 'required');
		//$this->form_validation->set_rules('catid', 'Category', 'required|numeric');
		//$this->form_validation->set_rules('path', 'Photo', 'required');
		$this->form_validation->set_rules('tag', 'Tag', 'required|max_length[100]');
	
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
			$introduce = $this->input->post("introduce") ? $this->input->post("introduce") : getstr($content,255,0,0,-1);
			$content = checkhtml($content);
			$catid = $this->input->post("catid");
			$catid = intval($catid);
			$thumb = $this->input->post("path",TRUE);
			$thumb = getstr($thumb,255,0,0,-1);
			$tag = $this->input->post("tag",TRUE);
			$tag = getstr($tag,255,0,0,-1);
			
			$author = $this->input->post("author") ? $this->input->post("author") : $username;
			$author = getstr($author,50,0,0,-1);
			$editor = $this->input->post("editor") ? $this->input->post("editor") : $username;
			$editor = getstr($editor,30,0,0,-1);
			$source = $this->input->post("source") ? $this->input->post("source") : $site['site_name'];
			$source = getstr($source,30,0,0,-1);
			$fromurl = $this->input->post("fromurl") ? $this->input->post("fromurl") : $site['main_domain'];
			$fromurl = getstr($fromurl,255,0,0,-1);
			$ip = $this->input->ip_address();
			$areaid = intval($areaid);
			if($fromurl && stripos($fromurl,$site['site_url']) ===false){
				$islink = 1;
			}
			$totime=strtotime("30 years");
			
			if($itemid){
				$findnews = $this->comm->find("news",array("itemid"=>$itemid,"username"=>$username));
				if(!$findnews){
					$json = array("code"=>0,"message"=>'Update error : You don\'t have operation permissions or the news is not exsit');
					echo json_encode($json);
					die();
				}
				if ($catid){
					$findcate = $this->comm->find("category",array("catid"=>$catid,"parentid"=>0));
					if(!$findcate){
						$json = array("code"=>0,"message"=>'Please choose the Category');
						echo json_encode($json);
						die();
					}else {
						$catid = 0;
					}
				}
				
				$updaterecord = array(
						'title'=>$title,
						'catid'=>$catid,
						'tag'=>$tag,
						'areaid'=>$areaid,
						'author'=>$author,
						'editor'=>$editor,
						'source'=>$source,
						'fromurl'=>$fromurl,
						'username'=>$username,
						'edittime'=>$timestamp,
						'introduce'=>$introduce,
						'totime'=>$totime,
						'linkurl'=>$linkurl,
						'ip'=>$ip,
						'news_data'=>array(
								'content'=>$content,
						),
				);
				$this->comm->linker()->update("news",array("itemid"=>$itemid),$updaterecord);
				$newthumb = $this->move_image($thumb,$linkurl);
				if($newthumb!==false){
					$this->db->update("news",array("thumb"=>$newthumb),array("itemid"=>$itemid));
				}
	
				$json = array("code"=>1,'message'=>"update success",'href'=>site_url("user/news/manage_news"));
				echo json_encode($json);
				die();
			}else{
				$companyinfo = $this->comm->linker()->find("member",array("username"=>$username));
				$newrecord = array(
						'title'=>$title,
						'catid'=>$catid,
						'tag'=>$tag,
						'areaid'=>$areaid,
						'author'=>$author,
						'editor'=>$editor,
						'source'=>$source,
						'fromurl'=>$fromurl,
						'addtime'=>$timestamp,
						'username'=>$username,
						"edittime"=>$timestamp,
						'introduce'=>$introduce,
						'totime'=>$totime,
						'linkurl'=>$linkurl,
						'status'=>2,
						'ip'=>$ip,
						'news_data'=>array(
								'content'=>$content,
						),
				);
				
				
				$cmd5 = md5($title.$companyinfo['company']);
				$findnews = $this->comm->find("check_news",array("cmd5"=>$cmd5));
				if(!$findnews){
					$itemid = $this->comm->linker()->create("news",$newrecord);
					if($itemid){
						$newthumb = $this->move_image($thumb,$linkurl);
						if($newthumb){
							$this->db->update("news",array("thumb"=>$newthumb),array("itemid"=>$itemid));
						}
						$this->db->insert("check_news",array("cmd5"=>$cmd5,"nid"=>$itemid));
						$json = array("code"=>1,'message'=>"post successfully",'href'=>site_url("user/news/manage_news"));
						echo json_encode($json);
					}else{
						$json = array("code"=>0,'message'=>'post error,please retry');
						echo json_encode($json);
					}
				}else{
					$json = array("code"=>0,'message'=>'The News has exsit');
					echo json_encode($json);
				}
			}	
		}
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
}