<?php if(!defined('BASEPATH')) exit('NO direct script access allowed');
class Page_style extends MY_Controller{
	function __construct(){
		parent::__construct();
		$this->load->library('Sphinxclient','','sphinx');
		$this->sphinx->SetServer ('127.0.0.1', 9312);
		$this->sphinx->SetConnectTimeout(1);
		$this->sphinx->SetArrayResult(true);
	}
	
	function style_add(){
		if ($this->input->post()){
			extract($this->input->post());
			$title = trim($title);
			$skin = trim($skin);
			if (!$title || !$skin){
				$data['msg'] = "风格名称和目录不为空!";
				$this->load->view('public/success',$data);
			}else {
				$findstyle=$this->comm->findCount('style',array('skin'=>$skin));
				if (!$findstyle){
					$rs = $this->comm->create('style',array('title'=>$title,'skin'=>$skin,'edittime'=>time(),'editip'=>$_SERVER["REMOTE_ADDR"],'username'=>$this->username));
					if ($rs){
						$data['msg'] = "添加成功!";
					}else {
						$data['msg'] = "添加失败!";
					}
				}else {
					$data['msg'] = "风格目录不能重复!";
				}
				
				$this->load->view('public/success',$data);
			}
		}else {
			$this->load->view('my_menu/page_style/style_add');
		}
		
	}
	
	function style_edit(){
		
		$id = $this->uri->rsegment(3,0);
		if ($id){
			$data['findstyle'] = $findstyle = $this->comm->find('style',array('id'=>$id));
			if ($findstyle){
				if ($this->input->post()){
					extract($this->input->post());
					$title = trim($title);
					$skin = trim($skin);
					if (!$title || !$skin){
						$data['msg'] = "风格名称和目录不为空!";
						$this->load->view('public/success',$data);
					}else {
						if ($skin !== $findstyle['skin']){
							$checkstyle=$this->comm->findCount('style',array('skin'=>$skin));
							if ($checkstyle){
								$data['msg'] = "风格目录不能重复!";
							}else {
								$rs = $this->comm->update('style',array('id'=>$id),array('title'=>$title,'skin'=>$skin,'edittime'=>time(),'editip'=>$_SERVER["REMOTE_ADDR"],'username'=>$this->username));
								if ($rs){
									$data['msg'] = "修改成功!";
								}else {
									$data['msg'] = "修改失败!";
								}
							}
						}else {
							$rs = $this->comm->update('style',array('id'=>$id),array('title'=>$title,'skin'=>$skin,'edittime'=>time(),'editip'=>$_SERVER["REMOTE_ADDR"],'username'=>$this->username));
							if ($rs){
								$data['msg'] = "修改成功!";
							}else {
								$data['msg'] = "修改失败!";
							}
						}
						
						$this->load->view('public/success',$data);
					}
				}else {
					$this->load->view('my_menu/page_style/style_edit',$data);
				}
			}
			
		}else {
			$data['msg'] = "修改失败!";
			$this->load->view('public/success',$data);
		}
	}
	function style_select(){
		$id = $this->uri->rsegment(3,0);
		if ($id){
			$findstyle = $this->comm->find('style',array('id'=>$id));
			if ($findstyle){
				if($this->comm->update('style',array('is_select'=>1),array('is_select'=>0))){
					$rs = $this->comm->update('style',array('id'=>$id),array('is_select'=>1));
					if ($rs){
						$msg = "风格选择成功!";
					}
				}
			}else {
				$msg = "风格选择失败!";
			}
		}else {
			$msg = "风格选择失败!";
		}
		$data['msg'] = $msg;
		$this->load->view('public/success',$data);
	}
	function style_setting(){
		$page = $this->uri->rsegment(3,0);
		$uri_segment = 4;
		$base_url = site_url("my_menu/page_style/".__FUNCTION__."/");
		if(preg_match("/^[a-zA-Z]{1,}-[0-9]{1,}$/isU",$page)){
			$page = $this->uri->rsegment(4,0);
			$uri_segment = 5;
			$base_url = site_url("my_menu/page_style/".__FUNCTION__."/".$this->uri->rsegment(3,'')."/");
		}
		$page = intval($page);
		$data['page_size']=$page_size=5;
		$findstyles = $this->comm->findAll("style","","id desc","","{$page},{$page_size}");
		$data['findstyles'] = $findstyles;
		$data['style_count']=$style_count=$this->comm->findCount("style");
		$data['total_page']=ceil($style_count/$page_size);
		$this->load->library('pagination');
		$data['base_url']=$config['base_url'] = $base_url;
		$config['total_rows'] = $style_count;
		$config['per_page'] = $page_size;
		$config['uri_segment'] = $uri_segment;
		$config['num_links'] = 5;
		$config['suffix'] = $this->config->item('url_suffix');
		$config['cur_tag_open'] = '<span class="current">';
		$config['cur_tag_close'] = '</span>';
			
		$this->pagination->initialize($config);
		$data['pages'] = $pages = $this->pagination->create_links();
		$this->load->view("my_menu/page_style/style_setting",$data);
	}
	
	function style_del(){
		//echo "wait....目前只做删除表内的数据,并未删除文件夹和文件";
		if($this->input->post()){
			$post_tmp = $this->input->post();
			$post_ids = $post_tmp['id'];
			foreach ($post_ids as $v){
 				$findstyle = $this->comm->find('style',array('id'=>$v));
 				if ($findstyle){
 					$res = $this->comm->delete('style',array('id'=>$findstyle['id']));
 					if ($res){
 						$data['msg']="删除成功(目前只做删除表内的数据,并未删除文件夹和文件,请人工删除)";
 					}
 				}
 				
 				//unlink(); //删除图片
				//$rs = $this->del_dir_file(); //删除目录
//  				if ($rs){
//  					$res = $this->comm->delete('style',array('id'=>$id));
//  					if ($res){
//  						$data['msg']="删除成功";
//  					}
//  				}					
			}
			
		}else {
			$id = $this->uri->rsegment(3,0);
			if ($id){
				$findstyle = $this->comm->find('style',array('id'=>$id));
				if ($findstyle){
					$res = $this->comm->delete('style',array('id'=>$findstyle['id']));
					if ($res){
						$data['msg']="删除成功(目前只做删除表内的数据,并未删除文件夹和文件,请人工删除)";
					}
				}
				//unlink(); //删除图片
				//$rs = $this->del_dir_file(); //删除目录
				
// 				if ($rs){
//					$res = $this->comm->delete('style',array('id'=>$id));
// 					if ($res){
// 						$data['msg']="删除成功";
// 					}
// 				}
				//$this->load->view('public/success',$data);
			}else {
				$data['msg'] = "删除失败!";
			}
		}	
		$this->load->view('public/success',$data);
	}
	//循环删除目录和文件函数
	function del_dir_file($dir_name)
	{
		if ($handle = opendir("$dir_name")) {
			while (false !== ( $item = readdir($handle))) {
				if ( $item != "." && $item != "..") {
					if (is_dir("$dir_name/$item")) {
						$this->del_dir_file("$dir_name/$item");
					}
				}
			}
			closedir($handle);
			if(rmdir($dir_name)){
				return $dir_name;
			}
		}
	}
	function page_setting(){
		$data['sell_fields'] = $sell_fields = array('title'=>'1标题','thumb'=>'1产品图片','company'=>'0公司','minprice'=>'1最低价格','maxprice'=>'0最高价格','minamount'=>'0最小供应量','amount'=>'0供应总量','addtime'=>'0发布时间','introduce'=>'0产品介绍','attr'=>'0产品属性(SEO页)','areaname'=>'0地区');
		$data['corps_fields'] = $corps_fields = array('company'=>'1公司','mode'=>'1经营模式','address'=>'1公司地址','telephone'=>'1公司电话','is_cate'=>'0公司类别','thumb'=>'0公司图片','markets'=>'0主要市场','capital'=>'0注册资本','size'=>'0员工人数','regyear'=>'0注册年份','regcity'=>'0注册城市','business'=>'0主要经营范围','volume'=>'0年销售额','export'=>'0出口百分比','fax'=>'0传真','mail'=>'0公司Email','zipcode'=>'0邮编','homepage'=>'0公司主页','hits'=>'0公司访问量','areaname'=>'1地区');
		$data['corp_info_fields'] = $corp_info_fields = array('company'=>'1公司','mode'=>'1经营模式','address'=>'1公司地址','telephone'=>'1公司电话','minprice'=>'1最低价格','maxprice'=>'0最高价格','minamount'=>'0最小供应量','amount'=>'0供应总量','thumb'=>'0公司图片','markets'=>'0主要市场','capital'=>'0注册资本','size'=>'0员工人数','regyear'=>'0注册年份','regcity'=>'0注册城市','business'=>'0主要经营范围','volume'=>'0年销售额','export'=>'0出口百分比','fax'=>'0传真','mail'=>'0公司Email','zipcode'=>'0邮编','homepage'=>'0公司主页','hits'=>'0公司访问量','areaname'=>'1地区');
		$data['corp_main_fields'] = $corp_main_fields = array('company'=>'1公司','mode'=>'1经营模式','address'=>'1公司地址','telephone'=>'1公司电话','markets'=>'0主要市场','capital'=>'0注册资本','size'=>'0员工人数','regyear'=>'0注册年份','regcity'=>'0注册城市','business'=>'0主要经营范围','volume'=>'0年销售额','export'=>'0出口百分比','fax'=>'0传真','mail'=>'0公司Email','zipcode'=>'0邮编','homepage'=>'0公司主页','hits'=>'0公司访问量','areaname'=>'1地区');
		//首页
		//头部长尾词
		$data['main_hot_search'] =$main_hot_search= $this->comm->find("page_set",array('mode'=>'main_hot_search','in_page'=>'main'));
		if ($main_hot_search['num']){
			$data['mhs_num'] = array_pop(explode(",", $main_hot_search['num']));
		}
		//类别列表
		$data['main_cate_list'] =$main_cate_list= $this->comm->find("page_set",array('mode'=>'main_cate_list','in_page'=>'main'));
		if ($main_cate_list['num']){
			$limit = explode("|", $main_cate_list['num']);
			$data['mcl_num1'] = array_pop(explode(",",$limit[0]));
			$data['mcl_num2'] = array_pop(explode(",",$limit[1]));
		}
		if ($main_cate_list['sort']){
			$sort = explode("|", $main_cate_list['sort']);
			$data['mcl_sort1'] = array_pop(explode(",",$sort[0]));
			$data['mcl_sort2'] = array_pop(explode(",",$sort[1]));
		}
		
		//最新产品列表
		$main_new_sells = $this->comm->find("page_set",array('mode'=>'main_new_sells','in_page'=>'main'));
		if ($main_new_sells['fields']){
			$data['mns_fields'] = $mns_fields = explode(',', $main_new_sells['fields']);
			$mns_fields_tmp1 = $sell_fields;
			foreach ($mns_fields as $k=>$v){
				foreach ($mns_fields_tmp1 as $kk=>$vv){
					if ($v==$kk){
						$mns_fields_tmp[$kk] = $vv;
					}
					unset($mns_fields_tmp1[$v]);
				}
			}
			$data['mns_fields_tmp'] = $mns_fields_tmp;
			$data['mns_fields_tmp1'] = $mns_fields_tmp1;
		}
		if ($main_new_sells['num']){
			$data['mns_num'] = array_pop(explode(",", $main_new_sells['num']));
		}
		$data['main_new_sells'] = $main_new_sells;
		//最热门产品列表
		$main_hot_sells = $this->comm->find("page_set",array('mode'=>'main_hot_sells','in_page'=>'main'));
		if ($main_hot_sells['fields']){
			$data['mhots_fields'] = $mhots_fields = explode(',', $main_hot_sells['fields']);
			$mhots_fields_tmp1 = $sell_fields;
			foreach ($mhots_fields as $k=>$v){
				foreach ($mhots_fields_tmp1 as $kk=>$vv){
					if ($v==$kk){
						$mhots_fields_tmp[$kk] = $vv;
					}
					unset($mhots_fields_tmp1[$v]);
				}
			}
			$data['mhots_fields_tmp'] = $mhots_fields_tmp;
			$data['mhots_fields_tmp1'] = $mhots_fields_tmp1;
		}
		if ($main_hot_sells['num']){
			$data['mhots_num'] = array_pop(explode(",", $main_hot_sells['num']));
		}
		$data['main_hot_sells'] = $main_hot_sells;
		//最新公司列表
		$main_new_corps = $this->comm->find("page_set",array('mode'=>'main_new_corps','in_page'=>'main'));
		if ($main_new_corps['fields']){
			$data['mnc_fields'] = $mnc_fields = explode(',', $main_new_corps['fields']);
			$mnc_fields_tmp1 = $corps_fields;
			foreach ($mnc_fields as $k=>$v){
				foreach ($mnc_fields_tmp1 as $kk=>$vv){
					if ($v==$kk){
						$mnc_fields_tmp[$kk] = $vv;
					}
					unset($mnc_fields_tmp1[$v]);
				}
			}
			$data['mnc_fields_tmp'] = $mnc_fields_tmp;
			$data['mnc_fields_tmp1'] = $mnc_fields_tmp1;
		}
		if ($main_new_corps['num']){
			$data['mnc_num'] = array_pop(explode(",", $main_new_corps['num']));
		}
		$data['main_new_corps'] = $main_new_corps;
		
		//类别主页配置
		//头部长尾词
		$data['cate_main_hot_search'] =$cate_main_hot_search= $this->comm->find("page_set",array('mode'=>'cate_main_hot_search','in_page'=>'cate_main'));
		if ($cate_main_hot_search['num']){
			$data['catemhs_num'] = array_pop(explode(",", $cate_main_hot_search['num']));
		}
		//类别列表
		$data['cate_main_cate_list'] =$cate_main_cate_list= $this->comm->find("page_set",array('mode'=>'cate_main_cate_list','in_page'=>'cate_main'));
		if ($cate_main_cate_list['num']){
			$limit = explode("|", $cate_main_cate_list['num']);
			$data['cmcl_num1'] = array_pop(explode(",",$limit[0]));
			$data['cmcl_num2'] = array_pop(explode(",",$limit[1]));
		}
		if ($cate_main_cate_list['sort']){
			$sort = explode("|", $cate_main_cate_list['sort']);
			$data['cmcl_sort1'] = array_pop(explode(",",$sort[0]));
			$data['cmcl_sort2'] = array_pop(explode(",",$sort[1]));
		}
		//最新产品列表
		$cate_main_new_sells = $this->comm->find("page_set",array('mode'=>'cate_main_new_sells','in_page'=>'cate_main'));
		if ($cate_main_new_sells['fields']){
			$data['catemns_fields'] = $catemns_fields = explode(',', $cate_main_new_sells['fields']);
			$catemns_fields_tmp1 = $sell_fields;
			foreach ($catemns_fields as $k=>$v){
				foreach ($catemns_fields_tmp1 as $kk=>$vv){
					if ($v==$kk){
						$catemns_fields_tmp[$kk] = $vv;
					}
					unset($catemns_fields_tmp1[$v]);
				}
			}
			$data['catemns_fields_tmp'] = $catemns_fields_tmp;
			$data['catemns_fields_tmp1'] = $catemns_fields_tmp1;
		}
		if ($cate_main_new_sells['num']){
			$data['catemns_num'] = array_pop(explode(",", $cate_main_new_sells['num']));
		}
		//最新公司列表
		$cate_main_new_corps = $this->comm->find("page_set",array('mode'=>'cate_main_new_corps','in_page'=>'cate_main'));
		if ($cate_main_new_corps['fields']){
			$data['catemnc_fields'] = explode(',', $cate_main_new_corps['fields']);
		}
		if ($cate_main_new_corps['fields']){
			$data['catemnc_fields'] = $catemnc_fields = explode(',', $cate_main_new_corps['fields']);
			$catemnc_fields_tmp1 = $corps_fields;
			foreach ($catemnc_fields as $k=>$v){
				foreach ($catemnc_fields_tmp1 as $kk=>$vv){
					if ($v==$kk){
						$catemnc_fields_tmp[$kk] = $vv;
					}
					unset($catemnc_fields_tmp1[$v]);
				}
			}
			$data['catemnc_fields_tmp'] = $catemnc_fields_tmp;
			$data['catemnc_fields_tmp1'] = $catemnc_fields_tmp1;
		}
		if ($cate_main_new_corps['num']){
			$data['catemnc_num'] = array_pop(explode(",", $cate_main_new_corps['num']));
		}
		$data['cate_main_new_corps'] = $cate_main_new_corps;
		//尾部长尾词
		$data['cate_main_other_search'] =$cate_main_other_search= $this->comm->find("page_set",array('mode'=>'cate_main_other_search','in_page'=>'cate_main'));
		if ($cate_main_other_search['num']){
			$data['catemos_num'] = array_pop(explode(",", $cate_main_other_search['num']));
		}
		
		//类别列表页配置
		//头部长尾词
		$data['cate_hot_search'] =$cate_hot_search= $this->comm->find("page_set",array('mode'=>'cate_hot_search','in_page'=>'cate_list'));
		if ($cate_hot_search['num']){
			$data['chs_num'] = array_pop(explode(",", $cate_hot_search['num']));
		}
		//产品类别
		$data['cates_list']=$cates_list = $this->comm->find("page_set",array('mode'=>'cates_list','in_page'=>'cate_list'));
		if ($cates_list['num']){
			$data['cl_num'] = array_pop(explode(",", $cates_list['num']));;
		}
		//产品属性列表
		$data['cate_attr_list']=$cate_attr_list = $this->comm->find("page_set",array('mode'=>'cate_attr_list','in_page'=>'cate_list'));
		if ($cate_attr_list['num']){
			$data['cal_num'] = array_pop(explode(",", $cate_attr_list['num']));;
		}
		//产品分页列表
		$cate_sell_list = $this->comm->find("page_set",array('mode'=>'cate_sell_list','in_page'=>'cate_list'));
		if ($cate_sell_list['fields']){
			$data['csl_fields'] = explode(',', $cate_sell_list['fields']);
		}
		if ($cate_sell_list['fields']){
			$data['csl_fields'] = $csl_fields = explode(',', $cate_sell_list['fields']);
			$csl_fields_tmp1 = $sell_fields;
			foreach ($csl_fields as $k=>$v){
				foreach ($csl_fields_tmp1 as $kk=>$vv){
					if ($v==$kk){
						$csl_fields_tmp[$kk] = $vv;
					}
					unset($csl_fields_tmp1[$v]);
				}
			}
			$data['csl_fields_tmp'] = $csl_fields_tmp;
			$data['csl_fields_tmp1'] = $csl_fields_tmp1;
		}
		if ($cate_sell_list['num']){
			$data['csl_num'] = array_pop(explode(",", $cate_sell_list['num']));
		}
		$data['cate_sell_list'] = $cate_sell_list;
		//相关产品列表
		$cate_list_relate_sells = $this->comm->find("page_set",array('mode'=>'cate_list_relate_sells','in_page'=>'cate_list'));
		if ($cate_list_relate_sells['fields']){
			$data['catelrs_fields'] = explode(',', $cate_list_relate_sells['fields']);
		}
		if ($cate_list_relate_sells['fields']){
			$data['catelrs_fields'] = $catelrs_fields = explode(',', $cate_list_relate_sells['fields']);
			$catelrs_fields_tmp1 = $sell_fields;
			foreach ($catelrs_fields as $k=>$v){
				foreach ($catelrs_fields_tmp1 as $kk=>$vv){
					if ($v==$kk){
						$catelrs_fields_tmp[$kk] = $vv;
					}
					unset($catelrs_fields_tmp1[$v]);
				}
			}
			$data['catelrs_fields_tmp'] = $catelrs_fields_tmp;
			$data['catelrs_fields_tmp1'] = $catelrs_fields_tmp1;
		}
		if ($cate_list_relate_sells['num']){
			$data['catelrs_num'] = array_pop(explode(",", $cate_list_relate_sells['num']));
		}
		$data['cate_list_relate_sells'] = $cate_list_relate_sells;
		//尾部长尾词
		$data['cate_other_search'] =$cate_other_search= $this->comm->find("page_set",array('mode'=>'cate_other_search','in_page'=>'cate_list'));
		if ($cate_other_search['num']){
			$data['cateos_num'] = array_pop(explode(",", $cate_other_search['num']));
		}
		
		//SEO页配置
		//头部长尾词
		$data['seo_hot_search'] =$seo_hot_search= $this->comm->find("page_set",array('mode'=>'seo_hot_search','in_page'=>'seo_sell'));
		if ($seo_hot_search['num']){
			$data['shs_num'] = array_pop(explode(",", $seo_hot_search['num']));
		}
		//产品类别
		$data['seo_cate_list']=$seo_cate_list = $this->comm->find("page_set",array('mode'=>'seo_cate_list','in_page'=>'seo_sell'));
		if ($seo_cate_list['num']){
			$data['scl_num'] = array_pop(explode(",", $seo_cate_list['num']));;
		}
		//产品属性列表
		$data['seo_attr_list']=$seo_attr_list = $this->comm->find("page_set",array('mode'=>'seo_attr_list','in_page'=>'seo_sell'));
		if ($seo_attr_list['num']){
			$data['sal_num'] = array_pop(explode(",", $seo_attr_list['num']));;
		}
		//产品分页列表
		$seo_sell_list = $this->comm->find("page_set",array('mode'=>'seo_sell_list','in_page'=>'seo_sell'));
		if ($seo_sell_list['fields']){
			$data['ssl_fields'] = explode(',', $seo_sell_list['fields']);
		}
		if ($seo_sell_list['fields']){
			$data['ssl_fields'] = $ssl_fields = explode(',', $seo_sell_list['fields']);
			$ssl_fields_tmp1 = $sell_fields;
			foreach ($ssl_fields as $k=>$v){
				foreach ($ssl_fields_tmp1 as $kk=>$vv){
					if ($v==$kk){
						$ssl_fields_tmp[$kk] = $vv;
					}
					unset($ssl_fields_tmp1[$v]);
				}
			}
			$data['ssl_fields_tmp'] = $ssl_fields_tmp;
			$data['ssl_fields_tmp1'] = $ssl_fields_tmp1;
		}
		if ($seo_sell_list['num']){
			$data['ssl_num'] = array_pop(explode(",", $seo_sell_list['num']));
		}
		$data['seo_sell_list'] = $seo_sell_list;
		//尾部长尾词
		$data['seo_other_search'] =$seo_other_search= $this->comm->find("page_set",array('mode'=>'seo_other_search','in_page'=>'seo_sell'));
		if ($seo_other_search['num']){
			$data['sos_num'] = array_pop(explode(",", $seo_other_search['num']));
		}

		//产品详细页配置
		//头部长尾词
		$data['hot_search'] =$hot_search= $this->comm->find("page_set",array('mode'=>'hot_search','in_page'=>'sell_detail'));
		if ($hot_search['num']){
			$data['hs_num'] = array_pop(explode(",", $hot_search['num']));
		}
		//公司其他产品列表
		$com_other_sells = $this->comm->find("page_set",array('mode'=>'com_other_sells','in_page'=>'sell_detail'));
		if ($com_other_sells['conditions']){
			$data['cos_conditions'] = explode(',', $com_other_sells['conditions']);
		}
		if ($com_other_sells['fields']){
			$data['cos_fields'] = $cos_fields = explode(',', $com_other_sells['fields']);
			$cos_fields_tmp1 = $sell_fields;
			foreach ($cos_fields as $k=>$v){
				foreach ($cos_fields_tmp1 as $kk=>$vv){
					if ($v==$kk){
						$cos_fields_tmp[$kk] = $vv;
					}
					unset($cos_fields_tmp1[$v]);
				}
			}
			$data['cos_fields_tmp'] = $cos_fields_tmp;
			$data['cos_fields_tmp1'] = $cos_fields_tmp1;
		}
		if ($com_other_sells['num']){
			$data['cos_num'] = array_pop(explode(",", $com_other_sells['num']));
		}
		$data['com_other_sells'] = $com_other_sells;
		//产品对比 VS
		$pros_vs = $this->comm->find("page_set",array('mode'=>'pros_vs','in_page'=>'sell_detail'));
		if ($pros_vs['fields']){
			$data['pv_fields'] = explode(',', $pros_vs['fields']);
		}
		if ($pros_vs['num']){
			$limit = explode("|", $pros_vs['num']);
			$data['pv_num1'] = array_pop(explode(",",$limit[0]));
			$data['pv_num2'] = array_pop(explode(",",$limit[1]));
		}
		$data['pros_vs'] = $pros_vs;
		//产品简介配置
		$com_intro = $this->comm->find("page_set",array('mode'=>'com_intro','in_page'=>'sell_detail'));
		if ($com_intro['fields']){
			$data['cominfo_fields'] = $cominfo_fields = explode(',', $com_intro['fields']);
			$cominfo_fields_tmp1 = $corp_info_fields;
			foreach ($cominfo_fields as $k=>$v){
				foreach ($cominfo_fields_tmp1 as $kk=>$vv){
					if ($v==$kk){
						$cominfo_fields_tmp[$kk] = $vv;
					}
					unset($cominfo_fields_tmp1[$v]);
				}
			}
			$data['cominfo_fields_tmp'] = $cominfo_fields_tmp;
			$data['cominfo_fields_tmp1'] = $cominfo_fields_tmp1;
		}
		//公司简介
		$com_intro_right = $this->comm->find("page_set",array('mode'=>'com_intro_right','in_page'=>'sell_detail'));
		if ($com_intro_right['fields']){
			$data['cominfo_r_fields'] = $cominfo_r_fields = explode(',', $com_intro_right['fields']);
			$cominfo_r_fields_tmp1 = $corp_main_fields;
			foreach ($cominfo_r_fields as $k=>$v){
				foreach ($cominfo_r_fields_tmp1 as $kk=>$vv){
					if ($v==$kk){
						$cominfo_r_fields_tmp[$kk] = $vv;
					}
					unset($cominfo_r_fields_tmp1[$v]);
				}
			}
			$data['cominfo_r_fields_tmp'] = $cominfo_r_fields_tmp;
			$data['cominfo_r_fields_tmp1'] = $cominfo_r_fields_tmp1;
		}
		//尾部长尾词
		$data['sell_detail_other_search'] =$sell_detail_other_search= $this->comm->find("page_set",array('mode'=>'sell_detail_other_search','in_page'=>'sell_detail'));
		if ($sell_detail_other_search['num']){
			$data['sdos_num'] = array_pop(explode(",", $sell_detail_other_search['num']));
		}
		
		//公司页配置
		$data['com_main_hot_search'] =$com_main_hot_search= $this->comm->find("page_set",array('mode'=>'com_main_hot_search','in_page'=>'com_main'));
		if ($com_main_hot_search['num']){
			$data['commhs_num'] = array_pop(explode(",", $com_main_hot_search['num']));
		}
		//公司产品分页列表
		$com_main_sell_list = $this->comm->find("page_set",array('mode'=>'com_main_sell_list','in_page'=>'com_main'));
		if ($com_main_sell_list['conditions']){
			$data['cms_conditions'] = explode(',', $com_main_sell_list['conditions']);
		}
		if ($com_main_sell_list['fields']){
			$data['cms_fields'] = $cms_fields = explode(',', $com_main_sell_list['fields']);
			$cms_fields_tmp1 = $sell_fields;
			foreach ($cms_fields as $k=>$v){
				foreach ($cms_fields_tmp1 as $kk=>$vv){
					if ($v==$kk){
						$cms_fields_tmp[$kk] = $vv;
					}
					unset($cms_fields_tmp1[$v]);
				}
			}
			$data['cms_fields_tmp'] = $cms_fields_tmp;
			$data['cms_fields_tmp1'] = $cms_fields_tmp1;
		}
		if ($com_main_sell_list['num']){
			$data['cms_num'] = array_pop(explode(",", $com_main_sell_list['num']));
		}
		$data['com_main_sell_list'] = $com_main_sell_list;
		//公司最新产品列表
		$com_main_new_sells = $this->comm->find("page_set",array('mode'=>'com_main_new_sells','in_page'=>'com_main'));
		if ($com_main_new_sells['conditions']){
			$data['cmns_conditions'] = explode(',', $com_main_new_sells['conditions']);
		}
		if ($com_main_new_sells['fields']){
			$data['cmns_fields'] = $cmns_fields = explode(',', $com_main_new_sells['fields']);
			$cmns_fields_tmp1 = $sell_fields;
			foreach ($cmns_fields as $k=>$v){
				foreach ($cmns_fields_tmp1 as $kk=>$vv){
					if ($v==$kk){
						$cmns_fields_tmp[$kk] = $vv;
					}
					unset($cmns_fields_tmp1[$v]);
				}
			}
			$data['cmns_fields_tmp'] = $cmns_fields_tmp;
			$data['cmns_fields_tmp1'] = $cmns_fields_tmp1;
			
		}
		if ($com_main_new_sells['num']){
			$data['cmns_num'] = array_pop(explode(",", $com_main_new_sells['num']));
		}
		$data['com_main_new_sells'] = $com_main_new_sells;
		//公司简介
		$com_main_intro = $this->comm->find("page_set",array('mode'=>'com_main_intro','in_page'=>'com_main'));
		if ($com_main_intro['fields']){
			$data['cmintro_fields'] = $cmintro_fields = explode(',', $com_main_intro['fields']);
			$cmintro_fields_tmp1 = $corp_main_fields;
			foreach ($cmintro_fields as $k=>$v){
				foreach ($cmintro_fields_tmp1 as $kk=>$vv){
					if ($v==$kk){
						$cmintro_fields_tmp[$kk] = $vv;
					}
					unset($cmintro_fields_tmp1[$v]);
				}
			}
			$data['cmintro_fields_tmp'] = $cmintro_fields_tmp;
			$data['cmintro_fields_tmp1'] = $cmintro_fields_tmp1;
		}
		//公司类别
		$data['com_main_cate']=$com_main_cate = $this->comm->find("page_set",array('mode'=>'com_main_cate','in_page'=>'com_main'));
		if ($com_main_cate['num']){
			$data['cmi_num'] = array_pop(explode(",", $com_main_cate['num']));;
		}
		
		$this->load->view("my_menu/page_style/page_setting",$data);
	}
	//public function
	function hot_search(){
		if ($this->input->post()){
			extract($this->input->post());
			if (is_array($orderby)){
				$sort = "";
				foreach ($orderby as $ko=>$vo){
					if (!$vo) unset($orderby[$ko]);
				}
				$sort = array_shift($orderby);
			}else {
				$sort = "id asc";
			}
			$cons ? $cons=1 : $cons="";
			$is_item ? $is_item=1 : $is_item="";
			$mlength ? $mlength = $mlength : $mlength = 0;
			$sort = $sort ? $sort : "id asc";
			$get_data = array('mode'=>$mode,'in_page'=>$in_page,'num'=>$limit,'conditions'=>$cons,'sort'=>$sort,'fields'=>$is_item,'mlength'=>$mlength,'edittime'=>time(),'editip'=>$_SERVER["REMOTE_ADDR"],'username'=>$this->username);
			$check = $this->comm->find('page_set',array('mode'=>$mode,'in_page'=>$in_page));
			if ($check){
				$rs=$this->comm->update('page_set',array('id'=>$check['id']),$get_data);
			}else {
				$rs=$this->comm->create('page_set',$get_data);
			}
			$rs ? $rs = "长尾词配置成功！" : $rs = "长尾词配置失败，请重试!";
			}else {
				$rs="请选择长尾词配置";
			}
			
			$data['msg']=$rs;
			$this->load->view('public/success',$data);

	}
	//public function
	function sell_list(){
		if ($this->input->post()){
			extract($this->input->post());
			$fields_tmp = "";
			if(!is_array($fields)){
				$fields_tmp  = explode(",",$fields);
				array_pop($fields_tmp);
				$fields_tmp = implode(",",$fields_tmp);
				$get_data = array('mode'=>$mode,'in_page'=>$in_page,'fields'=>$fields_tmp,'edittime'=>time(),'editip'=>$_SERVER["REMOTE_ADDR"],'username'=>$this->username);
				$check = $this->comm->find('page_set',array('mode'=>$mode,'in_page'=>$in_page));
				if ($check){
					$rs=$this->comm->update('page_set',array('id'=>$check['id']),$get_data);
					echo $rs;
				}else {
					$rs=$this->comm->create('page_set',$get_data);
					echo $rs;
				}
			}else {
				$condition = "";
				if (is_array($cons)){
					foreach ($cons as $kc=>$vc){
						if ($kc<count($cons)-1){
							$condition .= $vc.",";
						}else {
							$condition .= $vc;
						}
					}
				}
				$sort = "";
				if (is_array($orderby)){
					foreach ($orderby as $ko=>$vo){
						if (!$vo) unset($orderby[$ko]);
					}
					$sort = array_shift($orderby);
				}
				if (is_array($fields)){
					foreach ($fields as $kf=>$vf){
						if (!$vf) continue;
						if ($kf<count($fields)-1){
							$fields_tmp .= $vf.",";
						}else {
							$fields_tmp .= $vf;
						}
					}
				}
				$mlength ? $mlength : $mlength=0;
				$get_data = array('mode'=>$mode,'in_page'=>$in_page,'num'=>$limit,'conditions'=>$condition,'fields'=>$fields_tmp,'sort'=>$sort,'mlength'=>$mlength,'edittime'=>time(),'editip'=>$_SERVER["REMOTE_ADDR"],'username'=>$this->username);
				$check = $this->comm->find('page_set',array('mode'=>$mode,'in_page'=>$in_page));
				if ($check){
					$rs=$this->comm->update('page_set',array('id'=>$check['id']),$get_data);
					if($mode === "seo_sell_list" && $in_page === "seo_sell"){
						$this->comm->update('page_set',array('mode'=>'seo_cate_list','in_page'=>$in_page),array('mlength'=>$mlength,'edittime'=>time(),'editip'=>$_SERVER["REMOTE_ADDR"],'username'=>$this->username));
					}
				}else {
					$rs=$this->comm->create('page_set',$get_data);
				}
				$rs ? $rs = "产品列表配置成功！" : $rs = "产品列表配置失败，请重试!";
				$data['msg']=$rs;
				$this->load->view('public/success',$data);
			}
		}else {
			$rs="请选择产品列表配置";
			$data['msg']=$rs;
			$this->load->view('public/success',$data);
		}
		
	}
	//public function
	function attr_list(){
		if ($this->input->post()){
			extract($this->input->post());
			$mlength = $mlength ? $mlength : 0;
			$get_data = array('mode'=>$mode,'in_page'=>$in_page,'num'=>$limit,'mlength'=>$mlength,'edittime'=>time(),'editip'=>$_SERVER["REMOTE_ADDR"],'username'=>$this->username);
			$check = $this->comm->find('page_set',array('mode'=>$mode,'in_page'=>$in_page));
			if ($check){
				$rs=$this->comm->update('page_set',array('id'=>$check['id']),$get_data);
			}else {
				$rs=$this->comm->create('page_set',$get_data);
			}
			$rs ? $rs = "产品属性列表配置成功！" : $rs = "产品属性列表配置失败，请重试!";
		}else {
			$rs="请选择产品属性列表配置";
		}
		$data['msg']=$rs;
		$this->load->view('public/success',$data);
	}
	//public function 
	function catelist_set(){
		if ($this->input->post()){
			extract($this->input->post());
			if ($limit1 && $limit2){
				$limit = $limit1."|".$limit2;
			}
			$sort = "";
			if (is_array($orderby)){
				foreach ($orderby as $ko=>$vo){
					if (!$vo) unset($orderby[$ko]);
				}
				$sort = array_shift($orderby);
			}
			if (is_array($orderby2)){
				foreach ($orderby2 as $ko=>$vo){
					if (!$vo) unset($orderby2[$ko]);
				}
				$sort2 = array_shift($orderby2);
				$sort = $sort."|".$sort2;
			}
			
			$is_item ? $is_item=1 : $is_item="";
			$get_data = array('mode'=>$mode,'in_page'=>$in_page,'num'=>$limit,'sort'=>$sort,'fields'=>$is_item,'edittime'=>time(),'editip'=>$_SERVER["REMOTE_ADDR"],'username'=>$this->username);
			$check = $this->comm->find('page_set',array('mode'=>$mode,'in_page'=>$in_page));
			if ($check){
				$rs=$this->comm->update('page_set',array('id'=>$check['id']),$get_data);
			}else {
				$rs=$this->comm->create('page_set',$get_data);
			}
			$rs ? $rs = "类别列表配置成功！" : $rs = "类别列表配置失败，请重试!";
		}else {
			$rs="请选择类别列表配置";
		}
		$data['msg']=$rs;
		$this->load->view('public/success',$data);
	}
	
	//public function 
	function corps_list(){
		if ($this->input->post()){
			extract($this->input->post());
			$fields_tmp = "";
			if (is_array($fields)){
				foreach ($fields as $kf=>$vf){
					if (!$vf) continue;
					if ($kf<count($fields)-1){
						$fields_tmp .= $vf.",";
					}else {
						$fields_tmp .= $vf;
					}
				}
			}
			$sort = "";
			if (is_array($orderby)){
				foreach ($orderby as $ko=>$vo){
					if (!$vo) unset($orderby[$ko]);
				}
				$sort = array_shift($orderby);
			}
			$get_data = array('mode'=>$mode,'in_page'=>$in_page,'num'=>$limit,'conditions'=>"",'sort'=>$sort,'fields'=>$fields_tmp,'mlength'=>0,'edittime'=>time(),'editip'=>$_SERVER["REMOTE_ADDR"],'username'=>$this->username);
			$check = $this->comm->find('page_set',array('mode'=>$mode,'in_page'=>$in_page));
			if ($check){
				$rs=$this->comm->update('page_set',array('id'=>$check['id']),$get_data);
			}else {
				$rs=$this->comm->create('page_set',$get_data);
			}
			$rs ? $rs = "公司列表配置成功！" : $rs = "公司列表配置失败，请重试!";
		}else {
			$rs="请选择公司列表配置";
		}
		$data['msg']=$rs;
		$this->load->view('public/success',$data);
	}

	//sell_detail
	function pros_vs(){
		if ($this->input->post()){
			extract($this->input->post());
			$condition = "";
			$sort = "";
			if (is_array($orderby)){
				foreach ($orderby as $ko=>$vo){
					if (!$vo) unset($orderby[$ko]);
				}
				$sort = array_shift($orderby);
			}
			if ($limit1 && $limit2){
				$limit = $limit1."|".$limit2;
			}
			$get_data = array('mode'=>$mode,'in_page'=>$in_page,'num'=>$limit,'conditions'=>$condition,'sort'=>$sort,'fields'=>"",'mlength'=>$mlength,'edittime'=>time(),'editip'=>$_SERVER["REMOTE_ADDR"],'username'=>$this->username);
			$check = $this->comm->find('page_set',array('mode'=>$mode,'in_page'=>$in_page));
			if ($check){
				$rs=$this->comm->update('page_set',array('id'=>$check['id']),$get_data);
			}else {
				$rs=$this->comm->create('page_set',$get_data);
			}
			$rs ? $rs = "产品对比配置成功！" : $rs = "产品对比配置失败，请重试!";
		}else {
			$rs="请选择产品对比配置";
		}
	
		$data['msg']=$rs;
		$this->load->view('public/success',$data);
	}
	//sell_detail
	function com_intro(){
		if ($this->input->post()){
			extract($this->input->post());
			$fields_tmp = "";
			if (is_array($intro_fields)){
				foreach ($intro_fields as $kf=>$vf){
					if (!$vf) continue;
					if ($kf<count($intro_fields)-1){
						$fields_tmp .= $vf.",";
					}else {
						$fields_tmp .= $vf;
					}
				}
			}
		
			$get_data = array('mode'=>$mode,'in_page'=>$in_page,'num'=>"",'conditions'=>"",'sort'=>"",'fields'=>$fields_tmp,'edittime'=>time(),'editip'=>$_SERVER["REMOTE_ADDR"],'username'=>$this->username);
			$check = $this->comm->find('page_set',array('mode'=>$mode,'in_page'=>$in_page));
			if ($check){
				$rs=$this->comm->update('page_set',array('id'=>$check['id']),$get_data);
			}else {
				$rs=$this->comm->create('page_set',$get_data);
			}
			$rs ? $rs = "公司简介配置成功！" : $rs = "公司简介配置失败，请重试!";
		}else {
			$rs="请选择公司简介配置";
		}
		
		$data['msg']=$rs;
		$this->load->view('public/success',$data);
	}
	
	//com_main
	function com_main_intro(){
		if ($this->input->post()){
			extract($this->input->post());
			$fields_tmp = "";
			if (is_array($intro_fields)){
				foreach ($intro_fields as $kf=>$vf){
					if (!$vf) continue;
					if ($kf<count($intro_fields)-1){
						$fields_tmp .= $vf.",";
					}else {
						$fields_tmp .= $vf;
					}
				}
				$get_data = array('mode'=>$mode,'in_page'=>$in_page,'num'=>"",'conditions'=>"",'sort'=>"",'fields'=>$fields_tmp,'edittime'=>time(),'editip'=>$_SERVER["REMOTE_ADDR"],'username'=>$this->username);
				$check = $this->comm->find('page_set',array('mode'=>$mode,'in_page'=>$in_page));
				if ($check){
					$rs=$this->comm->update('page_set',array('id'=>$check['id']),$get_data);
				}else {
					$rs=$this->comm->create('page_set',$get_data);
				}
				$rs ? $rs = "(公司页)公司简介配置成功！" : $rs = "(公司页)公司简介配置失败，请重试!";
			}else {
				$rs="请选择(公司页)公司简介配置";
			}
		}else {
			$rs="请选择(公司页)公司简介配置";
		}
		
		$data['msg']=$rs;
		$this->load->view('public/success',$data);
	}
	//com_main
	function com_main_cate(){
		if ($this->input->post()){
			extract($this->input->post());
			if ($limit){
				$is_item ? $is_item=1 : $is_item=""; 
				$get_data = array('mode'=>$mode,'in_page'=>$in_page,'num'=>$limit,'fields'=>$is_item,'edittime'=>time(),'editip'=>$_SERVER["REMOTE_ADDR"],'username'=>$this->username);
				$check = $this->comm->find('page_set',array('mode'=>$mode,'in_page'=>$in_page));
				if ($check){
					$rs=$this->comm->update('page_set',array('id'=>$check['id']),$get_data);
				}else {
					$rs=$this->comm->create('page_set',$get_data);
				}
				$rs ? $rs = "公司类别配置成功！" : $rs = "公司类别配置失败，请重试!";
			}else {
				$rs="请选择公司类别配置";
			}
		}else {
			$rs="请选择公司类别配置";
		}
		$data['msg']=$rs;
		$this->load->view('public/success',$data);
	}
	
	
	
	
	
	
	
	
	
}