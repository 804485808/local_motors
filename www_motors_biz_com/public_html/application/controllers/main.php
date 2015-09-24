<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Main extends MY_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('comm_model','comm');
        $this->load->model('tagindex_model','tagindex');
        $this->load->model('sell_model','sell');
	}
	
	public function index(){
        $data['url'] = "index";
		$data['username'] = $this->username;
		$this->config->set_item("compress_output",TRUE);
		$this->load->helper('inflector');
		$site = $this->config->item("site");
		$data['site'] = $site;

		$data['country'] = array("China","India","Japan","Malaysia","Thailand","Turkey","USA","Vietnam");		

        //关键词封装
        $re_tagindex = $this->tagindex->getRoundTagindex();

        $data['keywords'] = $re_tagindex;

        //获取最新商品
        $selllist = $this->sell->getLatestProducts('0,10');

		$data['selllist'] = $selllist;

        //获取最新供应商
        $this->load->model('member_model','member');
        $this->load->model('company_model','company');
        $data['comlist'] = $this->company->getCompanyCommon('userid,username,company,business',"",'','','0,9');

        //获取最新询单信息
        $this->load->model('inquiry_model','inquiry');
        $data['NewInquiry'] = $this->inquiry->getNewInquiry('0,10');


        //获取最热门商品
        $hot_pros = $this->sell->getHotProducts('0,15');
        //商品属性
        $this->load->model('category_option_model','category_option');
        foreach($hot_pros as $k=>$v){

            $re = $this->category_option->getSellOption($v['pptword'],$v['itemid']);
            $hot_pros[$k]['attr'] = array_slice($re,0,3);
        }
        unset($hot_pros[2]);
		if(!$hot_pros){
			$hot_pros = array();
		}

		$data['hot_pros'] = $hot_pros;
        $this->load->model('category_model','category');

        $top_cates = $this->category->getCategoryCommon('catid,catname,linkurl',"parentid = 0 AND item <> 0 ",'hits desc,letter asc','');
		$top_cates_1 = array_slice($top_cates,0,16);
        $top_cates_other = array_slice($top_cates,17);
        $data['top_cates_other'] = $top_cates_other;
        //调整Other Motors顺序
        foreach($top_cates_1 as $k=>$v){
            if($v['catid']==587){
                $otherArr = $v;
                unset($top_cates_1[$k]);
            }
            if($v['catid']==2051){
                $hubMotors = $v;
                unset($top_cates_1[$k]);
               $re = $this->category->getCategoryCommon('catid,catname,linkurl',"catid=1104",'','',1);
               $MotorParts = $re;
            }


        }
        $top_cates_1[]=$otherArr;
        $top_cates_1[]=$MotorParts;

		$count_cates = count($top_cates);
		$top_cates_2 = array();
		if($count_cates > 8){
			$top_cates_2 = array_slice($top_cates,8,$count_cates-8);
		}

		$data['top_cates_1'] = $top_cates_1;			
		$data['top_cates_2'] = array_chunk($top_cates_2,20);

		$sub_cate=array();
		foreach($top_cates_1 as $s=>$t){
            $sub_cate[$t['catid']] = $this->category->getCategoryCommon("catid,catname,linkurl","parentid = {$t['catid']} AND item <> 0","hits desc,letter asc");
		}
		$data['sub_cate'] = $sub_cate;

        $this->load->model('company_model','company');

        $data['senior_com'] = $this->company->getCompanyCommon("userid,username,company","company!=''",'',"vip desc",'0,10');

        $showcase = $this->sell->getSellCommon('*',"level = 1",'','','0,8');
		if(!$showcase){
			$showcase = array();
		}

		$data['showcase_1'] = array_shift($showcase);
		$showcase = array_chunk($showcase,4);

        $this->load->model('area_model','area');
		if(isset($showcase[0])){
			foreach($showcase[0] as $x=>$z){
                $area = $this->area->getAreaName($z['areaid']);
				$showcase[0][$x]['areaname'] = $area['areaname'];
			}
		}

		if(isset($showcase[1])){
			foreach($showcase[1] as $n=>$m){
                $user = $this->member->getMemberCommon('userid',"username='{$m['username']}'",'','',1);
				$showcase[1][$n]['userid'] = $user['userid'];
			}
		}

        $this->load->model('news_model','news');
        $this->load->model('category_new_model','category_new');

        //获取技术
        $re = $this->category_new->getShowCategory('Technology');

        $arr = array();
        foreach($re as $k=>$v){
                $arr[$v['catname']][] = $v;
        }
        $data['technology'] = array_slice($arr,0,3);

        //获取展会
        $re = $this->category_new->getShowCategory('Exhibition');
        $data['exhibition'] = array_slice($re,0,7);

        //获取行情
        $re = $this->category_new->getShowCategory('Company News');
        $re1 = $this->category_new->getShowCategory('Industry News');
        $re2 = array_merge_recursive($re,$re1);

        $arr = array();
        foreach($re2 as $k=>$v){
            $arr[$v['catname']][] = $v;
        }
        $data['market'] = array_slice($arr,0,2);

        //获取新闻排行
        $this->load->model('news_model','news');
        $data['newsTop'] = $this->news->getNewsTop('0,12');
        //hot news
        $data['hotNews'] = $this->news->getNewsCommon('*','','hits desc','0,8');
        //获取价格
        $re = $this->sell->getHotProductPrice('0,4');

        $data['productPrice'] = $re;
		$data['showcase'] = $showcase;
		header('Content-Language:en');

        $data['title'] = "Motors-biz.com, Comprehensive Portal on Motor Products, Information, Exhibitions, Price, Suppliers, Buyers, Manufacturers";
        $data['description']="Motors-biz.com, a promising comprehensive portal for motor products, helps you to select suitable motor products. Learn about latest price and information on technology, news and exhibitions, find quality suppliers, buyers and manufacturers.";


		$this->load->view('header',$data);
		$this->load->view('main');
		$this->load->view('footer');
	}

    /**
     * 标题
     */
    public function subtitle(){
        $this->load->model('sell_model','sell');
        $i = $this->uri->rsegment(3,0);

        $page = $i*1000;
        $pageSize = 1000;
        $limit = "".$page.",".$pageSize."";
        $this->sell->changeTitle($limit);
        $i++;

        $url = site_url("main/subtitle/{$i}");
        echo "
            <script language='JavaScript'>
                window.location='".$url."'
            </script>
            ";
    }

    /**
     * 获取userid
     */
    public function getUerId(){
        $this->load->model('sell_model','sell');
        $i = $this->uri->rsegment(3,0);

        $page = $i*1000;
        $pageSize = 1000;
        $limit = "".$page.",".$pageSize."";

        $this->sell->getUserId($limit);
        $i++;

        $url = site_url("main/getUerId/{$i}");
        echo "
            <script language='JavaScript'>
                window.location='".$url."'
            </script>
            ";
    }

    /**
     * 文章标题图片
     */
    public function changeNewThumb(){
        $this->db->select('itemid,thumb');
        $query = $this->db->get('wl_news');
        $re = $query->result_array();
        foreach($re as $v){
            if($v['thumb']){
                $str = str_replace('/img/www_motorsbiz_com/public_html','',$v['thumb']);
                $this->db->where("itemid = {$v['itemid']}");
                $this->db->update('wl_news',array('thumb'=>$str));

            }
        }
    }

    /**
     * 文章内容图片
     */
    public function changeNewDataThumb(){
        $this->db->select('itemid,content');
        $query = $this->db->get('wl_news_data');
        $re = $query->result_array();
        foreach($re as $v){
            if($v['content']){
                $str = str_replace('http://img.com','http://img.motors-biz.com',$v['content']);
                $this->db->where("itemid = {$v['itemid']}");
                $this->db->update('wl_news_data',array('content'=>$str));
            }
        }
    }

}


