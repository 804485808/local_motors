<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Company extends CI_Controller {
	function __construct(){
		parent::__construct();

		$this->load->helper('url');
		$this->load->model('comm_model','comm');
		$this->load->helper('inflector');
		$this->load->library('encrypt');
		$t_username = $this->input->cookie('username', TRUE);
		$hash_1 = $this->input->cookie('hash_1', TRUE);
		$this->t_username = $this->encrypt->decode($t_username,$hash_1);
	}

    public $userid;

	
	//com_home
	public function index(){	
		$data = $this->Common();
        $userid = $this->userid;
//        $userid=2;
        //company detail


        $re = $company = $this->company->getCompanyCommon('*',"userid={$userid}",'','','',1);
        $re = $this->company->getCompanyCommonLink('t1.*,t2.*',array('wl_company'=>'t1'),array('Member'=>'t2'),"t1.userid={$userid}",'','',1);
        $res = $this->type->getTypeCommon('tname',"userid={$userid}");
        $mainProduct = '';
        foreach($res as $k=>$v){
            $mainProduct .= $v['tname'].",";
        }
        $mainProduct = substr($mainProduct,0,-1);
        $re['mainProduct'] = $mainProduct;

        $country = file_get_contents(base_url('/skin/country.txt'));
        $country = str_replace(array("\r\n","\r"),"\n",$country);
        $AllCountry = explode("\n",$country);
        //$AllCountry = preg_split('/\r\n/',$country);
        shuffle($AllCountry);

        $re['markets']=$AllCountry[0].",".$AllCountry[1].",".$AllCountry[2];

        $data['company_detail'] = $re;


        //hot sell
        $re = $this->type->getTypeCommonLink('t1.tid,t1.tname,t2.subtitle,t2.title,t2.thumb,t2.username,t2.linkurl,t2.linkurl,t2.itemid',array('wl_type'=>'t1'),array('Sell'=>'t2'),"t1.userid={$userid} and t2.status=3","t2.hits desc");
        $data['hot_sell'] = $re;

        //type
        $typeArr = array();
        foreach($re as $k=>$v){
            $typeArr[$v['tname']]= $v['tid'];
        }
        $data['companyType'] = $typeArr;

		$data['title'] = $company['company']." on motors-biz.com";
		$data['company'] = $company;

        $this->load->view('header',$data);
		$this->load->view('company/com_home');
		$this->load->view('footer');
	}

	function sell_list(){

		$this->load->service("url_service","urls");
		$data = $this->Common();

        $userid = $this->userid;
	    $this->load->model('type_model','type');
        $this->load->model('category_option_model','category_option');
        $this->load->model('sell_model','sell');
        $re = $this->sell->getSellCommon('pptword,itemid,username,thumb,title,mycatid',"username='{$data['username']}'",'','','0,50');


        $pptword = '';
        $itemids = '';
        foreach($re as $k=>$v){
            $pptword .= $v['pptword'].",";
            $itemids .= $v['itemid'].",";
        }
        $pptword = substr($pptword,0,-1);
        $itemids = substr($itemids,0,-1);


        //hot product
        $re = $this->sell->getSellCommon('minprice,currency,itemid,linkurl,username,thumb,title',"itemid in ({$itemids}) and status=3",'','hits desc','0,10');
        $data['hotProducts'] = $re;


        $re = $this->type->getCountTypeSell($userid);
		
        $sell_count = $re['num'];

        $page_size = 12;
        $re = $this->uri->rsegment('3');
        if(strstr($re,'tid')){
            $page = $this->uri->rsegment('4');
            if(!$page){
                $page = 0;
            }
            $r = explode('-',$re);
            $tid = $r[1];
        }else{
            $page = $this->uri->rsegment('3');
            if(!$page){
                $page=0;
            }
        }
		

        $where = $tid?" t1.tid = '{$tid}' and t1.userid='{$userid}' ":" t1.userid='{$userid}' ";
        $where .= " and t2.status=3 ";

        $limit = "".$page.",".$page_size."";



        $re = $this->type->getTypeSellPage($where,$limit);
        $country = file_get_contents(base_url('/skin/country.txt'));

        $sellList = array();
        foreach($re as $k=>$v){
            $rr = $this->sell->getSellCompany($v['itemid'],$country);
           $sellList[$v['itemid']]=$rr;
        }

        $data['sellList'] = $sellList;

        $thislinkurl=$this->uri->rsegment('2');
        //分页
        $data['total_count']=$sell_count;
        $cons = $thislinkurl;
        $base_url = site_url("company/".$cons);
        $data['total_page']=ceil($sell_count/$page_size);
        $this->load->library('pagination');
        $config['base_url'] = $base_url;
        $config['total_rows'] = $sell_count ? $sell_count : 0;
        $config['per_page'] = $page_size;
        $config['uri_segment'] = 4;
        $config['num_links'] = 4;
        $config['suffix'] = $this->config->item('url_suffix');
        $config['first_link']='first';
        $config['last_link']='last';
        $config['anchor_class'] = "class='pro_page' rel='nofollow'";
        $config['cur_tag_open'] = '<span class="current">';
        $config['cur_tag_close'] = '</span>';
        $this->pagination->initialize($config);
        $data['pages'] = $pages = $this->pagination->create_links();
		
		$company = $this->company->getCompanyCommon('*',"userid = {$userid}",'','','',1);
		$tid = $this->uri->rsegment(3,0);
		$tid = str_ireplace("tid_","",$tid);
		
		if(!$tid){
			$title = "Products List";
		}else{
			$tid = intval($tid);
			$findtype = $this->comm->find("type",array("tid"=>$tid));
			$title = $findtype['tname'];
		}

		$data['title'] = $title."-".$company['company']." on motors-biz.com";
		$data['company'] = $company;
		
		$this->load->view('header',$data);	
		$this->load->view('company/com_sell_list');
		$this->load->view('footer');
	}
	
	
	
	//company info
	public function info(){
        $data = $this->Common();
		$userid = $this->userid;
		
		$company_data = $company = $this->comm->find("company",array("userid"=>$userid));
		$area=$this->comm->find("area",array("areaid"=>$company_data['areaid']),"","areaname");
		$company_data['areaname']=$area['areaname'];
		$com_content=$this->comm->find("company_data",array("userid"=>$userid));
		$company_data['content'] = $com_content['content'];
		$data['company_data'] = $company_data;
		//dump($company_data);
		
		$btype=explode(",",$company_data['business']);
		$two_btype=array_shift($btype).",".array_shift($btype);
		$data['title'] = "Company Information - ".$company_data['company']." - ".$two_btype;
		
		$com_type=$this->comm->findAll("type",array("userid"=>$userid));
		$data['com_type'] = $com_type;		
		
		$data['title'] = "Company Info - ".$company['company']." on motors-biz.com";
		$data['company'] = $company;
		$this->load->view('header',$data);	
		$this->load->view('company/com_info');
		$this->load->view('footer');
	}
	
	
	//company contact
	public function contact(){
        $data = $this->Common();
        $userid = $this->userid;

		$this->load->model('company_model','company');
        $this->load->model('member_model','member');
        $this->load->model('type_model','type');
        $data['companyInfo'] = $company = $this->company->getCompanyCommon('*',"userid = {$userid}",'','','',1);
        $data['userInfo'] = $this->member->getMemberCommon('*',"userid={$userid}",'','',1);
        $data['type_sell'] = $this->type->getTypeSell($userid);

		$data['title'] = "Company Contact - ".$company['company']." on motors-biz.com";
		$data['company'] = $company;
		$this->load->view('header',$data);	
		$this->load->view('company/com_contact');
		$this->load->view('footer');
	}

    public function companyProfile(){
        $data = $this->Common();
        $userid = $this->userid;
        $this->load->model('company_model','company');
        $data['companyInfo'] = $company = $this->company->getCompanyCommon('*',"userid={$userid}",'','','',1);

		$data['title'] = "Company Profile - ".$company['company']." on motors-biz.com";
		$data['company'] = $company;
        $this->load->view('header',$data);
        $this->load->view('company/company_profile');
        $this->load->view('footer');
    }

    //公共方法
    public function Common(){
        $this->load->model('company_model','company');
        $this->load->model('type_model','type');

        $data['t_username'] = $this->t_username;
        $site = $this->config->item("site");
        $data['site'] = $site;

        $thisurl = current_url();
        if(preg_match("/http:\/\/(.*)\./isU",$thisurl,$arr)){
            $username = $arr[1];
        }else{
            show_404();
            die();
        }
        $userid=$this->comm->find("company",array("username"=>$username),"","userid");
        if(!$userid){
            show_404();
            die();
        }
        $this->userid=$userid['userid'];
        $data['username'] = $username;

        $kwtable=$this->db->dbprefix("tagindex");
        $sql="SELECT t1.id,t1.tag,t1.linkurl";
        $sql.=" FROM `{$kwtable}` AS t1 JOIN (SELECT ROUND(RAND() * ((SELECT MAX(id) FROM `{$kwtable}`)-(SELECT MIN(id) FROM `{$kwtable}`))+(SELECT MIN(id) FROM `{$kwtable}`)) AS id) AS t2";
        $sql.=" WHERE t1.id >= t2.id LIMIT 0,5";
        $query=$this->db->query($sql);
        if($query->num_rows()>0){
            $data['keywords'] = $query->result_array();
        }else {
            $data['keywords'] = $this->comm->findAll("tagindex","","","","0,5");
        }

      

        //Category_sell
        $arr = $this->type->getTypeSell($this->userid);
        $data['Type_sell'] = $arr;

        return $data;
    }
}